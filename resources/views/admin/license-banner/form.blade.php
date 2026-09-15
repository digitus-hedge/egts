@extends('admin.layout')
@section('title', 'Licenses Page - Banner')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Done!',
            text: @json(session('success')),
            confirmButtonColor: '#BF0001',
            timer: 2200,
            timerProgressBar: true
        });
    });
</script>
@endif

<div class="wrap">
    <div class="crumbs">
        <span onclick="window.location='{{ route('admin.dashboard') }}'">Home</span>
        <span>&rsaquo;</span>
        <b>Licenses Banner</b>
    </div>

    <div class="page-header">
        <div>
            <h1>Licenses Page - Banner</h1>
            <p>The hero banner shown at the top of your public Licenses page.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            <i class="bi bi-exclamation-circle"></i>
            Please fill below fields before submitting
        </div>
    @endif

    <form action="{{ route('admin.home.license-banner.store') }}" method="POST" enctype="multipart/form-data"  id="licenseBannerForm">
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $licenseBanner->title) }}"
                           class="{{ $errors->has('title') ? 'input-error' : '' }}"
                           placeholder="e.g. Certifications &amp; Licenses">
                    @error('title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-top:18px;">
                    <label>Description</label>
                    <textarea name="description" rows="4"
                              class="{{ $errors->has('description') ? 'input-error' : '' }}"
                              placeholder="Enter banner description">{{ old('description', $licenseBanner->description) }}</textarea>
                    @error('description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

     <div class="card" style="margin-top:20px;">
    <div class="card-body">
        <label class="section-label"><i class="bi bi-image"></i> Banner Image or Video</label>

        <div class="notice caution">
            <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
            <p><b>Image:</b> {{ $imageWidth ?? 1200 }} &times; {{ $imageHeight ?? 600 }}px &middot; JPG, PNG, WEBP &middot; up to 10MB.
               <b>Video:</b> MP4, MOV, WEBM &middot; up to 20MB.</p>
        </div>

        <div class="media-row">
            {{-- Image upload --}}
            <div class="image-upload-box">
                <span class="slot-label">Banner Image</span>
                <div class="thumb-wrap-lg" id="thumb-wrap-image">
                    @if ($licenseBanner->image)
                        <img src="{{ Storage::url($licenseBanner->image) }}" id="preview-image">
                        <button type="button" class="remove-img-btn" onclick="removeLicenseImage(event)" title="Remove image">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    @else
                        <i class="bi bi-image" id="preview-image" style="color:var(--faint,#9AA1B2); font-size:28px;"></i>
                    @endif
                </div>
                <label class="upload-btn {{ $errors->has('image') ? 'upload-btn-error' : '' }}">
                    <i class="bi bi-upload"></i> Choose file
                    <input type="file" id="file-license-image" name="image" accept="image/*"
                           onchange="previewLicenseImage(this)" hidden>
                </label>
                <input type="hidden" name="remove_image" id="remove-image" value="0">
                @error('image')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>

            {{-- Video upload --}}
            <div class="image-upload-box">
                <span class="slot-label">Banner Video</span>
                <div class="thumb-wrap-lg" id="thumb-wrap-video">
                    @if ($licenseBanner->video)
                        <video src="{{ Storage::url($licenseBanner->video) }}" id="preview-video" muted playsinline preload="metadata"></video>
                        <button type="button" class="remove-img-btn" onclick="removeLicenseVideo(event)" title="Remove video">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    @else
                        <i class="bi bi-camera-video" id="preview-video" style="color:var(--faint,#9AA1B2); font-size:28px;"></i>
                    @endif
                </div>
                <label class="upload-btn {{ $errors->has('video') ? 'upload-btn-error' : '' }}">
                    <i class="bi bi-upload"></i> Choose file
                    <input type="file" id="file-license-video" name="video" accept="video/*"
                           onchange="previewLicenseVideo(this)" hidden>
                </label>
                <input type="hidden" name="remove_video" id="remove-video" value="0">
                @error('video')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>


 <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-search"></i></span> SEO Meta</h2>
            </div>

            <div class="field">
                <div class="field-top">
                    <label class="field-label">Meta Title</label>
                </div>
                <input type="text" name="meta_title" value="{{ old('meta_title', $licenseBanner->meta_title) }}"
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
                          placeholder="SEO description shown in search results">{{ old('meta_description', $licenseBanner->meta_description) }}</textarea>
                @error('meta_description')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-primary">
                <i class="bi bi-check-lg"></i> Save
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('licenseBannerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    submitLicenseBannerForm();
});

function submitLicenseBannerForm() {
    const form = document.getElementById('licenseBannerForm');
    const formData = new FormData(form);
    const submitBtn = form.querySelector('.btn-primary');
    const originalBtnHtml = submitBtn.innerHTML;

    form.querySelectorAll('.field-error').forEach(el => el.remove());
    form.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
    form.querySelectorAll('.upload-btn-error').forEach(el => el.classList.remove('upload-btn-error'));

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(async (response) => {
        const data = await response.json().catch(() => null);

        if (response.status === 422 && data && data.errors) {
            showLicenseBannerValidationErrors(data.errors);
            return;
        }

        if (!response.ok) {
            throw new Error('Request failed');
        }

        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: (data && data.message) ? data.message : 'License banner updated successfully.',
            confirmButtonColor: '#BF0001',
            timer: 2000,
            timerProgressBar: true
        }).then(() => {
            window.location.reload();
        });
    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something went wrong. Please try again.',
            confirmButtonColor: '#BF0001'
        });
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
    });
}

function showLicenseBannerValidationErrors(errors) {
    const form = document.getElementById('licenseBannerForm');

    const fieldMap = {
        title: f => f.querySelector('[name="title"]'),
        description: f => f.querySelector('[name="description"]'),
        image: f => f.querySelector('#file-license-image').closest('.image-upload-box').querySelector('.upload-btn'),
        video: f => f.querySelector('#file-license-video').closest('.image-upload-box').querySelector('.upload-btn'),
    };

    Object.keys(errors).forEach(field => {
        const message = errors[field][0];
        const target = fieldMap[field] ? fieldMap[field](form) : null;
        if (!target) return;

        if (field === 'image' || field === 'video') {
            target.classList.add('upload-btn-error');
        } else {
            target.classList.add('input-error');
        }

        const errorEl = document.createElement('span');
        errorEl.className = 'field-error';
        errorEl.innerHTML = `<i class="bi bi-exclamation-circle"></i> ${message}`;
        target.insertAdjacentElement('afterend', errorEl);
    });

    const firstErrorField = form.querySelector('.input-error, .upload-btn-error');
    if (firstErrorField) {
        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}
</script>
<script>
function previewLicenseImage(input) {
    const wrap = document.getElementById('thumb-wrap-image');
    if (!wrap || !input.files || !input.files[0]) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        wrap.innerHTML = `
            <img src="${e.target.result}" id="preview-image">
            <button type="button" class="remove-img-btn" onclick="removeLicenseImage(event)" title="Remove image">
                <i class="bi bi-x-lg"></i>
            </button>
        `;
        document.getElementById('remove-image').value = '0';
    };
    reader.readAsDataURL(input.files[0]);
}

function removeLicenseImage(event) {
    event.stopPropagation();
    document.getElementById('remove-image').value = '1';
    document.getElementById('file-license-image').value = '';

    const wrap = document.getElementById('thumb-wrap-image');
    wrap.innerHTML = `<i class="bi bi-image" id="preview-image" style="color:var(--faint,#9AA1B2); font-size:28px;"></i>`;
}
</script>

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
                    img.id = previewId;
                    preview.replaceWith(img);
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


    function previewLicenseVideo(input) {
    const wrap = document.getElementById('thumb-wrap-video');
    if (!wrap || !input.files || !input.files[0]) return;

    const videoURL = URL.createObjectURL(input.files[0]);

    wrap.innerHTML = `
        <video src="${videoURL}" id="preview-video" muted playsinline preload="metadata"></video>
        <button type="button" class="remove-img-btn" onclick="removeLicenseVideo(event)" title="Remove video">
            <i class="bi bi-x-lg"></i>
        </button>
    `;
    document.getElementById('remove-video').value = '0';
}

function removeLicenseVideo(event) {
    event.stopPropagation();

    const wrap = document.getElementById('thumb-wrap-video');
    const existingVideo = wrap.querySelector('video');
    if (existingVideo && existingVideo.src.startsWith('blob:')) {
        URL.revokeObjectURL(existingVideo.src);
    }

    document.getElementById('remove-video').value = '1';
    document.getElementById('file-license-video').value = '';

    wrap.innerHTML = `<i class="bi bi-camera-video" id="preview-video" style="color:var(--faint,#9AA1B2); font-size:28px;"></i>`;
}
</script>

<style>
    .crumbs{ display:flex; align-items:center; gap:8px; font-size:13px; color: var(--faint,#9AA1B2); margin-bottom:10px; }
    .crumbs b{ color: var(--ink,#171B2C); font-weight:600; }
    .crumbs span:first-child{ cursor:pointer; transition:color .15s; }
    .crumbs span:first-child:hover{ color: var(--orange,#BF0001); }

    .page-header{ display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:24px; gap:16px; flex-wrap:wrap; }
    .page-header h1{ font-size:25px; font-weight:700; letter-spacing:-0.02em; margin:0; color: var(--ink,#171B2C); }
    .page-header p{ font-size:13.5px; color: var(--muted,#667085); margin:7px 0 0; max-width:460px; line-height:1.55; }

    .alert-error{
        display:flex; align-items:center; gap:8px; font-size:13.5px; color:#E9483F;
        background:#FDEDEC; border:1px solid #FADBD8; border-radius:10px; padding:12px 16px; margin-bottom:18px;
    }

    .card{
        background:#fff; border:1px solid var(--line,#E9EBF2); border-radius:16px;
        box-shadow:0 1px 2px rgba(15,21,38,0.03), 0 8px 24px -16px rgba(15,21,38,0.10);
        overflow:hidden;
    }
    .card-body{ padding:24px; }

    .form-group label{ display:block; font-size:13px; font-weight:700; color: var(--ink,#171B2C); margin-bottom:8px; }
    .form-group input[type="text"], .form-group textarea{
        width:100%; padding:11px 13px; border:1px solid var(--input-border,#DBDFEA); border-radius:10px;
        font-size:13.5px; color: var(--ink,#171B2C); outline:none; font-family:inherit; resize:vertical;
        background:#FAFBFD; transition:border-color .15s, box-shadow .15s;
    }
    .form-group input:focus, .form-group textarea:focus{
        border-color: var(--orange,#BF0001); box-shadow:0 0 0 4px var(--orange-tint-strong,#FFE9D8); background:#fff;
    }

    .section-label{ display:flex; align-items:center; gap:7px; font-size:13px; font-weight:700; color: var(--ink,#171B2C); margin-bottom:6px; }
    .hint-text{ font-size:12px; color: var(--faint,#9AA1B2); margin:0 0 16px; }

    .input-error{ border-color:#E9483F !important; background:#FFF8F8 !important; }
    .upload-btn-error{ border-color:#E9483F !important; }
    .field-error{ display:flex; align-items:center; gap:5px; color:#E9483F; font-size:12.5px; margin-top:7px; }

  .image-upload-box{
    display:flex;
    flex-direction:column;
    align-items:flex-start;
    gap:14px;
    width:360px;        /* was: max-width:360px */
    flex-shrink:0;      /* prevent it from shrinking below 360px in the flex row */
}

/* ADD THIS */
.media-row{
    display:flex;
    gap:24px;
    flex-wrap:wrap;
    align-items:flex-start;
}
   .thumb-wrap-lg{
    position: relative;
    width:100%; height:170px; border-radius:12px; overflow:hidden; border:1px solid var(--line,#E9EBF2);
    background: var(--canvas,#F6F7FB); display:flex; align-items:center; justify-content:center;
}
.thumb-wrap-lg img{ width:100%; height:100%; object-fit:cover; display:block; }


.thumb-wrap-lg video{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.thumb-wrap-lg .remove-img-btn{
    position:absolute; top:8px; right:8px; width:28px; height:28px; border-radius:999px;
    background:rgba(0,0,0,0.6); border:none; color:#fff; display:flex; align-items:center;
    justify-content:center; cursor:pointer; transition:background .15s; z-index:3; font-size:13px;
}
.thumb-wrap-lg .remove-img-btn:hover{ background:rgba(0,0,0,0.85); }

    .upload-btn{
        display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color: var(--ink,#171B2C);
        background:#fff; border:1px solid var(--input-border,#DBDFEA); border-radius:9px; padding:10px 16px;
        cursor:pointer; transition:border-color .15s, background .15s;
    }
    .upload-btn:hover{ border-color: var(--orange,#BF0001); background: var(--orange-tint-strong,#FFE9D8); }

    .form-actions{ display:flex; gap:12px; margin-top:22px; }
    .btn-cancel{
        display:flex; align-items:center; padding:11px 20px; border-radius:9px; border:1px solid var(--input-border,#DBDFEA);
        color: var(--muted,#667085); text-decoration:none; font-size:13px; font-weight:600; background:#fff;
        transition:border-color .15s, color .15s;
    }
    .btn-cancel:hover{ border-color: var(--orange,#BF0001); color: var(--orange,#BF0001); }

    .btn-primary{
        display:flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:#fff;
        background:linear-gradient(135deg, #0F1526, #1D2439); border:none; text-decoration:none;
        padding:11px 22px; border-radius:9px; cursor:pointer; white-space:nowrap;
        box-shadow:0 4px 12px -4px rgba(15,21,38,0.4);
        transition:transform .12s ease, box-shadow .12s ease;
    }
    .btn-primary:hover{ transform:translateY(-1px); box-shadow:0 8px 18px -6px rgba(15,21,38,0.5); color:#fff; }

        .notice{ margin-top:16px; display:flex; align-items:flex-start; gap:8px; background: var(--canvas,#F6F7FB); border-radius:10px; padding:10px 12px; }
    .notice p{ font-size:12px; color: var(--muted,#667085); margin:0; }
    .notice.caution{ background:#FFF8E8; border:1px solid #F5E3B3; margin-top:0; margin-bottom:16px; }
    .notice.caution i{ color:#B7791F; }
    .notice.caution p{ color:#8A6116; }
    .notice.caution p b{ color:#6B4A0E; font-weight:700; }
    .exclusivity-note{ margin-bottom:0; }


    .video-drop{
    position:relative; height:190px; border-radius:12px;
    border:2px dashed var(--input-border,#DBDFEA); background:#FAFBFD;
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    cursor:pointer; overflow:hidden; transition:border-color .15s, background .15s; text-align:center;
}
.video-drop:hover{ border-color: var(--orange,#BF0001); background: var(--orange-tint,#FFF8F3); }
.video-drop.has-file .drop-title{ color: var(--green,#12875A); }
.video-drop.input-error{ border-color:#e74c3c; background:#fff8f8; }

/* ===== Video preview state (filled) ===== */
.video-drop.filled{
    border:2px solid transparent;
    cursor:default;
}

.video-drop video{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
    background:#0F1220;
}

.video-drop .uploaded-tag{
    position:absolute;
    left:0; right:0; bottom:0;
    padding:8px 12px;
    background:linear-gradient(to top, rgba(0,0,0,0.55), transparent);
    color:rgba(255,255,255,0.9);
    font-size:11px;
    display:flex;
    align-items:center;
    gap:4px;
    pointer-events:none;
}

.images-row{
    display:flex;
    gap:16px;
    flex-wrap:wrap;
    align-items:flex-start;
}

.slot-label {
    font-size: 12px;
    font-weight: 500;
    color: var(--muted, #667085);
}

.slot-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}

.image-slot{
    flex:1;
    min-width:260px;
}

/* Make image drop use the same fixed height as video-drop instead of aspect-ratio */
.drop{
    position:relative;
    height:190px;               /* was: aspect-ratio:4/3 */
    border-radius:12px;
    border:2px dashed var(--input-border,#DBDFEA);
    background:#FAFBFD;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    overflow:hidden;
    transition:border-color .15s, background .15s;
    text-align:center;
}
.video-btn-spacer{
    margin-top:8px;
    height:35px; /* matches .choose-btn's total rendered height (padding + border + line-height) */
}


.section-title{ display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:6px; }
    .section-title h2{ display:flex; align-items:center; gap:8px; font-size:14px; font-weight:700; margin:0; color: var(--ink,#171B2C); }
    .icon{ display:inline-flex; color: var(--orange,#BF0001); }

    .field{ margin-bottom:22px; }
    .field-top{ display:flex; align-items:baseline; justify-content:space-between; margin-bottom:8px; }
    .field-label{ display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; color: var(--ink,#171B2C); }
  input[type=text], textarea{
        width:100%; border:1px solid var(--input-border,#DBDFEA); border-radius:10px;
        padding:11px 14px; font-size:14px; font-family:inherit; color: var(--ink,#171B2C);
        outline:none; transition:box-shadow .15s, border-color .15s; resize:vertical;
    }
    input[type=text]:focus, textarea:focus{
        border-color: var(--orange,#BF0001);
        box-shadow: 0 0 0 4px var(--orange-tint-strong,#FFE9D8);
    }
</style>

@endsection
