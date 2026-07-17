{{-- resources/views/articles/show.blade.php --}}
@extends('layouts.app')
@section('title', $article->title . ' — HNP Communications')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
    /* ══════════════════════════════════════
        RESET & BASE
    ══════════════════════════════════════ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --hnp-black:  #0D0D0D;
        --hnp-yellow: #FFD000;
        --hnp-purple: #3B0764;
        --hnp-red:    #FF2D55;
        --hnp-cream:  #FFF9ED;
        --border:     3px solid var(--hnp-black);
        --border-fat: 5px solid var(--hnp-black);
        --sh-sm:      3px 3px 0 var(--hnp-black);
        --sh-md:      5px 5px 0 var(--hnp-black);
        --sh-lg:      8px 8px 0 var(--hnp-black);
    }

    /* Override body dari app.css supaya background tetap kuning */
    body {
        background-color: var(--hnp-yellow) !important;
        background-image:
            linear-gradient(rgba(13,13,13,.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(13,13,13,.05) 1px, transparent 1px) !important;
        background-size: 32px 32px !important;
        background-attachment: fixed !important;
        font-family: 'Space Mono', monospace !important;
        color: var(--hnp-black) !important;
        overflow-x: hidden !important;
    }

    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--hnp-yellow); }
    ::-webkit-scrollbar-thumb { background: var(--hnp-black); border-radius: 0; }

    /* ══════════════════════════════════════
        TICKER
    ══════════════════════════════════════ */
    .ticker-outer {
        background: var(--hnp-black);
        border-bottom: var(--border);
        overflow: hidden;
        width: 100%;
        position: relative;
    }
    .ticker-track {
        display: flex;
        white-space: nowrap;
        animation: tickAnim 24s linear infinite;
        width: max-content;
    }
    .ticker-track:hover { animation-play-state: paused; }
    .ticker-item {
        display: inline-flex;
        align-items: center;
        gap: .75rem;
        padding: 0 1.25rem;
        height: 2.5rem;
        font-size: .6rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--hnp-yellow);
    }
    .ticker-dot {
        width: 5px; height: 5px;
        background: var(--hnp-red);
        border: 1.5px solid var(--hnp-yellow);
        flex-shrink: 0;
    }
    @keyframes tickAnim {
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
    }

    /* ══════════════════════════════════════
        HERO
    ══════════════════════════════════════ */
    .show-hero {
        background: var(--hnp-purple);
        border-bottom: var(--border-fat);
        position: relative;
        overflow: hidden;
    }
    .show-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,208,0,.06) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,208,0,.06) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }

    .hero-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem 1rem 1.5rem;
        position: relative;
        z-index: 1;
    }
    @media (min-width: 640px)  { .hero-inner { padding: 2.5rem 1.5rem 2rem; } }
    @media (min-width: 1024px) { .hero-inner { padding: 4rem 2rem 2.5rem; } }

    /* Breadcrumb */
    .breadcrumb {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: 1rem;
    }
    .breadcrumb a {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .1em;
        color: var(--hnp-yellow);
        text-decoration: none;
        border: 2px solid rgba(255,208,0,.3);
        padding: .3rem .75rem;
        transition: background .15s, border-color .15s;
    }
    .breadcrumb a:hover {
        background: rgba(255,208,0,.1);
        border-color: var(--hnp-yellow);
    }

    /* Category badge */
    .cat-badge {
        display: inline-block;
        background: var(--hnp-red);
        color: var(--hnp-cream);
        border: var(--border);
        box-shadow: var(--sh-sm);
        font-size: .58rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .15em;
        padding: .3rem .8rem;
        margin-bottom: .85rem;
        /* Pastikan badge tidak overflow */
        max-width: 100%;
        word-break: break-all;
    }

    /* Hero title — PERBAIKAN UTAMA MOBILE */
    .hero-title {
        font-family: 'Unbounded', sans-serif;
        font-weight: 900;
        /* clamp: min 1.1rem, ideal 5vw, max 3.5rem */
        font-size: clamp(1.1rem, 5vw, 3.5rem);
        line-height: 1.2;
        text-transform: uppercase;
        color: var(--hnp-yellow);
        margin-bottom: 1.25rem;
        /* Cegah overflow horizontal di mobile */
        overflow-wrap: break-word;
        word-break: break-word;
        hyphens: auto;
        max-width: 100%;
    }
    @media (min-width: 768px) {
        .hero-title { max-width: 820px; }
    }

    /* Author strip */
    .hero-author {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: 1rem 0 1.25rem;
        border-top: 2px solid rgba(255,208,0,.15);
        flex-wrap: wrap;
    }
    .author-avatar {
        width: 36px; height: 36px;
        background: var(--hnp-yellow);
        border: var(--border);
        flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Unbounded', sans-serif;
        font-size: .8rem;
        font-weight: 900;
        color: var(--hnp-black);
    }
    .author-name {
        font-size: .65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--hnp-cream);
    }
    .author-date {
        font-size: .58rem;
        color: rgba(255,249,237,.45);
        margin-top: .12rem;
    }

    /* Hero stripe */
    .hero-stripe {
        height: 10px;
        background: repeating-linear-gradient(
            90deg,
            var(--hnp-yellow) 0, var(--hnp-yellow) 20px,
            var(--hnp-red)    20px, var(--hnp-red)    40px,
            var(--hnp-black)  40px, var(--hnp-black)  50px
        );
        border-top: var(--border);
    }

    /* ══════════════════════════════════════
        PAGE WRAPPER & GRID
    ══════════════════════════════════════ */
    .page-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        /* Padding kecil di mobile, besar di desktop */
        padding: 1rem .75rem 3rem;
        /* Cegah overflow */
        overflow-x: hidden;
    }
    @media (min-width: 640px)  { .page-wrapper { padding: 1.5rem 1rem 4rem; } }
    @media (min-width: 1024px) { .page-wrapper { padding: 2rem 1.5rem 5rem; } }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
        align-items: start;
        /* Kunci: cegah kolom melebihi lebar container */
        min-width: 0;
    }
    @media (min-width: 1024px) {
        .main-grid {
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 1.5rem;
        }
    }

    /* ══════════════════════════════════════
        ARTICLE CARD
    ══════════════════════════════════════ */
    .article-card {
        background: var(--hnp-cream);
        border: var(--border);
        box-shadow: var(--sh-sm);
        overflow: hidden;
        /* Kunci: cegah konten meluap */
        min-width: 0;
        width: 100%;
    }
    @media (min-width: 640px)  { .article-card { box-shadow: var(--sh-md); } }
    @media (min-width: 1024px) { .article-card { box-shadow: var(--sh-lg); } }

    /* Featured image — DIPERBAIKI */
    .feat-img-wrap {
        border-bottom: var(--border);
        background: var(--hnp-purple);
        position: relative;
        overflow: hidden;
        width: 100%;
    }
    .feat-img-wrap img {
        width: 100%;
        height: auto;
        /* Mobile: tinggi proporsional, tidak terlalu pendek */
        max-height: 200px;
        object-fit: cover;
        display: block;
    }
    @media (min-width: 480px)  { .feat-img-wrap img { max-height: 280px; } }
    @media (min-width: 768px)  { .feat-img-wrap img { max-height: 400px; } }
    @media (min-width: 1024px) { .feat-img-wrap img { max-height: 500px; } }

    .feat-fallback {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--hnp-purple);
        position: relative;
        overflow: hidden;
        width: 100%;
    }
    @media (min-width: 480px)  { .feat-fallback { height: 200px; } }
    @media (min-width: 768px)  { .feat-fallback { height: 280px; } }
    .feat-fallback::before {
        content: 'HNP';
        font-family: 'Unbounded', sans-serif;
        font-size: clamp(2rem, 8vw, 5rem);
        font-weight: 900;
        color: rgba(255,208,0,.08);
        letter-spacing: .1em;
    }
    .feat-fallback::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            repeating-linear-gradient(0deg, transparent, transparent 10px, rgba(255,208,0,.03) 10px, rgba(255,208,0,.03) 11px),
            repeating-linear-gradient(90deg, transparent, transparent 10px, rgba(255,208,0,.03) 10px, rgba(255,208,0,.03) 11px);
    }

    .feat-label {
        position: absolute;
        bottom: 0; left: 0;
        background: var(--hnp-yellow);
        border-top: var(--border);
        border-right: var(--border);
        font-size: .52rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--hnp-black);
        padding: .25rem .55rem;
        max-width: calc(100% - .5rem);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Article body padding — DIPERBAIKI untuk mobile */
    .article-body-wrap {
        padding: 1rem;
        /* Cegah konten meluap */
        overflow-x: hidden;
        min-width: 0;
    }
    @media (min-width: 480px)  { .article-body-wrap { padding: 1.25rem; } }
    @media (min-width: 768px)  { .article-body-wrap { padding: 2rem; } }
    @media (min-width: 1024px) { .article-body-wrap { padding: 2.5rem; } }

    /* Draft notice */
    .notice-draft {
        background: #fff4cc;
        border: var(--border);
        box-shadow: var(--sh-sm);
        padding: .65rem .85rem;
        display: flex;
        align-items: flex-start;
        gap: .5rem;
        font-size: .6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #7a5800;
        margin-bottom: 1rem;
        word-break: break-word;
    }
    @media (min-width: 768px) { .notice-draft { margin-bottom: 1.5rem; } }
    .notice-icon { font-size: .95rem; flex-shrink: 0; line-height: 1.4; }

    /* Excerpt */
    .excerpt-box {
        background: var(--hnp-purple);
        border: var(--border);
        box-shadow: var(--sh-sm);
        padding: .85rem .85rem .85rem 1rem;
        margin-bottom: 1.25rem;
        position: relative;
        overflow: hidden;
    }
    @media (min-width: 768px) { .excerpt-box { padding: 1.25rem; margin-bottom: 1.75rem; } }
    .excerpt-box::before {
        content: '"';
        position: absolute;
        top: -.5rem; left: .3rem;
        font-family: 'Unbounded', sans-serif;
        font-size: clamp(2.5rem, 7vw, 5rem);
        font-weight: 900;
        color: rgba(255,208,0,.1);
        line-height: 1;
        pointer-events: none;
    }
    .excerpt-text {
        font-size: .75rem;
        font-weight: 700;
        line-height: 1.8;
        color: var(--hnp-cream);
        overflow-wrap: break-word;
        word-break: break-word;
        position: relative;
        z-index: 1;
    }
    @media (min-width: 768px) { .excerpt-text { font-size: .85rem; } }

    /* Section label */
    .sec-label {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: 1rem;
        min-width: 0;
    }
    @media (min-width: 768px) { .sec-label { gap: .65rem; margin-bottom: 1.25rem; } }
    .sec-label-tag {
        background: var(--hnp-black);
        color: var(--hnp-yellow);
        font-size: .5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        padding: .2rem .5rem;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .sec-label-line { flex: 1; height: 2px; background: var(--hnp-black); min-width: 0; }

    /* ══════════════════════════════════════
        ARTICLE BODY TYPOGRAPHY — KUNCI RESPONSIF
    ══════════════════════════════════════ */
    .article-body {
        font-size: .78rem;
        line-height: 1.9;
        color: #1a1a1a;
        /* INI KUNCI: cegah teks/gambar meluap */
        overflow-wrap: break-word;
        word-break: break-word;
        overflow-x: hidden;
        min-width: 0;
        max-width: 100%;
    }
    @media (min-width: 768px) { .article-body { font-size: .85rem; line-height: 2.0; } }

    .article-body h1,
    .article-body h2,
    .article-body h3,
    .article-body h4 {
        font-family: 'Unbounded', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--hnp-black);
        margin: 1.5rem 0 .75rem;
        line-height: 1.25;
        overflow-wrap: break-word;
        word-break: break-word;
        hyphens: auto;
    }
    .article-body h1 { font-size: clamp(.95rem, 3vw, 1.4rem); }
    .article-body h2 {
        font-size: clamp(.88rem, 2.5vw, 1.2rem);
        border-left: 4px solid var(--hnp-red);
        padding-left: .6rem;
    }
    .article-body h3 {
        font-size: clamp(.8rem, 2vw, 1rem);
        border-left: 4px solid var(--hnp-yellow);
        padding-left: .6rem;
    }
    .article-body h4 { font-size: clamp(.75rem, 1.8vw, .9rem); }

    .article-body p  { margin-bottom: 1rem; }
    .article-body ul,
    .article-body ol { padding-left: 1.1rem; margin-bottom: 1rem; }
    .article-body li { margin-bottom: .4rem; }
    .article-body blockquote {
        border-left: 4px solid var(--hnp-yellow);
        background: rgba(255,208,0,.08);
        padding: .75rem .9rem;
        margin: 1.25rem 0;
        font-style: italic;
        overflow-wrap: break-word;
        word-break: break-word;
    }
    .article-body a {
        color: var(--hnp-purple);
        font-weight: 700;
        text-decoration: underline;
        text-underline-offset: 3px;
        /* Cegah link panjang meluap */
        word-break: break-all;
    }
    .article-body a:hover { color: var(--hnp-red); }
    /* PENTING: gambar di dalam konten harus responsive */
    .article-body img {
        max-width: 100%;
        width: auto;
        height: auto;
        border: var(--border);
        box-shadow: var(--sh-sm);
        margin: 1.1rem 0;
        display: block;
    }
    .article-body strong { font-weight: 700; color: var(--hnp-black); }
    .article-body code {
        background: rgba(0,0,0,.07);
        padding: .1em .35em;
        border: 1px solid rgba(0,0,0,.12);
        font-size: .82em;
        /* Cegah code inline meluap */
        word-break: break-all;
        overflow-wrap: break-word;
        font-family: 'Space Mono', monospace;
    }
    .article-body pre {
        background: var(--hnp-black);
        color: var(--hnp-yellow);
        padding: .85rem;
        /* Scroll horizontal hanya di blok code */
        overflow-x: auto;
        margin: 1.1rem 0;
        border: var(--border);
        font-size: .7rem;
        /* Cegah pre meluap dari card */
        max-width: 100%;
    }
    /* Table responsif */
    .article-body table {
        width: 100%;
        border-collapse: collapse;
        font-size: .72rem;
        margin: 1rem 0;
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .article-body th,
    .article-body td {
        border: 2px solid var(--hnp-black);
        padding: .4rem .6rem;
        text-align: left;
        white-space: nowrap;
    }
    .article-body th {
        background: var(--hnp-black);
        color: var(--hnp-yellow);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    /* ══ ARTICLE FOOTER ══ */
    .article-footer {
        margin-top: 1.5rem;
        padding-top: 1.25rem;
        border-top: var(--border);
    }
    @media (min-width: 768px) { .article-footer { margin-top: 2.25rem; padding-top: 1.75rem; } }

    .footer-top {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }
    .footer-author-box {
        width: 40px; height: 40px;
        background: var(--hnp-yellow);
        border: var(--border);
        box-shadow: var(--sh-sm);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Unbounded', sans-serif;
        font-size: .85rem;
        font-weight: 900;
        color: var(--hnp-black);
        flex-shrink: 0;
    }
    .footer-author-name {
        font-size: .65rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    .footer-author-since {
        font-size: .55rem;
        color: rgba(0,0,0,.4);
        margin-top: .12rem;
    }

    /* Action buttons — responsif mobile */
    .footer-actions {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }
    .footer-actions form { display: contents; }

    .btn-brutal {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .3rem;
        /* Mobile: padding lebih kecil */
        padding: .55rem .8rem;
        font-family: 'Space Mono', monospace;
        font-size: .58rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        text-decoration: none;
        border: var(--border);
        box-shadow: var(--sh-sm);
        cursor: pointer;
        transition: box-shadow .1s, transform .1s;
        background: none;
        white-space: nowrap;
        line-height: 1;
        /* Minimum touch target */
        min-height: 36px;
    }
    @media (min-width: 480px) {
        .btn-brutal { padding: .6rem 1rem; font-size: .6rem; letter-spacing: .07em; }
    }
    .btn-brutal:hover  { box-shadow: 2px 2px 0 var(--hnp-black); transform: translate(2px,2px); }
    .btn-brutal:active { box-shadow: none; transform: translate(3px,3px); }
    .btn-yellow { background: var(--hnp-yellow); color: var(--hnp-black); }
    .btn-red    { background: var(--hnp-red);    color: var(--hnp-cream); }
    .btn-black  { background: var(--hnp-black);  color: var(--hnp-yellow); }

    /* ══════════════════════════════════════
        SIDEBAR
    ══════════════════════════════════════ */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        min-width: 0;
    }
    @media (min-width: 1024px) {
        .sidebar { position: sticky; top: 5.5rem; }
    }

    .sidebar-widget {
        background: var(--hnp-cream);
        border: var(--border);
        box-shadow: var(--sh-sm);
        overflow: hidden;
        min-width: 0;
        width: 100%;
    }
    @media (min-width: 768px) { .sidebar-widget { box-shadow: var(--sh-md); } }

    .widget-header {
        background: var(--hnp-black);
        color: var(--hnp-yellow);
        font-size: .56rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .18em;
        padding: .5rem .85rem;
        display: flex;
        align-items: center;
        gap: .5rem;
        border-bottom: var(--border);
    }
    .widget-body { padding: .75rem .85rem; }
    @media (min-width: 768px) { .widget-body { padding: 1rem 1.1rem; } }

    /* Related articles — responsif */
    .related-item {
        display: grid;
        grid-template-columns: 56px 1fr;
        gap: .55rem;
        text-decoration: none;
        color: inherit;
        padding-bottom: .65rem;
        margin-bottom: .65rem;
        border-bottom: 2px solid rgba(0,0,0,.07);
        transition: transform .12s;
        min-width: 0;
        overflow: hidden;
    }
    .related-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    .related-item:hover { transform: translateX(3px); }

    .rel-thumb {
        width: 56px; height: 56px;
        object-fit: cover;
        border: 2px solid var(--hnp-black);
        display: block;
        flex-shrink: 0;
    }
    .rel-thumb-fallback {
        width: 56px; height: 56px;
        background: var(--hnp-purple);
        border: 2px solid var(--hnp-black);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Unbounded', sans-serif;
        font-size: .45rem;
        font-weight: 900;
        color: rgba(255,208,0,.4);
        flex-shrink: 0;
    }
    .rel-title {
        font-size: .62rem;
        font-weight: 700;
        line-height: 1.4;
        color: var(--hnp-black);
        margin-bottom: .2rem;
        /* Kunci: cegah teks meluap */
        overflow-wrap: break-word;
        word-break: break-word;
        min-width: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .related-item:hover .rel-title { color: var(--hnp-purple); }
    .rel-date {
        font-size: .53rem;
        color: rgba(0,0,0,.4);
        font-weight: 700;
    }

    /* Brand widget */
    .brand-widget {
        background: var(--hnp-purple);
        border: var(--border);
        box-shadow: var(--sh-sm);
        padding: 1.1rem .85rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    @media (min-width: 768px) { .brand-widget { box-shadow: var(--sh-md); padding: 1.35rem 1.1rem; } }
    .brand-widget::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,208,0,.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,208,0,.05) 1px, transparent 1px);
        background-size: 24px 24px;
        pointer-events: none;
    }
    .brand-logo {
        font-family: 'Unbounded', sans-serif;
        font-size: clamp(.75rem, 2vw, 1rem);
        font-weight: 900;
        color: var(--hnp-yellow);
        text-transform: uppercase;
        letter-spacing: .03em;
        margin-bottom: .35rem;
        position: relative;
        line-height: 1.2;
    }
    .brand-sub {
        font-size: .52rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: rgba(255,249,237,.45);
        margin-bottom: .75rem;
        position: relative;
    }
    .brand-badge {
        display: inline-block;
        background: var(--hnp-yellow);
        border: var(--border);
        box-shadow: var(--sh-sm);
        font-family: 'Unbounded', sans-serif;
        font-size: .55rem;
        font-weight: 900;
        text-transform: uppercase;
        color: var(--hnp-black);
        padding: .3rem .65rem;
        position: relative;
    }

    /* ══════════════════════════════════════
        SIDEBAR DI MOBILE: tampil horizontal scroll
        supaya tidak terlalu panjang
    ══════════════════════════════════════ */
    @media (max-width: 1023px) {
        /* Di mobile, sidebar widgets tampil dalam 1 kolom normal */
        .sidebar { gap: 1rem; }
        /* Brand widget lebih compact di mobile */
        .brand-widget { padding: .85rem .75rem; }
    }
</style>
@endpush

@section('content')

<article>

    {{-- ══ TICKER ══ --}}
    @php
        $tickerItems = ['HNP Communications','Strategi PR Digital','Konten Kreatif','Media Partner','Brand Awareness','Social Media','Press Release','Copywriting'];
        $tickerDouble = array_merge($tickerItems, $tickerItems);
    @endphp
    <div class="ticker-outer">
        <div class="ticker-track">
            @foreach($tickerDouble as $t)
                <span class="ticker-item"><span class="ticker-dot"></span>{{ $t }}</span>
            @endforeach
        </div>
    </div>

    {{-- ══ HERO ══ --}}
    <header class="show-hero">
        <div class="hero-inner">

            <nav class="breadcrumb">
                <a href="{{ route('articles.index') }}">← Kembali ke Blog</a>
            </nav>

            <div class="cat-badge">{{ $article->category }}</div>

            <h1 class="hero-title">{{ $article->title }}</h1>

            <div class="hero-author">
                <div class="author-avatar">
                    {{ strtoupper(substr($article->user->name ?? 'H', 0, 1)) }}
                </div>
                <div>
                    <div class="author-name">{{ $article->user->name ?? 'HNP Team' }}</div>
                    <div class="author-date">
                        {{ $article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-stripe"></div>
    </header>

    {{-- ══ PAGE CONTENT ══ --}}
    <div class="page-wrapper">
        <div class="main-grid">

            {{-- ── MAIN COLUMN ── --}}
            <div style="min-width:0;">
                <div class="article-card">

                    {{-- Featured Image --}}
                    <div class="feat-img-wrap">
                        @if($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                 alt="{{ $article->title }}"
                                 loading="lazy">
                        @else
                            <div class="feat-fallback"></div>
                        @endif
                        <div class="feat-label">HNP Communications — {{ $article->category }}</div>
                    </div>

                    <div class="article-body-wrap">

                        {{-- Draft notice --}}
                        @auth
                            @if($article->status === 'draft' && (auth()->id() === $article->user_id || auth()->user()->isAdmin()))
                                <div class="notice-draft">
                                    <span class="notice-icon">⏳</span>
                                    <div>Artikel ini sedang dalam peninjauan moderator.</div>
                                </div>
                            @endif
                        @endauth

                        {{-- Excerpt --}}
                        @if($article->excerpt)
                            <div class="excerpt-box">
                                <p class="excerpt-text">{{ $article->excerpt }}</p>
                            </div>
                        @endif

                        {{-- Section label --}}
                        <div class="sec-label">
                            <span class="sec-label-tag">// Isi Artikel</span>
                            <div class="sec-label-line"></div>
                        </div>

                        {{-- Body --}}
                        <div class="article-body">
                            {!! nl2br(e($article->content)) !!}
                        </div>

                        {{-- Footer --}}
                        <div class="article-footer">
                            <div class="footer-top">
                                <div class="footer-author-box">
                                    {{ strtoupper(substr($article->user->name ?? 'H', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="footer-author-name">{{ $article->user->name ?? 'HNP Team' }}</div>
                                    <div class="footer-author-since">
                                        Member sejak {{ $article->user->created_at->format('Y') }}
                                    </div>
                                </div>
                            </div>

                            <div class="footer-actions">
                                @auth
                                    @can('update', $article)
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                           class="btn-brutal btn-yellow">✎ Edit</a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                              onsubmit="return confirm('Hapus artikel ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-brutal btn-red">✕ Hapus</button>
                                        </form>
                                    @endcan
                                @endauth
                                <a href="{{ route('articles.index') }}" class="btn-brutal btn-black">← Blog</a>
                            </div>
                        </div>

                    </div>{{-- /article-body-wrap --}}
                </div>{{-- /article-card --}}
            </div>{{-- /main col --}}

            {{-- ── SIDEBAR ── --}}
            <aside style="min-width:0;">
                <div class="sidebar">

                    {{-- Brand widget --}}
                    <div class="brand-widget">
                        <div class="brand-logo">HNP Communications</div>
                        <div class="brand-sub">Your Strategic PR &amp; Digital Partner</div>
                        <span class="brand-badge">200+ Media Partner</span>
                    </div>

                    {{-- Related articles --}}
                    @if($related->count() > 0)
                    <div class="sidebar-widget">
                        <div class="widget-header">▤ Baca Juga</div>
                        <div class="widget-body">
                            @foreach($related as $rel)
                                <a href="{{ route('articles.show', $rel->slug) }}" class="related-item">
                                    @if($rel->thumbnail)
                                        <img src="{{ asset('storage/' . $rel->thumbnail) }}"
                                             class="rel-thumb"
                                             alt="{{ $rel->title }}"
                                             loading="lazy">
                                    @else
                                        <div class="rel-thumb-fallback">HNP</div>
                                    @endif
                                    <div style="min-width:0; overflow:hidden;">
                                        <div class="rel-title">{{ $rel->title }}</div>
                                        <div class="rel-date">{{ $rel->created_at->translatedFormat('d M Y') }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- CTA widget --}}
                    <div class="sidebar-widget">
                        <div class="widget-header">◎ Tentang Kami</div>
                        <div class="widget-body">
                            <p style="font-size:.68rem;line-height:1.85;color:rgba(0,0,0,.65);overflow-wrap:break-word;">
                                HNP Communications adalah agensi PR &amp; digital yang membantu brand tampil lebih berkesan di media dan dunia digital.
                            </p>
                        </div>
                    </div>

                </div>
            </aside>

        </div>{{-- /main-grid --}}
    </div>{{-- /page-wrapper --}}

</article>

{{-- ── Article Structured Data (JSON-LD) ────────────────────── --}}
@push('scripts')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $article->title,
    'description' => $seoDescription,
    'image' => $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('images/og-blog.jpg'),
    'author' => [
        '@type' => 'Person',
        'name' => $article->user->name ?? 'HNP Team',
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'HNP Communications',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('favicons/android-chrome-512x512.png'),
            'width' => 512,
            'height' => 512,
        ],
    ],
    'datePublished' => ($article->published_at ?? $article->created_at)->toIso8601String(),
    'dateModified' => $article->updated_at->toIso8601String(),
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => url()->current(),
    ],
    'articleSection' => $article->category,
    'inLanguage' => 'id-ID',
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Blog',
            'item' => route('articles.index'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $article->title,
            'item' => url()->current(),
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@endsection