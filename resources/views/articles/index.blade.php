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

@endsection
