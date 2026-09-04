<?php
// app/Http/Requests/ServiceRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:150',
            'description' => 'required|string|max:500',
            'content'     => 'nullable|string',
            'image'       => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048',
            ],
            'sort_order'  => 'nullable|integer|min:0',
            'status'      => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Please upload an image for this service.',
        ];
    }
}