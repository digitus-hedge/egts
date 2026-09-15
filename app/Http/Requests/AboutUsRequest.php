<?php

namespace App\Http\Requests;

use App\Models\AboutUs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AboutUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',

            'banner_heading'     => 'required|string|max:80',
            'banner_description' => 'required|string|max:400',
            // 'banner_image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',


                  'banner_image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
        'banner_video'       => 'nullable|mimes:mp4,mov,webm|max:20480',
        'remove_banner_video' => 'nullable|boolean',


            'about_heading'         => 'required|string|max:65',
            'about_description'     => 'required|string|max:800',
            'section_two_image_one' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'section_two_image_two' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'mission_title'            => 'required|string|max:45',
            'mission_description'      => 'required|string|max:200',
            'mission_description_rich' => 'required|string|max:500',
            'mission_image'            => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'vision_title'             => 'required|string|max:45',
            'vision_description'       => 'required|string|max:200',
            'vision_description_rich'  => 'required|string|max:500',
            'vision_image'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'values_title'             => 'required|string|max:45',
            'values_description'       => 'required|string|max:200',
            'values_description_rich'  => 'required|string|max:500',
            'values_image'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'commitment_title'            => 'required|string|max:45',
            'commitment_description'      => 'required|string|max:200',
            'commitment_description_rich' => 'required|string|max:500',
            'commitment_image'            => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'foundation_heading'     => 'required|string|max:50',
            'foundation_description' => 'required|string|max:100',
        ];
    }

    /**
     * Global per-rule messages. ":attribute" is auto-filled from attributes() below.
     */
    public function messages(): array
    {
        return [
            'required' => 'The :attribute is required.',
            'string'   => 'The :attribute must be plain text.',
            'max'      => 'The :attribute :max is too long.',
            'image'    => 'The :attribute must be a valid image (JPG, PNG, or WEBP).',
            'mimes'    => 'The :attribute must be a file of type: :values.',
        ];
    }

    /**
     * Human-readable field names used in place of raw field keys inside messages.
     */
    public function attributes(): array
    {
        return [
            'meta_title'                   => 'Meta Title',
            'meta_description'             => 'Meta Description',

            'banner_heading'               => 'Banner Heading',
            'banner_description'           => 'Banner Description',
            'banner_image'                 => 'Banner Image',

            'about_heading'                => 'About Heading',
            'about_description'            => 'About Description',
            'section_two_image_one'        => 'About Image One',
            'section_two_image_two'        => 'About Image Two',

            'mission_title'                => 'Mission Title',
            'mission_description'          => 'Mission Description',
            'mission_description_rich'     => 'Mission Rich Description',
            'mission_image'                => 'Mission Image',

            'vision_title'                 => 'Vision Title',
            'vision_description'           => 'Vision Description',
            'vision_description_rich'      => 'Vision Rich Description',
            'vision_image'                 => 'Vision Image',

            'banner_video' => 'Banner Video',

            'values_title'                 => 'Core Values Title',
            'values_description'           => 'Core Values Description',
            'values_description_rich'      => 'Core Values Rich Description',
            'values_image'                 => 'Core Values Image',

            'commitment_title'             => 'Commitment Title',
            'commitment_description'       => 'Commitment Description',
            'commitment_description_rich'  => 'Commitment Rich Description',
            'commitment_image'             => 'Commitment Image',

            'foundation_heading'           => 'Foundation Heading',
            'foundation_description'       => 'Foundation Description',
        ];
    }

    /**
     * Extra checks that plain rule strings can't express:
     * - Each singleton image is required only if there's no existing image yet.
     * - Rich-text fields must have real content, not just empty editor markup.
     */
   public function withValidator(Validator $validator): void
{
    $validator->after(function (Validator $validator) {
        $about = AboutUs::first();

        // ----- 1. Banner: image OR video required (not both) -----
        $hasNewImage = $this->hasFile('banner_image');
        $hasNewVideo = $this->hasFile('banner_video');
        $hasExistingImage = $about && !empty($about->banner_image) && !$this->boolean('remove_banner_image');
        $hasExistingVideo = $about && !empty($about->banner_video) && !$this->boolean('remove_banner_video');

        $willHaveImage = $hasNewImage || $hasExistingImage;
        $willHaveVideo = $hasNewVideo || $hasExistingVideo;

        if (!$willHaveImage && !$willHaveVideo) {
            $validator->errors()->add('banner_image', 'Please upload either a Banner Image or a Banner Video.');
        }

        // ----- 2. Conditional image requirement (unchanged, minus banner_image) -----
        $imageFields = [
            'section_two_image_one',
            'section_two_image_two',
            'mission_image',
            'vision_image',
            'values_image',
            'commitment_image',
        ];

        foreach ($imageFields as $field) {
            $hasNew = $this->hasFile($field);
            $hasExisting = $about && !empty($about->{$field});

            if (!$hasNew && !$hasExisting) {
                $label = $this->attributes()[$field] ?? str_replace('_', ' ', $field);
                $validator->errors()->add($field, "Please upload an image for {$label}.");
            }
        }

        // ----- 3. Rich text (unchanged) -----
        $richTextFields = [
            'mission_description_rich',
            'vision_description_rich',
            'values_description_rich',
            'commitment_description_rich',
        ];

        foreach ($richTextFields as $field) {
            $raw = $this->input($field, '');
            $stripped = trim(strip_tags($raw));

            if ($stripped === '') {
                $label = $this->attributes()[$field] ?? str_replace('_', ' ', $field);
                $validator->errors()->add($field, "{$label} cannot be empty.");
            }
        }
    });
}
}