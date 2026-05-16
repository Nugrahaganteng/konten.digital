@extends('layouts.app')

@section('title', 'Pelatihan Konten Kreator - HNP Communications.id')

@section('content')

@php
    $heroS    = $sections->get('hero');
    $whyS     = $sections->get('why_join');
    $modS     = $sections->get('modules');
    $targetS  = $sections->get('targets');
    $ctaS     = $sections->get('cta');

    // Helper closures per section
    $hv = fn($k, $d = '') => $heroS   ? ($heroS->get($k)   ?: $d) : $d;
    $wv = fn($k, $d = '') => $whyS    ? ($whyS->get($k)    ?: $d) : $d;
    $mv = fn($k, $d = '') => $modS    ? ($modS->get($k)    ?: $d) : $d;
    $tv = fn($k, $d = '') => $targetS ? ($targetS->get($k) ?: $d) : $d;
    $cv = fn($k, $d = '') => $ctaS    ? ($ctaS->get($k)    ?: $d) : $d;

    // Reasons array — ambil dari CMS, fallback ke default
    $reasons = [];
    for ($i = 1; $i <= 4; $i++) {
        $title = $wv("reason_{$i}_title");
        $desc  = $wv("reason_{$i}_desc");
        if ($title || $desc) {
            $reasons[] = [$title, $desc];
        }
    }
    if (empty($reasons)) {
        $reasons = [
            ['Belajar Dari Ahlinya',  'Tim pengajar kami adalah mantan produser senior TV nasional dengan pengalaman lebih dari 20 tahun.'],
            ['Pengajar BNSP',         'Tim bersertifikasi Badan Nasional Sertifikasi Profesi (BNSP) dengan gelar Certified Content Creator.'],
            ['Materi Komprehensif',   'Mencakup seluruh aspek creation mulai dari teknik pengambilan gambar hingga strategi engagement.'],
            ['Metode Fleksibel',      'Tersedia format kolektif maupun privat, cocok untuk perusahaan, instansi, maupun UMKM.'],
        ];
    }

    // Modules array
    $modules = [];
    for ($i = 1; $i <= 6; $i++) {
        $title = $mv("module_{$i}_title");
        $desc  = $mv("module_{$i}_desc");
        if ($title || $desc) {
            $modules[] = [$title, $desc];
        }
    }
    if (empty($modules)) {
        $modules = [
            ['Modul 1: Pengenalan Dunia Konten Kreator', 'Niche content, personal branding, dan peran kreator di industri digital.'],
            ['Modul 2: Persiapan dan Perencanaan',       'Ide konten, scriptwriting yang efektif, riset audiens, dan pembuatan storyboard.'],
            ['Modul 3: Produksi Konten',                 'Teknik kamera (angle, framing, lighting) dan penggunaan aksesoris smartphone.'],
            ['Modul 4: Editing Video dengan Smartphone', 'Pengenalan aplikasi CapCut, dasar editing, transisi, musik, dan color correction.'],
            ['Modul 5: Distribusi dan Promosi Video',    'Optimasi video untuk platform YouTube, Instagram, TikTok, dan Facebook.'],
            ['Modul 6: Cuan dari Ngonten',               'Strategi monetisasi, affiliate marketing, endorse, dan penjualan produk/jasa.'],
        ];
    }

    // Targets array
    $targets = [];
    for ($i = 1; $i <= 4; $i++) {
        $title = $tv("target_{$i}");
        $desc  = $tv("target_{$i}_desc");
        if ($title || $desc) {
            $targets[] = [$title, $desc];
        }
    }
    if (empty($targets)) {
        $targets = [
            ['Perusahaan Profesional', 'Perusahaan yang concern terhadap konten (properti, travel, RS, dsb).'],
            ['Instansi & Lembaga',     'Sekolah, ponpes, universitas, dan lembaga pemerintahan.'],
            ['Individu Kreator',       'Individu yang ingin menjadi kreator profesional atau meningkatkan kompetensi.'],
            ['Business Owner & UMKM', 'Pemilik bisnis yang ingin mempromosikan produk melalui konten kreatif.'],
        ];
    }
@endphp

{{-- HERO SECTION --}}
<section class="relative pt-32 pb-24 bg-[#FFD200] border-b-8 border-black overflow-hidden">
    <div class="absolute top-20 right-10 opacity-20 animate-pulse hidden md:block">
        <svg class="w-40 h-40 text-[#3D0066]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        {{-- Text Content --}}
        <div class="space-y-8">
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#3D0066] transform -rotate-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="text-white font-black text-sm tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ UPGRADE SKILL KONTEN KREATORMU') }}
                </span>
            </div>

            <h1 class="text-6xl md:text-8xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                {{ $hv('title_line1', 'Ciptakan Konten') }} <br>
                <span class="bg-black text-[#FFD200] px-4 inline-block transform rotate-1 italic">
                    {{ $hv('title_highlight', 'Inovatif') }}
                </span> <br>
                {{ $hv('title_line2', 'dengan Smartphone') }}
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-xl font-bold text-black italic leading-tight">
                    "{{ $hv('quote', 'Ubah perangkat harian Anda menjadi mesin produksi konten profesional.') }}"
                </p>
            </div>

            <p class="text-lg font-bold text-black/80 max-w-md">
                {{ $hv('description', 'Ikuti pelatihan konten kreator bersama HNP Communications    .id. Materi komprehensif mulai dari pengambilan video, editing, hingga strategi publikasi.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://api.whatsapp.com/send?phone=6287786000919') }}"
               class="inline-block bg-black text-white px-10 py-5 text-2xl font-black border-4 border-black shadow-[8px_8px_0px_0px_rgba(230,30,80,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG →') }}
            </a>
        </div>

        {{-- Visual Side --}}
        <div class="relative flex justify-center items-center h-[550px]">
            <div class="absolute w-[420px] h-[420px] border-[6px] border-black rounded-[40px] -translate-x-6 -translate-y-6"></div>

            <div class="relative w-[380px] h-[380px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-hidden">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}"
                         alt="Pelatihan Konten Kreator"
                         class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
                @else
                    <img src="/images/latihan.png"
                         alt="Pelatihan Konten Kreator"
                         class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
                @endif

                {{-- Floating Badge --}}
                <div class="absolute -bottom-8 right-0 bg-white border-4 border-black px-6 py-3 shadow-[6px_6px_0px_0px_rgba(61,0,102,1)] z-20 flex items-center gap-3">
                    <div class="bg-[#FFD200] border-2 border-black p-1">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="font-black text-sm uppercase">
                        {{ $hv('badge_cert', 'Pengajar Bersertifikasi BNSP') }}
                    </span>
                </div>
            </div>

            <div class="absolute top-5 -right-4 bg-[#3D0066] text-white border-4 border-black px-4 py-2 font-black text-xs uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-30">
                {{ $hv('badge_live', '✦ LIVE WORKSHOP') }}
            </div>
        </div>
    </div>
</section>

{{-- MENGAPA HARUS IKUT --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black uppercase mb-16 text-center italic tracking-tighter text-[#3D0066]">
            {{ $wv('title', 'Mengapa Harus Ikut Pelatihan Kami?') }}
        </h2>
        <div class="grid md:grid-cols-4 gap-8">
            @foreach($reasons as $reason)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:bg-[#3D0066] transition-all">
                <div class="w-12 h-12 bg-[#FFD200] border-2 border-black flex items-center justify-center mb-6 group-hover:bg-white transition-colors">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="font-black text-xl uppercase mb-4 group-hover:text-[#FFD200] transition-colors leading-none">{{ $reason[0] }}</h3>
                <p class="font-bold text-sm leading-tight group-hover:text-white transition-colors">{{ $reason[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- MODUL MATERI --}}
<section class="py-24 bg-[#3D0066] border-b-8 border-black">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-black text-[#FFD200] uppercase mb-4 tracking-tighter underline decoration-8 decoration-black underline-offset-8">
                {{ $mv('title', 'Apa Saja Materi Pelatihan Kami?') }}
            </h2>
        </div>

        <div class="space-y-4">
            @foreach($modules as $module)
            <div class="bg-white border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] group hover:bg-[#FFD200] transition-all">
                <div class="p-6 flex justify-between items-center cursor-pointer">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 bg-black flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <h3 class="font-black text-xl uppercase leading-none">{{ $module[0] }}</h3>
                    </div>
                </div>
                @if($module[1])
                <div class="px-16 pb-6 italic font-bold text-black/70 group-hover:text-black">
                    "{{ $module[1] }}"
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SIAPA YANG COCOK --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-center uppercase mb-20 tracking-tighter italic text-[#3D0066]">
            {{ $tv('title', 'Siapa Saja yang Cocok?') }}
        </h2>
        <div class="grid md:grid-cols-4 gap-8 text-center">
            @foreach($targets as $target)
            <div class="flex flex-col items-center group">
                <div class="w-20 h-20 bg-[#FFD200] border-4 border-black mb-6 rotate-3 flex items-center justify-center group-hover:bg-[#E61E50] group-hover:rotate-0 transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                    <svg class="w-10 h-10 text-black group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="font-black text-xl uppercase mb-3 leading-tight">{{ $target[0] }}</h3>
                <p class="font-bold text-sm text-black/60">{{ $target[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section class="py-32 bg-[#FFD200] text-center border-t-8 border-black">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-6xl md:text-8xl font-black uppercase mb-10 leading-[0.8] tracking-tighter text-[#3D0066]">
            {{ $cv('title', "SIAP JADI\nKREATOR?") }}
        </h2>
        <a href="{{ $cv('cta_url', 'https://api.whatsapp.com/send?phone=6287786000919') }}"
           class="inline-block bg-black text-white px-12 py-6 text-2xl font-black border-4 border-black shadow-[10px_10px_0px_0px_rgba(230,30,80,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all uppercase">
            {{ $cv('cta_text', 'HUBUNGI KAMI SEKARANG →') }}
        </a>
    </div>
</section>

@endsection