<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Models\ContactBanner;

class ContactBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:80',
            'company_name'  => 'required|string|max:50',
            'description'   => 'required|string|max:700',
            // image / video are never "required" directly here — the after()
            // hook below decides whether at least one is missing.
            'image'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'video'         => 'nullable|mimes:mp4,mov,webm|max:20480',

            'remove_image' => 'nullable|boolean',
            'remove_video' => 'nullable|boolean',

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

            'image.image' => 'File must be a valid image.',
            'image.mimes' => 'Image must be JPG, PNG, or WEBP.',
            'image.max'   => 'Image must not exceed 10MB.',

            'video.mimes' => 'Video must be MP4, MOV, or WEBM.',
            'video.max'   => 'Video must not exceed 20MB.',
        ];
    }

    /**
     * Either a Banner Image or a Banner Video is required — not both, and not neither.
     * Checked against the existing record's saved files, accounting for any
     * new uploads and any removal flags in this request.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $contactBanner = $this->route('contact_banner') ?? ContactBanner::first();

            $hasNewImage = $this->hasFile('image');
            $hasNewVideo = $this->hasFile('video');

            $hasExistingImage = $contactBanner && !empty($contactBanner->image) && !$this->boolean('remove_image');
            $hasExistingVideo = $contactBanner && !empty($contactBanner->video) && !$this->boolean('remove_video');

            $willHaveImage = $hasNewImage || $hasExistingImage;
            $willHaveVideo = $hasNewVideo || $hasExistingVideo;

            if (!$willHaveImage && !$willHaveVideo) {
                $validator->errors()->add('image', 'Please upload either a Banner Image or a Banner Video.');
            }
        });
    }
}