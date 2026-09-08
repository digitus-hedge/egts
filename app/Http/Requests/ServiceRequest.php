<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    // public function rules(): array
    // {
    //     return [
    //         'title'                     => 'required|string|max:255',
    //         'description'               => 'required|string|max:500',
    //         'process_description'       => 'required|string',
    //         'technical_scope'           => 'required|array',
    //         'technical_scope.*'         => 'required|string|max:255',
    //         'specifications'            => 'required|array',
    //         'specifications.*.specification' => 'required|string|max:255',
    //         'specifications.*.details'       => 'required|string|max:255',
    //         'specifications.*.compliance'    => 'required|string|max:100',
    //         'image'                         => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
    //         'banner_image'                  => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
    //         'meta_title'                    => 'nullable|string|max:70',
    //         'meta_description'              => 'nullable|string|max:500',
    //         'gallery'                   => 'required|array|max:6',
    //         'gallery.*'                 => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
    //         'remove_gallery'            => 'nullable|array',
    //         'remove_gallery.*'          => 'string',
    //         'sort_order'                => 'nullable|integer|min:0',
    //         'status'                    => 'nullable|boolean',
    //     ];
    // }



    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

        return [
            'title'                     => 'required|string|max:255',
            'description'               => 'required|string|max:500',
            'process_description'       => 'required|string',

            'technical_scope'           => 'required|array|min:1',
            'technical_scope.*'         => 'required|string|max:255',

            'specifications'                 => 'required|array|min:1',
            'specifications.*.specification' => 'required|string|max:255',
            'specifications.*.details'       => 'required|string|max:255',
            'specifications.*.compliance'    => 'required|string|max:100',

            // no longer conditionally required here — enforced in withValidator() instead,
            // so mime/size rules still apply whenever a file IS submitted
            'image'        => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',

            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',

            'gallery'          => [$isUpdate ? 'nullable' : 'required', 'array', 'max:6'],
            'gallery.*'        => 'image|mimes:jpeg,jpg,png,webp|max:2048',

            'remove_gallery'   => 'nullable|array',
            'remove_gallery.*' => 'string',

            'sort_order'       => 'nullable|integer|min:0',
            'status'           => 'nullable|boolean',
        ];
    }

    /**
     * Additional validation: make sure the FINAL gallery count
     * (existing images minus removed ones, plus newly uploaded ones)
     * never exceeds 6 — the plain `max:6` rule above only limits
     * the newly uploaded files, not the combined total.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $service = $this->route('service'); // null on create, Service model on update

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

            // ===== Hero image: must exist either as upload or already saved =====
            $hasExistingImage = $service && $service->image;
            $hasNewImageUpload = $this->hasFile('image');

            if (!$hasExistingImage && !$hasNewImageUpload) {
                $validator->errors()->add('image', 'The hero/card image field is required.');
            }

            // ===== Banner image: must exist either as upload or already saved =====
            $hasExistingBanner = $service && $service->banner_image;
            $hasNewBannerUpload = $this->hasFile('banner_image');

            if (!$hasExistingBanner && !$hasNewBannerUpload) {
                $validator->errors()->add('banner_image', 'The banner image field is required.');
            }
        });
    }
}
