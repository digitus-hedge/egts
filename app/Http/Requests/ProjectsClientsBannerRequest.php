<?php

namespace App\Http\Requests;

use App\Models\ProjectsClientsBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ProjectsClientsBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'        => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'video'        => 'nullable|mimes:mp4,mov,webm|max:20480',
            'remove_image' => 'nullable|boolean',
            'remove_video' => 'nullable|boolean',
            'title'        => 'required|string|max:45',
            'content'      => 'required|string|max:300',
            'description'  => 'required|string|max:600',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'The image must be a JPG, PNG, or WEBP file.',
            'image.max'   => 'The image must not exceed 10MB.',
            'video.mimes' => 'The video must be an MP4, MOV, or WEBM file.',
            'video.max'   => 'The video must not exceed 20MB.',
        ];
    }

    /**
     * Require either an Image or a Video — not both, and not neither.
     * Checked against the existing record's saved files, accounting for
     * any new uploads and any removal flags in this request.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $existing = ProjectsClientsBanner::first();

            $hasNewImage = $this->hasFile('image');
            $hasNewVideo = $this->hasFile('video');

            $hasExistingImage = $existing && !empty($existing->image) && !$this->boolean('remove_image');
            $hasExistingVideo = $existing && !empty($existing->video) && !$this->boolean('remove_video');

            $willHaveImage = $hasNewImage || $hasExistingImage;
            $willHaveVideo = $hasNewVideo || $hasExistingVideo;

            if (!$willHaveImage && !$willHaveVideo) {
                $validator->errors()->add('image', 'Please upload either an Image or a Video.');
            }
        });
    }
}