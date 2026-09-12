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
            'client_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image'       => $this->isMethod('post')
                                ? 'required|image|mimes:jpeg,jpg,png,webp|max:10240'
                                : 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }

    public function messages(): array
    {
        return [
            'client_name.required' => 'Please enter the client name.',
            'client_name.max'      => 'Client name must not exceed 255 characters.',

            'description.required' => 'Please enter a project description.',
            'description.max'      => 'Description must not exceed 1000 characters.',

            'image.required' => 'Please upload a project image.',
            'image.image'    => 'File must be a valid image.',
            'image.mimes'    => 'Image must be JPG, PNG, or WEBP.',
            'image.max'      => 'Image must not exceed 10MB.',
        ];
    }
}