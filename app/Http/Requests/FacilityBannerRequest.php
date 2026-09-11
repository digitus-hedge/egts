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
            'banner_title'       => 'required|string|max:255',
            'banner_description' => 'required|string|max:1000',
            // banner_image is never "required" here — the after() hook below
            // decides whether it's actually missing, based on the existing record.
            'banner_image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'operations_heading'     => 'required|string|max:255',
            'operations_description' => 'required|string|max:2000',

            'infrastructure_title'       => 'required|string|max:255',
            'infrastructure_description' => 'required|string',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute is required.',
            'string'   => 'The :attribute must be plain text.',
            'max'      => 'The :attribute is too long or too large.',
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
            $hasExistingImage = $facilityBanner && !empty($facilityBanner->banner_image);

            if (!$hasNewImage && !$hasExistingImage) {
                $validator->errors()->add('banner_image', 'Please upload a Banner Image.');
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