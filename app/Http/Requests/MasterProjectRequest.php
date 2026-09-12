<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterProjectRequest extends FormRequest
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
            'image'       => $this->isMethod('post')
                                ? 'required|image|mimes:jpeg,jpg,png,webp|max:10240'
                                : 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a project title.',
            'title.max'      => 'Title must not exceed 255 characters.',

            'description.required' => 'Please enter a project description.',
            'description.max'      => 'Description must not exceed 1000 characters.',

            'image.required' => 'Please upload a project image.',
            'image.image'    => 'File must be a valid image.',
            'image.mimes'    => 'Image must be JPG, PNG, or WEBP.',
            'image.max'      => 'Image must not exceed 10MB.',
        ];
    }
}