@extends('layouts.app')

@section('title', 'Jasa Penulisan Artikel SEO - HNP Communications.id')

@section('content')

@php
    $heroS    = $sections->get('hero');
    $whyS     = $sections->get('why_artikel');
    $pricingS = $sections->get('pricing');
    $ctaS     = $sections->get('cta');

    $hv = fn($k, $d = '') => $heroS    ? ($heroS->get($k)    ?: $d) : $d;
    $wv = fn($k, $d = '') => $whyS     ? ($whyS->get($k)     ?: $d) : $d;
    $pv = fn($k, $d = '') => $pricingS ? ($pricingS->get($k) ?: $d) : $d;
    $cv = fn($k, $d = '') => $ctaS     ? ($ctaS->get($k)     ?: $d) : $d;
@endphp

{{-- ── HERO ──────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 overflow-hidden border-b-8 border-black bg-[#FFD200]">
    <div class="absolute top-20 right-16 w-24 h-24 bg-[#430A5D] opacity-10 rounded-full animate-pulse hidden md:block"></div>
    <div class="absolute bottom-16 left-16 w-16 h-16 border-4 border-[#430A5D] opacity-10 rotate-45 animate-bounce-slow hidden md:block"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center relative z-10">
        <div class="space-y-6">
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PENULISAN ARTIKEL') }}
                </span>
            </div>

            <h1 class="text-6xl md:text-7xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                {{ $hv('title_line1', 'KONTEN ARTIKEL') }}<br>
                {{ $hv('title_line2', 'BERKUALITAS &') }}<br>
                <span class="bg-black text-[#FFD200] px-2 italic">
                    {{ $hv('title_line3', 'SEO FRIENDLY') }}
                </span>
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-lg font-bold text-black italic">
                    "{{ $hv('quote', 'Artikel yang menarik pembaca sekaligus disukai Google.') }}"
                </p>
            </div>

            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">
                {{ $hv('description', 'Tim penulis berpengalaman kami siap menghasilkan artikel informatif, engaging, dan teroptimasi untuk kebutuhan website, blog, maupun media Anda.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-block px-10 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG →') }}
            </a>
        </div>

        <div class="relative flex justify-center items-center h-[480px]">
            <div class="absolute w-[400px] h-[400px] border-[6px] border-black rounded-[40px] -translate-x-6 -translate-y-4"></div>
            <div class="relative w-[380px] h-[380px] bg-[#14b8a6] border-[6px] border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Penulisan Artikel"
                         class="absolute bottom-0 w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-6">
                @else
                    <div class="flex flex-col items-center justify-center text-white">
                        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        <span class="font-black text-xl uppercase">ARTIKEL</span>
                    </div>
                @endif
                <div class="absolute top-10 -right-16 bg-white border-4 border-black rounded-full px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-20">
                    <span class="font-black text-sm text-black uppercase">SEO READY!</span>
                    <div class="absolute -bottom-2 left-4 w-4 h-4 bg-white border-b-4 border-r-4 border-black rotate-45"></div>
                </div>
                <div class="absolute -top-12 -right-8 bg-[#3D0066] text-white border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-30">
                    ✦ PENULISAN ARTIKEL
                </div>
                <div class="absolute -bottom-10 -left-12 bg-white text-black border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 z-30">
                    ✦ ANTI PLAGIAT
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow { 0%,100%{transform:rotate(45deg) translateY(0)}50%{transform:rotate(45deg) translateY(-20px)} }
    .animate-bounce-slow{animation:bounce-slow 5s ease-in-out infinite}
</style>

{{-- ── MENGAPA JASA PENULISAN ARTIKEL ───────────────────────── --}}
<section class="py-24 bg-[#1a88d1] border-b-4 border-black text-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black uppercase italic mb-4">
                {{ $wv('title', 'Mengapa Harus Jasa Penulisan Artikel?') }}
            </h2>
            <p class="font-bold">{{ $wv('subtitle', 'Konten artikel yang baik adalah investasi jangka panjang untuk traffic organik.') }}</p>
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
            {{ $pv('title', 'Paket Harga Jasa Penulisan Artikel') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            {{-- BASIC --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#14b8a6] uppercase mb-2">BASIC</h3>
                @if($pv('basic_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('basic_price_ori', 'Rp 100.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('basic_price', 'Rp 75.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('basic_words', '500') }} Kata</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Artikel original</li>
                    <li>✔️ Anti plagiat</li>
                    <li>✔️ Riset topik</li>
                    <li>✔️ Revisi 1x</li>
                    <li>✔️ Format Word/PDF</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-[#14b8a6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Pesan Sekarang
                </a>
            </div>

            {{-- STANDARD --}}
            <div class="bg-[#FFD217] border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full relative">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-black text-white text-xs font-black px-4 py-1 uppercase">TERPOPULER</div>
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">STANDARD</h3>
                @if($pv('standard_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('standard_price_ori', 'Rp 200.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('standard_price', 'Rp 150.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('standard_words', '1000') }} Kata</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Artikel original</li>
                    <li>✔️ Anti plagiat</li>
                    <li>✔️ Riset kata kunci SEO</li>
                    <li>✔️ Revisi 2x</li>
                    <li>✔️ Format Word/PDF</li>
                    <li class="text-blue-600">✔️ Optimasi on-page SEO</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-black text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(67,10,93,1)] hover:shadow-none transition-all">
                    Pesan Sekarang
                </a>
            </div>

            {{-- PRO --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">PRO</h3>
                @if($pv('pro_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('pro_price_ori', 'Rp 350.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('pro_price', 'Rp 275.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('pro_words', '2000') }} Kata</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Artikel original</li>
                    <li>✔️ Anti plagiat</li>
                    <li>✔️ Riset kata kunci SEO</li>
                    <li>✔️ Revisi unlimited</li>
                    <li>✔️ Format Word/PDF</li>
                    <li class="text-blue-600">✔️ Optimasi on-page SEO</li>
                    <li class="text-blue-600">✔️ Internal & external linking</li>
                    <li class="text-blue-600">✔️ Meta description</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-gradient-to-r from-[#430A5D] to-[#3B82F6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA FINAL ────────────────────────────────────────────── --}}
<footer class="py-20 bg-black text-white text-center border-t-4 border-black">
    <h2 class="text-5xl font-black uppercase mb-8 italic text-yellow-400">
        {{ $cv('title', 'SIAP PUNYA KONTEN BERKUALITAS?') }}
    </h2>
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="inline-block bg-white text-black px-12 py-6 font-black text-2xl uppercase shadow-[8px_8px_0px_0px_rgba(250,204,21,1)]">
        {{ $cv('cta_text', 'PESAN ARTIKEL SEKARANG →') }}
    </a>
</footer>

@endsection