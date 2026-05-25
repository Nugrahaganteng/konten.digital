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
<section class="relative pt-24 pb-24 bg-[#FFD200] overflow-hidden border-b-8 border-black">

    {{-- Dekoratif: star kiri atas --}}
    <div class="absolute top-10 left-10 opacity-20 animate-bounce hidden md:block text-[#3D0066]">
        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
        </svg>
    </div>
    {{-- Dekoratif: megaphone kanan bawah --}}
    <!-- <div class="absolute bottom-20 right-10 opacity-20 animate-pulse hidden md:block text-[#E61E50]">
        <svg class="w-20 h-20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46"/>
        </svg>
    </div> -->

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="reveal-text space-y-6">
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#3D0066] transform -rotate-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:rotate-0 transition-transform cursor-default">
                <span class="text-white font-black text-sm tracking-widest uppercase italic">
                    {{ $hv('badge_text', '✦ JASA PRESS CONFERENCE') }}
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-[#3D0066] leading-none uppercase tracking-tighter drop-shadow-sm">
                {{ $hv('title_line1', 'KONFERENSI PERS') }}<br>
                {{ $hv('title_line2', 'PROFESIONAL &') }}<br>
                <span class="bg-black text-[#FFD200] px-3 inline-block transform skew-x-2 italic">
                    {{ $hv('title_line3', 'BERGARANSI MEDIA') }}
                </span>
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-xl font-bold text-black/80 italic">
                    "{{ $hv('quote', 'Hadirkan wartawan media ternama ke acara brand Anda.') }}"
                </p>
            </div>

            <p class="text-lg font-bold text-black/70 leading-relaxed max-w-md">
                {{ $hv('description', 'Kami mengelola seluruh proses konferensi pers Anda, mulai dari undangan media hingga distribusi siaran pers pasca acara.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-flex items-center gap-3 px-10 py-5 bg-black text-[#FFD200] font-black text-2xl border-4 border-black hover:bg-[#3D0066] hover:text-white transition-all transform hover:-translate-y-2 active:translate-y-0 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tight">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG') }}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

        <div class="relative group">
            {{-- Lingkaran Dekoratif Belakang --}}
            <div class="absolute -z-10 top-10 right-10 w-full h-full bg-[#E61E50] border-4 border-black rounded-full shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] group-hover:scale-105 transition-transform duration-500"></div>

            {{-- Foto dari public/images --}}
            <div class="overflow-hidden border-4 border-black rounded-2xl shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Press Conference"
                         class="w-full h-auto grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                @else
                    <img src="{{ asset('images/wartawan.png') }}" alt="Press Conference"
                         class="w-full h-auto grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                @endif
            </div>

            {{-- Floating Badge Kiri Bawah --}}
            <div class="absolute -bottom-6 -left-6 bg-white border-4 border-black px-4 py-3 font-black transform rotate-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase text-sm animate-float flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                </svg>
                LIVE NOW!
            </div>
            {{-- Floating Badge Kanan Atas --}}
            <div class="absolute -top-6 -right-6 bg-[#3D0066] text-white border-4 border-black px-4 py-3 font-black transform -rotate-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase text-sm animate-float-delayed flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"/>
                </svg>
                PRESS CONFERENCE
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(3deg); }
        50% { transform: translateY(-10px) rotate(5deg); }
    }
    @keyframes float-delayed {
        0%, 100% { transform: translateY(0) rotate(-3deg); }
        50% { transform: translateY(-15px) rotate(-1deg); }
    }
    .animate-float { animation: float 3s ease-in-out infinite; }
    .animate-float-delayed { animation: float-delayed 4s ease-in-out infinite; }
    .reveal-text { animation: reveal 0.8s cubic-bezier(0.77, 0, 0.175, 1); }
    @keyframes reveal {
        0% { opacity: 0; transform: translateX(-30px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        display: inline-flex;
        animation: marquee 30s linear infinite;
    }
</style>

{{-- ── MARQUEE LOGO MEDIA ────────────────────────────────────── --}}
<div class="bg-black py-6 border-b-8 border-black overflow-hidden flex flex-nowrap">
    <div class="flex gap-12 items-center animate-marquee whitespace-nowrap px-4 opacity-70 hover:opacity-100 transition-all cursor-default">
        <span class="text-white font-black text-2xl mx-8 uppercase">KR JOGJA</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">TRIBUN JOGJA</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">RADAR JOGJA</span>
        <span class="text-[#3B82F6] font-black text-2xl mx-8 uppercase italic">DETIK.COM</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">KOMPAS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">INDO MEDIA</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">SUARA.COM</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">OKEZONE</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TVONE NEWS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">LIPUTAN 6</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TRIBUN NEWS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">JAWA POS</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TIMES NEWS</span>
        {{-- Duplicate untuk loop tanpa putus --}}
        <span class="text-white font-black text-2xl mx-8 uppercase">KR JOGJA</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">TRIBUN JOGJA</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">RADAR JOGJA</span>
        <span class="text-[#3B82F6] font-black text-2xl mx-8 uppercase italic">DETIK.COM</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">KOMPAS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">INDO MEDIA</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">SUARA.COM</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">OKEZONE</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TVONE NEWS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">LIPUTAN 6</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TRIBUN NEWS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">JAWA POS</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TIMES NEWS</span>
    </div>
</div>

{{-- ── MENGAPA PRESS CONFERENCE ──────────────────────────────── --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-6xl font-black uppercase italic mb-6">
                {{ $wv('title', 'Mengapa Harus Press Conference?') }}
            </h2>
            <p class="max-w-4xl mx-auto font-bold text-lg leading-relaxed">
                {{ $wv('subtitle', 'Press conference adalah cara paling efektif menyampaikan pesan brand ke media sekaligus.') }}
            </p>
        </div>

        @php
            $whyIcons = [
                1 => '<path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46"/>',
                2 => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>',
                3 => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>',
                4 => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>',
                5 => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>',
            ];
        @endphp

        <div class="grid md:grid-cols-3 gap-8">
            @foreach([1,2,3,4,5] as $i)
            @if($wv("reason_{$i}_title", ''))
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-black group hover:bg-[#FFD200] transition-colors">
                <div class="w-12 h-12 mb-4 text-[#3B82F6] group-hover:text-black group-hover:scale-125 transition-all">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="w-full h-full">
                        {!! $whyIcons[$i] !!}
                    </svg>
                </div>
                <h3 class="text-xl font-black uppercase mb-3">{{ $wv("reason_{$i}_title", '') }}</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">{{ $wv("reason_{$i}_desc", '') }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── SIAPA SAJA ────────────────────────────────────────────── --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
        <div class="grid grid-cols-2 gap-4">
            <img src="{{ asset('images/pres1.jpg') }}"
                 class="border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 aspect-video object-cover w-full">
            <img src="{{ asset('images/pres2.jpg') }}"
                 class="border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform rotate-2 mt-8 aspect-video object-cover w-full">
        </div>
        <div>
            <h2 class="text-4xl font-black uppercase mb-8 leading-tight">Siapa Saja yang Dapat Menggunakan Jasa Kami?</h2>
            @php
                $users = [
                    ['label' => 'Perusahaan',           'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>'],
                    ['label' => 'Pengusaha / Pebisnis', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>'],
                    ['label' => 'Perguruan Tinggi',     'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>'],
                    ['label' => 'Komunitas',            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>'],
                    ['label' => 'Instansi Pemerintah',  'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/>'],
                    ['label' => 'Selebriti',            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>'],
                    ['label' => 'Content Creator',      'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c-.621 0-1.125.504-1.125 1.125m0 0c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125"/>'],
                    ['label' => 'Organisasi Sosial',    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>'],
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($users as $user)
                <div class="flex items-center gap-3 font-black text-base p-3 border-2 border-black bg-[#FFD200] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] group hover:bg-black hover:text-white transition-all">
                    <div class="flex-shrink-0 w-8 h-8 text-black group-hover:text-[#FFD200] transition-colors">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="w-full h-full">
                            {!! $user['icon'] !!}
                        </svg>
                    </div>
                    {{ $user['label'] }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── APA YANG PERLU DISIAPKAN ─────────────────────────────── --}}
<section class="py-24 bg-black text-white overflow-hidden border-b-8 border-black">
    <div class="max-w-5xl mx-auto px-6 relative">
        <div class="absolute -top-10 -right-10 text-9xl opacity-10 font-black select-none">PREP</div>
        <h2 class="text-4xl font-black uppercase mb-12 text-center text-[#FFD200]">Apa yang Perlu Disiapkan?</h2>

        @php
            $preps = [
                ['text' => 'Menyiapkan ruang press conference (Hotel, Meeting Room, atau Event Hall).', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>'],
                ['text' => 'Menetapkan Narasumber & Moderator utama.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>'],
                ['text' => 'Menyiapkan Key Points atau informasi inti yang akan disampaikan.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>'],
                ['text' => 'Fasilitas teknis pendukung (Meja, Sound System, Mic, dll).', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"/>'],
            ];
        @endphp

        <div class="space-y-6">
            @foreach($preps as $index => $prep)
            <div class="flex gap-6 items-start p-6 border-4 border-[#3B82F6] bg-white text-black shadow-[8px_8px_0px_0px_#3B82F6] group">
                <div class="flex-shrink-0 flex flex-col items-center gap-2">
                    <span class="bg-black text-white w-10 h-10 flex items-center justify-center font-black border-2 border-white group-hover:rotate-12 transition-transform text-sm">{{ $index + 1 }}</span>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 text-[#3B82F6] flex-shrink-0 mt-0.5">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="w-full h-full">
                            {!! $prep['icon'] !!}
                        </svg>
                    </div>
                    <p class="font-black text-lg">{{ $prep['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── APA YANG KAMI KERJAKAN ───────────────────────────────── --}}
<section class="py-24 bg-[#FFD200] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-center uppercase mb-16 italic underline decoration-black">
            Apa Saja yang Kami Kerjakan?
        </h2>

        @php
            $works = [
                ['label' => 'Mengatur persiapan & mengundang media.',        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>'],
                ['label' => 'Distribusi Press Release ke Jaringan Media.',   'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/>'],
                ['label' => 'Pembuatan naskah Press Release profesional.',   'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>'],
                ['label' => 'Media monitoring (Follow up penayangan).',      'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                ['label' => 'Report Link URL & dokumentasi berita.',         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>'],
                ['label' => 'Konsultasi strategi media.',                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>'],
            ];
        @endphp

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($works as $work)
            <div class="flex items-center gap-6 p-8 bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:bg-[#3B82F6] hover:text-white transition-all group">
                <div class="w-10 h-10 text-black group-hover:text-white flex-shrink-0 transition-colors group-hover:scale-110 transform">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="w-full h-full">
                        {!! $work['icon'] !!}
                    </svg>
                </div>
                <p class="font-black text-lg uppercase leading-tight">{{ $work['label'] }}</p>
            </div>
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
                    @php $checkIcon = '<svg class="w-4 h-4 text-[#14b8a6] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>'; @endphp
                    <li class="flex items-start gap-2">{!! $checkIcon !!} Undangan wartawan</li>
                    <li class="flex items-start gap-2">{!! $checkIcon !!} Distribusi press release</li>
                    <li class="flex items-start gap-2">{!! $checkIcon !!} Liputan {{ $pv('basic_media_count', '10') }} media</li>
                    <li class="flex items-start gap-2">{!! $checkIcon !!} Garansi tayang</li>
                    <li class="flex items-start gap-2">{!! $checkIcon !!} Laporan URL</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-[#14b8a6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Konsultasi Sekarang
                </a>
            </div>

            {{-- PRO --}}
            <div class="bg-[#FFD200] border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full relative">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-black text-white text-xs font-black px-4 py-1 uppercase">TERPOPULER</div>
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">PRO</h3>
                @if($pv('pro_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('pro_price_ori', 'Rp 10.000.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('pro_price', 'Rp 8.500.000') }}</div>
                <div class="text-sm font-bold text-black/60 mb-6">{{ $pv('pro_media_count', '25') }} Media</div>
                @php $checkIconPro = '<svg class="w-4 h-4 text-[#430A5D] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
                     $checkIconBlue = '<svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>'; @endphp
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li class="flex items-start gap-2">{!! $checkIconPro !!} Undangan wartawan</li>
                    <li class="flex items-start gap-2">{!! $checkIconPro !!} Distribusi press release</li>
                    <li class="flex items-start gap-2">{!! $checkIconPro !!} Liputan {{ $pv('pro_media_count', '25') }} media</li>
                    <li class="flex items-start gap-2">{!! $checkIconPro !!} Garansi tayang</li>
                    <li class="flex items-start gap-2">{!! $checkIconPro !!} Laporan URL</li>
                    <li class="flex items-start gap-2 text-blue-600">{!! $checkIconBlue !!} Bonus media dari kami</li>
                    <li class="flex items-start gap-2 text-blue-600">{!! $checkIconBlue !!} Prioritas pengerjaan</li>
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
                @php $checkIconVip = '<svg class="w-4 h-4 text-[#430A5D] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>'; @endphp
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li class="flex items-start gap-2">{!! $checkIconVip !!} Undangan wartawan</li>
                    <li class="flex items-start gap-2">{!! $checkIconVip !!} Distribusi press release</li>
                    <li class="flex items-start gap-2">{!! $checkIconVip !!} Liputan {{ $pv('vip_media_count', '50') }} media</li>
                    <li class="flex items-start gap-2">{!! $checkIconVip !!} Garansi tayang</li>
                    <li class="flex items-start gap-2">{!! $checkIconVip !!} Laporan URL</li>
                    <li class="flex items-start gap-2 text-blue-600">{!! $checkIconBlue !!} Bonus media dari kami</li>
                    <li class="flex items-start gap-2 text-blue-600">{!! $checkIconBlue !!} Prioritas pengerjaan</li>
                    <li class="flex items-start gap-2 text-blue-600">{!! $checkIconBlue !!} Dedicated account manager</li>
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
    <div class="inline-block p-4 border-4 border-dashed border-[#FFD200] mb-8 animate-pulse">
        <span class="font-black text-xl uppercase italic text-[#FFD200]">Siap Menjadi Headline Besok Pagi?</span>
    </div>
    <br>
    <h2 class="text-5xl font-black uppercase mb-8 italic text-[#FFD200]">
        {{ $cv('title', 'SIAP GELAR PRESS CONFERENCE?') }}
    </h2>
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="inline-flex items-center gap-4 bg-white text-black px-16 py-8 font-black text-3xl uppercase shadow-[12px_12px_0px_0px_rgba(250,204,21,1)] hover:bg-[#3B82F6] hover:text-white hover:translate-y-2 transition-all italic">
        {{ $cv('cta_text', 'HUBUNGI KAMI SEKARANG') }}
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
        </svg>
    </a>
</footer>

@endsection