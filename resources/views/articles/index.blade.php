{{-- resources/views/articles/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Artikel & Blog')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
    /* ── CORE VARIABLES ─────────────────── */
    :root {
        --black: #0a0a0a;
        --white: #f5f0e8;
        --yellow: #FFD000;
        --cyan: #00E5FF;
        --purple: #3b0764;
        --red: #FF2D55;
        --card-shadow: 5px 5px 0px var(--black);
        --card-shadow-hover: 2px 2px 0px var(--black);
    }

    * { box-sizing: border-box; }

    body { background-color: var(--purple); }

    /* ── BRUTAL BUTTON ──────────────────── */
    .btn-brutal {
        box-shadow: var(--card-shadow);
        transition: box-shadow 0.12s ease, transform 0.12s ease;
        cursor: pointer;
    }
    .btn-brutal:hover {
        box-shadow: var(--card-shadow-hover);
        transform: translate(3px, 3px);
    }
    .btn-brutal:active {
        box-shadow: none;
        transform: translate(5px, 5px);
    }

    /* ── RETRO GRID BACKGROUND ──────────── */
    .page-bg {
        background-color: var(--purple);
        background-image:
            radial-gradient(circle, rgba(255,208,0,0.06) 1px, transparent 1px);
        background-size: 28px 28px;
        min-height: 100vh;
    }

    /* ── SCANLINE OVERLAY ───────────────── */
    /* FIX: parent harus position:relative agar ::after bisa inset:0 dengan benar */
    .scanline-overlay {
        position: relative;
        overflow: hidden; /* tambahan agar pseudo-element tidak keluar batas */
    }
    .scanline-overlay::after {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: repeating-linear-gradient(
            0deg,
            transparent,
            transparent 3px,
            rgba(0,0,0,0.06) 3px,
            rgba(0,0,0,0.06) 4px
        );
        border-radius: inherit;
        z-index: 1; /* pastikan di atas konten tapi tidak menghalangi klik */
    }

    /* ── HERO BADGE TICKER ──────────────── */
    .ticker-wrap {
        overflow: hidden;
        border-top: 3px solid var(--black);
        border-bottom: 3px solid var(--black);
        background: var(--black);
    }
    .ticker-track {
        display: flex;
        white-space: nowrap;
        animation: ticker 18s linear infinite;
        /* FIX: gap:0 sudah benar, tapi width harus minimal 200% agar animasi loop mulus */
        width: max-content;
    }
    .ticker-track span {
        padding: 0 2rem;
        color: var(--yellow);
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        line-height: 2.5rem;
    }
    .ticker-track span.sep { color: var(--cyan); }
    @keyframes ticker {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* ── HERO ───────────────────────────── */
    .hero-wrap {
        background: var(--yellow);
        border: 3px solid var(--black);
        box-shadow: 8px 8px 0 var(--black);
        position: relative;
        overflow: hidden;
    }
    .hero-inner {
        background: var(--white);
        border: 3px solid var(--black);
        margin: 6px;
        padding: 2.5rem 2.5rem 2rem;
        position: relative;
        overflow: hidden;
    }
    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--black);
        color: var(--yellow);
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 0.25rem 0.75rem;
        margin-bottom: 1.25rem;
    }
    .hero-eyebrow::before {
        content: '▶';
        font-size: 0.55rem;
        color: var(--cyan);
    }
    .hero-title {
        font-family: 'Unbounded', sans-serif;
        font-weight: 900;
        font-size: clamp(2.8rem, 8vw, 6rem);
        line-height: 0.92;
        text-transform: uppercase;
        color: var(--black);
        margin-bottom: 1.5rem;
    }
    .hero-title .outline {
        -webkit-text-stroke: 3px var(--black);
        color: transparent;
    }
    .hero-title .accent {
        color: var(--purple);
    }
    .hero-desc {
        font-family: 'Space Mono', monospace;
        font-size: 0.875rem;
        color: #333;
        line-height: 1.75;
        max-width: 38ch;
        border-left: 4px solid var(--cyan);
        padding-left: 1rem;
    }
    .hero-pixel {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-family: 'Space Mono', monospace;
        font-size: 1.4rem;
        color: var(--purple);
        opacity: 0.12;
        letter-spacing: 0.3em;
        font-weight: 700;
        user-select: none;
    }
    .hero-stripe {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 160px;
        height: 8px;
        background: repeating-linear-gradient(
            90deg,
            var(--cyan) 0px,
            var(--cyan) 16px,
            var(--black) 16px,
            var(--black) 20px
        );
    }

    /* ── STATS BAR ──────────────────────── */
    .stats-bar {
        display: flex;
        border: 3px solid var(--black);
        background: var(--white);
        box-shadow: 5px 5px 0 var(--black);
        overflow: hidden;
    }
    .stats-item {
        flex: 1;
        padding: 1rem 1.25rem;
        border-right: 3px solid var(--black);
        display: flex;
        flex-direction: column;
        gap: 0.15rem;
    }
    .stats-item:last-child { border-right: none; }
    .stats-label {
        font-family: 'Space Mono', monospace;
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: #555;
        font-weight: 700;
    }
    .stats-value {
        font-family: 'Unbounded', sans-serif;
        font-size: 1.4rem;
        font-weight: 900;
        color: var(--black);
    }
    .stats-value.cyan { color: #008caa; }
    .stats-value.red  { color: var(--red); }

    /* ── CONTROL PANEL ──────────────────── */
    .control-panel {
        background: var(--white);
        border: 3px solid var(--black);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }
    .control-row {
        display: flex;
        align-items: stretch;
        border-bottom: 3px solid var(--black);
    }
    .control-row:last-child { border-bottom: none; }
    .control-row-label {
        display: flex;
        align-items: center;
        padding: 0 1rem;
        background: var(--black);
        color: var(--yellow);
        font-family: 'Space Mono', monospace;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        white-space: nowrap;
        border-right: 3px solid var(--black);
        min-width: 80px;
        justify-content: center;
        /* FIX: hapus writing-mode:horizontal-tb karena itu nilai default, tidak perlu ditulis */
    }
    .control-row-label .label-icon {
        margin-right: 0.4rem;
        font-size: 0.7rem;
    }

    /* Filter buttons row */
    .filter-panel {
        display: flex;
        flex-wrap: wrap;
        gap: 0;
        align-items: stretch;
        flex: 1;
        /* FIX: overflow hidden agar filter tidak keluar batas di mobile */
        overflow-x: auto;
    }
    .filter-btn {
        font-family: 'Space Mono', monospace;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 0.65rem 1.1rem;
        border: none;
        border-right: 2px solid rgba(0,0,0,0.12);
        background: var(--white);
        color: #555;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background 0.1s, color 0.1s;
        white-space: nowrap; /* FIX: cegah teks filter wrap di mobile */
    }
    .filter-btn:last-child { border-right: none; }
    .filter-btn:hover { background: #ede8e0; color: var(--black); }
    .filter-btn.active {
        background: var(--cyan);
        color: var(--black);
        font-weight: 700;
        position: relative;
    }
    .filter-btn.active::after {
        content: '▼';
        font-size: 0.45rem;
        margin-left: 0.4rem;
        opacity: 0.6;
    }

    /* Search row */
    .search-wrap {
        display: flex;
        flex: 1;
        align-items: stretch;
    }
    .search-wrap input {
        flex: 1;
        border: none;
        outline: none;
        padding: 0.7rem 1rem;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        background: var(--white);
        color: var(--black);
        min-width: 0;
    }
    .search-wrap input::placeholder { color: #aaa; }
    .search-btn {
        background: var(--black);
        color: var(--yellow);
        border: none;
        border-left: 3px solid var(--black);
        padding: 0 1.5rem;
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        cursor: pointer;
        transition: background 0.12s;
        white-space: nowrap;
    }
    .search-btn:hover { background: var(--purple); }

    /* ── ARTICLE CARD ───────────────────── */
    .article-card {
        background: var(--white);
        border: 3px solid var(--black);
        display: flex;
        flex-direction: column;
        height: 100%;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--card-shadow);
        transition: box-shadow 0.12s ease, transform 0.12s ease;
        position: relative;
    }
    .article-card:hover {
        box-shadow: var(--card-shadow-hover);
        transform: translate(3px, 3px);
    }

    .card-thumb {
        aspect-ratio: 16/10;
        border-bottom: 3px solid var(--black);
        overflow: hidden;
        position: relative;
        background: var(--cyan);
    }
    .card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%) contrast(1.1);
        transition: filter 0.3s ease;
        display: block;
    }
    .article-card:hover .card-thumb img {
        filter: grayscale(0%) contrast(1);
    }
    .card-thumb-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--cyan) 0%, #00b8cc 100%);
        font-size: 3rem;
        position: relative;
    }
    .card-thumb-fallback::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            repeating-linear-gradient(0deg, transparent, transparent 10px, rgba(0,0,0,0.05) 10px, rgba(0,0,0,0.05) 11px),
            repeating-linear-gradient(90deg, transparent, transparent 10px, rgba(0,0,0,0.05) 10px, rgba(0,0,0,0.05) 11px);
    }
    .card-number {
        position: absolute;
        top: 0;
        left: 0;
        background: var(--black);
        color: var(--yellow);
        font-family: 'Unbounded', sans-serif;
        font-size: 0.6rem;
        font-weight: 900;
        padding: 0.25rem 0.5rem;
        letter-spacing: 0.05em;
        z-index: 2; /* FIX: pastikan nomor di atas scanline overlay */
    }
    .card-category {
        position: absolute;
        bottom: 0;
        left: 0;
        background: var(--yellow);
        border-top: 3px solid var(--black);
        border-right: 3px solid var(--black);
        font-family: 'Space Mono', monospace;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 0.3rem 0.75rem;
        color: var(--black);
        z-index: 2; /* FIX: pastikan label di atas overlay */
    }
    .card-body {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    .card-title {
        font-family: 'Unbounded', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 1.35;
        color: var(--black);
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .article-card:hover .card-title { color: var(--purple); }

    .card-meta {
        margin-top: auto;
        padding-top: 0.75rem;
        border-top: 2px solid var(--black);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: 'Space Mono', monospace;
        font-size: 0.65rem;
        font-weight: 700;
        color: #555;
        /* FIX: gap agar tidak overlap saat nama author panjang */
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .card-author { display: flex; align-items: center; gap: 0.4rem; }
    .card-author-dot {
        width: 6px; height: 6px;
        background: var(--cyan);
        border: 1.5px solid var(--black);
        display: inline-block;
        flex-shrink: 0;
    }

    /* ── FEATURED CARD (first article) ─── */
    /*
     * FIX: featured card hanya span 2 kolom saat grid memiliki 2+ kolom.
     * Di breakpoint 1 kolom (mobile), featured tetap normal agar tidak overflow.
     */
    .article-card.featured {
        flex-direction: column; /* default: mobile-first */
    }
    @media (min-width: 768px) {
        .article-card.featured {
            flex-direction: row;
            grid-column: span 2;
        }
        .article-card.featured .card-thumb {
            width: 45%;
            aspect-ratio: unset;
            border-bottom: none;
            border-right: 3px solid var(--black);
            flex-shrink: 0;
        }
        .article-card.featured .card-body {
            padding: 2rem;
        }
        .article-card.featured .card-title {
            font-size: 1.4rem;
            -webkit-line-clamp: 4;
        }
    }
    /* FIX: di layar 3 kolom, featured span 2 (bukan 3) sehingga 1 kartu lain bisa di sebelahnya */
    @media (min-width: 1024px) {
        .article-card.featured {
            grid-column: span 2;
        }
    }

    .featured-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: var(--red);
        color: var(--white);
        font-family: 'Space Mono', monospace;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        padding: 0.25rem 0.6rem;
        border: 2px solid var(--black);
        margin-bottom: 0.75rem;
        /* FIX: width fit-content agar badge tidak melebar penuh */
        width: fit-content;
    }
    .featured-badge::before { content: '★'; color: var(--yellow); }

    /* ── EMPTY STATE ─────────────────────── */
    .empty-state {
        background: var(--white);
        border: 3px solid var(--black);
        box-shadow: var(--card-shadow);
        padding: 4rem 2rem;
        text-align: center;
        /* FIX: gunakan grid-column untuk semua ukuran layar */
        grid-column: 1 / -1;
    }
    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        display: block;
    }
    .empty-title {
        font-family: 'Unbounded', sans-serif;
        font-size: 1.75rem;
        font-weight: 900;
        text-transform: uppercase;
        color: var(--black);
        margin-bottom: 0.5rem;
    }
    .empty-sub {
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        color: #555;
    }

    /* ── FLASH MESSAGE ───────────────────── */
    .flash-msg {
        background: #22c55e;
        border: 3px solid var(--black);
        box-shadow: var(--card-shadow);
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-family: 'Space Mono', monospace;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--black);
        /* FIX: justify-content agar tombol dismiss bisa di kanan */
        justify-content: space-between;
    }
    .flash-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .flash-check {
        width: 28px; height: 28px;
        border: 2.5px solid var(--black);
        border-radius: 50%;
        background: var(--white);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
    }
    /* FIX: tombol dismiss flash message */
    .flash-dismiss {
        background: none;
        border: 2px solid var(--black);
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        font-size: 0.75rem;
        font-weight: 900;
        color: var(--black);
        flex-shrink: 0;
        transition: background 0.1s;
    }
    .flash-dismiss:hover { background: rgba(0,0,0,0.1); }

    /* ── PAGINATION ──────────────────────── */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .page-btn {
        width: 42px; height: 42px;
        display: flex; align-items: center; justify-content: center;
        border: 3px solid var(--black);
        background: var(--white);
        font-family: 'Unbounded', sans-serif;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--black);
        text-decoration: none;
        box-shadow: 3px 3px 0 var(--black);
        transition: all 0.1s;
    }
    .page-btn:hover:not(.disabled):not(.active) {
        box-shadow: 1px 1px 0 var(--black);
        transform: translate(2px, 2px);
    }
    .page-btn.active {
        background: var(--black);
        color: var(--yellow);
        box-shadow: none;
        transform: translate(3px, 3px);
    }
    .page-btn.disabled {
        background: #ccc;
        color: #888;
        opacity: 0.5;
        cursor: not-allowed;
        box-shadow: none;
    }
    /* FIX: ellipsis pagination untuk banyak halaman */
    .page-ellipsis {
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        color: rgba(245,240,232,0.5);
        padding: 0 0.25rem;
        line-height: 42px;
    }



    /* ── SECTION HEADING ─────────────────── */
    .section-heading {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .section-heading-line {
        flex: 1;
        height: 3px;
        background: rgba(245,240,232,0.15);
    }
    .section-heading-text {
        font-family: 'Space Mono', monospace;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: rgba(245,240,232,0.45);
    }

    /* ── RESPONSIVE ──────────────────────── */
    @media (max-width: 768px) {
        .stats-bar { flex-direction: column; }
        .stats-item { border-right: none; border-bottom: 3px solid var(--black); }
        .stats-item:last-child { border-bottom: none; }
    }
</style>
@endpush

@section('content')

<div class="page-bg pb-24">
    <div class="max-w-7xl mx-auto px-5 lg:px-14 pt-28">

        {{-- ══════════════════════════════════════
             HERO
        ══════════════════════════════════════ --}}
        <div class="hero-wrap mb-4">

            {{-- FIX: Ticker sekarang berisi konten yang benar --}}
            <div class="ticker-wrap">
                <div class="ticker-track">
                    {{-- Duplikat 2x agar animasi translateX(-50%) loop sempurna --}}
                    <span>Strategi Digital</span><span class="sep">✦</span>
                    <span>Konten Kreatif</span><span class="sep">✦</span>
                    <span>Update Teknologi</span><span class="sep">✦</span>
                    <span>Tips & Trik</span><span class="sep">✦</span>
                    <span>Inspirasi Bisnis</span><span class="sep">✦</span>
                    <span>Strategi Digital</span><span class="sep">✦</span>
                    <span>Konten Kreatif</span><span class="sep">✦</span>
                    <span>Update Teknologi</span><span class="sep">✦</span>
                    <span>Tips & Trik</span><span class="sep">✦</span>
                    <span>Inspirasi Bisnis</span><span class="sep">✦</span>
                </div>
            </div>

            {{-- Inner panel --}}
            <div class="hero-inner scanline-overlay">
                <div class="hero-pixel">••••ᗧ</div>
                <div class="hero-stripe"></div>

                <h1 class="hero-title">
                    BLOG<br>
                    <span class="outline">&amp;</span>
                    <span class="accent"> ARTICLE.</span>
                </h1>

                <p class="hero-desc">
                    Kumpulan strategi digital, inspirasi konten kreatif, dan update terbaru seputar dunia teknologi.
                </p>
            </div>
        </div>

        {{-- Stats bar --}}
        <div class="stats-bar mb-10">
            <div class="stats-item">
                <span class="stats-label">Total Artikel</span>
                <span class="stats-value">{{ $articles->total() }}</span>
            </div>
            <div class="stats-item">
                <span class="stats-label">Kategori</span>
                <span class="stats-value cyan">{{ count($categories) }}</span>
            </div>
            <div class="stats-item">
                <span class="stats-label">Halaman</span>
                <span class="stats-value red">{{ $articles->lastPage() }}</span>
            </div>
        </div>

        {{-- ══════════════════════════════════════
             CONTROL PANEL
        ══════════════════════════════════════ --}}

        <div class="control-panel mb-10">

            {{-- Row 1: Category Filter --}}
            <div class="control-row">
                <div class="control-row-label">
                    <span class="label-icon">▤</span> Filter
                </div>
                <div class="filter-panel">
                    {{--
                        FIX: preserve query param `search` juga saat pindah kategori,
                        agar hasil pencarian tidak hilang saat klik filter
                    --}}
                    <a href="{{ route('articles.index', array_filter(['search' => request('search')])) }}"
                       class="filter-btn {{ !request('category') ? 'active' : '' }}">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('articles.index', array_filter(['category' => $cat, 'search' => request('search')])) }}"
                           class="filter-btn {{ request('category') === $cat ? 'active' : '' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Row 2: Search --}}
            <div class="control-row">
                <div class="control-row-label">
                    <span class="label-icon">◎</span> Cari
                </div>
                {{--
                    FIX: preserve SEMUA query param yang relevan via hidden input,
                    bukan hanya category. Ini agar filter aktif tidak reset saat search.
                --}}
                <form action="{{ route('articles.index') }}" method="GET" style="flex:1; display:flex;">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="search-wrap">
                        <input type="text" name="search"
                               placeholder="Ketik judul atau kata kunci artikel..."
                               value="{{ request('search') }}">
                        <button type="submit" class="search-btn">→ Cari</button>
                    </div>
                </form>
            </div>

        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            {{-- FIX: tambah tombol dismiss dan struktur yang lebih proper --}}
            <div class="flash-msg mb-8" id="flash-msg">
                <div class="flash-left">
                    <span class="flash-check">✓</span>
                    {{ session('success') }}
                </div>
                <button class="flash-dismiss" onclick="document.getElementById('flash-msg').style.display='none'" aria-label="Tutup notifikasi">✕</button>
            </div>
        @endif

        {{-- ══════════════════════════════════════
             ARTICLE GRID
        ══════════════════════════════════════ --}}
        <div class="section-heading">
            <div class="section-heading-line"></div>
            <span class="section-heading-text">// Artikel — Halaman {{ $articles->currentPage() }}</span>
            <div class="section-heading-line"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($articles as $index => $article)

                @php $isFeatured = $index === 0 && $articles->currentPage() === 1 && !request('search') && !request('category'); @endphp

                <a href="{{ route('articles.show', $article->slug) }}"
                   class="article-card {{ $isFeatured ? 'featured' : '' }} group">

                    {{-- Thumbnail --}}
                    <div class="card-thumb">
                        <span class="card-number"># {{ str_pad($articles->firstItem() + $index, 3, '0', STR_PAD_LEFT) }}</span>

                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                 alt="{{ $article->title }}"
                                 loading="lazy">
                            {{-- FIX: tambah loading="lazy" untuk performa --}}
                        @else
                            <div class="card-thumb-fallback">👾</div>
                        @endif

                        <span class="card-category">{{ $article->category }}</span>
                    </div>

                    {{-- Body --}}
                    <div class="card-body">
                        @if($isFeatured)
                            <div class="featured-badge">Featured Post</div>
                        @endif

                        <h2 class="card-title">{{ $article->title }}</h2>

                        <div class="card-meta">
                            <span class="card-author">
                                <span class="card-author-dot"></span>
                                {{-- FIX: null-safe operator untuk antisipasi user dihapus --}}
                                {{ $article->user?->name ?? 'Anonim' }}
                            </span>
                            <span>{{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>

                </a>

            @empty
                <div class="empty-state">
                    <span class="empty-icon">📭</span>
                    <h2 class="empty-title">Data Kosong</h2>
                    <p class="empty-sub">
                        @if(request('search'))
                            Tidak ada artikel yang cocok dengan "<strong>{{ request('search') }}</strong>".
                        @elseif(request('category'))
                            Belum ada artikel di kategori "<strong>{{ request('category') }}</strong>".
                        @else
                            Belum ada artikel yang dipublikasikan.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        {{-- ══════════════════════════════════════
             PAGINATION
             FIX: ganti getUrlRange() dengan logika smart pagination
             agar tidak render ratusan tombol saat halaman banyak
        ══════════════════════════════════════ --}}
        @if($articles->hasPages())
            @php
                $currentPage = $articles->currentPage();
                $lastPage    = $articles->lastPage();

                // Tentukan range halaman yang ditampilkan (selalu maks 5 di tengah)
                $window  = 2;
                $rangeStart = max(1, $currentPage - $window);
                $rangeEnd   = min($lastPage, $currentPage + $window);
            @endphp

            <div class="mt-16 pagination">
                {{-- Tombol Prev --}}
                @if($articles->onFirstPage())
                    <span class="page-btn disabled">‹</span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" class="page-btn" aria-label="Halaman sebelumnya">‹</a>
                @endif

                {{-- Halaman pertama + ellipsis kiri --}}
                @if($rangeStart > 1)
                    <a href="{{ $articles->url(1) }}" class="page-btn">1</a>
                    @if($rangeStart > 2)
                        <span class="page-ellipsis">…</span>
                    @endif
                @endif

                {{-- Range tengah --}}
                @for($page = $rangeStart; $page <= $rangeEnd; $page++)
                    <a href="{{ $articles->url($page) }}"
                       class="page-btn {{ $page === $currentPage ? 'active' : '' }}"
                       aria-label="Halaman {{ $page }}"
                       @if($page === $currentPage) aria-current="page" @endif>
                        {{ $page }}
                    </a>
                @endfor

                {{-- Ellipsis kanan + halaman terakhir --}}
                @if($rangeEnd < $lastPage)
                    @if($rangeEnd < $lastPage - 1)
                        <span class="page-ellipsis">…</span>
                    @endif
                    <a href="{{ $articles->url($lastPage) }}" class="page-btn">{{ $lastPage }}</a>
                @endif

                {{-- Tombol Next --}}
                @if($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" class="page-btn" aria-label="Halaman berikutnya">›</a>
                @else
                    <span class="page-btn disabled">›</span>
                @endif
            </div>
        @endif

    </div>
</div>

@endsection