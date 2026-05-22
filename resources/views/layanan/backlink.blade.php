@extends('layouts.app')

@section('title', 'Jasa Backlink Media Nasional - HNP Communications.id')

@section('content')

@php
    $heroS    = $sections->get('hero');
    $whyS     = $sections->get('why_backlink');
    $pricingS = $sections->get('pricing');
    $ctaS     = $sections->get('cta');

    $hv = fn($k, $d = '') => $heroS    ? ($heroS->get($k)    ?: $d) : $d;
    $wv = fn($k, $d = '') => $whyS     ? ($whyS->get($k)     ?: $d) : $d;
    $pv = fn($k, $d = '') => $pricingS ? ($pricingS->get($k) ?: $d) : $d;
    $cv = fn($k, $d = '') => $ctaS     ? ($ctaS->get($k)     ?: $d) : $d;
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
            {{ $hv('title', 'BACKLINK') }}<span class="text-white">.ID</span>
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

{{-- ── MENGAPA BACKLINK PENTING ──────────────────────────────── --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-white uppercase italic mb-4">
                {{ $wv('title', 'Mengapa Backlink Media Penting?') }}
            </h2>
            <p class="text-white font-bold text-lg">{{ $wv('subtitle', 'Backlink dari media terpercaya adalah sinyal kuat untuk Google.') }}</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
                $benefitIcons = [
                    'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2 M22 21v-2a4 4 0 0 0-3-3.87 M16 3.13a4 4 0 0 1 0 7.75',
                    'M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z',
                    'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z',
                    'M13 2L3 14h9l-1 8 10-12h-9l1-8z',
                    'M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6',
                ];
            @endphp
            @foreach([1,2,3,4,5] as $i)
            @php $title = $wv("reason_{$i}_title", ''); @endphp
            @if($title)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="{{ $benefitIcons[$i-1] ?? $benefitIcons[0] }}"/>
                    </svg>
                </div>
                <h3 class="text-xl font-black uppercase mb-4">{{ $title }}</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">{{ $wv("reason_{$i}_desc", '') }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── PAKET HARGA ───────────────────────────────────────────── --}}
@if($pricingS && $pricingS->get('title'))
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-black uppercase mb-16 italic text-[#430A5D]">
            {{ $pv('title', 'Paket Harga Jasa Backlink Media Nasional') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            {{-- STARTER --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#3B82F6] uppercase mb-2">STARTER</h3>
                @if($pv('starter_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('starter_price_ori', 'Rp 500.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('starter_price', 'Rp 350.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('starter_count', '1') }} Link</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Backlink do-follow</li>
                    <li>✔️ Dari media nasional</li>
                    <li>✔️ Tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Laporan URL</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-[#3B82F6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- BASIC --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-gray-500 uppercase mb-2">BASIC</h3>
                @if($pv('basic_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('basic_price_ori', 'Rp 2.250.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('basic_price', 'Rp 1.750.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('basic_count', '5') }} Link</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Backlink do-follow</li>
                    <li>✔️ Dari media nasional</li>
                    <li>✔️ Tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Laporan URL</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-[#333] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- PRO --}}
            <div class="bg-[#FFD217] border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full relative">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-black text-white text-xs font-black px-4 py-1 uppercase">TERPOPULER</div>
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">PRO</h3>
                @if($pv('pro_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('pro_price_ori', 'Rp 4.000.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('pro_price', 'Rp 3.250.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('pro_count', '10') }} Link</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Backlink do-follow</li>
                    <li>✔️ Dari media nasional</li>
                    <li>✔️ Tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Laporan URL</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                    <li class="text-blue-600">✔️ Prioritas pengerjaan</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-black text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(67,10,93,1)] hover:shadow-none transition-all">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- ENTERPRISE --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">ENTERPRISE</h3>
                @if($pv('enterprise_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('enterprise_price_ori', 'Rp 7.500.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('enterprise_price', 'Rp 6.000.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('enterprise_count', '20') }} Link</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Backlink do-follow</li>
                    <li>✔️ Dari media nasional</li>
                    <li>✔️ Tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Laporan URL</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                    <li class="text-blue-600">✔️ Prioritas pengerjaan</li>
                    <li class="text-blue-600">✔️ Dedicated account manager</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-gradient-to-r from-[#430A5D] to-[#3B82F6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Konsultasi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ── CTA FINAL ────────────────────────────────────────────── --}}
<section class="py-24 bg-black text-center">
    <h2 class="text-4xl md:text-6xl font-black text-[#F2B038] uppercase mb-10 leading-tight">
        {{ $cv('title', 'SIAP BOOST SEO WEBSITE KAMU?') }}
    </h2>
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="inline-block px-12 py-6 bg-white text-black font-black text-2xl border-4 border-[#F2B038] hover:bg-[#F2B038] transition-all uppercase shadow-[8px_8px_0px_0px_rgba(242,176,56,1)]">
        {{ $cv('cta_text', 'Hubungi Kami Sekarang →') }}
    </a>
</section>

@endsection