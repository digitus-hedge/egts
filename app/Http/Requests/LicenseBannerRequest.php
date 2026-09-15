<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Models\LicenseBanner;

class LicenseBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:45',
            'description' => 'required|string|max:300',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'video'       => 'nullable|mimes:mp4,mov,webm|max:20480',

            'remove_image' => 'nullable|boolean',
            'remove_video' => 'nullable|boolean',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'File must be a valid image.',
            'image.mimes' => 'Image must be JPG, PNG, or WEBP.',
            'image.max'   => 'Image must not exceed 10MB.',
            'video.mimes' => 'Video must be MP4, MOV, or WEBM.',
            'video.max'   => 'Video must not exceed 20MB.',
        ];
    }

    /**
     * Either an Image or a Video is required — not both, and not neither.
     * Checked against the existing record's saved files, accounting for
     * any new uploads and any removal flags in this request.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $banner = LicenseBanner::first();

            $hasNewImage = $this->hasFile('image');
            $hasNewVideo = $this->hasFile('video');

            $hasExistingImage = $banner && !empty($banner->image) && !$this->boolean('remove_image');
            $hasExistingVideo = $banner && !empty($banner->video) && !$this->boolean('remove_video');

            $willHaveImage = $hasNewImage || $hasExistingImage;
            $willHaveVideo = $hasNewVideo || $hasExistingVideo;

            if (!$willHaveImage && !$willHaveVideo) {
                $validator->errors()->add('image', 'Please upload either an Image or a Video.');
            }
        });
    }
}
