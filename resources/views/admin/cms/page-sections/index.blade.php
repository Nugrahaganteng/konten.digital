@extends('layouts.admin')

@section('title', 'CMS — ' . strtoupper($page))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════════════
   CMS PAGE-SECTIONS INDEX
   Full mobile responsive + smooth scrollable tabs
   ═════════════════════════════════════════════════════ */
:root {
    --w:     #F5F0E8;
    --blk:   #0D0D0D;
    --yel:   #F5C800;
    --cor:   #FF5A36;
    --mnt:   #00C48C;
    --blu:   #1A56FF;
    --txt:   #0D0D0D;
    --txt2:  #3D3D3D;
    --mu:    #7A7A7A;
    --bd:    3px solid #0D0D0D;
    --sh:    4px 4px 0 #0D0D0D;
    --shlg:  6px 6px 0 #0D0D0D;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* CRITICAL: clip bukan hidden */
.cms-wrap {
    overflow-x: clip;
    max-width: 100%;
    min-height: 100vh;
}

/* ── Ticker ───────────────────────────────────────── */
.ticker-bar {
    background: var(--blk);
    padding: 5px 0;
    overflow: hidden;
    white-space: nowrap;
    border-bottom: var(--bd);
    width: 100%;
}
.ticker-inner {
    display: inline-block;
    animation: ticker 22s linear infinite;
    font-family: 'JetBrains Mono', monospace;
    font-size: .56rem;
    font-weight: 700;
    color: var(--yel);
    letter-spacing: .13em;
    text-transform: uppercase;
    padding-left: 100%;
}
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ── Masthead ─────────────────────────────────────── */
.masthead {
    background: var(--yel);
    border-bottom: var(--bd);
    padding: 1rem 1.25rem;
    width: 100%;
    overflow: clip;
}
.masthead-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .85rem;
}
.cms-title {
    display: flex;
    align-items: center;
    gap: .85rem;
    min-width: 0;
    flex: 1;
    overflow: hidden;
}
.title-icon-box {
    width: 44px; height: 44px; min-width: 44px;
    background: var(--blk);
    border: var(--bd);
    box-shadow: var(--sh);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; color: var(--yel);
    flex-shrink: 0;
}
.title-text { min-width: 0; overflow: hidden; }
.title-main {
    font-family: 'Syne', sans-serif;
    font-size: clamp(.95rem, 4.5vw, 1.8rem);
    font-weight: 800;
    color: var(--blk);
    line-height: 1;
    letter-spacing: -.02em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.title-page-tag {
    display: inline-block;
    background: var(--blk); color: var(--yel);
    font-family: 'JetBrains Mono', monospace;
    font-size: .54rem; font-weight: 700;
    padding: 2px 7px; letter-spacing: .12em;
    text-transform: uppercase; margin-top: 3px;
}
.title-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: .54rem; color: var(--txt2);
    margin-top: 2px; letter-spacing: .04em;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.hint-chip {
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem; font-weight: 600; color: var(--blk);
    display: flex; align-items: center; gap: .35rem;
    background: var(--w); border: var(--bd); box-shadow: var(--sh);
    padding: .38rem .7rem; white-space: nowrap; flex-shrink: 0;
}

/* ── Alerts ───────────────────────────────────────── */
.alerts-outer { padding: .6rem 1.25rem 0; }
.alert {
    display: flex; align-items: center; gap: .5rem;
    padding: .6rem .85rem; border: var(--bd);
    margin-bottom: .45rem;
    font-family: 'JetBrains Mono', monospace;
    font-size: .65rem; font-weight: 600;
    box-shadow: var(--sh); animation: slideDown .2s ease;
}
.alert-success { background: #D4F5E4; color: #005C33; }
.alert-error   { background: #FFE0D9; color: #8B1A00; }
@keyframes slideDown { from { opacity:0; transform:translateY(-4px); } to { opacity:1; transform:translateY(0); } }

/* ══════════════════════════════════════════════════════
   TABS — SMOOTH HORIZONTAL SCROLL
   Teknik kunci:
   1. .tabs-outer: overflow: visible (JANGAN hidden/clip)
   2. .tabs-scroll: overflow-x: auto + scroll-behavior: smooth
   3. Fade overlay kanan sebagai visual hint
   ═════════════════════════════════════════════════════ */
.tabs-outer {
    background: var(--w);
    border-bottom: var(--bd);
    position: relative;  /* untuk fade overlay */
    /* JANGAN overflow: hidden di sini */
}

.tabs-scroll {
    display: flex;
    align-items: center;
    gap: .45rem;
    padding: .75rem 1.25rem .85rem;
    /* KUNCI SCROLL SMOOTH */
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: smooth;
    scroll-snap-type: x proximity;
    scrollbar-width: none;          /* Firefox */
    -ms-overflow-style: none;       /* IE */
    /* Jangan pakai mask-image — itu blokir scroll di beberapa browser */
    white-space: nowrap;
}
.tabs-scroll::-webkit-scrollbar { display: none; }

.tabs-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .56rem; font-weight: 700;
    color: var(--mu); text-transform: uppercase;
    letter-spacing: .1em; flex-shrink: 0;
    white-space: nowrap;
}

.page-tab {
    font-family: 'JetBrains Mono', monospace;
    font-size: .6rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase;
    padding: .35rem .8rem;
    border: 2px solid var(--blk);
    background: var(--w); color: var(--blk);
    text-decoration: none;
    transition: all .14s;
    box-shadow: 2px 2px 0 var(--blk);
    flex-shrink: 0; white-space: nowrap;
    display: inline-block;
    scroll-snap-align: start;
    -webkit-tap-highlight-color: transparent;
}
.page-tab:hover { background: var(--blk); color: var(--w); }
.page-tab.active {
    background: var(--blk); color: var(--yel);
    box-shadow: 2px 2px 0 #555;
}

/* Fade gradient kanan — visual hint ada lebih banyak tab */
.tabs-fade-right {
    position: absolute;
    right: 0; top: 0; bottom: 0;
    width: 48px;
    background: linear-gradient(to right, transparent, var(--w));
    pointer-events: none;
    transition: opacity .25s;
    /* border bawah sama tingginya */
}
.tabs-fade-left {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 32px;
    background: linear-gradient(to left, transparent, var(--w));
    pointer-events: none;
    opacity: 0;
    transition: opacity .25s;
}

/* ── Grid Area ───────────────────────────────────── */
.grid-area {
    padding: 1.1rem 1.25rem 5.5rem;
    overflow-x: clip;
    width: 100%;
}

.row-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: .57rem; font-weight: 700; color: var(--mu);
    text-transform: uppercase; letter-spacing: .12em;
    margin-bottom: .75rem;
    display: flex; align-items: center; gap: .5rem; overflow: hidden;
}
.row-label::after { content: ''; flex: 1; height: 2px; background: var(--blk); min-width: 0; }

.sections-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(min(100%, 280px), 1fr));
    gap: .9rem;
    width: 100%;
}

/* ── Section Card ────────────────────────────────── */
.section-card {
    background: var(--w);
    border: var(--bd);
    box-shadow: var(--sh);
    cursor: grab;
    position: relative;
    transition: transform .12s, box-shadow .12s;
    animation: cardReveal .32s ease both;
    width: 100%; overflow: hidden;
}
.section-card:nth-child(1) { animation-delay: .03s; }
.section-card:nth-child(2) { animation-delay: .06s; }
.section-card:nth-child(3) { animation-delay: .09s; }
.section-card:nth-child(4) { animation-delay: .12s; }
.section-card:nth-child(5) { animation-delay: .15s; }
.section-card:nth-child(6) { animation-delay: .17s; }
@keyframes cardReveal {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}
@media (hover: hover) {
    .section-card:hover { transform: translate(-2px,-2px); box-shadow: var(--shlg); }
}
.section-card:active { cursor: grabbing; }
.section-card.dragging { opacity: .3; transform: rotate(-1deg) scale(.97); }
.section-card.drag-over { outline: 3px dashed var(--cor); outline-offset: -3px; }
.section-card.inactive { opacity: .55; }

.section-card:nth-child(4n+1) .card-accent { background: var(--yel); }
.section-card:nth-child(4n+2) .card-accent { background: var(--cor); }
.section-card:nth-child(4n+3) .card-accent { background: var(--mnt); }
.section-card:nth-child(4n+4) .card-accent { background: var(--blu); }
.card-accent { height: 4px; border-bottom: 2px solid var(--blk); }

/* Card Header */
.card-hd {
    display: flex; align-items: center;
    padding: .6rem .8rem;
    background: var(--blk);
    gap: .45rem; border-bottom: var(--bd);
    overflow: hidden; min-width: 0;
}
.card-hd-left {
    display: flex; align-items: center;
    gap: .4rem; min-width: 0; flex: 1; overflow: hidden;
}
.drag-handle {
    color: #888; font-size: .62rem; cursor: grab;
    flex-shrink: 0; padding: 2px;
    min-width: 20px; min-height: 20px;
    display: flex; align-items: center; justify-content: center;
    transition: color .14s;
}
.drag-handle:hover { color: var(--yel); }
.order-num {
    font-family: 'Syne', sans-serif; font-size: 1rem;
    font-weight: 800; color: var(--yel); line-height: 1;
    flex-shrink: 0; min-width: 22px;
}
.card-meta { min-width: 0; flex: 1; overflow: hidden; }
.card-label {
    font-family: 'Syne', sans-serif; font-size: .8rem;
    font-weight: 700; color: var(--w);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.15;
}
.card-key {
    font-family: 'JetBrains Mono', monospace; font-size: .5rem;
    color: #888; margin-top: 1px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.card-actions { display: flex; align-items: center; gap: .4rem; flex-shrink: 0; }

.status-pip {
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--mnt); border: 1.5px solid rgba(255,255,255,.5); flex-shrink: 0;
}
.status-pip.off { background: #555; border-color: #888; }

/* Toggle */
.toggle-form { display: inline-flex; }
.toggle { position: relative; width: 34px; height: 18px; cursor: pointer; display: block; }
.toggle input { opacity: 0; width: 0; height: 0; position: absolute; }
.toggle-track { position: absolute; inset: 0; background: #444; border-radius: 999px; border: 2px solid #888; transition: all .18s; }
.toggle input:checked ~ .toggle-track { background: var(--mnt); border-color: #00a078; }
.toggle-thumb { position: absolute; top: 3px; left: 3px; width: 12px; height: 12px; background: #888; border-radius: 50%; transition: transform .18s, background .18s; pointer-events: none; }
.toggle input:checked ~ .toggle-thumb { transform: translateX(16px); background: var(--w); }

.btn-edit {
    font-family: 'JetBrains Mono', monospace; font-size: .57rem;
    font-weight: 700; letter-spacing: .04em;
    padding: .3rem .6rem;
    background: var(--yel); border: 2px solid var(--yel); color: var(--blk);
    text-decoration: none;
    display: flex; align-items: center; gap: .25rem;
    transition: all .14s; white-space: nowrap; text-transform: uppercase;
    box-shadow: 2px 2px 0 rgba(255,255,255,.25); flex-shrink: 0;
    min-height: 28px; -webkit-tap-highlight-color: transparent;
}
.btn-edit:hover { background: var(--w); border-color: var(--w); }

/* Card Body */
.card-body { padding: .65rem .8rem; overflow: hidden; }
.field-rows { display: flex; flex-direction: column; }
.field-row {
    display: flex; align-items: flex-start; gap: .4rem;
    padding: .23rem 0; border-bottom: 1px solid rgba(0,0,0,.06);
    min-width: 0; overflow: hidden;
}
.field-row:last-child { border-bottom: none; }
.f-label {
    font-family: 'JetBrains Mono', monospace; font-size: .54rem;
    font-weight: 600; color: var(--mu);
    min-width: 78px; max-width: 78px; flex-shrink: 0;
    padding-top: 1px; text-transform: uppercase; letter-spacing: .03em;
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.f-val {
    color: var(--txt2); word-break: break-word; overflow: hidden;
    display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;
    font-weight: 500; font-size: .68rem; flex: 1; min-width: 0;
}
.f-val.empty { color: #bbb; font-style: italic; }
.f-img { width: 32px; height: 22px; object-fit: cover; border: 2px solid var(--blk); flex-shrink: 0; }
.f-color-dot { width: 12px; height: 12px; border: 2px solid var(--blk); flex-shrink: 0; margin-top: 2px; }
.more-label {
    font-family: 'JetBrains Mono', monospace; font-size: .54rem;
    font-weight: 700; color: var(--mu);
    padding: .28rem 0 0; border-top: 2px dashed rgba(0,0,0,.12);
    margin-top: .22rem; text-transform: uppercase; letter-spacing: .06em;
}

/* ── Empty State ─────────────────────────────────── */
.empty-state {
    text-align: center; padding: 4rem 2rem;
    color: var(--mu); font-family: 'JetBrains Mono', monospace;
}
.empty-icon { font-size: 2rem; margin-bottom: .8rem; display: block; opacity: .2; }
.empty-state p { font-size: .7rem; }

/* ── Reorder Float Bar ───────────────────────────── */
.reorder-bar {
    position: fixed;
    bottom: 1.25rem;
    left: 50%;
    transform: translateX(-50%) translateY(120px);
    background: var(--blk);
    border: var(--bd);
    box-shadow: var(--shlg);
    padding: .6rem 1rem;
    display: flex; align-items: center; gap: .7rem;
    z-index: 999;
    font-family: 'JetBrains Mono', monospace;
    font-size: .65rem; color: var(--yel);
    opacity: 0; pointer-events: none;
    transition: transform .35s cubic-bezier(.34,1.56,.64,1), opacity .25s;
    white-space: nowrap;
    max-width: calc(100vw - 2.5rem);
}
.reorder-bar.visible {
    transform: translateX(-50%) translateY(0);
    opacity: 1; pointer-events: auto;
}
.blink-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--cor); animation: blink .8s step-end infinite; flex-shrink: 0; }
@keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0;} }
.bar-text { flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; }
.btn-save-order {
    background: var(--yel); color: var(--blk);
    border: 2px solid var(--yel);
    padding: .4rem .95rem;
    font-family: 'JetBrains Mono', monospace;
    font-size: .62rem; font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase;
    cursor: pointer; transition: all .14s; flex-shrink: 0;
}
.btn-save-order:hover { background: var(--w); border-color: var(--w); }
.btn-save-order:disabled { opacity: .4; cursor: not-allowed; }
#reorder-status { font-size: .6rem; min-width: 50px; text-align: right; flex-shrink: 0; }

/* ── Responsive ──────────────────────────────────── */
@media (max-width: 700px) {
    .masthead { padding: .8rem 1rem; }
    .title-icon-box { width: 38px; height: 38px; min-width: 38px; font-size: .95rem; }
    .cms-title { gap: .65rem; }
    .hint-chip { display: none; }
    .grid-area { padding: .9rem 1rem 5rem; }
    .alerts-outer { padding: .5rem 1rem 0; }
    .tabs-scroll { padding: .65rem 1rem .75rem; }
    .sections-grid { grid-template-columns: 1fr; gap: .75rem; }
    /* Reorder bar full width on mobile */
    .reorder-bar {
        left: .85rem; right: .85rem;
        transform: translateX(0) translateY(120px);
        max-width: none;
    }
    .reorder-bar.visible { transform: translateX(0) translateY(0); }
}
@media (max-width: 420px) {
    .masthead { padding: .65rem .85rem; }
    .grid-area { padding: .75rem .85rem 5rem; }
    .tabs-scroll { padding: .55rem .85rem .65rem; }
    .card-hd { padding: .52rem .7rem; }
    .card-body { padding: .55rem .7rem; }
    .btn-edit { padding: .28rem .52rem; font-size: .55rem; }
    .order-num { font-size: .9rem; }
}
</style>
@endpush

@section('content')
<div class="cms-wrap">

    {{-- Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-inner">
            ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS PAGE SECTIONS &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ CLICK EDIT TO MODIFY &nbsp;&nbsp;&nbsp; ◆ HNP COMMUNICATIONS ADMIN PANEL &nbsp;&nbsp;&nbsp; ◆ CMS PAGE SECTIONS &nbsp;&nbsp;&nbsp; ◆ DRAG TO REORDER &nbsp;&nbsp;&nbsp; ◆ CLICK EDIT TO MODIFY &nbsp;&nbsp;&nbsp;
        </div>
    </div>

    {{-- Masthead --}}
    <div class="masthead">
        <div class="masthead-inner">
            <div class="cms-title">
                <div class="title-icon-box">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="title-text">
                    <div class="title-main">CMS SECTIONS</div>
                    <div class="title-page-tag">{{ $page }}</div>
                    <div class="title-sub">{{ $sections->count() ?? 0 }} SECTION DITEMUKAN</div>
                </div>
            </div>
            <div class="hint-chip">
                <i class="fas fa-grip-vertical"></i>
                DRAG REORDER
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success') || session('error'))
    <div class="alerts-outer" style="margin-top:.6rem">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
    </div>
    @endif

    {{-- ══════════════════════════════════════════════
         TABS — SMOOTH HORIZONTAL SCROLL
         ══════════════════════════════════════════════ --}}
    <div class="tabs-outer">
        {{-- Fade left (muncul saat scroll kanan) --}}
        <div class="tabs-fade-left" id="tabs-fade-left"></div>

        <div class="tabs-scroll" id="tabs-scroll">
            <span class="tabs-label">PAGE&nbsp;/</span>
            @foreach($availablePages as $p)
            <a href="{{ route('admin.cms.page-sections.index', ['page' => $p]) }}"
               class="page-tab {{ $p === $page ? 'active' : '' }}"
               data-page="{{ $p }}">
                {{ $p }}
            </a>
            @endforeach
        </div>

        {{-- Fade right (visual hint ada lebih banyak tab) --}}
        <div class="tabs-fade-right" id="tabs-fade-right"></div>
    </div>

    {{-- Grid --}}
    <div class="grid-area">
        @if($sections->isEmpty())
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-inbox"></i></span>
            <p>BELUM ADA SECTION UNTUK HALAMAN <strong>{{ strtoupper($page) }}</strong></p>
        </div>
        @else
        <div class="row-label">SECTION LIST — {{ strtoupper($page) }}</div>
        <div class="sections-grid" id="sortable-grid">
            @foreach($sections as $section)
            @php
                $fields  = $section->getFields();
                $content = $section->content ?? [];
                $preview = array_slice($fields, 0, 4);
                $more    = count($fields) - count($preview);
            @endphp
            <div class="section-card {{ !$section->is_active ? 'inactive' : '' }}" data-id="{{ $section->id }}">
                <div class="card-accent"></div>
                <div class="card-hd">
                    <div class="card-hd-left">
                        <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                        <span class="order-num">{{ str_pad($section->order, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="card-meta">
                            <div class="card-label">{{ $section->label }}</div>
                            <div class="card-key">{{ $section->section_key }}</div>
                        </div>
                        <div class="status-pip {{ !$section->is_active ? 'off' : '' }}"></div>
                    </div>
                    <div class="card-actions">
                        <form method="POST" action="{{ route('admin.cms.page-sections.toggle', $section) }}" class="toggle-form">
                            @csrf @method('PATCH')
                            <label class="toggle" title="{{ $section->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                <input type="checkbox" {{ $section->is_active ? 'checked' : '' }} onchange="this.closest('form').submit()">
                                <span class="toggle-track"></span>
                                <span class="toggle-thumb"></span>
                            </label>
                        </form>
                        <a href="{{ route('admin.cms.page-sections.edit', $section) }}" class="btn-edit">
                            <i class="fas fa-pen"></i> EDIT
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="field-rows">
                        @foreach($preview as $field)
                        @php $key = $field['key']; $val = $content[$key] ?? null; $type = $field['type']; @endphp
                        <div class="field-row">
                            <span class="f-label">{{ Str::limit($field['label'], 13) }}</span>
                            @if($type === 'image')
                                @if($val) <img src="{{ Storage::url($val) }}" alt="" class="f-img">
                                @else <span class="f-val empty">— no image</span> @endif
                            @elseif($type === 'color')
                                @if($val)
                                    <span class="f-color-dot" style="background:{{ $val }}"></span>
                                    <span class="f-val" style="font-family:'JetBrains Mono',monospace;font-size:.54rem">{{ $val }}</span>
                                @else <span class="f-val empty">—</span> @endif
                            @else
                                <span class="f-val {{ !$val ? 'empty' : '' }}">{{ $val ? Str::limit(strip_tags($val), 42) : '—' }}</span>
                            @endif
                        </div>
                        @endforeach
                        @if($more > 0)
                        <div class="more-label">+{{ $more }} more fields</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Reorder Bar --}}
    <div class="reorder-bar" id="reorder-bar">
        <div class="blink-dot"></div>
        <span class="bar-text">URUTAN BERUBAH</span>
        <button class="btn-save-order" id="btn-save-order">SIMPAN</button>
        <span id="reorder-status"></span>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ════════════════════════════════════════════════
       TABS — SCROLL LOGIC
       - Auto-scroll ke tab aktif saat halaman load
       - Fade kiri/kanan update saat scroll
       ════════════════════════════════════════════ */
    const tabsScroll   = document.getElementById('tabs-scroll');
    const fadeRight    = document.getElementById('tabs-fade-right');
    const fadeLeft     = document.getElementById('tabs-fade-left');
    const activeTab    = tabsScroll?.querySelector('.page-tab.active');

    function updateTabsFade() {
        if (!tabsScroll) return;
        const { scrollLeft, scrollWidth, clientWidth } = tabsScroll;
        const atStart = scrollLeft <= 2;
        const atEnd   = scrollLeft + clientWidth >= scrollWidth - 2;
        if (fadeRight) fadeRight.style.opacity = atEnd   ? '0' : '1';
        if (fadeLeft)  fadeLeft.style.opacity  = atStart ? '0' : '1';
    }

    /* Auto-scroll tab aktif ke tengah viewport tabs */
    if (activeTab && tabsScroll) {
        const tabLeft    = activeTab.offsetLeft;
        const tabWidth   = activeTab.offsetWidth;
        const scrollW    = tabsScroll.clientWidth;
        const targetScroll = tabLeft - (scrollW / 2) + (tabWidth / 2);
        tabsScroll.scrollTo({ left: Math.max(0, targetScroll), behavior: 'instant' });
    }

    tabsScroll?.addEventListener('scroll', updateTabsFade, { passive: true });
    updateTabsFade(); /* initial check */

    /* Swipe gesture percepat (momentum pada mobile sudah native) */
    let isDown = false, startX = 0, scrollStart = 0;
    tabsScroll?.addEventListener('mousedown', e => {
        isDown = true; startX = e.pageX - tabsScroll.offsetLeft;
        scrollStart = tabsScroll.scrollLeft;
        tabsScroll.style.cursor = 'grabbing';
    });
    window.addEventListener('mouseup', () => { isDown = false; tabsScroll.style.cursor = ''; });
    tabsScroll?.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x    = e.pageX - tabsScroll.offsetLeft;
        const walk = (x - startX) * 1.2;
        tabsScroll.scrollLeft = scrollStart - walk;
    });

    /* ════════════════════════════════════════════════
       DRAG & DROP — SECTION CARDS
       ════════════════════════════════════════════ */
    const grid    = document.getElementById('sortable-grid');
    const bar     = document.getElementById('reorder-bar');
    const btnSave = document.getElementById('btn-save-order');
    const statusEl= document.getElementById('reorder-status');
    if (!grid) return;

    let dragged = null, touchDragged = null, touchClone = null;
    let touchStartX = 0, touchStartY = 0, touchCardRect = null;

    function initCard(card) {
        card.setAttribute('draggable', 'true');

        /* Desktop */
        card.addEventListener('dragstart', e => {
            dragged = card;
            setTimeout(() => card.classList.add('dragging'), 0);
            e.dataTransfer.effectAllowed = 'move';
        });
        card.addEventListener('dragend', () => {
            card.classList.remove('dragging');
            grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
            dragged = null;
        });
        card.addEventListener('dragover', e => {
            e.preventDefault();
            if (card !== dragged) {
                grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
                card.classList.add('drag-over');
            }
        });
        card.addEventListener('drop', e => {
            e.preventDefault();
            if (!dragged || dragged === card) return;
            const cards = [...grid.querySelectorAll('.section-card')];
            grid.insertBefore(dragged, cards.indexOf(dragged) < cards.indexOf(card)
                ? card.nextSibling : card);
            updateBadges(); bar.classList.add('visible');
        });

        /* Touch */
        card.addEventListener('touchstart', e => {
            touchDragged  = card;
            const t       = e.touches[0];
            touchStartX   = t.clientX; touchStartY = t.clientY;
            touchCardRect = card.getBoundingClientRect();
            touchClone    = card.cloneNode(true);
            Object.assign(touchClone.style, {
                position:'fixed', zIndex:'9999', opacity:'.72',
                pointerEvents:'none', width:touchCardRect.width+'px',
                transform:'rotate(-1deg) scale(.97)',
                boxShadow:'6px 6px 0 #0D0D0D',
                left:touchCardRect.left+'px', top:touchCardRect.top+'px',
                transition:'none',
            });
            document.body.appendChild(touchClone);
            card.classList.add('dragging');
        }, { passive: true });

        card.addEventListener('touchmove', e => {
            if (!touchDragged || !touchClone) return;
            e.preventDefault();
            const t  = e.touches[0];
            touchClone.style.left = (touchCardRect.left + t.clientX - touchStartX) + 'px';
            touchClone.style.top  = (touchCardRect.top  + t.clientY - touchStartY) + 'px';
            const el = document.elementFromPoint(t.clientX, t.clientY);
            const tgt = el?.closest('.section-card');
            grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
            if (tgt && tgt !== touchDragged) tgt.classList.add('drag-over');
        }, { passive: false });

        card.addEventListener('touchend', e => {
            if (!touchDragged) return;
            const t   = e.changedTouches[0];
            const el  = document.elementFromPoint(t.clientX, t.clientY);
            const tgt = el?.closest('.section-card');
            if (tgt && tgt !== touchDragged) {
                const cards = [...grid.querySelectorAll('.section-card')];
                grid.insertBefore(touchDragged, cards.indexOf(touchDragged) < cards.indexOf(tgt)
                    ? tgt.nextSibling : tgt);
                updateBadges(); bar.classList.add('visible');
            }
            touchDragged.classList.remove('dragging');
            grid.querySelectorAll('.section-card').forEach(c => c.classList.remove('drag-over'));
            if (touchClone) { document.body.removeChild(touchClone); touchClone = null; }
            touchDragged = null;
        }, { passive: true });
    }

    grid.querySelectorAll('.section-card').forEach(initCard);

    function updateBadges() {
        grid.querySelectorAll('.section-card').forEach((c, i) => {
            const b = c.querySelector('.order-num');
            if (b) b.textContent = String(i + 1).padStart(2, '0');
        });
    }

    /* Save order */
    btnSave?.addEventListener('click', () => {
        const ids = [...grid.querySelectorAll('.section-card')].map(c => c.dataset.id);
        statusEl.textContent = 'SAVING...';
        btnSave.disabled = true;
        fetch('{{ route('admin.cms.page-sections.reorder') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ order: ids }),
        }).then(r => r.json()).then(data => {
            if (data.success) {
                statusEl.textContent = '✓ OK';
                setTimeout(() => {
                    bar.classList.remove('visible');
                    statusEl.textContent = '';
                    btnSave.disabled = false;
                }, 2000);
            } else throw new Error();
        }).catch(() => {
            statusEl.textContent = '✗ ERROR';
            btnSave.disabled = false;
        });
    });
});
</script>
@endpush