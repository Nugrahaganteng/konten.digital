@extends('layouts.admin')

@section('title', 'Edit Section — ' . $section->label)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
    /* ── Base ─────────────────────────────────────── */
    :root {
        --bg:        #0f0f13;
        --surface:   #18181f;
        --surface2:  #22222d;
        --border:    #2e2e3a;
        --accent:    #7c6af7;
        --accent2:   #f7c26a;
        --danger:    #f76a6a;
        --success:   #6af7a8;
        --text:      #e8e8f0;
        --muted:     #7a7a95;
        --radius:    10px;
    }

    body { background: var(--bg); color: var(--text); font-family: 'DM Sans', 'Segoe UI', sans-serif; }

    /* ── Layout ───────────────────────────────────── */
    .form-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 1.5rem;
        align-items: start;
    }
    @media (max-width: 900px) {
        .form-layout { grid-template-columns: 1fr; }
        .form-sidebar { order: -1; }
    }

    /* ── Page Header ──────────────────────────────── */
    .form-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--muted);
        text-decoration: none;
        padding: .4rem .8rem;
        border-radius: 6px;
        border: 1.5px solid var(--border);
        transition: all .2s;
    }
    .btn-back:hover { color: var(--text); border-color: #4b4b62; }
    .form-title {
        font-size: 1.3rem;
        font-weight: 700;
        font-family: 'DM Mono', monospace;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .page-badge {
        font-size: .62rem;
        background: var(--surface2);
        border: 1.5px solid var(--border);
        color: var(--muted);
        padding: 2px 8px;
        border-radius: 4px;
        font-family: 'DM Mono', monospace;
        letter-spacing: .06em;
        text-transform: uppercase;
    }
    .section-badge {
        font-size: .62rem;
        background: rgba(124,106,247,.15);
        border: 1.5px solid rgba(124,106,247,.3);
        color: var(--accent);
        padding: 2px 8px;
        border-radius: 4px;
        font-family: 'DM Mono', monospace;
        letter-spacing: .06em;
    }

    /* ── Card ─────────────────────────────────────── */
    .card {
        background: var(--surface);
        border: 1.5px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
    }
    .card-header-bar {
        display: flex;
        align-items: center;
        gap: .7rem;
        padding: .9rem 1.2rem;
        background: var(--surface2);
        border-bottom: 1.5px solid var(--border);
        font-weight: 700;
        font-size: .88rem;
    }
    .card-header-bar i { color: var(--accent); }
    .card-content { padding: 1.4rem 1.2rem; display: flex; flex-direction: column; gap: 1.4rem; }

    /* ── Field Groups ─────────────────────────────── */
    .field-group { display: flex; flex-direction: column; gap: .45rem; }

    .field-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
    }
    .field-label {
        font-size: .8rem;
        font-weight: 700;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: .4rem;
    }
    .field-label .type-tag {
        font-family: 'DM Mono', monospace;
        font-size: .6rem;
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--muted);
        padding: 1px 6px;
        border-radius: 3px;
        letter-spacing: .05em;
    }

    /* ── Inputs ───────────────────────────────────── */
    .inp {
        width: 100%;
        background: var(--surface2);
        border: 1.5px solid var(--border);
        border-radius: 7px;
        color: var(--text);
        font-size: .87rem;
        padding: .65rem .9rem;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        font-family: inherit;
        resize: none;
    }
    .inp:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(124,106,247,.15);
    }
    .inp::placeholder { color: var(--muted); }
    textarea.inp { min-height: 100px; line-height: 1.6; }

    /* ── Color Picker ─────────────────────────────── */
    .color-wrap {
        display: flex;
        align-items: center;
        gap: .75rem;
    }
    .color-swatch-btn {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        border: 2px solid var(--border);
        cursor: pointer;
        flex-shrink: 0;
        transition: border-color .2s, transform .15s;
        position: relative;
        overflow: hidden;
    }
    .color-swatch-btn:hover { border-color: var(--accent); transform: scale(1.08); }
    .color-swatch-btn input[type="color"] {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        border: none;
        padding: 0;
    }
    .color-hex {
        font-family: 'DM Mono', monospace;
        font-size: .82rem;
        flex: 1;
    }

    /* ── Image Upload ─────────────────────────────── */
    .image-upload-area {
        border: 2px dashed var(--border);
        border-radius: 8px;
        padding: 1.2rem;
        text-align: center;
        transition: border-color .2s, background .2s;
        cursor: pointer;
        position: relative;
    }
    .image-upload-area:hover,
    .image-upload-area.drag-over {
        border-color: var(--accent);
        background: rgba(124,106,247,.05);
    }
    .image-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .upload-icon { font-size: 1.8rem; color: var(--muted); margin-bottom: .5rem; }
    .upload-text { font-size: .78rem; color: var(--muted); }
    .upload-text strong { color: var(--accent); }

    /* Image preview */
    .img-preview-wrap {
        position: relative;
        display: inline-block;
        margin-bottom: .6rem;
    }
    .img-preview {
        max-width: 100%;
        max-height: 180px;
        border-radius: 6px;
        border: 1.5px solid var(--border);
        object-fit: cover;
        display: block;
    }
    .img-remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 22px;
        height: 22px;
        background: var(--danger);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: .65rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .2s;
    }
    .img-remove-btn:hover { transform: scale(1.15); }
    .img-filename {
        font-size: .7rem;
        color: var(--muted);
        margin-top: .3rem;
        font-family: 'DM Mono', monospace;
        word-break: break-all;
    }

    /* ── Divider between field groups ─────────────── */
    .field-divider {
        border: none;
        border-top: 1px solid var(--border);
        margin: 0;
    }

    /* ── Sidebar ──────────────────────────────────── */
    .sidebar-card { position: sticky; top: 1.5rem; }

    /* Status toggle in sidebar */
    .status-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.2rem;
        background: var(--surface2);
        border-bottom: 1.5px solid var(--border);
    }
    .status-label { font-size: .85rem; font-weight: 700; }
    .toggle {
        position: relative;
        width: 44px;
        height: 24px;
        cursor: pointer;
        display: inline-block;
    }
    .toggle input { opacity: 0; width: 0; height: 0; }
    .toggle-track {
        position: absolute;
        inset: 0;
        background: var(--border);
        border-radius: 999px;
        transition: background .25s;
    }
    .toggle input:checked ~ .toggle-track { background: var(--success); }
    .toggle-thumb {
        position: absolute;
        top: 4px;
        left: 4px;
        width: 16px;
        height: 16px;
        background: #fff;
        border-radius: 50%;
        transition: transform .25s;
        pointer-events: none;
    }
    .toggle input:checked ~ .toggle-thumb { transform: translateX(20px); }

    /* Section info in sidebar */
    .sidebar-info { padding: 1rem 1.2rem; display: flex; flex-direction: column; gap: .6rem; }
    .info-row { display: flex; flex-direction: column; gap: .2rem; }
    .info-key { font-size: .68rem; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; font-family: 'DM Mono', monospace; }
    .info-val { font-size: .82rem; font-weight: 600; }

    /* ── Submit Button ────────────────────────────── */
    .btn-submit {
        width: 100%;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: .85rem;
        font-size: .9rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        transition: opacity .2s, transform .15s;
        letter-spacing: .02em;
    }
    .btn-submit:hover { opacity: .88; transform: translateY(-1px); }
    .btn-submit:active { transform: translateY(0); }

    /* ── Alert ────────────────────────────────────── */
    .alert {
        padding: .85rem 1.1rem;
        border-radius: var(--radius);
        border-left: 4px solid;
        margin-bottom: 1.5rem;
        font-size: .88rem;
        font-weight: 600;
    }
    .alert-success { background: rgba(106,247,168,.08); border-color: var(--success); color: var(--success); }
    .alert-error   { background: rgba(247,106,106,.08); border-color: var(--danger);  color: var(--danger); }

    /* ── Field count indicator ────────────────────── */
    .fields-count {
        font-size: .72rem;
        color: var(--muted);
        font-family: 'DM Mono', monospace;
        margin-left: auto;
    }

    /* ── Scrollbar ────────────────────────────────── */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg); }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
</style>
@endpush

@section('content')

{{-- Alert --}}
@if(session('success'))
<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
<div class="alert alert-error">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ $errors->first() }}
</div>
@endif

{{-- Header --}}
<div class="form-header">
    <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div class="form-title">
        <i class="fas fa-pen-to-square" style="color:var(--accent)"></i>
        Edit Section
    </div>
    <span class="page-badge">{{ $section->page }}</span>
    <span class="section-badge">{{ $section->section_key }}</span>
</div>

{{-- Form --}}
<form method="POST"
      action="{{ route('admin.cms.page-sections.update', $section) }}"
      enctype="multipart/form-data"
      id="section-form">
    @csrf
    @method('PUT')

    <div class="form-layout">

        {{-- ── Main Fields ──────────────────────────── --}}
        <div class="card">
            <div class="card-header-bar">
                <i class="fas fa-sliders"></i>
                {{ $section->label }}
                <span class="fields-count">{{ count($fields) }} field</span>
            </div>
            <div class="card-content">

                @if(empty($fields))
                <p style="color:var(--muted); font-size:.85rem; text-align:center; padding:2rem 0">
                    Tidak ada field untuk section ini.
                </p>
                @else

                @foreach($fields as $idx => $field)
                @php
                    $key         = $field['key'];
                    $label       = $field['label'];
                    $type        = $field['type'];
                    $placeholder = $field['placeholder'] ?? '';
                    $currentVal  = $section->get($key, '');
                    $inputId     = 'field_' . $key;
                @endphp

                @if($idx > 0)
                <hr class="field-divider">
                @endif

                <div class="field-group" id="group_{{ $key }}">
                    <div class="field-label-row">
                        <label class="field-label" for="{{ $inputId }}">
                            {{ $label }}
                            <span class="type-tag">{{ $type }}</span>
                        </label>
                    </div>

                    {{-- ── TEXT ── --}}
                    @if($type === 'text')
                        <input type="text"
                               id="{{ $inputId }}"
                               name="{{ $key }}"
                               value="{{ old($key, $currentVal) }}"
                               placeholder="{{ $placeholder }}"
                               class="inp">

                    {{-- ── TEXTAREA ── --}}
                    @elseif($type === 'textarea')
                        <textarea id="{{ $inputId }}"
                                  name="{{ $key }}"
                                  placeholder="{{ $placeholder }}"
                                  class="inp"
                                  rows="4">{{ old($key, $currentVal) }}</textarea>

                    {{-- ── COLOR ── --}}
                    @elseif($type === 'color')
                        @php $colorVal = old($key, $currentVal ?: '#7c6af7'); @endphp
                        <div class="color-wrap">
                            <label class="color-swatch-btn" style="background:{{ $colorVal }}">
                                <input type="color"
                                       name="{{ $key }}"
                                       value="{{ $colorVal }}"
                                       id="{{ $inputId }}"
                                       onchange="
                                           this.closest('.color-swatch-btn').style.background = this.value;
                                           document.getElementById('hex_{{ $key }}').value = this.value;
                                       ">
                            </label>
                            <input type="text"
                                   id="hex_{{ $key }}"
                                   value="{{ $colorVal }}"
                                   placeholder="#ffffff"
                                   class="inp color-hex"
                                   maxlength="7"
                                   oninput="syncColorFromHex(this, '{{ $inputId }}')">
                        </div>

                    {{-- ── IMAGE ── --}}
                    @elseif($type === 'image')
                        <div class="image-upload-area" id="drop_{{ $key }}"
                             ondragover="handleDragOver(event, this)"
                             ondragleave="handleDragLeave(event, this)"
                             ondrop="handleFileDrop(event, '{{ $key }}')">

                            {{-- Hidden input to clear image (future) --}}
                            {{-- Current image preview --}}
                            @if($currentVal)
                            <div class="img-preview-wrap" id="preview_wrap_{{ $key }}">
                                <img src="{{ Storage::url($currentVal) }}"
                                     alt=""
                                     class="img-preview"
                                     id="preview_{{ $key }}">
                                <button type="button"
                                        class="img-remove-btn"
                                        onclick="clearImage('{{ $key }}')"
                                        title="Hapus gambar">
                                    <i class="fas fa-times"></i>
                                </button>
                                <p class="img-filename" id="filename_{{ $key }}">
                                    {{ basename($currentVal) }}
                                </p>
                            </div>
                            @else
                            <div id="preview_wrap_{{ $key }}" style="display:none">
                                <img src="" alt="" class="img-preview" id="preview_{{ $key }}">
                                <button type="button"
                                        class="img-remove-btn"
                                        onclick="clearImage('{{ $key }}')"
                                        title="Hapus gambar">
                                    <i class="fas fa-times"></i>
                                </button>
                                <p class="img-filename" id="filename_{{ $key }}"></p>
                            </div>
                            @endif

                            {{-- Upload prompt --}}
                            <div id="upload_prompt_{{ $key }}" {{ $currentVal ? 'style=display:none' : '' }}>
                                <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                                <div class="upload-text">
                                    <strong>Klik untuk pilih</strong> atau drag & drop gambar<br>
                                    <span style="font-size:.7rem">PNG, JPG, WEBP — maks 2MB</span>
                                </div>
                            </div>

                            {{-- Actual file input --}}
                            <input type="file"
                                   name="{{ $key }}"
                                   id="{{ $inputId }}"
                                   accept="image/*"
                                   onchange="handleImageChange(this, '{{ $key }}')">
                        </div>

                    @endif
                </div>
                @endforeach

                @endif
            </div>
        </div>

        {{-- ── Sidebar ───────────────────────────────── --}}
        <div class="form-sidebar">

            {{-- Publish Card --}}
            <div class="card sidebar-card">

                {{-- Status Toggle --}}
                <div class="status-row">
                    <span class="status-label">
                        <i class="fas fa-circle" style="font-size:.55rem; color:{{ $section->is_active ? 'var(--success)' : 'var(--muted)' }}; margin-right:.4rem"></i>
                        Status Section
                    </span>
                    <label class="toggle" title="Aktif / Nonaktif">
                        <input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}>
                        <span class="toggle-track"></span>
                        <span class="toggle-thumb"></span>
                    </label>
                </div>

                {{-- Info --}}
                <div class="sidebar-info">
                    <div class="info-row">
                        <span class="info-key">Halaman</span>
                        <span class="info-val">{{ $section->page }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-key">Section Key</span>
                        <span class="info-val" style="font-family:'DM Mono',monospace; font-size:.78rem; color:var(--accent)">{{ $section->section_key }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-key">Urutan</span>
                        <span class="info-val">#{{ $section->order }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-key">Terakhir diubah</span>
                        <span class="info-val" style="font-size:.78rem">{{ $section->updated_at->diffForHumans() }}</span>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-submit" style="margin-top:.5rem">
                        <i class="fas fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>

                    {{-- Kembali --}}
                    <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}"
                       style="display:block; text-align:center; font-size:.78rem; color:var(--muted); text-decoration:none; margin-top:.3rem; padding:.4rem">
                        Batal & Kembali
                    </a>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
/* ── Image Upload Handling ──────────────────────────── */
function handleImageChange(input, key) {
    const file = input.files[0];
    if (!file) return;
    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file melebihi 2MB. Silakan pilih file yang lebih kecil.');
        input.value = '';
        return;
    }
    showImagePreview(key, file);
}

function handleFileDrop(e, key) {
    e.preventDefault();
    const area = document.getElementById('drop_' + key);
    area.classList.remove('drag-over');

    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;

    // Assign to the file input
    const input = document.getElementById('field_' + key);
    const dt    = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;

    showImagePreview(key, file);
}

function handleDragOver(e, area) {
    e.preventDefault();
    area.classList.add('drag-over');
}

function handleDragLeave(e, area) {
    if (!area.contains(e.relatedTarget)) {
        area.classList.remove('drag-over');
    }
}

function showImagePreview(key, file) {
    const reader = new FileReader();
    reader.onload = function(ev) {
        const wrap   = document.getElementById('preview_wrap_' + key);
        const img    = document.getElementById('preview_' + key);
        const fname  = document.getElementById('filename_' + key);
        const prompt = document.getElementById('upload_prompt_' + key);

        img.src = ev.target.result;
        fname.textContent = file.name;
        wrap.style.display = 'inline-block';
        if (prompt) prompt.style.display = 'none';
    };
    reader.readAsDataURL(file);
}

function clearImage(key) {
    const wrap   = document.getElementById('preview_wrap_' + key);
    const img    = document.getElementById('preview_' + key);
    const fname  = document.getElementById('filename_' + key);
    const prompt = document.getElementById('upload_prompt_' + key);
    const input  = document.getElementById('field_' + key);

    img.src = '';
    fname.textContent = '';
    input.value = '';
    wrap.style.display = 'none';
    if (prompt) prompt.style.display = 'block';
}

/* ── Color Hex Sync ─────────────────────────────────── */
function syncColorFromHex(hexInput, colorInputId) {
    const val = hexInput.value;
    if (/^#[0-9a-fA-F]{6}$/.test(val)) {
        const colorInput = document.getElementById(colorInputId);
        colorInput.value = val;
        colorInput.closest('.color-swatch-btn').style.background = val;
    }
}

/* ── Unsaved changes warning ────────────────────────── */
let formChanged = false;
const form = document.getElementById('section-form');
if (form) {
    form.addEventListener('change', () => { formChanged = true; });
    form.addEventListener('submit', () => { formChanged = false; });
    window.addEventListener('beforeunload', e => {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
}
</script>
@endpush