<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacilityBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'banner_image'       => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_title'       => 'required|string|max:255',
            'banner_description' => 'required|string|max:1000',

            'operations_heading'     => 'required|string|max:255',
            'operations_description' => 'required|string|max:2000',

            'infrastructure_title'       => 'required|string|max:255',
            'infrastructure_description' => 'required|string',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }
}
