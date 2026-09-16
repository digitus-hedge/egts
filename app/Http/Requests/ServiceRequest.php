<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

        return [
            'title'                     => 'required|string|max:45',
            'description'               => 'required|string|max:100',
            'process_description'       => 'required|string|max:400',

            'technical_scope'           => 'required|array|min:1',
            'technical_scope.*'         => 'required|string|max:100',

            'specifications'                 => 'required|array|min:1',
            'specifications.*.specification' => 'required|string|max:35',
            'specifications.*.details'       => 'required|string|max:100',
            'specifications.*.compliance'    => 'required|string|max:30',

            'image'        => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'banner_video' => 'nullable|mimes:mp4,mov,webm|max:20480',

            'remove_banner_image' => 'nullable|boolean',
            'remove_banner_video' => 'nullable|boolean',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',

            'gallery'          => [$isUpdate ? 'nullable' : 'required', 'array', 'max:6'],
            'gallery.*'        => 'image|mimes:jpeg,jpg,png,webp|max:10240',

            'remove_gallery'   => 'nullable|array',
            'remove_gallery.*' => 'string',

            // ===== Inspection Process: heading + description mandatory per row =====
            // Image mandatory too, but enforced in withValidator() below since it
            // must accept EITHER a new upload OR an existing saved image (on update).
            'inspection_process'                 => 'required|array|min:1',
            'inspection_process.*.heading'       => 'required|string|max:40',
            'inspection_process.*.description'   => 'required|string|max:500',
            'inspection_process.*.image'         => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'inspection_process.*.existing_image' => 'nullable|string',

            'sort_order'       => 'nullable|integer|min:0',
            'status'           => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a service title.',
            'title.max'      => 'Title must not exceed 45 characters.',

            'description.required' => 'Please enter a short description.',
            'description.max'      => 'Description must not exceed 100 characters.',

            'process_description.required' => 'Please enter a process description.',
            'process_description.max'      => 'Process description must not exceed 400 characters.',

            'technical_scope.required' => 'Please add at least one technical scope point.',
            'technical_scope.min'      => 'Please add at least one technical scope point.',
            'technical_scope.*.required' => 'This technical scope point cannot be empty.',
            'technical_scope.*.max'      => 'Each technical scope point must not exceed 100 characters.',

            'specifications.required' => 'Please add at least one specification row.',
            'specifications.min'      => 'Please add at least one specification row.',
            'specifications.*.specification.required' => 'Specification is required for this row.',
            'specifications.*.specification.max'      => 'Specification must not exceed 35 characters.',
            'specifications.*.details.required' => 'Details is required for this row.',
            'specifications.*.details.max'      => 'Details must not exceed 100 characters.',
            'specifications.*.compliance.required' => 'Compliance is required for this row.',
            'specifications.*.compliance.max'      => 'Compliance must not exceed 30 characters.',

            'image.image' => 'The hero/card image must be a valid image.',
            'image.mimes' => 'The hero/card image must be a JPG, PNG, or WEBP file.',
            'image.max'   => 'The hero/card image must not exceed 10MB.',

            'banner_image.image' => 'The banner image must be a valid image.',
            'banner_image.mimes' => 'The banner image must be a JPG, PNG, or WEBP file.',
            'banner_image.max'   => 'The banner image must not exceed 10MB.',

            'banner_video.mimes' => 'The banner video must be an MP4, MOV, or WEBM file.',
            'banner_video.max'   => 'The banner video must not exceed 20MB.',

            'meta_title.max'       => 'Meta title must not exceed 60 characters.',
            'meta_description.max' => 'Meta description must not exceed 160 characters.',

            'gallery.required' => 'Please upload at least one gallery image.',
            'gallery.array'    => 'Gallery images were not submitted correctly.',
            'gallery.max'      => 'You can upload a maximum of 6 gallery images.',
            'gallery.*.image'  => 'Each gallery file must be a valid image.',
            'gallery.*.mimes'  => 'Each gallery image must be a JPG, PNG, or WEBP file.',
            'gallery.*.max'    => 'Each gallery image must not exceed 10MB.',

            'inspection_process.required' => 'Please add at least one inspection process step.',
            'inspection_process.min'      => 'Please add at least one inspection process step.',
            'inspection_process.*.heading.required'     => 'Heading is required for this inspection step.',
            'inspection_process.*.heading.max'          => 'Heading must not exceed 40 characters.',
            'inspection_process.*.description.required' => 'Description is required for this inspection step.',
            'inspection_process.*.description.max'      => 'Description must not exceed 500 characters.',
            'inspection_process.*.image.image' => 'The inspection step image must be a valid image.',
            'inspection_process.*.image.mimes' => 'The inspection step image must be a JPG, PNG, or WEBP file.',
            'inspection_process.*.image.max'   => 'The inspection step image must not exceed 10MB.',

            'sort_order.integer' => 'Sort order must be a whole number.',
            'sort_order.min'     => 'Sort order cannot be negative.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'                 => 'title',
            'description'           => 'short description',
            'process_description'   => 'process description',
            'image'                 => 'hero/card image',
            'banner_image'          => 'banner image',
            'banner_video'          => 'banner video',
            'meta_title'            => 'meta title',
            'meta_description'      => 'meta description',
            'gallery'               => 'gallery',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
        $service = $this->route('service');

        // ===== Gallery: combined total check =====
        $existingGalleryCount = $service ? count($service->gallery ?? []) : 0;
        $removeCount = count($this->input('remove_gallery', []));
        $newGalleryCount = count($this->file('gallery', []));

        $remainingExisting = max(0, $existingGalleryCount - $removeCount);
        $finalGalleryCount = $remainingExisting + $newGalleryCount;

        if ($finalGalleryCount > 6) {
            $validator->errors()->add(
                'gallery',
                "Total gallery images cannot exceed 6. You currently have {$remainingExisting} remaining plus {$newGalleryCount} new (total {$finalGalleryCount})."
            );
        }

        // NEW: require at least 1 gallery image overall, whether create or update
        if ($finalGalleryCount < 1) {
            $validator->errors()->add('gallery', 'Please upload at least one gallery image.');
        }

            // ===== Hero image: must exist either as upload or already saved =====
            $hasExistingImage = $service && $service->image;
            $hasNewImageUpload = $this->hasFile('image');

            if (!$hasExistingImage && !$hasNewImageUpload) {
                $validator->errors()->add('image', 'Please upload a hero/card image.');
            }

            // ===== Banner Image OR Video: exactly one required, not both, not neither =====
            $hasNewBannerImage = $this->hasFile('banner_image');
            $hasNewBannerVideo = $this->hasFile('banner_video');

            $hasExistingBannerImage = $service
                && !empty($service->banner_image)
                && !$this->boolean('remove_banner_image');

            $hasExistingBannerVideo = $service
                && !empty($service->banner_video)
                && !$this->boolean('remove_banner_video');

            $willHaveBannerImage = $hasNewBannerImage || $hasExistingBannerImage;
            $willHaveBannerVideo = $hasNewBannerVideo || $hasExistingBannerVideo;

            if (!$willHaveBannerImage && !$willHaveBannerVideo) {
                $validator->errors()->add('banner_image', 'Please upload either a Banner Image or a Banner Video.');
            }

            if ($willHaveBannerImage && $willHaveBannerVideo) {
                $validator->errors()->add('banner_image', 'Please choose only one — a Banner Image OR a Banner Video, not both.');
            }

            // ===== Inspection Process: each row's image must exist (new upload OR existing kept) =====
            $inspectionRows = $this->input('inspection_process', []);
            $inspectionFiles = $this->file('inspection_process', []);

            foreach ($inspectionRows as $index => $row) {
                $hasNewImage = isset($inspectionFiles[$index]['image']) && $inspectionFiles[$index]['image'] !== null;
                $hasExistingImage = !empty($row['existing_image']);

                if (!$hasNewImage && !$hasExistingImage) {
                    $validator->errors()->add(
                        "inspection_process.$index.image",
                        'An image is required for each inspection process step (row ' . ($index + 1) . ').'
                    );
                }
            }
        });
    }
}