<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\LicenseBanner;

class LicenseBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $hasExistingImage = LicenseBanner::first()?->image;

        return [
            'title'       => 'required|string|max:45',
            'description' => 'required|string|max:300',
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
            'image.required' => 'Please upload an image.',
            'image.image'    => 'File must be a valid image.',
            'image.mimes'    => 'Image must be JPG, PNG, or WEBP.',
            'image.max'      => 'Image must not exceed 2MB.',
        ];
    }
}