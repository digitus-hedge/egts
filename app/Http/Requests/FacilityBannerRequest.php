<?php

namespace App\Http\Requests;

use App\Models\FacilityBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class FacilityBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'banner_title'       => 'required|string|max:60',
            'banner_description' => 'required|string|max:150',
            // banner_image / banner_video are never "required" directly here — the
            // after() hook below decides whether at least one is missing, based on
            // the existing record and any removal flags.
            'banner_image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'banner_video'       => 'nullable|mimes:mp4,mov,webm|max:20480',

            'remove_banner_image' => 'nullable|boolean',
            'remove_banner_video' => 'nullable|boolean',

            'operations_heading'     => 'required|string|max:45',
            'operations_description' => 'required|string|max:350',

            'infrastructure_title'       => 'required|string|max:45',
            'infrastructure_description' => 'required|string|max:600',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute is required.',
            'string'   => 'The :attribute must be plain text.',
            'max'      => 'The :attribute :max is too long.',
            'image'    => 'The :attribute must be a valid image (JPG, PNG, or WEBP).',
            'mimes'    => 'The :attribute must be a file of type: :values.',
        ];
    }

    public function attributes(): array
    {
        return [
            'banner_title'       => 'Banner Title',
            'banner_description' => 'Banner Description',
            'banner_image'       => 'Banner Image',
            'banner_video'       => 'Banner Video',

            'operations_heading'     => 'Operations Heading',
            'operations_description' => 'Operations Description',

            'infrastructure_title'       => 'Infrastructure Title',
            'infrastructure_description' => 'Infrastructure Description',

            'meta_title'       => 'Meta Title',
            'meta_description' => 'Meta Description',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            // Query the singleton row directly — do NOT rely on $this->route(),
            // since this form's route has no bound model parameter.
            $facilityBanner = FacilityBanner::first();

            $hasNewImage = $this->hasFile('banner_image');
            $hasNewVideo = $this->hasFile('banner_video');

            $hasExistingImage = $facilityBanner && !empty($facilityBanner->banner_image) && !$this->boolean('remove_banner_image');
            $hasExistingVideo = $facilityBanner && !empty($facilityBanner->banner_video) && !$this->boolean('remove_banner_video');

            $willHaveImage = $hasNewImage || $hasExistingImage;
            $willHaveVideo = $hasNewVideo || $hasExistingVideo;

            if (!$willHaveImage && !$willHaveVideo) {
                $validator->errors()->add('banner_image', 'Please upload either a Banner Image or a Banner Video.');
            }

            // Same fix pattern for infrastructure_description (CKEditor empty-markup check)
            $raw = $this->input('infrastructure_description', '');
            $stripped = trim(strip_tags($raw));
            if ($stripped === '') {
                $validator->errors()->add('infrastructure_description', 'The Infrastructure Description cannot be empty.');
            }
        });
    }
}