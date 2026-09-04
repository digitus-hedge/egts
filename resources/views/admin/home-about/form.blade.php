@extends('admin.layout')
@section('title', $about->exists ? 'Edit About Section' : 'Add About Section')
@section('content')


  
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

    @if ($errors->any())
        <div class="alert alert-error">
            <i class="bi bi-exclamation-circle"></i>
                  Please fill below fields before submitting

        </div>
    @endif

    <div class="form-header">
        <h4>
            <i class="bi bi-{{ $about->exists ? 'pencil-square' : 'plus-circle' }}"></i>
            {{ $about->exists ? 'Edit About Section' : 'Add About Section' }}
        </h4>
        <a href="{{ route('admin.home.about') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to list
        </a>
    </div>

   <form action="{{ $about->exists ? route('admin.home.about.update', $about->id) : route('admin.home.about.store') }}"
      method="POST" enctype="multipart/form-data" class="banner-form" id="aboutForm">
    @csrf
    @if ($about->exists)
        @method('PUT')
    @endif

    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-type"></i> Title</label>
                        <input type="text" name="title" value="{{ old('title', $about->title) }}"
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
                    <label class="section-label"><i class="bi bi-image"></i> Image</label>
                    <p class="hint-text">Accepted: JPG, PNG, WEBP — Max size: <strong>2MB</strong></p>

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
                            <input type="file" name="image" accept="image/*" data-max-size="5"
                                   onchange="previewImage(this, 'preview-image'); showFileSize(this, 'size-image')" hidden>
                        </label>
                        <span class="file-size-info" id="size-image"></span>

                        @error('image')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-text-paragraph"></i> Description</label>

                    <div id="editor-container">{!! old('description', $about->description) !!}</div>
                    <input type="hidden" name="description" id="description-input" value="{{ old('description', $about->description) }}">

                    @error('description')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-actions">
                    <a href="{{ route('admin.home.about') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        {{ $about->exists ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  

    <script>
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write the about description here...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image'],
                    [{ align: [] }],
                    ['clean']
                ]
            }
        });

        // Sync Quill's HTML content into the hidden input before submit
        document.getElementById('aboutForm').addEventListener('submit', function () {
            document.getElementById('description-input').value = quill.root.innerHTML;
        });

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
        .form-group input[type="text"] { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; }
        .form-group input:focus { border-color: #3b3b58; }
        .section-label { display: flex; align-items: center; gap: 6px; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 8px; }
        .hint-text { font-size: 12.5px; color: #888; margin-bottom: 14px; }
        .hint-text strong { color: #555; }
        .image-upload-box { display: flex; flex-direction: column; align-items: flex-start; width: 100%; max-width: 300px; }
        .preview-wrap { width: 100%; }
        .preview-img { width: 100%; height: 130px; object-fit: cover; border-radius: 6px; border: 1px solid #eee; margin-bottom: 10px; }
        .preview-placeholder { width: 100%; height: 130px; display: flex; align-items: center; justify-content: center; background: #f4f6f9; border-radius: 6px; border: 1px dashed #ddd; color: #bbb; font-size: 28px; margin-bottom: 10px; }
        .upload-btn { display: inline-flex; align-items: center; gap: 6px; background: #f4f6f9; color: #3b3b58; padding: 7px 14px; border-radius: 6px; font-size: 13px; cursor: pointer; border: 1px solid #ddd; }
        .upload-btn:hover { background: #e9ecf2; }
        .upload-btn-error { border-color: #e74c3c !important; background: #fff8f8 !important; color: #c0392b !important; }
        .file-size-info { display: block; font-size: 12px; color: #1e8449; margin-top: 6px; }
        .file-size-info.size-error { color: #e74c3c; font-weight: 600; }
        .input-error { border-color: #e74c3c !important; background: #fff8f8; }
        .field-error { display: flex; align-items: center; gap: 5px; color: #e74c3c; font-size: 12.5px; margin-top: 6px; }
        .field-error i { font-size: 13px; }
        #editor-container { min-height: 200px; background:#fff; }
        .ql-toolbar { border-radius: 6px 6px 0 0; }
        .ql-container { border-radius: 0 0 6px 6px; font-size: 14px; }
        .form-actions { display: flex; gap: 12px; margin-top: 6px; }
        .btn-cancel { padding: 11px 22px; border-radius: 6px; border: 1px solid #ddd; color: #555; text-decoration: none; font-size: 14px; }
        .btn-cancel:hover { background: #f4f6f9; }
        .btn-submit { display: flex; align-items: center; gap: 7px; background: #3b3b58; color: #fff; border: none; padding: 11px 24px; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; }
        .btn-submit:hover { background: #2b2b42; }
    </style>

@endsection