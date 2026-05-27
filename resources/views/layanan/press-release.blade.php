@extends('layouts.app')

@section('title', 'Jasa Press Release Media Online Nasional - Konten Digital')

@section('content')

@php
    // ── Load sections ─────────────────────────────────────────────────────────
    $heroS     = $sections->get('hero');
    $whyS      = $sections->get('why_pr');
    $materiS   = $sections->get('materi_publikasi');
    $targetS   = $sections->get('target_audience');
    $keungS    = $sections->get('keunggulan');
    $pricingS  = $sections->get('pricing');
    $mediaS    = $sections->get('media_partner');
    $ctaS      = $sections->get('cta');

    // ── Helper: ambil nilai field, return $default jika hidden ATAU kosong ────
    // Logika: jika field di-hide di admin → return $default (tidak tampil)
    //         jika field visible tapi kosong → return $default (fallback)
    //         jika field visible dan berisi → return nilai dari DB
    $hv  = function($k, $d = '') use ($heroS)    {
        if (!$heroS) return $d;
        if ($heroS->isFieldHidden($k)) return null; // null = sembunyikan sepenuhnya
        $v = $heroS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $wv  = function($k, $d = '') use ($whyS)     {
        if (!$whyS) return $d;
        if ($whyS->isFieldHidden($k)) return null;
        $v = $whyS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $mv  = function($k, $d = '') use ($materiS)  {
        if (!$materiS) return $d;
        if ($materiS->isFieldHidden($k)) return null;
        $v = $materiS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $tv  = function($k, $d = '') use ($targetS)  {
        if (!$targetS) return $d;
        if ($targetS->isFieldHidden($k)) return null;
        $v = $targetS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $kv  = function($k, $d = '') use ($keungS)   {
        if (!$keungS) return $d;
        if ($keungS->isFieldHidden($k)) return null;
        $v = $keungS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $pv  = function($k, $d = '') use ($pricingS) {
        if (!$pricingS) return $d;
        if ($pricingS->isFieldHidden($k)) return null;
        $v = $pricingS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $mdv = function($k, $d = '') use ($mediaS)   {
        if (!$mediaS) return $d;
        if ($mediaS->isFieldHidden($k)) return null;
        $v = $mediaS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
    $cv  = function($k, $d = '') use ($ctaS)     {
        if (!$ctaS) return $d;
        if ($ctaS->isFieldHidden($k)) return null;
        $v = $ctaS->get($k);
        return ($v !== null && $v !== '') ? $v : $d;
    };
@endphp

{{-- ══════════════════════════════════════════════════════════════════════════
     1. HERO
     null = field di-hide admin → skip render elemen tersebut
     string (termasuk default) → render normal
══════════════════════════════════════════════════════════════════════════ --}}
<section class="relative pt-32 pb-24 overflow-hidden border-b-8 border-black bg-[#FFD200]">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center relative z-10">
        <div class="space-y-6">

            {{-- Badge --}}
            @if($hv('badge_text', '✦ JASA PRESS RELEASE') !== null)
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PRESS RELEASE') }}
                </span>
            </div>
            @endif

            {{-- Judul --}}
            @php
                $tl1 = $hv('title_line1', 'BERSAMA');
                $tl2 = $hv('title_line2', 'WARTAWAN DARI');
                $tl3 = $hv('title_line3', 'MEDIA TERNAMA');
            @endphp
            @if($tl1 !== null || $tl2 !== null || $tl3 !== null)
            <h1 class="text-6xl md:text-7xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                @if($tl1 !== null){{ $tl1 }}<br>@endif
                @if($tl2 !== null){{ $tl2 }}<br>@endif
                @if($tl3 !== null)
                <span class="bg-black text-[#FFD200] px-2 italic">{{ $tl3 }}</span>
                @endif
            </h1>
            @endif

            {{-- Kutipan --}}
            @if($hv('quote', 'Ubah statement menjadi berita nasional dalam sekejap.') !== null)
            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-lg font-bold text-black italic">
                    "{{ $hv('quote', 'Ubah statement menjadi berita nasional dalam sekejap.') }}"
                </p>
            </div>
            @endif

            {{-- Deskripsi --}}
            @php $desc = $hv('description', 'Selain membantu mengundang wartawan/media untuk Anda, kami menangani pembuatan artikel press release, undangan media, distribusi berita, hingga monitoring pemuatan berita secara tuntas.'); @endphp
            @if($desc !== null)
            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">{{ $desc }}</p>
            @endif

            {{-- CTA --}}
            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') ?: 'https://wa.me/6287786000919' }}"
               class="inline-block px-10 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG →') ?: 'KONSULTASI SEKARANG →' }}
            </a>

        </div>

        {{-- Gambar hero --}}
        <div class="relative flex justify-center items-center h-[550px]">
            <div class="absolute w-[420px] h-[430px] border-[6px] border-black rounded-[40px] -translate-x-6 -translate-y-4"></div>
            <div class="relative w-[400px] h-[400px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                @if($heroS && $heroS->getField('image'))
                    <img src="{{ Storage::url($heroS->getField('image')) }}" alt="Press Release"
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

{{-- ══════════════════════════════════════════════════════════════════════════
     2. MENGAPA HARUS PRESS RELEASE
══════════════════════════════════════════════════════════════════════════ --}}
@if(!$whyS || $whyS->is_active)
<section class="py-24 bg-[#1a88d1] border-b-4 border-black text-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            @if($wv('title', 'Mengapa Harus Press Release?') !== null)
            <h2 class="text-4xl font-black uppercase italic mb-4">
                {{ $wv('title', 'Mengapa Harus Press Release?') }}
            </h2>
            @endif
            @php $wSub = $wv('subtitle', 'Press release memiliki peran penting dalam strategi pemasaran dan branding suatu perusahaan.'); @endphp
            @if($wSub !== null)
            <p class="font-bold">{{ $wSub }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            @foreach([1,2,3] as $i)
            @php
                $t = $wv("reason_{$i}_title");
                $d = $wv("reason_{$i}_desc");
            @endphp
            @if($t !== null)
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span>
                    {{ $t }}
                </h3>
                @if($d !== null)<p class="text-sm font-medium leading-relaxed">{{ $d }}</p>@endif
            </div>
            @endif
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @foreach([4,5] as $i)
            @php
                $t = $wv("reason_{$i}_title");
                $d = $wv("reason_{$i}_desc");
            @endphp
            @if($t !== null)
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span>
                    {{ $t }}
                </h3>
                @if($d !== null)<p class="text-sm font-medium leading-relaxed">{{ $d }}</p>@endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     3. MATERI PUBLIKASI — CHECKLIST
══════════════════════════════════════════════════════════════════════════ --}}
@if(!$materiS || $materiS->is_active)
@php
    $materiItems = [];
    for ($i = 1; $i <= 8; $i++) {
        $val = $mv("item_{$i}");
        if ($val !== null && $val !== '') $materiItems[] = $val;
    }
    $bgImage = ($materiS && !$materiS->isFieldHidden('bg_image')) ? $materiS->getField('bg_image') : null;
@endphp
@if(!empty($materiItems))
<section class="py-20 bg-white border-b-4 border-black">
    <div class="max-w-6xl mx-auto px-6">
        <div class="relative border-4 border-black p-12 bg-cover bg-center overflow-hidden"
             @if($bgImage) style="background-image:url('{{ Storage::url($bgImage) }}')"
             @else style="background-image:url('https://images.unsplash.com/photo-1495020689067-958852a7765e?q=80&w=2069&auto=format&fit=crop')"
             @endif>
            <div class="absolute inset-0 bg-white/90"></div>
            <div class="relative z-10 text-center">
                @if($mv('title', 'Pilih Materi Publikasi Sesuai Kebutuhan Anda!') !== null)
                <h2 class="text-3xl font-black uppercase mb-8">
                    {{ $mv('title', 'Pilih Materi Publikasi Sesuai Kebutuhan Anda!') }}
                </h2>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-left max-w-4xl mx-auto font-bold">
                    @foreach($materiItems as $item)
                    <div class="flex items-center gap-3">
                        <span class="text-2xl text-[#1a88d1]">•</span> {{ $item }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     4. TARGET AUDIENCE
══════════════════════════════════════════════════════════════════════════ --}}
@if(!$targetS || $targetS->is_active)
@php
    $targetIcons = [
        1 => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        2 => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
        3 => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
        4 => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
    ];
    $targetDefaultColors = [1=>'bg-cyan-300', 2=>'bg-yellow-300', 3=>'bg-rose-300', 4=>'bg-lime-300'];
    $hasTargets = false;
    for ($i = 1; $i <= 4; $i++) {
        if ($tv("target_{$i}_title") !== null) { $hasTargets = true; break; }
    }
@endphp
@if($hasTargets)
<section class="py-24 bg-[#F0F0F0] border-y-8 border-black relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image:radial-gradient(#000 2px,transparent 2px);background-size:30px 30px;"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            @if($tv('title', 'SIAPA TARGET ANDA?') !== null)
            <h2 class="inline-block bg-white text-black text-3xl md:text-5xl font-black uppercase px-8 py-3 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-4">
                {{ $tv('title', 'SIAPA TARGET ANDA?') }}
            </h2>
            @endif
            @php $tSub = $tv('subtitle', 'PILIH KATEGORI UNTUK MULAI EKSPANSI'); @endphp
            @if($tSub !== null)
            <p class="text-black font-black text-sm tracking-[0.2em] uppercase mt-4">{{ $tSub }}</p>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @for($i = 1; $i <= 4; $i++)
            @php
                $tTitle = $tv("target_{$i}_title");
                $tBadge = $tv("target_{$i}_badge", 'P0'.$i);
                $tDesc  = $tv("target_{$i}_desc");
                $tColor = $tv("target_{$i}_color") ?: ($targetDefaultColors[$i] ?? 'bg-cyan-300');
                if ($tColor === null) $tColor = $targetDefaultColors[$i] ?? 'bg-cyan-300';
            @endphp
            @if($tTitle !== null)
            <div class="group relative bg-white border-4 border-black p-8 transition-all duration-200 hover:-translate-y-2 hover:-translate-x-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                @if($tBadge !== null)
                <div class="{{ $tColor }} border-2 border-black inline-block px-3 py-1 mb-6">
                    <span class="text-xs font-black tracking-tighter">{{ $tBadge }} // SELECT</span>
                </div>
                @endif
                <div class="w-16 h-16 {{ $tColor }} border-4 border-black rounded-full flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $targetIcons[$i] ?? $targetIcons[1] }}"></path>
                    </svg>
                </div>
                <h4 class="text-black text-2xl font-black uppercase mb-3 tracking-tighter leading-none">{{ $tTitle }}</h4>
                @if($tDesc !== null)<p class="text-black/70 text-sm font-bold leading-relaxed mb-6">{{ $tDesc }}</p>@endif
                <div class="pt-4 border-t-2 border-dashed border-black/20 group-hover:border-black/100 transition-colors">
                    <span class="text-[10px] font-black uppercase tracking-widest text-black/40 group-hover:text-black">Insert Coin to Start →</span>
                </div>
            </div>
            @endif
            @endfor
        </div>
    </div>
</section>
@endif
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     5. KEUNGGULAN
══════════════════════════════════════════════════════════════════════════ --}}
@if(!$keungS || $keungS->is_active)
@php
    $keungBg = $kv('bg_color', '#22d3ee') ?: '#22d3ee';
    $keungItems = [];
    for ($i = 1; $i <= 8; $i++) {
        $t = $kv("item_{$i}_title");
        if ($t !== null) $keungItems[] = [
            'title' => $t,
            'desc'  => $kv("item_{$i}_desc"),
            'color' => $kv("item_{$i}_color") ?: 'bg-white',
        ];
    }
    $keungIcons = [
        'M13 10V3L4 14H11V21L20 10H13Z',
        'M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z',
        'M11 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17C18.1046 20 19 19.1046 19 18V13M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63317 20.4142 6.41421L11.8284 15H9V12.1716L17.5858 3.58579Z',
        'M3 5H11M3 10H11M3 15H11M13 5H21M13 10H21M13 15H21M3 20H21',
        'M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z',
        'M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H19C20.1046 4 21 4.89543 21 6V18C21 19.1046 20.1046 20 19 20ZM5 8H19M7 12H17M7 16H13',
        'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
        'M12 8V12L15 15M21 12C21 17.1364 16.8636 21.2727 12 21.2727C7.13636 21.2727 3 17.1364 3 12C3 7.13636 7.13636 3 12 3C16.8636 3 21 7.13636 21 12Z',
    ];
@endphp
@if(!empty($keungItems))
<section class="py-24 border-b-4 border-black relative overflow-hidden"
         style="background-color:{{ $keungBg }}">
    <div class="absolute top-10 right-10 w-32 h-32 bg-yellow-400 border-4 border-black rounded-full mix-blend-multiply opacity-50 animate-pulse"></div>
    <div class="absolute bottom-10 left-10 w-24 h-24 bg-purple-600 border-4 border-black rotate-12 opacity-30"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="mb-16 max-w-3xl">
            <h2 class="text-5xl md:text-6xl font-black uppercase leading-none tracking-tighter text-black">
                @if($kv('title', 'MENGAPA KLIEN') !== null)
                {{ $kv('title', 'MENGAPA KLIEN') }}<br>
                @endif
                @if($kv('title_line2', 'MEMILIH KAMI?') !== null)
                <span class="bg-white px-4 py-1 border-4 border-black inline-block mt-2 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    {{ $kv('title_line2', 'MEMILIH KAMI?') }}
                </span>
                @endif
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($keungItems as $idx => $item)
            <div class="{{ $item['color'] }} border-4 border-black p-6 group hover:-translate-y-2 hover:-translate-x-2 transition-all duration-200 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-[15px_15px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-12 h-12 bg-black flex items-center justify-center mb-6 border-2 border-white shadow-[4px_4px_0px_0px_rgba(255,255,255,0.3)]">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $keungIcons[$idx] ?? $keungIcons[0] }}"></path>
                    </svg>
                </div>
                <h4 class="font-black text-xl uppercase mb-3 leading-tight tracking-tighter">{{ $item['title'] }}</h4>
                @if($item['desc'] !== null)<p class="text-sm font-bold text-black/80 leading-snug">{{ $item['desc'] }}</p>@endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     6. PAKET HARGA
══════════════════════════════════════════════════════════════════════════ --}}
@if(!$pricingS || $pricingS->is_active)
<section class="py-24 bg-[#1a88d1] border-y-4 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        @if($pv('title', 'Paket Harga Jasa Press Release Media Online') !== null)
        <h2 class="text-4xl font-black uppercase mb-16 text-white italic">
            {{ $pv('title', 'Paket Harga Jasa Press Release Media Online') }}
        </h2>
        @endif
        @php
            $packages = [
                [
                    'label' => 'BRONZE',
                    'color' => 'text-purple-600',
                    'btn'   => 'bg-gradient-to-r from-cyan-400 to-purple-500 text-white',
                    'ori'   => $pv('bronze_price_ori',   'Rp 3.750.000,-'),
                    'price' => $pv('bronze_price',       'Rp 3.000.000'),
                    'media' => $pv('bronze_media_count', '3'),
                    'extra' => [],
                ],
                [
                    'label' => 'SILVER',
                    'color' => 'text-gray-500',
                    'btn'   => 'bg-[#333] text-white',
                    'ori'   => $pv('silver_price_ori',   'Rp 5.750.000,-'),
                    'price' => $pv('silver_price',       'Rp 4.750.000'),
                    'media' => $pv('silver_media_count', '5'),
                    'extra' => ['Bonus media dari kami'],
                ],
                [
                    'label' => 'GOLD',
                    'color' => 'text-yellow-600',
                    'btn'   => 'bg-yellow-600 text-white',
                    'ori'   => $pv('gold_price_ori',   'Rp 11.000.000,-'),
                    'price' => $pv('gold_price',       'Rp 9.000.000'),
                    'media' => $pv('gold_media_count', '10'),
                    'extra' => ['Bonus media dari kami'],
                ],
                [
                    'label' => 'PLATINUM',
                    'color' => 'text-blue-800',
                    'btn'   => 'bg-gradient-to-r from-cyan-400 to-blue-700 text-white',
                    'ori'   => $pv('platinum_price_ori',   'Rp 15.750.000,-'),
                    'price' => $pv('platinum_price',       'Rp 12.750.000'),
                    'media' => $pv('platinum_media_count', '15'),
                    'extra' => ['Bonus media dari kami'],
                ],
            ];
            $ctaUrl = ($pricingS ? $pricingS->getField('cta_url') : null) ?: 'https://wa.me/6287786000919';
            $baseFeatures = [
                'Bebas pilih media*','Berita tayang permanen','Garansi tayang',
                'Garansi uang kembali','Gratis pembuatan artikel','Index Google',
                'Laporan tautan URL','Proses tayang 1-3 hari',
            ];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($packages as $pkg)
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black {{ $pkg['color'] }} uppercase mb-2">{{ $pkg['label'] }}</h3>
                @if($pkg['ori'] !== null)<div class="text-sm line-through text-red-500 font-bold">{{ $pkg['ori'] }}</div>@endif
                @if($pkg['price'] !== null)<div class="text-3xl font-black mb-6">{{ $pkg['price'] }}</div>@endif
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    @if($pkg['media'] !== null)<li>✔️ Artikel terbit di {{ $pkg['media'] }} media</li>@endif
                    @foreach($baseFeatures as $feat)<li>✔️ {{ $feat }}</li>@endforeach
                    @foreach($pkg['extra'] as $ext)<li class="text-blue-600">✔️ {{ $ext }}</li>@endforeach
                </ul>
                <a href="{{ $ctaUrl }}"
                   class="block w-full {{ $pkg['btn'] }} py-3 font-black uppercase text-sm rounded-lg border-2 border-black text-center mt-auto">
                    Konsultasi Sekarang
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     7. MEDIA PARTNER STRIP
══════════════════════════════════════════════════════════════════════════ --}}
@if(!$mediaS || $mediaS->is_active)
@php
    $mediaLogos = [];
    for ($i = 1; $i <= 12; $i++) {
        if ($mediaS && $mediaS->isFieldHidden("logo_{$i}")) continue;
        $logo = $mediaS ? $mediaS->getField("logo_{$i}") : null;
        if ($logo) $mediaLogos[] = $logo;
    }
    $mediaTitle    = $mdv('title',    '100+ MITRA.')                     ?: '100+ MITRA.';
    $mediaSubtitle = $mdv('subtitle', 'Terpercaya di Seluruh Indonesia') ?: 'Terpercaya di Seluruh Indonesia';
@endphp
<section class="bg-purple-950 border-b-4 border-black py-20 px-6 lg:px-16 relative overflow-hidden" id="clients">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex flex-col md:flex-row border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-12">
            <div class="bg-purple-950 text-yellow-400 px-8 py-6 border-b-4 md:border-b-0 md:border-r-4 border-black flex flex-col justify-center min-w-[300px]">
                @if($mdv('title', '100+ MITRA.') !== null)
                <h2 class="font-black text-2xl uppercase tracking-widest mb-1">{{ $mediaTitle }}</h2>
                @endif
                @if($mdv('subtitle', 'Terpercaya di Seluruh Indonesia') !== null)
                <p class="text-xs font-bold uppercase opacity-80 leading-tight">{{ $mediaSubtitle }}</p>
                @endif
            </div>
            <div class="bg-yellow-400 flex-1 relative overflow-hidden flex items-center py-4 px-6">
                <div class="absolute inset-0 flex items-center px-6">
                    <div class="w-full border-t-[8px] border-dotted border-purple-950/40"></div>
                </div>
                <div class="relative w-full h-full flex items-center overflow-hidden">
                    <div class="animate-ticker w-max flex items-center gap-12 text-purple-950">
                        @for($i=0; $i<6; $i++)
                            <div class="flex items-center gap-4">
                                <svg class="w-8 h-8 animate-bounce" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14H11V21L20 10H13Z"/></svg>
                                <span class="text-lg font-black uppercase tracking-tighter italic">FAST</span>
                            </div>
                            <span class="text-2xl opacity-30">✦✦✦</span>
                            <div class="flex items-center gap-4">
                                <svg class="w-8 h-8 animate-pulse" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L4.5 20.29L5.21 21L12 18L18.79 21L19.5 20.29L12 2Z"/></svg>
                                <span class="text-lg font-black uppercase tracking-tighter italic">TRUSTED</span>
                            </div>
                            <span class="text-2xl opacity-30">✦✦✦</span>
                            <div class="flex items-center gap-4">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16.5C21 16.88 20.79 17.21 20.47 17.38L12.57 21.82C12.41 21.94 12.21 22 12 22C11.79 22 11.59 21.94 11.43 21.82L3.53 17.38C3.21 17.21 3 16.88 3 16.5V7.5C3 7.12 3.21 6.79 3.53 6.62L11.43 2.18C11.59 2.06 11.79 2 12 2C12.21 2 12.41 2.06 12.57 2.18L20.47 6.62C20.79 6.79 21 7.12 21 7.5V16.5Z"/></svg>
                                <span class="text-lg font-black uppercase tracking-tighter italic">PREMIUM</span>
                            </div>
                            <span class="text-2xl opacity-30">✦✦✦</span>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="border-4 border-black bg-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-1">
                @if(!empty($mediaLogos))
                    @foreach($mediaLogos as $logo)
                    <div class="bg-yellow-400 aspect-square flex items-center justify-center p-8 hover:bg-cyan-400 transition-all duration-500 group cursor-pointer relative overflow-hidden">
                        <img src="{{ Storage::url($logo) }}" alt="Media Partner"
                             class="w-full h-full object-contain opacity-60 group-hover:opacity-100 scale-90 group-hover:scale-110 transition-all duration-500">
                        <div class="absolute inset-0 border-0 group-hover:border-[6px] border-black transition-all duration-200 pointer-events-none"></div>
                    </div>
                    @endforeach
                @else
                    @php $clientLogos = ['tugu.png','lunas.png','kuliner.png','dog.png','hikmat.png','indo.png','kids.png','bio.png','praja.png','price.png','volantis.png','gorem.png']; @endphp
                    @foreach($clientLogos as $logo)
                    <div class="bg-yellow-400 aspect-square flex items-center justify-center p-8 hover:bg-cyan-400 transition-all duration-500 group cursor-pointer relative overflow-hidden">
                        <img src="{{ asset('images/clients/' . $logo) }}" alt="Client Logo"
                             class="w-full h-full object-contain opacity-60 group-hover:opacity-100 scale-90 group-hover:scale-110 transition-all duration-500">
                        <div class="absolute inset-0 border-0 group-hover:border-[6px] border-black transition-all duration-200 pointer-events-none"></div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════════════════════
     8. CTA FOOTER
══════════════════════════════════════════════════════════════════════════ --}}
@if(!$ctaS || $ctaS->is_active)
<footer class="py-20 bg-black text-white text-center border-t-4 border-black">
    @if($cv('title', 'SIAP UNTUK GO NATIONAL?') !== null)
    <h2 class="text-5xl font-black uppercase mb-8 italic text-yellow-400">
        {{ $cv('title', 'SIAP UNTUK GO NATIONAL?') }}
    </h2>
    @endif
    <a href="{{ ($ctaS ? $ctaS->getField('cta_url') : null) ?: 'https://wa.me/6287786000919' }}"
       class="inline-block bg-white text-black px-12 py-6 font-black text-2xl uppercase shadow-[8px_8px_0px_0px_rgba(250,204,21,1)] hover:bg-yellow-400 transition-all">
        {{ $cv('cta_text', 'HUBUNGI KAMI SEKARANG →') ?: 'HUBUNGI KAMI SEKARANG →' }}
    </a>
</footer>
@endif

@endsection