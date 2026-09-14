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

    <form action="{{ route('admin.home.license-banner.store') }}" method="POST" enctype="multipart/form-data">
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
                <label class="section-label"><i class="bi bi-image"></i> Banner Image</label>
                <p class="hint-text">Accepted: JPG, PNG, WEBP — Max size: <strong>2MB</strong></p>

                <div class="image-upload-box">
                    <div class="thumb-wrap-lg">
                        @if ($licenseBanner->image)
                            <img src="{{ Storage::url($licenseBanner->image) }}" id="preview-image">
                        @else
                            <i class="bi bi-image" id="preview-image" style="color:var(--faint,#9AA1B2); font-size:28px;"></i>
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

        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-primary">
                <i class="bi bi-check-lg"></i> Save
            </button>
        </div>
    </form>
</div>

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

    .image-upload-box{ display:flex; flex-direction:column; align-items:flex-start; gap:14px; max-width:360px; }
    .thumb-wrap-lg{
        width:100%; height:170px; border-radius:12px; overflow:hidden; border:1px solid var(--line,#E9EBF2);
        background: var(--canvas,#F6F7FB); display:flex; align-items:center; justify-content:center;
    }
    .thumb-wrap-lg img{ width:100%; height:100%; object-fit:cover; display:block; }

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
</style>

@endsection
