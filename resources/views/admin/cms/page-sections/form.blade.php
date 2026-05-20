@extends('layouts.admin')

@section('title', 'Edit — ' . $section->label)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════════
   NEOBRUTALISM — EDIT SECTION v4
   Form KIRI · Sidebar KANAN · Responsive
══════════════════════════════════════════════════ */
:root {
    --w:   #F5F0E8;
    --blk: #0D0D0D;
    --yel: #F5C800;
    --cor: #FF5A36;
    --mnt: #00C48C;
    --blu: #1A56FF;
    --pur: #7B2FFF;
    --txt: #0D0D0D;
    --txt2:#3D3D3D;
    --mu:  #7A7A7A;
    --bd:  3px solid #0D0D0D;
    --sh:  4px 4px 0 #0D0D0D;
    --shlg:6px 6px 0 #0D0D0D;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html,body{overflow-x:hidden!important;max-width:100%!important}
body{background:var(--w);color:var(--txt);font-family:'Space Grotesk',sans-serif;font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}

/* ── Ticker ── */
.ticker-bar{background:var(--blk);padding:5px 0;overflow:hidden;white-space:nowrap;border-bottom:var(--bd)}
.ticker-inner{display:inline-block;animation:ticker 18s linear infinite;font-family:'JetBrains Mono',monospace;font-size:.56rem;font-weight:700;color:var(--yel);letter-spacing:.13em;text-transform:uppercase;padding-left:100%}
@keyframes ticker{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* ── Top Nav ── */
.top-nav{background:var(--yel);border-bottom:var(--bd);padding:.8rem 1.5rem;display:flex;align-items:center;gap:.65rem;flex-wrap:nowrap;overflow:hidden}
.btn-back{display:inline-flex;align-items:center;gap:.35rem;font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;color:var(--blk);text-decoration:none;padding:.42rem .85rem;border:var(--bd);background:var(--w);text-transform:uppercase;letter-spacing:.04em;box-shadow:var(--sh);flex-shrink:0;white-space:nowrap;transition:all .12s;min-height:34px}
.btn-back:hover{background:var(--blk);color:var(--yel)}
.nav-sep{color:var(--blk);font-family:'JetBrains Mono',monospace;font-weight:700;flex-shrink:0}
.nav-title-wrap{display:flex;align-items:center;gap:.5rem;flex:1;min-width:0;overflow:hidden}
.page-heading{font-family:'Syne',sans-serif;font-size:clamp(.9rem,3.5vw,1.45rem);font-weight:800;color:var(--blk);letter-spacing:-.02em;line-height:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.unsaved-pip{display:none;width:9px;height:9px;border-radius:50%;background:var(--cor);border:2px solid var(--blk);animation:blink .8s step-end infinite;flex-shrink:0}
body.has-changes .unsaved-pip{display:inline-block}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
.pill{font-family:'JetBrains Mono',monospace;font-size:.55rem;font-weight:700;padding:2px 8px;border:2px solid var(--blk);text-transform:uppercase;letter-spacing:.05em;flex-shrink:0;white-space:nowrap}
.pill-page{background:var(--w);color:var(--blk)}
.pill-key{background:var(--blk);color:var(--yel)}

/* ── Alerts ── */
.alerts-wrap{padding:.65rem 1.5rem 0}
.alert{display:flex;align-items:center;gap:.5rem;padding:.6rem .85rem;border:var(--bd);box-shadow:var(--sh);margin-bottom:.5rem;font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:600;animation:slideDown .22s ease}
.alert-success{background:#D4F5E4;color:#005C33}
.alert-error{background:#FFE0D9;color:#8B1A00}
.alert-warning{background:#FFF8D6;color:#7A5500}
@keyframes slideDown{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:translateY(0)}}

/* ══════════════════════════════════════════════════
   LAYOUT — 2 kolom: form kiri, sidebar kanan
══════════════════════════════════════════════════ */
.form-layout{
    display:grid;
    grid-template-columns:1fr 275px;
    grid-template-areas:"main side";
    gap:1.1rem;
    align-items:start;
    padding:1.25rem 1.5rem 5rem;
    max-width:100%;
    overflow-x:hidden;
    animation:wakeUp .3s ease both;
}
@keyframes wakeUp{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}

.form-main{grid-area:main;display:flex;flex-direction:column;gap:.9rem;min-width:0}
.form-sidebar{grid-area:side;display:flex;flex-direction:column;gap:.8rem;min-width:0}
.sidebar-sticky{position:sticky;top:1rem;display:flex;flex-direction:column;gap:.8rem}

/* ── Card ── */
.card{background:var(--w);border:var(--bd);box-shadow:var(--sh);overflow:hidden;width:100%}
.card-hd{display:flex;align-items:center;gap:.55rem;padding:.72rem 1rem;background:var(--blk);border-bottom:var(--bd);min-width:0;overflow:hidden}
.card-hd i{color:var(--yel);font-size:.8rem;flex-shrink:0}
.card-hd-label{font-family:'Syne',sans-serif;font-size:.92rem;font-weight:700;color:var(--w);flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.field-count-chip{font-family:'JetBrains Mono',monospace;font-size:.52rem;font-weight:700;background:var(--yel);color:var(--blk);padding:2px 7px;border:2px solid var(--yel);letter-spacing:.05em;flex-shrink:0;white-space:nowrap}
.card-body{padding:1rem;display:flex;flex-direction:column;gap:1rem}

/* ══════════════════════════════════════════════════
   FIELD GROUP
══════════════════════════════════════════════════ */
.field-group{display:flex;flex-direction:column;gap:.4rem}
.field-group+.field-group{padding-top:1rem;border-top:2px solid rgba(0,0,0,.07)}
.field-group.is-hidden .field-inner{opacity:.4;pointer-events:none}
.field-group.is-hidden .field-label-row{opacity:.7}

/* Label row */
.field-label-row{display:flex;align-items:center;gap:.4rem}
.field-label{font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:700;color:var(--txt);display:flex;align-items:center;gap:.35rem;text-transform:uppercase;letter-spacing:.06em;flex:1;flex-wrap:wrap}
.type-chip{font-family:'JetBrains Mono',monospace;font-size:.52rem;background:var(--blk);color:var(--w);padding:1px 5px;letter-spacing:.03em}

/* Eye toggle */
.field-eye-btn{flex-shrink:0;display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border:2px solid transparent;border-radius:3px;cursor:pointer;background:transparent;color:#ccc;font-size:.65rem;transition:all .15s;padding:0;position:relative;-webkit-tap-highlight-color:transparent}
.field-eye-btn:hover{border-color:var(--cor);background:rgba(255,90,54,.08);color:var(--cor)}
.field-eye-btn.is-hidden{color:var(--cor);border-color:var(--cor);background:rgba(255,90,54,.12)}
.eye-tooltip{position:absolute;bottom:calc(100% + 6px);right:0;background:var(--blk);color:var(--yel);font-family:'JetBrains Mono',monospace;font-size:.5rem;font-weight:700;padding:3px 7px;white-space:nowrap;border:2px solid var(--blk);pointer-events:none;opacity:0;transition:opacity .15s;letter-spacing:.04em;text-transform:uppercase}
.field-eye-btn:hover .eye-tooltip{opacity:1}

/* Hidden notice */
.hidden-notice{display:none;font-family:'JetBrains Mono',monospace;font-size:.57rem;font-weight:700;color:var(--cor);background:rgba(255,90,54,.07);border:1.5px dashed rgba(255,90,54,.35);padding:.3rem .6rem;letter-spacing:.05em;text-transform:uppercase;align-items:center;gap:.3rem}
.field-group.is-hidden .hidden-notice{display:flex}

/* ── Inputs ── */
.inp{width:100%;background:var(--w);border:var(--bd);color:var(--txt);font-size:.88rem;padding:.6rem .85rem;outline:none;transition:box-shadow .12s;font-family:'Space Grotesk',sans-serif;resize:vertical;border-radius:0;box-shadow:var(--sh);-webkit-appearance:none;appearance:none;max-width:100%}
.inp:focus{box-shadow:5px 5px 0 var(--blu)}
.inp::placeholder{color:#aaa}
textarea.inp{min-height:90px;line-height:1.65}

/* Color */
.color-wrap{display:flex;align-items:center;gap:.6rem}
.color-swatch-btn{width:42px;height:42px;min-width:42px;border:var(--bd);cursor:pointer;flex-shrink:0;position:relative;overflow:hidden;box-shadow:var(--sh);transition:box-shadow .12s}
.color-swatch-btn:hover{box-shadow:5px 5px 0 var(--blk)}
.color-swatch-btn input[type="color"]{position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;border:none;padding:0}
.color-hex{font-family:'JetBrains Mono',monospace;font-size:.78rem;flex:1;min-width:90px}

/* Image upload */
.image-upload-area{border:3px dashed var(--blk);padding:1.3rem 1rem;text-align:center;transition:background .12s;cursor:pointer;position:relative;background:var(--w);width:100%;overflow:hidden}
.image-upload-area:hover,.image-upload-area.drag-over{background:#EDE8DC;box-shadow:var(--sh)}
.image-upload-area input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.upload-icon{font-size:1.3rem;color:var(--mu);margin-bottom:.35rem}
.upload-text{font-family:'JetBrains Mono',monospace;font-size:.6rem;color:var(--mu);line-height:1.8}
.upload-text strong{color:var(--blk);font-weight:700}
.img-preview-wrap{position:relative;display:inline-block;margin-bottom:.35rem;max-width:100%}
.img-preview{max-width:100%;max-height:140px;border:var(--bd);box-shadow:var(--sh);object-fit:cover;display:block}
.img-remove-btn{position:absolute;top:-9px;right:-9px;width:24px;height:24px;background:var(--cor);border:2px solid var(--blk);color:#fff;font-size:.55rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:transform .12s}
.img-remove-btn:hover{transform:scale(1.15)}
.img-filename{font-family:'JetBrains Mono',monospace;font-size:.58rem;color:var(--mu);margin-top:.25rem;word-break:break-all}

/* ══════════════════════════════════════════════════
   SIDEBAR
══════════════════════════════════════════════════ */
/* Status Card */
.status-row{display:flex;align-items:center;justify-content:space-between;padding:.72rem 1rem;background:var(--blk);border-bottom:var(--bd)}
.status-label{font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;color:var(--w);text-transform:uppercase;letter-spacing:.06em;display:flex;align-items:center;gap:.4rem}
.s-dot{width:7px;height:7px;border-radius:50%;border:1.5px solid rgba(255,255,255,.4)}
.s-dot.on{background:var(--mnt)}.s-dot.off{background:#555}
.toggle{position:relative;width:38px;height:20px;cursor:pointer;display:inline-block}
.toggle input{opacity:0;width:0;height:0}
.toggle-track{position:absolute;inset:0;background:#555;border-radius:999px;border:2px solid #888;transition:all .2s}
.toggle input:checked~.toggle-track{background:var(--mnt);border-color:#00a078}
.toggle-thumb{position:absolute;top:3px;left:3px;width:14px;height:14px;background:#888;border-radius:50%;transition:transform .2s,background .2s;pointer-events:none}
.toggle input:checked~.toggle-thumb{transform:translateX(18px);background:var(--w)}

.sidebar-info{padding:.9rem 1rem;display:flex;flex-direction:column;gap:.7rem}
.info-row{display:flex;flex-direction:column;gap:2px}
.info-k{font-family:'JetBrains Mono',monospace;font-size:.53rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--mu)}
.info-v{font-size:.82rem;font-weight:600;color:var(--txt)}
.info-v.mono{font-family:'JetBrains Mono',monospace;font-size:.68rem;color:var(--blk);background:var(--yel);border:2px solid var(--blk);padding:1px 6px;display:inline-block;word-break:break-all}

/* Save Button */
.btn-submit{width:100%;background:var(--yel);color:var(--blk);border:var(--bd);box-shadow:var(--sh);padding:.78rem;font-family:'Syne',sans-serif;font-size:1rem;font-weight:800;letter-spacing:.04em;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.45rem;transition:all .12s;border-radius:0;-webkit-tap-highlight-color:transparent;min-height:48px}
.btn-submit:hover{background:var(--blk);color:var(--yel)}
.btn-submit:active{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--blk)}
.link-cancel{display:block;text-align:center;font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;color:var(--mu);text-decoration:none;padding:.42rem;transition:color .12s;text-transform:uppercase;letter-spacing:.05em}
.link-cancel:hover{color:var(--cor);text-decoration:underline}

/* Hidden Summary */
.hidden-summary{padding:.65rem 1rem;background:rgba(255,90,54,.06);border-top:2px solid rgba(255,90,54,.2);display:none}
.hidden-summary.has-hidden{display:block}
.hidden-summary-title{font-family:'JetBrains Mono',monospace;font-size:.56rem;font-weight:700;color:var(--cor);text-transform:uppercase;letter-spacing:.08em;margin-bottom:.45rem;display:flex;align-items:center;gap:.3rem}
.hidden-tag{font-family:'JetBrains Mono',monospace;font-size:.5rem;background:rgba(255,90,54,.1);border:1.5px solid rgba(255,90,54,.3);color:var(--cor);padding:2px 5px;display:inline-block;margin:2px;cursor:pointer;transition:all .15s}
.hidden-tag:hover{background:var(--cor);color:#fff}

/* History */
.history-hd{display:flex;align-items:center;justify-content:space-between;padding:.72rem 1rem;cursor:pointer;user-select:none;font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;color:var(--w);text-transform:uppercase;letter-spacing:.06em;background:var(--blk);border-bottom:var(--bd);transition:background .12s;-webkit-tap-highlight-color:transparent;min-height:42px}
.history-hd:hover{background:#222}
.history-hd-left{display:flex;align-items:center;gap:.45rem}
.history-hd i{color:var(--yel)}
.history-badge{font-family:'JetBrains Mono',monospace;font-size:.54rem;font-weight:700;background:var(--yel);color:var(--blk);padding:1px 6px;border:2px solid var(--yel)}
.history-chevron{color:#888;transition:transform .2s}
.history-chevron.open{transform:rotate(180deg)}
.history-body{display:none;flex-direction:column}
.history-body.open{display:flex}
.history-item{padding:.72rem 1rem;border-top:2px solid rgba(0,0,0,.07);display:flex;flex-direction:column;gap:.35rem;transition:background .12s}
.history-item:hover{background:#EDE8DC}
.history-item-top{display:flex;align-items:center;justify-content:space-between;gap:.45rem;flex-wrap:wrap}
.h-time-abs{font-family:'JetBrains Mono',monospace;font-size:.62rem;font-weight:700;color:var(--txt)}
.h-time-rel{font-family:'JetBrains Mono',monospace;font-size:.56rem;color:var(--mu);margin-top:1px}
.h-status{font-family:'JetBrains Mono',monospace;font-size:.52rem;padding:2px 6px;font-weight:700;letter-spacing:.04em;border:2px solid}
.h-status.on{background:#D4F5E4;color:#005C33;border-color:#005C33}
.h-status.off{background:#eee;color:var(--mu);border-color:var(--mu)}
.h-preview{font-family:'JetBrains Mono',monospace;font-size:.56rem;display:flex;gap:.3rem;overflow:hidden}
.h-pk{color:var(--mu);min-width:45px;flex-shrink:0}
.h-pv{color:var(--txt2);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-weight:600}
.btn-restore{display:flex;align-items:center;justify-content:center;gap:.3rem;width:100%;padding:.4rem;border:var(--bd);background:var(--w);color:var(--blk);font-family:'JetBrains Mono',monospace;font-size:.58rem;font-weight:700;cursor:pointer;letter-spacing:.05em;text-transform:uppercase;transition:all .12s;margin-top:.1rem;box-shadow:2px 2px 0 var(--blk);-webkit-tap-highlight-color:transparent;min-height:36px}
.btn-restore:hover{background:var(--yel)}
.history-empty{padding:1.5rem 1rem;text-align:center;color:var(--mu);font-family:'JetBrains Mono',monospace;font-size:.6rem;line-height:1.9}
.history-empty i{display:block;font-size:1.1rem;margin-bottom:.4rem;opacity:.25}

/* ── Modal ── */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:9998;display:none;align-items:center;justify-content:center;padding:1rem}
.modal-overlay.open{display:flex}
.modal-box{background:var(--w);border:var(--bd);box-shadow:var(--shlg);padding:1.5rem;max-width:340px;width:100%;text-align:center;animation:modalPop .25s cubic-bezier(.34,1.56,.64,1)}
@keyframes modalPop{from{transform:scale(.88) translateY(12px);opacity:0}to{transform:scale(1) translateY(0);opacity:1}}
.modal-icon{width:50px;height:50px;background:var(--yel);border:var(--bd);box-shadow:var(--sh);display:flex;align-items:center;justify-content:center;margin:0 auto .9rem;font-size:1.15rem;color:var(--blk)}
.modal-title{font-family:'Syne',sans-serif;font-size:1.25rem;font-weight:800;color:var(--blk);margin-bottom:.35rem;letter-spacing:-.02em}
.modal-desc{font-size:.8rem;color:var(--txt2);margin-bottom:.8rem;line-height:1.65}
.modal-time{font-family:'JetBrains Mono',monospace;font-size:.68rem;background:#EDE8DC;border:var(--bd);padding:.42rem .75rem;margin-bottom:1rem;color:var(--blk);font-weight:700;word-break:break-word}
.modal-actions{display:flex;gap:.5rem}
.btn-modal-cancel{flex:1;padding:.52rem;border:var(--bd);background:var(--w);color:var(--txt);font-family:'JetBrains Mono',monospace;font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;cursor:pointer;transition:all .12s;box-shadow:2px 2px 0 var(--blk)}
.btn-modal-cancel:hover{background:var(--cor);color:#fff}
.btn-modal-confirm{flex:1;padding:.52rem;border:var(--bd);background:var(--yel);color:var(--blk);font-family:'Syne',sans-serif;font-size:.92rem;font-weight:800;cursor:pointer;transition:all .12s;box-shadow:2px 2px 0 var(--blk)}
.btn-modal-confirm:hover{background:var(--blk);color:var(--yel)}

/* ── Toast ── */
.form-toast{position:fixed;bottom:5rem;right:1.5rem;background:var(--blk);color:var(--yel);font-family:'JetBrains Mono',monospace;font-size:.6rem;font-weight:700;padding:.5rem 1rem;border:2px solid var(--yel);box-shadow:var(--sh);z-index:1000;opacity:0;transform:translateY(8px);transition:all .25s;pointer-events:none;letter-spacing:.06em;text-transform:uppercase;max-width:300px}
.form-toast.show{opacity:1;transform:translateY(0)}

/* ══════════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════════ */
@media(max-width:900px){
    .form-layout{grid-template-columns:1fr 240px;gap:.9rem;padding:1rem 1.25rem 5rem}
}

@media(max-width:720px){
    /* Mobile: sidebar naik ke atas, form di bawah */
    .form-layout{
        grid-template-columns:1fr;
        grid-template-areas:"side" "main";
        padding:.9rem 1rem 5rem;
        gap:.8rem;
    }
    .sidebar-sticky{position:static}
    .sidebar-info{display:grid;grid-template-columns:1fr 1fr;gap:.5rem .9rem}
    .btn-submit,.link-cancel,.hidden-summary{grid-column:1/-1}
    .top-nav{padding:.7rem 1rem;gap:.45rem}
    .pill-key{display:none}
    .alerts-wrap{padding:.55rem 1rem 0}
}
@media(max-width:480px){
    .form-layout{padding:.8rem .85rem 5rem}
    .top-nav{padding:.6rem .85rem}
    .page-heading{font-size:.9rem}
    .btn-back{padding:.35rem .65rem;font-size:.57rem}
    .nav-sep{display:none}
    .pill{display:none}
    .card-hd{padding:.55rem .8rem}
    .card-hd-label{font-size:.82rem}
    .card-body{padding:.8rem;gap:.8rem}
    .inp{font-size:.82rem;padding:.52rem .72rem}
    textarea.inp{min-height:78px}
    .color-swatch-btn{width:36px;height:36px;min-width:36px}
    .sidebar-info{grid-template-columns:1fr}
    .modal-box{padding:1.15rem}
    .modal-title{font-size:1.1rem}
    .modal-actions{flex-direction:column;gap:.4rem}
}
</style>
@endpush

@section('content')

{{-- Ticker --}}
<div class="ticker-bar">
    <div class="ticker-inner">
        ◆ EDIT SECTION MODE &nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN &nbsp;&nbsp; ◆ {{ strtoupper($section->section_key) }} &nbsp;&nbsp; ◆ KLIK 👁 UNTUK SEMBUNYIKAN FIELD &nbsp;&nbsp; ◆ EDIT SECTION MODE &nbsp;&nbsp; ◆ {{ strtoupper($section->section_key) }} &nbsp;&nbsp;
    </div>
</div>

{{-- Top Nav --}}
<div class="top-nav">
    <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> KEMBALI
    </a>
    <span class="nav-sep">/</span>
    <div class="nav-title-wrap">
        <h1 class="page-heading">EDIT SECTION</h1>
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

<form method="POST"
      action="{{ route('admin.cms.page-sections.update', $section) }}"
      enctype="multipart/form-data"
      id="section-form">
@csrf @method('PUT')

@php $hiddenFields = $section->hidden_fields ?? []; @endphp

<div class="form-layout">

    {{-- ══════════════════════════════════════════
         KIRI — FORM FIELDS
    ══════════════════════════════════════════ --}}
    <div class="form-main">
        <div class="card">
            <div class="card-hd">
                <i class="fas fa-sliders"></i>
                <span class="card-hd-label">{{ $section->label }}</span>
                <span class="field-count-chip">{{ count($fields) }} FIELDS</span>
            </div>
            <div class="card-body">
                @if(empty($fields))
                <p style="font-family:'JetBrains Mono',monospace;font-size:.62rem;color:var(--mu);text-align:center;padding:2rem 0">NO FIELDS FOR THIS SECTION.</p>
                @else
                @foreach($fields as $field)
                @php
                    $key         = $field['key'];
                    $label       = $field['label'];
                    $type        = $field['type'];
                    $placeholder = $field['placeholder'] ?? '';
                    $currentVal  = $section->get($key, '');
                    $inputId     = 'field_' . $key;
                    $isHidden    = in_array($key, $hiddenFields);
                @endphp

                <div class="field-group {{ $isHidden ? 'is-hidden' : '' }}"
                     id="fg_{{ $key }}" data-field-key="{{ $key }}">

                    <div class="field-label-row">
                        <label class="field-label" for="{{ $inputId }}">
                            {{ strtoupper($label) }}
                            <span class="type-chip">{{ strtoupper($type) }}</span>
                        </label>
                        <button type="button"
                                class="field-eye-btn {{ $isHidden ? 'is-hidden' : '' }}"
                                id="eye_{{ $key }}"
                                data-field="{{ $key }}"
                                data-section="{{ $section->id }}"
                                onclick="toggleFieldEye('{{ $key }}', {{ $section->id }}, this)">
                            <i class="fas {{ $isHidden ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                            <span class="eye-tooltip">{{ $isHidden ? 'TAMPILKAN' : 'SEMBUNYIKAN' }}</span>
                        </button>
                    </div>

                    <div class="hidden-notice">
                        <i class="fas fa-eye-slash"></i>
                        FIELD INI DISEMBUNYIKAN DARI FRONTEND
                    </div>

                    <div class="field-inner">
                        @if($type === 'text')
                            <input type="text" id="{{ $inputId }}" name="{{ $key }}"
                                value="{{ old($key, $currentVal) }}"
                                placeholder="{{ $placeholder }}"
                                class="inp">

                        @elseif($type === 'textarea')
                            <textarea id="{{ $inputId }}" name="{{ $key }}"
                                placeholder="{{ $placeholder }}"
                                class="inp" rows="4">{{ old($key, $currentVal) }}</textarea>

                        @elseif($type === 'color')
                            @php $colorVal = old($key, $currentVal ?: '#F5C800'); @endphp
                            <div class="color-wrap">
                                <label class="color-swatch-btn" style="background:{{ $colorVal }}">
                                    <input type="color" name="{{ $key }}" value="{{ $colorVal }}" id="{{ $inputId }}"
                                        onchange="this.closest('.color-swatch-btn').style.background=this.value; document.getElementById('hex_{{ $key }}').value=this.value;">
                                </label>
                                <input type="text" id="hex_{{ $key }}" value="{{ $colorVal }}" placeholder="#000000"
                                    class="inp color-hex" maxlength="7"
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
                                        <strong>KLIK PILIH</strong> ATAU DRAG &amp; DROP<br>
                                        <span style="font-size:.56rem;color:#bbb">PNG · JPG · WEBP — MAX 2MB</span>
                                    </div>
                                </div>
                                <input type="file" name="{{ $key }}" id="{{ $inputId }}" accept="image/*"
                                    onchange="handleImageChange(this, '{{ $key }}')">
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         KANAN — SIDEBAR (status, save, history)
    ══════════════════════════════════════════ --}}
    <div class="form-sidebar">
        <div class="sidebar-sticky">

            {{-- Publish Card --}}
            <div class="card">
                <div class="status-row">
                    <span class="status-label">
                        <span class="s-dot {{ $section->is_active ? 'on' : 'off' }}"></span>
                        STATUS SECTION
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
                        <span class="info-v" style="font-size:.74rem">{{ $section->updated_at->diffForHumans() }}</span>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-floppy-disk"></i> SIMPAN PERUBAHAN
                    </button>
                    <a href="{{ route('admin.cms.page-sections.index', ['page' => $section->page]) }}" class="link-cancel">
                        BATAL &amp; KEMBALI
                    </a>
                </div>

                {{-- Hidden Fields Summary --}}
                <div class="hidden-summary {{ count($hiddenFields) > 0 ? 'has-hidden' : '' }}" id="hidden-summary">
                    <div class="hidden-summary-title">
                        <i class="fas fa-eye-slash"></i>
                        <span id="hidden-count">{{ count($hiddenFields) }}</span> FIELD DISEMBUNYIKAN
                    </div>
                    <div id="hidden-tags-list">
                        @foreach($hiddenFields as $hf)
                        <span class="hidden-tag" onclick="revealField('{{ $hf }}')" title="Klik untuk tampilkan">
                            {{ $hf }} <i class="fas fa-times" style="font-size:.4rem"></i>
                        </span>
                        @endforeach
                    </div>
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
                        @php
                            $pfs = array_slice($section->getFields(), 0, 3);
                            $pc  = $history->content ?? [];
                        @endphp
                        @foreach($pfs as $pf)
                        @php
                            $pv = $pc[$pf['key']] ?? null;
                            $sv = ($pv && !in_array($pf['type'], ['image','color']))
                                ? Str::limit(strip_tags($pv), 26) : null;
                        @endphp
                        @if($sv)
                        <div class="h-preview">
                            <span class="h-pk">{{ Str::limit($pf['label'], 7) }}</span>
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

{{-- Restore Modal --}}
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

{{-- Hidden restore forms --}}
@foreach($histories as $history)
<form method="POST"
      action="{{ route('admin.cms.page-sections.restore', [$section, $history]) }}"
      id="restore-form-{{ $history->id }}"
      style="display:none">@csrf</form>
@endforeach

{{-- Toast --}}
<div class="form-toast" id="form-toast"></div>

@endsection

@push('scripts')
<script>
const CSRF             = '{{ csrf_token() }}';
const TOGGLE_FIELD_URL = '{{ url('admin/cms/page-sections/section') }}';

/* ── Eye Toggle per Field ── */
async function toggleFieldEye(fieldKey, sectionId, btn) {
    btn.disabled = true;
    try {
        const res  = await fetch(`${TOGGLE_FIELD_URL}/${sectionId}/toggle-field`, {
            method: 'PATCH',
            headers: { 'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json' },
            body: JSON.stringify({ field_key: fieldKey }),
        });
        const data = await res.json();
        if (!data.success) throw new Error(data.error || 'Gagal');

        const isHidden = data.is_hidden;
        const group    = document.getElementById(`fg_${fieldKey}`);
        const icon     = btn.querySelector('i');
        const tooltip  = btn.querySelector('.eye-tooltip');

        group.classList.toggle('is-hidden', isHidden);
        btn.classList.toggle('is-hidden', isHidden);
        icon.className     = `fas ${isHidden ? 'fa-eye-slash' : 'fa-eye'}`;
        tooltip.textContent= isHidden ? 'TAMPILKAN' : 'SEMBUNYIKAN';

        updateHiddenSummary(fieldKey, isHidden, data.hidden_count);
        showToast(isHidden ? `"${fieldKey}" disembunyikan` : `"${fieldKey}" ditampilkan`);
    } catch(e) {
        showToast('Gagal: ' + e.message, true);
    }
    btn.disabled = false;
}

function revealField(fieldKey) {
    const btn = document.getElementById(`eye_${fieldKey}`);
    if (btn) toggleFieldEye(fieldKey, btn.dataset.section, btn);
}

function updateHiddenSummary(fieldKey, isHidden, hiddenCount) {
    const summary  = document.getElementById('hidden-summary');
    const countEl  = document.getElementById('hidden-count');
    const tagsList = document.getElementById('hidden-tags-list');
    if (!summary || !countEl || !tagsList) return;
    countEl.textContent = hiddenCount;
    summary.classList.toggle('has-hidden', hiddenCount > 0);
    const existing = tagsList.querySelector(`[data-tag="${fieldKey}"]`);
    if (isHidden && !existing) {
        const tag = document.createElement('span');
        tag.className   = 'hidden-tag';
        tag.dataset.tag = fieldKey;
        tag.onclick     = () => revealField(fieldKey);
        tag.title       = 'Klik untuk tampilkan';
        tag.innerHTML   = `${fieldKey} <i class="fas fa-times" style="font-size:.4rem"></i>`;
        tagsList.appendChild(tag);
    } else if (!isHidden && existing) {
        existing.remove();
    }
}

/* ── Image ── */
function handleImageChange(input, key) {
    const file = input.files[0];
    if (!file) return;
    if (file.size > 2 * 1024 * 1024) { alert('File melebihi 2MB'); input.value = ''; return; }
    showImagePreview(key, file);
}
function handleFileDrop(e, key) {
    e.preventDefault();
    document.getElementById('drop_' + key).classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const input = document.getElementById('field_' + key);
    const dt = new DataTransfer(); dt.items.add(file); input.files = dt.files;
    showImagePreview(key, file);
}
function handleDragOver(e, area)  { e.preventDefault(); area.classList.add('drag-over'); }
function handleDragLeave(e, area) { if (!area.contains(e.relatedTarget)) area.classList.remove('drag-over'); }
function showImagePreview(key, file) {
    const reader = new FileReader();
    reader.onload = ev => {
        document.getElementById('preview_' + key).src = ev.target.result;
        document.getElementById('filename_' + key).textContent = file.name;
        document.getElementById('preview_wrap_' + key).style.display = 'inline-block';
        const p = document.getElementById('upload_prompt_' + key);
        if (p) p.style.display = 'none';
    };
    reader.readAsDataURL(file);
}
function clearImage(key) {
    document.getElementById('preview_' + key).src = '';
    document.getElementById('filename_' + key).textContent = '';
    document.getElementById('field_' + key).value = '';
    document.getElementById('preview_wrap_' + key).style.display = 'none';
    const p = document.getElementById('upload_prompt_' + key);
    if (p) p.style.display = 'block';
}

/* ── Color ── */
function syncColorFromHex(hexInput, id) {
    const v = hexInput.value;
    if (/^#[0-9a-fA-F]{6}$/.test(v)) {
        const c = document.getElementById(id);
        c.value = v;
        c.closest('.color-swatch-btn').style.background = v;
    }
}

/* ── History ── */
function toggleHistory() {
    document.getElementById('history-body').classList.toggle('open');
    document.getElementById('history-chevron').classList.toggle('open');
}
document.addEventListener('DOMContentLoaded', () => {
    @if($histories->isNotEmpty()) toggleHistory(); @endif
});

/* ── Restore Modal ── */
let pendingRestoreId = null;
function confirmRestore(id, abs, rel) {
    pendingRestoreId = id;
    document.getElementById('modal-time-display').textContent = abs + ' (' + rel + ')';
    document.getElementById('restore-modal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeRestoreModal() {
    document.getElementById('restore-modal').classList.remove('open');
    document.body.style.overflow = '';
    pendingRestoreId = null;
}
document.getElementById('btn-confirm-restore').addEventListener('click', () => {
    if (!pendingRestoreId) return;
    document.getElementById('restore-form-' + pendingRestoreId)?.submit();
});
document.getElementById('restore-modal').addEventListener('click', function(e) {
    if (e.target === this) closeRestoreModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeRestoreModal(); });

/* ── Unsaved Changes ── */
let formChanged = false;
const form = document.getElementById('section-form');
if (form) {
    form.addEventListener('change', () => { formChanged = true; document.body.classList.add('has-changes'); });
    form.addEventListener('submit', () => { formChanged = false; document.body.classList.remove('has-changes'); });
    window.addEventListener('beforeunload', e => { if (formChanged) { e.preventDefault(); e.returnValue = ''; } });
}

/* ── Toast ── */
let _tt;
function showToast(msg, isError = false) {
    const t = document.getElementById('form-toast');
    t.textContent = msg;
    t.style.background  = isError ? '#FF5A36' : '#0D0D0D';
    t.style.color       = isError ? '#fff'    : '#F5C800';
    t.style.borderColor = isError ? '#FF5A36' : '#F5C800';
    t.classList.add('show');
    clearTimeout(_tt);
    _tt = setTimeout(() => t.classList.remove('show'), 2800);
}
</script>
@endpushz