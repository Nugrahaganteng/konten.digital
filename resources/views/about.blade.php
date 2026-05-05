{{-- resources/views/about.blade.php --}}
@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

{{-- ══ HERO ═══════════════════════════════════════════════ --}}
{{-- resources/views/about.blade.php --}}
@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

{{-- ══ HERO ═══════════════════════════════════════════════ --}}
<section class="min-h-screen bg-yellow-400 border-b-4 border-black flex flex-col pt-20 overflow-hidden relative">

    {{-- Dekorasi floating (Menggunakan Ikon Heroicons) --}}
    <div class="absolute top-28 left-10 animate-float opacity-30 hidden lg:block select-none pointer-events-none text-purple-950">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-16 h-16"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
    </div>
    <div class="absolute top-40 right-16 animate-float-slow opacity-25 hidden lg:block select-none pointer-events-none text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20"><path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699-2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" /></svg>
    </div>
    <div class="absolute bottom-32 right-1/3 animate-bounce-heavy opacity-20 hidden lg:block select-none pointer-events-none text-black">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16"><path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" /></svg>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center px-6 py-20 relative z-10 text-center">
        {{-- Badge --}}
        <div class="reveal mb-6">
            <span class="inline-flex items-center gap-2 bg-red-500 text-white font-black text-xs tracking-widest uppercase px-5 py-2 border-[3px] border-black shadow-neo-sm -rotate-1 hover:rotate-1 transition-transform cursor-default" style="font-family:'Unbounded',sans-serif">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M16.243 16.243l-1.591-1.591M12 18.75V21m-4.243-4.757-1.591 1.591M3.75 10.5H6m.166-5.834 1.591 1.591" /></svg>
                SIAPA KAMI
            </span>
        </div>

        {{-- Headline --}}
        <div class="reveal mb-4">
            <h1 class="font-black leading-none" style="font-family:'Unbounded',sans-serif; font-size:clamp(3.5rem,10vw,9rem);">
                <span class="text-purple-950 text-glitch-heavy block">WHO</span>
                <span class="text-transparent block" style="-webkit-text-stroke:4px #2d1b4e">WE ARE.</span>
            </h1>
        </div>

        <p class="reveal font-bold text-purple-950/70 text-lg md:text-xl max-w-xl mx-auto mb-12 italic">
            "Mitra terpercaya dalam komunikasi dan pemasaran digital."
        </p>

        {{-- Icon Central (Replacing UFO Emoji/SVG) --}}
        <div class="reveal animate-float text-purple-950">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32" style="filter:drop-shadow(6px 6px 0 #ef4444)">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
            </svg>
        </div>
    </div>

    {{-- Mountain --}}
    <svg viewBox="0 0 1440 160" fill="none" preserveAspectRatio="none" class="w-full block mt-auto">
        <path d="M0,160 L0,90 L80,20 L160,90 L240,5 L320,70 L400,0 L480,55 L560,10 L640,65 L720,0 L800,60 L880,15 L960,75 L1040,10 L1120,70 L1200,20 L1280,75 L1360,30 L1440,60 L1440,160 Z" fill="#3b0764"/>
    </svg>
</section>

{{-- ══ TENTANG KAMI ════════════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden bg-space-stars">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Visual kiri --}}
            <div class="relative reveal group">
                <div class="border-4 border-yellow-400 bg-yellow-400 overflow-hidden aspect-[4/3] flex items-center justify-center shadow-[14px_14px_0px_0px_#ef4444] group-hover:shadow-none group-hover:translate-x-2 group-hover:translate-y-2 transition-all duration-300">
                    <img src="{{ asset('images/r.png') }}" alt="Tim KontenDigital" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="hidden w-full h-full items-center justify-center bg-yellow-300 flex-col gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-purple-950 animate-bounce-heavy"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.998 5.998 0 0 0-12 0m12 0c0-1.657-1.343-3-3-3m-9 3c0-1.657 1.343-3 3-3m1.5-3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm7.5-3a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        <p class="font-black text-purple-950 text-sm uppercase tracking-widest">Tim Kami</p>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 bg-red-500 border-4 border-black shadow-neo p-4 animate-float">
                    <div class="font-black text-white text-3xl leading-none" style="font-family:'Unbounded',sans-serif">5+</div>
                    <div class="text-white/70 text-xs font-bold uppercase tracking-widest mt-1">Tahun Berdiri</div>
                </div>
            </div>

            {{-- Teks kanan --}}
            <div class="reveal">
                <span class="section-eyebrow mb-6">TENTANG KAMI</span>
                <h2 class="font-black text-white leading-tight mb-6 text-glitch-heavy" style="font-family:'Unbounded',sans-serif; font-size:clamp(2rem,4vw,3.5rem)">
                    Mitra Digital<br><span class="text-yellow-400">Terpercaya</span>
                </h2>
                <p class="text-white/80 font-bold leading-relaxed mb-6 text-base">
                    Kami adalah mitra terpercaya dalam komunikasi dan pemasaran digital, menawarkan layanan unggulan seperti Jasa Press Release, Jasa Backlink Media Nasional, dan Jasa Press Conference.
                </p>

                <div class="grid grid-cols-2 gap-px bg-black border-4 border-black shadow-neo">
                    @foreach([['200+','Media Partner'],['1K+','Happy Clients'],['5+','Tahun Berdiri'],['8','Jenis Layanan']] as [$v,$l])
                    <div class="bg-purple-900 p-5 hover:bg-yellow-400 group/stat transition-all cursor-default text-center">
                        <div class="font-black text-yellow-400 text-4xl leading-none group-hover/stat:text-purple-950 transition-colors" style="font-family:'Unbounded',sans-serif">{{ $v }}</div>
                        <div class="text-white/60 text-xs uppercase font-bold tracking-widest mt-2 group-hover/stat:text-black transition-colors">{{ $l }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ VISI & MISI ═════════════════════════════════════════ --}}
<section class="bg-cyan-400 bg-retro-grid border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex items-center gap-4 mb-16 reveal">
            <div class="bg-white border-4 border-black shadow-neo px-6 py-4 w-fit">
                <h2 class="font-black text-black text-2xl uppercase" style="font-family:'Unbounded',sans-serif">Visi & Misi</h2>
            </div>
            <div class="w-6 h-6 bg-red-500 border-2 border-black rounded-full animate-radar flex-shrink-0"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- VISI --}}
            <div class="reveal group">
                <div class="bg-white border-4 border-black shadow-neo overflow-hidden hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                    <div class="bg-purple-950 border-b-4 border-black px-8 py-5 flex items-center gap-4">
                        <div class="flex-1 relative h-6 flex items-center">
                            <div class="w-full border-t-4 border-dotted border-yellow-400/50"></div>
                            <span class="absolute left-0 text-yellow-400 animate-bounce-heavy">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                            </span>
                        </div>
                        <h3 class="font-black text-yellow-400 text-xl uppercase whitespace-nowrap" style="font-family:'Unbounded',sans-serif">Our Vision</h3>
                    </div>
                    <div class="p-8 relative">
                        <div class="text-purple-950 mb-4 animate-float-slow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        </div>
                        <p class="font-bold text-black/80 leading-relaxed text-base">
                            Menjadi agensi digital terkemuka di Indonesia yang dipercaya oleh ratusan brand untuk meningkatkan visibilitas dan kredibilitas mereka.
                        </p>
                    </div>
                </div>
            </div>

            {{-- MISI --}}
            <div class="reveal group" style="transition-delay:0.15s">
                <div class="bg-white border-4 border-black shadow-neo overflow-hidden hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                    <div class="bg-red-500 border-b-4 border-black px-8 py-5 flex items-center gap-4">
                        <div class="flex-1 relative h-6 flex items-center">
                            <div class="w-full border-t-4 border-dotted border-white/50"></div>
                            <span class="absolute left-0 text-white animate-bounce-heavy">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" /></svg>
                            </span>
                        </div>
                        <h3 class="font-black text-white text-xl uppercase whitespace-nowrap" style="font-family:'Unbounded',sans-serif">Our Mission</h3>
                    </div>
                    <div class="p-8 relative">
                        <ul class="space-y-4">
                            @php
                                $misi = [
                                    ['M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z', 'Solusi komunikasi digital inovatif dan terukur.'],
                                    ['M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5-1.5-3-1m-5.01 4.793L12 13.5M12 13.5l-2.25-1.313M12 13.5V15', 'Menghubungkan brand dengan 200+ media nasional.'],
                                    ['M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z', 'Membangun hubungan jangka panjang berbasis kepercayaan.'],
                                    ['M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699-2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z', 'Terus berinovasi dalam layanan konten digital.'],
                                ];
                            @endphp
                            @foreach($misi as [$path, $text])
                            <li class="flex items-start gap-3">
                                <span class="text-red-500 flex-shrink-0 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" /></svg>
                                </span>
                                <p class="font-bold text-black/75 leading-relaxed text-sm">{{ $text }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ GALLERY (SLIDER VERSION) ════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden bg-space-stars">
    <div class="max-w-7xl mx-auto relative z-10">
        
        {{-- Header Ticker Track --}}
        <div class="flex flex-col md:flex-row border-4 border-black shadow-neo mb-12 reveal overflow-hidden">
            <div class="bg-purple-950 text-yellow-400 px-8 py-5 border-b-4 md:border-b-0 md:border-r-4 border-black flex items-center min-w-[220px]">
                <h2 class="font-black text-2xl uppercase text-glitch" style="font-family:'Unbounded',sans-serif">Our Gallery</h2>
            </div>
            <div class="bg-yellow-400 flex-1 relative overflow-hidden flex items-center py-4 px-6">
                <div class="animate-ticker w-max flex items-center gap-6 text-purple-950">
                    @for($i=0;$i<10;$i++)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 animate-bounce-heavy"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" /></svg>
                        <span class="tracking-[0.5em] opacity-40 text-lg font-bold">••••</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 animate-bounce-heavy"><path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        <span class="tracking-[0.5em] opacity-40 text-lg font-bold">••••</span>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Container Slider --}}
        <div class="relative group reveal">
            <button onclick="scrollGallery('left')" class="absolute left-[-20px] top-1/2 -translate-y-1/2 z-30 bg-yellow-400 border-4 border-black p-4 shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all hidden md:flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            </button>
            <button onclick="scrollGallery('right')" class="absolute right-[-20px] top-1/2 -translate-y-1/2 z-30 bg-yellow-400 border-4 border-black p-4 shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all hidden md:flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
            </button>

            <div id="galleryContainer" class="flex gap-6 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-12 pt-4 px-4 scroll-smooth">
                @foreach([
                    ['images/kantor1.jpg','Kantor Kami'],
                    ['images/tim1.jpg','Tim Kreatif'],
                    ['images/kerja2.jpg','Workspace'],
                    ['images/event.jpg','Event Press Conference'],
                    ['images/sudut.jpg','Sudut Kreatif'],
                    ['images/tim.jpg','Meeting Room'],
                ] as [$img, $caption])
                <div class="flex-none w-[85vw] md:w-[500px] snap-center">
                    <div class="relative aspect-video border-4 border-black shadow-neo overflow-hidden group/item bg-purple-900">
                        <img src="{{ asset($img) }}" alt="{{ $caption }}" class="w-full h-full object-cover grayscale group-hover/item:grayscale-0 transition-all duration-500 group-hover/item:scale-110" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="hidden w-full h-full items-center justify-center flex-col gap-4 absolute inset-0 bg-purple-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-yellow-400"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                            <p class="text-yellow-400 font-black uppercase tracking-widest text-xs">{{ $caption }}</p>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-0 group-hover/item:opacity-100 transition-opacity flex items-end p-6">
                            <span class="bg-yellow-400 text-black font-black px-4 py-2 border-2 border-black text-sm uppercase">
                                {{ $caption }}
                            </span> 
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ WE ARE DIFFERENT ════════════════════════════════════ --}}
<section class="bg-red-500 border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <span class="inline-flex items-center gap-2 bg-black text-yellow-400 font-black text-xs tracking-widest uppercase px-4 py-2 mb-6 shadow-neo-sm animate-bounce-heavy">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 22.125l-.394-1.558a1.907 1.907 0 0 0-1.39-1.39l-1.558-.394 1.558-.394a1.907 1.907 0 0 0 1.39-1.39l.394-1.558.394 1.558a1.907 1.907 0 0 0 1.39 1.39l1.558.394-1.558.394a1.907 1.907 0 0 0-1.39 1.39Z" /></svg>
                    KENAPA KAMI
                </span>
                <h2 class="font-black text-white leading-none mb-6 text-glitch-heavy" style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,5vw,5rem)">
                    We Are<br><span class="text-black" style="-webkit-text-stroke:1px white">Different!</span>
                </h2>
                <a href="{{ route('contact') }}" class="btn-pop bg-yellow-400 text-purple-950 !shadow-neo hover:!shadow-none animate-float">HUBUNGI KAMI →</a>
            </div>

            <div class="grid grid-cols-2 gap-4 reveal">
                @php
                    $features = [
                        ['M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c.946-.076 1.9-.115 2.856-.115a45.35 45.35 0 0 1 7.788.673c.76.104 1.306.762 1.306 1.523v3.82c0 .664-.475 1.223-1.129 1.311a45.647 45.647 0 0 1-5.146.415 45.708 45.708 0 0 1-5.146-.415A1.33 1.33 0 0 1 4.75 10.138V5.759c0-.76.546-1.419 1.306-1.523Z', '200+ Media', 'Jaringan media nasional terluas'],
                        ['m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z', 'Respon Cepat', '< 1 jam di hari kerja'],
                        ['M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z', 'Garansi Tayang', 'Atau uang kembali'],
                        ['M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z', 'Tim Profesional', 'Berpengalaman 5+ tahun'],
                    ];
                @endphp
                @foreach($features as [$path, $title, $desc])
                <div class="bg-white border-4 border-black p-4 shadow-neo-sm hover:bg-yellow-400 hover:translate-y-[-4px] transition-all group cursor-default">
                    <div class="text-black mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" /></svg>
                    </div>
                    <p class="font-black text-black text-sm uppercase mb-1">{{ $title }}</p>
                    <p class="text-black/60 text-xs font-bold">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ CTA ════════════════════════════════════════════════ --}}
<section class="bg-white border-b-4 border-black py-24 px-6 lg:px-16 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto relative z-10">
        <h2 class="reveal font-black text-black leading-none mb-10" style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,6vw,5.5rem)">
            Siap Melejit<br><span class="text-red-500">Bersama Kami?</span>
        </h2>
        <div class="reveal flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6287786000919" class="btn-pop text-base px-10 py-5 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.33.18.506.514.482.887l-.847 12.89a2.25 2.25 0 0 1-2.269 2.1c-2.83-.068-7.67-.103-11.307-.103-3.716 0-8.106.035-10.925.103a2.25 2.25 0 0 1-2.274-2.1l-.846-12.89a.888.888 0 0 1 .482-.887l10.925-5.962a1.5 1.5 0 0 1 1.442 0l10.925 5.962ZM7.5 12h9m-9 3.5h9m-9 3.5h9" /></svg>
                WhatsApp Sekarang
            </a>
           
        </div>
    </div>
</section>

@endsection

@endsection

@push('styles')
<style>
    /* Menghilangkan scrollbar tapi tetap bisa di-scroll */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@push('scripts')
<script>
    // Fungsi Geser Gallery
    function scrollGallery(direction) {
        const container = document.getElementById('galleryContainer');
        const scrollAmount = window.innerWidth > 768 ? 524 : 320; // Sesuaikan dengan lebar item
        
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
</script>
@endpush