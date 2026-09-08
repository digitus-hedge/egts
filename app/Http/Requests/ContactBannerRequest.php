<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:255',
            'company_name'  => 'nullable|string|max:255',
            'description'   => 'nullable|string|max:1000',
            'image'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'address'       => 'nullable|string|max:255',
            'phone'         => 'nullable|string|max:50',
            'email'         => 'nullable|email|max:255',
            'working_hours' => 'nullable|string|max:255',

            'admin_phone'      => 'nullable|string|max:50',
            'admin_email'      => 'nullable|email|max:255',
            'qaqc_phone'       => 'nullable|string|max:50',
            'qaqc_email'       => 'nullable|email|max:255',
            'operations_phone' => 'nullable|string|max:50',
            'operations_email' => 'nullable|email|max:255',
            'sales_phone'      => 'nullable|string|max:50',
            'sales_email'      => 'nullable|email|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title.',
            'image.image'    => 'File must be a valid image.',
            'image.mimes'    => 'Image must be JPG, PNG, or WEBP.',
            'image.max'      => 'Image must not exceed 2MB.',
        ];
    }
}
