<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:2|max:255',
            'email'     => 'required|email:rfc,dns|max:255',
            'phone'     => 'nullable|string|regex:/^[0-9+\-\s()]{7,20}$/',
            'subject'   => 'required|string|min:3|max:255',
            'message'   => 'required|string|min:5|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Please enter your full name.',
            'full_name.min'      => 'Your name must be at least 2 characters.',

            'email.required'     => 'Please enter your email address.',
            'email.email'        => 'Please enter a valid email address.',

            'phone.regex'        => 'Please enter a valid phone number.',

            'subject.required'   => 'Please enter a subject.',
            'subject.min'        => 'Subject must be at least 3 characters.',

            'message.required'   => 'Please enter your message.',
            'message.min'        => 'Your message must be at least 5 characters.',
        ];
    }
}
