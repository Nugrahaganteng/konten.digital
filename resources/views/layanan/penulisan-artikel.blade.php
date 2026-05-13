@extends('layouts.app')

@section('title', 'Jasa Penulis Artikel SEO Terpercaya - Kontendigital.id')

@section('content')

@php
    $heroS     = $sections->get('hero');
    $problemsS = $sections->get('problems');
    $whyUsS    = $sections->get('why_us');
    $topicsS   = $sections->get('topics');

    $hv = fn($k, $d = '') => $heroS     ? ($heroS->get($k)     ?: $d) : $d;
    $pv = fn($k, $d = '') => $problemsS ? ($problemsS->get($k) ?: $d) : $d;
    $wv = fn($k, $d = '') => $whyUsS    ? ($whyUsS->get($k)    ?: $d) : $d;
    $tv = fn($k, $d = '') => $topicsS   ? ($topicsS->get($k)   ?: $d) : $d;
@endphp

{{-- ── HERO ──────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 bg-[#FFD200] overflow-hidden border-b-8 border-black">
    <div class="absolute bottom-10 right-10 opacity-40 animate-bounce hidden md:block">
        <svg class="w-24 h-24 text-[#E61E50]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.13 14.71L8.5 10.08L10 8.58L14.63 13.21L13.13 14.71M16 11L11.5 6.5L12.58 5.42C13.08 4.92 13.9 4.92 14.41 5.42L18.58 9.58C19.08 10.09 19.08 10.91 18.58 11.42L16 11M5.41 18.59L2 22L5.41 18.59C5.91 19.09 6.74 19.09 7.24 18.59L11.38 14.45L6.75 9.82L2.61 13.96C2.11 14.46 2.11 15.29 2.61 15.79L5.41 18.59Z"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-4 items-center relative z-10">
        <div class="space-y-6">
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PENULIS ARTIKEL SEO') }}
                </span>
            </div>

            <h1 class="text-6xl md:text-8xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                {{ $hv('title_line1', 'DAPATKAN') }}<br>
                {{ $hv('title_line2', 'KONTEN') }}<br>
                <span class="bg-black text-[#FFD200] px-2 italic">
                    {{ $hv('title_highlight', 'BERKUALITAS') }}
                </span>
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-xl font-bold text-black italic">
                    "{{ $hv('quote', 'Ubah ide Anda menjadi konten yang merajai Google.') }}"
                </p>
            </div>

            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">
                {{ $hv('description', 'Jasa penulis artikel SEO, konten media, copywriter, dan script video YouTube/Social Media dengan riset keyword mendalam.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-block px-8 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG →') }}
            </a>
        </div>

        <div class="relative flex justify-center items-center h-[600px]">
            <div class="absolute w-[450px] h-[450px] border-[6px] border-black rounded-[50px] -translate-x-4 -translate-y-4"></div>
            <div class="relative w-[400px] h-[400px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[25px_25px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Penulisan Artikel"
                         class="absolute bottom-0 w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-5">
                @else
                    <img src="/images/tulis1.png" alt="Penulisan Artikel"
                         class="absolute bottom-0 w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-5">
                @endif
                <div class="absolute top-20 -right-16 bg-white border-4 border-black rounded-full px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-20">
                    <span class="font-black text-sm text-black uppercase">GOOD NEWS!!!</span>
                    <div class="absolute -bottom-2 left-4 w-4 h-4 bg-white border-b-4 border-r-4 border-black rotate-45"></div>
                </div>
                <div class="absolute top-5 -right-20 bg-[#3D0066] text-white border-4 border-black px-6 py-2 font-black text-sm uppercase shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-30">
                    ✦ SEO FRIENDLY
                </div>
                <div class="absolute -bottom-10 -left-24 bg-white text-black border-4 border-black px-6 py-3 font-black text-sm uppercase shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 z-30">
                    ✦ GARANSI LOLOS COPYSKAPE
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MASALAH & SOLUSI ──────────────────────────────────────── --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
        <div class="relative group">
            <div class="absolute inset-0 bg-[#FFD200] border-4 border-black translate-x-4 translate-y-4 -z-10 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform"></div>
            @if($heroS && $heroS->get('image_2'))
                <img src="{{ Storage::url($heroS->get('image_2')) }}" class="w-full grayscale border-4 border-black shadow-none">
            @else
                <img src="/images/tulis.png" class="w-full grayscale border-4 border-black shadow-none">
            @endif
        </div>
        <div>
            <h2 class="text-4xl font-black uppercase mb-10 leading-tight text-[#3D0066]">
                {{ $pv('title', 'Apakah Anda Mengalami Hal Ini?') }}
            </h2>
            <div class="space-y-4">
                @foreach([1,2,3,4,5] as $i)
                @php $problem = $pv("problem_{$i}", ''); @endphp
                @if($problem)
                <div class="flex items-center gap-4 p-4 bg-white border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-red-50 transition-colors group">
                    <div class="w-8 h-8 bg-black flex items-center justify-center border-2 border-white group-hover:bg-red-600">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <span class="font-black uppercase text-sm">{{ $problem }}</span>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── MENGAPA HARUS KAMI ────────────────────────────────────── --}}
<section class="py-24 bg-[#3D0066] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-6xl font-black uppercase mb-16 italic text-[#FFD200]">
            {{ $wv('title', 'Mengapa Harus Kami?') }}
        </h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([1,2,3,4,5,6] as $i)
            @php $trust = $wv("trust_{$i}", ''); @endphp
            @if($trust)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_#FFD200] group hover:-translate-y-2 transition-transform">
                <div class="w-14 h-14 bg-black border-4 border-[#FFD200] mx-auto mb-6 flex items-center justify-center transform group-hover:rotate-12 transition-transform">
                    <svg class="w-8 h-8 text-[#FFD200]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="font-black text-xl uppercase leading-none">{{ $trust }}</h3>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── TOPIK PENULISAN ───────────────────────────────────────── --}}
<section class="py-24 bg-[#FFD200] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-5xl font-black uppercase mb-6 text-[#3D0066]">
                {{ $tv('title', 'Topik Penulisan') }}
            </h2>
            <p class="font-bold mb-10 text-xl border-b-4 border-black pb-2 inline-block">Kami Menguasai Berbagai Niche Industri:</p>
            <div class="grid grid-cols-2 gap-y-4">
                @foreach([1,2,3,4,5,6,7,8] as $i)
                @php $topic = $tv("topic_{$i}", ''); @endphp
                @if($topic)
                <div class="flex items-center gap-3 font-black uppercase group">
                    <span class="w-3 h-3 bg-black group-hover:bg-[#E61E50] transition-colors"></span>
                    <span class="border-b-2 border-transparent group-hover:border-black">{{ $topic }}</span>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="relative">
            <div class="absolute inset-0 border-4 border-black translate-x-4 translate-y-4"></div>
            @if($heroS && $heroS->get('image_3'))
                <img src="{{ Storage::url($heroS->get('image_3')) }}" class="relative w-full border-4 border-black shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
            @else
                <img src="/images/tulis2.png" class="relative w-full border-4 border-black shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
            @endif
        </div>
    </div>
</section>

@endsection