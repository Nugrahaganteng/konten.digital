{{-- resources/views/articles/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Blog & Artikel — HNP Communications')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<style>
/* ── RESET & ROOT ─────────────────────────── */
:root {
    --blk: #0D0D0D;
    --yel: #FFD000;
    --pur: #3B0764;
    --red: #FF2D55;
    --crm: #FFF9ED;
    --b:   3px solid #0D0D0D;
    --bf:  5px solid #0D0D0D;
    --s1:  3px 3px 0 #0D0D0D;
    --s2:  6px 6px 0 #0D0D0D;
    --sh:  2px 2px 0 #0D0D0D;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { overflow-x: hidden; }
body {
    background: var(--yel);
    font-family: 'Space Mono', monospace;
    color: var(--blk);
    overflow-x: hidden;
    position: relative;
}
body::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
        linear-gradient(rgba(13,13,13,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(13,13,13,.04) 1px, transparent 1px);
    background-size: 36px 36px;
    pointer-events: none;
    z-index: 0;
}
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--yel); }
::-webkit-scrollbar-thumb { background: var(--blk); }

/* ── TICKER ──────────────────────────────── */
.hnp-ticker {
    background: var(--blk);
    border-bottom: var(--b);
    overflow: hidden;
    position: relative;
    z-index: 10;
}
.hnp-ticker-track {
    display: flex;
    white-space: nowrap;
    animation: hnp-tick 26s linear infinite;
    width: max-content;
}
.hnp-ticker-track:hover { animation-play-state: paused; }
@keyframes hnp-tick {
    from { transform: translateX(0); }
    to   { transform: translateX(-50%); }
}
.hnp-ti {
    display: inline-flex;
    align-items: center;
    gap: .7rem;
    padding: 0 1.1rem;
    font-size: .62rem;
    font-weight: 700;
    letter-spacing: .13em;
    text-transform: uppercase;
    color: var(--yel);
    line-height: 2.6rem;
}
.hnp-ti .dot {
    width: 5px; height: 5px;
    background: var(--red);
    border: 1.5px solid var(--yel);
    flex-shrink: 0;
}

/* ── HERO ────────────────────────────────── */
.hnp-hero {
    background: var(--pur);
    border-bottom: var(--bf);
    position: relative;
    overflow: hidden;
    /* space for nav */
    padding-top: 80px;
}
.hnp-hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(255,208,0,.07) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,208,0,.07) 1px, transparent 1px);
    background-size: 44px 44px;
    pointer-events: none;
}
.hnp-hero-inner {
    max-width: 1160px;
    margin: 0 auto;
    padding: 1.75rem 1rem 0;
    position: relative;
    z-index: 1;
}

/* brand pill */
.hnp-pill {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: var(--yel);
    border: var(--b);
    box-shadow: var(--s1);
    padding: .3rem .85rem;
    font-size: .58rem;
    font-weight: 700;
    letter-spacing: .13em;
    text-transform: uppercase;
    color: var(--blk);
    margin-bottom: 1.25rem;
}
.hnp-pill .lb {
    width: 15px; height: 15px;
    background: var(--blk);
    display: flex; align-items: center; justify-content: center;
    color: var(--yel);
    font-weight: 900;
    font-size: .58rem;
    flex-shrink: 0;
}

/* title */
.hnp-htitle {
    font-family: 'Unbounded', sans-serif;
    font-weight: 900;
    line-height: .9;
    text-transform: uppercase;
    margin-bottom: 1.25rem;
}
.hnp-htitle .l1 {
    display: block;
    font-size: clamp(2.4rem, 11vw, 6.5rem);
    color: var(--yel);
}
.hnp-htitle .l2 {
    display: block;
    font-size: clamp(2.4rem, 11vw, 6.5rem);
    color: transparent;
    -webkit-text-stroke: clamp(2px, .4vw, 3px) var(--yel);
}
.hnp-htitle .l3 {
    display: block;
    font-size: clamp(.9rem, 3.2vw, 2rem);
    color: var(--red);
    -webkit-text-stroke: 0;
    margin-top: .4rem;
}

/* desc */
.hnp-desc {
    font-size: .75rem;
    line-height: 1.8;
    color: rgba(255,249,237,.68);
    border-left: 4px solid var(--red);
    padding-left: .8rem;
    margin-bottom: 1.5rem;
    max-width: 40ch;
}
.hnp-desc strong { color: var(--yel); font-weight: 700; }

/* stats — horizontal scroll on mobile */
.hnp-stats {
    display: flex;
    border: var(--b);
    background: var(--yel);
    box-shadow: var(--s2);
    margin-bottom: 1.5rem;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.hnp-stats::-webkit-scrollbar { display: none; }
.hnp-st {
    flex: 0 0 auto;
    padding: .8rem 1.15rem;
    border-right: var(--b);
}
.hnp-st:last-child { border-right: none; }
.hnp-st .n {
    font-family: 'Unbounded', sans-serif;
    font-size: 1.4rem;
    font-weight: 900;
    color: var(--blk);
    display: block;
    line-height: 1;
}
.hnp-st .n.r { color: var(--red); }
.hnp-st .n.p { color: var(--pur); }
.hnp-st .l {
    font-size: .52rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: rgba(0,0,0,.48);
    display: block;
    margin-top: .18rem;
}

/* deco column — only on md+ */
.hnp-hero-grid { display: block; }
.hnp-deco { display: none; }

@media (min-width: 740px) {
    .hnp-hero-grid {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 1.5rem;
        align-items: flex-end;
    }
    .hnp-deco {
        display: flex;
        flex-direction: column;
        gap: .6rem;
        align-items: flex-end;
        padding-bottom: 1.5rem;
        flex-shrink: 0;
    }
}
.hnp-db {
    background: var(--yel);
    border: var(--b);
    box-shadow: var(--s1);
    padding: .45rem .95rem;
    font-family: 'Unbounded', sans-serif;
    font-size: .6rem;
    font-weight: 900;
    text-transform: uppercase;
    color: var(--blk);
    white-space: nowrap;
}
.hnp-db.r  { background: var(--red); color: var(--crm); }
.hnp-db.bk { background: var(--blk); color: var(--yel); }

/* stripe */
.hnp-stripe {
    height: 10px;
    background: repeating-linear-gradient(
        90deg,
        var(--yel) 0, var(--yel) 22px,
        var(--red) 22px, var(--red) 44px,
        var(--blk) 44px, var(--blk) 54px
    );
    border-top: var(--b);
    margin-top: 1.5rem;
}

/* ── PAGE SHELL ──────────────────────────── */
.hnp-shell { position: relative; z-index: 1; }
.hnp-wrap {
    max-width: 1160px;
    margin: 0 auto;
    padding: 1.5rem 1rem 5rem;
}

/* ── CONTROL PANEL ───────────────────────── */
.hnp-ctrl {
    background: var(--crm);
    border: var(--b);
    box-shadow: var(--s2);
    margin-top: 1.75rem;
    margin-bottom: 1.5rem;
}
.hnp-crow {
    display: flex;
    align-items: stretch;
    border-bottom: var(--b);
}
.hnp-crow:last-child { border-bottom: none; }
.hnp-clbl {
    background: var(--blk);
    color: var(--yel);
    font-size: .52rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .13em;
    padding: 0 .75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
    border-right: var(--b);
    flex-shrink: 0;
    min-width: 62px;
}

/* filter buttons */
.hnp-frow {
    display: flex;
    flex: 1;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.hnp-frow::-webkit-scrollbar { display: none; }
.hnp-fbtn {
    font-size: .6rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    padding: .65rem .9rem;
    border: none;
    border-right: 2px solid rgba(0,0,0,.08);
    background: transparent;
    color: rgba(0,0,0,.38);
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    transition: background .1s, color .1s;
    cursor: pointer;
}
.hnp-fbtn:last-child { border-right: none; }
.hnp-fbtn:hover { background: rgba(0,0,0,.04); color: var(--blk); }
.hnp-fbtn.active { background: var(--blk); color: var(--yel); }

/* search */
.hnp-sform { flex: 1; display: flex; min-width: 0; }
.hnp-sinput {
    flex: 1;
    min-width: 0;
    border: none;
    outline: none;
    padding: .7rem .9rem;
    font-family: 'Space Mono', monospace;
    font-size: .72rem;
    background: transparent;
    color: var(--blk);
}
.hnp-sinput::placeholder { color: rgba(0,0,0,.26); }
.hnp-sbtn {
    background: var(--red);
    color: var(--crm);
    border: none;
    border-left: var(--b);
    padding: 0 .9rem;
    font-family: 'Space Mono', monospace;
    font-size: .6rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .09em;
    cursor: pointer;
    white-space: nowrap;
    flex-shrink: 0;
    transition: background .1s;
}
.hnp-sbtn:hover { background: var(--blk); }

/* ── SECTION DIVIDER ─────────────────────── */
.hnp-sdiv {
    display: flex;
    align-items: center;
    gap: .65rem;
    margin: 1.75rem 0 1.15rem;
}
.hnp-sdiv-ln { flex: 1; height: 2px; background: var(--blk); }
.hnp-sdiv-tg {
    background: var(--blk);
    color: var(--yel);
    font-size: .52rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .17em;
    padding: .22rem .7rem;
    white-space: nowrap;
}

/* ── ARTICLE GRID ────────────────────────── */
.hnp-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}
@media (min-width: 540px) {
    .hnp-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (min-width: 960px) {
    .hnp-grid { grid-template-columns: repeat(3, 1fr); }
}

/* card */
.hnp-card {
    background: var(--crm);
    border: var(--b);
    box-shadow: var(--s2);
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    transition: box-shadow .1s, transform .1s;
}
.hnp-card:hover {
    box-shadow: var(--sh);
    transform: translate(4px, 4px);
}

/* thumb */
.hnp-thumb {
    aspect-ratio: 16/9;
    border-bottom: var(--b);
    overflow: hidden;
    position: relative;
    background: var(--pur);
    flex-shrink: 0;
}
.hnp-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    filter: grayscale(100%) contrast(1.1);
    transition: filter .3s;
}
.hnp-card:hover .hnp-thumb img { filter: none; }
.hnp-thumb-fb {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    position: relative; overflow: hidden;
}
.hnp-thumb-fb::before {
    content: 'HNP';
    font-family: 'Unbounded', sans-serif;
    font-size: 2.2rem;
    font-weight: 900;
    color: rgba(255,208,0,.1);
    letter-spacing: .1em;
    position: relative; z-index: 1;
}
.hnp-thumb-fb::after {
    content: '';
    position: absolute; inset: 0;
    background:
        repeating-linear-gradient(0deg, transparent, transparent 9px, rgba(255,208,0,.04) 9px, rgba(255,208,0,.04) 10px),
        repeating-linear-gradient(90deg, transparent, transparent 9px, rgba(255,208,0,.04) 9px, rgba(255,208,0,.04) 10px);
}
.hnp-num {
    position: absolute; top: 0; left: 0; z-index: 2;
    background: var(--yel);
    border-bottom: 2px solid var(--blk);
    border-right: 2px solid var(--blk);
    font-family: 'Unbounded', sans-serif;
    font-size: .48rem;
    font-weight: 900;
    color: var(--blk);
    padding: .18rem .45rem;
}
.hnp-cat {
    position: absolute; bottom: 0; right: 0; z-index: 2;
    background: var(--red);
    border-top: 2px solid var(--blk);
    border-left: 2px solid var(--blk);
    font-size: .52rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    padding: .22rem .55rem;
    color: var(--crm);
    max-width: 60%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* card body */
.hnp-cbody {
    padding: .9rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: .55rem;
}
.hnp-ctitle {
    font-family: 'Unbounded', sans-serif;
    font-size: .78rem;
    font-weight: 700;
    text-transform: uppercase;
    line-height: 1.4;
    color: var(--blk);
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    overflow-wrap: break-word;
    word-break: break-word;
}
.hnp-card:hover .hnp-ctitle { color: var(--pur); }
.hnp-cmeta {
    margin-top: auto;
    padding-top: .55rem;
    border-top: 2px solid var(--blk);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: .52rem;
    font-weight: 700;
    color: rgba(0,0,0,.38);
    gap: .35rem;
    flex-wrap: wrap;
}
.hnp-cauthor {
    display: flex; align-items: center; gap: .3rem;
    color: var(--blk);
    max-width: 55%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.hnp-cdot {
    width: 6px; height: 6px;
    background: var(--red);
    border: 1.5px solid var(--blk);
    flex-shrink: 0;
}

/* FEATURED */
.hnp-card.feat { grid-column: 1 / -1; }

@media (min-width: 540px) {
    .hnp-card.feat { flex-direction: row; }
    .hnp-card.feat .hnp-thumb {
        width: 42%;
        aspect-ratio: unset;
        border-bottom: none;
        border-right: var(--b);
        flex-shrink: 0;
    }
    .hnp-card.feat .hnp-cbody { padding: 1.25rem; }
    .hnp-card.feat .hnp-ctitle {
        font-size: 1rem;
        -webkit-line-clamp: 4;
    }
}
@media (min-width: 960px) {
    .hnp-card.feat .hnp-cbody { padding: 1.85rem; }
    .hnp-card.feat .hnp-ctitle { font-size: 1.25rem; }
}

.hnp-feat-badge {
    display: inline-flex;
    align-items: center;
    gap: .28rem;
    background: var(--red);
    color: var(--crm);
    border: 2px solid var(--blk);
    box-shadow: var(--s1);
    font-size: .52rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .09em;
    padding: .2rem .55rem;
    width: fit-content;
    margin-bottom: .3rem;
}
.hnp-feat-badge::before { content: '★'; color: var(--yel); margin-right: .18rem; }

/* empty */
.hnp-empty {
    grid-column: 1 / -1;
    background: var(--crm);
    border: var(--b);
    box-shadow: var(--s2);
    padding: 3rem 1.25rem;
    text-align: center;
}
.hnp-empty-big {
    font-family: 'Unbounded', sans-serif;
    font-size: 3rem;
    font-weight: 900;
    color: var(--blk);
    opacity: .08;
    margin-bottom: .75rem;
}
.hnp-empty-h {
    font-family: 'Unbounded', sans-serif;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    color: var(--blk);
    margin-bottom: .3rem;
}
.hnp-empty-s {
    font-size: .68rem;
    color: rgba(0,0,0,.42);
    line-height: 1.7;
}

/* ── FLASH ───────────────────────────────── */
.hnp-flash {
    background: #16a34a;
    border: var(--b);
    box-shadow: var(--s2);
    padding: .8rem 1.1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .65rem;
    font-size: .67rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: var(--crm);
    margin-bottom: 1.1rem;
    flex-wrap: wrap;
}
.hnp-flash-l { display: flex; align-items: center; gap: .65rem; flex: 1; }
.hnp-flash-ck {
    width: 22px; height: 22px;
    border: 2px solid var(--crm);
    display: flex; align-items: center; justify-content: center;
    font-size: .65rem; flex-shrink: 0;
}
.hnp-flash-x {
    background: none;
    border: 2px solid var(--crm);
    width: 22px; height: 22px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    font-size: .65rem;
    font-weight: 900;
    color: var(--crm);
    flex-shrink: 0;
    line-height: 1;
}

/* ── PAGINATION ──────────────────────────── */
.hnp-pgn {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: .3rem;
    flex-wrap: wrap;
    padding: 2rem 0 0;
}
.hnp-pb {
    width: 38px; height: 38px;
    display: flex; align-items: center; justify-content: center;
    border: var(--b);
    background: var(--crm);
    font-family: 'Unbounded', sans-serif;
    font-size: .62rem;
    font-weight: 700;
    color: var(--blk);
    text-decoration: none;
    box-shadow: var(--s1);
    transition: all .1s;
    flex-shrink: 0;
}
.hnp-pb:hover:not(.dis):not(.act) {
    box-shadow: var(--sh);
    transform: translate(2px, 2px);
}
.hnp-pb.act {
    background: var(--blk);
    color: var(--yel);
    box-shadow: none;
    transform: translate(3px, 3px);
}
.hnp-pb.dis {
    background: rgba(0,0,0,.06);
    color: rgba(0,0,0,.2);
    box-shadow: none;
    cursor: not-allowed;
}
.hnp-pellip {
    font-size: .68rem;
    color: var(--blk);
    opacity: .32;
    padding: 0 .15rem;
}
</style>
@endpush

@section('content')
<div class="hnp-shell">

    {{-- TICKER --}}
    @php
        $tItems = ['HNP Communications','Strategi PR Digital','Konten Kreatif','Media Partner','Brand Awareness','Social Media','Press Release','Copywriting'];
        $tItems = array_merge($tItems, $tItems);
    @endphp
    <div class="hnp-ticker">
        <div class="hnp-ticker-track">
            @foreach($tItems as $t)
                <span class="hnp-ti"><span class="dot"></span>{{ $t }}</span>
            @endforeach
        </div>
    </div>

    {{-- HERO --}}
    <div class="hnp-hero">
        <div class="hnp-hero-inner">

            <div class="hnp-pill">
                <span class="lb">H</span>
                HNP Communications &nbsp;/&nbsp; Blog &amp; Artikel
            </div>

            <div class="hnp-hero-grid">
                <div>
                    <h1 class="hnp-htitle">
                        <span class="l1">BLOG</span>
                        <span class="l2">&amp; ARTIKEL</span>
                        <span class="l3">Your Strategic PR Partner.</span>
                    </h1>
                    <p class="hnp-desc">
                        Insight <strong>PR &amp; digital</strong> terkini, strategi konten, dan inspirasi kreatif dari tim <strong>HNP Communications</strong>.
                    </p>
                    <div class="hnp-stats">
                        <div class="hnp-st">
                            <span class="n">{{ $articles->total() }}</span>
                            <span class="l">Artikel</span>
                        </div>
                        <div class="hnp-st">
                            <span class="n p">{{ count($categories) }}</span>
                            <span class="l">Kategori</span>
                        </div>
                        <div class="hnp-st">
                            <span class="n r">{{ $articles->lastPage() }}</span>
                            <span class="l">Halaman</span>
                        </div>
                        <div class="hnp-st">
                            <span class="n">5+</span>
                            <span class="l">Tahun</span>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
        <div class="hnp-stripe"></div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="hnp-wrap">

        {{-- Control Panel --}}
        <div class="hnp-ctrl">
            <div class="hnp-crow">
                <div class="hnp-clbl">▤ Filter</div>
                <div class="hnp-frow">
                    <a href="{{ route('articles.index', array_filter(['search' => request('search')])) }}"
                       class="hnp-fbtn {{ !request('category') ? 'active' : '' }}">✦ Semua</a>
                    @foreach($categories as $cat)
                        <a href="{{ route('articles.index', array_filter(['category' => $cat, 'search' => request('search')])) }}"
                           class="hnp-fbtn {{ request('category') === $cat ? 'active' : '' }}">{{ $cat }}</a>
                    @endforeach
                </div>
            </div>
            <div class="hnp-crow">
                <div class="hnp-clbl">◎ Cari</div>
                <form action="{{ route('articles.index') }}" method="GET" class="hnp-sform">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" class="hnp-sinput"
                           placeholder="Cari artikel..." value="{{ request('search') }}">
                    <button type="submit" class="hnp-sbtn">→ Cari</button>
                </form>
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="hnp-flash" id="hnp-flash">
                <div class="hnp-flash-l">
                    <span class="hnp-flash-ck">✓</span>
                    {{ session('success') }}
                </div>
                <button class="hnp-flash-x" onclick="document.getElementById('hnp-flash').style.display='none'">✕</button>
            </div>
        @endif

        {{-- Divider --}}
        <div class="hnp-sdiv">
            <div class="hnp-sdiv-ln"></div>
            <span class="hnp-sdiv-tg">// Artikel — Hal. {{ $articles->currentPage() }}</span>
            <div class="hnp-sdiv-ln"></div>
        </div>

        {{-- Grid --}}
        <div class="hnp-grid">
            @forelse($articles as $index => $article)
                @php
                    $isFeat = $index === 0
                        && $articles->currentPage() === 1
                        && !request('search')
                        && !request('category');
                @endphp
                <a href="{{ route('articles.show', $article->slug) }}"
                   class="hnp-card {{ $isFeat ? 'feat' : '' }}">

                    <div class="hnp-thumb">
                        <span class="hnp-num">#{{ str_pad($articles->firstItem() + $index, 3, '0', STR_PAD_LEFT) }}</span>
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                 alt="{{ $article->title }}" loading="lazy">
                        @else
                            <div class="hnp-thumb-fb"></div>
                        @endif
                        <span class="hnp-cat">{{ $article->category }}</span>
                    </div>

                    <div class="hnp-cbody">
                        @if($isFeat)
                            <div class="hnp-feat-badge">Artikel Utama</div>
                        @endif
                        <h2 class="hnp-ctitle">{{ $article->title }}</h2>
                        <div class="hnp-cmeta">
                            <span class="hnp-cauthor">
                                <span class="hnp-cdot"></span>
                                {{ $article->user?->name ?? 'HNP Team' }}
                            </span>
                            <span>{{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="hnp-empty">
                    <div class="hnp-empty-big">HNP</div>
                    <h2 class="hnp-empty-h">Belum Ada Artikel</h2>
                    <p class="hnp-empty-s">
                        @if(request('search'))
                            Tidak ada hasil untuk "<strong>{{ request('search') }}</strong>".
                        @elseif(request('category'))
                            Belum ada artikel di kategori "<strong>{{ request('category') }}</strong>".
                        @else
                            Belum ada artikel yang dipublikasikan.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($articles->hasPages())
            @php
                $cp = $articles->currentPage();
                $lp = $articles->lastPage();
                $rs = max(1, $cp - 2);
                $re = min($lp, $cp + 2);
            @endphp
            <div class="hnp-pgn">
                @if($articles->onFirstPage())
                    <span class="hnp-pb dis">‹</span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" class="hnp-pb">‹</a>
                @endif

                @if($rs > 1)
                    <a href="{{ $articles->url(1) }}" class="hnp-pb">1</a>
                    @if($rs > 2)<span class="hnp-pellip">…</span>@endif
                @endif

                @for($pg = $rs; $pg <= $re; $pg++)
                    <a href="{{ $articles->url($pg) }}"
                       class="hnp-pb {{ $pg === $cp ? 'act' : '' }}"
                       @if($pg === $cp) aria-current="page" @endif>{{ $pg }}</a>
                @endfor

                @if($re < $lp)
                    @if($re < $lp - 1)<span class="hnp-pellip">…</span>@endif
                    <a href="{{ $articles->url($lp) }}" class="hnp-pb">{{ $lp }}</a>
                @endif

                @if($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" class="hnp-pb">›</a>
                @else
                    <span class="hnp-pb dis">›</span>
                @endif
            </div>
        @endif

    </div>{{-- /wrap --}}
</div>{{-- /shell --}}
@endsection