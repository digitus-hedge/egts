<?php

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
            'items'               => 'required|array|min:1|max:5',
            'items.*.value'       => 'required|string|max:10',
            'items.*.label'       => 'required|string|max:20',
            'items.*.description' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Please add at least 1 stat item.',
            'items.min'      => 'Please add at least 1 stat item.',
            'items.max'      => 'You can add a maximum of 5 stats.',

            'items.*.value.required' => 'The value field is required for item #:position.',
            'items.*.value.max'      => 'The value cannot exceed 8 characters for item #:position.',

            'items.*.label.required' => 'The label field is required for item #:position.',
            'items.*.label.max'      => 'The label cannot exceed 20 characters for item #:position.',

            'items.*.description.required' => 'The description field is required for item #:position.',
            'items.*.description.max'      => 'The description cannot exceed 20 characters for item #:position.',
        ];
    }

    public function attributes(): array
    {
        return [
            'items.*.value'       => 'value',
            'items.*.label'       => 'label',
            'items.*.description' => 'description',
        ];
    }
}