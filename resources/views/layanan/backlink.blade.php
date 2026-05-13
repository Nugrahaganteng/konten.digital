@extends('layouts.app')

@section('title', 'Jasa Backlink Media Nasional - Kontendigital.id')

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

{{-- ── HERO ──────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 bg-[#FFD217] overflow-hidden border-b-8 border-black">
    <div class="absolute top-20 left-10 w-16 h-16 bg-[#430A5D] opacity-10 rounded-lg rotate-12 animate-bounce-slow"></div>
    <div class="absolute bottom-20 right-10 w-20 h-20 border-4 border-[#430A5D] opacity-10 rounded-full animate-pulse"></div>

    <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
        <div class="inline-block px-6 py-2 border-4 border-black bg-white transform -rotate-2 mb-8 shadow-[4px_4px_0px_0px_rgba(67,10,93,1)]">
            <span class="text-[#430A5D] font-black text-sm tracking-widest uppercase italic">
                {{ $hv('badge_text', '✦ JASA BACKLINK MEDIA NASIONAL') }}
            </span>
        </div>

        <h1 class="text-6xl md:text-9xl font-black text-[#430A5D] leading-none uppercase tracking-tighter mb-8 drop-shadow-[6px_6px_0px_#000]">
            {{ $hv('title', 'KONTENDIGITAL') }}<span class="text-white">.ID</span>
        </h1>

        <p class="text-xl md:text-2xl font-bold text-black max-w-3xl mx-auto mb-10 leading-relaxed">
            "{{ $hv('description', 'Mitra terpercaya dalam komunikasi dan pemasaran digital yang mudah, murah, cepat, dan terjamin kualitasnya.') }}"
        </p>

        <div class="relative inline-block group">
            <div class="absolute inset-0 bg-[#430A5D] translate-x-2 translate-y-2 group-hover:translate-x-0 group-hover:translate-y-0 transition-all border-4 border-black"></div>
            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="relative flex items-center justify-center px-10 py-5 bg-black text-white font-black text-2xl border-4 border-black group-hover:bg-[#430A5D] group-hover:text-[#FFD217] transition-all uppercase">
                {{ $hv('cta_text', 'Konsultasi Sekarang') }}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-3 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
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

{{-- ── MANFAAT ───────────────────────────────────────────────── --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-white uppercase italic mb-4">
                {{ $bv('title', 'Manfaat Backlink Media Nasional') }}
            </h2>
            <p class="text-white font-bold text-lg">{{ $bv('subtitle', 'Backlink media nasional memiliki beberapa manfaat sebagai berikut:') }}</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
                $benefitIcons = [
                    'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2 M22 21v-2a4 4 0 0 0-3-3.87 M16 3.13a4 4 0 0 1 0 7.75',
                    'M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z',
                    'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
                ];
            @endphp
            @foreach([1,2,3] as $i)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="{{ $benefitIcons[$i-1] }}"/>
                    </svg>
                </div>
                <h3 class="text-xl font-black uppercase mb-4">{{ $bv("benefit_{$i}_title", '') }}</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">{{ $bv("benefit_{$i}_desc", '') }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── APA ITU BACKLINK ──────────────────────────────────────── --}}
<section class="py-24 bg-white border-b-8 border-black overflow-hidden relative">
    <div class="absolute top-10 right-10 w-24 h-24 bg-[#F2B038] border-4 border-black rounded-full opacity-20 animate-bounce -z-0"></div>
    <div class="absolute bottom-10 left-10 w-16 h-16 bg-[#3B82F6] border-4 border-black rotate-45 opacity-20 animate-pulse -z-0"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-20">
            <div class="w-full lg:w-1/2 relative group">
                <div class="absolute -inset-6 bg-black border-4 border-black -rotate-3 group-hover:rotate-0 transition-all duration-500 shadow-[15px_15px_0px_0px_rgba(242,176,56,1)]"></div>
                <div class="absolute -inset-3 bg-[#3B82F6] border-4 border-black rotate-2 group-hover:-rotate-1 transition-all duration-500 delay-75"></div>
                <div class="relative bg-white border-4 border-black overflow-hidden shadow-[20px_20px_0px_0px_rgba(0,0,0,1)]">
                    @if($whatIsS && $whatIsS->get('image'))
                        <img src="{{ Storage::url($whatIsS->get('image')) }}" alt="Backlink" class="w-full h-auto object-cover">
                    @else
                        <img src="{{ asset('images/leptop.png') }}" alt="Apa itu Backlink" class="w-full h-auto object-cover">
                    @endif
                </div>
                <div class="absolute -bottom-10 -right-5 bg-black text-white px-6 py-3 font-black uppercase italic border-4 border-white shadow-[8px_8px_0px_0px_rgba(59,130,246,1)] animate-bounce-slow">
                    #SEO_BOOSTER
                </div>
            </div>

            <div class="w-full lg:w-1/2 space-y-8">
                <div class="space-y-4">
                    <h2 class="text-5xl md:text-7xl font-black text-black uppercase leading-[0.9] italic">
                        {{ $wv('title', 'APA ITU') }}<br>
                        <span class="relative inline-block mt-2">
                            BACKLINK
                            <div class="absolute -bottom-2 left-0 w-full h-6 bg-[#F2B038]/40 -z-10 skew-x-12"></div>
                        </span>
                    </h2>
                    <p class="text-2xl font-black text-black/40 uppercase tracking-widest">{{ $wv('subtitle', 'Media Nasional Expertise') }}</p>
                </div>

                <div class="space-y-6">
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-4 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)] group-hover:translate-x-1 group-hover:translate-y-1 group-hover:shadow-none transition-all">
                            <span class="text-white font-black">01</span>
                        </div>
                        <p class="text-xl font-bold text-black/80 leading-tight">
                            {{ $wv('point_1', 'Tautan atau hyperlink strategis yang ditempatkan pada portal berita raksasa di Indonesia.') }}
                        </p>
                    </div>
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#F2B038] flex items-center justify-center border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] group-hover:translate-x-1 group-hover:translate-y-1 group-hover:shadow-none transition-all">
                            <span class="text-black font-black">02</span>
                        </div>
                        <p class="text-xl font-bold text-black/80 leading-tight">
                            {{ $wv('point_2', 'Senjata utama untuk memicu algoritma Google agar mengenali website Anda sebagai Otoritas Tinggi.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MENGAPA MEMILIH KAMI ──────────────────────────────────── --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-black uppercase mb-16 leading-tight">
            {{ $yv('title', 'Mengapa Klien Memilih Jasa Kontendigital.id?') }}
        </h2>

        @php
            $icons = [
                'M12 6V12L16 14M22 12A10 10 0 1 1 2 12A10 10 0 0 1 22 12Z',
                'M22 12A10 10 0 1 1 2 12A10 10 0 0 1 22 12Z M9 12L11 14L15 10',
                'M11 5H6C4.89 5 4 5.89 4 7V18C4 19.1 4.89 20 6 20H17C18.1 20 19 19.1 19 18V13M17.59 3.59A2 2 0 1 1 20.41 6.41L11.83 15H9V12.17L17.59 3.59Z',
                'M12 1V23M17 5H9.5A3.5 3.5 0 0 0 9.5 12H14.5A3.5 3.5 0 0 1 14.5 19H6',
                'M2 3H8C9.1 3 10 3.9 10 5V19C10 20.1 9.1 21 8 21H2V3Z M14 3H20C21.1 3 22 3.9 22 5V19C22 20.1 21.1 21 20 21H14V3Z',
                'M14 2H6A2 2 0 0 0 4 4V20A2 2 0 0 0 6 22H18A2 2 0 0 0 20 20V8L14 2Z',
            ];
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach([1,2,3,4,5,6] as $i)
            @php $title = $yv("reason_{$i}", ''); @endphp
            @if($title)
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="{{ $icons[$i-1] }}"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">{{ $title }}</h4>
                    <p class="font-bold text-black/60 text-sm">{{ $yv("reason_{$i}_desc", '') }}</p>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA FINAL ────────────────────────────────────────────── --}}
<section class="py-24 bg-black text-center">
    <h2 class="text-4xl md:text-6xl font-black text-[#F2B038] uppercase mb-10 leading-tight">
        {{ $cv('title', 'SIAP UNTUK GO NATIONAL?') }}
    </h2>
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="inline-block px-12 py-6 bg-white text-black font-black text-2xl border-4 border-[#F2B038] hover:bg-[#F2B038] transition-all uppercase shadow-[8px_8px_0px_0px_rgba(242,176,56,1)]">
        {{ $cv('cta_text', 'Hubungi Kami Sekarang →') }}
    </a>
</section>

@endsection