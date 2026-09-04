<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeAboutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|min:3|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Please enter a title.',
            'title.min'            => 'Title must be at least :min characters.',
            'title.max'            => 'Title cannot exceed :max characters.',

            'description.required' => 'Please enter a description.',

            'image.image'          => 'The file must be a valid image.',
            'image.mimes'          => 'Image must be a JPG, PNG, or WEBP file.',
            'image.max'            => 'Image must not exceed 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'       => 'title',
            'description' => 'description',
            'image'       => 'image',
        ];
    }

    /**
     * Image required only if there's no existing image already saved (edit mode).
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $about = $this->route('home_about');

            $hasNewImage = $this->hasFile('image');
            $hasExistingImage = $about && !empty($about->image);

            if (!$hasNewImage && !$hasExistingImage) {
                $validator->errors()->add('image', 'Please upload an image.');
            }
        });
    }
}