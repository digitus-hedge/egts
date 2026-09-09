@extends('admin.layout')
@section('title', 'Projects & Clients - Banner')
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
        <i class="bi bi-diagram-3"></i>
        Projects &amp; Clients - Banner
    </h4>
</div>

<form action="{{ route('admin.home.projects-clients.banner.store') }}" method="POST" enctype="multipart/form-data" class="banner-form">
    @csrf

    <div class="container-fluid px-0">
        <div class="row">

            {{-- Banner section --}}
            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-image"></i> Page Hero / Banner</label>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ old('title', $projectsClientsBanner->title) }}"
                               class="{{ $errors->has('title') ? 'input-error' : '' }}"
                               placeholder="e.g. Trusted by Industry Leaders Worldwide">
                        @error('title')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:16px;">
                        <label>Content</label>
                        <textarea name="content" rows="3"
                                  class="{{ $errors->has('content') ? 'input-error' : '' }}"
                                  placeholder="Short supporting text under the banner title...">{{ old('content', $projectsClientsBanner->content) }}</textarea>
                        @error('content')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:16px;">
                        <label>Banner Image</label>
                        <p class="hint-text">Accepted: JPG, PNG, WEBP — Max size: <strong>2MB</strong></p>

                        <div class="image-upload-box">
                            <div class="preview-wrap">
                                @if ($projectsClientsBanner->image)
                                    <img src="{{ Storage::url($projectsClientsBanner->image) }}" class="preview-img" id="preview-image">
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
            </div>

            {{-- Page content section --}}
            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-file-text"></i> Page Content</label>

                    <div class="form-group" style="margin-top:16px;">
                        <label>Description</label>
                        <textarea name="description" rows="5"
                                  class="{{ $errors->has('description') ? 'input-error' : '' }}"
                                  placeholder="Describe the partnership narrative shown above the client logo grid...">{{ old('description', $projectsClientsBanner->description) }}</textarea>
                        @error('description')
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
