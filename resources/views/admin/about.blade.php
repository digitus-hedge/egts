@extends('admin.layout')
@section('title', 'About Us Page')
@section('content')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

@if ($errors->any())
<div class="alert alert-error">
    <i class="bi bi-exclamation-circle"></i>
    <div>
        Please fill below fields before submitting:
        <!-- <ul style="margin: 6px 0 0 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul> -->
    </div>
</div>
@endif

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: @json(session('success')),
            confirmButtonColor: '#3b3b58',
            timer: 2500,
            timerProgressBar: true
        });
    });

</script>
@endif

<div class="form-header">
    <h4>
        <i class="bi bi-star"></i>
        About Us Page
    </h4>
</div>

<form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data" class="banner-form"
    id="aboutForm"> @csrf

    <div class="container-fluid px-0">
        <div class="row">

            {{-- 1. BANNER SECTION --}}


            <div class="col-md-12">
                        <div class="form-card">
                            <label class="section-label"><i class="bi bi-search"></i> SEO Meta</label>

                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" value="{{ old('meta_title', $why->meta_title) }}"
                                    class="{{ $errors->has('meta_title') ? 'input-error' : '' }}"
                                    placeholder="e.g. About EGTS - Precision Oilfield Machining Services">
                                <p class="hint-text">Recommended: 50–60 characters.</p>
                                @error('meta_title')
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-top:16px;">
                                <label>Meta Description</label>
                                <textarea name="meta_description" rows="3"
                                    class="{{ $errors->has('meta_description') ? 'input-error' : '' }}"
                                    placeholder="A short summary shown in search engine results...">{{ old('meta_description', $why->meta_description) }}</textarea>
                                <p class="hint-text">Recommended: 150–160 characters.</p>
                                @error('meta_description')
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    
            <div class="col-md-12">
                <div class="form-card">

                    

                    <label class="section-label"><i class="bi bi-image"></i> Banner Section</label>

                    <div class="form-group">
                        <label>Heading <span class="text-danger">*</span></label>
                        <input type="text" name="banner_heading"
                            value="{{ old('banner_heading', $why->banner_heading) }}"
                            class="{{ $errors->has('banner_heading') ? 'input-error' : '' }}">
                        @error('banner_heading')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group" style="margin-top:14px;">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="banner_description" rows="4"
                            class=" {{ $errors->has('banner_description') ? 'input-error' : '' }}">{{ old('banner_description', $why->banner_description) }}</textarea>
                        @error('banner_description')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group" style="margin-top:14px;">
                        <label>Banner Image</label>
                        <!-- <p class="hint-text">Max 2MB — JPG, PNG, WEBP</p> -->

                             <div class="upload-guidelines">
                        <span class="guideline-item">
                            <i class="bi bi-file-earmark-image"></i>
                            Accepted: <strong>JPG, PNG, WEBP</strong>
                        </span>
                        <span class="guideline-divider"></span>
                        <span class="guideline-item">
                            <i class="bi bi-hdd"></i>
                            Max size: <strong>10MB</strong> per image
                        </span>
                        <span class="guideline-divider"></span>
                        <span class="guideline-item">
                            <i class="bi bi-aspect-ratio"></i>
                            Recommended: <strong>{{ $imageWidth ?? 1200 }} × {{ $imageHeight ?? 600 }}px</strong>
                        </span>
                    </div>
                        <div class="image-upload-box">
                            <div class="preview-wrap">
                                @if ($why->banner_image)
                                <img src="{{ Storage::url($why->banner_image) }}" class="preview-img"
                                    id="preview-banner">
                                @else
                                <div class="preview-placeholder" id="preview-banner"><i class="bi bi-image"></i></div>
                                @endif
                            </div>
                            <label class="upload-btn">
                                <i class="bi bi-upload"></i> Choose file
                                <input type="file" name="banner_image" accept="image/*"
                                    onchange="previewImage(this,'preview-banner')" hidden>
                            </label>
                            @error('banner_image')<span class="field-error d-block mt-2">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. SECTION TWO --}}
            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-layout-text-window"></i> ABOUT EGTS</label>

                    <div class="form-group">
                        <label>Heading <span class="text-danger">*</span></label>
                        <input type="text" name="about_heading" value="{{ old('about_heading', $why->about_heading) }}"
                            class="{{ $errors->has('about_heading') ? 'input-error' : '' }}">
                        @error('about_heading')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group" style="margin-top:14px;">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="about_description"
                            class="rich-text {{ $errors->has('about_description') ? 'input-error' : '' }}">{{ old('about_description', $why->about_description) }}</textarea>
                        @error('about_description')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                 <div class="row" style="margin-top:14px;">
    @foreach (['image_one' => 'Image One', 'image_two' => 'Image Two'] as $suffix => $label)
        @php $field = 'section_two_' . $suffix; @endphp
        <div class="col-md-6">
            <label>{{ $label }}</label>
            <div class="image-upload-box">
                <div class="preview-wrap">
                    @if ($why->{$field})
                        <img src="{{ Storage::url($why->{$field}) }}" class="preview-img"
                            id="preview-{{ $field }}">
                    @else
                        <div class="preview-placeholder" id="preview-{{ $field }}"><i class="bi bi-image"></i></div>
                    @endif
                </div>

                <label class="upload-btn">
                    <i class="bi bi-upload"></i> Choose file
                    <input type="file" name="{{ $field }}" accept="image/*"
                        onchange="previewImage(this,'preview-{{ $field }}')" hidden>
                </label>

                <div class="upload-guidelines">
                    <span class="guideline-item">
                        <i class="bi bi-file-earmark-image"></i>
                        <strong>JPG, PNG, WEBP</strong>
                    </span>
                    <span class="guideline-divider"></span>
                    <span class="guideline-item">
                        <i class="bi bi-hdd"></i>
                        Max <strong>10MB</strong>
                    </span>
                    <span class="guideline-divider"></span>
                    <span class="guideline-item">
                        <i class="bi bi-aspect-ratio"></i>
                        <strong>{{ $imageWidth ?? 600 }} × {{ $imageHeight ?? 400 }}px</strong>
                    </span>
                </div>

                @error($field)
                    <span class="field-error d-block mt-2"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>
    @endforeach
</div>
                    
                </div>
            </div>


            {{-- Mission, Vision, Core Values --}}
            @php $blocks = [
            'mission' => 'Mission',
            'vision' => 'Vision',
            'values' => 'Core Values',
            ]; @endphp

            @foreach ($blocks as $key => $label)
            <div class="col-md-4">
                <div class="form-card block-card">
                    <label class="section-label"><i class="bi bi-flag"></i> {{ $label }}</label>

                    {{-- Block Title --}}
                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" name="{{ $key }}_title"
                            value="{{ old($key.'_title', $why->{$key.'_title'}) }}"
                            class="{{ $errors->has($key.'_title') ? 'input-error' : '' }}" placeholder="{{ $label }}">
                        @error($key.'_title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Block Description (Plain) --}}
                    <div class="form-group" style="margin-top:12px;">
                        <label>Description (Plain Text) <span class="text-danger">*</span></label>
                        <textarea name="{{ $key }}_description" rows="4"
                            class="{{ $errors->has($key.'_description') ? 'input-error' : '' }}"
                            placeholder="Describe the {{ strtolower($label) }}...">{{ old($key.'_description', $why->{$key.'_description'}) }}</textarea>
                        @error($key.'_description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Block Description (Rich Text) --}}
                    <div class="form-group" style="margin-top:12px;">
                        <label>Description (Rich Text) <span class="text-danger">*</span></label>
                        <textarea name="{{ $key }}_description_rich" id="{{ $key }}-desc-rich"
                            class="rich-text {{ $errors->has($key.'_description_rich') ? 'input-error' : '' }}"
                            placeholder="Describe the {{ strtolower($label) }}...">{{ old($key.'_description_rich', $why->{$key.'_description_rich'}) }}</textarea>
                        @error($key.'_description_rich')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Block Image --}}
                    <div class="form-group" style="margin-top:12px;">
                        <label>Background Image <span class="text-danger">*</span></label>
                        <!-- <p class="hint-text">Max <strong>2MB</strong> — JPG, PNG, WEBP</p> -->


                         <div class="upload-guidelines">
                        <span class="guideline-item">
                            <i class="bi bi-file-earmark-image"></i>
                            Accepted: <strong>JPG, PNG, WEBP</strong>
                        </span>
                        <span class="guideline-divider"></span>
                        <span class="guideline-item">
                            <i class="bi bi-hdd"></i>
                            Max size: <strong>10MB</strong> per image
                        </span>
                        <span class="guideline-divider"></span>
                        <span class="guideline-item">
                            <i class="bi bi-aspect-ratio"></i>
                            Recommended: <strong>{{ $imageWidth ?? 580 }} × {{ $imageHeight ?? 300 }}px</strong>
                        </span>
                    </div>

                        <div class="image-upload-box">
                            <div class="preview-wrap">
                                @if ($why->{$key.'_image'})
                                <img src="{{ Storage::url($why->{$key.'_image'}) }}" class="preview-img"
                                    id="preview-{{ $key }}">
                                @else
                                <div class="preview-placeholder" id="preview-{{ $key }}">
                                    <i class="bi bi-image"></i>
                                </div>
                                @endif
                            </div>
                            <label class="upload-btn">
                                <i class="bi bi-upload"></i> Choose file
                                <input type="file" name="{{ $key }}_image" accept="image/*"
                                    onchange="previewImage(this, 'preview-{{ $key }}')" hidden>
                            </label>
                            @error($key.'_image')
                            <span class="field-error d-block mt-2"><i class="bi bi-exclamation-circle"></i>
                                {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Commitment --}}
            <div class="col-md-12">
                <div class="form-card block-card commitment-card">
                    <label class="section-label"><i class="bi bi-shield-check"></i> Commitment</label>

                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" name="commitment_title"
                            value="{{ old('commitment_title', $why->commitment_title) }}"
                            class="{{ $errors->has('commitment_title') ? 'input-error' : '' }}"
                            placeholder="e.g. OUR COMMITMENT">
                        @error('commitment_title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:12px;">
                        <label>Description (Plain Text) <span class="text-danger">*</span></label>
                        <textarea name="commitment_description" rows="4"
                            class="{{ $errors->has('commitment_description') ? 'input-error' : '' }}"
                            placeholder="We are committed to providing...">{{ old('commitment_description', $why->commitment_description) }}</textarea>
                        @error('commitment_description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:12px;">
                        <label>Description (Rich Text) <span class="text-danger">*</span></label>
                        <textarea name="commitment_description_rich" id="commitment-desc-rich"
                            class="rich-text {{ $errors->has('commitment_description_rich') ? 'input-error' : '' }}"
                            placeholder="We are committed to providing...">{{ old('commitment_description_rich', $why->commitment_description_rich) }}</textarea>
                        @error('commitment_description_rich')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Commitment Image --}}
                    <div class="form-group" style="margin-top:12px;">
                        <label>Commitment Image</label>
                        <!-- <p class="hint-text">Max <strong>2MB</strong> — JPG, PNG, WEBP</p> -->
                          <div class="upload-guidelines">
                        <span class="guideline-item">
                            <i class="bi bi-file-earmark-image"></i>
                            Accepted: <strong>JPG, PNG, WEBP</strong>
                        </span>
                        <span class="guideline-divider"></span>
                        <span class="guideline-item">
                            <i class="bi bi-hdd"></i>
                            Max size: <strong>10MB</strong> per image
                        </span>
                        <span class="guideline-divider"></span>
                        <span class="guideline-item">
                            <i class="bi bi-aspect-ratio"></i>
                            Recommended: <strong>{{ $imageWidth ?? 1000 }} × {{ $imageHeight ?? 700 }}px</strong>
                        </span>
                    </div>
                        <div class="image-upload-box">
                            <div class="preview-wrap">
                                @if ($why->commitment_image)
                                <img src="{{ Storage::url($why->commitment_image) }}" class="preview-img"
                                    id="preview-commitment">
                                @else
                                <div class="preview-placeholder" id="preview-commitment">
                                    <i class="bi bi-image"></i>
                                </div>
                                @endif
                            </div>
                            <label class="upload-btn">
                                <i class="bi bi-upload"></i> Choose file
                                <input type="file" name="commitment_image" accept="image/*"
                                    onchange="previewImage(this, 'preview-commitment')" hidden>
                            </label>
                            @error('commitment_image')
                            <span class="field-error d-block mt-2"><i class="bi bi-exclamation-circle"></i>
                                {{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>
            </div>
            {{-- OUR FOUNDATION --}}
            <div class="col-md-12">
                <div class="form-card block-card">
                    <label class="section-label"><i class="bi bi-bank"></i> Our Foundation</label>

                    <div class="form-group">
                        <label>Heading <span class="text-danger">*</span></label>
                        <input type="text" name="foundation_heading"
                            value="{{ old('foundation_heading', $why->foundation_heading) }}"
                            class="{{ $errors->has('foundation_heading') ? 'input-error' : '' }}"
                            placeholder="e.g. Our Foundation">
                        @error('foundation_heading')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:12px;">
                        <label>Description <span class="text-danger">*</span></label>
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
    </div>

    <div class="col-md-12">
        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-lg"></i>
                Save
            </button>
        </div>
    </div>



    {{-- 3. VISION + 4. MISSION --}}


    {{-- 5. OUR FOUNDATION (intro) --}}


    {{-- 6. FOUNDATION LIST (repeater) --}}
    {{-- 6. FOUNDATION LIST (fixed: 2 items) --}}




    </div>
    </div>
</form>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-img';
                    img.id = previewId;
                    preview.replaceWith(img);
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function initRichText(selector) {
        tinymce.init({
            selector: selector,
            height: 250,
            menubar: false,
            plugins: 'lists link image code table',
            toolbar: 'undo redo | bold italic | bullist numlist | link | code',
            branding: false,
            promotion: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initRichText('.rich-text');
    });

</script>

<style>
    .alert {
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-error {
        background: #fdecea;
        color: #c0392b;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .form-header h4 {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #1e1e2d;
    }

    .banner-form {
        width: 100%;
    }

    .form-card {
        background: #fff;
        padding: 22px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        margin-bottom: 18px;
        height: calc(100% - 18px);
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
        font-size: 13px;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
        font-family: inherit;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #3b3b58;
    }

    .section-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-size: 15px;
        color: #1e1e2d;
        margin-bottom: 14px;
    }

    .hint-text {
        font-size: 12px;
        color: #888;
        margin: 4px 0 10px;
    }

    .input-error {
        border-color: #e74c3c !important;
        background: #fff8f8;
    }

    .field-error {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #e74c3c;
        font-size: 12.5px;
        margin-top: 6px;
    }

    .block-card {
        border-top: 3px solid #b40707;
    }

    .commitment-card {
        border-top: 3px solid #3b3b58;
    }

    .image-upload-box {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .preview-wrap {
        width: 100%;
    }

    .preview-img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eee;
        margin-bottom: 10px;
    }

    .preview-placeholder {
        width: 100%;
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f4f6f9;
        border-radius: 6px;
        border: 1px dashed #ddd;
        color: #bbb;
        font-size: 26px;
        margin-bottom: 10px;
    }

    .upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f4f6f9;
        color: #3b3b58;
        padding: 7px 14px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        border: 1px solid #ddd;
    }

    .upload-btn:hover {
        background: #e9ecf2;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 6px;
    }

    .btn-cancel {
        padding: 11px 22px;
        border-radius: 6px;
        border: 1px solid #ddd;
        color: #555;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-cancel:hover {
        background: #f4f6f9;
    }

    .btn-submit {
        display: flex;
        align-items: center;
        gap: 7px;
        background: #3b3b58;
        color: #fff;
        border: none;
        padding: 11px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-submit:hover {
        background: #2b2b42;
    }

    .upload-guidelines {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 15px;
    padding: 9px 14px;
    background: #f4f6f9;
    border: 1px solid #e8eaee;
    border-radius: 6px;
     margin-bottom: 15px;
}

.guideline-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    color: #666;
    white-space: nowrap;
}

.guideline-item i {
    font-size: 13px;
    color: #8b93a1;
}

.guideline-item strong {
    color: #3b3b58;
    font-weight: 600;
}

.guideline-divider {
    width: 1px;
    height: 14px;
    background: #d8dce2;
    flex-shrink: 0;
}

@media (max-width: 600px) {
    .upload-guidelines {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    .guideline-divider {
        display: none;
    }
}

</style>

@endsection
