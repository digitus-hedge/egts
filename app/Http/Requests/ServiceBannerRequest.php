<?php

namespace App\Http\Requests;

use App\Models\ServiceBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ServiceBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],

            'meta_title'       => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute is required.',
            'image'    => 'The :attribute must be a valid image (JPG, PNG, or WEBP).',
            'mimes'    => 'The :attribute must be a file of type: :values.',
            'max'      => 'The :attribute is too large.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'             => 'Title',
            'description'       => 'Short Description',
            'image'             => 'Image',
            'meta_title'        => 'Meta Title',
            'meta_description'  => 'Meta Description',
        ];
    }

    /**
     * Image is required only if THIS specific banner record has no image yet —
     * not merely "does any row exist in the table."
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $banner = ServiceBanner::first(); // singleton row, adjust if you key by id

            $hasNewImage = $this->hasFile('image');
            $hasExistingImage = $banner && !empty($banner->image);

            if (!$hasNewImage && !$hasExistingImage) {
                $validator->errors()->add('image', 'Please upload an image.');
            }
        });
    }
}