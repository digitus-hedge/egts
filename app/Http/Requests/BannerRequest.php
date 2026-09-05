<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class BannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|min:3|max:255',
            'description' => 'required|string|max:2000',

            'image_1' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'video'   => 'nullable|mimes:mp4,mov,avi,wmv|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Please enter a banner title.',
            'title.min'            => 'Title must be at least :min characters.',
            'title.max'            => 'Title cannot exceed :max characters.',

            'description.required' => 'Please enter a banner description.',
            'description.max'      => 'Description cannot exceed :max characters.',

            'image_1.image'        => 'Image 1 must be a valid image file.',
            'image_2.image'        => 'Image 2 must be a valid image file.',
            'image_3.image'        => 'Image 3 must be a valid image file.',

            'image_1.mimes'        => 'Image 1 must be a JPG, PNG, or WEBP file.',
            'image_2.mimes'        => 'Image 2 must be a JPG, PNG, or WEBP file.',
            'image_3.mimes'        => 'Image 3 must be a JPG, PNG, or WEBP file.',

            'image_1.max'          => 'Image 1 must not exceed 2MB.',
            'image_2.max'          => 'Image 2 must not exceed 2MB.',
            'image_3.max'          => 'Image 3 must not exceed 2MB.',

            'video.mimes'          => 'Video must be a file of type: MP4, MOV, AVI, or WMV.',
            'video.max'            => 'Video must not exceed 5MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'       => 'banner title',
            'description' => 'banner description',
            'image_1'     => 'Image 1',
            'image_2'     => 'Image 2',
            'image_3'     => 'Image 3',
            'video'       => 'video',
        ];
    }

    /**
     * Custom conditional validation:
     * - At least 1 image is required (new upload OR already saved on the banner when editing)
     * - Video becomes required only if there are no images at all (new or existing)
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {

            $banner = \App\Models\Banner::first(); // the single existing banner row, or null if none saved yet

            // Count newly uploaded images in this request
            $newImageCount = collect(['image_1', 'image_2', 'image_3'])
                ->filter(fn ($field) => $this->hasFile($field))
                ->count();

            // Count images already stored on the banner (only relevant on edit)
            $existingImageCount = 0;
            if ($banner) {
                $existingImageCount = collect(['image_1', 'image_2', 'image_3'])
                    ->filter(fn ($field) => !empty($banner->{$field}))
                    ->count();
            }

            $totalImages = $newImageCount + $existingImageCount;

            // Rule 1: at least 1 image required (new or existing)
            if ($totalImages < 1) {
                $validator->errors()->add('image_1', 'Please upload at least 1 image (maximum 3 allowed).');
            }

            // Rule 2: video required ONLY if no images exist at all
            $hasNewVideo = $this->hasFile('video');
            $hasExistingVideo = $banner && !empty($banner->video);

            if ($totalImages < 1 && !$hasNewVideo && !$hasExistingVideo) {
                $validator->errors()->add('video', 'Since no images were uploaded, a video is required.');
            }
        });
    }
}
