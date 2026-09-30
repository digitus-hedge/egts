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
            'title'       => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
            'license_type' => 'required|in:API License,Premium License,ISO License',
                 'image'        => 'nullable|file|mimes:pdf,doc,docx|max:10240',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title.',
            'title.max'      => 'Title must not exceed 50 characters.',

            // 'description.required' => 'Please enter a description.',
            'description.max'      => 'Description must not exceed 1000 characters.',

           'image.file'     => 'Please upload a valid file.',
        'image.mimes'    => 'Certificate must be a PDF, DOC or DOCX file.',
        'image.max'      => 'Certificate file must not exceed 10MB.',
        'image.uploaded' => 'The file failed to upload. It may be larger than the server limit.',

            'license_type.required' => 'Please select a license type.',
            'license_type.in' => 'Please select a valid license type.',
        ];
    }

    /**
     * Require an image only if there's no existing one already saved
     * for the certificate being edited (or none at all, on create).
     */
    public function withValidator(Validator $validator): void
    {
         $validator->after(function (Validator $validator) {
        $existing = $this->route('certificate');

        $hasNewFile      = $this->hasFile('image');
        $removedExisting = $this->input('remove_image') === '1';
        $hasExistingFile = $existing && ! empty($existing->image) && ! $removedExisting;

        if (! $hasNewFile && ! $hasExistingFile) {
            $validator->errors()->add('image', 'Please upload a certificate file (PDF, DOC or DOCX).');
        }
    });
    }
}
