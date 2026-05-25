@extends('layouts.app')

@section('title', 'Jasa Backlink Media Nasional - HNP Communications.id')

@section('content')

@php
    $heroS     = $sections->get('hero');
    $benefitsS = $sections->get('benefits');
    $whatIsS   = $sections->get('what_is');
    $whyUsS    = $sections->get('why_us');
    $ctaS      = $sections->get('cta');

    $hv = fn($k, $d = '') => $heroS     ? ($heroS->get($k)     ?: $d) : $d;
    $bv = fn($k, $d = '') => $benefitsS ? ($benefitsS->get($k) ?: $d) : $d;
    $wv = fn($k, $d = '') => $whatIsS   ? ($whatIsS->get($k)   ?: $d) : $d;
    $yv = fn($k, $d = '') => $whyUsS    ? ($whyUsS->get($k)    ?: $d) : $d;
    $cv = fn($k, $d = '') => $ctaS      ? ($ctaS->get($k)      ?: $d) : $d;
@endphp

{{-- ── HERO SECTION ──────────────────────────────────────────── --}}
<section class="relative pt-28 pb-16 md:pt-36 md:pb-24 bg-[#FFD217] overflow-hidden border-b-8 border-black">
    <div class="hidden sm:block absolute top-20 left-10 w-16 h-16 bg-[#430A5D] opacity-10 rounded-lg rotate-12 animate-bounce-slow"></div>
    <div class="hidden sm:block absolute bottom-20 right-10 w-20 h-20 border-4 border-[#430A5D] opacity-10 rounded-full animate-pulse"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 text-center relative z-10">
        <div class="inline-block px-4 py-2 border-4 border-black bg-white transform -rotate-2 mb-6 md:mb-8 shadow-[4px_4px_0px_0px_rgba(67,10,93,1)]">
            <span class="text-[#430A5D] font-black text-xs md:text-sm tracking-widest uppercase italic block">
                {{ $hv('badge_text', '✦ JASA BACKLINK MEDIA NASIONAL') }}
            </span>
        </div>

        <h1 class="text-5xl sm:text-7xl md:text-8xl font-black text-[#430A5D] leading-none uppercase tracking-tighter mb-6 md:mb-8 drop-shadow-[4px_4px_0px_#000] md:drop-shadow-[6px_6px_0px_#000] break-words">
            {{ $hv('title', 'BACKLINK') }}<span class="text-white">.ID</span>
        </h1>

        <p class="text-lg md:text-2xl font-bold text-black max-w-3xl mx-auto mb-8 md:mb-10 leading-relaxed px-2">
            "{{ $hv('description', 'Mitra terpercaya dalam komunikasi dan pemasaran digital yang mudah, murah, cepat, dan terjamin kualitasnya.') }}"
        </p>

        <div class="relative inline-block group w-full sm:w-auto px-4 sm:px-0">
            <div class="absolute inset-x-4 sm:inset-0 bg-[#430A5D] translate-x-2 translate-y-2 group-hover:translate-x-0 group-hover:translate-y-0 transition-all border-4 border-black"></div>
            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="relative flex items-center justify-center mx-4 sm:mx-0 px-6 py-4 md:px-10 md:py-5 bg-black text-white font-black text-xl md:text-2xl border-4 border-black group-hover:bg-[#430A5D] group-hover:text-[#FFD217] transition-all uppercase">
                {{ $hv('cta_text', 'Konsultasi Sekarang') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-3 group-hover:translate-x-2 transition-transform shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow { 0%,100%{transform:translateY(0) rotate(12deg)}50%{transform:translateY(-20px) rotate(15deg)} }
    .animate-bounce-slow{animation:bounce-slow 5s ease-in-out infinite}
</style>

{{-- ── MANFAAT SECTION ───────────────────────────────────────── --}}
<section class="py-16 md:py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-5xl font-black text-white uppercase italic mb-4 px-2">
                {{ $bv('title', 'Manfaat Backlink Media Nasional') }}
            </h2>
            <p class="text-white font-bold text-base md:text-lg px-4">{{ $bv('subtitle', 'Backlink media nasional memiliki beberapa manfaat sebagai berikut:') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $benefitIcons = [
                    'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2 M16 3.13a4 4 0 0 1 0 7.75 M23 21v-2a4 4 0 0 0-3-3.87',
                    'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z',
                    'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
                ];
            @endphp
            @foreach([1,2,3] as $i)
            <div class="bg-white p-6 md:p-8 border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] md:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="{{ $benefitIcons[$i-1] }}"/>
                    </svg>
                </div>
                <h3 class="text-xl font-black uppercase mb-3 text-black">{{ $bv("benefit_{$i}_title", 'Manfaat ' . $i) }}</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">{{ $bv("benefit_{$i}_desc", 'Deskripsi manfaat mendalam mengenai optimasi performa website Anda melalui media besar.') }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── APA ITU BACKLINK SECTION ──────────────────────────────── --}}
<section class="py-16 md:py-24 bg-white border-b-8 border-black overflow-hidden relative">
    <div class="hidden lg:block absolute top-10 right-10 w-24 h-24 bg-[#F2B038] border-4 border-black rounded-full opacity-20 animate-bounce -z-0"></div>
    <div class="hidden lg:block absolute bottom-10 left-10 w-16 h-16 bg-[#3B82F6] border-4 border-black rotate-45 opacity-20 animate-pulse -z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <div class="w-full lg:w-1/2 relative group px-2 sm:px-4">
                <div class="absolute -inset-2 sm:-inset-4 bg-black border-4 border-black -rotate-2 group-hover:rotate-0 transition-all duration-500 shadow-[10px_10px_0px_0px_rgba(242,176,56,1)]"></div>
                <div class="absolute -inset-1 sm:-inset-2 bg-[#3B82F6] border-4 border-black rotate-1 group-hover:-rotate-1 transition-all duration-500 delay-75"></div>
                <div class="relative bg-white border-4 border-black overflow-hidden shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
                    @if($whatIsS && $whatIsS->get('image'))
                        <img src="{{ Storage::url($whatIsS->get('image')) }}" alt="Backlink" class="w-full h-auto object-cover block">
                    @else
                        <img src="{{ asset('images/leptop.png') }}" alt="Apa itu Backlink" class="w-full h-auto object-cover block">
                    @endif
                </div>
                <div class="absolute -bottom-6 -right-2 bg-black text-white px-4 py-2 text-xs md:text-sm font-black uppercase italic border-4 border-white shadow-[4px_4px_0px_0px_rgba(59,130,246,1)] animate-bounce-slow">
                    #SEO_BOOSTER
                </div>
            </div>

            <div class="w-full lg:w-1/2 space-y-6 md:space-y-8 mt-6 lg:mt-0">
                <div class="space-y-3">
                    <h2 class="text-4xl md:text-7xl font-black text-black uppercase leading-[0.9] italic">
                        {{ $wv('title', 'APA ITU') }}<br>
                        <span class="relative inline-block mt-2">
                            BACKLINK
                            <div class="absolute -bottom-1 md:-bottom-2 left-0 w-full h-4 md:h-6 bg-[#F2B038]/40 -z-10 skew-x-12"></div>
                        </span>
                    </h2>
                    <p class="text-lg md:text-2xl font-black text-black/40 uppercase tracking-widest">{{ $wv('subtitle', 'Media Nasional Expertise') }}</p>
                </div>

                <div class="space-y-4 md:space-y-6">
                    <div class="flex gap-4 group items-start">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-black flex items-center justify-center border-4 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)] group-hover:translate-x-1 group-hover:translate-y-1 group-hover:shadow-none transition-all">
                            <span class="text-white font-black text-sm md:text-base">01</span>
                        </div>
                        <p class="text-base md:text-xl font-bold text-black/80 leading-tight pt-1">
                            {{ $wv('point_1', 'Tautan atau hyperlink strategis yang ditempatkan pada portal berita raksasa di Indonesia.') }}
                        </p>
                    </div>
                    <div class="flex gap-4 group items-start">
                        <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-[#F2B038] flex items-center justify-center border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] group-hover:translate-x-1 group-hover:translate-y-1 group-hover:shadow-none transition-all">
                            <span class="text-black font-black text-sm md:text-base">02</span>
                        </div>
                        <p class="text-base md:text-xl font-bold text-black/80 leading-tight pt-1">
                            {{ $wv('point_2', 'Senjata utama untuk memicu algoritma Google agar mengenali website Anda sebagai Otoritas Tinggi.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MENGAPA MEMILIH KAMI SECTION ──────────────────────────── --}}
<section class="py-16 md:py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl md:text-5xl font-black text-black uppercase mb-12 md:mb-16 leading-tight text-center md:text-left px-2">
            {{ $yv('title', 'Mengapa Klien Memilih Jasa HNP Communications.id?') }}
        </h2>

        @php
            $icons = [
                'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                'M12 1v22M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6',
                'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
            @foreach([1,2,3,4,5,6] as $i)
            @php 
                $title = $yv("reason_{$i}", 'Keunggulan Utama ' . $i); 
                $desc = $yv("reason_{$i}_desc", 'Kami menyediakan pelayanan terbaik di kelasnya untuk menjaga kepuasan berkala seluruh mitra bisnis kami.');
            @endphp
            @if($title)
            <div class="flex gap-4 md:gap-6 items-start p-2">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="{{ $icons[$i-1] }}"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-base md:text-lg mb-2 text-black leading-tight">{{ $title }}</h4>
                    <p class="font-bold text-black/60 text-xs md:text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA FINAL SECTION ────────────────────────────────────── --}}
<section class="py-16 md:py-24 bg-black text-center px-4">
    <h2 class="text-3xl md:text-6xl font-black text-[#F2B038] uppercase mb-8 md:mb-10 leading-tight max-w-4xl mx-auto break-words">
        {{ $cv('title', 'SIAP UNTUK GO NATIONAL?') }}
    </h2>
    <div class="w-full sm:w-auto inline-block px-4 sm:px-0">
        <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
           class="block sm:inline-block w-full sm:w-auto px-8 py-5 md:px-12 md:py-6 bg-white text-black font-black text-xl md:text-2xl border-4 border-[#F2B038] hover:bg-[#F2B038] hover:text-black transition-all uppercase shadow-[6px_6px_0px_0px_rgba(242,176,56,1)] md:shadow-[8px_8px_0px_0px_rgba(242,176,56,1)]">
            {{ $cv('cta_text', 'Hubungi Kami Sekarang →') }}
        </a>
    </div>
</section>

@endsection