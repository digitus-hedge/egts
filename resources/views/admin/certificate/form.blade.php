@extends('admin.layout')
@section('title', $certificate->exists ? 'Edit Certificate' : 'Add Certificate')
@section('content')

@if ($errors->any())
    <div class="alert alert-error">
        <i class="bi bi-exclamation-circle"></i>
        Please fill below fields before submitting
    </div>
@endif

<div class="form-header">
    <h4>
        <i class="bi bi-{{ $certificate->exists ? 'pencil-square' : 'plus-circle' }}"></i>
        {{ $certificate->exists ? 'Edit Certificate' : 'Add Certificate' }}
    </h4>
    <a href="{{ route('admin.home.certificates') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Back to list
    </a>
</div>

<form action="{{ $certificate->exists ? route('admin.home.certificates.update', $certificate->id) : route('admin.home.certificates.store') }}"
      method="POST" enctype="multipart/form-data" class="banner-form">
    @csrf
    @if ($certificate->exists)
        @method('PUT')
    @endif

    <div class="container-fluid px-0">
        <div class="row">

            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-type"></i> Title</label>
                        <input type="text" name="title" value="{{ old('title', $certificate->title) }}"
                               class="{{ $errors->has('title') ? 'input-error' : '' }}"
                               placeholder="e.g. API Q1 Certification">
                        @error('title')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-text-paragraph"></i> Description</label>
                        <textarea name="description" rows="4"
                                  class="{{ $errors->has('description') ? 'input-error' : '' }}"
                                  placeholder="Enter certificate description">{{ old('description', $certificate->description) }}</textarea>
                        @error('description')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-image"></i> Image</label>
                    <p class="hint-text">Accepted: JPG, PNG, WEBP — Max size: <strong>2MB</strong></p>

                    <div class="image-upload-box">
                        <div class="preview-wrap">
                            @if ($certificate->image)
                                <img src="{{ Storage::url($certificate->image) }}" class="preview-img" id="preview-image">
                            @else
                                <div class="preview-placeholder" id="preview-image">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </div>
                        <label class="upload-btn {{ $errors->has('image') ? 'upload-btn-error' : '' }}">
                            <i class="bi bi-upload"></i> Choose file
                            <input type="file" name="image" accept="image/*"
                                   onchange="previewImage(this, 'preview-image')" hidden>
                        </label>
                        @error('image')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-actions">
                    <a href="{{ route('admin.home.certificates') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        {{ $certificate->exists ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>

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
</script>

<style>
    .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; display:flex; align-items:center; gap:8px; }
    .alert-error { background: #fdecea; color: #c0392b; }
    .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
    .form-header h4 { display: flex; align-items: center; gap: 8px; color: #1e1e2d; }
    .btn-back { display: flex; align-items: center; gap: 6px; color: #3b3b58; text-decoration: none; font-size: 14px; }
    .btn-back:hover { text-decoration: underline; }
    .banner-form { width: 100%; }
    .form-card { background: #fff; padding: 22px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 18px; }
    .form-group label { display: flex; align-items: center; gap: 6px; margin-bottom: 7px; font-weight: 600; font-size: 14px; color: #333; }
    .form-group input[type="text"], .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit; resize: vertical; }
    .form-group input:focus, .form-group textarea:focus { border-color: #3b3b58; }
    .section-label { display: flex; align-items: center; gap: 6px; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 8px; }
    .hint-text { font-size: 12.5px; color: #888; margin-bottom: 14px; }
    .image-upload-box { display: flex; flex-direction: column; align-items: flex-start; width: 100%; max-width: 300px; }
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
