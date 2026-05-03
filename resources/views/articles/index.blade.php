{{-- resources/views/articles/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Artikel & Blog')

@push('styles')
<style>
    /* Efek Tombol Fisik Neo-Brutalism */
    .btn-brutal {
        box-shadow: 6px 6px 0px 0px #000;
        transition: all 0.15s ease-in-out;
    }
    .btn-brutal:hover {
        box-shadow: 0px 0px 0px 0px #000;
        transform: translate(6px, 6px);
    }
    
    /* Background Grid Kertas Retro */
    .bg-retro-grid {
        background-color: #3b0764; /* purple-950 */
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.05) 2px, transparent 2px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.05) 2px, transparent 2px);
        background-size: 30px 30px;
    }
</style>
@endpush

@section('content')

<div class="bg-retro-grid min-h-screen pb-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-16 pt-32">
        
        {{-- ══ HEADER / HERO DASHBOARD ════════════════════════════════════ --}}
        <div class="bg-yellow-400 border-4 border-black p-2 shadow-[8px_8px_0_0_#000] mb-12">
            <div class="border-4 border-black p-8 md:p-12 bg-white relative overflow-hidden">
                {{-- Aksen Pac-Man Dots di Atas --}}
                <div class="absolute top-4 right-4 text-purple-950 tracking-[0.5em] font-black opacity-30">
                    ••••ᗧ
                </div>

                <div class="inline-block bg-black text-yellow-400 px-4 py-1 font-black uppercase text-sm mb-4 border-2 border-black">
                    Player 1 Ready
                </div>
                
                <h1 class="font-black text-5xl md:text-7xl lg:text-8xl text-black uppercase mb-4" style="font-family:'Unbounded',sans-serif;">
                    BLOG <span class="text-transparent" style="-webkit-text-stroke: 3px black;">&</span> ARTICLE.
                </h1>
                
                <p class="font-bold text-lg md:text-xl text-gray-800 max-w-2xl border-l-4 border-cyan-400 pl-4">
                    Kumpulan strategi digital, inspirasi konten kreatif, dan update terbaru seputar dunia teknologi.
                </p>
            </div>
        </div>

        {{-- ══ CONTROL PANEL (Search & Filter) ════════════════════════════ --}}
        <div class="flex flex-col lg:flex-row gap-6 mb-12">
            
            {{-- Filter Kategori --}}
            <div class="flex-1 flex flex-wrap gap-3">
                <a href="{{ route('articles.index') }}" 
                   class="border-4 border-black px-6 py-3 font-black uppercase {{ !request('category') ? 'bg-cyan-400 translate-y-[6px] translate-x-[6px] shadow-[0_0_0_0_#000]' : 'bg-white btn-brutal' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('articles.index', ['category' => $cat]) }}" 
                       class="border-4 border-black px-6 py-3 font-black uppercase {{ request('category') === $cat ? 'bg-cyan-400 translate-y-[6px] translate-x-[6px] shadow-[0_0_0_0_#000]' : 'bg-white btn-brutal' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            {{-- Form Search --}}
            <form action="{{ route('articles.index') }}" method="GET" class="flex w-full lg:w-1/3 btn-brutal">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" class="w-full border-y-4 border-l-4 border-black px-4 py-3 font-bold outline-none bg-white placeholder-gray-400" placeholder="Cari artikel..." value="{{ request('search') }}">
                <button type="submit" class="bg-black text-yellow-400 border-4 border-black px-6 font-black uppercase hover:bg-cyan-400 hover:text-black transition-colors">
                    Cari
                </button>
            </form>

        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="bg-green-400 border-4 border-black p-4 mb-8 font-black uppercase btn-brutal flex items-center gap-3">
                <span class="text-2xl bg-white rounded-full w-8 h-8 flex items-center justify-center border-2 border-black">✓</span> 
                {{ session('success') }}
            </div>
        @endif

        {{-- ══ GRID ARTIKEL (Clean UI) ═══════════════════════════════════ --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <a href="{{ route('articles.show', $article->slug) }}" class="group block h-full">
                    <div class="bg-white border-4 border-black h-full flex flex-col btn-brutal">
                        
                        {{-- Thumbnail --}}
                        <div class="w-full aspect-[4/3] border-b-4 border-black overflow-hidden relative bg-cyan-400">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" 
                                     class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-6xl group-hover:scale-110 transition-transform">
                                    👾
                                </div>
                            @endif
                            
                            {{-- Label Kategori --}}
                            <div class="absolute bottom-0 left-0 bg-yellow-400 border-t-4 border-r-4 border-black px-4 py-1 font-black text-sm uppercase">
                                {{ $article->category }}
                            </div>
                        </div>

                        {{-- Konten --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <h2 class="font-black text-xl md:text-2xl uppercase mb-4 line-clamp-3 leading-snug group-hover:text-purple-950 transition-colors">
                                {{ $article->title }}
                            </h2>
                            
                            <div class="mt-auto border-t-4 border-black pt-4 flex justify-between items-center font-bold text-sm text-gray-600">
                                <span class="flex items-center gap-2">
                                    <span class="text-black">👤</span> {{ $article->user->name }}
                                </span>
                                <span>
                                    {{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>
                        </div>

                    </div>
                </a>
            @empty
                <div class="col-span-full bg-white border-4 border-black p-12 text-center btn-brutal">
                    <div class="text-6xl mb-4">📭</div>
                    <h2 class="font-black text-3xl uppercase mb-2">Data Kosong</h2>
                    <p class="font-bold text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>

        {{-- ══ PAGINATION ═══════════════════════════════════════════════ --}}
        @if($articles->hasPages())
            <div class="mt-16 flex justify-center gap-4">
                {{-- Prev --}}
                @if ($articles->onFirstPage())
                    <span class="w-12 h-12 flex items-center justify-center border-4 border-black bg-gray-300 text-gray-500 font-black text-xl opacity-50 cursor-not-allowed">‹</span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" class="w-12 h-12 flex items-center justify-center border-4 border-black bg-white font-black text-xl btn-brutal">‹</a>
                @endif

                {{-- Pages --}}
                @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center border-4 border-black font-black text-xl 
                        {{ $page === $articles->currentPage() ? 'bg-black text-yellow-400 translate-y-[6px] translate-x-[6px] shadow-[0_0_0_0_#000]' : 'bg-white btn-brutal' }}">
                        {{ $page }}
                    </a>
                @endforeach

                {{-- Next --}}
                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" class="w-12 h-12 flex items-center justify-center border-4 border-black bg-white font-black text-xl btn-brutal">›</a>
                @else
                    <span class="w-12 h-12 flex items-center justify-center border-4 border-black bg-gray-300 text-gray-500 font-black text-xl opacity-50 cursor-not-allowed">›</span>
                @endif
            </div>
        @endif

    </div>
</div>

{{-- ══ FLOATING ACTION BUTTON ════════════════════════════════════════ --}}
@auth
    <a href="{{ route('articles.create') }}" 
       class="fixed bottom-8 right-8 z-50 bg-yellow-400 border-4 border-black px-6 py-4 font-black uppercase flex items-center gap-3 btn-brutal group">
        <span class="text-2xl group-hover:scale-125 transition-transform">✏️</span> Tulis Artikel
    </a>
@else
    <a href="{{ route('login') }}" 
       class="fixed bottom-8 right-8 z-50 bg-cyan-400 border-4 border-black px-6 py-4 font-black uppercase flex items-center gap-3 btn-brutal group">
        <span class="text-2xl group-hover:scale-125 transition-transform">🔒</span> Login Admin
    </a>
@endauth

@endsection 