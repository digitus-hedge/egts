<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tool = $this->route('tool'); // adjust name to match your route parameter
        $hasExistingImage = $tool?->image;

        return [
            'title'       => 'required|string|max:40',
            'description' => 'required|string|max:200',
            'image'       => [
                $hasExistingImage ? 'nullable' : 'required',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:10240',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Please enter a tool title.',
            'description.required' => 'Please enter a tool description.',
            'image.required'       => 'Please upload a tool image.',
            'image.image'          => 'File must be a valid image.',
            'image.mimes'          => 'Image must be JPG, PNG, or WEBP.',
            'image.max'            => 'Image must not exceed 10MB.',
        ];
    }
}