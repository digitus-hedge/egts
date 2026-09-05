<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'images.*'    => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Please enter a title.',
            'images.*.image'   => 'Each file must be a valid image.',
            'images.*.mimes'   => 'Images must be JPG, PNG, or WEBP.',
            'images.*.max'     => 'Each image must not exceed 2MB.',
        ];
    }
}
