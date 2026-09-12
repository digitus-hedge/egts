<?php

namespace App\Http\Requests;

use App\Models\ProjectsClientsBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ProjectsClientsBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image'        => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'title'        => 'required|string|max:255',
            'content'      => 'required|string|max:1000',
            'description'  => 'required|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'The image must be a JPG, PNG, or WEBP file.',
            'image.max'   => 'The image must not exceed 10MB.',
        ];
    }

    /**
     * Require an image only if there's no existing one already saved.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $existing = ProjectsClientsBanner::first();

            $hasNewImage = $this->hasFile('image');
            $hasExistingImage = $existing && ! empty($existing->image);

            if (! $hasNewImage && ! $hasExistingImage) {
                $validator->errors()->add('image', 'Please upload an image.');
            }
        });
    }
}