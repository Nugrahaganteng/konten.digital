@extends('layouts.admin')

@section('title', 'CMS — ' . strtoupper($page))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IBM+Plex+Mono:wght@400;600;700&family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════════════════
   DARK RETRO ARCADE CMS — HNP COMMUNICATIONS
   Vibes: 90s Zine · Neon Noir · Arcade Cabinet
   Palette: Deep Navy #0A0A14 · Neon Yellow #F5E642
            Hot Magenta #FF2D6B · Cyan #00E5FF · Lime #B8FF00
   Font: Bebas Neue (headers) · IBM Plex Mono (ui)
   ═════════════════════════════════════════════════════ */
:root {
    --bg:        #0A0A14;
    --bg2:       #0F0F1E;
    --bg3:       #141428;
    --panel:     #12121F;
    --panel2:    #1A1A2E;
    --border:    #2A2A4A;
    --border2:   #3A3A60;
    --yellow:    #F5E642;
    --magenta:   #FF2D6B;
    --cyan:      #00E5FF;
    --lime:      #B8FF00;
    --orange:    #FF6B00;
    --text:      #E8E8F0;
    --text2:     #9090B8;
    --muted:     #50507A;
    --r:         6px;
    --r-lg:      10px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--bg);
    color: var(--text);
    font-family: 'Barlow', sans-serif;
    font-size: 13px;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
    min-height: 100vh;
}

/* ── Noise Texture Overlay ─────────────────────────── */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    background-size: 200px 200px;
    pointer-events: none;
    z-index: 0;
    opacity: .6;
}

/* ── Scanline Effect ───────────────────────────────── */
body::after {
    content: '';
    position: fixed;
    inset: 0;
    background: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 2px,
        rgba(0,0,0,.08) 2px,
        rgba(0,0,0,.08) 4px
    );
    pointer-events: none;
    z-index: 0;
}

.cms-wrap {
    position: relative;
    z-index: 1;
    animation: wakeUp .5s ease both;
}
@keyframes wakeUp {
    from { opacity: 0; transform: scale(.99); }
    to   { opacity: 1; transform: scale(1); }
}

/* ── Alerts ────────────────────────────────────────── */
.alerts-outer { padding: 0 1.5rem; }
.alert {
    display: flex;
    align-items: center;
    gap: .6rem;
    padding: .7rem 1rem;
    border-radius: var(--r);
    border: 1px solid;
    margin-bottom: .75rem;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .72rem;
    font-weight: 600;
    animation: slideDown .25s ease;
}
.alert-success { background: rgba(184,255,0,.06); border-color: rgba(184,255,0,.3); color: var(--lime); }
.alert-error   { background: rgba(255,45,107,.06); border-color: rgba(255,45,107,.3); color: var(--magenta); }
@keyframes slideDown {
    from { opacity:0; transform:translateY(-6px); }
    to   { opacity:1; transform:translateY(0); }
}

/* ── Masthead ──────────────────────────────────────── */
.masthead {
    background: var(--panel);
    border-bottom: 2px solid var(--border);
    padding: 0 1.5rem;
    position: relative;
    overflow: hidden;
}
/* Top ticker bar */
.ticker-bar {
    background: var(--yellow);
    padding: 3px 0;
    overflow: hidden;
    white-space: nowrap;
}
.ticker-inner {
    display: inline-block;
    animation: ticker 18s linear infinite;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    color: var(--bg);
    letter-spacing: .12em;
    text-transform: uppercase;
    padding-right: 60px;
}
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

.masthead-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
    padding: 1.1rem 0;
}
.cms-title {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.title-icon-box {
    width: 44px;
    height: 44px;
    background: var(--yellow);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: var(--bg);
    flex-shrink: 0;
    position: relative;
    clip-path: polygon(8px 0%, 100% 0%, calc(100% - 8px) 100%, 0% 100%);
    transition: transform .2s;
}
.title-icon-box:hover { transform: skewX(-4deg) scale(1.05); }
.title-text-wrap { line-height: 1; }
.title-main {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.8rem;
    letter-spacing: .08em;
    color: var(--text);
    line-height: .9;
    display: flex;
    align-items: baseline;
    gap: .5rem;
}
.title-accent { color: var(--yellow); }
.title-page-tag {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    background: var(--yellow);
    color: var(--bg);
    padding: 1px 6px;
    letter-spacing: .1em;
    text-transform: uppercase;
    display: inline-block;
    margin-top: 3px;
}
.title-sub {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .6rem;
    color: var(--muted);
    margin-top: 2px;
    letter-spacing: .05em;
}
.masthead-right {
    display: flex;
    align-items: center;
    gap: .75rem;
}
.hint-chip {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .62rem;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: .4rem;
    border: 1px solid var(--border);
    padding: .3rem .7rem;
    border-radius: 3px;
}

/* ── Page Tabs ─────────────────────────────────────── */
.tabs-wrap {
    background: var(--bg2);
    border-bottom: 2px solid var(--border);
    padding: .75rem 1.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: .4rem;
    align-items: center;
}
.tabs-label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-right: .25rem;
}
.page-tab {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .62rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .35rem .85rem;
    border-radius: 3px;
    border: 1px solid var(--border2);
    background: var(--bg3);
    color: var(--text2);
    text-decoration: none;
    transition: all .15s;
    position: relative;
    top: 0;
}
.page-tab:hover {
    border-color: var(--cyan);
    color: var(--cyan);
    background: rgba(0,229,255,.06);
    top: -2px;
}
.page-tab.active {
    background: var(--yellow);
    border-color: var(--yellow);
    color: var(--bg);
    font-weight: 700;
}

/* ── Grid Area ─────────────────────────────────────── */
.grid-area {
    padding: 1.25rem 1.5rem 5rem;
}

/* Row label */
.row-label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .12em;
    margin-bottom: .65rem;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.row-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
}

.sections-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
    gap: .9rem;
    margin-bottom: 1.5rem;
}

/* ── Section Card ──────────────────────────────────── */
.section-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: var(--r-lg);
    overflow: hidden;
    cursor: grab;
    position: relative;
    transition: border-color .2s, box-shadow .2s, transform .2s;
    animation: cardReveal .4s ease both;
}
.section-card::before {
    /* Left accent bar */
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--yellow);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform .25s ease;
}
.section-card:hover { border-color: var(--border2); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,.5); }
.section-card:hover::before { transform: scaleY(1); }
.section-card:active { cursor: grabbing; }
.section-card.dragging { opacity: .35; transform: rotate(-1.5deg) scale(.97); border-color: var(--cyan); }
.section-card.drag-over { border-color: var(--lime); box-shadow: 0 0 0 1px var(--lime); }
.section-card.inactive { opacity: .45; }
.section-card.inactive::before { background: var(--muted); }

@keyframes cardReveal {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}
.section-card:nth-child(1)  { animation-delay: .03s; }
.section-card:nth-child(2)  { animation-delay: .06s; }
.section-card:nth-child(3)  { animation-delay: .09s; }
.section-card:nth-child(4)  { animation-delay: .12s; }
.section-card:nth-child(5)  { animation-delay: .15s; }
.section-card:nth-child(6)  { animation-delay: .18s; }
.section-card:nth-child(7)  { animation-delay: .21s; }
.section-card:nth-child(8)  { animation-delay: .24s; }

/* Card Top Strip — neon line per card */
.card-neon-strip {
    height: 2px;
    background: linear-gradient(90deg, var(--yellow) 0%, var(--cyan) 60%, transparent 100%);
    opacity: 0;
    transition: opacity .3s;
}
.section-card:hover .card-neon-strip { opacity: 1; }

/* Card Header */
.card-hd {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .6rem .85rem;
    background: var(--panel2);
    border-bottom: 1px solid var(--border);
    gap: .6rem;
}
.card-hd-left {
    display: flex;
    align-items: center;
    gap: .5rem;
    min-width: 0;
    flex: 1;
}
.drag-handle {
    color: var(--muted);
    font-size: .65rem;
    cursor: grab;
    flex-shrink: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color .15s;
}
.drag-handle:hover { color: var(--yellow); }
.order-num {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1rem;
    color: var(--yellow);
    line-height: 1;
    flex-shrink: 0;
    min-width: 20px;
}
.card-meta { min-width: 0; }
.card-label {
    font-family: 'Bebas Neue', sans-serif;
    font-size: .95rem;
    letter-spacing: .06em;
    color: var(--text);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.1;
}
.card-key {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    color: var(--muted);
    margin-top: 1px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.card-actions {
    display: flex;
    align-items: center;
    gap: .45rem;
    flex-shrink: 0;
}

/* Toggle Switch */
.toggle-form { display: inline-flex; }
.toggle {
    position: relative;
    width: 32px;
    height: 17px;
    cursor: pointer;
    display: block;
}
.toggle input { opacity: 0; width: 0; height: 0; position: absolute; }
.toggle-track {
    position: absolute;
    inset: 0;
    background: var(--border);
    border-radius: 999px;
    border: 1px solid var(--border2);
    transition: all .2s;
}
.toggle input:checked ~ .toggle-track {
    background: var(--lime);
    border-color: var(--lime);
    box-shadow: 0 0 8px rgba(184,255,0,.4);
}
.toggle-thumb {
    position: absolute;
    top: 3px; left: 3px;
    width: 11px; height: 11px;
    background: var(--muted);
    border-radius: 50%;
    transition: transform .2s, background .2s;
    pointer-events: none;
}
.toggle input:checked ~ .toggle-thumb {
    transform: translateX(15px);
    background: var(--bg);
}

/* Edit Btn */
.btn-edit {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    letter-spacing: .04em;
    padding: .3rem .7rem;
    border-radius: 3px;
    background: var(--yellow);
    border: none;
    color: var(--bg);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: .3rem;
    transition: all .15s;
    white-space: nowrap;
    text-transform: uppercase;
}
.btn-edit:hover {
    background: var(--cyan);
    color: var(--bg);
    box-shadow: 0 0 12px rgba(0,229,255,.4);
}

/* Card Body */
.card-body { padding: .75rem .85rem; }
.field-rows { display: flex; flex-direction: column; gap: 0; }
.field-row {
    display: flex;
    align-items: flex-start;
    gap: .5rem;
    font-size: .72rem;
    padding: .28rem .3rem;
    border-radius: 3px;
    transition: background .12s;
    border-bottom: 1px solid rgba(255,255,255,.03);
}
.field-row:last-child { border-bottom: none; }
.field-row:hover { background: rgba(245,230,66,.04); }
.f-label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .6rem;
    color: var(--muted);
    min-width: 90px;
    flex-shrink: 0;
    padding-top: 1px;
}
.f-val { color: var(--text2); word-break: break-word; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; }
.f-val.empty { color: var(--muted); }
.f-img {
    width: 36px; height: 26px;
    object-fit: cover;
    border-radius: 3px;
    border: 1px solid var(--border2);
    opacity: .85;
}
.f-color-dot {
    width: 12px; height: 12px;
    border-radius: 2px;
    border: 1px solid var(--border2);
    flex-shrink: 0;
    margin-top: 2px;
}
.more-label {
    font-family: 'IBM Plex Mono', monospace;
    font-size: .58rem;
    color: var(--muted);
    padding: .3rem .3rem 0;
    border-top: 1px dashed var(--border);
    margin-top: .2rem;
}

/* Status indicator dot */
.status-pip {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--lime);
    box-shadow: 0 0 6px var(--lime);
    flex-shrink: 0;
    margin-left: auto;
    animation: pip 2s ease infinite;
}
.status-pip.off { background: var(--border2); box-shadow: none; animation: none; }
@keyframes pip { 0%,100% { opacity:1; } 50% { opacity:.3; } }

/* ── Empty State ───────────────────────────────────── */
.empty-state {
    text-align: center;
    padding: 5rem 2rem;
    color: var(--muted);
    font-family: 'IBM Plex Mono', monospace;
}
.empty-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    display: block;
    filter: grayscale(1);
    opacity: .3;
}
.empty-state p { font-size: .78rem; }

/* ── Reorder Float Bar ─────────────────────────────── */
.reorder-bar {
    position: fixed;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: var(--panel2);
    border: 1px solid var(--yellow);
    border-radius: 4px;
    padding: .65rem .65rem .65rem 1.1rem;
    display: flex;
    align-items: center;
    gap: .75rem;
    box-shadow: 0 0 30px rgba(245,230,66,.2), 0 16px 48px rgba(0,0,0,.6);
    z-index: 999;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .72rem;
    color: var(--yellow);
    transition: transform .35s cubic-bezier(.34,1.56,.64,1), opacity .3s;
    opacity: 0;
    pointer-events: none;
}
.reorder-bar.visible {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
    pointer-events: auto;
}
.blink-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: var(--yellow);
    animation: blink .8s step-end infinite;
    flex-shrink: 0;
}
@keyframes blink { 0%,100% { opacity:1; } 50% { opacity:0; } }
.btn-save-order {
    background: var(--yellow);
    color: var(--bg);
    border: none;
    border-radius: 3px;
    padding: .4rem 1rem;
    font-family: 'IBM Plex Mono', monospace;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background .15s, box-shadow .15s;
}
.btn-save-order:hover { background: var(--cyan); box-shadow: 0 0 14px rgba(0,229,255,.4); }
.btn-save-order:disabled { opacity: .4; cursor: not-allowed; }
#reorder-status {
    font-size: .65rem;
    font-family: 'IBM Plex Mono', monospace;
    min-width: 65px;
}

/* ── Responsive ────────────────────────────────────── */
@media (max-width: 640px) {
    .sections-grid { grid-template-columns: 1fr; }
    .masthead-inner { flex-direction: column; align-items: flex-start; }
    .grid-area, .tabs-wrap, .masthead { padding-left: 1rem; padding-right: 1rem; }
}
</style>
@endpush

@section('content')
<div class="cms-wrap">

    {{-- Ticker Bar --}}
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
                <div class="title-text-wrap">
                    <div class="title-main">
                        CMS <span class="title-accent">SECTIONS</span>
                        <div class="title-page-tag">{{ $page }}</div>
                    </div>
                    <div class="title-sub">KELOLA KONTEN HALAMAN · {{ $sections->count() ?? 0 }} SECTION DITEMUKAN</div>
                </div>
            </div>
            <div class="masthead-right">
                <div class="hint-chip">
                    <i class="fas fa-grip-vertical"></i>
                    DRAG UNTUK REORDER
                </div>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    <div class="alerts-outer" style="margin-top:.75rem">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>{{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>{{ session('error') }}
        </div>
        @endif
    </div>

    {{-- Tabs --}}
    <div class="tabs-wrap">
        <span class="tabs-label">PAGE /</span>
        @foreach($availablePages as $p)
        <a href="{{ route('admin.cms.page-sections.index', ['page' => $p]) }}"
           class="page-tab {{ $p === $page ? 'active' : '' }}">
            {{ $p }}
        </a>
        @endforeach
    </div>

    {{-- Grid --}}
    <div class="grid-area">
        @if($sections->isEmpty())
        <div class="empty-state">
            <span class="empty-icon"><i class="fas fa-inbox"></i></span>
            <p>BELUM ADA SECTION UNTUK HALAMAN <strong style="color:var(--yellow)">{{ strtoupper($page) }}</strong></p>
        </div>
        @else

        <div class="row-label">SECTION LIST — {{ strtoupper($page) }}</div>

        <div class="sections-grid" id="sortable-grid">
            @foreach($sections as $section)
            @php
                $fields  = $section->getFields();
                $content = $section->content ?? [];
                $preview = array_slice($fields, 0, 5);
                $more    = count($fields) - count($preview);
            @endphp

            <div class="section-card {{ !$section->is_active ? 'inactive' : '' }}" data-id="{{ $section->id }}">
                <div class="card-neon-strip"></div>
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
                        <form method="POST"
                              action="{{ route('admin.cms.page-sections.toggle', $section) }}"
                              class="toggle-form">
                            @csrf @method('PATCH')
                            <label class="toggle" title="{{ $section->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                <input type="checkbox"
                                       {{ $section->is_active ? 'checked' : '' }}
                                       onchange="this.closest('form').submit()">
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
                        @php
                            $key  = $field['key'];
                            $val  = $content[$key] ?? null;
                            $type = $field['type'];
                        @endphp
                        <div class="field-row">
                            <span class="f-label">{{ Str::limit($field['label'], 16) }}</span>

                            @if($type === 'image')
                                @if($val)
                                    <img src="{{ Storage::url($val) }}" alt="" class="f-img">
                                @else
                                    <span class="f-val empty">— no image</span>
                                @endif
                            @elseif($type === 'color')
                                @if($val)
                                    <span class="f-color-dot" style="background:{{ $val }}"></span>
                                    <span class="f-val" style="font-family:'IBM Plex Mono',monospace;font-size:.6rem">{{ $val }}</span>
                                @else
                                    <span class="f-val empty">—</span>
                                @endif
                            @else
                                <span class="f-val {{ !$val ? 'empty' : '' }}">
                                    {{ $val ? Str::limit(strip_tags($val), 48) : '—' }}
                                </span>
                            @endif
                        </div>
                        @endforeach

                        @if($more > 0)
                        <div class="more-label">+{{ $more }} MORE FIELDS</div>
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
        <span>URUTAN BERUBAH</span>
        <button class="btn-save-order" id="btn-save-order">SIMPAN</button>
        <span id="reorder-status"></span>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const grid     = document.getElementById('sortable-grid');
    const bar      = document.getElementById('reorder-bar');
    const btnSave  = document.getElementById('btn-save-order');
    const statusEl = document.getElementById('reorder-status');
    if (!grid) return;

    let dragged = null;

    grid.querySelectorAll('.section-card').forEach(card => {
        card.setAttribute('draggable', 'true');
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
            const cards   = [...grid.querySelectorAll('.section-card')];
            const fromIdx = cards.indexOf(dragged);
            const toIdx   = cards.indexOf(card);
            grid.insertBefore(dragged, fromIdx < toIdx ? card.nextSibling : card);
            updateBadges();
            bar.classList.add('visible');
        });
    });

    function updateBadges() {
        grid.querySelectorAll('.section-card').forEach((c, i) => {
            const badge = c.querySelector('.order-num');
            if (badge) badge.textContent = String(i + 1).padStart(2, '0');
        });
    }

    btnSave.addEventListener('click', () => {
        const ids = [...grid.querySelectorAll('.section-card')].map(c => c.dataset.id);
        statusEl.textContent  = 'SAVING...';
        statusEl.style.color  = 'var(--yellow)';
        btnSave.disabled = true;

        fetch('{{ route('admin.cms.page-sections.reorder') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ order: ids }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                statusEl.textContent = '✓ OK';
                statusEl.style.color = 'var(--lime)';
                setTimeout(() => {
                    bar.classList.remove('visible');
                    statusEl.textContent = '';
                    btnSave.disabled = false;
                }, 2000);
            } else { throw new Error(); }
        })
        .catch(() => {
            statusEl.textContent = '✗ ERROR';
            statusEl.style.color = 'var(--magenta)';
            btnSave.disabled = false;
        });
    });
});
</script>
@endpush