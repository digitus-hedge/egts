{{--
    ============================================================================
    Uses the confirmed real variable: $contactBanner (confirmed from your
    actual code). Every field is wrapped in ?? null so the page won't crash
    even if a particular column doesn't exist yet or the row hasn't been
    created — values will simply show empty until saved.

    One placeholder still needs confirming/replacing if wrong:
      "admin.home.contact-banner.store" — the form action route below.
      Swap it if your real route name differs.
    ============================================================================
--}}

@extends('admin.layout')
@section('title', 'Contact Us')
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

@php
    // Every field pulled through this helper is null-safe.
    $c = fn($field) => $contactBanner->{$field} ?? null;
@endphp

<div class="wrap">
    <div class="crumbs">
        <span onclick="window.location='{{ route('admin.dashboard') }}'">Home</span>
        <span>&rsaquo;</span>
        <b>Contact Us</b>
    </div>

    <div class="header">
        <div>
            <h1>Contact Us</h1>
            <p>The banner, contact details, department contacts, map, and social links shown on your Contact page.</p>
        </div>
    </div>

    <form action="{{ route('admin.home.contact-banner.store') }}" method="POST" enctype="multipart/form-data" id="contactForm">
        @csrf

        {{-- Banner --}}
         <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-building"></i></span> Company Info</h2>
            </div>
 
            <div class="two-col">
                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Title <span class="req">*</span></label>
                    </div>
                    <input type="text" name="title" value="{{ old('title', $c('title')) }}"
                           class="{{ $errors->has('title') ? 'input-error' : '' }}"
                           placeholder="e.g. Get in Touch">
                    @error('title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
 
                <div class="field">
                    <div class="field-top">
                        <label class="field-label">Company Name <span class="req">*</span></label>
                    </div>
                    <input type="text" name="company_name" value="{{ old('company_name', $c('company_name')) }}"
                           class="{{ $errors->has('company_name') ? 'input-error' : '' }}"
                           placeholder="e.g. EGTS">
                    @error('company_name')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>
 
            <div class="field" style="margin-bottom:0;">
                <div class="field-top">
                    <label class="field-label">Description <span class="req">*</span></label>
                </div>
                <textarea name="description" rows="4"
                          class="{{ $errors->has('description') ? 'input-error' : '' }}"
                          placeholder="Short description shown under the title...">{{ old('description', $c('description')) }}</textarea>
                @error('description')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>
 
        {{-- Image --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-image"></i></span>Banner Image <span class="req">*</span></h2>
            </div>
 
               <div class="notice caution">
                <i class="bi bi-exclamation-triangle" style="margin-top:1px;"></i>
                <p><b>Recommended size:</b> {{ $imageWidth ?? 1200 }} &times; {{ $imageHeight ?? 600 }}px &middot; JPG, PNG, WEBP &middot; up to 10MB per image.</p>
            </div>
 
            <div class="image-slot" style="max-width:350px;">
                @php $contactImage = $c('image'); @endphp
                <div class="drop img-slot {{ $contactImage ? 'filled' : '' }}" data-file-input="file-image" onclick="handleDropClick(this)">
                    @if ($contactImage)
                        <img src="{{ Storage::url($contactImage) }}" id="preview-image" alt="Contact banner image">
                        <button type="button" class="remove-img-btn" onclick="removeUploadedImage(event, this, 'image', 'preview-image')" title="Remove image">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <div class="uploaded-tag"><i class="bi bi-check-circle"></i> Uploaded</div>
                    @else
                        <div class="preview-placeholder" id="preview-image">
                            <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                            <div class="drop-title">Click to upload</div>
                            <div class="drop-sub">or drag &amp; drop</div>
                        </div>
                    @endif
                </div>
                <input type="file" id="file-image" name="image" accept="image/*" hidden
                       onchange="previewImage(this, 'preview-image')">
                <input type="hidden" name="remove_image" id="remove-image" value="0">
                @if (!$contactImage)
                    <button type="button" class="choose-btn" onclick="document.getElementById('file-image').click()">Choose file</button>
                @endif
            </div>
            @error('image')
                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
            @enderror
        </div>


        {{-- Contact Details --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-person-lines-fill"></i></span> Contact Details</h2>
            </div>

            <div class="two-col">
                <div class="field">
                    <div class="field-top">
                        <label class="field-label"><i class="bi bi-telephone" style="font-size:13px;"></i> Phone Number</label>
                    </div>
                    <input type="text" name="phone" value="{{ old('phone', $c('phone')) }}"
                           class="{{ $errors->has('phone') ? 'input-error' : '' }}"
                           placeholder="e.g. +964 750 000 0000">
                    @error('phone')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <div class="field-top">
                        <label class="field-label"><i class="bi bi-envelope" style="font-size:13px;"></i> Email Address</label>
                    </div>
                    <input type="email" name="email" value="{{ old('email', $c('email')) }}"
                           class="{{ $errors->has('email') ? 'input-error' : '' }}"
                           placeholder="e.g. info@egts-iq.com">
                    @error('email')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="field">
                <div class="field-top">
                    <label class="field-label"><i class="bi bi-clock" style="font-size:13px;"></i> Working Hours</label>
                </div>
                <input type="text" name="working_hours" value="{{ old('working_hours', $c('working_hours')) }}"
                       class="{{ $errors->has('working_hours') ? 'input-error' : '' }}"
                       placeholder="e.g. Sun - Thu, 8:00 AM - 5:00 PM">
                @error('working_hours')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="field" style="margin-bottom:0;">
                <div class="field-top">
                    <label class="field-label"><i class="bi bi-geo-alt" style="font-size:13px;"></i> Address</label>
                </div>
                <textarea name="address" rows="3"
                          class="{{ $errors->has('address') ? 'input-error' : '' }}"
                          placeholder="Full office address...">{{ old('address', $c('address')) }}</textarea>
                @error('address')
                    <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Department Contacts --}}
        <div class="card">
            <div class="section-title">
                <h2><span class="icon"><i class="bi bi-diagram-3"></i></span> Department Contacts</h2>
            </div>

            <div class="dept-grid">
                @php
                    $departments = [
                        'admin'      => 'Admin',
                        'qa_qc'      => 'QA/QC',
                        'operations' => 'Operations',
                        'sales'      => 'Sales',
                    ];
                @endphp

                @foreach ($departments as $key => $label)
                    <div class="dept-card">
                        <h3 class="dept-name">{{ strtoupper($label) }}</h3>

                        <div class="field">
                            <div class="field-top">
                                <label class="field-label">Phone</label>
                            </div>
                            <input type="text" name="{{ $key }}_phone"
                                   value="{{ old($key.'_phone', $c($key.'_phone')) }}"
                                   class="{{ $errors->has($key.'_phone') ? 'input-error' : '' }}"
                                   placeholder="e.g. +964 751 015 7184">
                            @error($key.'_phone')
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field" style="margin-bottom:0;">
                            <div class="field-top">
                                <label class="field-label">Email</label>
                            </div>
                            <input type="email" name="{{ $key }}_email"
                                   value="{{ old($key.'_email', $c($key.'_email')) }}"
                                   class="{{ $errors->has($key.'_email') ? 'input-error' : '' }}"
                                   placeholder="e.g. name@egts-iq.com">
                            @error($key.'_email')
                                <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Map --}}
       

        {{-- Social Links --}}
       

        {{-- SEO Meta --}}
   

        <div class="savebar">
            <div class="savebar-inner">
                <span class="savebar-status">All changes save to the live Contact page</span>
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

                    const removeInput = drop.parentElement.querySelector('input[type="hidden"][id^="remove-"]');
                    if (removeInput) removeInput.value = '0';

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
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeUploadedImage(event, btn, fieldName, previewId) {
        event.stopPropagation();
        const drop = btn.closest('.drop');
        const wrapper = drop.parentElement;
        const fileInput = wrapper.querySelector('input[type="file"]');
        const removeInput = document.getElementById(`remove-${fieldName}`);

        if (removeInput) removeInput.value = '1';
        if (fileInput) fileInput.value = '';

        drop.classList.remove('filled');
        drop.innerHTML = `
            <div class="preview-placeholder" id="${previewId}">
                <div class="ico-circle"><i class="bi bi-image" style="color:#AEB4C4;font-size:18px;"></i></div>
                <div class="drop-title">Click to upload</div>
                <div class="drop-sub">or drag &amp; drop</div>
            </div>
        `;

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
    }
</script>

@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fieldOrder = [
        'banner_heading', 'banner_description', 'banner_image',
        'phone', 'email', 'working_hours', 'address',
        'admin_phone', 'admin_email', 'qa_qc_phone', 'qa_qc_email',
        'operations_phone', 'operations_email', 'sales_phone', 'sales_email',
        'map_embed_url', 'linkedin_url', 'facebook_url', 'instagram_url', 'twitter_url',
        'meta_title', 'meta_description',
    ];

    const errorFields = @json(array_keys($errors->getMessages()));
    if (errorFields.length === 0) return;

    let targetName = fieldOrder.find(name => errorFields.includes(name)) || errorFields[0];
    const field = document.querySelector(`[name="${targetName}"]`);
    const scrollTarget = field ? (field.closest('.dept-card') || field.closest('.card') || field) : document.querySelector('.field-error');

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
    .header p{ font-size:13.5px; color: var(--muted,#667085); margin:7px 0 0; line-height:1.55; }

    .section-title{ display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:6px; }
    .section-title h2{ display:flex; align-items:center; gap:8px; font-size:14px; font-weight:700; margin:0; color: var(--ink,#171B2C); }
    .icon{ display:inline-flex; color: var(--orange,#EF7B2E); }
    .section-sub{ font-size:12px; color: var(--faint,#9AA1B2); }
    .section-sub code{ background: var(--canvas,#F6F7FB); padding:1px 5px; border-radius:4px; font-size:11px; }

    .two-col{ display:grid; grid-template-columns:1fr 1fr; gap:24px; }
    @media (max-width:700px){ .two-col{ grid-template-columns:1fr; } }

    .field{ margin-bottom:22px; }
    .field-top{ display:flex; align-items:baseline; justify-content:space-between; margin-bottom:8px; }
    .field-label{ display:flex; align-items:center; gap:6px; font-size:13px; font-weight:600; color: var(--ink,#171B2C); }
    .field-hint{ font-size:11.5px; color: var(--faint,#9AA1B2); }

    input[type=text], input[type=email], input[type=url], textarea{
        width:100%; border:1px solid var(--input-border,#DBDFEA); border-radius:10px;
        padding:11px 14px; font-size:14px; font-family:inherit; color: var(--ink,#171B2C);
        outline:none; transition:box-shadow .15s, border-color .15s; resize:vertical; background:#fff;
    }
    input:focus, textarea:focus{
        border-color: var(--orange,#EF7B2E);
        box-shadow: 0 0 0 4px var(--orange-tint-strong,#FFE9D8);
    }
    .input-error{ border-color:#e74c3c !important; background:#fff8f8; }
    .field-error{ display:flex; align-items:center; gap:5px; color:#e74c3c; font-size:12.5px; margin-top:6px; }

    .notice{ display:flex; align-items:flex-start; gap:8px; background: var(--canvas,#F6F7FB); border-radius:10px; padding:10px 12px; margin-bottom:16px; }
    .notice p{ font-size:12px; color: var(--muted,#667085); margin:0; }
    .notice.caution{ background:#FFF8E8; border:1px solid #F5E3B3; }
    .notice.caution i{ color:#B7791F; }

    .drop{
        position:relative; aspect-ratio:4/3; border-radius:12px;
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
    .choose-btn{
        margin-top:8px; width:100%; font-size:12px; font-weight:600; color: var(--orange,#EF7B2E);
        background:#fff; border:1px solid var(--orange-border,#F3D8C2); border-radius:8px;
        padding:7px 0; cursor:pointer; transition:background .15s;
    }
    .choose-btn:hover{ background: var(--orange-tint,#FFF8F3); }
    .remove-img-btn{
        position:absolute; top:8px; right:8px; width:26px; height:26px; border-radius:999px;
        background:rgba(0,0,0,0.6); border:none; color:#fff; display:flex; align-items:center;
        justify-content:center; cursor:pointer; transition:background .15s; z-index:3; font-size:11px;
    }
    .remove-img-btn:hover{ background:rgba(0,0,0,0.85); }

    .map-preview{
        margin-top:14px; border-radius:12px; overflow:hidden; border:1px solid var(--line,#E9EBF2);
        aspect-ratio:16/7; background: var(--canvas,#F6F7FB);
    }
    .map-preview iframe{ width:100%; height:100%; border:0; display:block; }

    /* ===== Department Contacts grid ===== */
    .dept-grid{ display:grid; grid-template-columns:repeat(4, 1fr); gap:16px; }
    @media (max-width:1000px){ .dept-grid{ grid-template-columns:repeat(2, 1fr); } }
    @media (max-width:560px){ .dept-grid{ grid-template-columns:1fr; } }

    .dept-card{
        background: var(--canvas,#F6F7FB); border:1px solid var(--line,#E9EBF2);
        border-radius:12px; padding:18px;
    }
    .dept-name{
        font-size:13px; font-weight:800; letter-spacing:.03em; color: var(--ink,#171B2C);
        margin:0 0 16px; text-transform:uppercase;
    }
    .dept-card .field{ margin-bottom:16px; }
    .dept-card input{ background:#fff; }

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

    /* .scroll-error-highlight{
        outline:3px solid #e74c3c !important; outline-offset:4px; border-radius:12px;
        animation:scrollErrorPulse 0.6s ease-in-out 2;
    }
    @keyframes scrollErrorPulse{
        0%, 100% { outline-color:#e74c3c; }
        50% { outline-color:#ff8a80; }
    } */
</style>

@endsection