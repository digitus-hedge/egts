@extends('admin.layout')
@section('title', $behindTheScene->exists ? 'Edit Behind The Scenes' : 'Add Behind The Scenes')
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
        <span onclick="window.location='{{ route('admin.home.services.behind-the-scenes') }}'">Behind The Scenes</span>
        <span>&rsaquo;</span>
        <b>{{ $behindTheScene->exists ? 'Edit' : 'Add New' }}</b>
    </div>

    <div class="header">
        <div>
            <h1>{{ $behindTheScene->exists ? 'Edit Behind The Scenes' : 'Add Behind The Scenes' }}</h1>
            <p>A media moment shown in the Behind The Scenes section, linked to a specific service.</p>
        </div>
        <a href="{{ route('admin.home.services.behind-the-scenes') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to list
        </a>
    </div>

    <form action="{{ $behindTheScene->exists ? route('admin.home.services.behind-the-scenes.update', $behindTheScene->id) : route('admin.home.services.behind-the-scenes.store') }}"
          method="POST" enctype="multipart/form-data" id="behindTheSceneForm">
        @csrf
        @if ($behindTheScene->exists)
            @method('PUT')
        @endif

        {{-- Select Service + Title --}}
        <div class="card">
            <div class="two-col">
                <div class="field" style="margin-bottom:0;">
                    <div class="field-top">
                        <label class="field-label">Select Service <span class="req">*</span></label>
                    </div>
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

                <div class="field" style="margin-bottom:0;">
                    <div class="field-top">
                        <label class="field-label">Title <span class="req">*</span></label>
                    </div>
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
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-card-text"></i></span> Description <span class="req">*</span></h2>
            </div>
            <div class="field" style="margin-bottom:0;">
                <textarea name="description" rows="3"
                          class="{{ $errors->has('description') ? 'input-error' : '' }}"
                          placeholder="Short description of this behind-the-scenes moment...">{{ old('description', $behindTheScene->description) }}</textarea>
                @error('description')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Media Source --}}
        @php
            $currentType = old('media_type',
                $behindTheScene->exists
                    ? ($behindTheScene->video ? 'video' : ($behindTheScene->video_url ? 'video_url' : ($behindTheScene->image ? 'image' : '')))
                    : ''
            );
        @endphp

        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-collection-play"></i></span> Media Source  <span class="req">*</span></h2>
            </div>
            <p class="section-sub" style="margin:0 0 16px;">Choose exactly <b>one</b> — Upload Video, Video URL, or Upload Image. Switching type will clear the previously saved media.</p>

            <div class="field">
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
            <div class="media-field" id="field-video" style="display:none;">
                <div class="notice caution">
                    <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                    <p>Recommended format: MP4, MOV, AVI, WEBM &middot; up to 20MB</p>

                    
                </div>

                <div class="image-slot" style="max-width:400px;">
                    <div class="drop video-drop-slot {{ $behindTheScene->video ? 'filled' : '' }}">
                        @if ($behindTheScene->video)
                            <video src="{{ Storage::url($behindTheScene->video) }}" controls></video>
                        @else
                            <div class="preview-placeholder">
                                <div class="ico-circle"><i class="bi bi-camera-video" style="color:#AEB4C4;font-size:18px;"></i></div>
                                <div class="drop-title">No video uploaded</div>
                            </div>
                        @endif
                    </div>
                    <label class="choose-btn inline" style="cursor:pointer;">
                        <i class="bi bi-upload"></i> Choose video file
                        <input type="file" name="video" accept="video/*" hidden
                               onchange="this.closest('.media-field').querySelector('.file-name').textContent = this.files[0]?.name ?? ''">
                    </label>
                    <span class="field-hint file-name" style="display:block; margin-top:6px;"></span>
                </div>
                @error('video')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>

            {{-- Video URL --}}
            <div class="media-field" id="field-video_url" style="display:none;">
                <div class="field" style="margin-bottom:0;">
                    <div class="field-top">
                        <label class="field-label">Video URL</label>
                    </div>
                    <input type="url" name="video_url" value="{{ old('video_url', $behindTheScene->video_url) }}"
                           class="{{ $errors->has('video_url') ? 'input-error' : '' }}"
                           placeholder="https://www.youtube.com/watch?v=...">
                    <span class="field-hint" style="display:block; margin-top:8px;">YouTube, Vimeo, or direct video links.</span>
                    @error('video_url')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Image Upload --}}
            <div class="media-field" id="field-image" style="display:none;">
                <div class="notice caution">
                    <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                    <p><b>Recommended size:</b> {{ $imageWidth ?? 380 }} &times; {{ $imageHeight ?? 260 }}px &middot; JPG, PNG, WEBP &middot; up to 10MB</p>
                </div>

                <div class="image-slot" style="max-width:340px;">
                    <div class="drop img-slot {{ $behindTheScene->image ? 'filled' : '' }}" onclick="document.getElementById('file-image-input').click()">
                        @if ($behindTheScene->image)
                            <img src="{{ Storage::url($behindTheScene->image) }}" id="preview-image" alt="Behind the scenes image">
                            <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                        @else
                            <div class="preview-placeholder" id="preview-image">
                                <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                                <div class="drop-title">Click to upload</div>
                                <div class="drop-sub">or drag &amp; drop</div>
                            </div>
                        @endif
                    </div>
                    <input type="file" id="file-image-input" name="image" accept="image/*" hidden
                           onchange="previewImage(this, 'preview-image')">
                    @if (!$behindTheScene->image)
                        <button type="button" class="choose-btn" onclick="document.getElementById('file-image-input').click()">Choose file</button>
                    @endif
                </div>
                @error('image')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="savebar">
            <div class="savebar-inner">
                <span class="savebar-status">All changes save to the live Behind The Scenes section</span>
                <div class="btn-group">
                    <a href="{{ route('admin.home.services.behind-the-scenes') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        {{ $behindTheScene->exists ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

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
                    img.id = previewId;
                    preview.replaceWith(img);
                }
                const drop = document.querySelector('.img-slot');
                if (drop) drop.classList.add('filled');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fieldOrder = ['service_id', 'title', 'description', 'media_type', 'video', 'video_url', 'image'];

    const errorFields = @json(array_keys($errors->getMessages()));
    if (errorFields.length === 0) return;

    let targetName = fieldOrder.find(name => errorFields.includes(name)) || errorFields[0];

    let field = document.querySelector(`[name="${targetName}"]`);

    const mediaFieldWrapperMap = { video: '#field-video', video_url: '#field-video_url', image: '#field-image' };

    if (mediaFieldWrapperMap[targetName]) {
        const wrapper = document.querySelector(mediaFieldWrapperMap[targetName]);
        if (wrapper) {
            document.querySelectorAll('.media-field').forEach(el => el.style.display = 'none');
            wrapper.style.display = 'block';

            const mediaTypeSelect = document.getElementById('media_type');
            if (mediaTypeSelect) mediaTypeSelect.value = targetName;
        }
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
    .section-sub{ font-size:12px; color: var(--faint,#9AA1B2); }

    .two-col{ display:grid; grid-template-columns:1fr 1fr; gap:24px; }
    @media (max-width:700px){ .two-col{ grid-template-columns:1fr; } }

    .field{ margin-bottom:22px; }
    .field-top{ display:flex; align-items:baseline; justify-content:space-between; margin-bottom:8px; }
    .field-label{ display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; color: var(--ink,#171B2C); }
    .field-hint{ font-size:11.5px; color: var(--faint,#9AA1B2); }

    input[type=text], input[type=url], textarea, select{
        width:100%; border:1px solid var(--input-border,#DBDFEA); border-radius:10px;
        padding:11px 14px; font-size:14px; font-family:inherit; color: var(--ink,#171B2C);
        outline:none; transition:box-shadow .15s, border-color .15s; resize:vertical; background:#fff;
    }
    select{ cursor:pointer; }
    input:focus, textarea:focus, select:focus{
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

    .media-field{ margin-top:20px; padding-top:20px; border-top:1px solid var(--line,#E9EBF2); }

    .drop{
        position:relative; aspect-ratio:4/3; border-radius:12px;
        border:2px dashed var(--input-border,#DBDFEA); background:#FAFBFD;
        display:flex; flex-direction:column; align-items:center; justify-content:center;
        cursor:pointer; overflow:hidden; transition:border-color .15s, background .15s; text-align:center;
    }
    .drop:hover{ border-color: var(--orange,#EF7B2E); background: var(--orange-tint,#FFF8F3); }
    .drop.filled{ border:2px solid transparent; background:#0F1220; cursor:default; }
    .drop img{ width:100%; height:100%; object-fit:cover; display:block; }
    .video-drop-slot{ aspect-ratio:16/9; cursor:default; }
    .video-drop-slot video{ width:100%; height:100%; object-fit:cover; display:block; }
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

    .scroll-error-highlight{
        /* outline:3px solid #e74c3c !important; outline-offset:4px; border-radius:12px;
        animation:scrollErrorPulse 0.6s ease-in-out 2; */
    }
    @keyframes scrollErrorPulse{
        /* 0%, 100% { outline-color:#e74c3c; }
        50% { outline-color:#ff8a80; } */
    }
</style>

@endsection