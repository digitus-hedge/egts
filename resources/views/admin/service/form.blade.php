@extends('admin.layout')
@section('title', $service->exists ? 'Edit Service' : 'Add Service')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->any())
<div class="notice caution" style="margin-bottom:20px;">
    <i class="bi bi-exclamation-triangle" style="font-size:15px;flex-shrink:0;margin-top:1px;"></i>
    <p>Please fix the highlighted fields below before submitting.</p>
</div>
@endif

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: @json(session('success')),
            confirmButtonColor: '#EF7B2E',
            timer: 2500,
            timerProgressBar: true
        });
    });
</script>
@endif

<div class="wrap">
    <div class="crumbs">
        <span onclick="window.location='{{ route('admin.home.services') }}'">Service Cards</span>
        <span>&rsaquo;</span>
        <b>{{ $service->exists ? 'Edit Service' : 'Add Service' }}</b>
    </div>

    <div class="header">
        <div>
            <h1>{{ $service->exists ? 'Edit Service' : 'Add Service' }}</h1>
            <p>Everything shown for this service card on the homepage and its detail page.</p>
        </div>
        <a href="{{ route('admin.home.services') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to list
        </a>
    </div>

    <form action="{{ $service->exists ? route('admin.home.services.update', $service->id) : route('admin.home.services.store') }}"
          method="POST" enctype="multipart/form-data" id="serviceForm">
        @csrf
        @if ($service->exists)
            @method('PUT')
        @endif

        {{-- Title + Show on Home --}}
        <div class="card">
            <div class="two-col">
                <div class="field" style="margin-bottom:0;">
                    <div class="field-top">
                        <label class="field-label">Title <span class="req">*</span></label>
                    </div>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}"
                           class="{{ $errors->has('title') ? 'input-error' : '' }}"
                           placeholder="e.g. API Threading Services">
                    @error('title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="toggle-field">
                    <div class="field-top">
                        <label class="field-label">Show on Home Page</label>
                    </div>
                    <label class="switch-toggle">
                        <input type="checkbox" name="show_on_home" value="1"
                               {{ old('show_on_home', $service->show_on_home) ? 'checked' : '' }}>
                        <span class="switch-slider"></span>
                    </label>
                    <span class="field-hint" style="display:block; margin-top:6px;">Enable to display this service on the homepage.</span>
                    @error('show_on_home')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Short Description --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-card-text"></i></span> Short Description<span class="req">*</span></h2>
            </div>
            <p class="section-sub" style="margin:0 0 16px;">Shown on the homepage card and listing page under the title.</p>
            <div class="field" style="margin-bottom:0;">
                <textarea name="description" rows="3"
                          class="{{ $errors->has('description') ? 'input-error' : '' }}"
                          placeholder="e.g. API threading and machining solutions for critical oilfield connections.">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Banner Image --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-image"></i></span> Banner Image<span class="req">*</span></h2>
            </div>
            <div class="notice caution">
                <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                <p><b>Recommended size:</b> {{ $imageWidth ?? 1200 }} &times; {{ $imageHeight ?? 600 }}px &middot; JPG, PNG, WEBP &middot; up to 10MB.</p>
            </div>

            <div class="image-slot" style="max-width:340px;">
                <div class="drop img-slot {{ $service->banner_image ? 'filled' : '' }}" data-file-input="file-banner-image" onclick="handleDropClick(this)">
                    @if ($service->banner_image)
                        <img src="{{ Storage::url($service->banner_image) }}" id="preview-banner-image" alt="Banner image">
                        <button type="button" class="remove-img-btn" onclick="removeUploadedImage(event, this, 'banner_image', 'preview-banner-image')" title="Remove image">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                    @else
                        <div class="preview-placeholder" id="preview-banner-image">
                            <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                            <div class="drop-title">Click to upload</div>
                            <div class="drop-sub">or drag &amp; drop</div>
                        </div>
                    @endif
                </div>
                <input type="file" id="file-banner-image" name="banner_image" accept="image/*" hidden
                       onchange="previewImage(this,'preview-banner-image')">
                <input type="hidden" name="remove_banner_image" id="remove-banner_image" value="0">
                @if (!$service->banner_image)
                    <button type="button" class="choose-btn" onclick="document.getElementById('file-banner-image').click()">Choose file</button>
                @endif
            </div>
            @error('banner_image')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
        </div>

        {{-- Hero Image --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-image"></i></span> Hero Image <span class="req">*</span></h2>
            </div>
            <p class="section-sub" style="margin:0 0 16px;">Used on listing cards and the service detail page hero.</p>
            <div class="notice caution">
                <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                <p><b>Recommended size:</b> {{ $imageWidth ?? 1100 }} &times; {{ $imageHeight ?? 340 }}px &middot; JPG, PNG, WEBP &middot; up to 10MB.</p>
            </div>

            <div class="image-slot" style="max-width:340px;">
                <div class="drop img-slot {{ $service->image ? 'filled' : '' }}" data-file-input="file-image" onclick="handleDropClick(this)">
                    @if ($service->image)
                        <img src="{{ Storage::url($service->image) }}" id="preview-image" alt="Hero image">
                        <button type="button" class="remove-img-btn" onclick="removeUploadedImage(event, this, 'image', 'preview-image')" title="Remove image">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                    @else
                        <div class="preview-placeholder" id="preview-image">
                            <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                            <div class="drop-title">Click to upload</div>
                            <div class="drop-sub">or drag &amp; drop</div>
                        </div>
                    @endif
                </div>
                <input type="file" id="file-image" name="image" accept="image/*" hidden
                       onchange="previewImage(this,'preview-image')">
                <input type="hidden" name="remove_image" id="remove-image" value="0">
                @if (!$service->image)
                    <button type="button" class="choose-btn" onclick="document.getElementById('file-image').click()">Choose file</button>
                @endif
            </div>
            @error('image')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
        </div>

        {{-- Process Description --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-file-text"></i></span> Process Description<span class="req">*</span></h2>
            </div>
            <p class="section-sub" style="margin:0 0 16px;">Detail page — "Process Description" column under Service Overview.</p>
            <div class="field" style="margin-bottom:0;">
                <textarea name="process_description" rows="5"
                          class="{{ $errors->has('process_description') ? 'input-error' : '' }}"
                          placeholder="Describe the step-by-step process...">{{ old('process_description', $service->process_description) }}</textarea>
                @error('process_description')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Inspection Process --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-clipboard-check"></i></span> Inspection Process<span class="req">*</span></h2>
            </div>
            <p class="section-sub" style="margin:0 0 16px;">Detail page — step-by-step inspection process with heading, description, and image per step.</p>

            <div id="inspectionRows"></div>
            <button type="button" id="addInspectionBtn" class="choose-btn inline">
                <i class="bi bi-plus-circle"></i> Add Row
            </button>

            @error('inspection_process')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
            @if ($errors->has('inspection_process.*.heading') || $errors->has('inspection_process.*.description') || $errors->has('inspection_process.*.image'))
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> Please fill in all required fields for each inspection step.</span>
            @endif
        </div>

        {{-- Technical Scope --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-list-check"></i></span> Technical Scope &amp; Capabilities<span class="req">*</span></h2>
            </div>
            <p class="section-sub" style="margin:0 0 16px;">Detail page — bullet list next to Process Description.</p>

            <div id="scopeRows"></div>
            <button type="button" id="addScopeBtn" class="choose-btn inline">
                <i class="bi bi-plus-circle"></i> Add Point
            </button>

            @error('technical_scope')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
            @error('technical_scope.*')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
        </div>

        {{-- Specifications --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-table"></i></span> Technical Specifications &amp; Features<span class="req">*</span></h2>
            </div>
            <p class="section-sub" style="margin:0 0 16px;">Detail page — Specification / Details / Compliance table.</p>

            <div class="specs-table-header">
                <span>Specification</span>
                <span>Details</span>
                <span>Compliance</span>
                <span></span>
            </div>
            <div id="specRows"></div>
            <button type="button" id="addSpecBtn" class="choose-btn inline">
                <i class="bi bi-plus-circle"></i> Add Row
            </button>

            @error('specifications')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
            @if ($errors->has('specifications.*.specification') || $errors->has('specifications.*.details') || $errors->has('specifications.*.compliance'))
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> Please fill in all Specification, Details, and Compliance fields for each row.</span>
            @endif
        </div>

        {{-- SEO Meta --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-search"></i></span> SEO Meta</h2>
            </div>

            <div class="field">
                <div class="field-top">
                    <label class="field-label">Meta Title</label>
                </div>
                <input type="text" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}"
                       class="{{ $errors->has('meta_title') ? 'input-error' : '' }}"
                       placeholder="SEO title for search engines">
                @error('meta_title')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="field" style="margin-bottom:0;">
                <div class="field-top">
                    <label class="field-label">Meta Description</label>
                </div>
                <textarea name="meta_description" rows="3"
                          class="{{ $errors->has('meta_description') ? 'input-error' : '' }}"
                          placeholder="SEO description shown in search results">{{ old('meta_description', $service->meta_description) }}</textarea>
                @error('meta_description')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Gallery --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-images"></i></span> Gallery <span class="req">*</span> <span class="section-sub" style="margin:0;">(up to 6 images)</span></h2>
            </div>
            <div class="notice caution">
                <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                <p><b>Recommended size:</b> {{ $imageWidth ?? 220 }} &times; {{ $imageHeight ?? 140 }}px &middot; JPG, PNG, WEBP &middot; up to 10MB per image.</p>
            </div>

            @if (!empty($service->gallery))
            <div class="slot-top" style="margin-bottom:8px;">
                <span class="slot-label">Currently saved</span>
            </div>
            <div class="images-row" id="existingGallery" style="margin-bottom:20px;">
                @foreach ($service->gallery as $img)
                    <div class="image-slot" style="flex:0 0 120px; min-width:120px;">
                        <div class="drop filled existing-gallery-item">
                            <img src="{{ Storage::url($img) }}" alt="Gallery image">
                            <label class="remove-img-btn" title="Remove this image">
                                <input type="checkbox" name="remove_gallery[]" value="{{ $img }}" onchange="updateGalleryCount(); toggleGalleryRemoveMark(this)">
                                <i class="bi bi-x-lg"></i>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

            <div class="slot-top" style="margin-bottom:8px;">
                <span class="slot-label">Add new images</span>
            </div>
            <div class="gallery-new" id="newGalleryPreview"></div>

            <label class="choose-btn inline" id="galleryUploadBtn">
                <i class="bi bi-upload"></i> Add gallery images
                <input type="file" name="gallery[]" id="galleryInput" accept="image/*" multiple hidden>
            </label>
            <span class="field-hint" id="galleryFileCount" style="display:inline-block; margin-left:10px;"></span>
            <p class="field-error" id="galleryLimitMsg" style="display:none; margin-top:10px;">
                <i class="bi bi-exclamation-circle"></i> You can upload a maximum of 6 images in total.
            </p>

            @error('gallery')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
            @error('gallery.*')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
        </div>

        <div class="savebar">
            <div class="savebar-inner">
                <span class="savebar-status">All changes save to the live Service Cards page</span>
                <div class="btn-group">
                    <a href="{{ route('admin.home.services') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        {{ $service->exists ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- ===== Templates for dynamic rows ===== --}}
<template id="scopeRowTemplate">
    <div class="scope-row">
        <input type="text" name="technical_scope[]" placeholder="e.g. Thread types: Buttress, LTC, STC">
        <button type="button" class="action-btn delete btn-remove-row" title="Remove"><i class="bi bi-trash3"></i></button>
    </div>
</template>

<template id="specRowTemplate">
    <div class="specs-row">
        <input type="text" name="specifications[__INDEX__][specification]" placeholder="e.g. Thread Form">
        <input type="text" name="specifications[__INDEX__][details]" placeholder="e.g. Buttress thread form">
        <input type="text" name="specifications[__INDEX__][compliance]" placeholder="e.g. API 5B">
        <button type="button" class="action-btn delete btn-remove-row" title="Remove"><i class="bi bi-trash3"></i></button>
    </div>
</template>

<template id="inspectionRowTemplate">
    <div class="inspection-row">
        <button type="button" class="action-btn delete inspection-remove" title="Remove"><i class="bi bi-trash3"></i></button>
        <div class="inspection-row-fields">
            <div class="field">
                <div class="field-top"><label class="field-label">Heading</label></div>
                <input type="text" name="inspection_process[__INDEX__][heading]" placeholder="e.g. Visual Inspection">
            </div>
            <div class="field">
                <div class="field-top"><label class="field-label">Description</label></div>
                <textarea name="inspection_process[__INDEX__][description]" rows="3" placeholder="Describe this inspection step..."></textarea>
            </div>
            <div class="field" style="margin-bottom:0;">
                <div class="field-top"><label class="field-label">Image</label></div>
                <div class="notice caution notice-compact">
                    <i class="bi bi-exclamation-triangle"></i>
                    <p>Recommended size: {{ $imageWidth ?? 552 }}&times;{{ $imageHeight ?? 340 }}px &middot; JPG, PNG, WEBP &middot; up to 10MB.</p>
                </div>
                <div class="drop img-slot inspection-drop" onclick="this.nextElementSibling.click()">
                    <div class="preview-placeholder inspection-preview">
                        <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:16px;"></i></div>
                        <div class="drop-title">Click to upload</div>
                        <div class="drop-sub">or drag &amp; drop</div>
                    </div>
                </div>
                <input type="file" name="inspection_process[__INDEX__][image]" accept="image/*" hidden onchange="previewInspectionImage(this)">
                <input type="hidden" name="inspection_process[__INDEX__][existing_image]" class="existing-image-input" value="">
            </div>
        </div>
    </div>
</template>
@php
    $inspectionForJs = collect(old('inspection_process', $service->inspection_process ?? []))
        ->map(function ($row) {
            if (!empty($row['image'])) {
                $row['image_url'] = Storage::url($row['image']);
            }
            return $row;
        });
@endphp

<script>
    // ===== Drop-zone click + remove (image slots that support server-side removal) =====
    function handleDropClick(el) {
        if (el.classList.contains('filled')) return;
        const inputId = el.getAttribute('data-file-input');
        const input = document.getElementById(inputId);
        if (input) input.click();
    }

    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (!preview) return;

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.id = previewId;
                preview.replaceWith(img);

                const drop = img.closest('.drop');
                if (drop) {
                    drop.classList.add('filled');
                    const chooseBtn = drop.parentElement.querySelector('.choose-btn');
                    if (chooseBtn) chooseBtn.style.display = 'none';

                    const removeInput = drop.parentElement.querySelector('input[type="hidden"][id^="remove-"]');
                    if (removeInput) removeInput.value = '0';

                    if (!drop.querySelector('.remove-img-btn')) {
                        const fieldName = removeInput ? removeInput.id.replace('remove-', '') : null;
                        if (fieldName) {
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = 'remove-img-btn';
                            btn.title = 'Remove image';
                            btn.innerHTML = '<i class="bi bi-x-lg"></i>';
                            btn.onclick = (ev) => removeUploadedImage(ev, btn, fieldName, previewId);
                            drop.appendChild(btn);
                        }
                    }
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeUploadedImage(event, btn, fieldName, previewId) {
        event.stopPropagation();
        const drop = btn.closest('.drop');
        const wrapper = drop.parentElement;
        const fileInput = wrapper.querySelector('input[type="file"]');
        const removeInput = document.getElementById(`remove-${fieldName}`);

        if (removeInput) removeInput.value = '1';
        if (fileInput) fileInput.value = '';

        drop.classList.remove('filled');
        drop.innerHTML = `
            <div class="preview-placeholder" id="${previewId}">
                <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                <div class="drop-title">Click to upload</div>
                <div class="drop-sub">or drag &amp; drop</div>
            </div>
        `;

        let chooseBtn = wrapper.querySelector('.choose-btn');
        if (!chooseBtn && fileInput) {
            chooseBtn = document.createElement('button');
            chooseBtn.type = 'button';
            chooseBtn.className = 'choose-btn';
            chooseBtn.textContent = 'Choose file';
            chooseBtn.onclick = () => fileInput.click();
            wrapper.appendChild(chooseBtn);
        } else if (chooseBtn) {
            chooseBtn.style.display = 'block';
        }
    }

    // ===== Technical Scope (simple list) =====
    const existingScope = @json(old('technical_scope', $service->technical_scope ?? []));
    const scopeContainer = document.getElementById('scopeRows');
    const scopeTemplate = document.getElementById('scopeRowTemplate');

    function addScopeRow(value = '') {
        const clone = scopeTemplate.content.cloneNode(true);
        const row = clone.querySelector('.scope-row');
        row.querySelector('input').value = value;
        row.querySelector('.btn-remove-row').addEventListener('click', () => row.remove());
        scopeContainer.appendChild(row);
    }

    document.getElementById('addScopeBtn').addEventListener('click', () => addScopeRow());

    if (existingScope.length > 0) {
        existingScope.forEach(v => addScopeRow(v));
    } else {
        addScopeRow();
    }

    // ===== Specifications (table rows) =====
    const existingSpecs = @json(old('specifications', $service->specifications ?? []));
    const specContainer = document.getElementById('specRows');
    const specTemplate = document.getElementById('specRowTemplate');
    let specIndex = 0;

    function addSpecRow(data = {}) {
        const clone = specTemplate.content.cloneNode(true);
        const row = clone.querySelector('.specs-row');

        row.querySelectorAll('input').forEach(input => {
            input.name = input.name.replace('__INDEX__', specIndex);
        });

        row.querySelector('input[name$="[specification]"]').value = data.specification ?? '';
        row.querySelector('input[name$="[details]"]').value = data.details ?? '';
        row.querySelector('input[name$="[compliance]"]').value = data.compliance ?? '';

        row.querySelector('.btn-remove-row').addEventListener('click', () => row.remove());

        specContainer.appendChild(row);
        specIndex++;
    }

    document.getElementById('addSpecBtn').addEventListener('click', () => addSpecRow());

    if (existingSpecs.length > 0) {
        existingSpecs.forEach(row => addSpecRow(row));
    } else {
        addSpecRow();
    }

    // ===== Gallery (multi-file with existing-image removal) =====
    const MAX_GALLERY_IMAGES = 6;
    const galleryInput = document.getElementById('galleryInput');
    const newGalleryPreview = document.getElementById('newGalleryPreview');
    const galleryFileCount = document.getElementById('galleryFileCount');
    const galleryLimitMsg = document.getElementById('galleryLimitMsg');

    let selectedFiles = [];

    function toggleGalleryRemoveMark(checkbox) {
        const drop = checkbox.closest('.drop');
        drop.classList.toggle('marked-remove', checkbox.checked);
    }

    function countExistingRemaining() {
        const existingThumbs = document.querySelectorAll('#existingGallery .existing-gallery-item');
        let remaining = 0;
        existingThumbs.forEach(thumb => {
            const checkbox = thumb.querySelector('input[type="checkbox"]');
            if (!checkbox.checked) remaining++;
        });
        return remaining;
    }

    function updateGalleryCount() {
        const remainingExisting = countExistingRemaining();
        const totalCount = remainingExisting + selectedFiles.length;

        galleryFileCount.textContent = totalCount > 0
            ? `${totalCount} / ${MAX_GALLERY_IMAGES} image(s) selected`
            : '';

        galleryLimitMsg.style.display = totalCount > MAX_GALLERY_IMAGES ? 'flex' : 'none';

        document.getElementById('galleryUploadBtn').style.opacity = totalCount >= MAX_GALLERY_IMAGES ? '0.5' : '1';
        document.getElementById('galleryUploadBtn').style.pointerEvents = totalCount >= MAX_GALLERY_IMAGES ? 'none' : 'auto';
    }

    function renderNewPreviews() {
        newGalleryPreview.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const slot = document.createElement('div');
                slot.className = 'image-slot';
                slot.style.cssText = 'flex:0 0 120px; min-width:120px;';

                slot.innerHTML = `
                    <div class="drop filled new-gallery-item">
                        <img src="${e.target.result}" alt="New gallery image">
                        <button type="button" class="remove-img-btn" title="Cancel">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                `;

                slot.querySelector('.remove-img-btn').addEventListener('click', (ev) => {
                    ev.stopPropagation();
                    selectedFiles.splice(index, 1);
                    syncFileInput();
                    renderNewPreviews();
                    updateGalleryCount();
                });

                newGalleryPreview.appendChild(slot);
            };
            reader.readAsDataURL(file);
        });
    }

    function syncFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        galleryInput.files = dataTransfer.files;
    }

    galleryInput.addEventListener('change', function () {
        const remainingExisting = countExistingRemaining();
        const newlyPicked = Array.from(galleryInput.files);
        let combined = selectedFiles.concat(newlyPicked);
        const allowedNewCount = MAX_GALLERY_IMAGES - remainingExisting;

        if (combined.length > allowedNewCount) {
            combined = combined.slice(0, Math.max(allowedNewCount, 0));
            galleryLimitMsg.style.display = 'flex';
        } else {
            galleryLimitMsg.style.display = 'none';
        }

        selectedFiles = combined;
        syncFileInput();
        renderNewPreviews();
        updateGalleryCount();
    });

    document.addEventListener('DOMContentLoaded', updateGalleryCount);

    // ===== Inspection Process (heading + description + image rows) =====
    const existingInspection = @json($inspectionForJs);
    const inspectionContainer = document.getElementById('inspectionRows');
    const inspectionTemplate = document.getElementById('inspectionRowTemplate');
    let inspectionIndex = 0;

    function addInspectionRow(data = {}) {
    const clone = inspectionTemplate.content.cloneNode(true);
    const row = clone.querySelector('.inspection-row');

    row.querySelectorAll('input, textarea').forEach(field => {
        field.name = field.name.replace('__INDEX__', inspectionIndex);
    });

    row.querySelector('input[name$="[heading]"]').value = data.heading ?? '';
    row.querySelector('textarea[name$="[description]"]').value = data.description ?? '';

    if (data.image) {
        const drop = row.querySelector('.inspection-drop');
        drop.innerHTML = `
            <img src="${data.image_url ?? data.image}" alt="Inspection step" style="width:100%;height:100%;object-fit:cover;">
            <button type="button" class="remove-img-btn" onclick="removeInspectionImage(event, this)" title="Remove image">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
        drop.classList.add('filled');
        row.querySelector('.existing-image-input').value = data.image;
    }

    row.querySelector('.inspection-remove').addEventListener('click', () => row.remove());

    inspectionContainer.appendChild(row);
    inspectionIndex++;
}

    document.getElementById('addInspectionBtn').addEventListener('click', () => addInspectionRow());

    if (existingInspection.length > 0) {
        existingInspection.forEach(row => addInspectionRow(row));
    } else {
        addInspectionRow();
    }

function previewInspectionImage(input) {
    const dropEl = input.previousElementSibling; // .inspection-drop
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        dropEl.classList.add('filled');
        dropEl.innerHTML = `
            <img src="${e.target.result}" alt="Preview" style="width:100%;height:100%;object-fit:cover;">
            <button type="button" class="remove-img-btn" onclick="removeInspectionImage(event, this)" title="Remove image">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
    };
    reader.readAsDataURL(file);
}

function removeInspectionImage(event, btn) {
    event.stopPropagation();
    const dropEl = btn.closest('.inspection-drop');
    const row = dropEl.closest('.inspection-row');
    const fileInput = row.querySelector('input[type="file"]');
    const existingInput = row.querySelector('.existing-image-input');

    fileInput.value = '';
    existingInput.value = '';
    dropEl.classList.remove('filled');
    dropEl.innerHTML = `
        <div class="preview-placeholder inspection-preview">
            <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:16px;"></i></div>
            <div class="drop-title">Click to upload</div>
            <div class="drop-sub">or drag &amp; drop</div>
        </div>
    `;
}
</script>

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fieldOrder = [
        'title', 'show_on_home', 'description', 'banner_image', 'image', 'process_description',
        'inspection_process', 'technical_scope', 'specifications',
        'meta_title', 'meta_description', 'gallery', 'remove_gallery',
    ];

    const errorFields = @json(array_keys($errors->getMessages()));
    if (errorFields.length === 0) return;

    let targetPrefix = fieldOrder.find(prefix =>
        errorFields.some(errKey => errKey === prefix || errKey.startsWith(prefix + '.'))
    );
    if (!targetPrefix) targetPrefix = errorFields[0];

    const exactKey = errorFields.find(errKey => errKey === targetPrefix || errKey.startsWith(targetPrefix + '.')) || targetPrefix;

    let field = document.querySelector(`[name="${exactKey}"]`);

    if (!field) {
        const bracketName = exactKey.replace(/\.(\d+)\./, '[$1][').replace(/\.([a-z_]+)$/, '[$1]') + (exactKey.match(/\.(\d+)\./) ? ']' : '');
        field = document.querySelector(`[name="${bracketName}"]`) || document.querySelector(`[name^="${targetPrefix}"]`);
    }

    if (!field) {
        const containerMap = {
            'inspection_process': '#inspectionRows',
            'technical_scope': '#scopeRows',
            'specifications': '#specRows',
            'gallery': '#galleryUploadBtn',
        };
        field = containerMap[targetPrefix] ? document.querySelector(containerMap[targetPrefix]) : null;
    }

    const scrollTarget = field ? (field.closest('.card') || field) : document.querySelector('.field-error');

    if (scrollTarget) {
        scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });
        scrollTarget.classList.add('scroll-error-highlight');
        setTimeout(() => scrollTarget.classList.remove('scroll-error-highlight'), 2500);

        setTimeout(() => {
            if (field && typeof field.focus === 'function' && field.offsetParent !== null) {
                field.focus({ preventScroll: true });
            }
        }, 400);
    }
});
</script>
@endif

<style>
    .req{ color: var(--orange, #EF7B2E); }

    .crumbs{ display:flex; align-items:center; gap:8px; font-size:13px; color: var(--faint,#9AA1B2); margin-bottom:10px; }
    .crumbs b{ color: var(--ink,#171B2C); font-weight:600; }
    .crumbs span:first-child{ cursor:pointer; transition:color .15s; }
    .crumbs span:first-child:hover{ color: var(--orange,#EF7B2E); }

    .header{ display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:32px; gap:16px; flex-wrap:wrap; }
    .header h1{ font-size:25px; font-weight:700; letter-spacing:-0.02em; margin:0; color: var(--ink,#171B2C); }
    .header p{ font-size:13.5px; color: var(--muted,#667085); margin:7px 0 0; max-width:560px; line-height:1.55; }

    .btn-back{
        display:inline-flex; align-items:center; gap:6px; padding:9px 16px; font-size:13px; font-weight:600;
        color: var(--muted,#667085); background:#fff; border:1px solid var(--line,#E9EBF2); border-radius:9px;
        text-decoration:none; transition:all .15s ease; white-space:nowrap;
    }
    .btn-back:hover{ background: var(--orange,#EF7B2E); border-color: var(--orange,#EF7B2E); color:#fff; }

    .section-title{ display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:6px; }
    .section-title h2{ display:flex; align-items:center; gap:8px; font-size:14px; font-weight:700; margin:0; color: var(--ink,#171B2C); }
    .icon{ display:inline-flex; color: var(--orange,#EF7B2E); }
    .section-sub{ font-size:12px; font-weight:400; color: var(--faint,#9AA1B2); }

    .two-col{ display:grid; grid-template-columns:1fr 220px; gap:24px; align-items:start; }
    @media (max-width:700px){ .two-col{ grid-template-columns:1fr; } }

    .field{ margin-bottom:22px; }
    .field:last-child{ margin-bottom:0; }
    .field-top{ display:flex; align-items:baseline; justify-content:space-between; margin-bottom:8px; }
    .field-label{ display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; color: var(--ink,#171B2C); }
    .field-hint{ font-size:11.5px; color: var(--faint,#9AA1B2); }

    .toggle-field{ padding-top:2px; }

    input[type=text], textarea{
        width:100%; border:1px solid var(--input-border,#DBDFEA); border-radius:10px;
        padding:11px 14px; font-size:14px; font-family:inherit; color: var(--ink,#171B2C);
        outline:none; transition:box-shadow .15s, border-color .15s; resize:vertical;
    }
    input[type=text]:focus, textarea:focus{
        border-color: var(--orange,#EF7B2E);
        box-shadow: 0 0 0 4px var(--orange-tint-strong,#FFE9D8);
    }
    .input-error{ border-color:#e74c3c !important; background:#fff8f8; }
    .field-error{ display:flex; align-items:center; gap:5px; color:#e74c3c; font-size:12.5px; margin-top:6px; }

    .notice{ display:flex; align-items:flex-start; gap:8px; background: var(--canvas,#F6F7FB); border-radius:10px; padding:10px 12px; margin-bottom:16px; }
    .notice p{ font-size:12px; color: var(--muted,#667085); margin:0; }
    .notice.caution{ background:#FFF8E8; border:1px solid #F5E3B3; }
    .notice.caution i{ color:#B7791F; }
    .notice.caution p{ color:#8A6116; }
    .notice.caution p b{ color:#6B4A0E; font-weight:700; }

    .slot-top{ display:flex; align-items:center; justify-content:space-between; }
    .slot-label{ font-size:12px; font-weight:600; color: var(--muted,#667085); }
    .images-row, .gallery-new{ display:flex; gap:14px; flex-wrap:wrap; }

    .drop{
        position:relative; aspect-ratio:4/3; border-radius:12px;
        border:2px dashed var(--input-border,#DBDFEA); background:#FAFBFD;
        display:flex; flex-direction:column; align-items:center; justify-content:center;
        cursor:pointer; overflow:hidden; transition:border-color .15s, background .15s; text-align:center;
    }
    .drop:hover{ border-color: var(--orange,#EF7B2E); background: var(--orange-tint,#FFF8F3); }
    .drop.filled{ border:2px solid transparent; background:#0F1220; cursor:default; }
    .drop img{ width:100%; height:100%; object-fit:cover; display:block; }
    .ico-circle{ width:40px; height:40px; border-radius:999px; background:#EEF0F6; display:flex; align-items:center; justify-content:center; margin-bottom:8px; }
    .drop-title{ font-size:12px; font-weight:500; color: var(--muted,#667085); }
    .drop-sub{ font-size:11px; color:#B0B5C4; margin-top:2px; }
    .uploaded-tag{
        position:absolute; left:0; right:0; bottom:0; padding:8px 12px;
        background:linear-gradient(to top, rgba(0,0,0,0.55), transparent);
        color:rgba(255,255,255,0.9); font-size:11px; display:flex; align-items:center; gap:4px;
    }
    .choose-btn{
        margin-top:8px; font-size:12px; font-weight:600; color: var(--orange,#EF7B2E);
        background:#fff; border:1px solid var(--orange-border,#F3D8C2); border-radius:8px;
        padding:7px 16px; cursor:pointer; transition:background .15s; width:100%;
    }
    .choose-btn.inline{ display:inline-flex; align-items:center; gap:6px; width:auto; }
    .choose-btn:hover{ background: var(--orange-tint,#FFF8F3); }

    .remove-img-btn{
        position:absolute; top:8px; right:8px; width:26px; height:26px; border-radius:999px;
        background:rgba(0,0,0,0.6); border:none; color:#fff; display:flex; align-items:center;
        justify-content:center; cursor:pointer; transition:background .15s; z-index:3; font-size:11px;
    }
    .remove-img-btn:hover{ background:rgba(0,0,0,0.85); }
    .remove-img-btn input[type="checkbox"]{ position:absolute; opacity:0; width:100%; height:100%; margin:0; cursor:pointer; }

    .existing-gallery-item.marked-remove{ opacity:0.35; }
    .existing-gallery-item.marked-remove::after{
        content:"Will be removed"; position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
        background:rgba(231,76,60,0.85); color:#fff; font-size:9px; font-weight:700; text-align:center; padding:6px;
    }

    /* ===== Toggle switch (orange, matching this design system) ===== */
    .switch-toggle{ position:relative; display:inline-block; width:46px; height:26px; }
    .switch-toggle input{ opacity:0; width:0; height:0; }
    .switch-slider{
        position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0;
        background:#DBDFEA; border-radius:26px; transition:.25s;
    }
    .switch-slider::before{
        position:absolute; content:""; height:20px; width:20px; left:3px; bottom:3px;
        background:#fff; border-radius:50%; transition:.25s; box-shadow:0 1px 2px rgba(0,0,0,0.15);
    }
    .switch-toggle input:checked + .switch-slider{ background: var(--orange,#EF7B2E); }
    .switch-toggle input:checked + .switch-slider::before{ transform:translateX(20px); }

    /* ===== Dynamic rows: scope / specs ===== */
    .scope-row{ display:flex; gap:10px; margin-bottom:10px; }
    .scope-row input{ flex:1; }

    .specs-table-header{
        display:grid; grid-template-columns:1fr 1.5fr 1fr 40px; gap:12px;
        font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.05em;
        color: var(--faint,#9AA1B2); padding:0 4px 10px; border-bottom:1px solid var(--line,#E9EBF2); margin-bottom:12px;
    }
    .specs-row{ display:grid; grid-template-columns:1fr 1.5fr 1fr 40px; gap:12px; margin-bottom:10px; align-items:center; }
    @media (max-width:700px){
        .specs-table-header{ display:none; }
        .specs-row{ grid-template-columns:1fr; }
    }

    .action-btn{
        width:36px; height:36px; border-radius:8px; border:none;
        display:inline-flex; align-items:center; justify-content:center;
        cursor:pointer; font-size:14px; transition:filter .15s; flex-shrink:0;
    }
    .action-btn.delete{ background:#fdecea; color:#e74c3c; }
    .action-btn.delete:hover{ filter:brightness(0.95); }

    /* ===== Inspection rows ===== */
 .inspection-row {
    position: relative;
    display: block;
    padding: 20px;
    padding-top: 44px;      /* room for the trash button pinned top-right */
    background: #F7F8FA;
    border-radius: 10px;
    margin-bottom: 16px;
}

.inspection-row-fields {
    display: grid !important;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1.6fr) minmax(180px, 220px) !important;
    gap: 24px;
    align-items: start;
    width: 100%;
}

.inspection-row-fields .field {
    min-width: 0;   /* prevents input/textarea from forcing the column to overflow and wrap */
    margin-bottom: 0;
}

.inspection-row-fields .field input,
.inspection-row-fields .field textarea {
    width: 100%;
    box-sizing: border-box;
}

.inspection-drop.img-slot {
    width: 100%;
    height: 180px;
    border: 1.5px dashed #D8DCE3;
    border-radius: 10px;
    background: #fff;
    cursor: pointer;
    overflow: hidden;
    position: relative;
}

.inspection-preview {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    text-align: center;
    padding: 0 12px;
}

.inspection-preview .ico-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #EEF0F4;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 4px;
    flex-shrink: 0;
}

.inspection-preview .drop-title {
    font-weight: 600;
    font-size: 14px;
    color: #1F2430;
}

.inspection-preview .drop-sub {
    font-size: 12px;
    color: #9AA1AE;
}

.inspection-row .action-btn.delete {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: #FDECEC;
    color: #E5484D;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 2;
}

.inspection-row .action-btn.delete:hover {
    background: #FBD5D5;
}

/* stack on narrow screens instead of squeezing columns */
@media (max-width: 768px) {
    .inspection-row-fields {
        grid-template-columns: 1fr !important;
    }
}
    .savebar{
        position:fixed; left:264px; right:0; bottom:0; z-index:20;
        border-top:1px solid var(--line,#E9EBF2);
        background:rgba(255,255,255,0.96); backdrop-filter:blur(6px);
        padding:0 32px;
        box-shadow:0 -4px 16px -8px rgba(15,21,38,0.06);
    }
    .savebar-inner{ padding:16px 0; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; }
    .savebar-status{ font-size:12px; color: var(--faint,#9AA1B2); }
    .btn-group{ display:flex; align-items:center; gap:12px; }
    .btn-cancel{
        font-size:13px; font-weight:600; color: var(--muted,#667085); background:none; border:none;
        padding:10px 16px; border-radius:8px; cursor:pointer; text-decoration:none; transition:color .15s, background .15s;
    }
    .btn-cancel:hover{ color: var(--ink,#171B2C); background: var(--canvas,#F6F7FB); }
    .btn-save{
        display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:#fff;
        background:linear-gradient(135deg, #0F1526, #1D2439); border:none;
        padding:11px 22px; border-radius:9px; cursor:pointer;
        box-shadow:0 4px 12px -4px rgba(15,21,38,0.4);
        transition:transform .12s ease, box-shadow .12s ease;
    }
    .btn-save:hover{ transform:translateY(-1px); box-shadow:0 8px 18px -6px rgba(15,21,38,0.5); }

    .wrap{ padding-bottom:90px; }

    @media (max-width:900px){
        .savebar{ left:0; }
    }

    .notice-compact {
    padding: 8px 10px;
    margin-bottom: 8px;
    display: flex;
    align-items: flex-start;
    gap: 6px;
    font-size: 11.5px;
    line-height: 1.35;
    border-radius: 8px;
}

.notice-compact i {
    font-size: 12px;
    margin-top: 1px;
    flex-shrink: 0;
}

.notice-compact p {
    margin: 0;
}

.notice-compact b {
    font-weight: 600;
}
</style>

@endsection