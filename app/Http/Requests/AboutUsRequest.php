<?php

namespace App\Http\Requests;

use App\Models\AboutUs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AboutUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'banner_heading'     => 'required|string|max:255',
            'banner_description' => 'required|string',
            'banner_image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'about_heading'     => 'required|string|max:255',
            'about_description' => 'required|string',
            'section_two_image_one'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'section_two_image_two'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'mission_title'            => 'required|string|max:255',
            'mission_description'      => 'required|string|max:2000',
            'mission_description_rich' => 'required|string',
            'mission_image'            => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'vision_title'             => 'required|string|max:255',
            'vision_description'       => 'required|string|max:2000',
            'vision_description_rich'  => 'required|string',
            'vision_image'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'values_title'             => 'required|string|max:255',
            'values_description'       => 'required|string|max:2000',
            'values_description_rich'  => 'required|string',
            'values_image'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'commitment_title'             => 'required|string|max:255',
            'commitment_description'       => 'required|string|max:2000',
            'commitment_description_rich'  => 'required|string',
            'commitment_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            'foundation_heading'     => 'required|string|max:255',
            'foundation_description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'This field is required.',
        ];
    }

    /**
     * Each singleton image is required only the first time (no existing row/image yet).
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $about = AboutUs::first();

            $imageFields = [
                'banner_image',
                'section_two_image_one',
                'section_two_image_two',
                'mission_image',
                'vision_image',
                'values_image',
                'commitment_image'
            ];

            foreach ($imageFields as $field) {
                $hasNew = $this->hasFile($field);
                $hasExisting = $about && !empty($about->{$field});

                if (!$hasNew && !$hasExisting) {
                    $validator->errors()->add($field, 'Please upload an image for this section.');
                }
            }
        });
    }
}