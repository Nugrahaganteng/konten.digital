@extends('layouts.app')

@section('title', 'Jasa Press Release Media Online Nasional - Konten Digital')

@section('content')

@php
    // ── Load sections ────────────────────────────────────────────────
    $heroS    = $sections->get('hero');
    $whyS     = $sections->get('why_pr');
    $pricingS = $sections->get('pricing');
    $ctaS     = $sections->get('cta');

    // ── Helper closures ───────────────────────────────────────────────
    $hv  = fn($k, $d = '') => $heroS    ? ($heroS->get($k)    ?: $d) : $d;
    $wv  = fn($k, $d = '') => $whyS     ? ($whyS->get($k)     ?: $d) : $d;
    $pv  = fn($k, $d = '') => $pricingS ? ($pricingS->get($k) ?: $d) : $d;
    $cv  = fn($k, $d = '') => $ctaS     ? ($ctaS->get($k)     ?: $d) : $d;
@endphp

{{-- ── 1. HERO ─────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 overflow-hidden border-b-8 border-black bg-[#FFD200]">
    <div class="absolute bottom-10 right-10 opacity-40 animate-pulse hidden md:block">
        <svg class="w-24 h-24 text-[#E61E50]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.13 14.71L8.5 10.08L10 8.58L14.63 13.21L13.13 14.71M16 11L11.5 6.5L12.58 5.42C13.08 4.92 13.9 4.92 14.41 5.42L18.58 9.58C19.08 10.09 19.08 10.91 18.58 11.42L16 11M5.41 18.59L2 22L5.41 18.59C5.91 19.09 6.74 19.09 7.24 18.59L11.38 14.45L6.75 9.82L2.61 13.96C2.11 14.46 2.11 15.29 2.61 15.79L5.41 18.59Z"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center relative z-10">
        <div class="space-y-6">
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PRESS RELEASE') }}
                </span>
            </div>

            <h1 class="text-6xl md:text-7xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                {{ $hv('title_line1', 'BERSAMA') }}<br>
                {{ $hv('title_line2', 'WARTAWAN DARI') }}<br>
                <span class="bg-black text-[#FFD200] px-2 italic">
                    {{ $hv('title_line3', 'MEDIA TERNAMA') }}
                </span>
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-lg font-bold text-black italic">
                    "{{ $hv('quote', 'Ubah statement menjadi berita nasional dalam sekejap.') }}"
                </p>
            </div>

            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">
                {{ $hv('description', 'Selain membantu mengundang wartawan/media untuk Anda, kami menangani pembuatan artikel press release, undangan media, distribusi berita, hingga monitoring pemuatan berita secara tuntas.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-block px-10 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG →') }}
            </a>
        </div>

        <div class="relative flex justify-center items-center h-[550px]">
            <div class="absolute w-[420px] h-[430px] border-[6px] border-black rounded-[40px] -translate-x-6 -translate-y-4"></div>
            <div class="relative w-[400px] h-[400px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Press Release"
                         class="absolute bottom-0 w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-6">
                @else
                    <img src="/images/press1.png" alt="Press Release"
                         class="absolute bottom-0 w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-6">
                @endif
                <div class="absolute top-10 -right-16 bg-white border-4 border-black rounded-full px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-20">
                    <span class="font-black text-sm text-black uppercase">GOOD NEWS!!!</span>
                    <div class="absolute -bottom-2 left-4 w-4 h-4 bg-white border-b-4 border-r-4 border-black rotate-45"></div>
                </div>
                <div class="absolute -top-12 -right-8 bg-[#3D0066] text-white border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-30">
                    ✦ PRESS RELEASE
                </div>
                <div class="absolute -bottom-10 -left-12 bg-white text-black border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 z-30">
                    ✦ LAUNCHING PRODUK
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── 2. MENGAPA HARUS PRESS RELEASE ──────────────────────────── --}}
<section class="py-24 bg-[#1a88d1] border-b-4 border-black text-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black uppercase italic mb-4">
                {{ $wv('title', 'Mengapa Harus Press Release?') }}
            </h2>
            <p class="font-bold">{{ $wv('subtitle', 'Press release memiliki peran penting dalam strategi pemasaran dan branding suatu perusahaan.') }}</p>
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

{{-- ── 3. PAKET HARGA ───────────────────────────────────────────── --}}
<section class="py-24 bg-[#1a88d1] border-y-4 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-black uppercase mb-16 text-white italic">
            {{ $pv('title', 'Paket Harga Jasa Press Release Media Online') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            {{-- BRONZE --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-purple-600 uppercase mb-2">BRONZE</h3>
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('bronze_price_ori', 'Rp 3.750.000,-') }}</div>
                <div class="text-3xl font-black mb-6">{{ $pv('bronze_price', 'Rp 3.000.000') }}</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di {{ $pv('bronze_media_count', '3') }} media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-gradient-to-r from-cyan-400 to-purple-500 text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- SILVER --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-gray-500 uppercase mb-2">SILVER</h3>
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('silver_price_ori', 'Rp 5.750.000,-') }}</div>
                <div class="text-3xl font-black mb-6">{{ $pv('silver_price', 'Rp 4.750.000') }}</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di {{ $pv('silver_media_count', '5') }} media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-[#333] text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- GOLD --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-yellow-600 uppercase mb-2">GOLD</h3>
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('gold_price_ori', 'Rp 11.000.000,-') }}</div>
                <div class="text-3xl font-black mb-6">{{ $pv('gold_price', 'Rp 9.000.000') }}</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di {{ $pv('gold_media_count', '10') }} media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-yellow-600 text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- PLATINUM --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-blue-800 uppercase mb-2">PLATINUM</h3>
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('platinum_price_ori', 'Rp 15.750.000,-') }}</div>
                <div class="text-3xl font-black mb-6">{{ $pv('platinum_price', 'Rp 12.750.000') }}</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di {{ $pv('platinum_media_count', '15') }} media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-gradient-to-r from-cyan-400 to-blue-700 text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">
                    Konsultasi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── 4. CTA FOOTER ────────────────────────────────────────────── --}}
<footer class="py-20 bg-black text-white text-center border-t-4 border-black">
    <h2 class="text-5xl font-black uppercase mb-8 italic text-yellow-400">
        {{ $cv('title', 'SIAP UNTUK GO NATIONAL?') }}
    </h2>
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="inline-block bg-white text-black px-12 py-6 font-black text-2xl uppercase shadow-[8px_8px_0px_0px_rgba(250,204,21,1)]">
        {{ $cv('cta_text', 'HUBUNGI KAMI SEKARANG →') }}
    </a>
</footer>

@endsection