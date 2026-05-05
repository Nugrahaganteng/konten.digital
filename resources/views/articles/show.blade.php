{{-- resources/views/articles/show.blade.php --}}
@extends('layouts.app')
@section('title', $article->title)

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Plus+Jakarta+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400&display=swap');

    :root {
        --ink: #0e0b14;
        --yellow: #f5c518;
        --purple: #2d1b4e;
        --punch: #e8402a;
        --cream: #fbf9f4;
        --blue: #3b5bdb;
        --white: #ffffff;
        --shadow: 8px 8px 0px var(--ink);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body { background-color: var(--cream); color: var(--ink); font-family: 'Plus Jakarta Sans', sans-serif; }

    /* Hero Section */
    .hero-section {
        background: var(--purple);
        padding: 6rem 0 4rem;
        border-bottom: 6px solid var(--ink);
        position: relative;
        overflow: hidden;
    }

    .hero-pattern {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0.1;
        background-image: radial-gradient(var(--yellow) 2px, transparent 2px);
        background-size: 30px 30px;
    }

    .hero-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 1;
    }

    .breadcrumb {
        font-family: 'Anton', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
        margin-bottom: 2rem;
    }

    .breadcrumb a { color: var(--yellow); text-decoration: none; }

    .article-badge {
        background: var(--punch);
        color: white;
        padding: 0.4rem 1rem;
        font-family: 'Anton', sans-serif;
        font-size: 0.8rem;
        border: 3px solid var(--ink);
        box-shadow: 4px 4px 0 var(--ink);
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    .display-title {
        font-family: 'Anton', sans-serif;
        font-size: clamp(2.5rem, 6vw, 4.8rem);
        line-height: 1;
        color: var(--white);
        text-transform: uppercase;
        margin-bottom: 2rem;
        text-shadow: 4px 4px 0 var(--ink);
        /* Fix untuk judul yang terlalu panjang */
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    /* Article Layout */
    .main-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 4rem;
        max-width: 1200px;
        margin: -3rem auto 4rem;
        padding: 0 2rem;
    }

    @media (max-width: 992px) {
        .main-grid { grid-template-columns: 1fr; margin-top: 2rem; }
    }

    /* Content Card */
    .article-card {
        background: var(--white);
        border: 4px solid var(--ink);
        box-shadow: var(--shadow);
        padding: 0;
        overflow: hidden;
    }

    .featured-image-wrapper {
        border-bottom: 4px solid var(--ink);
        background: var(--yellow);
    }

    .featured-image {
        width: 100%;
        height: auto;
        display: block;
        max-height: 550px;
        object-fit: cover;
    }

    .content-padding { padding: 3rem; }
    @media (max-width: 576px) { .content-padding { padding: 1.5rem; } }

    .excerpt-box {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.6;
        color: var(--purple);
        margin-bottom: 2.5rem;
        padding: 1.5rem;
        background: rgba(245, 197, 24, 0.1);
        border-left: 8px solid var(--yellow);
        /* Fix teks panjang di excerpt */
        overflow-wrap: break-word;
    }

    .article-body {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #2d2d2d;
        /* FIX UTAMA: Mencegah teks jebol keluar layar */
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
    }

    .article-body h2, .article-body h3 {
        font-family: 'Anton', sans-serif;
        margin-top: 2.5rem;
        color: var(--ink);
    }

    /* Meta Info */
    .author-strip {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px dashed #ddd;
    }

    .author-circle {
        flex-shrink: 0;
        width: 50px; height: 50px;
        background: var(--blue);
        border: 3px solid var(--ink);
        border-radius: 50%;
        display: flex;
        align-items: center; justify-content: center;
        font-family: 'Anton', sans-serif;
        color: white;
    }

    /* Sidebar Components */
    .sidebar-widget {
        background: var(--white);
        border: 4px solid var(--ink);
        box-shadow: 6px 6px 0 var(--ink);
        padding: 1.5rem;
        margin-bottom: 2.5rem;
        position: sticky;
        top: 2rem;
    }

    .widget-title {
        font-family: 'Anton', sans-serif;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .widget-title::after {
        content: "";
        flex: 1;
        height: 4px;
        background: var(--ink);
    }

    .related-link {
        display: grid;
        grid-template-columns: 80px 1fr;
        gap: 1rem;
        text-decoration: none;
        color: inherit;
        margin-bottom: 1.25rem;
        transition: var(--transition);
    }

    .related-link:hover { transform: translateX(5px); }
    .related-link:hover .rel-title { color: var(--blue); }

    .rel-img {
        width: 80px; height: 80px;
        border: 2px solid var(--ink);
        object-fit: cover;
    }

    .rel-title {
        font-weight: 800;
        font-size: 0.95rem;
        line-height: 1.3;
        margin-bottom: 0.25rem;
        /* Mencegah judul di sidebar juga jebol */
        overflow-wrap: break-word;
    }

    /* Buttons */
    .btn-neo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.8rem 1.5rem;
        font-family: 'Anton', sans-serif;
        text-transform: uppercase;
        text-decoration: none;
        border: 3px solid var(--ink);
        box-shadow: 4px 4px 0 var(--ink);
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-neo:hover { transform: translate(-2px, -2px); box-shadow: 7px 7px 0 var(--ink); }
    .btn-neo:active { transform: translate(2px, 2px); box-shadow: 1px 1px 0 var(--ink); }
    
    .btn-yellow { background: var(--yellow); color: var(--ink); }
    .btn-punch { background: var(--punch); color: white; }

    .notice {
        padding: 1rem;
        border: 3px solid var(--ink);
        font-weight: 800;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .notice-waiting { background: #fff4cc; color: #856404; }
</style>
@endpush

@section('content')

<article>
    {{-- Hero Section --}}
    <header class="hero-section">
        <div class="hero-pattern"></div>
        <div class="hero-container">
            <nav class="breadcrumb">
                <a href="{{ route('articles.index') }}">← Back to Articles</a>
            </nav>
            
            <span class="article-badge">{{ $article->category }}</span>
            <h1 class="display-title">{{ $article->title }}</h1>
            
            <div class="author-strip" style="border:none; color: white;">
                <div class="author-circle" style="background: var(--yellow); color: var(--ink)">
                    {{ strtoupper(substr($article->user->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight: 800;">{{ $article->user->name }}</div>
                    <div style="opacity: 0.7; font-size: 0.8rem;">
                        {{ $article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-grid">
        {{-- Main Column --}}
        <div class="article-column">
            <div class="article-card">
                {{-- Featured Image --}}
                <div class="featured-image-wrapper">
                    @if($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" class="featured-image" alt="{{ $article->title }}">
                    @else
                        <div style="height: 300px; display: flex; align-items: center; justify-content: center; font-size: 5rem;">
                            {{ ['🚀','📱','📰','🎨','💡'][$article->id % 5] }}
                        </div>
                    @endif
                </div>

                <div class="content-padding">
                    {{-- Status Notices --}}
                    @auth
                        @if($article->status === 'draft' && (auth()->id() === $article->user_id || auth()->user()->isAdmin()))
                            <div class="notice notice-waiting">
                                <span>⏳</span> Sedang dalam peninjauan moderator.
                            </div>
                        @endif
                    @endauth

                    {{-- Excerpt --}}
                    @if($article->excerpt)
                        <div class="excerpt-box">
                            {{ $article->excerpt }}
                        </div>
                    @endif

                    {{-- Body --}}
                    <div class="article-body">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    {{-- Tags/Footer --}}
                    <div style="margin-top: 4rem; padding-top: 2rem; border-top: 4px solid var(--ink); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                        <div class="author-strip" style="margin-bottom: 0; border: none; padding: 0;">
                            <div class="author-circle">{{ strtoupper(substr($article->user->name, 0, 1)) }}</div>
                            <div>
                                <div style="font-weight: 800;">Ditulis oleh {{ $article->user->name }}</div>
                                <div style="font-size: 0.85rem; opacity: 0.6;">Member sejak {{ $article->user->created_at->format('Y') }}</div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        @auth
                            @can('update', $article)
                                <div style="display: flex; gap: 1rem;">
                                    <a href="{{ route('articles.edit', $article) }}" class="btn-neo btn-yellow">Edit</a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel?')">
                                        @csrf @method('DELETE')
                                        <button class="btn-neo btn-punch">Hapus</button>
                                    </form>
                                </div>
                            @endcan
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="sidebar-column">
            @if($related->count() > 0)
            <div class="sidebar-widget">
                <h3 class="widget-title">BACA JUGA</h3>
                @foreach($related as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}" class="related-link">
                        @if($rel->thumbnail)
                            <img src="{{ asset('storage/' . $rel->thumbnail) }}" class="rel-img">
                        @else
                            <div class="rel-img" style="background: var(--purple); display: flex; align-items: center; justify-content: center; color: white;">
                                📝
                            </div>
                        @endif
                        <div>
                            <div class="rel-title">{{ Str::limit($rel->title, 45) }}</div>
                            <div style="font-size: 0.7rem; opacity: 0.6; font-weight: 700;">{{ $rel->created_at->format('d M Y') }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
            @endif
        </aside>
    </div>
</article>

@endsection