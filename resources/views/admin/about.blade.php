@extends('admin.layout')
@section('title', 'About Us Page')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>



@if ($errors->any())
<div class="notice caution" style="margin-bottom:20px;">
    <i class="bi bi-exclamation-triangle" style="font-size:15px;flex-shrink:0;margin-top:1px;"></i>
    <p>Please fill in the highlighted fields below before submitting.</p>
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

<form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data" class="banner-form" id="aboutForm">
    @csrf

    <div class="wrap">
        <div class="crumbs">
            <span onclick="window.location='{{ route('admin.dashboard') }}'">Home</span>
            <span>&rsaquo;</span>
            <b>About Us Page</b>
        </div>

        <div class="header">
            <div>
                <h1>About Us Page</h1>
                <p>Everything shown on your public About page — banner, mission &amp; values, commitment, and foundation.</p>
            </div>

            <!-- <span class="badge" id="imageBadge">
                <i class="bi bi-check-lg"></i>
                <span id="imageBadgeCount">0</span>/<span id="imageBadgeTotal">7</span> images added
            </span> -->

        </div>

        {{-- ============ Form (no live preview column — single-column layout) ============ --}}
        <div class="form-col">

            {{-- SEO Meta --}}
            <div class="card">
                <div class="section-title">
                    <h2><span class="icon"><i class="bi bi-search"></i></span> SEO Meta</h2>
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Meta Title</label>
                        <span class="field-hint">Recommended 50&ndash;60 chars</span>
                    </div>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $why->meta_title) }}"
                           class="{{ $errors->has('meta_title') ? 'input-error' : '' }}"
                           placeholder="e.g. About EGTS - Precision Oilfield Machining Services">
                    @error('meta_title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Meta Description</label>
                        <span class="field-hint">Recommended 150&ndash;160 chars</span>
                    </div>
                    <textarea name="meta_description" rows="3"
                              class="{{ $errors->has('meta_description') ? 'input-error' : '' }}"
                              placeholder="A short summary shown in search engine results...">{{ old('meta_description', $why->meta_description) }}</textarea>
                    @error('meta_description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Banner Section --}}
            <div class="card">
                <div class="section-title">
                    <h2><span class="icon"><i class="bi bi-image"></i></span> Banner Section <span class="req">*</span></h2>
                    <span class="section-sub" style="margin:0;">JPG, PNG, WEBP &middot; up to 10MB</span>
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Heading <span class="req">*</span></label>
                    </div>
                    <input type="text" name="banner_heading" id="bannerHeadingInput"
                           value="{{ old('banner_heading', $why->banner_heading) }}"
                           class="{{ $errors->has('banner_heading') ? 'input-error' : '' }}">
                    @error('banner_heading')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Description <span class="req">*</span></label>
                    </div>
                    <textarea name="banner_description" id="bannerDescInput" rows="4"
                              class="{{ $errors->has('banner_description') ? 'input-error' : '' }}">{{ old('banner_description', $why->banner_description) }}</textarea>
                    @error('banner_description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Banner Image<span class="req">*</span></label>
                    </div>

                    <div class="notice caution">
                        <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                        <p><b>Recommended size:</b> {{ $imageWidth ?? 1200 }} &times; {{ $imageHeight ?? 600 }}px &middot; 16:9 landscape &middot; <b>Suppoted Type and Size:</b>JPG, PNG, WEBP &middot; up to 10MB each.</p>
                    </div>

                    <div class="image-slot" style="max-width:340px;">
                        <div class="drop img-slot {{ $why->banner_image ? 'filled' : '' }}" data-file-input="file-banner" onclick="handleDropClick(this)">
                            @if ($why->banner_image)
                                <img src="{{ Storage::url($why->banner_image) }}" id="preview-banner" alt="Banner image">
                                <button type="button" class="remove-img-btn" onclick="removeUploadedImage(event, this, 'banner_image', 'preview-banner')" title="Remove image">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                            @else
                                <div class="preview-placeholder" id="preview-banner">
                                    <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                                    <div class="drop-title">Click to upload</div>
                                    <div class="drop-sub">or drag &amp; drop</div>
                                </div>
                            @endif
                        </div>
                        <input type="file" id="file-banner" name="banner_image" accept="image/*" hidden
                               onchange="previewImage(this,'preview-banner')">
                        <input type="hidden" name="remove_banner_image" id="remove-banner_image" value="0">
                        @if (!$why->banner_image)
                            <button type="button" class="choose-btn" onclick="document.getElementById('file-banner').click()">Choose file</button>
                        @endif
                    </div>
                    @error('banner_image')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- About EGTS --}}
            <div class="card">
                <div class="section-title">
                    <h2><span class="icon"><i class="bi bi-layout-text-window"></i></span> About EGTS</h2>
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Heading <span class="req">*</span></label>
                    </div>
                    <input type="text" name="about_heading" value="{{ old('about_heading', $why->about_heading) }}"
                           class="{{ $errors->has('about_heading') ? 'input-error' : '' }}">
                    @error('about_heading')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Description <span class="req">*</span></label>
                    </div>
                    <textarea name="about_description" class="rich-text {{ $errors->has('about_description') ? 'input-error' : '' }}">{{ old('about_description', $why->about_description) }}</textarea>
                    @error('about_description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>


                     <div class="notice caution">
                        <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                        <p><b>Recommended size:</b> {{ $imageWidth ?? 1200 }} &times; {{ $imageHeight ?? 600 }}px &middot; 16:9 landscape &middot; <b>Suppoted Type and Size:</b>JPG, PNG, WEBP &middot; up to 5MB each.</p>
                    </div>

                    
                <div class="images-row">
                    @foreach (['image_one' => 'Image One', 'image_two' => 'Image Two'] as $suffix => $label)
                        @php $field = 'section_two_' . $suffix; @endphp
                        <div class="image-slot">
                            <div class="slot-top">
                                <span class="slot-label">{{ $label }} <span class="req">*</span></span>
                            </div>
                            <div class="drop img-slot {{ $why->{$field} ? 'filled' : '' }}" data-file-input="file-{{ $field }}" onclick="handleDropClick(this)">
                                @if ($why->{$field})
                                    <img src="{{ Storage::url($why->{$field}) }}" id="preview-{{ $field }}" alt="{{ $label }}">
                                    <button type="button" class="remove-img-btn" onclick="removeUploadedImage(event, this, '{{ $field }}', 'preview-{{ $field }}')" title="Remove image">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                    <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                                @else
                                    <div class="preview-placeholder" id="preview-{{ $field }}">
                                        <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                                        <div class="drop-title">Click to upload</div>
                                        <div class="drop-sub">JPG, PNG, WEBP</div>
                                    </div>
                                @endif
                            </div>

                          


                            <input type="file" id="file-{{ $field }}" name="{{ $field }}" accept="image/*" hidden
                                   onchange="previewImage(this,'preview-{{ $field }}')">
                            <input type="hidden" name="remove_{{ $field }}" id="remove-{{ $field }}" value="0">
                            @if (!$why->{$field})
                                <button type="button" class="choose-btn" onclick="document.getElementById('file-{{ $field }}').click()">Choose file</button>
                            @endif
                            @error($field)
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Mission / Vision / Core Values --}}
            @php
                $blocks = [
                    'mission' => ['label' => 'Mission', 'icon' => 'bi-bullseye', 'accent' => '#EF7B2E'],
                    'vision'  => ['label' => 'Vision',  'icon' => 'bi-eye', 'accent' => '#2563EB'],
                    'values'  => ['label' => 'Core Values', 'icon' => 'bi-flag', 'accent' => '#12875A'],
                ];
            @endphp

            <div class="block-grid">
                @foreach ($blocks as $key => $meta)
                <div class="card block-card" style="border-top:3px solid {{ $meta['accent'] }};">
                    <div class="section-title">
                        <h2><span class="icon" style="color:{{ $meta['accent'] }};"><i class="bi {{ $meta['icon'] }}"></i></span> {{ $meta['label'] }}</h2>
                    </div>

                    <div class="field">
                        <div class="field-top">
                            <label class="field-label">Title <span class="req">*</span></label>
                        </div>
                        <input type="text" name="{{ $key }}_title" value="{{ old($key.'_title', $why->{$key.'_title'}) }}"
                               class="{{ $errors->has($key.'_title') ? 'input-error' : '' }}" placeholder="{{ $meta['label'] }}">
                        @error($key.'_title')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="field-top">
                            <label class="field-label">Description (Plain Text) <span class="req">*</span></label>
                        </div>
                        <textarea name="{{ $key }}_description" rows="4"
                                  class="{{ $errors->has($key.'_description') ? 'input-error' : '' }}"
                                  placeholder="Describe the {{ strtolower($meta['label']) }}...">{{ old($key.'_description', $why->{$key.'_description'}) }}</textarea>
                        @error($key.'_description')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="field-top">
                            <label class="field-label">Description (Rich Text) <span class="req">*</span></label>
                        </div>
                        <textarea name="{{ $key }}_description_rich" id="{{ $key }}-desc-rich"
                                  class="rich-text {{ $errors->has($key.'_description_rich') ? 'input-error' : '' }}"
                                  placeholder="Describe the {{ strtolower($meta['label']) }}...">{{ old($key.'_description_rich', $why->{$key.'_description_rich'}) }}</textarea>
                        @error($key.'_description_rich')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="field-top">
                            <label class="field-label">Background Image <span class="req">*</span></label>
                        </div>

                            <div class="notice caution">
                        <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                        <p><b>Recommended size:</b> {{ $imageWidth ?? 1200 }} &times; {{ $imageHeight ?? 600 }}px &middot; 16:9 landscape &middot; <b>Suppoted Type and Size:</b>JPG, PNG, WEBP &middot; up to 5MB each.</p>
                    </div>

                    

                        <div class="drop img-slot {{ $why->{$key.'_image'} ? 'filled' : '' }}" data-file-input="file-{{ $key }}" onclick="handleDropClick(this)">
                            @if ($why->{$key.'_image'})
                                <img src="{{ Storage::url($why->{$key.'_image'}) }}" id="preview-{{ $key }}" alt="{{ $meta['label'] }}">
                                <button type="button" class="remove-img-btn" onclick="removeUploadedImage(event, this, '{{ $key }}_image', 'preview-{{ $key }}')" title="Remove image">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                            @else
                                <div class="preview-placeholder" id="preview-{{ $key }}">
                                    <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                                    <div class="drop-title">Click to upload</div>
                                    <div class="drop-sub">{{ $imageWidth ?? 580 }}&times;{{ $imageHeight ?? 300 }}px</div>
                                </div>
                            @endif
                        </div>
                        <input type="file" id="file-{{ $key }}" name="{{ $key }}_image" accept="image/*" hidden
                               onchange="previewImage(this,'preview-{{ $key }}')">
                        <input type="hidden" name="remove_{{ $key }}_image" id="remove-{{ $key }}_image" value="0">
                        @if (!$why->{$key.'_image'})
                            <button type="button" class="choose-btn" onclick="document.getElementById('file-{{ $key }}').click()">Choose file</button>
                        @endif
                        @error($key.'_image')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Commitment --}}
            <div class="card block-card" style="border-top:3px solid #171B2C;">
                <div class="section-title">
                    <h2><span class="icon" style="color:#171B2C;"><i class="bi bi-shield-check"></i></span> Commitment</h2>
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Title <span class="req">*</span></label>
                    </div>
                    <input type="text" name="commitment_title" value="{{ old('commitment_title', $why->commitment_title) }}"
                           class="{{ $errors->has('commitment_title') ? 'input-error' : '' }}" placeholder="e.g. OUR COMMITMENT">
                    @error('commitment_title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Description (Plain Text) <span class="req">*</span></label>
                    </div>
                    <textarea name="commitment_description" rows="4"
                              class="{{ $errors->has('commitment_description') ? 'input-error' : '' }}"
                              placeholder="We are committed to providing...">{{ old('commitment_description', $why->commitment_description) }}</textarea>
                    @error('commitment_description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Description (Rich Text) <span class="req">*</span></label>
                    </div>
                    <textarea name="commitment_description_rich" id="commitment-desc-rich"
                              class="rich-text {{ $errors->has('commitment_description_rich') ? 'input-error' : '' }}"
                              placeholder="We are committed to providing...">{{ old('commitment_description_rich', $why->commitment_description_rich) }}</textarea>
                    @error('commitment_description_rich')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Commitment Image<span class="req">*</span></label>
                    </div>

                      <div class="notice caution">
                        <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                        <p><b>Recommended size:</b> {{ $imageWidth ?? 1200 }} &times; {{ $imageHeight ?? 600 }}px &middot; 16:9 landscape &middot; <b>Suppoted Type and Size:</b>JPG, PNG, WEBP &middot; up to 5MB each.</p>
                    </div>
                    

                    <div class="image-slot" style="max-width:340px;">
                        <div class="drop img-slot {{ $why->commitment_image ? 'filled' : '' }}" data-file-input="file-commitment" onclick="handleDropClick(this)">
                            @if ($why->commitment_image)
                                <img src="{{ Storage::url($why->commitment_image) }}" id="preview-commitment" alt="Commitment">
                                <button type="button" class="remove-img-btn" onclick="removeUploadedImage(event, this, 'commitment_image', 'preview-commitment')" title="Remove image">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                            @else
                                <div class="preview-placeholder" id="preview-commitment">
                                    <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                                    <div class="drop-title">Click to upload</div>
                                    <div class="drop-sub">{{ $imageWidth ?? 1000 }}&times;{{ $imageHeight ?? 700 }}px</div>
                                </div>
                            @endif
                        </div>
                        <input type="file" id="file-commitment" name="commitment_image" accept="image/*" hidden
                               onchange="previewImage(this,'preview-commitment')">
                        <input type="hidden" name="remove_commitment_image" id="remove-commitment_image" value="0">
                        @if (!$why->commitment_image)
                            <button type="button" class="choose-btn" onclick="document.getElementById('file-commitment').click()">Choose file</button>
                        @endif
                    </div>
                    @error('commitment_image')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Our Foundation --}}
            <div class="card block-card" style="border-top:3px solid #9333EA;">
                <div class="section-title">
                    <h2><span class="icon" style="color:#9333EA;"><i class="bi bi-bank"></i></span> Our Foundation</h2>
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Heading <span class="req">*</span></label>
                    </div>
                    <input type="text" name="foundation_heading" value="{{ old('foundation_heading', $why->foundation_heading) }}"
                           class="{{ $errors->has('foundation_heading') ? 'input-error' : '' }}" placeholder="e.g. Our Foundation">
                    @error('foundation_heading')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Description <span class="req">*</span></label>
                    </div>
                    <textarea name="foundation_description" rows="4"
                              class="{{ $errors->has('foundation_description') ? 'input-error' : '' }}"
                              placeholder="Describe the foundation...">{{ old('foundation_description', $why->foundation_description) }}</textarea>
                    @error('foundation_description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

    </div>

    <div class="savebar">
        <div class="savebar-inner">
            <span class="savebar-status" id="saveStatus">All changes save to the live About page</span>
            <div class="btn-group">
                <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-save">
                    <i class="bi bi-check-lg"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    // ===== Drop-zone click handling (only opens picker when not already filled) =====
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

                    // If a remove-image hidden flag was set earlier in this session
                    // (user removed then re-selected a new file), reset it back to 0
                    // since a fresh file is now being uploaded.
                    const removeInput = drop.parentElement.querySelector('input[type="hidden"][id^="remove-"]');
                    if (removeInput) removeInput.value = '0';

                    // Add the remove (X) button on top of the newly chosen image too,
                    // so it behaves the same as an already-saved image.
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

                updateImageBadge();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ===== Remove an already-uploaded (or newly-selected) image =====
    // Sets a hidden "remove_<field>" flag to 1 so the backend deletes the stored file,
    // clears the file input, and reverts the drop zone back to the empty state.
    function removeUploadedImage(event, btn, fieldName, previewId) {
        event.stopPropagation(); // don't trigger handleDropClick and reopen the file picker

        const drop = btn.closest('.drop');
        const wrapper = drop.parentElement;
        const fileInput = wrapper.querySelector('input[type="file"]');
        const removeInput = document.getElementById(`remove-${fieldName}`);

        if (removeInput) removeInput.value = '1';
        if (fileInput) fileInput.value = '';

        // Rebuild the placeholder content and drop the "filled"/uploaded state.
        drop.classList.remove('filled');
        drop.innerHTML = `
            <div class="preview-placeholder" id="${previewId}">
                <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                <div class="drop-title">Click to upload</div>
                <div class="drop-sub">or drag &amp; drop</div>
            </div>
        `;

        // Show the "Choose file" button again if it was hidden.
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

        updateImageBadge();
    }

    // ===== Badge: count how many of the 7 image slots are filled =====
    function updateImageBadge() {
        const total = document.querySelectorAll('.img-slot').length;
        const filled = document.querySelectorAll('.img-slot.filled').length;
        document.getElementById('imageBadgeCount').textContent = filled;
        document.getElementById('imageBadgeTotal').textContent = total;
    }

    // ===== Rich text editor init =====
        // ===== Rich text editor init =====
    function initRichText(selector) {
        tinymce.init({
            selector: selector,
            height: 400,
            menubar: false,
            plugins: 'advlist autolink lists link image charmap preview anchor ' +
                'searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
            toolbar: 'undo redo | blocks | bold italic underline forecolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image media table | ' +
                'code preview fullscreen | removeformat help',
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Quote=blockquote',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size:14px }',
            branding: false,
            promotion: false,
            setup: function (editor) {
                editor.on('change keyup', function () {
                    editor.save();
                });
            }
        });
    }

    

    document.addEventListener('DOMContentLoaded', function () {
        initRichText('.rich-text');
        updateImageBadge();
    });
</script>

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fieldOrder = [
        'meta_title', 'meta_description',
        'banner_heading', 'banner_description', 'banner_image',
        'about_heading', 'about_description', 'section_two_image_one', 'section_two_image_two',
        'mission_title', 'mission_description', 'mission_description_rich', 'mission_image',
        'vision_title', 'vision_description', 'vision_description_rich', 'vision_image',
        'values_title', 'values_description', 'values_description_rich', 'values_image',
        'commitment_title', 'commitment_description', 'commitment_description_rich', 'commitment_image',
        'foundation_heading', 'foundation_description',
    ];

    const errorFields = @json(array_keys($errors->getMessages()));
    if (errorFields.length === 0) return;

    let targetName = fieldOrder.find(name => errorFields.includes(name)) || errorFields[0];

    let field = document.querySelector(`[name="${targetName}"]`);
    if (!field) {
        field = document.getElementById(`${targetName.replace('_description_rich', '')}-desc-rich`);
    }

    const scrollTarget = field
        ? (field.closest('.card') || field.closest('.field') || field)
        : document.querySelector('.field-error');

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
    /* ===== Page layout: full width ===== */
    .wrap{ width:100%; }
    .form-col{ min-width:0; }

    .crumbs{ display:flex; align-items:center; gap:8px; font-size:13px; color: var(--faint,#9AA1B2); margin-bottom:10px; grid-column:1/-1; }
    .crumbs b{ color: var(--ink,#171B2C); font-weight:600; }
    .crumbs span:first-child{ cursor:pointer; transition:color .15s; }
    .crumbs span:first-child:hover{ color: var(--orange,#EF7B2E); }

    .header{ display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:28px; gap:16px; flex-wrap:wrap; }
    .header h1{ font-size:25px; font-weight:700; letter-spacing:-0.02em; margin:0; color: var(--ink,#171B2C); }
    .header p{ font-size:13.5px; color: var(--muted,#667085); margin:7px 0 0; line-height:1.55; }
    .badge{
        display:inline-flex; align-items:center; gap:6px; font-size:12px; font-weight:600;
        color: var(--green,#12875A); background: var(--green-tint,#E9F8EF); padding:7px 13px;
        border-radius:999px; white-space:nowrap; border:1px solid rgba(18,135,90,0.15);
    }

    .req{ color: var(--orange, #EF7B2E); }

    .section-title{ display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:6px; }
    .section-title h2{ display:flex; align-items:center; gap:8px; font-size:14px; font-weight:700; margin:0; color: var(--ink,#171B2C); }
    .icon{ display:inline-flex; color: var(--orange,#EF7B2E); }
    .section-sub{ font-size:12px; color: var(--faint,#9AA1B2); }

    .field{ margin-bottom:22px; }
    .field:last-child{ margin-bottom:0; }
    .field-top{ display:flex; align-items:baseline; justify-content:space-between; margin-bottom:8px; }
    .field-label{ display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; color: var(--ink,#171B2C); }
    .field-hint{ font-size:11.5px; color: var(--faint,#9AA1B2); }

    input[type=text], textarea{
        width:100%; border:1px solid var(--input-border,#DBDFEA); border-radius:10px;
        padding:11px 14px; font-size:14px; font-family:inherit; color: var(--ink,#171B2C);
        outline:none; transition:box-shadow .15s, border-color .15s;
    }
    input[type=text]:focus, textarea:focus{
        border-color: var(--orange,#EF7B2E);
        box-shadow: 0 0 0 4px var(--orange-tint-strong,#FFE9D8);
    }
    textarea{ resize:vertical; line-height:1.5; }

    .input-error{ border-color:#e74c3c !important; background:#fff8f8; }
    .field-error{ display:flex; align-items:center; gap:5px; color:#e74c3c; font-size:12.5px; margin-top:6px; }

    .notice{ display:flex; align-items:flex-start; gap:8px; background: var(--canvas,#F6F7FB); border-radius:10px; padding:10px 12px; margin-bottom:16px; }
    .notice p{ font-size:12px; color: var(--muted,#667085); margin:0; }
    .notice.caution{ background:#FFF8E8; border:1px solid #F5E3B3; }
    .notice.caution i{ color:#B7791F; }
    .notice.caution p{ color:#8A6116; }
    .notice.caution p b{ color:#6B4A0E; font-weight:700; }

    .images-row{ display:flex; gap:16px; flex-wrap:wrap; }
    .image-slot{ flex:1; min-width:200px; }
    .slot-top{ display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
    .slot-label{ font-size:12px; font-weight:500; color: var(--muted,#667085); }

    .drop{
        position:relative; height:190px; border-radius:12px;
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
    .remove-img-btn{
        position:absolute; top:8px; right:8px; width:28px; height:28px; border-radius:999px;
        background:rgba(0,0,0,0.6); border:none; color:#fff; display:flex; align-items:center;
        justify-content:center; cursor:pointer; transition:background .15s; z-index:3; font-size:13px;
    }
    .remove-img-btn:hover{ background:rgba(0,0,0,0.85); }
    .choose-btn{
        margin-top:8px; width:100%; font-size:12px; font-weight:600; color: var(--orange,#EF7B2E);
        background:#fff; border:1px solid var(--orange-border,#F3D8C2); border-radius:8px;
        padding:7px 0; cursor:pointer; transition:background .15s;
    }
    .choose-btn:hover{ background: var(--orange-tint,#FFF8F3); }

    .block-grid{ display:flex; flex-direction:column; gap:20px; margin-bottom:20px; }


    /* ===== Sticky save bar ===== */
    .savebar{
        position:sticky; bottom:0; border-top:1px solid var(--line,#E9EBF2);
        background:rgba(255,255,255,0.94); backdrop-filter:blur(6px);
        margin:24px -32px -32px; padding:0 32px;
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

    .scroll-error-highlight{
        outline:3px solid #e74c3c !important; outline-offset:4px; border-radius:12px;
        animation:scrollErrorPulse 0.6s ease-in-out 2;
    }
    @keyframes scrollErrorPulse{
        0%, 100% { outline-color:#e74c3c; }
        50% { outline-color:#ff8a80; }
    }
</style>

@endsection