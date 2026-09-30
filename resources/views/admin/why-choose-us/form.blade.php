@extends('admin.layout')
@section('title', 'Why Choose Us Section')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- TinyMCE rich text editor (self-hosted build via CDN, no API key needed) --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" referrerpolicy="origin"></script>

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
            confirmButtonColor: '#BF0001',
            timer: 2500,
            timerProgressBar: true
        });
    });
</script>
@endif

<div class="wrap">
    <div class="crumbs">
        <span onclick="window.location='{{ route('admin.dashboard') }}'">Home</span>
        <span>&rsaquo;</span>
        <b>Why Choose Us</b>
    </div>

    <div class="header">
        <div>
            <h1>Why Choose Us Section</h1>
            <p>The heading and supporting description shown in the "Why Choose Us" block on your homepage.</p>
        </div>
    </div>

    <form action="{{ route('admin.home.why-choose-us.store') }}" method="POST" enctype="multipart/form-data" id="whyChooseUsForm">
        @csrf

        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-type-h1"></i></span> Heading &amp; Description</h2>
            </div>

            <div class="field">
                <div class="field-top">
                    <label class="field-label">Heading <span class="req">*</span></label>
                </div>
                <input type="text" name="heading" value="{{ old('heading', $why->heading) }}"
                       class="{{ $errors->has('heading') ? 'input-error' : '' }}"
                       placeholder="e.g. Quality and accountability in every operation.">
                @error('heading')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <div class="field-top">
                    <label class="field-label">Description <span class="req">*</span></label>
                </div>

                <div class="rte-wrap {{ $errors->has('description') ? 'input-error' : '' }}">
                    <textarea name="description" id="descriptionInput" rows="8"
                              placeholder="Our approach is built around...">{{ old('description', $why->description) }}</textarea>
                </div>

                @error('description')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="savebar">
            <div class="savebar-inner">
                <span class="savebar-status">All changes save to the live homepage</span>
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
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // ===== TinyMCE rich text editor for Description =====
    tinymce.init({
        selector: '#descriptionInput',
        license_key: 'gpl',            // free self-hosted (GPL) build
        height: 280,
        menubar: false,
        branding: false,
        promotion: false,
        statusbar: false,
        plugins: 'lists link autolink code',
        toolbar: 'blocks | bold italic underline strikethrough | forecolor | ' +
                 'alignleft aligncenter alignright | bullist numlist | link blockquote | removeformat code',
        block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
        content_style: "body{ font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; font-size:14px; color:#171B2C; line-height:1.6; margin:12px 14px; }",
        setup: function (editor) {
            // Mirror the red focus ring used by the other inputs
            const wrap = document.querySelector('.rte-wrap');
            editor.on('focus', () => wrap.classList.add('is-focused'));
            editor.on('blur',  () => wrap.classList.remove('is-focused'));
        }
    });

    // Make sure the latest editor HTML is in the textarea on submit
    document.getElementById('whyChooseUsForm').addEventListener('submit', function () {
        tinymce.triggerSave();
    });

    // ===== Scroll to the first validation error on page load =====
    const firstErrorField = document.querySelector('.input-error, .upload-btn-error');
    const firstErrorMsg = document.querySelector('.field-error');

    if (firstErrorField) {
        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstErrorField.classList.add('error-flash');
        setTimeout(() => firstErrorField.classList.remove('error-flash'), 1500);
    } else if (firstErrorMsg) {
        firstErrorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>


<style>
    .req{ color: var(--orange, #BF0001); }

    .crumbs{ display:flex; align-items:center; gap:8px; font-size:13px; color: var(--faint,#9AA1B2); margin-bottom:10px; }
    .crumbs b{ color: var(--ink,#171B2C); font-weight:600; }
    .crumbs span:first-child{ cursor:pointer; transition:color .15s; }
    .crumbs span:first-child:hover{ color: var(--orange,#BF0001); }

    .header{ display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:32px; gap:16px; flex-wrap:wrap; }
    .header h1{ font-size:25px; font-weight:700; letter-spacing:-0.02em; margin:0; color: var(--ink,#171B2C); }
    .header p{ font-size:13.5px; color: var(--muted,#667085); margin:7px 0 0;  line-height:1.55; }

    .section-title{ display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:6px; }
    .section-title h2{ display:flex; align-items:center; gap:8px; font-size:14px; font-weight:700; margin:0; color: var(--ink,#171B2C); }
    .icon{ display:inline-flex; color: var(--orange,#BF0001); }

    .field{ margin-bottom:22px; }
    .field:last-child{ margin-bottom:0; }
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
    .input-error{ border-color:#e74c3c !important; background:#fff8f8; }
    .field-error{ display:flex; align-items:center; gap:5px; color:#e74c3c; font-size:12.5px; margin-top:6px; }

    /* ===== Rich text editor, styled to match the inputs ===== */
    .rte-wrap{
        border:1px solid var(--input-border,#DBDFEA); border-radius:10px; background:#fff;
        overflow:hidden; transition:box-shadow .15s, border-color .15s;
    }
    .rte-wrap.is-focused{
        border-color: var(--orange,#BF0001);
        box-shadow: 0 0 0 4px var(--orange-tint-strong,#FFE9D8);
    }
    .rte-wrap .tox-tinymce{ border:none !important; border-radius:0 !important; }
    .rte-wrap .tox .tox-editor-header{ box-shadow:none !important; border-bottom:1px solid var(--line,#E9EBF2) !important; }
    .rte-wrap .tox .tox-toolbar,
    .rte-wrap .tox .tox-toolbar__primary,
    .rte-wrap .tox .tox-toolbar-overlord{ background: var(--canvas,#F6F7FB) !important; }
    .rte-wrap.input-error .tox .tox-toolbar__primary{ background:#fff3f3 !important; }

    .notice{ display:flex; align-items:flex-start; gap:8px; background: var(--canvas,#F6F7FB); border-radius:10px; padding:10px 12px; }
    .notice.caution{ background:#FFF8E8; border:1px solid #F5E3B3; }
    .notice.caution i{ color:#B7791F; }
    .notice.caution p{ color:#8A6116; margin:0; font-size:12px; }

    .savebar{
        position:sticky; bottom:0; border-top:1px solid var(--line,#E9EBF2);
        background:rgba(255,255,255,0.92); backdrop-filter:blur(6px);
        margin:102px -32px -32px; padding:0 32px;
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
</style>

@endsection