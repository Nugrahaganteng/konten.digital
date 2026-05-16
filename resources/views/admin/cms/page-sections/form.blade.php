@extends('layouts.admin')

@section('title', 'Edit — ' . $section->label)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════════════
   NEOBRUTALISM — EDIT SECTION
   ═════════════════════════════════════════════════════ */
:root {
    --white:     #F5F0E8;
    --black:     #0D0D0D;
    --yellow:    #F5C800;
    --coral:     #FF5A36;
    --mint:      #00C48C;
    --blue:      #1A56FF;
    --purple:    #7B2FFF;
    --text:      #0D0D0D;
    --text2:     #3D3D3D;
    --muted:     #7A7A7A;
    --border:    3px solid #0D0D0D;
    --shadow:    4px 4px 0px #0D0D0D;
    --shadow-lg: 6px 6px 0px #0D0D0D;
    --r:         4px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--white);
    color: var(--text);
    font-family: 'Space Grotesk', sans-serif;
    font-size: 13px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
}

/* ── Ticker ─────────────────────────────────────────── */
.ticker-bar {
    background: var(--black);
    padding: 6px 0;
    overflow: hidden;
    white-space: nowrap;
    border-bottom: var(--border);
}
.ticker-inner {
    display: inline-block;
    animation: ticker 16s linear infinite;
    font-family: 'JetBrains Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    color: var(--yellow);
    letter-spacing: .14em;
    text-transform: uppercase;
}
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ── Top Nav ──────────────────────────────────────────── */
.top-nav {
    background: var(--yellow);
    border-bottom: var(--border);
    padding: .85rem 1.5rem;
    display: flex;
    align-items: center;
    gap: .75rem;
    flex-wrap: wrap;
}
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    font-family: 'JetBrains Mono', monospace;
    font-size: .62rem;
    font-weight: 700;
    color: var(--black);
    text-decoration: none;
    padding: .42rem .9rem;
    border: var(--border);
    background: var(--white);
    text-transform: uppercase;
    letter-spacing: .05em;
    transition: all .12s;
    box-shadow: var(--shadow);
}
.btn-back:hover { background: var(--black); color: var(--yellow); box-shadow: 2px 2px 0 #7A7A7A; }
.breadcrumb-sep { color: var(--black); font-family: 'JetBrains Mono', monospace; font-size: .75rem; font-weight: 700; }
.page-title-wrap { display: flex; align-items: center; gap: .6rem; flex: 1; }
.page-heading {
    font-family: 'Syne', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--black);
    letter-spacing: -.02em;
    line-height: 1;
}
.pill {
    font-family: 'JetBrains Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    padding: 3px 8px;
    border: 2px solid var(--black);
    text-transform: uppercase;
    letter-spacing: .06em;
}
.pill-page { background: var(--white); color: var(--black); }
.pill-key  { background: var(--black); color: var(--yellow); }

/* Unsaved pip */
.unsaved-pip {
    display: none;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--coral);
    border: 2px solid var(--black);
    animation: pipBlink .8s step-end infinite;
}
body.has-changes .unsaved-pip { display: inline-block; }
@keyframes pipBlink { 0%,100% { opacity:1; } 50% { opacity:0; } }

/* ── Alerts ─────────────────────────────────────────── */
.alerts-wrap { padding: .75rem 1.5rem 0; }
.alert {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .65rem .9rem;
    border: var(--border);
    box-shadow: var(--shadow);
    margin-bottom: .6rem;
    font-family: 'JetBrains Mono', monospace;
    font-size: .68rem;
    font-weight: 600;
    letter-spacing: .03em;
    animation: slideDown .22s ease;
}
.alert-success { background: #D4F5E4; color: #005C33; }
.alert-error   { background: #FFE0D9; color: #8B1A00; }
.alert-warning { background: #FFF8D6; color: #7A5500; }
@keyframes slideDown { from { opacity:0; transform:translateY(-5px); } to { opacity:1; transform:translateY(0); } }

/* ── Form Layout ───────────────────────────────────── */
.form-layout {
    display: grid;
    grid-template-columns: 1fr 270px;
    gap: 1.1rem;
    align-items: start;
    padding: 1.35rem 1.5rem 5rem;
}
@media (max-width: 860px) {
    .form-layout { grid-template-columns: 1fr; padding: 1rem; }
    .form-sidebar { order: -1; }
}

/* ── Card ───────────────────────────────────────────── */
.card {
    background: var(--white);
    border: var(--border);
    box-shadow: var(--shadow);
    transition: box-shadow .12s, transform .12s;
}
.card:hover { box-shadow: var(--shadow-lg); transform: translate(-1px, -1px); }

.card-head {
    display: flex;
    align-items: center;
    gap: .6rem;
    padding: .75rem 1rem;
    background: var(--black);
    border-bottom: var(--border);
}
.card-head-label {
    font-family: 'Syne', sans-serif;
    font-size: 1.05rem;
    font-weight: 700;
    letter-spacing: -.01em;
    color: var(--white);
}
.card-head i { color: var(--yellow); font-size: .85rem; }
.field-count-chip {
    margin-left: auto;
    font-family: 'JetBrains Mono', monospace;
    font-size: .58rem;
    font-weight: 700;
    background: var(--yellow);
    color: var(--black);
    padding: 2px 8px;
    border: 2px solid var(--yellow);
    letter-spacing: .06em;
}

.card-body { padding: 1.1rem; display: flex; flex-direction: column; gap: 1.1rem; }

/* ── Field Group ───────────────────────────────────── */
.field-group { display: flex; flex-direction: column; gap: .5rem; }
.field-group + .field-group { padding-top: 1.1rem; border-top: 2px solid rgba(0,0,0,.1); }
.field-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .68rem;
    font-weight: 700;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: .4rem;
    text-transform: uppercase;
    letter-spacing: .06em;
}
.type-chip {
    font-family: 'JetBrains Mono', monospace;
    font-size: .55rem;
    background: var(--black);
    color: var(--white);
    padding: 1px 6px;
    letter-spacing: .04em;
}

/* ── Inputs ─────────────────────────────────────────── */
.inp {
    width: 100%;
    background: var(--white);
    border: var(--border);
    color: var(--text);
    font-size: .85rem;
    padding: .6rem .85rem;
    outline: none;
    transition: box-shadow .12s;
    font-family: 'Space Grotesk', sans-serif;
    resize: none;
    border-radius: 0;
    box-shadow: var(--shadow);
}
.inp:focus { box-shadow: 5px 5px 0 var(--blue); }
.inp::placeholder { color: #aaa; }
textarea.inp { min-height: 90px; line-height: 1.65; }

/* ── Color Picker ───────────────────────────────────── */
.color-wrap { display: flex; align-items: center; gap: .6rem; }
.color-swatch-btn {
    width: 42px; height: 42px;
    border: var(--border);
    cursor: pointer;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: box-shadow .12s;
}
.color-swatch-btn:hover { box-shadow: 5px 5px 0 var(--black); }
.color-swatch-btn input[type="color"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; border: none; padding: 0; }
.color-hex { font-family: 'JetBrains Mono', monospace; font-size: .75rem; flex: 1; }

/* ── Image Upload ───────────────────────────────────── */
.image-upload-area {
    border: 3px dashed var(--black);
    padding: 1.5rem 1rem;
    text-align: center;
    transition: background .12s, box-shadow .12s;
    cursor: pointer;
    position: relative;
    background: var(--white);
}
.image-upload-area:hover,
.image-upload-area.drag-over {
    background: #EDE8DC;
    box-shadow: var(--shadow);
}
.image-upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
.upload-icon { font-size: 1.4rem; color: var(--muted); margin-bottom: .4rem; }
.upload-text { font-family: 'JetBrains Mono', monospace; font-size: .65rem; color: var(--muted); line-height: 1.7; }
.upload-text strong { color: var(--black); font-weight: 700; }

.img-preview-wrap { position: relative; display: inline-block; margin-bottom: .4rem; }
.img-preview { max-width: 100%; max-height: 150px; border: var(--border); box-shadow: var(--shadow); object-fit: cover; display: block; }
.img-remove-btn {
    position: absolute; top: -10px; right: -10px;
    width: 22px; height: 22px;
    background: var(--coral);
    border: 2px solid var(--black);
    color: var(--white);
    font-size: .55rem;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: transform .12s;
}
.img-remove-btn:hover { transform: scale(1.15); }
.img-filename { font-family: 'JetBrains Mono', monospace; font-size: .6rem; color: var(--muted); margin-top: .3rem; word-break: break-all; }

/* ── Sidebar ────────────────────────────────────────── */
.form-sidebar { display: flex; flex-direction: column; gap: .85rem; }
.sidebar-sticky { position: sticky; top: 1.25rem; display: flex; flex-direction: column; gap: .85rem; }

/* Status row */
.status-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: .75rem 1rem;
    background: var(--black);
    border-bottom: var(--border);
}
.status-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .65rem; font-weight: 700;
    color: var(--white);
    text-transform: uppercase; letter-spacing: .06em;
    display: flex; align-items: center; gap: .4rem;
}
.s-dot { width: 7px; height: 7px; border-radius: 50%; border: 1.5px solid rgba(255,255,255,.4); }
.s-dot.on  { background: var(--mint); }
.s-dot.off { background: #555; }

/* Toggle */
.toggle { position: relative; width: 36px; height: 19px; cursor: pointer; display: inline-block; }
.toggle input { opacity: 0; width: 0; height: 0; }
.toggle-track { position: absolute; inset: 0; background: #555; border-radius: 999px; border: 2px solid #888; transition: all .2s; }
.toggle input:checked ~ .toggle-track { background: var(--mint); border-color: #00a078; }
.toggle-thumb { position: absolute; top: 3px; left: 3px; width: 13px; height: 13px; background: #888; border-radius: 50%; transition: transform .2s, background .2s; pointer-events: none; }
.toggle input:checked ~ .toggle-thumb { transform: translateX(17px); background: var(--white); }

/* Sidebar info */
.sidebar-info { padding: .9rem 1rem; display: flex; flex-direction: column; gap: .7rem; }
.info-row { display: flex; flex-direction: column; gap: 2px; }
.info-k { font-family: 'JetBrains Mono', monospace; font-size: .55rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); }
.info-v { font-size: .82rem; font-weight: 600; color: var(--text); }
.info-v.mono {
    font-family: 'JetBrains Mono', monospace;
    font-size: .7rem;
    color: var(--black);
    background: var(--yellow);
    border: 2px solid var(--black);
    padding: 1px 7px;
    display: inline-block;
}

/* Submit Button */
.btn-submit {
    width: 100%;
    position: relative;
    overflow: hidden;
    background: var(--yellow);
    color: var(--black);
    border: var(--border);
    box-shadow: var(--shadow);
    padding: .8rem;
    font-family: 'Syne', sans-serif;
    font-size: 1.05rem;
    font-weight: 800;
    letter-spacing: .05em;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    transition: all .12s;
    border-radius: 0;
    margin-top: .2rem;
}
.btn-submit:hover { background: var(--black); color: var(--yellow); box-shadow: 2px 2px 0 #7A7A7A; }
.btn-submit:active { transform: translate(3px, 3px); box-shadow: 1px 1px 0 var(--black); }

.link-cancel {
    display: block; text-align: center;
    font-family: 'JetBrains Mono', monospace;
    font-size: .62rem; font-weight: 700;
    color: var(--muted);
    text-decoration: none;
    padding: .45rem;
    transition: color .12s;
    text-transform: uppercase;
    letter-spacing: .06em;
}
.link-cancel:hover { color: var(--coral); text-decoration: underline; }

/* ── History Panel ──────────────────────────────────── */
.history-hd {
    display: flex; align-items: center; justify-content: space-between;
    padding: .75rem 1rem;
    cursor: pointer; user-select: none;
    font-family: 'JetBrains Mono', monospace;
    font-size: .65rem; font-weight: 700;
    color: var(--white);
    text-transform: uppercase; letter-spacing: .06em;
    background: var(--black);
    border-bottom: var(--border);
    transition: background .12s;
}
.history-hd:hover { background: #222; }
.history-hd-left { display: flex; align-items: center; gap: .5rem; }
.history-hd i { color: var(--yellow); }
.history-badge {
    font-family: 'JetBrains Mono', monospace;
    font-size: .58rem; font-weight: 700;
    background: var(--yellow);
    color: var(--black);
    padding: 1px 7px;
    border: 2px solid var(--yellow);
    letter-spacing: .04em;
}
.history-chevron { color: #888; font-size: .65rem; transition: transform .2s; }
.history-chevron.open { transform: rotate(180deg); }

.history-body { display: none; flex-direction: column; }
.history-body.open { display: flex; }

.history-item {
    padding: .75rem 1rem;
    border-top: 2px solid rgba(0,0,0,.07);
    display: flex; flex-direction: column; gap: .4rem;
    transition: background .12s;
}
.history-item:hover { background: #EDE8DC; }

.history-item-top { display: flex; align-items: center; justify-content: space-between; gap: .5rem; }
.h-time-abs { font-family: 'JetBrains Mono', monospace; font-size: .68rem; font-weight: 700; color: var(--text); }
.h-time-rel { font-family: 'JetBrains Mono', monospace; font-size: .6rem; color: var(--muted); margin-top: 1px; }
.h-status {
    font-family: 'JetBrains Mono', monospace; font-size: .56rem;
    padding: 2px 7px; font-weight: 700; letter-spacing: .04em;
    border: 2px solid;
}
.h-status.on  { background: #D4F5E4; color: #005C33; border-color: #005C33; }
.h-status.off { background: #eee; color: var(--muted); border-color: var(--muted); }

.h-preview { font-family: 'JetBrains Mono', monospace; font-size: .6rem; display: flex; gap: .35rem; }
.h-pk { color: var(--muted); min-width: 55px; flex-shrink: 0; }
.h-pv { color: var(--text2); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 120px; font-weight: 600; }

.btn-restore {
    display: flex; align-items: center; justify-content: center; gap: .35rem;
    width: 100%; padding: .4rem;
    border: var(--border);
    background: var(--white);
    color: var(--black);
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem; font-weight: 700;
    cursor: pointer; letter-spacing: .05em; text-transform: uppercase;
    transition: all .12s;
    margin-top: .1rem;
    box-shadow: 2px 2px 0 var(--black);
}
.btn-restore:hover { background: var(--yellow); box-shadow: 3px 3px 0 var(--black); }

.history-empty {
    padding: 1.5rem 1rem; text-align: center;
    color: var(--muted);
    font-family: 'JetBrains Mono', monospace;
    font-size: .65rem; line-height: 1.8;
}
.history-empty i { display: block; font-size: 1.2rem; margin-bottom: .4rem; opacity: .25; }

/* ── Modal ─────────────────────────────────────────── */
.modal-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 9998;
    display: none; align-items: center; justify-content: center;
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: var(--white);
    border: var(--border);
    box-shadow: var(--shadow-lg);
    padding: 1.75rem;
    max-width: 360px; width: 90%;
    text-align: center;
    animation: modalPop .25s cubic-bezier(.34,1.56,.64,1);
}
@keyframes modalPop {
    from { transform: scale(.88) translateY(16px); opacity: 0; }
    to   { transform: scale(1) translateY(0); opacity: 1; }
}
.modal-icon {
    width: 52px; height: 52px;
    background: var(--yellow);
    border: var(--border);
    box-shadow: var(--shadow);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.2rem;
    color: var(--black);
}
.modal-title {
    font-family: 'Syne', sans-serif;
    font-size: 1.4rem; font-weight: 800;
    letter-spacing: -.02em;
    color: var(--black);
    margin-bottom: .4rem;
}
.modal-desc { font-size: .8rem; color: var(--text2); margin-bottom: .9rem; line-height: 1.65; }
.modal-time {
    font-family: 'JetBrains Mono', monospace; font-size: .72rem;
    background: #EDE8DC;
    border: var(--border);
    padding: .45rem .8rem; margin-bottom: 1.1rem;
    color: var(--black); font-weight: 700;
}
.modal-actions { display: flex; gap: .6rem; }
.btn-modal-cancel {
    flex: 1; padding: .55rem;
    border: var(--border); background: var(--white); color: var(--text);
    font-family: 'JetBrains Mono', monospace; font-size: .68rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .05em;
    cursor: pointer; transition: all .12s;
    box-shadow: 2px 2px 0 var(--black);
}
.btn-modal-cancel:hover { background: var(--coral); color: var(--white); }
.btn-modal-confirm {
    flex: 1; padding: .55rem;
    border: var(--border); background: var(--yellow); color: var(--black);
    font-family: 'Syne', sans-serif; font-size: .95rem; font-weight: 800;
    cursor: pointer; transition: all .12s;
    box-shadow: 2px 2px 0 var(--black);
}
.btn-modal-confirm:hover { background: var(--black); color: var(--yellow); }

/* ── Scrollbar ─────────────────────────────────────── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--white); }
::-webkit-scrollbar-thumb { background: var(--black); border-radius: 2px; }
</style>
@endpush

@section('content')
<div class="page-wrap" style="min-height:100vh; position:relative; z-index:1; animation: wakeUp .35s ease both;">
<style>
@keyframes wakeUp { from { opacity:0; transform:translateY(5px); } to { opacity:1; transform:translateY(0); } }
</style>

    {{-- Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-inner">
            ◆ EDIT SECTION MODE &nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN &nbsp;&nbsp; ◆ {{ strtoupper($section->section_key) }} &nbsp;&nbsp; ◆ EDIT SECTION MODE &nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN &nbsp;&nbsp; ◆ {{ strtoupper($section->section_key) }} &nbsp;&nbsp;
        </div>
    </div>

    {{-- Top Nav --}}
    <div class="top-nav">
        <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> KEMBALI
        </a>
        <span class="breadcrumb-sep">/</span>
        <div class="page-title-wrap">
            <div class="page-heading">EDIT SECTION</div>
            <span class="unsaved-pip" title="Ada perubahan belum disimpan"></span>
        </div>
        <span class="pill pill-page">{{ $section->page }}</span>
        <span class="pill pill-key">{{ $section->section_key }}</span>
    </div>

    {{-- Alerts --}}
    <div class="alerts-wrap">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('warning'))
        <div class="alert alert-warning"><i class="fas fa-clock-rotate-left"></i> {{ session('warning') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-error"><i class="fas fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif
    </div>

    {{-- Form --}}
    <form method="POST"
        action="{{ route('admin.cms.page-sections.update', $section) }}"
        enctype="multipart/form-data"
        id="section-form">
        @csrf @method('PUT')

        <div class="form-layout">
            {{-- MAIN FIELDS --}}
            <div class="card">
                <div class="card-head">
                    <i class="fas fa-sliders"></i>
                    <span class="card-head-label">{{ $section->label }}</span>
                    <span class="field-count-chip">{{ count($fields) }} FIELDS</span>
                </div>
                <div class="card-body">
                    @if(empty($fields))
                    <p style="font-family:'JetBrains Mono',monospace;font-size:.65rem;color:var(--muted);text-align:center;padding:2rem 0">NO FIELDS FOR THIS SECTION.</p>
                    @else
                    @foreach($fields as $idx => $field)
                    @php
                        $key = $field['key']; $label = $field['label']; $type = $field['type'];
                        $placeholder = $field['placeholder'] ?? ''; $currentVal = $section->get($key, '');
                        $inputId = 'field_' . $key;
                    @endphp
                    <div class="field-group" id="group_{{ $key }}">
                        <label class="field-label" for="{{ $inputId }}">
                            {{ strtoupper($label) }}
                            <span class="type-chip">{{ strtoupper($type) }}</span>
                        </label>

                        @if($type === 'text')
                            <input type="text" id="{{ $inputId }}" name="{{ $key }}" value="{{ old($key, $currentVal) }}" placeholder="{{ $placeholder }}" class="inp">

                        @elseif($type === 'textarea')
                            <textarea id="{{ $inputId }}" name="{{ $key }}" placeholder="{{ $placeholder }}" class="inp" rows="4">{{ old($key, $currentVal) }}</textarea>

                        @elseif($type === 'color')
                            @php $colorVal = old($key, $currentVal ?: '#F5C800'); @endphp
                            <div class="color-wrap">
                                <label class="color-swatch-btn" style="background:{{ $colorVal }}">
                                    <input type="color" name="{{ $key }}" value="{{ $colorVal }}" id="{{ $inputId }}"
                                        onchange="this.closest('.color-swatch-btn').style.background=this.value; document.getElementById('hex_{{ $key }}').value=this.value;">
                                </label>
                                <input type="text" id="hex_{{ $key }}" value="{{ $colorVal }}" placeholder="#000000" class="inp color-hex" maxlength="7"
                                    oninput="syncColorFromHex(this, '{{ $inputId }}')">
                            </div>

                        @elseif($type === 'image')
                            <div class="image-upload-area" id="drop_{{ $key }}"
                                ondragover="handleDragOver(event, this)"
                                ondragleave="handleDragLeave(event, this)"
                                ondrop="handleFileDrop(event, '{{ $key }}')">

                                @if($currentVal)
                                <div class="img-preview-wrap" id="preview_wrap_{{ $key }}">
                                    <img src="{{ Storage::url($currentVal) }}" alt="" class="img-preview" id="preview_{{ $key }}">
                                    <button type="button" class="img-remove-btn" onclick="clearImage('{{ $key }}')"><i class="fas fa-times"></i></button>
                                    <p class="img-filename" id="filename_{{ $key }}">{{ basename($currentVal) }}</p>
                                </div>
                                @else
                                <div id="preview_wrap_{{ $key }}" style="display:none">
                                    <img src="" alt="" class="img-preview" id="preview_{{ $key }}">
                                    <button type="button" class="img-remove-btn" onclick="clearImage('{{ $key }}')"><i class="fas fa-times"></i></button>
                                    <p class="img-filename" id="filename_{{ $key }}"></p>
                                </div>
                                @endif

                                <div id="upload_prompt_{{ $key }}" {{ $currentVal ? 'style=display:none' : '' }}>
                                    <div class="upload-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                                    <div class="upload-text">
                                        <strong>KLIK UNTUK PILIH</strong> ATAU DRAG & DROP<br>
                                        <span style="font-size:.6rem;color:#bbb">PNG · JPG · WEBP — MAX 2MB</span>
                                    </div>
                                </div>
                                <input type="file" name="{{ $key }}" id="{{ $inputId }}" accept="image/*" onchange="handleImageChange(this, '{{ $key }}')">
                            </div>
                        @endif
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="form-sidebar">
                <div class="sidebar-sticky">
                    {{-- Publish Card --}}
                    <div class="card">
                        <div class="status-row">
                            <span class="status-label">
                                <span class="s-dot {{ $section->is_active ? 'on' : 'off' }}"></span>
                                STATUS
                            </span>
                            <label class="toggle">
                                <input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}>
                                <span class="toggle-track"></span>
                                <span class="toggle-thumb"></span>
                            </label>
                        </div>
                        <div class="sidebar-info">
                            <div class="info-row">
                                <span class="info-k">HALAMAN</span>
                                <span class="info-v">{{ strtoupper($section->page) }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">SECTION KEY</span>
                                <span class="info-v mono">{{ $section->section_key }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">URUTAN</span>
                                <span class="info-v">#{{ $section->order }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-k">LAST UPDATE</span>
                                <span class="info-v" style="font-size:.75rem">{{ $section->updated_at->diffForHumans() }}</span>
                            </div>
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-floppy-disk"></i> SIMPAN PERUBAHAN
                            </button>
                            <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="link-cancel">
                                BATAL & KEMBALI
                            </a>
                        </div>
                    </div>

                    {{-- History Card --}}
                    <div class="card">
                        <div class="history-hd" onclick="toggleHistory()">
                            <div class="history-hd-left">
                                <i class="fas fa-clock-rotate-left"></i>
                                RIWAYAT
                                @if($histories->isNotEmpty())
                                <span class="history-badge">{{ $histories->count() }}</span>
                                @endif
                            </div>
                            <i class="fas fa-chevron-down history-chevron" id="history-chevron"></i>
                        </div>
                        <div class="history-body" id="history-body">
                            @if($histories->isEmpty())
                            <div class="history-empty">
                                <i class="fas fa-history"></i>
                                BELUM ADA RIWAYAT.<br>TERSIMPAN OTOMATIS SAAT SAVE.
                            </div>
                            @else
                            @foreach($histories as $history)
                            <div class="history-item">
                                <div class="history-item-top">
                                    <div>
                                        <div class="h-time-abs">{{ $history->saved_at->format('d M Y, H:i') }}</div>
                                        <div class="h-time-rel">{{ $history->saved_at->diffForHumans() }}</div>
                                    </div>
                                    <span class="h-status {{ $history->is_active ? 'on' : 'off' }}">
                                        {{ $history->is_active ? 'ON' : 'OFF' }}
                                    </span>
                                </div>
                                @php $pfs = array_slice($section->getFields(), 0, 3); $pc = $history->content ?? []; @endphp
                                @foreach($pfs as $pf)
                                @php $pv = $pc[$pf['key']] ?? null; $sv = ($pv && !in_array($pf['type'], ['image','color'])) ? Str::limit(strip_tags($pv), 30) : null; @endphp
                                @if($sv)
                                <div class="h-preview">
                                    <span class="h-pk">{{ Str::limit($pf['label'], 8) }}</span>
                                    <span class="h-pv">{{ $sv }}</span>
                                </div>
                                @endif
                                @endforeach
                                <button type="button" class="btn-restore"
                                    onclick="confirmRestore({{ $history->id }}, '{{ $history->saved_at->format('d M Y, H:i') }}', '{{ $history->saved_at->diffForHumans() }}')">
                                    <i class="fas fa-rotate-left"></i> PULIHKAN
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

    {{-- Modal --}}
    <div class="modal-overlay" id="restore-modal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-rotate-left"></i></div>
            <div class="modal-title">PULIHKAN VERSI?</div>
            <div class="modal-desc">Data saat ini akan digantikan. Versi ini akan otomatis disimpan ke riwayat.</div>
            <div class="modal-time" id="modal-time-display">—</div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeRestoreModal()">BATAL</button>
                <button type="button" class="btn-modal-confirm" id="btn-confirm-restore">
                    <i class="fas fa-rotate-left"></i> PULIHKAN
                </button>
            </div>
        </div>
    </div>

    @foreach($histories as $history)
    <form method="POST" action="{{ route('admin.cms.page-sections.restore', [$section, $history]) }}" id="restore-form-{{ $history->id }}" style="display:none">
        @csrf
    </form>
    @endforeach

</div>
@endsection

@push('scripts')
<script>
function handleImageChange(input, key) {
    const file = input.files[0]; if (!file) return;
    if (file.size > 2*1024*1024) { alert('File melebihi 2MB'); input.value=''; return; }
    showImagePreview(key, file);
}
function handleFileDrop(e, key) {
    e.preventDefault(); document.getElementById('drop_'+key).classList.remove('drag-over');
    const file = e.dataTransfer.files[0]; if (!file || !file.type.startsWith('image/')) return;
    const input = document.getElementById('field_'+key);
    const dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
    showImagePreview(key, file);
}
function handleDragOver(e, area) { e.preventDefault(); area.classList.add('drag-over'); }
function handleDragLeave(e, area) { if (!area.contains(e.relatedTarget)) area.classList.remove('drag-over'); }
function showImagePreview(key, file) {
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('preview_'+key).src = ev.target.result;
        document.getElementById('filename_'+key).textContent = file.name;
        document.getElementById('preview_wrap_'+key).style.display = 'inline-block';
        const p = document.getElementById('upload_prompt_'+key); if (p) p.style.display = 'none';
    }; reader.readAsDataURL(file);
}
function clearImage(key) {
    document.getElementById('preview_'+key).src = '';
    document.getElementById('filename_'+key).textContent = '';
    document.getElementById('field_'+key).value = '';
    document.getElementById('preview_wrap_'+key).style.display = 'none';
    const p = document.getElementById('upload_prompt_'+key); if (p) p.style.display = 'block';
}
function syncColorFromHex(hexInput, id) {
    const v = hexInput.value;
    if (/^#[0-9a-fA-F]{6}$/.test(v)) { const c = document.getElementById(id); c.value = v; c.closest('.color-swatch-btn').style.background = v; }
}
function toggleHistory() {
    document.getElementById('history-body').classList.toggle('open');
    document.getElementById('history-chevron').classList.toggle('open');
}
document.addEventListener('DOMContentLoaded', () => { @if($histories->isNotEmpty()) toggleHistory(); @endif });
let pendingRestoreId = null;
function confirmRestore(id, abs, rel) {
    pendingRestoreId = id;
    document.getElementById('modal-time-display').textContent = abs + ' (' + rel + ')';
    document.getElementById('restore-modal').classList.add('open');
}
function closeRestoreModal() { document.getElementById('restore-modal').classList.remove('open'); pendingRestoreId = null; }
document.getElementById('btn-confirm-restore').addEventListener('click', () => {
    if (!pendingRestoreId) return;
    document.getElementById('restore-form-'+pendingRestoreId)?.submit();
});
document.getElementById('restore-modal').addEventListener('click', function(e) { if (e.target === this) closeRestoreModal(); });
let formChanged = false;
const form = document.getElementById('section-form');
if (form) {
    form.addEventListener('change', () => { formChanged = true; document.body.classList.add('has-changes'); });
    form.addEventListener('submit', () => { formChanged = false; document.body.classList.remove('has-changes'); });
    window.addEventListener('beforeunload', e => { if (formChanged) { e.preventDefault(); e.returnValue = ''; } });
}
</script>
@endpush