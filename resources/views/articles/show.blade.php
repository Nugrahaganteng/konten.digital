@extends('layouts.app')
@section('title', $article->title)

@section('content')

<article class="max-w-4xl mx-auto px-6 py-12">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-muted mb-8">
        <a href="{{ route('home') }}" class="hover:text-ink transition-colors">Beranda</a>
        <span>/</span>
        <a href="{{ route('articles.index') }}" class="hover:text-ink transition-colors">Artikel</a>
        <span>/</span>
        <span class="text-ink truncate max-w-xs">{{ $article->title }}</span>
    </nav>

    {{-- Category --}}
    <a href="{{ route('articles.index', ['category' => $article->category]) }}"
       class="inline-block bg-accent/10 text-accent text-xs font-bold px-3 py-1.5 rounded-full tracking-wide uppercase mb-6 hover:bg-accent/20 transition-colors">
        {{ $article->category }}
    </a>

    {{-- Title --}}
    <h1 class="font-display text-4xl md:text-5xl font-black text-ink leading-tight mb-6">
        {{ $article->title }}
    </h1>

    {{-- Meta --}}
    <div class="flex flex-wrap items-center gap-4 text-sm text-muted mb-8 pb-8 border-b border-ink/10">
        <div class="flex items-center gap-2">
            <div class="w-9 h-9 rounded-full bg-ink/10 flex items-center justify-center font-bold text-ink text-sm">
                {{ substr($article->user->name, 0, 1) }}
            </div>
            <span class="font-medium text-ink">{{ $article->user->name }}</span>
        </div>
        <span>·</span>
        <time>{{ $article->published_at->translatedFormat('d F Y') }}</time>
        <span>·</span>
        <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} menit baca</span>

        @auth
            @if(auth()->user()->id === $article->user_id || auth()->user()->is_admin)
                <span class="ml-auto flex gap-3">
                    <a href="{{ route('articles.edit', $article) }}"
                       class="text-muted hover:text-ink border border-ink/20 px-3 py-1 rounded-lg text-xs font-medium transition-colors">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('articles.destroy', $article) }}"
                          onsubmit="return confirm('Hapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 border border-red-200 px-3 py-1 rounded-lg text-xs font-medium transition-colors">
                            Hapus
                        </button>
                    </form>
                </span>
            @endif
        @endauth
    </div>

    {{-- Thumbnail --}}
    @if($article->thumbnail)
        <div class="rounded-2xl overflow-hidden mb-10 shadow-lg">
            <img src="{{ $article->thumbnail_url }}"
                 alt="{{ $article->title }}"
                 class="w-full aspect-video object-cover">
        </div>
    @endif

    {{-- Excerpt --}}
    @if($article->excerpt)
        <p class="text-xl text-muted leading-relaxed border-l-4 border-accent pl-6 mb-10 italic">
            {{ $article->excerpt }}
        </p>
    @endif

    {{-- Content --}}
    <div class="prose prose-lg prose-ink max-w-none
                prose-headings:font-display prose-headings:text-ink
                prose-a:text-accent prose-a:no-underline hover:prose-a:underline
                prose-img:rounded-xl prose-img:shadow-md
                prose-blockquote:border-accent prose-blockquote:text-muted
                prose-code:bg-ink/5 prose-code:text-accent prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded">
        {!! nl2br(e($article->content)) !!}
    </div>

    {{-- Tags/Category footer --}}
    <div class="mt-12 pt-8 border-t border-ink/10 flex items-center justify-between flex-wrap gap-4">
        <a href="{{ route('articles.index', ['category' => $article->category]) }}"
           class="inline-flex items-center gap-2 bg-ink/5 text-ink px-4 py-2 rounded-full text-sm font-medium hover:bg-ink hover:text-cream transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/></svg>
            {{ $article->category }}
        </a>
        <a href="{{ route('articles.index') }}"
           class="text-sm text-muted hover:text-ink transition-colors">
            ← Kembali ke artikel
        </a>
    </div>
</article>

{{-- Related Articles --}}
@if($related->count() > 0)
<section class="bg-cream border-t border-ink/8 py-16">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="font-display text-2xl font-bold text-ink mb-8">Artikel Terkait</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($related as $item)
                <x-article-card :article="$item" />
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
