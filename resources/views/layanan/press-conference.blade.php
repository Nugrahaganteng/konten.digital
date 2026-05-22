@extends('layouts.app')

@section('title', 'Jasa Press Conference / Konferensi Pers - HNP Communications.id')

@section('content')

@php
    $heroS    = $sections->get('hero');
    $whyS     = $sections->get('why_pc');
    $pricingS = $sections->get('pricing');
    $ctaS     = $sections->get('cta');

    $hv = fn($k, $d = '') => $heroS    ? ($heroS->get($k)    ?: $d) : $d;
    $wv = fn($k, $d = '') => $whyS     ? ($whyS->get($k)     ?: $d) : $d;
    $pv = fn($k, $d = '') => $pricingS ? ($pricingS->get($k) ?: $d) : $d;
    $cv = fn($k, $d = '') => $ctaS     ? ($ctaS->get($k)     ?: $d) : $d;
@endphp

{{-- ── HERO ──────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 overflow-hidden border-b-8 border-black bg-[#FFD200]">
    <div class="absolute bottom-10 right-10 opacity-40 animate-pulse hidden md:block">
        <svg class="w-24 h-24 text-[#E61E50]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17,12V3A1,1 0 0,0 16,2H3A1,1 0 0,0 2,3V17L6,13H16A1,1 0 0,0 17,12M21,6H19V15H6V17A1,1 0 0,0 7,18H18L22,22V7A1,1 0 0,0 21,6Z"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center relative z-10">
        <div class="space-y-6">
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PRESS CONFERENCE') }}
                </span>
            </div>

            <h1 class="text-6xl md:text-7xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                {{ $hv('title_line1', 'KONFERENSI PERS') }}<br>
                {{ $hv('title_line2', 'PROFESIONAL &') }}<br>
                <span class="bg-black text-[#FFD200] px-2 italic">
                    {{ $hv('title_line3', 'BERGARANSI MEDIA') }}
                </span>
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-lg font-bold text-black italic">
                    "{{ $hv('quote', 'Hadirkan wartawan media ternama ke acara brand Anda.') }}"
                </p>
            </div>

            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">
                {{ $hv('description', 'Kami mengelola seluruh proses konferensi pers Anda, mulai dari undangan media hingga distribusi siaran pers pasca acara.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-block px-10 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG →') }}
            </a>
        </div>

        <div class="relative flex justify-center items-center h-[480px]">
            <div class="absolute w-[400px] h-[400px] border-[6px] border-black rounded-[40px] -translate-x-6 -translate-y-4"></div>
            <div class="relative w-[380px] h-[380px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Press Conference"
                         class="absolute bottom-0 w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-6">
                @else
                    <div class="flex flex-col items-center justify-center text-white">
                        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"/>
                        </svg>
                        <span class="font-black text-xl uppercase">PRESS CONF</span>
                    </div>
                @endif
                <div class="absolute top-10 -right-16 bg-white border-4 border-black rounded-full px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-20">
                    <span class="font-black text-sm text-black uppercase">LIVE NOW!</span>
                    <div class="absolute -bottom-2 left-4 w-4 h-4 bg-white border-b-4 border-r-4 border-black rotate-45"></div>
                </div>
                <div class="absolute -top-12 -right-8 bg-[#3D0066] text-white border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-30">
                    ✦ PRESS CONFERENCE
                </div>
                <div class="absolute -bottom-10 -left-12 bg-white text-black border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 z-30">
                    ✦ MEDIA GATHERING
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MENGAPA PRESS CONFERENCE ──────────────────────────────── --}}
<section class="py-24 bg-[#1a88d1] border-b-4 border-black text-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black uppercase italic mb-4">
                {{ $wv('title', 'Mengapa Harus Press Conference?') }}
            </h2>
            <p class="font-bold">{{ $wv('subtitle', 'Press conference adalah cara paling efektif menyampaikan pesan brand ke media sekaligus.') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            @foreach([1,2,3] as $i)
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span>
                    {{ $wv("reason_{$i}_title", '') }}
                </h3>
                <p class="text-sm font-medium leading-relaxed">{{ $wv("reason_{$i}_desc", '') }}</p>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @foreach([4,5] as $i)
            @if($wv("reason_{$i}_title", ''))
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span>
                    {{ $wv("reason_{$i}_title", '') }}
                </h3>
                <p class="text-sm font-medium leading-relaxed">{{ $wv("reason_{$i}_desc", '') }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── PAKET HARGA ───────────────────────────────────────────── --}}
<section class="py-24 bg-[#1a88d1] border-y-4 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-black uppercase mb-16 text-white italic">
            {{ $pv('title', 'Paket Harga Jasa Press Conference') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            {{-- BASIC --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#14b8a6] uppercase mb-2">BASIC</h3>
                @if($pv('basic_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('basic_price_ori', 'Rp 5.000.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('basic_price', 'Rp 4.000.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('basic_media_count', '10') }} Media</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Undangan wartawan</li>
                    <li>✔️ Distribusi press release</li>
                    <li>✔️ Liputan {{ $pv('basic_media_count', '10') }} media</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Laporan URL</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-[#14b8a6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- PRO --}}
            <div class="bg-[#FFD217] border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full relative">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-black text-white text-xs font-black px-4 py-1 uppercase">TERPOPULER</div>
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">PRO</h3>
                @if($pv('pro_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('pro_price_ori', 'Rp 10.000.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('pro_price', 'Rp 8.500.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('pro_media_count', '25') }} Media</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Undangan wartawan</li>
                    <li>✔️ Distribusi press release</li>
                    <li>✔️ Liputan {{ $pv('pro_media_count', '25') }} media</li>
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

            {{-- VIP --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">VIP</h3>
                @if($pv('vip_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('vip_price_ori', 'Rp 20.000.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('vip_price', 'Rp 17.000.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('vip_media_count', '50') }} Media</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Undangan wartawan</li>
                    <li>✔️ Distribusi press release</li>
                    <li>✔️ Liputan {{ $pv('vip_media_count', '50') }} media</li>
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

{{-- ── CTA FINAL ────────────────────────────────────────────── --}}
<footer class="py-20 bg-black text-white text-center border-t-4 border-black">
    <h2 class="text-5xl font-black uppercase mb-8 italic text-yellow-400">
        {{ $cv('title', 'SIAP GELAR PRESS CONFERENCE?') }}
    </h2>
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="inline-block bg-white text-black px-12 py-6 font-black text-2xl uppercase shadow-[8px_8px_0px_0px_rgba(250,204,21,1)]">
        {{ $cv('cta_text', 'HUBUNGI KAMI SEKARANG →') }}
    </a>
</footer>

@endsection