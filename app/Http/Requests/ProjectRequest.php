<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            
            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a project title.',
            'image.image'    => 'File must be a valid image.',
            'image.mimes'    => 'Image must be JPG, PNG, or WEBP.',
            'image.max'      => 'Image must not exceed 2MB.',
        ];
    }
}
