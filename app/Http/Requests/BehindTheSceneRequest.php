<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BehindTheSceneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'service_id'  => 'required|exists:services,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'media_type'  => 'required|in:video,video_url,image',
        ];

        // Only the selected media type is required; others are ignored
        switch ($this->input('media_type')) {
            case 'video':
                $rules['video'] = $this->isMethod('post') && !$this->route('behind_the_scene')
                    ? 'required|file|mimes:mp4,mov,avi,wmv|max:51200'
                    : 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200';
                break;

            case 'video_url':
                $rules['video_url'] = 'required|url|max:500';
                break;

            case 'image':
                $rules['image'] = $this->isMethod('post') && !$this->route('behind_the_scene')
                    ? 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
                    : 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
                break;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'video.required'     => 'Please upload a video.',
            'video_url.required' => 'Please enter a video URL.',
            'image.required'     => 'Please upload an image.',
        ];
    }
}