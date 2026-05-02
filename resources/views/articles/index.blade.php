@extends('layouts.app')
@section('title', 'Artikel')

@section('content')

{{-- Header --}}
<div class="bg-ink text-cream py-14">
    <div class="max-w-6xl mx-auto px-6">
        <p class="text-accent text-xs font-semibold tracking-widest uppercase mb-3">Semua Tulisan</p>
        <h1 class="font-display text-5xl font-black mb-4">Artikel</h1>
        <p class="text-cream/50 text-lg">Temukan artikel menarik dari berbagai penulis.</p>
    </div>
</div>

<div class="max-w-6xl mx-auto px-6 py-12">

    {{-- Filter & Search --}}
    <form method="GET" action="{{ route('articles.index') }}" class="flex flex-col sm:flex-row gap-4 mb-10">
        <div class="relative flex-1">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari artikel..."
                   class="w-full pl-11 pr-4 py-3 border border-ink/15 rounded-xl bg-white text-ink placeholder-muted focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/20 transition-all">
        </div>
        <select name="category" onchange="this.form.submit()"
                class="px-4 py-3 border border-ink/15 rounded-xl bg-white text-ink focus:outline-none focus:border-accent transition-all min-w-[160px]">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        @if(request('search') || request('category'))
            <a href="{{ route('articles.index') }}"
               class="px-4 py-3 border border-ink/15 rounded-xl bg-white text-muted hover:text-ink transition-colors text-sm font-medium">
                Reset
            </a>
        @endif
    </form>

    {{-- Results --}}
    @if($articles->isEmpty())
        <div class="text-center py-24">
            <p class="text-5xl mb-4">🔍</p>
            <p class="font-display text-2xl text-ink mb-2">Artikel tidak ditemukan</p>
            <p class="text-muted">Coba kata kunci atau kategori lain.</p>
        </div>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $articles->withQueryString()->links() }}
        </div>
    @endif
</div>

{{-- resources/views/articles/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Artikel & Blog')

@push('styles')
<style>
    :root{--ink:#0e0b14;--yellow:#f5c518;--purple:#2d1b4e;--punch:#e8402a;--cream:#f7f2e8;--blue:#3b5bdb;}

    .articles-hero{background:var(--blue);padding:9rem 4rem 5rem;border-bottom:5px solid var(--ink);overflow:hidden;position:relative;}
    .articles-hero::after{content:'ARTICLE';position:absolute;right:-1rem;top:50%;transform:translateY(-50%);font-family:'Anton',sans-serif;font-size:12rem;color:rgba(255,255,255,0.04);pointer-events:none;line-height:1;}
    .hero-tag{display:inline-block;background:var(--yellow);color:var(--purple);font-family:'Anton',sans-serif;font-size:0.75rem;letter-spacing:0.15em;padding:0.35rem 1rem;border:2.5px solid var(--ink);margin-bottom:1rem;}
    .hero-title{font-family:'Anton',sans-serif;font-size:clamp(3.5rem,7vw,6rem);color:var(--yellow);line-height:0.9;letter-spacing:-0.01em;margin-bottom:1rem;}
    .hero-sub{color:rgba(255,255,255,0.65);font-size:1rem;font-weight:600;max-width:480px;}

    /* Filter bar */
    .filter-bar{background:var(--ink);border-bottom:4px solid var(--yellow);padding:0 4rem;display:flex;align-items:center;overflow-x:auto;}
    .filter-tag{font-family:'Anton',sans-serif;font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;padding:1rem 1.5rem;color:rgba(255,255,255,0.4);border:none;background:transparent;border-right:1px solid rgba(255,255,255,0.08);white-space:nowrap;text-decoration:none;transition:color 0.2s,background 0.2s;}
    .filter-tag:hover,.filter-tag.active{background:var(--yellow);color:var(--purple);}

    /* Search */
    .search-section{background:var(--blue);padding:1.5rem 4rem;border-bottom:4px solid var(--ink);}
    .search-form{max-width:600px;display:flex;border:3px solid var(--ink);overflow:hidden;}
    .search-input{flex:1;padding:0.75rem 1.25rem;font-family:'DM Sans',sans-serif;font-weight:700;font-size:0.95rem;border:none;outline:none;background:white;}
    .search-submit{background:var(--yellow);color:var(--ink);font-family:'Anton',sans-serif;font-size:0.85rem;letter-spacing:0.1em;padding:0 1.5rem;border:none;border-left:3px solid var(--ink);cursor:pointer;transition:background 0.15s;}
    .search-submit:hover{background:var(--punch);color:white;}

    /* Grid */
    .articles-section{background:var(--blue);padding:4rem;min-height:60vh;}
    .articles-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-bottom:3rem;}
    @media(max-width:1000px){.articles-grid{grid-template-columns:repeat(2,1fr);}}
    @media(max-width:640px){.articles-grid{grid-template-columns:1fr;}.articles-section,.articles-hero,.filter-bar,.search-section{padding-left:1.5rem;padding-right:1.5rem;}}

    /* Card */
    .article-card{display:block;text-decoration:none;color:inherit;cursor:pointer;transition:transform 0.2s;}
    .article-card:hover{transform:translateY(-4px);}
    .card-thumb{width:100%;aspect-ratio:16/10;object-fit:cover;display:block;}
    .card-thumb-placeholder{width:100%;aspect-ratio:16/10;display:flex;align-items:center;justify-content:center;font-size:3rem;}
    .card-body{padding:1.25rem 0;}
    .card-cat{font-family:'Anton',sans-serif;font-size:0.65rem;letter-spacing:0.15em;color:var(--yellow);text-transform:uppercase;margin-bottom:0.5rem;}
    .card-title{font-family:'Anton',sans-serif;font-size:1.35rem;color:white;line-height:1.1;margin-bottom:0.5rem;transition:color 0.2s;}
    .article-card:hover .card-title{color:var(--yellow);}
    .card-meta{font-size:0.78rem;color:rgba(255,255,255,0.45);font-weight:600;}

    /* FAB */
    .write-btn{position:fixed;bottom:2rem;right:2rem;background:var(--punch);color:white;font-family:'Anton',sans-serif;font-size:0.85rem;letter-spacing:0.1em;padding:1rem 1.75rem;border:3px solid var(--ink);box-shadow:5px 5px 0 var(--ink);text-decoration:none;z-index:40;transition:transform 0.15s,box-shadow 0.15s;display:flex;align-items:center;gap:0.5rem;}
    .write-btn:hover{transform:translate(3px,3px);box-shadow:2px 2px 0 var(--ink);}

    /* Empty */
    .empty-state{text-align:center;padding:5rem 2rem;grid-column:1/-1;}
    .empty-icon{font-size:4rem;margin-bottom:1rem;}
    .empty-title{font-family:'Anton',sans-serif;font-size:2rem;color:white;margin-bottom:0.5rem;}
    .empty-sub{color:rgba(255,255,255,0.5);font-weight:600;}

    /* Pagination */
    .pagination-wrap{display:flex;justify-content:center;gap:4px;}
    .page-link{display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border:2px solid rgba(255,255,255,0.2);color:rgba(255,255,255,0.6);font-family:'Anton',sans-serif;font-size:0.85rem;text-decoration:none;transition:background 0.15s,color 0.15s;}
    .page-link:hover,.page-link.active{background:var(--yellow);color:var(--purple);border-color:var(--yellow);}

    /* Flash */
    .flash-box{background:rgba(0,168,150,0.15);border:2px solid #00a896;padding:0.75rem 1.25rem;font-weight:700;font-size:0.85rem;color:#004d47;margin-bottom:1.5rem;}
</style>
@endpush

@section('content')

<section class="articles-hero">
    <div>
        <span class="hero-tag">✦ BLOG & ARTIKEL</span>
        <h1 class="hero-title">ARTICLE</h1>
        <p class="hero-sub">Kumpulan artikel seputar digital marketing, konten kreatif, dan strategi brand.</p>
    </div>
</section>

<div class="filter-bar">
    <a href="{{ route('articles.index') }}"
       class="filter-tag {{ !request('category') ? 'active' : '' }}">Semua</a>
    @foreach($categories as $cat)
    <a href="{{ route('articles.index', ['category' => $cat]) }}"
       class="filter-tag {{ request('category') === $cat ? 'active' : '' }}">{{ $cat }}</a>
    @endforeach
</div>

<div class="search-section">
    <form action="{{ route('articles.index') }}" method="GET" class="search-form">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <input type="text" name="search" class="search-input"
               placeholder="Cari artikel..." value="{{ request('search') }}">
        <button type="submit" class="search-submit">CARI</button>
    </form>
</div>

<section class="articles-section">

    @if(session('success'))
    <div class="flash-box">✓ {{ session('success') }}</div>
    @endif

    <div class="articles-grid">
        @forelse($articles as $article)
        <a href="{{ route('articles.show', $article->slug) }}" class="article-card">
            @if($article->thumbnail)
                <img src="{{ asset('storage/'.$article->thumbnail) }}"
                     alt="{{ $article->title }}" class="card-thumb">
            @else
                @php
                    $emojis=['🚀','📱','📰','🎨','📊','💡','🔥','✨'];
                    $bgs=['#2d1b4e','#e8402a','#00a896','#1a1a2e','#3b5bdb'];
                    $emoji=$emojis[$article->id % count($emojis)];
                    $bg=$bgs[$article->id % count($bgs)];
                @endphp
                <div class="card-thumb-placeholder" style="background:{{ $bg }};">{{ $emoji }}</div>
            @endif
            <div class="card-body">
                <div class="card-cat">{{ $article->category }}</div>
                <h2 class="card-title">{{ $article->title }}</h2>
                <div class="card-meta">
                    {{ $article->user->name }}
                    &nbsp;·&nbsp;
                    {{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}
                </div>
            </div>
        </a>
        @empty
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <div class="empty-title">BELUM ADA ARTIKEL</div>
            <p class="empty-sub">Jadilah yang pertama menulis artikel!</p>
        </div>
        @endforelse
    </div>

    @if($articles->hasPages())
    <div class="pagination-wrap">
        @if($articles->onFirstPage())
            <span class="page-link" style="opacity:0.3;">‹</span>
        @else
            <a href="{{ $articles->previousPageUrl() }}" class="page-link">‹</a>
        @endif

        @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
            <a href="{{ $url }}" class="page-link {{ $page === $articles->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach

        @if($articles->hasMorePages())
            <a href="{{ $articles->nextPageUrl() }}" class="page-link">›</a>
        @else
            <span class="page-link" style="opacity:0.3;">›</span>
        @endif
    </div>
    @endif
</section>

@auth
    <a href="{{ route('articles.create') }}" class="write-btn">✏️ TULIS ARTIKEL</a>
@else
    <a href="{{ route('login') }}" class="write-btn">✏️ TULIS ARTIKEL</a>
@endauth

@endsection
