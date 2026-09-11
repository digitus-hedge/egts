<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BehindTheSceneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $behindTheScene = $this->route('behind_the_scene'); // adjust param name if different

        return [
            'service_id'  => 'required|exists:services,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:2000',

            'media_type'  => 'required|in:video,video_url,image',

            'video'     => 'nullable|file|mimes:mp4,mov,avi,webm|max:20480', // 20MB
            'video_url' => 'nullable|url|max:500',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240', // 10MB
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'The :attribute is required.',
            'exists'   => 'The selected :attribute is invalid.',
            'in'       => 'Please choose a valid :attribute.',
            'url'      => 'The :attribute must be a valid URL.',
            'mimes'    => 'The :attribute must be a file of type: :values.',
            'max'      => 'The :attribute is too large.',
        ];
    }

    public function attributes(): array
    {
        return [
            'service_id'  => 'Service',
            'title'       => 'Title',
            'description' => 'Description',
            'media_type'  => 'Media Source',
            'video'       => 'Video File',
            'video_url'   => 'Video URL',
            'image'       => 'Image',
        ];
    }

    /**
     * Enforce "exactly one media source, matching the selected media_type" —
     * something plain rules can't express since the required field depends
     * on the value of another field AND on whether an existing file is already saved.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $type = $this->input('media_type');
            $record = $this->route('behind_the_scene'); // existing model on update, null on create

            if (!$type) {
                return; // 'media_type required' rule already covers this
            }

            $fieldMap = [
                'video'     => 'video',
                'video_url' => 'video_url',
                'image'     => 'image',
            ];

            $expectedField = $fieldMap[$type] ?? null;

            if (!$expectedField) {
                return;
            }

            $hasNewFile = $expectedField === 'video_url'
                ? $this->filled('video_url')
                : $this->hasFile($expectedField);

            $hasExisting = $record && !empty($record->{$expectedField});

            if (!$hasNewFile && !$hasExisting) {
                $label = match ($expectedField) {
                    'video'     => 'a video file',
                    'video_url' => 'a video URL',
                    'image'     => 'an image',
                    default     => 'media',
                };
                $validator->errors()->add($expectedField, "Please provide {$label} for the selected media type.");
            }
        });
    }
}