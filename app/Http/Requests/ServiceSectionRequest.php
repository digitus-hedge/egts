<?php
// app/Http/Requests/ServiceSectionRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'label'       => 'nullable|string|max:0',
            'heading'     => 'required|string|max:60',
            'description' => 'required|string|max:600',
        ];
    }
}