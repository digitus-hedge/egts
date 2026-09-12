<?php

namespace App\Http\Requests;

use App\Models\Certificate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CertificateRequest extends FormRequest
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
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title.',
            'title.max'      => 'Title must not exceed 255 characters.',

            'description.required' => 'Please enter a description.',
            'description.max'      => 'Description must not exceed 1000 characters.',

            'image.image' => 'File must be a valid image.',
            'image.mimes' => 'Image must be JPG, PNG, or WEBP.',
            'image.max'   => 'Image must not exceed 10MB.',
        ];
    }

    /**
     * Require an image only if there's no existing one already saved
     * for the certificate being edited (or none at all, on create).
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            // Adjust 'certificate' to match your actual route parameter name
            $existing = $this->route('certificate');

            $hasNewImage = $this->hasFile('image');
            $hasExistingImage = $existing && ! empty($existing->image);

            if (! $hasNewImage && ! $hasExistingImage) {
                $validator->errors()->add('image', 'Please upload an image.');
            }
        });
    }
}