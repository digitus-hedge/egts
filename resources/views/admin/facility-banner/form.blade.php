@extends('admin.layout')
@section('title', 'Facility & Capabilities - Banner')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->any())
    <div class="alert alert-error">
        <i class="bi bi-exclamation-circle"></i>
        Please fill below fields before submitting
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
        <i class="bi bi-building"></i>
        Facility &amp; Capabilities - Banner
    </h4>
</div>

<form action="{{ route('admin.home.facility.banner.store') }}" method="POST" enctype="multipart/form-data" class="banner-form" id="facilityForm">
    @csrf

    <div class="container-fluid px-0">
        <div class="row">

            {{-- Banner section --}}
            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-image"></i> Page Hero / Banner</label>

                    <div class="form-group">
                        <label>Banner Title</label>
                        <input type="text" name="banner_title" value="{{ old('banner_title', $facilityBanner->banner_title) }}"
                               class="{{ $errors->has('banner_title') ? 'input-error' : '' }}"
                               placeholder="e.g. Our Modern Facility: Advanced Machining & Precision">
                        @error('banner_title')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:16px;">
                        <label>Banner Description</label>
                        <textarea name="banner_description" rows="3"
                                  class="{{ $errors->has('banner_description') ? 'input-error' : '' }}"
                                  placeholder="Showcase of the modern Ankawa facility, advanced CNC infrastructure, and precision measuring tools.">{{ old('banner_description', $facilityBanner->banner_description) }}</textarea>
                        @error('banner_description')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:16px;">
                        <label>Banner Image</label>
                        <p class="hint-text">Accepted: JPG, PNG, WEBP — Max size: <strong>2MB</strong></p>

                        <div class="image-upload-box">
                            <div class="preview-wrap">
                                @if ($facilityBanner->banner_image)
                                    <img src="{{ Storage::url($facilityBanner->banner_image) }}" class="preview-img" id="preview-banner-image">
                                @else
                                    <div class="preview-placeholder" id="preview-banner-image">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <label class="upload-btn {{ $errors->has('banner_image') ? 'upload-btn-error' : '' }}">
                                <i class="bi bi-upload"></i> Choose file
                                <input type="file" name="banner_image" accept="image/*"
                                       onchange="previewImage(this, 'preview-banner-image')" hidden>
                            </label>
                            @error('banner_image')
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Operations section --}}
            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-gear"></i> Ankawa Operations</label>

                    <div class="form-group">
                        <label>Operations Heading</label>
                        <input type="text" name="operations_heading" value="{{ old('operations_heading', $facilityBanner->operations_heading) }}"
                               class="{{ $errors->has('operations_heading') ? 'input-error' : '' }}"
                               placeholder="e.g. Ankawa Operations & Infrastructure">
                        @error('operations_heading')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:16px;">
                        <label>Operations Description</label>
                        <textarea name="operations_description" rows="5"
                                  class="{{ $errors->has('operations_description') ? 'input-error' : '' }}"
                                  placeholder="Describe the Ankawa facility narrative and infrastructure highlights...">{{ old('operations_description', $facilityBanner->operations_description) }}</textarea>
                        @error('operations_description')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Infrastructure section (CKEditor) --}}
            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-cpu"></i> Advanced CNC Infrastructure</label>

                    <div class="form-group">
                        <label>Infrastructure Title</label>
                        <input type="text" name="infrastructure_title" value="{{ old('infrastructure_title', $facilityBanner->infrastructure_title) }}"
                               class="{{ $errors->has('infrastructure_title') ? 'input-error' : '' }}"
                               placeholder="e.g. Advanced CNC Infrastructure">
                        @error('infrastructure_title')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:16px;">
                        <label>Infrastructure Description</label>
                        <textarea id="infrastructure_description" name="infrastructure_description" rows="8">{{ old('infrastructure_description', $facilityBanner->infrastructure_description) }}</textarea>
                        @error('infrastructure_description')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
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

        </div>
    </div>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#infrastructure_description'))
        .catch(error => console.error(error));

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
</script>

<style>
    .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; display:flex; align-items:center; gap:8px; }
    .alert-error { background: #fdecea; color: #c0392b; }
    .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
    .form-header h4 { display: flex; align-items: center; gap: 8px; color: #1e1e2d; }
    .banner-form { width: 100%; }
    .form-card { background: #fff; padding: 22px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 18px; }
    .form-group label { display: block; margin-bottom: 7px; font-weight: 600; font-size: 14px; color: #333; }
    .form-group input[type="text"], .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit; resize: vertical; }
    .form-group input:focus, .form-group textarea:focus { border-color: #3b3b58; }
    .section-label { display: flex; align-items: center; gap: 6px; font-weight: 700; font-size: 15px; color: #1e1e2d; margin-bottom: 16px; }
    .hint-text { font-size: 12.5px; color: #888; margin-bottom: 10px; }
    .image-upload-box { display: flex; flex-direction: column; align-items: flex-start; width: 100%; max-width: 350px; }
    .preview-wrap { width: 100%; }
    .preview-img { width: 100%; height: 160px; object-fit: cover; border-radius: 6px; border: 1px solid #eee; margin-bottom: 10px; }
    .preview-placeholder { width: 100%; height: 160px; display: flex; align-items: center; justify-content: center; background: #f4f6f9; border-radius: 6px; border: 1px dashed #ddd; color: #bbb; font-size: 28px; margin-bottom: 10px; }
    .upload-btn { display: inline-flex; align-items: center; gap: 6px; background: #f4f6f9; color: #3b3b58; padding: 7px 14px; border-radius: 6px; font-size: 13px; cursor: pointer; border: 1px solid #ddd; }
    .upload-btn:hover { background: #e9ecf2; }
    .input-error { border-color: #e74c3c !important; background: #fff8f8; }
    .field-error { display: flex; align-items: center; gap: 5px; color: #e74c3c; font-size: 12.5px; margin-top: 6px; }
    .form-actions { display: flex; gap: 12px; margin-top: 6px; }
    .btn-cancel { padding: 11px 22px; border-radius: 6px; border: 1px solid #ddd; color: #555; text-decoration: none; font-size: 14px; }
    .btn-cancel:hover { background: #f4f6f9; }
    .btn-submit { display: flex; align-items: center; gap: 7px; background: #3b3b58; color: #fff; border: none; padding: 11px 24px; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; }
    .btn-submit:hover { background: #2b2b42; }
</style>

@endsection
