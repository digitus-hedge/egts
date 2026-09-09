<?php

namespace App\Http\Requests;

use App\Models\ServiceBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ServiceBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Mandatory fields
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'], // 10MB

            // Optional (not mandatory) fields
            'meta_title'       => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
        ];
    }

    /**
     * Custom messages for clarity.
     */
    public function messages(): array
    {
        return [
            'title.required'       => 'The title field is required.',
            'description.required' => 'The short description field is required.',
            'image.required'       => 'Please upload an image.',
        ];
    }

    /**
     * Image is only strictly required when creating the banner for the first time.
     * On update, an existing image is fine if no new file is uploaded.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $exists = ServiceBanner::query()->exists();

            if (!$exists && !$this->hasFile('image')) {
                $validator->errors()->add('image', 'The image field is required.');
            }
        });
    }
}