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
        $contactBanner = $this->route('contact_banner') ?? \App\Models\ContactBanner::first();

        return [
            'title'         => 'required|string|max:80',
            'company_name'  => 'required|string|max:50',
            'description'   => 'required|string|max:700',
            'image'         => ($contactBanner && $contactBanner->image)
                                    ? 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240'
                                    : 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
            'address'       => 'required|string|max:150',
            'phone'         => 'required|string|max:20',
            'email'         => 'required|email|max:40',
            'working_hours' => 'required|string|max:50',

            'admin_phone'      => 'nullable|string|max:20',
            'admin_email'      => 'nullable|email|max:40',
            'qa_qc_phone'      => 'nullable|string|max:20',
            'qa_qc_email'      => 'nullable|email|max:40',
            'operations_phone' => 'nullable|string|max:20',
            'operations_email' => 'nullable|email|max:40',
            'sales_phone'      => 'nullable|string|max:50',
            'sales_email'      => 'nullable|email|max:40',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title.',

            'company_name.required' => 'Please enter the company name.',
            'company_name.max'      => 'Company name must not exceed 50 characters.',

            'description.required' => 'Please enter a description.',
            'description.max'      => 'Description must not exceed 700 characters.',

            'image.required' => 'Please upload an image.',
            'image.image'    => 'File must be a valid image.',
            'image.mimes'    => 'Image must be JPG, PNG, or WEBP.',
            'image.max'      => 'Image must not exceed 10MB.',
        ];
    }
}