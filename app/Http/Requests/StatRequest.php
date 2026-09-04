<?php
// app/Http/Requests/StatRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'value'       => 'required|string|max:20',
            'label'       => 'required|string|max:50',
            'description' => 'required|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
            'status'      => 'nullable|boolean',
        ];
    }
}