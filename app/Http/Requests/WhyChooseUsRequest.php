<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhyChooseUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $why = \App\Models\WhyChooseUs::first();

        return [
            'heading'                => 'required|string|max:65',
            'description'            => 'required|string|max:650',

            // 'mission_title'          => 'required|string|max:100',
            // 'mission_description'    => 'required|string|max:1000',
            // // Image is required on initial upload, nullable on updates if image already exists
            // 'mission_image'          => ($why && $why->mission_image ? 'nullable' : 'required') . '|image|mimes:jpeg,jpg,png,webp|max:2048',

            // 'vision_title'           => 'required|string|max:100',
            // 'vision_description'     => 'required|string|max:1000',
            // 'vision_image'           => ($why && $why->vision_image ? 'nullable' : 'required') . '|image|mimes:jpeg,jpg,png,webp|max:2048',

            // 'values_title'           => 'required|string|max:100',
            // 'values_description'     => 'required|string|max:1000',
            // 'values_image'           => ($why && $why->values_image ? 'nullable' : 'required') . '|image|mimes:jpeg,jpg,png,webp|max:2048',

            // 'commitment_title'       => 'required|string|max:100',
            // 'commitment_description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'heading.required'                => 'Please enter a heading.',
            'description.required'            => 'Please enter a description.',

            // 'mission_title.required'          => 'Mission title is required.',
            // 'mission_description.required'    => 'Mission description is required.',
            // 'mission_image.required'          => 'Mission background image is required.',

            // 'vision_title.required'           => 'Vision title is required.',
            // 'vision_description.required'     => 'Vision description is required.',
            // 'vision_image.required'           => 'Vision background image is required.',

            // 'values_title.required'           => 'Core Values title is required.',
            // 'values_description.required'     => 'Core Values description is required.',
            // 'values_image.required'           => 'Core Values background image is required.',

            // 'commitment_title.required'       => 'Commitment title is required.',
            // 'commitment_description.required' => 'Commitment description is required.',

            // '*.image'                         => 'File must be a valid image file.',
            // '*.mimes'                         => 'Images must be in JPG, PNG, or WEBP format.',
            // '*.max'                           => 'Image size must not exceed 2MB.',
        ];
    }
}