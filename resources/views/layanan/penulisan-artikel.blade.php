@extends('layouts.app')

@section('title', 'Jasa Penulisan Artikel SEO - HNP Communications.id')

@section('content')

@php
    $heroS     = $sections->get('hero');
    $problemS  = $sections->get('problems');
    $whyS      = $sections->get('why_artikel');
    $topicS    = $sections->get('topics');
    $pricingS  = $sections->get('pricing');
    $ctaS      = $sections->get('cta');

    // Helper: null  = field di-HIDE admin  → jangan render elemen
    //         string = field visible (isi DB atau fallback default) → render
    $hv  = function($k, $d = '') use ($heroS) {
        if (!$heroS) return $d;
        if ($heroS->isFieldHidden($k)) return null;
        $v = $heroS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $prv = function($k, $d = '') use ($problemS) {
        if (!$problemS) return $d;
        if ($problemS->isFieldHidden($k)) return null;
        $v = $problemS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $wv  = function($k, $d = '') use ($whyS) {
        if (!$whyS) return $d;
        if ($whyS->isFieldHidden($k)) return null;
        $v = $whyS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $tv  = function($k, $d = '') use ($topicS) {
        if (!$topicS) return $d;
        if ($topicS->isFieldHidden($k)) return null;
        $v = $topicS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $pv  = function($k, $d = '') use ($pricingS) {
        if (!$pricingS) return $d;
        if ($pricingS->isFieldHidden($k)) return null;
        $v = $pricingS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $cv  = function($k, $d = '') use ($ctaS) {
        if (!$ctaS) return $d;
        if ($ctaS->isFieldHidden($k)) return null;
        $v = $ctaS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
@endphp

{{-- ── 1. HERO ──────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 bg-[#FFD200] overflow-hidden border-b-8 border-black">
    <div class="absolute bottom-16 left-16 w-16 h-16 border-4 border-[#430A5D] opacity-10 rotate-45 animate-bounce-slow hidden md:block"></div>

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center relative z-10">
        <div class="space-y-6">

            {{-- Badge --}}
            @if($hv('badge_text', '✦ JASA PENULISAN ARTIKEL') !== null)
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PENULISAN ARTIKEL') }}
                </span>
            </div>
            @endif

            {{-- Judul --}}
            @php
                $tl1 = $hv('title_line1', 'KONTEN ARTIKEL');
                $tl2 = $hv('title_line2', 'BERKUALITAS &');
                $tl3 = $hv('title_line3', 'SEO FRIENDLY');
            @endphp
            @if($tl1 !== null || $tl2 !== null || $tl3 !== null)
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-[#3D0066] leading-[0.95] uppercase tracking-tighter">
                @if($tl1 !== null){{ $tl1 }}<br>@endif
                @if($tl2 !== null){{ $tl2 }}<br>@endif
                @if($tl3 !== null)
                <span class="bg-black text-[#FFD200] px-3 inline-block transform rotate-1 italic">{{ $tl3 }}</span>
                @endif
            </h1>
            @endif

            {{-- Kutipan --}}
            @if($hv('quote', 'Artikel yang menarik pembaca sekaligus disukai Google.') !== null)
            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-xl font-bold text-black italic">
                    "{{ $hv('quote', 'Artikel yang menarik pembaca sekaligus disukai Google.') }}"
                </p>
            </div>
            @endif

            {{-- Deskripsi --}}
            @php $hvDesc = $hv('description', 'Tim penulis berpengalaman kami siap menghasilkan artikel informatif, engaging, dan teroptimasi untuk kebutuhan website, blog, maupun media Anda.'); @endphp
            @if($hvDesc !== null)
            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">{{ $hvDesc }}</p>
            @endif

            {{-- CTA --}}
            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') ?: 'https://wa.me/6287786000919' }}"
               class="inline-flex items-center gap-3 px-10 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG') ?: 'KONSULTASI SEKARANG' }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

        {{-- Image Side --}}
        <div class="relative flex justify-center items-center h-[500px] md:h-[550px] lg:h-[600px] w-full mt-12 lg:mt-0 select-none">
            <div class="absolute w-[280px] h-[280px] sm:w-[320px] sm:h-[320px] md:w-[420px] md:h-[420px] border-[6px] border-black rounded-[40px] md:rounded-[50px] -translate-x-4 -translate-y-4 pointer-events-none"></div>

            <div class="relative w-[260px] h-[260px] sm:w-[300px] sm:h-[300px] md:w-[380px] md:h-[380px] lg:w-[400px] lg:h-[400px] bg-[#14b8a6] border-[6px] border-black rounded-full shadow-[16px_16px_0px_0px_rgba(0,0,0,1)] md:shadow-[25px_25px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">

                @if($heroS && !$heroS->isFieldHidden('image') && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Penulisan Artikel"
                         class="absolute bottom-0 w-[115%] md:w-[120%] lg:w-[125%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-1.5 object-contain pointer-events-auto">
                @else
                    <img src="{{ asset('images/tulis1.png') }}" alt="Penulisan Artikel"
                         class="absolute bottom-0 w-[115%] md:w-[120%] lg:w-[125%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-1.5 object-contain pointer-events-auto">
                @endif

                <div class="absolute top-1/3 -right-8 sm:-right-12 md:-right-20 bg-white border-4 border-black rounded-full px-4 py-1.5 md:px-5 md:py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] z-20 flex items-center gap-1.5 md:gap-2">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-black text-[10px] md:text-xs lg:text-sm text-black uppercase tracking-tight">SEO READY!</span>
                    <div class="absolute -bottom-2 left-6 w-3 h-3 bg-white border-b-4 border-r-4 border-black rotate-45"></div>
                </div>

                <div class="absolute bottom-4 -left-6 sm:-left-10 md:bottom-2 md:-left-16 bg-white text-black border-4 border-black px-3 py-1.5 md:px-5 md:py-2 font-black text-[10px] md:text-sm uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] md:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-[3deg] z-30 flex items-center gap-1.5 md:gap-2 whitespace-nowrap">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-[#14b8a6] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    ANTI PLAGIAT
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: rotate(45deg) translateY(0); }
        50% { transform: rotate(45deg) translateY(-20px); }
    }
    .animate-bounce-slow { animation: bounce-slow 5s ease-in-out infinite; }
</style>

{{-- ── 2. MASALAH & SOLUSI ─────────────────────────────────────── --}}
@if(!$problemS || $problemS->is_active)
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div class="relative group order-2 lg:order-1">
            <div class="absolute inset-0 bg-[#FFD200] border-4 border-black translate-x-4 translate-y-4 -z-10 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform"></div>
            @if($problemS && !$problemS->isFieldHidden('image') && $problemS->get('image'))
                <img src="{{ Storage::url($problemS->get('image')) }}" alt="Masalah Penulisan Artikel"
                     class="w-full grayscale border-4 border-black object-cover aspect-video lg:aspect-auto">
            @else
                <img src="{{ asset('images/tulis.png') }}" alt="Masalah Penulisan Artikel"
                     class="w-full grayscale border-4 border-black object-cover aspect-video lg:aspect-auto">
            @endif
        </div>
        <div class="order-1 lg:order-2">
            @if($prv('title', 'Apakah Anda Mengalami Hal Ini?') !== null)
            <h2 class="text-4xl font-black uppercase mb-10 leading-tight text-[#3D0066]">
                {{ $prv('title', 'Apakah Anda Mengalami Hal Ini?') }}
            </h2>
            @endif
            <div class="space-y-4">
                @for($i = 1; $i <= 8; $i++)
                    @php $item = $prv("problem_{$i}"); @endphp
                    @if($item !== null && $item !== '')
                    <div class="flex items-center gap-4 p-4 bg-white border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-red-50 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all group">
                        <div class="w-8 h-8 bg-black flex items-center justify-center border-2 border-white flex-shrink-0 group-hover:bg-red-600 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="font-black uppercase text-sm tracking-tight text-black">{{ $item }}</span>
                    </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</section>
@endif

{{-- ── 3. MENGAPA HARUS KAMI ───────────────────────────────────── --}}
@if(!$whyS || $whyS->is_active)
<section class="py-24 bg-[#3D0066] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        @if($wv('title', 'Mengapa Harus Jasa Penulisan Artikel?') !== null)
        <h2 class="text-4xl md:text-6xl font-black uppercase mb-4 italic text-[#FFD200]">
            {{ $wv('title', 'Mengapa Harus Jasa Penulisan Artikel?') }}
        </h2>
        @endif
        @if($wv('subtitle', 'Konten artikel yang baik adalah investasi jangka panjang untuk traffic organik.') !== null)
        <p class="text-white font-bold mb-16 text-lg max-w-2xl mx-auto">
            {{ $wv('subtitle', 'Konten artikel yang baik adalah investasi jangka panjang untuk traffic organik.') }}
        </p>
        @endif

        @php
            $trustIcons = [
                1 => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>',
                2 => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                3 => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>',
                4 => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>',
                5 => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            ];
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach([1,2,3] as $i)
            @if($wv("reason_{$i}_title") !== null && $wv("reason_{$i}_title") !== '')
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_#FFD200] group hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                <div class="w-14 h-14 bg-black border-4 border-[#FFD200] mx-auto mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform text-[#FFD200]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        {!! $trustIcons[$i] !!}
                    </svg>
                </div>
                <h3 class="font-black text-xl uppercase mb-3 text-black">{{ $wv("reason_{$i}_title") }}</h3>
                @if($wv("reason_{$i}_desc") !== null)
                <p class="text-sm font-medium text-black/70 leading-relaxed">{{ $wv("reason_{$i}_desc") }}</p>
                @endif
            </div>
            @endif
            @endforeach
        </div>

        @php
            $hasR4 = $wv('reason_4_title') !== null && $wv('reason_4_title') !== '';
            $hasR5 = $wv('reason_5_title') !== null && $wv('reason_5_title') !== '';
        @endphp
        @if($hasR4 || $hasR5)
        <div class="grid md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            @foreach([4,5] as $i)
            @if($wv("reason_{$i}_title") !== null && $wv("reason_{$i}_title") !== '')
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_#FFD200] group hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                <div class="w-14 h-14 bg-black border-4 border-[#FFD200] mx-auto mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform text-[#FFD200]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        {!! $trustIcons[$i] !!}
                    </svg>
                </div>
                <h3 class="font-black text-xl uppercase mb-3 text-black">{{ $wv("reason_{$i}_title") }}</h3>
                @if($wv("reason_{$i}_desc") !== null)
                <p class="text-sm font-medium text-black/70 leading-relaxed">{{ $wv("reason_{$i}_desc") }}</p>
                @endif
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif

{{-- ── 4. TOPIK PENULISAN ──────────────────────────────────────── --}}
@if(!$topicS || $topicS->is_active)
<section class="py-24 bg-[#FFD200] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
        <div>
            @if($tv('title', 'Topik Penulisan') !== null)
            <h2 class="text-5xl font-black uppercase mb-6 text-[#3D0066]">
                {{ $tv('title', 'Topik Penulisan') }}
            </h2>
            @endif
            @if($tv('subtitle', 'Kami Menguasai Berbagai Niche Industri:') !== null)
            <p class="font-bold mb-10 text-xl border-b-4 border-black pb-2 inline-block text-black">
                {{ $tv('subtitle', 'Kami Menguasai Berbagai Niche Industri:') }}
            </p>
            @endif

            @php
                $topicIcons = [
                    1 => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/>',
                    2 => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>',
                    3 => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>',
                    4 => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>',
                    5 => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>',
                    6 => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.124V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>',
                    7 => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z"/>',
                    8 => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>',
                ];
            @endphp

            <div class="grid grid-cols-2 gap-y-4 gap-x-6">
                @for($i = 1; $i <= 8; $i++)
                    @php $topicLabel = $tv("topic_{$i}"); @endphp
                    @if($topicLabel !== null && $topicLabel !== '')
                    <div class="flex items-center gap-3 font-black uppercase group cursor-default">
                        <div class="w-6 h-6 text-black group-hover:text-[#E61E50] transition-colors flex-shrink-0">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="w-full h-full">
                                {!! $topicIcons[$i] ?? $topicIcons[1] !!}
                            </svg>
                        </div>
                        <span class="text-black border-b-2 border-transparent group-hover:border-black transition-all">{{ $topicLabel }}</span>
                    </div>
                    @endif
                @endfor
            </div>
        </div>

        <div class="relative mt-8 lg:mt-0">
            @if($topicS && !$topicS->isFieldHidden('image') && $topicS->get('image'))
                <div class="absolute inset-0 border-4 border-black translate-x-4 translate-y-4 bg-black/10"></div>
                <img src="{{ Storage::url($topicS->get('image')) }}" alt="Topik Penulisan"
                     class="relative w-full border-4 border-black shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] grayscale">
            @else
                <div class="absolute inset-0 border-4 border-black translate-x-4 translate-y-4 bg-black/10"></div>
                <img src="{{ asset('images/tulis2.png') }}" alt="Topik Penulisan"
                     class="relative w-full border-4 border-black shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] grayscale">
            @endif
        </div>
    </div>
</section>
@endif

{{-- ── 5. PAKET HARGA ───────────────────────────────────────────── --}}
@if(!$pricingS || $pricingS->is_active)
<section class="py-24 bg-[#1a88d1] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        @if($pv('title', 'Paket Harga Jasa Penulisan Artikel') !== null)
        <h2 class="text-4xl font-black uppercase mb-16 text-white italic tracking-tight">
            {{ $pv('title', 'Paket Harga Jasa Penulisan Artikel') }}
        </h2>
        @endif

        @php
            $checkTeal   = '<svg class="w-4 h-4 text-[#14b8a6] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
            $checkPurple = '<svg class="w-4 h-4 text-[#430A5D] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
            $checkBlue   = '<svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
            $ctaUrl      = ($pricingS && !$pricingS->isFieldHidden('cta_url') && $pricingS->get('cta_url'))
                           ? $pricingS->get('cta_url')
                           : 'https://wa.me/6287786000919';
            $ctaText     = $pv('cta_text', 'Pesan Sekarang') ?: 'Pesan Sekarang';
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto items-start">

            {{-- BASIC --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                @if($pv('basic_name', 'BASIC') !== null)
                <h3 class="text-2xl font-black text-[#14b8a6] uppercase mb-2">{{ $pv('basic_name', 'BASIC') }}</h3>
                @endif
                @if($pv('basic_price_ori') !== null && $pv('basic_price_ori') !== '')
                <div class="text-sm line-through text-red-500 font-bold mb-1">{{ $pv('basic_price_ori') }}</div>
                @endif
                @if($pv('basic_price', 'Rp 75.000') !== null)
                <div class="text-3xl font-black text-black mb-2">{{ $pv('basic_price', 'Rp 75.000') }}</div>
                @endif
                @if($pv('basic_words', '500') !== null)
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('basic_words', '500') }} Kata</div>
                @endif
                <ul class="text-[11px] font-black space-y-2 mb-8 text-left uppercase flex-1 text-black">
                    @php $hasBasicFeat = false; @endphp
                    @for($i = 1; $i <= 6; $i++)
                        @php $feat = $pv("basic_feature_{$i}"); @endphp
                        @if($feat !== null && $feat !== '')
                            @php $hasBasicFeat = true; @endphp
                            <li class="flex items-start gap-2">{!! $checkTeal !!} {{ $feat }}</li>
                        @endif
                    @endfor
                    @if(!$hasBasicFeat)
                        <li class="flex items-start gap-2">{!! $checkTeal !!} Artikel original</li>
                        <li class="flex items-start gap-2">{!! $checkTeal !!} Anti plagiat</li>
                        <li class="flex items-start gap-2">{!! $checkTeal !!} Riset topik</li>
                        <li class="flex items-start gap-2">{!! $checkTeal !!} Revisi 1x</li>
                        <li class="flex items-start gap-2">{!! $checkTeal !!} Format Word/PDF</li>
                    @endif
                </ul>
                <a href="{{ $ctaUrl }}"
                   class="mt-auto block w-full bg-[#14b8a6] text-white py-3 border-4 border-black font-black uppercase text-sm shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-center">
                    {{ $ctaText }}
                </a>
            </div>

            {{-- STANDARD --}}
            <div class="bg-[#FFD200] border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full relative lg:scale-105 z-10 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all mt-6 md:mt-0">
                @if($pv('standard_badge', 'TERPOPULER') !== null)
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-black text-white text-xs font-black px-4 py-1 border-2 border-white uppercase whitespace-nowrap">
                    {{ $pv('standard_badge', 'TERPOPULER') }}
                </div>
                @endif
                @if($pv('standard_name', 'STANDARD') !== null)
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">{{ $pv('standard_name', 'STANDARD') }}</h3>
                @endif
                @if($pv('standard_price_ori') !== null && $pv('standard_price_ori') !== '')
                <div class="text-sm line-through text-red-500 font-bold mb-1">{{ $pv('standard_price_ori') }}</div>
                @endif
                @if($pv('standard_price', 'Rp 150.000') !== null)
                <div class="text-3xl font-black text-black mb-2">{{ $pv('standard_price', 'Rp 150.000') }}</div>
                @endif
                @if($pv('standard_words', '1000') !== null)
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('standard_words', '1000') }} Kata</div>
                @endif
                <ul class="text-[11px] font-black space-y-2 mb-8 text-left uppercase flex-1 text-black">
                    @php $hasStdFeat = false; @endphp
                    @for($i = 1; $i <= 8; $i++)
                        @php $feat = $pv("standard_feature_{$i}"); @endphp
                        @if($feat !== null && $feat !== '')
                            @php $hasStdFeat = true; $isSeo = str_contains(strtolower($feat), 'seo') || str_contains(strtolower($feat), 'optim'); @endphp
                            <li class="flex items-start gap-2 {{ $isSeo ? 'text-blue-700' : '' }}">{!! $isSeo ? $checkBlue : $checkPurple !!} {{ $feat }}</li>
                        @endif
                    @endfor
                    @if(!$hasStdFeat)
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Artikel original</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Anti plagiat</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Riset kata kunci SEO</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Revisi 2x</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Format Word/PDF</li>
                        <li class="flex items-start gap-2 text-blue-700">{!! $checkBlue !!} Optimasi on-page SEO</li>
                    @endif
                </ul>
                <a href="{{ $ctaUrl }}"
                   class="mt-auto block w-full bg-black text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(67,10,93,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-center">
                    {{ $ctaText }}
                </a>
            </div>

            {{-- PRO --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all md:col-span-2 lg:col-span-1 mt-6 lg:mt-0">
                @if($pv('pro_name', 'PRO') !== null)
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">{{ $pv('pro_name', 'PRO') }}</h3>
                @endif
                @if($pv('pro_price_ori') !== null && $pv('pro_price_ori') !== '')
                <div class="text-sm line-through text-red-500 font-bold mb-1">{{ $pv('pro_price_ori') }}</div>
                @endif
                @if($pv('pro_price', 'Rp 275.000') !== null)
                <div class="text-3xl font-black text-black mb-2">{{ $pv('pro_price', 'Rp 275.000') }}</div>
                @endif
                @if($pv('pro_words', '2000') !== null)
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('pro_words', '2000') }} Kata</div>
                @endif
                <ul class="text-[11px] font-black space-y-2 mb-8 text-left uppercase flex-1 text-black">
                    @php $hasProFeat = false; @endphp
                    @for($i = 1; $i <= 10; $i++)
                        @php $feat = $pv("pro_feature_{$i}"); @endphp
                        @if($feat !== null && $feat !== '')
                            @php
                                $hasProFeat = true;
                                $isSeo = str_contains(strtolower($feat), 'seo')
                                      || str_contains(strtolower($feat), 'optim')
                                      || str_contains(strtolower($feat), 'internal')
                                      || str_contains(strtolower($feat), 'meta');
                            @endphp
                            <li class="flex items-start gap-2 {{ $isSeo ? 'text-blue-700' : '' }}">{!! $isSeo ? $checkBlue : $checkPurple !!} {{ $feat }}</li>
                        @endif
                    @endfor
                    @if(!$hasProFeat)
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Artikel original</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Anti plagiat</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Riset kata kunci SEO</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Revisi unlimited</li>
                        <li class="flex items-start gap-2">{!! $checkPurple !!} Format Word/PDF</li>
                        <li class="flex items-start gap-2 text-blue-700">{!! $checkBlue !!} Optimasi on-page SEO</li>
                        <li class="flex items-start gap-2 text-blue-700">{!! $checkBlue !!} Internal & external linking</li>
                        <li class="flex items-start gap-2 text-blue-700">{!! $checkBlue !!} Meta description</li>
                    @endif
                </ul>
                <a href="{{ $ctaUrl }}"
                   class="mt-auto block w-full bg-[#430A5D] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-center">
                    {{ $ctaText }}
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ── 6. CTA FINAL ────────────────────────────────────────────── --}}
@if(!$ctaS || $ctaS->is_active)
<footer class="py-20 bg-black text-white text-center border-t-8 border-black">
    @if($cv('tagline', 'Siap Punya Konten yang Merajai Google?') !== null)
    <div class="inline-block p-4 border-4 border-dashed border-[#FFD200] mb-8 animate-pulse">
        <span class="font-black text-xl uppercase italic text-[#FFD200]">
            {{ $cv('tagline', 'Siap Punya Konten yang Merajai Google?') }}
        </span>
    </div>
    <br>
    @endif
    @if($cv('title', 'SIAP PUNYA KONTEN BERKUALITAS?') !== null)
    <h2 class="text-4xl md:text-5xl font-black uppercase mb-8 italic text-[#FFD200] tracking-tight">
        {{ $cv('title', 'SIAP PUNYA KONTEN BERKUALITAS?') }}
    </h2>
    @endif
    <a href="{{ ($ctaS && !$ctaS->isFieldHidden('cta_url') && $ctaS->get('cta_url')) ? $ctaS->get('cta_url') : 'https://wa.me/6287786000919' }}"
       class="inline-flex items-center gap-4 bg-white text-black px-8 py-6 md:px-16 md:py-8 border-4 border-black font-black text-xl md:text-3xl uppercase shadow-[12px_12px_0px_0px_rgba(250,204,21,1)] hover:bg-[#3B82F6] hover:text-white hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all italic">
        {{ $cv('cta_text', 'PESAN ARTIKEL SEKARANG') ?: 'PESAN ARTIKEL SEKARANG' }}
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
        </svg>
    </a>
</footer>
@endif

@endsection