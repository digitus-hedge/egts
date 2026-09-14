<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenseBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image'       => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'File must be a valid image.',
            'image.mimes' => 'Image must be JPG, PNG, or WEBP.',
            'image.max'   => 'Image must not exceed 2MB.',
        ];
    }
}
