@extends('layouts.app')

@section('title', 'Jasa Konferensi Pers (Khusus Jogja) - Kontendigital.id')

@section('content')

@php
    $heroS    = $sections->get('hero');
    $whyS     = $sections->get('why_needed');
    $prepS    = $sections->get('prep');
    $workS    = $sections->get('our_work');
    $ctaS     = $sections->get('cta');

    $hv = fn($k, $d = '') => $heroS ? ($heroS->get($k) ?: $d) : $d;
    $wv = fn($k, $d = '') => $whyS  ? ($whyS->get($k)  ?: $d) : $d;
    $pv = fn($k, $d = '') => $prepS ? ($prepS->get($k)  ?: $d) : $d;
    $ov = fn($k, $d = '') => $workS ? ($workS->get($k)  ?: $d) : $d;
    $cv = fn($k, $d = '') => $ctaS  ? ($ctaS->get($k)   ?: $d) : $d;
@endphp

{{-- ── HERO ──────────────────────────────────────────────────── --}}
<section class="relative pt-24 pb-24 bg-[#FFD200] overflow-hidden border-b-8 border-black">
    <div class="absolute top-10 left-10 opacity-20 animate-bounce">
        <span class="text-6xl">⭐</span>
    </div>
    <div class="absolute bottom-20 right-10 opacity-20 animate-pulse">
        <span class="text-8xl">🚀</span>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div>
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#3D0066] transform -rotate-1 mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:rotate-0 transition-transform cursor-default">
                <span class="text-white font-black text-sm tracking-widest uppercase italic">
                    {{ $hv('badge_text', '✦ JASA KONFERENSI PERS (KHUSUS JOGJA)') }}
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-[#3D0066] leading-none uppercase tracking-tighter mb-8 drop-shadow-sm">
                {{ $hv('title_line1', 'Bersama Wartawan dari') }}
                <span class="bg-black text-[#FFD200] px-3 inline-block transform skew-x-2">
                    {{ $hv('title_highlight', 'Media Ternama') }}
                </span>
            </h1>

            <p class="text-xl font-bold text-black/80 mb-10 leading-relaxed italic border-l-4 border-black pl-4">
                "{{ $hv('quote', 'Ubah statement menjadi berita nasional dalam sekejap.') }}"
            </p>

            <p class="text-lg font-bold text-black/70 mb-10 leading-relaxed">
                {{ $hv('description', 'Selain membantu mengundang wartawan/media untuk Anda, kami menangani pembuatan artikel press release, undangan media, distribusi berita, hingga monitoring pemuatan berita secara tuntas.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-block px-10 py-5 bg-black text-[#FFD200] font-black text-2xl border-4 border-black hover:bg-[#3D0066] hover:text-white transition-all transform hover:-translate-y-2 active:translate-y-0 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tight">
                {{ $hv('cta_text', 'Konsultasi Sekarang →') }}
            </a>
        </div>

        <div class="relative group">
            <div class="absolute -z-10 top-10 right-10 w-full h-full bg-[#E61E50] border-4 border-black rounded-full shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] group-hover:scale-105 transition-transform duration-500"></div>
            <div class="overflow-hidden border-4 border-black rounded-2xl shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Konferensi Pers" class="w-full h-auto grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                @else
                    <img src="/images/wartawan.png" alt="Konferensi Pers" class="w-full h-auto grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                @endif
            </div>
            <div class="absolute -bottom-6 -left-6 bg-white border-4 border-black p-4 font-black transform rotate-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase text-sm animate-float">
                {{ $hv('badge_1', '✦ Launching Produk') }}
            </div>
            <div class="absolute -top-6 -right-6 bg-[#3D0066] text-white border-4 border-black p-4 font-black transform -rotate-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase text-sm animate-float-delayed">
                {{ $hv('badge_2', '✦ Press Release') }}
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes float{0%,100%{transform:translateY(0) rotate(3deg)}50%{transform:translateY(-10px) rotate(5deg)}}
    @keyframes float-delayed{0%,100%{transform:translateY(0) rotate(-3deg)}50%{transform:translateY(-15px) rotate(-1deg)}}
    .animate-float{animation:float 3s ease-in-out infinite}
    .animate-float-delayed{animation:float-delayed 4s ease-in-out infinite}
</style>

{{-- ── MARQUEE ───────────────────────────────────────────────── --}}
<div class="bg-black py-6 border-b-8 border-black overflow-hidden flex flex-nowrap">
    <div class="flex gap-12 items-center animate-marquee whitespace-nowrap px-4 grayscale opacity-70">
        @foreach(['KR JOGJA','TRIBUN JOGJA','RADAR JOGJA','DETIK.COM','KOMPAS','SUARA.COM','OKEZONE','TVONE NEWS','LIPUTAN 6','TRIBUN NEWS','JAWA POS'] as $m)
            <span class="text-white font-black text-2xl mx-8 uppercase">{{ $m }}</span>
            <span class="text-[#FFD200] text-2xl mx-4">✦</span>
        @endforeach
    </div>
</div>
<style>
    @keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
    .animate-marquee{display:inline-flex;animation:marquee 30s linear infinite}
</style>

{{-- ── MENGAPA DIBUTUHKAN ────────────────────────────────────── --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-6xl font-black uppercase italic mb-6">
                {{ $wv('title', 'Mengapa Dibutuhkan Konferensi Pers?') }}
            </h2>
            <p class="max-w-4xl mx-auto font-bold text-lg leading-relaxed">
                {{ $wv('description', 'Dalam konferensi pers, narasumber bisa menjawab pertanyaan secara langsung dari para wartawan.') }}
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
                $emojis = ['📢','🚀','🤝','📈','📊','🏛️'];
            @endphp
            @foreach([1,2,3,4,5,6] as $i)
            @php $title = $wv("benefit_{$i}_title", ''); @endphp
            @if($title)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-black group hover:bg-[#F2B038] transition-colors">
                <span class="text-4xl mb-4 block transform group-hover:scale-125 transition-transform">{{ $emojis[$i-1] }}</span>
                <h3 class="text-xl font-black uppercase mb-3">{{ $title }}</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">{{ $wv("benefit_{$i}_desc", '') }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── APA YANG PERLU DISIAPKAN ──────────────────────────────── --}}
<section class="py-24 bg-black text-white overflow-hidden border-b-8 border-black">
    <div class="max-w-5xl mx-auto px-6 relative">
        <div class="absolute -top-10 -right-10 text-9xl opacity-10 font-black">PREP</div>
        <h2 class="text-4xl font-black uppercase mb-12 text-center text-[#F2B038]">
            {{ $pv('title', 'Apa yang Perlu Disiapkan?') }}
        </h2>
        <div class="space-y-6">
            @foreach([1,2,3,4] as $i)
            @php $prep = $pv("prep_{$i}", ''); @endphp
            @if($prep)
            <div class="flex gap-6 items-start p-6 border-4 border-[#3B82F6] bg-white text-black shadow-[8px_8px_0px_0px_#3B82F6] group">
                <span class="bg-black text-white w-10 h-10 flex-shrink-0 flex items-center justify-center font-black border-2 border-white group-hover:rotate-12 transition-transform">{{ $i }}</span>
                <p class="font-black text-lg">{{ $prep }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ── APA YANG KAMI KERJAKAN ────────────────────────────────── --}}
<section class="py-24 bg-[#F2B038]">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-center uppercase mb-16 italic underline decoration-black">
            {{ $ov('title', 'Apa Saja yang Kami Kerjakan?') }}
        </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([1,2,3,4,5,6] as $i)
            @php $work = $ov("work_{$i}", ''); @endphp
            @if($work)
            <div class="flex items-center gap-6 p-8 bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:bg-[#3B82F6] hover:text-white transition-all group">
                <div class="w-12 h-12 bg-black text-white border-2 border-white flex items-center justify-center text-xl font-bold group-hover:scale-110">✔</div>
                <p class="font-black text-lg uppercase leading-tight">{{ $work }}</p>
            </div>
            @endif
            @endforeach
        </div>

        <div class="mt-20 text-center">
            <div class="inline-block p-4 border-4 border-dashed border-black mb-8 animate-pulse">
                <span class="font-black text-xl uppercase italic">{{ $cv('title', 'Siap Menjadi Headline Besok Pagi?') }}</span>
            </div>
            <br>
            <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-block px-16 py-8 bg-black text-white font-black text-3xl border-4 border-white shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] hover:bg-[#3B82F6] hover:translate-y-2 transition-all uppercase italic">
                {{ $cv('cta_text', 'Hubungi Kami Sekarang →') }}
            </a>
        </div>
    </div>
</section>

@endsection