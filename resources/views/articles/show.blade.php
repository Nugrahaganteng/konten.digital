{{-- resources/views/articles/show.blade.php --}}
@extends('layouts.app')
@section('title', $article->title)

@push('styles')
<style>
    :root{--ink:#0e0b14;--yellow:#f5c518;--purple:#2d1b4e;--punch:#e8402a;--cream:#f7f2e8;--blue:#3b5bdb;}

    /* Hero */
    .article-hero{background:var(--blue);padding:9rem 0 0;border-bottom:5px solid var(--ink);}
    .article-hero-inner{max-width:860px;margin:0 auto;padding:0 2rem 3rem;}
    .back-link{display:inline-flex;align-items:center;gap:0.4rem;font-family:'Anton',sans-serif;font-size:0.75rem;letter-spacing:0.12em;color:rgba(255,255,255,0.5);text-decoration:none;margin-bottom:1.5rem;transition:color 0.2s;}
    .back-link:hover{color:var(--yellow);}
    .article-cat-tag{display:inline-block;background:var(--yellow);color:var(--purple);font-family:'Anton',sans-serif;font-size:0.7rem;letter-spacing:0.15em;padding:0.3rem 0.9rem;border:2px solid var(--ink);margin-bottom:1.25rem;text-transform:uppercase;}
    .article-title{font-family:'Anton',sans-serif;font-size:clamp(2.5rem,5vw,4.5rem);color:white;line-height:0.95;margin-bottom:1.5rem;}
    .article-meta{display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;padding:1.25rem 0;border-top:2px solid rgba(255,255,255,0.1);border-bottom:2px solid rgba(255,255,255,0.1);}
    .meta-avatar{width:40px;height:40px;background:var(--punch);border:2px solid var(--ink);border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Anton',sans-serif;font-size:1rem;color:white;flex-shrink:0;}
    .meta-name{font-weight:700;font-size:0.9rem;color:white;}
    .meta-date{font-size:0.8rem;color:rgba(255,255,255,0.45);font-weight:600;}

    /* Thumbnail */
    .article-thumb-wrap{background:var(--blue);border-bottom:5px solid var(--ink);}
    .article-thumb-wrap img{width:100%;max-height:500px;object-fit:cover;display:block;}
    .article-thumb-placeholder{width:100%;height:320px;display:flex;align-items:center;justify-content:center;font-size:6rem;}

    /* Layout */
    .article-layout{display:grid;grid-template-columns:1fr 300px;gap:3rem;max-width:1100px;margin:0 auto;padding:4rem 2rem;}
    @media(max-width:768px){.article-layout{grid-template-columns:1fr;}}

    /* Content */
    .article-content-body{font-family:'DM Sans',sans-serif;font-size:1.05rem;line-height:1.8;color:var(--ink);}
    .article-content-body h1,.article-content-body h2,.article-content-body h3{font-family:'Anton',sans-serif;color:var(--purple);margin:2rem 0 1rem;line-height:1;}
    .article-content-body h1{font-size:2.5rem;}
    .article-content-body h2{font-size:2rem;}
    .article-content-body h3{font-size:1.5rem;}
    .article-content-body p{margin-bottom:1.25rem;}
    .article-content-body ul,.article-content-body ol{padding-left:1.5rem;margin-bottom:1.25rem;}
    .article-content-body li{margin-bottom:0.5rem;}
    .article-content-body strong{font-weight:700;color:var(--purple);}
    .article-content-body blockquote{border-left:5px solid var(--yellow);background:rgba(245,197,24,0.08);padding:1rem 1.5rem;margin:1.5rem 0;font-style:italic;color:var(--purple);}
    .article-content-body img{max-width:100%;border:3px solid var(--ink);margin:1.5rem 0;}
    .article-content-body a{color:var(--blue);text-decoration:underline;font-weight:700;}

    /* Sidebar */
    .sidebar-card{background:var(--cream);border:3px solid var(--ink);box-shadow:5px 5px 0 var(--ink);padding:1.5rem;margin-bottom:2rem;}
    .sidebar-title{font-family:'Anton',sans-serif;font-size:1rem;letter-spacing:0.05em;color:var(--purple);border-bottom:3px solid var(--ink);padding-bottom:0.75rem;margin-bottom:1rem;text-transform:uppercase;}
    .related-item{display:flex;gap:0.75rem;margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid rgba(14,11,20,0.1);text-decoration:none;color:inherit;}
    .related-item:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0;}
    .related-thumb{width:70px;height:55px;object-fit:cover;flex-shrink:0;border:2px solid var(--ink);}
    .related-thumb-placeholder{width:70px;height:55px;flex-shrink:0;border:2px solid var(--ink);display:flex;align-items:center;justify-content:center;font-size:1.4rem;}
    .related-info-title{font-family:'Anton',sans-serif;font-size:0.9rem;color:var(--ink);line-height:1.1;margin-bottom:0.3rem;transition:color 0.2s;}
    .related-item:hover .related-info-title{color:var(--punch);}
    .related-date{font-size:0.72rem;color:rgba(14,11,20,0.45);font-weight:600;}

    /* Author box */
    .author-box{background:var(--purple);border:4px solid var(--ink);box-shadow:8px 8px 0 var(--ink);padding:2rem;margin-top:3rem;display:flex;gap:1.5rem;align-items:flex-start;}
    .author-avatar{width:64px;height:64px;background:var(--yellow);border:3px solid var(--ink);border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Anton',sans-serif;font-size:1.6rem;color:var(--purple);flex-shrink:0;}
    .author-name{font-family:'Anton',sans-serif;font-size:1.1rem;color:var(--yellow);margin-bottom:0.25rem;}
    .author-bio{font-size:0.85rem;color:rgba(255,255,255,0.6);font-weight:600;line-height:1.6;}

    /* Action buttons */
    .action-bar{display:flex;gap:1rem;margin-top:2.5rem;padding-top:2rem;border-top:3px solid rgba(14,11,20,0.1);flex-wrap:wrap;}
    .btn-action{font-family:'Anton',sans-serif;font-size:0.8rem;letter-spacing:0.1em;padding:0.65rem 1.5rem;border:3px solid var(--ink);cursor:pointer;text-decoration:none;transition:transform 0.15s,box-shadow 0.15s;box-shadow:4px 4px 0 var(--ink);display:inline-block;}
    .btn-action:hover{transform:translate(3px,3px);box-shadow:1px 1px 0 var(--ink);}
    .btn-edit{background:var(--yellow);color:var(--purple);}
    .btn-delete{background:var(--punch);color:white;}
    .btn-admin{background:var(--purple);color:white;}

    /* Status notices */
    .draft-notice{background:rgba(245,197,24,0.15);border:2px solid var(--yellow);padding:0.75rem 1.25rem;font-weight:700;font-size:0.85rem;color:#7c6200;margin-bottom:1.5rem;}
    .rejected-notice{background:rgba(232,64,42,0.1);border:2px solid var(--punch);padding:0.75rem 1.25rem;font-weight:700;font-size:0.85rem;color:var(--punch);margin-bottom:1.5rem;}
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="article-hero">
    <div class="article-hero-inner">
        <a href="{{ route('articles.index') }}" class="back-link">← KEMBALI KE ARTIKEL</a>
        <div><span class="article-cat-tag">{{ $article->category }}</span></div>
        <h1 class="article-title">{{ $article->title }}</h1>
        <div class="article-meta">
            <div class="meta-avatar">{{ strtoupper(substr($article->user->name, 0, 1)) }}</div>
            <div>
                <div class="meta-name">{{ $article->user->name }}</div>
                <div class="meta-date">
                    {{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}
                </div>
            </div>
            <div style="width:4px;height:4px;background:rgba(255,255,255,0.25);border-radius:50%;"></div>
            <div class="meta-date">{{ $article->category }}</div>
        </div>
    </div>
</div>

{{-- Thumbnail --}}
<div class="article-thumb-wrap">
    @if($article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}"
             alt="{{ $article->title }}"
             style="max-width:860px;margin:0 auto;display:block;">
    @else
        @php
            $emojis = ['🚀','📱','📰','🎨','📊','💡','🔥','✨'];
            $bgs    = ['#2d1b4e','#e8402a','#00a896','#1a1a2e','#3b5bdb'];
            $emoji  = $emojis[$article->id % count($emojis)];
            $bg     = $bgs[$article->id % count($bgs)];
        @endphp
        <div class="article-thumb-placeholder" style="background:{{ $bg }};">{{ $emoji }}</div>
    @endif
</div>

{{-- Content Layout --}}
<div style="background:white;">
    <div class="article-layout">

        {{-- Main Content --}}
        <div>
            @auth
                @if($article->status === 'draft' && (auth()->id() === $article->user_id || auth()->user()->isAdmin()))
                    <div class="draft-notice">⏳ Artikel ini masih menunggu review dari admin.</div>
                @endif
                @if($article->status === 'rejected' && (auth()->id() === $article->user_id || auth()->user()->isAdmin()))
                    <div class="rejected-notice">✗ Artikel ini ditolak oleh admin.</div>
                @endif
            @endauth

            @if($article->excerpt)
                <p style="font-size:1.1rem;color:rgba(14,11,20,0.6);font-weight:600;font-style:italic;border-left:5px solid var(--yellow);padding-left:1.25rem;margin-bottom:2rem;line-height:1.6;">
                    {{ $article->excerpt }}
                </p>
            @endif

            <div class="article-content-body">
                {!! nl2br(e($article->content)) !!}
            </div>

            {{-- Author box --}}
            <div class="author-box">
                <div class="author-avatar">{{ strtoupper(substr($article->user->name, 0, 1)) }}</div>
                <div>
                    <div class="author-name">{{ $article->user->name }}</div>
                    <div class="author-bio">
                        Penulis artikel ini. Bergabung sejak {{ $article->user->created_at->format('Y') }}.
                    </div>
                </div>
            </div>

            {{-- Action buttons --}}
            @auth
                @can('update', $article)
                    <div class="action-bar">
                        <a href="{{ route('articles.edit', $article) }}" class="btn-action btn-edit">✏️ EDIT</a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">🗑 HAPUS</button>
                        </form>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.articles.edit', $article) }}"
                               class="btn-action btn-admin">⚙️ KELOLA (ADMIN)</a>
                        @endif
                    </div>
                @endcan
            @endauth
        </div>

        {{-- Sidebar --}}
        <aside>
            @if($related->count() > 0)
                <div class="sidebar-card">
                    <div class="sidebar-title">Artikel Terkait</div>
                    @foreach($related as $rel)
                        <a href="{{ route('articles.show', $rel->slug) }}" class="related-item">
                            @if($rel->thumbnail)
                                <img src="{{ asset('storage/' . $rel->thumbnail) }}"
                                     alt="{{ $rel->title }}" class="related-thumb">
                            @else
                                @php
                                    $emojis = ['🚀','📱','📰','🎨','📊'];
                                    $bgs    = ['#2d1b4e','#e8402a','#00a896'];
                                @endphp
                                <div class="related-thumb-placeholder"
                                     style="background:{{ $bgs[$rel->id % count($bgs)] }};">
                                    {{ $emojis[$rel->id % count($emojis)] }}
                                </div>
                            @endif
                            <div>
                                <div class="related-info-title">{{ Str::limit($rel->title, 55) }}</div>
                                <div class="related-date">
                                    {{ $rel->published_at?->format('d M Y') ?? $rel->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- CTA --}}
            <div class="sidebar-card" style="background:var(--purple);border-color:var(--ink);">
                <div style="font-family:'Anton',sans-serif;font-size:1.1rem;color:var(--yellow);margin-bottom:0.75rem;">PUNYA CERITA?</div>
                <p style="font-size:0.85rem;color:rgba(255,255,255,0.65);font-weight:600;margin-bottom:1.25rem;line-height:1.6;">
                    Bagikan artikel kamu dan jangkau ribuan pembaca.
                </p>
                @auth
                    <a href="{{ route('articles.create') }}"
                       style="display:block;text-align:center;background:var(--yellow);color:var(--purple);font-family:'Anton',sans-serif;font-size:0.85rem;letter-spacing:0.1em;padding:0.75rem;border:2px solid var(--ink);text-decoration:none;box-shadow:3px 3px 0 var(--ink);">
                        TULIS ARTIKEL →
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       style="display:block;text-align:center;background:var(--yellow);color:var(--purple);font-family:'Anton',sans-serif;font-size:0.85rem;letter-spacing:0.1em;padding:0.75rem;border:2px solid var(--ink);text-decoration:none;box-shadow:3px 3px 0 var(--ink);">
                        MASUK / DAFTAR →
                    </a>
                @endauth
            </div>
        </aside>

    </div>
</div>

@endsection