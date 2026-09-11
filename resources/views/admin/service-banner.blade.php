@extends('admin.layout')
@section('title', 'Service Banner')
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
    document.addEventListener('DOMContentLoaded', function() {
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
        <i class="bi bi-file-text"></i>
        Service Banner Section
    </h4>
</div>

<form action="{{ route('admin.service.banner.store') }}"
    method="POST" enctype="multipart/form-data" class="banner-form" id="serviceBannerForm">
    @csrf

    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-type"></i> Title</label>
                        <input type="text" name="title" value="{{ old('title', $about->banner_heading) }}"
                            class="{{ $errors->has('title') ? 'input-error' : '' }}"
                            placeholder="Enter title">
                        @error('title')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-card-text"></i> Short Description</label>
                        <!-- <p class="hint-text">Shown on the homepage card and listing page under the title.</p> -->
                        <textarea name="description" rows="3"
                            class="{{ $errors->has('description') ? 'input-error' : '' }}"
                            placeholder="e.g. API threading and machining solutions for critical oilfield connections.">{{ old('description', $about->banner_description) }}</textarea>
                        @error('description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-image"></i> Image</label>

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
                            Recommended: <strong>{{ $imageWidth ?? 550 }} × {{ $imageHeight ?? 560 }}px</strong>
                        </span>
                    </div>

                    <div class="image-upload-box">
                        <div class="preview-wrap">
                            @if ($about->image)
                            <img src="{{ Storage::url($about->image) }}" class="preview-img" id="preview-image">
                            @else
                            <div class="preview-placeholder" id="preview-image">
                                <i class="bi bi-image"></i>
                            </div>
                            @endif
                        </div>
                        <label class="upload-btn {{ $errors->has('image') ? 'upload-btn-error' : '' }}">
                            <i class="bi bi-upload"></i> Choose file
                            <input type="file" name="image" accept="image/*" data-max-size="10"
                                onchange="previewImage(this, 'preview-image'); showFileSize(this, 'size-image')" hidden>
                        </label>
                        <span class="file-size-info" id="size-image"></span>

                        @error('image')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Meta Title --}}
            <div class="col-md-8">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-tag"></i> Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" maxlength="60"
                               value="{{ old('meta_title', $about->meta_title) }}"
                               class="{{ $errors->has('meta_title') ? 'input-error' : '' }}"
                               placeholder="SEO title for search engines"
                               oninput="document.getElementById('metaTitleCount').textContent = this.value.length">
                        <p class="hint-text"><span id="metaTitleCount">{{ strlen(old('meta_title', $about->meta_title ?? '')) }}</span> / 60 characters</p>
                        @error('meta_title')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Meta Description --}}
            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-card-text"></i> Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" maxlength="160"
                                  class="{{ $errors->has('meta_description') ? 'input-error' : '' }}"
                                  placeholder="SEO description shown in search results"
                                  oninput="document.getElementById('metaDescCount').textContent = this.value.length">{{ old('meta_description', $about->meta_description) }}</textarea>
                        <p class="hint-text"><span id="metaDescCount">{{ strlen(old('meta_description', $about->meta_description ?? '')) }}</span> / 160 characters</p>
                        @error('meta_description')
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#description-input',
        height: 400,
        menubar: false,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
        toolbar: 'undo redo | blocks | bold italic forecolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image media table | code preview fullscreen | removeformat help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size:14px }',
        branding: false,
        promotion: false,

        setup: function(editor) {
            const maxChars = 600;

            function updateCounter() {
                editor.save();
                const count = editor.plugins.wordcount ? editor.plugins.wordcount.body.getCharacterCount() : 0;
                const charCountEl = document.getElementById('char-count');
                const charCountMsg = document.getElementById('char-count-msg');

                if (charCountEl && charCountMsg) {
                    charCountEl.textContent = count;
                    if (count > maxChars) {
                        charCountMsg.classList.remove('text-muted');
                        charCountMsg.classList.add('text-danger');
                    } else {
                        charCountMsg.classList.remove('text-danger');
                        charCountMsg.classList.add('text-muted');
                    }
                }
            }

            editor.on('init keyup change paste Undo Redo', updateCounter);

            // Block typing past limit
            editor.on('keydown', function(e) {
                const count = editor.plugins.wordcount ? editor.plugins.wordcount.body.getCharacterCount() : 0;
                const allowedKeys = [8, 46, 37, 38, 39, 40]; // Backspace, Delete, Arrow keys

                if (count >= maxChars && !allowedKeys.includes(e.keyCode) && !e.ctrlKey && !e.metaKey) {
                    e.preventDefault();
                }
            });
        }
    });
</script>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
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

    function showFileSize(input, displayId) {
        const display = document.getElementById(displayId);
        if (!input.files || !input.files[0]) {
            display.textContent = '';
            display.classList.remove('size-error');
            return;
        }
        const file = input.files[0];
        const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
        const maxMB = parseFloat(input.dataset.maxSize);

        if (sizeMB > maxMB) {
            display.innerHTML = `<i class="bi bi-exclamation-triangle"></i> ${sizeMB} MB — exceeds ${maxMB}MB limit!`;
            display.classList.add('size-error');
        } else {
            display.innerHTML = `<i class="bi bi-check-circle"></i> ${sizeMB} MB`;
            display.classList.remove('size-error');
        }
    }
</script>




@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fields on this form, in the order they appear top to bottom.
    const fieldOrder = [
        'title',
        'description',
        'image',
        'meta_title',
        'meta_description',
    ];

    const errorFields = @json(array_keys($errors->getMessages()));

    if (errorFields.length === 0) return;

    // Find the first field (by page order) that actually has an error.
    let targetName = fieldOrder.find(name => errorFields.includes(name));

    // Fallback: if something errored that isn't in our known list, just use whatever came first.
    if (!targetName) {
        targetName = errorFields[0];
    }

    const field = document.querySelector(`[name="${targetName}"]`);
    const scrollTarget = field
        ? (field.closest('.form-card') || field)
        : document.querySelector('.field-error');

    if (scrollTarget) {
        scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'center' });

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

    /* .btn-back {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #3b3b58;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-back:hover {
        text-decoration: underline;
    } */

        /* Back to list button */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    color: #333333;
    background-color: #f5f5f5;
    border: 1px solid #dddddd;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
}

.btn-back i {
    font-size: 14px;
    line-height: 1;
}

.btn-back:hover {
    background-color: #e9852c; /* matches orange theme */
    border-color: #e9852c;
    color: #ffffff;
    text-decoration: none;
}

.btn-back:active {
    background-color: #d67320;
    border-color: #d67320;
}

.btn-back:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(233, 133, 44, 0.25);
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
    }

    .section-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
    }

    .hint-text {
        font-size: 12.5px;
        color: #888;
        margin-bottom: 12px;
    }

    .image-upload-box {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        max-width: 300px;
    }

    .preview-wrap {
        width: 100%;
    }

    .preview-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eee;
        margin-bottom: 10px;
    }

    .preview-placeholder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f4f6f9;
        border-radius: 6px;
        border: 1px dashed #ddd;
        color: #bbb;
        font-size: 28px;
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

    .upload-btn-error {
        border-color: #e74c3c !important;
    }

    .field-error {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #e74c3c;
        font-size: 12.5px;
        margin-top: 6px;
    }

    .input-error {
        border-color: #e74c3c !important;
        background: #fff8f8;
    }

    .file-name {
        font-size: 13px;
        color: #666;
        margin-left: 10px;
    }

    .scope-row {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .scope-row input {
        flex: 1;
    }

    .specs-table-header {
        display: grid;
        grid-template-columns: 1fr 1.5fr 1fr 40px;
        gap: 12px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #888;
        padding: 0 4px 10px;
        border-bottom: 1px solid #eee;
        margin-bottom: 12px;
    }

    .specs-row {
        display: grid;
        grid-template-columns: 1fr 1.5fr 1fr 40px;
        gap: 12px;
        margin-bottom: 10px;
        align-items: center;
    }

    .btn-remove-row {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 6px;
        border: 1px solid #f0d0d0;
        background: #fdecea;
        color: #c0392b;
        cursor: pointer;
    }

    .btn-remove-row:hover {
        background: #c0392b;
        color: #fff;
    }

    .btn-add-row {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f4f6f9;
        color: #3b3b58;
        border: 1px solid #ddd;
        padding: 9px 16px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        margin-top: 4px;
    }

    .btn-add-row:hover {
        background: #e9ecf2;
    }

    .gallery-existing {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .gallery-thumb {
        width: 120px;
    }

    .gallery-thumb img {
        width: 100%;
        height: 90px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eee;
        margin-bottom: 6px;
    }

    .gallery-remove {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #c0392b;
        cursor: pointer;
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

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 7px;
        font-weight: 600;
        font-size: 14px;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="url"],
    .form-group input[type="number"],
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
        font-family: inherit;
        resize: vertical;
        background: #fff;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #3b3b58;
    }

    .gallery-new { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 16px; }
.gallery-thumb-new { border: 1px dashed #3b3b58; }


.inspection-row {
    display: flex;
    gap: 14px;
    align-items: stretch;
    background: #fafbfc;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 18px;
    margin-bottom: 14px;
    position: relative;
}

.inspection-row-fields {
    flex: 1;
    display: grid;
    grid-template-columns: 1fr 1fr 220px;
    gap: 16px;
    align-items: start;
}

.inspection-row-fields .form-group {
    display: flex;
    flex-direction: column;
}

.inspection-row-fields .form-group label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 7px;
    color: #333;
}

.inspection-row-fields input[type="text"],
.inspection-row-fields textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
}

.inspection-row-fields textarea {
    min-height: 110px;
}

/* ===== Compact image upload box just for inspection rows ===== */
.inspection-row .image-upload-box {
    width: 100%;
    max-width: 220px;
}

.inspection-row .preview-wrap {
    width: 100%;
}

.inspection-row .preview-img,
.inspection-row .preview-placeholder {
    width: 100%;
    height: 110px;           /* matches textarea height instead of 300px */
    margin-bottom: 8px;
}

.inspection-row .preview-placeholder {
    font-size: 22px;
}

.inspection-row .upload-btn {
    width: 100%;
    justify-content: center;
    font-size: 12.5px;
    padding: 8px 10px;
}

/* ===== Remove button aligned to top-right of the row, not floating oddly ===== */
.inspection-row .btn-remove-row {
    position: absolute;
    top: 40px;
    right: 14px;
    width: 34px;
    height: 34px;
    flex-shrink: 0;

     /* centering fix */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    line-height: 1;
}

.inspection-row .btn-remove-row i {
    display: block;
    font-size: 15px;
    line-height: 1;
}

/* add right padding to row so trash icon doesn't overlap the image column */
.inspection-row {
    padding-right: 56px;
}

@media (max-width: 900px) {
    .inspection-row-fields {
        grid-template-columns: 1fr;
    }
    .inspection-row .image-upload-box {
        max-width: 100%;
    }
    .inspection-row {
        padding-right: 18px;
    }
    .inspection-row .btn-remove-row {
        position: static;
        margin-top: 12px;
    }
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