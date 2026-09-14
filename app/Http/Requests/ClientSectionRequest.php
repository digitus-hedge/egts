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
            'description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Please enter a title.',
            'title.max'            => 'Title cannot exceed 255 characters.',

            'description.required' => 'Please enter a description.',
            'description.max'      => 'Description cannot exceed 1000 characters.',
        ];
    }
}
