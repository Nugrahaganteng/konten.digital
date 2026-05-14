@extends('layouts.admin')

@section('title', 'Edit Section — ' . $section->label)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
    /* ── Reset & Base ─────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; }

    :root {
        --bg:        #f5f5f7;
        --surface:   #ffffff;
        --surface2:  #f9f9fb;
        --border:    rgba(0,0,0,.08);
        --border-md: rgba(0,0,0,.13);
        --accent:    #5a4fcf;
        --accent-bg: rgba(90,79,207,.08);
        --danger:    #d94f4f;
        --success:   #2da870;
        --warning:   #c97b1e;
        --warning-bg:rgba(201,123,30,.09);
        --text:      #111118;
        --muted:     #6b6b80;
        --hint:      #9999b0;
        --radius-sm: 6px;
        --radius-md: 9px;
        --radius-lg: 13px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,.07);
    }

    @media (prefers-color-scheme: dark) {
        :root {
            --bg:        #0e0e12;
            --surface:   #18181f;
            --surface2:  #1f1f28;
            --border:    rgba(255,255,255,.07);
            --border-md: rgba(255,255,255,.12);
            --accent:    #7c6af7;
            --accent-bg: rgba(124,106,247,.10);
            --danger:    #e06060;
            --success:   #3ec47a;
            --warning:   #e0972a;
            --warning-bg:rgba(224,151,42,.10);
            --text:      #e8e8f0;
            --muted:     #8888a0;
            --hint:      #5a5a72;
            --shadow-sm: 0 1px 4px rgba(0,0,0,.35);
        }
    }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: 'DM Sans', 'Segoe UI', sans-serif;
        font-size: 14px;
        line-height: 1.5;
    }

    /* ── Layout ───────────────────────────────────── */
    .page-wrap { padding: 1.5rem; }

    .form-layout {
        display: grid;
        grid-template-columns: 1fr 260px;
        gap: 1rem;
        align-items: start;
    }

    @media (max-width: 860px) {
        .form-layout { grid-template-columns: 1fr; }
        .form-sidebar { order: -1; }
    }

    /* ── Page Header ──────────────────────────────── */
    .form-header {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: 12px;
        font-weight: 500;
        color: var(--muted);
        text-decoration: none;
        padding: .35rem .75rem;
        border-radius: var(--radius-sm);
        border: .5px solid var(--border-md);
        transition: color .15s, border-color .15s;
    }
    .btn-back:hover { color: var(--text); border-color: var(--muted); }

    .form-title {
        font-size: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: .45rem;
    }
    .form-title i { color: var(--muted); font-size: 14px; }

    .pill {
        font-size: 11px;
        padding: 2px 9px;
        border-radius: 20px;
        font-family: 'DM Mono', monospace;
        letter-spacing: .03em;
    }
    .pill-page {
        background: var(--surface2);
        border: .5px solid var(--border-md);
        color: var(--muted);
    }
    .pill-key {
        background: var(--accent-bg);
        border: .5px solid rgba(90,79,207,.2);
        color: var(--accent);
    }

    /* ── Card ─────────────────────────────────────── */
    .card {
        background: var(--surface);
        border: .5px solid var(--border-md);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .card-head {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .75rem 1rem;
        background: var(--surface2);
        border-bottom: .5px solid var(--border);
        font-size: 13px;
        font-weight: 600;
    }
    .card-head i { color: var(--muted); }
    .fields-count {
        margin-left: auto;
        font-size: 11px;
        color: var(--hint);
        font-family: 'DM Mono', monospace;
    }

    .card-body {
        padding: 1.1rem;
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
    }

    /* ── Field Group ──────────────────────────────── */
    .field-group { display: flex; flex-direction: column; gap: .4rem; }

    .field-group + .field-group {
        padding-top: 1.1rem;
        border-top: .5px solid var(--border);
    }

    .field-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: .4rem;
    }
    .type-tag {
        font-family: 'DM Mono', monospace;
        font-size: 10px;
        font-weight: 400;
        background: var(--surface2);
        border: .5px solid var(--border-md);
        color: var(--hint);
        padding: 1px 6px;
        border-radius: 4px;
        letter-spacing: .04em;
    }

    /* ── Inputs ───────────────────────────────────── */
    .inp {
        width: 100%;
        background: var(--surface2);
        border: .5px solid var(--border-md);
        border-radius: var(--radius-md);
        color: var(--text);
        font-size: 13px;
        padding: .55rem .8rem;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: inherit;
        resize: none;
    }
    .inp:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-bg);
    }
    .inp::placeholder { color: var(--hint); }
    textarea.inp { min-height: 90px; line-height: 1.6; }

    /* ── Color Picker ─────────────────────────────── */
    .color-wrap { display: flex; align-items: center; gap: .6rem; }
    .color-swatch-btn {
        width: 38px;
        height: 38px;
        border-radius: var(--radius-md);
        border: .5px solid var(--border-md);
        cursor: pointer;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        transition: border-color .15s, transform .15s;
    }
    .color-swatch-btn:hover { border-color: var(--accent); transform: scale(1.06); }
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
    .color-hex { font-family: 'DM Mono', monospace; font-size: 12px; flex: 1; }

    /* ── Image Upload ─────────────────────────────── */
    .image-upload-area {
        border: .5px dashed var(--border-md);
        border-radius: var(--radius-md);
        padding: 1.25rem 1rem;
        text-align: center;
        transition: border-color .15s, background .15s;
        cursor: pointer;
        position: relative;
    }
    .image-upload-area:hover,
    .image-upload-area.drag-over {
        border-color: var(--accent);
        background: var(--accent-bg);
    }
    .image-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .upload-icon { font-size: 20px; color: var(--hint); margin-bottom: .4rem; }
    .upload-text { font-size: 12px; color: var(--muted); line-height: 1.6; }
    .upload-text strong { color: var(--accent); font-weight: 500; }

    .img-preview-wrap { position: relative; display: inline-block; margin-bottom: .5rem; }
    .img-preview {
        max-width: 100%;
        max-height: 160px;
        border-radius: var(--radius-md);
        border: .5px solid var(--border-md);
        object-fit: cover;
        display: block;
    }
    .img-remove-btn {
        position: absolute;
        top: -7px; right: -7px;
        width: 20px; height: 20px;
        background: var(--danger);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 9px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .15s;
    }
    .img-remove-btn:hover { transform: scale(1.15); }
    .img-filename {
        font-size: 10px;
        color: var(--hint);
        margin-top: .25rem;
        font-family: 'DM Mono', monospace;
        word-break: break-all;
    }

    /* ── Sidebar ──────────────────────────────────── */
    .form-sidebar { display: flex; flex-direction: column; gap: .75rem; }
    .sidebar-sticky { position: sticky; top: 1.25rem; display: flex; flex-direction: column; gap: .75rem; }

    .status-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: .75rem 1rem;
        background: var(--surface2);
        border-bottom: .5px solid var(--border);
    }
    .status-label {
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: .45rem;
    }
    .status-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-dot.active   { background: var(--success); }
    .status-dot.inactive { background: var(--hint); }

    /* Toggle */
    .toggle { position: relative; width: 36px; height: 20px; cursor: pointer; display: inline-block; }
    .toggle input { opacity: 0; width: 0; height: 0; }
    .toggle-track {
        position: absolute; inset: 0;
        background: var(--border-md);
        border-radius: 999px;
        transition: background .2s;
    }
    .toggle input:checked ~ .toggle-track { background: var(--success); }
    .toggle-thumb {
        position: absolute;
        top: 3px; left: 3px;
        width: 14px; height: 14px;
        background: #fff;
        border-radius: 50%;
        transition: transform .2s;
        pointer-events: none;
    }
    .toggle input:checked ~ .toggle-thumb { transform: translateX(16px); }

    .sidebar-info { padding: .85rem 1rem; display: flex; flex-direction: column; gap: .6rem; }
    .info-row { display: flex; flex-direction: column; gap: 2px; }
    .info-key {
        font-size: 10px;
        color: var(--hint);
        text-transform: uppercase;
        letter-spacing: .05em;
        font-family: 'DM Mono', monospace;
    }
    .info-val { font-size: 13px; font-weight: 500; }
    .info-val.mono { font-family: 'DM Mono', monospace; color: var(--accent); font-size: 12px; }

    /* Submit */
    .btn-submit {
        width: 100%;
        background: var(--text);
        color: var(--surface);
        border: none;
        border-radius: var(--radius-md);
        padding: .6rem;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .4rem;
        transition: opacity .15s;
        margin-top: .25rem;
    }
    .btn-submit:hover { opacity: .8; }

    .link-cancel {
        display: block;
        text-align: center;
        font-size: 12px;
        color: var(--hint);
        text-decoration: none;
        padding: .4rem;
        transition: color .15s;
    }
    .link-cancel:hover { color: var(--muted); }

    /* ── Alert ────────────────────────────────────── */
    .alert {
        padding: .65rem .9rem;
        border-radius: var(--radius-md);
        border-left: 2px solid;
        margin-bottom: 1.25rem;
        font-size: 13px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .alert-success { background: rgba(45,168,112,.08); border-color: var(--success); color: var(--success); }
    .alert-error   { background: rgba(217,79,79,.08);  border-color: var(--danger);  color: var(--danger); }
    .alert-warning { background: var(--warning-bg);    border-color: var(--warning); color: var(--warning); }

    /* ── History Panel ────────────────────────────── */
    .history-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
        padding: .75rem 1rem;
        cursor: pointer;
        user-select: none;
        font-size: 13px;
        font-weight: 600;
        transition: background .15s;
    }
    .history-header:hover { background: var(--surface2); }
    .history-header-left { display: flex; align-items: center; gap: .5rem; }
    .history-header-left i { color: var(--muted); }

    .history-count-badge {
        font-size: 10px;
        background: var(--warning-bg);
        border: .5px solid rgba(201,123,30,.25);
        color: var(--warning);
        padding: 1px 7px;
        border-radius: 4px;
        font-family: 'DM Mono', monospace;
    }
    .history-chevron { color: var(--hint); font-size: 11px; transition: transform .2s; }
    .history-chevron.open { transform: rotate(180deg); }

    .history-body { display: none; flex-direction: column; }
    .history-body.open { display: flex; }

    .history-item {
        padding: .75rem 1rem;
        border-top: .5px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: .4rem;
        transition: background .15s;
    }
    .history-item:hover { background: var(--surface2); }

    .history-item-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
    }
    .history-time-abs { font-size: 12px; font-weight: 600; font-family: 'DM Mono', monospace; }
    .history-time-rel { font-size: 11px; color: var(--hint); }

    .history-status {
        font-size: 10px;
        padding: 1px 6px;
        border-radius: 4px;
        font-weight: 600;
        letter-spacing: .03em;
    }
    .history-status.active   { background: rgba(45,168,112,.12); color: var(--success); border: .5px solid rgba(45,168,112,.25); }
    .history-status.inactive { background: var(--surface2);       color: var(--hint);    border: .5px solid var(--border-md); }

    .history-preview-row { display: flex; gap: .4rem; font-size: 11px; }
    .history-preview-key { color: var(--hint); min-width: 60px; flex-shrink: 0; font-family: 'DM Mono', monospace; }
    .history-preview-val { color: var(--muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 130px; }

    .btn-restore {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        width: 100%;
        padding: .4rem;
        border-radius: var(--radius-sm);
        border: .5px solid rgba(201,123,30,.3);
        background: var(--warning-bg);
        color: var(--warning);
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity .15s;
        margin-top: .1rem;
    }
    .btn-restore:hover { opacity: .75; }

    .history-empty {
        padding: 1.5rem 1rem;
        text-align: center;
        color: var(--hint);
        font-size: 12px;
    }
    .history-empty i { display: block; font-size: 18px; margin-bottom: .4rem; }

    /* ── Restore Confirm Modal ────────────────────── */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.5);
        z-index: 9998;
        display: none;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(3px);
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
        background: var(--surface);
        border: .5px solid var(--border-md);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        max-width: 380px;
        width: 90%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,.25);
        animation: modalIn .2s ease;
    }
    @keyframes modalIn {
        from { transform: scale(.94); opacity: 0; }
        to   { transform: scale(1);   opacity: 1; }
    }
    .modal-icon {
        width: 48px; height: 48px;
        background: var(--warning-bg);
        border: .5px solid rgba(201,123,30,.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto .9rem;
        font-size: 18px;
        color: var(--warning);
    }
    .modal-title { font-size: 15px; font-weight: 600; margin-bottom: .35rem; }
    .modal-desc  { font-size: 12px; color: var(--muted); margin-bottom: 1.1rem; line-height: 1.6; }
    .modal-time  {
        font-family: 'DM Mono', monospace;
        font-size: 12px;
        background: var(--surface2);
        border: .5px solid var(--border-md);
        border-radius: var(--radius-sm);
        padding: .45rem .8rem;
        margin-bottom: 1.1rem;
        color: var(--warning);
    }
    .modal-actions { display: flex; gap: .6rem; }
    .btn-modal-cancel {
        flex: 1;
        padding: .55rem;
        border-radius: var(--radius-md);
        border: .5px solid var(--border-md);
        background: transparent;
        color: var(--muted);
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all .15s;
    }
    .btn-modal-cancel:hover { border-color: var(--muted); color: var(--text); }
    .btn-modal-confirm {
        flex: 1;
        padding: .55rem;
        border-radius: var(--radius-md);
        border: none;
        background: var(--warning);
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity .15s;
    }
    .btn-modal-confirm:hover { opacity: .85; }

    /* ── Scrollbar ────────────────────────────────── */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border-md); border-radius: 3px; }
</style>
@endpush

@section('content')
<div class="page-wrap">

{{-- Alerts --}}
@if(session('success'))
<div class="alert alert-success">
    <i class="fas fa-circle-check"></i>{{ session('success') }}
</div>
@endif
@if(session('warning'))
<div class="alert alert-warning">
    <i class="fas fa-clock-rotate-left"></i>{{ session('warning') }}
</div>
@endif
@if($errors->any())
<div class="alert alert-error">
    <i class="fas fa-circle-exclamation"></i>{{ $errors->first() }}
</div>
@endif

{{-- Header --}}
<div class="form-header">
    <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div class="form-title">
        <i class="fas fa-pen-to-square"></i>
        Edit Section
    </div>
    <span class="pill pill-page">{{ $section->page }}</span>
    <span class="pill pill-key">{{ $section->section_key }}</span>
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
            <div class="card-head">
                <i class="fas fa-sliders"></i>
                {{ $section->label }}
                <span class="fields-count">{{ count($fields) }} field</span>
            </div>
            <div class="card-body">

                @if(empty($fields))
                <p style="color:var(--hint); font-size:13px; text-align:center; padding:2rem 0">
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

                <div class="field-group" id="group_{{ $key }}">
                    <label class="field-label" for="{{ $inputId }}">
                        {{ $label }}
                        <span class="type-tag">{{ $type }}</span>
                    </label>

                    {{-- TEXT --}}
                    @if($type === 'text')
                        <input type="text"
                               id="{{ $inputId }}"
                               name="{{ $key }}"
                               value="{{ old($key, $currentVal) }}"
                               placeholder="{{ $placeholder }}"
                               class="inp">

                    {{-- TEXTAREA --}}
                    @elseif($type === 'textarea')
                        <textarea id="{{ $inputId }}"
                                  name="{{ $key }}"
                                  placeholder="{{ $placeholder }}"
                                  class="inp"
                                  rows="4">{{ old($key, $currentVal) }}</textarea>

                    {{-- COLOR --}}
                    @elseif($type === 'color')
                        @php $colorVal = old($key, $currentVal ?: '#5a4fcf'); @endphp
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

                    {{-- IMAGE --}}
                    @elseif($type === 'image')
                        <div class="image-upload-area" id="drop_{{ $key }}"
                             ondragover="handleDragOver(event, this)"
                             ondragleave="handleDragLeave(event, this)"
                             ondrop="handleFileDrop(event, '{{ $key }}')">

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
                                <p class="img-filename" id="filename_{{ $key }}">{{ basename($currentVal) }}</p>
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

                            <div id="upload_prompt_{{ $key }}" {{ $currentVal ? 'style=display:none' : '' }}>
                                <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                                <div class="upload-text">
                                    <strong>Klik untuk pilih</strong> atau drag & drop gambar<br>
                                    <span style="font-size:11px; color:var(--hint)">PNG, JPG, WEBP — maks 2MB</span>
                                </div>
                            </div>

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
            <div class="sidebar-sticky">

                {{-- Publish Card --}}
                <div class="card">
                    <div class="status-row">
                        <span class="status-label">
                            <span class="status-dot {{ $section->is_active ? 'active' : 'inactive' }}"></span>
                            Status Section
                        </span>
                        <label class="toggle" title="Aktif / Nonaktif">
                            <input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}>
                            <span class="toggle-track"></span>
                            <span class="toggle-thumb"></span>
                        </label>
                    </div>

                    <div class="sidebar-info">
                        <div class="info-row">
                            <span class="info-key">Halaman</span>
                            <span class="info-val">{{ $section->page }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-key">Section Key</span>
                            <span class="info-val mono">{{ $section->section_key }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-key">Urutan</span>
                            <span class="info-val">#{{ $section->order }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-key">Terakhir diubah</span>
                            <span class="info-val" style="font-size:12px">{{ $section->updated_at->diffForHumans() }}</span>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-floppy-disk"></i>
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}"
                           class="link-cancel">
                            Batal & Kembali
                        </a>
                    </div>
                </div>

                {{-- History Panel --}}
                <div class="card">
                    <div class="history-header" onclick="toggleHistory()" id="history-toggle">
                        <div class="history-header-left">
                            <i class="fas fa-clock-rotate-left"></i>
                            Riwayat Versi
                            @if($histories->isNotEmpty())
                            <span class="history-count-badge">{{ $histories->count() }} tersimpan</span>
                            @endif
                        </div>
                        <i class="fas fa-chevron-down history-chevron" id="history-chevron"></i>
                    </div>

                    <div class="history-body" id="history-body">
                        @if($histories->isEmpty())
                        <div class="history-empty">
                            <i class="fas fa-history"></i>
                            Belum ada riwayat.<br>
                            <span style="font-size:11px">Riwayat tersimpan otomatis setiap kali menyimpan.</span>
                        </div>
                        @else
                        @foreach($histories as $history)
                        <div class="history-item">
                            <div class="history-item-top">
                                <div>
                                    <div class="history-time-abs">{{ $history->saved_at->format('d M Y, H:i') }}</div>
                                    <div class="history-time-rel">{{ $history->saved_at->diffForHumans() }}</div>
                                </div>
                                <span class="history-status {{ $history->is_active ? 'active' : 'inactive' }}">
                                    {{ $history->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                </span>
                            </div>

                            @php
                                $previewFields  = array_slice($section->getFields(), 0, 3);
                                $previewContent = $history->content ?? [];
                            @endphp
                            <div>
                                @foreach($previewFields as $pf)
                                @php
                                    $pVal    = $previewContent[$pf['key']] ?? null;
                                    $showVal = ($pVal && !in_array($pf['type'], ['image','color']))
                                        ? Str::limit(strip_tags($pVal), 35)
                                        : null;
                                @endphp
                                @if($showVal)
                                <div class="history-preview-row">
                                    <span class="history-preview-key">{{ Str::limit($pf['label'], 10) }}</span>
                                    <span class="history-preview-val">{{ $showVal }}</span>
                                </div>
                                @endif
                                @endforeach
                            </div>

                            <button type="button"
                                    class="btn-restore"
                                    onclick="confirmRestore({{ $history->id }}, '{{ $history->saved_at->format('d M Y, H:i') }}', '{{ $history->saved_at->diffForHumans() }}')">
                                <i class="fas fa-rotate-left"></i>
                                Pulihkan versi ini
                            </button>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</form>

{{-- Restore Confirm Modal --}}
<div class="modal-overlay" id="restore-modal">
    <div class="modal-box">
        <div class="modal-icon"><i class="fas fa-rotate-left"></i></div>
        <div class="modal-title">Pulihkan Versi Ini?</div>
        <div class="modal-desc">
            Data saat ini akan digantikan dengan versi yang dipilih.<br>
            Tenang — versi saat ini akan otomatis disimpan ke riwayat.
        </div>
        <div class="modal-time" id="modal-time-display">—</div>
        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeRestoreModal()">Batal</button>
            <button type="button" class="btn-modal-confirm" id="btn-confirm-restore">
                <i class="fas fa-rotate-left"></i> Ya, Pulihkan
            </button>
        </div>
    </div>
</div>

{{-- Hidden restore forms --}}
@foreach($histories as $history)
<form method="POST"
      action="{{ route('admin.cms.page-sections.restore', [$section, $history]) }}"
      id="restore-form-{{ $history->id }}"
      style="display:none">
    @csrf
</form>
@endforeach

</div>{{-- /page-wrap --}}
@endsection

@push('scripts')
<script>
/* ── Image Upload ───────────────────────────────── */
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
    document.getElementById('drop_' + key).classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
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
    if (!area.contains(e.relatedTarget)) area.classList.remove('drag-over');
}

function showImagePreview(key, file) {
    const reader = new FileReader();
    reader.onload = function(ev) {
        const wrap   = document.getElementById('preview_wrap_' + key);
        const img    = document.getElementById('preview_' + key);
        const fname  = document.getElementById('filename_' + key);
        const prompt = document.getElementById('upload_prompt_' + key);
        img.src            = ev.target.result;
        fname.textContent  = file.name;
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
    img.src            = '';
    fname.textContent  = '';
    input.value        = '';
    wrap.style.display = 'none';
    if (prompt) prompt.style.display = 'block';
}

/* ── Color Sync ─────────────────────────────────── */
function syncColorFromHex(hexInput, colorInputId) {
    const val = hexInput.value;
    if (/^#[0-9a-fA-F]{6}$/.test(val)) {
        const colorInput = document.getElementById(colorInputId);
        colorInput.value = val;
        colorInput.closest('.color-swatch-btn').style.background = val;
    }
}

/* ── History Toggle ─────────────────────────────── */
function toggleHistory() {
    document.getElementById('history-body').classList.toggle('open');
    document.getElementById('history-chevron').classList.toggle('open');
}

document.addEventListener('DOMContentLoaded', () => {
    @if($histories->isNotEmpty())
    toggleHistory();
    @endif
});

/* ── Restore Modal ──────────────────────────────── */
let pendingRestoreId = null;

function confirmRestore(historyId, timeAbs, timeRel) {
    pendingRestoreId = historyId;
    document.getElementById('modal-time-display').textContent = timeAbs + ' (' + timeRel + ')';
    document.getElementById('restore-modal').classList.add('open');
}

function closeRestoreModal() {
    document.getElementById('restore-modal').classList.remove('open');
    pendingRestoreId = null;
}

document.getElementById('btn-confirm-restore').addEventListener('click', () => {
    if (!pendingRestoreId) return;
    const form = document.getElementById('restore-form-' + pendingRestoreId);
    if (form) form.submit();
});

document.getElementById('restore-modal').addEventListener('click', function(e) {
    if (e.target === this) closeRestoreModal();
});

/* ── Unsaved changes warning ────────────────────── */
let formChanged = false;
const form = document.getElementById('section-form');
if (form) {
    form.addEventListener('change', () => { formChanged = true; });
    form.addEventListener('submit', () => { formChanged = false; });
    window.addEventListener('beforeunload', e => {
        if (formChanged) { e.preventDefault(); e.returnValue = ''; }
    });
}
</script>
@endpush