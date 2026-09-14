<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $machine = $this->route('machine');

        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image'       => ($machine && $machine->image)
                                ? 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240'
                                : 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a machine title.',
            'description.required' => 'Please enter a description.',
            'image.required' => 'Please upload a machine image.',
            'image.image'    => 'File must be a valid image.',
            'image.mimes'    => 'Image must be JPG, PNG, or WEBP.',
            'image.max'      => 'Image must not exceed 10MB.',
        ];
    }
}