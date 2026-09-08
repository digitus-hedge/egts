@extends('admin.layout')
@section('title', $behindTheScene->exists ? 'Edit Behind The Scenes' : 'Add Behind The Scenes')
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
        <i class="bi bi-{{ $behindTheScene->exists ? 'pencil-square' : 'plus-circle' }}"></i>
        {{ $behindTheScene->exists ? 'Edit Behind The Scenes' : 'Add Behind The Scenes' }}
    </h4>
    <a href="{{ route('admin.home.services.behind-the-scenes') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Back to list
    </a>
</div>

<form action="{{ $behindTheScene->exists ? route('admin.home.services.behind-the-scenes.update', $behindTheScene->id) : route('admin.home.services.behind-the-scenes.store') }}"
      method="POST" enctype="multipart/form-data" class="banner-form" id="behindTheSceneForm">
    @csrf
    @if ($behindTheScene->exists)
        @method('PUT')
    @endif

    <div class="container-fluid px-0">
        <div class="row">

            {{-- Select Service --}}
            <div class="col-md-8">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-diagram-3"></i> Select Service</label>
                        <select name="service_id" class="{{ $errors->has('service_id') ? 'input-error' : '' }}">
                            <option value="">-- Select Service --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ (int) old('service_id', $behindTheScene->service_id) === $service->id ? 'selected' : '' }}>
                                    {{ $service->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Title --}}
            <div class="col-md-8">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-type"></i> Title</label>
                        <input type="text" name="title" value="{{ old('title', $behindTheScene->title) }}"
                               class="{{ $errors->has('title') ? 'input-error' : '' }}"
                               placeholder="e.g. Precision Machining in Action">
                        @error('title')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-card-text"></i> Description</label>
                        <textarea name="description" rows="3"
                                  class="{{ $errors->has('description') ? 'input-error' : '' }}"
                                  placeholder="Short description of this behind-the-scenes moment...">{{ old('description', $behindTheScene->description) }}</textarea>
                        @error('description')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Media Type Selector --}}
            @php
                $currentType = old('media_type',
                    $behindTheScene->exists
                        ? ($behindTheScene->video ? 'video' : ($behindTheScene->video_url ? 'video_url' : ($behindTheScene->image ? 'image' : '')))
                        : ''
                );
            @endphp

            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-collection-play"></i> Media Source</label>
                    <p class="hint-text">Choose exactly <strong>one</strong> — Upload Video, Video URL, or Upload Image. Switching type will clear the previously saved media.</p>

                    <div class="form-group">
                        <select name="media_type" id="media_type" class="{{ $errors->has('media_type') ? 'input-error' : '' }}">
                            <option value="">-- Select Media Type --</option>
                            <option value="video" {{ $currentType == 'video' ? 'selected' : '' }}>Upload Video</option>
                            <option value="video_url" {{ $currentType == 'video_url' ? 'selected' : '' }}>Video URL</option>
                            <option value="image" {{ $currentType == 'image' ? 'selected' : '' }}>Upload Image</option>
                        </select>
                        @error('media_type')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Video Upload --}}
                    <div class="media-field" id="field-video" style="display:none; margin-top:16px;">
                        <div class="image-upload-box">
                            <div class="preview-wrap">
                                @if ($behindTheScene->video)
                                    <video src="{{ Storage::url($behindTheScene->video) }}" class="preview-img" controls></video>
                                @else
                                    <div class="preview-placeholder">
                                        <i class="bi bi-camera-video"></i>
                                    </div>
                                @endif
                            </div>
                            <label class="upload-btn {{ $errors->has('video') ? 'upload-btn-error' : '' }}">
                                <i class="bi bi-upload"></i> Choose video file
                                <input type="file" name="video" accept="video/*" hidden
                                       onchange="this.closest('.media-field').querySelector('.file-name').textContent = this.files[0]?.name ?? ''">
                            </label>
                            <span class="file-name"></span>
                            @error('video')
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Video URL --}}
                    <div class="media-field" id="field-video_url" style="display:none; margin-top:16px;">
                        <div class="form-group">
                            <label><i class="bi bi-link-45deg"></i> Video URL</label>
                            <input type="url" name="video_url" value="{{ old('video_url', $behindTheScene->video_url) }}"
                                   class="{{ $errors->has('video_url') ? 'input-error' : '' }}"
                                   placeholder="https://www.youtube.com/watch?v=...">
                            @error('video_url')
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Image Upload --}}
                    <div class="media-field" id="field-image" style="display:none; margin-top:16px;">
                        <div class="image-upload-box">
                            <div class="preview-wrap">
                                @if ($behindTheScene->image)
                                    <img src="{{ Storage::url($behindTheScene->image) }}" class="preview-img" id="preview-image">
                                @else
                                    <div class="preview-placeholder" id="preview-image">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <label class="upload-btn {{ $errors->has('image') ? 'upload-btn-error' : '' }}">
                                <i class="bi bi-upload"></i> Choose image
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

            {{-- Sort Order + Status --}}
          

          

            <div class="col-md-12">
                <div class="form-actions">
                    <a href="{{ route('admin.home.services.behind-the-scenes') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        {{ $behindTheScene->exists ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>

<script>
    function toggleMediaFields() {
        const type = document.getElementById('media_type').value;
        document.querySelectorAll('.media-field').forEach(el => el.style.display = 'none');
        if (type) {
            document.getElementById('field-' + type).style.display = 'block';
        }
    }
    document.getElementById('media_type').addEventListener('change', toggleMediaFields);
    document.addEventListener('DOMContentLoaded', toggleMediaFields);

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
    .form-group { margin-bottom: 0; }
    .form-group label { display: flex; align-items: center; gap: 6px; margin-bottom: 7px; font-weight: 600; font-size: 14px; color: #333; }
    .form-group input[type="text"],
    .form-group input[type="url"],
    .form-group input[type="number"],
    .form-group select,
    .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; font-family: inherit; resize: vertical; background: #fff; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #3b3b58; }
    .section-label { display: flex; align-items: center; gap: 6px; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 8px; }
    .hint-text { font-size: 12.5px; color: #888; margin-bottom: 12px; }
    .image-upload-box { display: flex; flex-direction: column; align-items: flex-start; width: 100%; max-width: 300px; }
    .preview-wrap { width: 100%; }
    .preview-img { width: 100%; height: 180px; object-fit: cover; border-radius: 6px; border: 1px solid #eee; margin-bottom: 10px; }
    .preview-placeholder { width: 100%; height: 180px; display: flex; align-items: center; justify-content: center; background: #f4f6f9; border-radius: 6px; border: 1px dashed #ddd; color: #bbb; font-size: 28px; margin-bottom: 10px; }
    .upload-btn { display: inline-flex; align-items: center; gap: 6px; background: #f4f6f9; color: #3b3b58; padding: 7px 14px; border-radius: 6px; font-size: 13px; cursor: pointer; border: 1px solid #ddd; }
    .upload-btn:hover { background: #e9ecf2; }
    .upload-btn-error { border-color: #e74c3c !important; }
    .field-error { display: flex; align-items: center; gap: 5px; color: #e74c3c; font-size: 12.5px; margin-top: 6px; }
    .input-error { border-color: #e74c3c !important; background: #fff8f8; }
    .file-name { font-size: 13px; color: #666; margin-left: 10px; }

    .form-actions { display: flex; gap: 12px; margin-top: 6px; }
    .btn-cancel { padding: 11px 22px; border-radius: 6px; border: 1px solid #ddd; color: #555; text-decoration: none; font-size: 14px; }
    .btn-cancel:hover { background: #f4f6f9; }
    .btn-submit { display: flex; align-items: center; gap: 7px; background: #3b3b58; color: #fff; border: none; padding: 11px 24px; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; }
    .btn-submit:hover { background: #2b2b42; }
</style>

@endsection