@extends('admin.layout')
@section('title', $stat->exists ? 'Edit Stat' : 'Add Stat')
@section('content')

@if ($errors->any())
    <div class="alert alert-error">
        <i class="bi bi-exclamation-circle"></i>
                Please fill below fields before submitting

    </div>
@endif

<div class="form-header">
    <h4>
        <i class="bi bi-{{ $stat->exists ? 'pencil-square' : 'plus-circle' }}"></i>
        {{ $stat->exists ? 'Edit Stat' : 'Add Stat' }}
    </h4>
    <a href="{{ route('admin.home.stats') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Back to list
    </a>
</div>

<form action="{{ $stat->exists ? route('admin.home.stats.update', $stat->id) : route('admin.home.stats.store') }}"
      method="POST" class="banner-form" id="statForm">
    @csrf
    @if ($stat->exists)
        @method('PUT')
    @endif

    <div class="container-fluid px-0">
        <div class="row">

            <div class="col-md-6">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-123"></i> Value</label>
                        <input type="text" name="value" value="{{ old('value', $stat->value) }}"
                               class="{{ $errors->has('value') ? 'input-error' : '' }}"
                               placeholder="e.g. 100K, 15+, 18%">
                        @error('value')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-tag"></i> Label</label>
                        <input type="text" name="label" value="{{ old('label', $stat->label) }}"
                               class="{{ $errors->has('label') ? 'input-error' : '' }}"
                               placeholder="e.g. LICENSES">
                        @error('label')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-card-text"></i> Description</label>
                        <input type="text" name="description" value="{{ old('description', $stat->description) }}"
                               class="{{ $errors->has('description') ? 'input-error' : '' }}"
                               placeholder="e.g. Held & managed">
                        @error('description')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-card">
                    <div class="form-group">
                        <label><i class="bi bi-sort-numeric-down"></i> Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $stat->sort_order ?? 0) }}"
                               class="{{ $errors->has('sort_order') ? 'input-error' : '' }}"
                               placeholder="0">
                        <p class="hint-text">Lower numbers show first.</p>
                        @error('sort_order')
                            <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-6">
                <div class="form-card">
                    <label class="section-label"><i class="bi bi-toggle-on"></i> Status</label>
                    <label class="switch-label">
                        <input type="checkbox" name="status" value="1"
                               {{ old('status', $stat->status) ? 'checked' : '' }}>
                        <span>Active (visible on frontend)</span>
                    </label>
                    @error('status')
                        <span class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div> -->

            <div class="col-md-12">
                <div class="form-actions">
                    <a href="{{ route('admin.home.stats') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        {{ $stat->exists ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>

<style>
    .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; display:flex; align-items:center; gap:8px; }
    .alert-error { background: #fdecea; color: #c0392b; }
    .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; }
    .form-header h4 { display: flex; align-items: center; gap: 8px; color: #1e1e2d; }
    .btn-back { display: flex; align-items: center; gap: 6px; color: #3b3b58; text-decoration: none; font-size: 14px; }
    .btn-back:hover { text-decoration: underline; }
    .banner-form { width: 100%; }
    .form-card { background: #fff; padding: 22px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 18px; height: calc(100% - 18px); }
    .form-group { margin-bottom: 0; }
    .form-group label { display: flex; align-items: center; gap: 6px; margin-bottom: 7px; font-weight: 600; font-size: 14px; color: #333; }
    .form-group input[type="text"],
    .form-group input[type="number"] { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; }
    .form-group input:focus { border-color: #3b3b58; }
    .section-label { display: flex; align-items: center; gap: 6px; font-weight: 600; font-size: 14px; color: #333; margin-bottom: 10px; }
    .hint-text { font-size: 12.5px; color: #888; margin-top: 6px; margin-bottom: 0; }
    .switch-label { display: flex; align-items: center; gap: 8px; font-size: 14px; color: #333; cursor: pointer; }
    .switch-label input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; }
    .input-error { border-color: #e74c3c !important; background: #fff8f8; }
    .field-error { display: flex; align-items: center; gap: 5px; color: #e74c3c; font-size: 12.5px; margin-top: 6px; }
    .field-error i { font-size: 13px; }
    .form-actions { display: flex; gap: 12px; margin-top: 6px; }
    .btn-cancel { padding: 11px 22px; border-radius: 6px; border: 1px solid #ddd; color: #555; text-decoration: none; font-size: 14px; }
    .btn-cancel:hover { background: #f4f6f9; }
    .btn-submit { display: flex; align-items: center; gap: 7px; background: #3b3b58; color: #fff; border: none; padding: 11px 24px; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer; }
    .btn-submit:hover { background: #2b2b42; }
</style>

@endsection