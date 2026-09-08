<?php

namespace App\Http\Requests;

use App\Models\Banner;
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
            'title'       => 'required|string|min:3|max:60',
            'description' => 'required|string|max:200',

            'image_1' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'image_2' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'image_3' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'video'   => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
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

             'meta_title.max'       => 'Meta title cannot exceed :max characters.',
            'meta_description.max' => 'Meta description cannot exceed :max characters.',

            'image_1.image'        => 'Image 1 must be a valid image file.',
            'image_2.image'        => 'Image 2 must be a valid image file.',
            'image_3.image'        => 'Image 3 must be a valid image file.',

            'image_1.mimes'        => 'Image 1 must be a JPG, PNG, or WEBP file.',
            'image_2.mimes'        => 'Image 2 must be a JPG, PNG, or WEBP file.',
            'image_3.mimes'        => 'Image 3 must be a JPG, PNG, or WEBP file.',

            'image_1.max'          => 'Image 1 must not exceed 10MB.',
            'image_2.max'          => 'Image 2 must not exceed 10MB.',
            'image_3.max'          => 'Image 3 must not exceed 10MB.',

            'video.mimes'          => 'Video must be a file of type: MP4, MOV, AVI, or WMV.',
            'video.max'            => 'Video must not exceed 20MB.',
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
                      'meta_title'        => 'meta title',
            'meta_description'  => 'meta description',
        ];
    }

    /**
     * Ensures at least one media source remains after taking image/video exclusivity into account.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $banner = Banner::first();

            $hasNewVideo = $this->hasFile('video');
            $hasNewImage = collect(['image_1', 'image_2', 'image_3'])
                ->contains(fn($field) => $this->hasFile($field));

            // If new video uploaded, images will be wiped out
            $hasVideoAfterSave = $hasNewVideo || (! $hasNewImage && $banner && ! empty($banner->video));

            // If new image uploaded, video will be wiped out
            $hasImageAfterSave = $hasNewImage || (! $hasNewVideo && $banner && (
                ! empty($banner->image_1) || ! empty($banner->image_2) || ! empty($banner->image_3)
            ));

            if (! $hasVideoAfterSave && ! $hasImageAfterSave) {
                $validator->errors()->add('image_1', 'Please upload at least one image or a video for the banner.');
                $validator->errors()->add('video', 'Please upload a video or at least one image for the banner.');
            }
        });
    }
}
