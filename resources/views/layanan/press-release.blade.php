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
    <!-- <div class="absolute bottom-10 right-10 opacity-40 animate-pulse hidden md:block">
        <svg class="w-24 h-24 text-[#E61E50]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.13 14.71L8.5 10.08L10 8.58L14.63 13.21L13.13 14.71M16 11L11.5 6.5L12.58 5.42C13.08 4.92 13.9 4.92 14.41 5.42L18.58 9.58C19.08 10.09 19.08 10.91 18.58 11.42L16 11M5.41 18.59L2 22L5.41 18.59C5.91 19.09 6.74 19.09 7.24 18.59L11.38 14.45L6.75 9.82L2.61 13.96C2.11 14.46 2.11 15.29 2.61 15.79L5.41 18.59Z"/>
        </svg>
    </div> -->

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

{{-- ── 3. MATERI PUBLIKASI ──────────────────────────────────────── --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="relative border-4 border-black p-12 bg-[url('https://images.unsplash.com/photo-1495020689067-958852a7765e?q=80&w=2069&auto=format&fit=crop')] bg-cover bg-center">
            <div class="absolute inset-0 bg-white/90"></div>
            <div class="relative z-10 text-center">
                <h2 class="text-3xl font-black uppercase mb-8">Pilih Materi Publikasi Sesuai Kebutuhan Anda!</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-left max-w-4xl mx-auto font-bold">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Promosi launching/peluncuran bisnis atau brand
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Kegiatan sosial atau kemasyarakatan
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Memperkenalkan produk atau jasa baru
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Promosi perusahaan, event, seminar, kegiatan kampus, dll
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── 4. TARGET AUDIENCE ───────────────────────────────────────── --}}
<section class="py-24 bg-[#F0F0F0] border-y-8 border-black relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
         style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 30px 30px;">
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="inline-block bg-white text-black text-3xl md:text-5xl font-black uppercase px-8 py-3 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-4" style="font-family:'Unbounded', sans-serif">
                SIAPA TARGET ANDA?
            </h2>
            <p class="text-black font-black text-sm tracking-[0.2em] uppercase mt-4">PILIH KATEGORI UNTUK MULAI EKSPANSI</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $targets = [
                    [
                        'label' => 'P01',
                        'title' => 'Brand & UMKM',
                        'desc' => 'Tingkatkan konversi customer dengan validasi berita dari media terpercaya.',
                        'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                        'color' => 'bg-cyan-300',
                    ],
                    [
                        'label' => 'P02',
                        'title' => 'Profesional',
                        'desc' => 'Bangun personal branding kuat dan tingkatkan elektabilitas di mata publik.',
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'color' => 'bg-yellow-300',
                    ],
                    [
                        'label' => 'P03',
                        'title' => 'Influencer',
                        'desc' => 'Naikkan kelas endorsement Anda dengan label "Diliput Media Nasional".',
                        'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                        'color' => 'bg-rose-300',
                    ],
                    [
                        'label' => 'P04',
                        'title' => 'Komunitas',
                        'desc' => 'Dapatkan kepercayaan maksimal untuk menarik ribuan anggota baru ke institusi Anda.',
                        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        'color' => 'bg-lime-300',
                    ]
                ];
            @endphp

            @foreach($targets as $t)
            <div class="group relative bg-white border-4 border-black p-8 transition-all duration-200 hover:-translate-y-2 hover:-translate-x-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                <div class="{{ $t['color'] }} border-2 border-black inline-block px-3 py-1 mb-6">
                    <span class="text-xs font-black tracking-tighter">{{ $t['label'] }} // SELECT</span>
                </div>
                <div class="w-16 h-16 {{ $t['color'] }} border-4 border-black rounded-full flex items-center justify-center mb-6 group-hover:rotate-12 transition-transform shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $t['icon'] }}"></path>
                    </svg>
                </div>
                <h4 class="text-black text-2xl font-black uppercase mb-3 tracking-tighter leading-none">{{ $t['title'] }}</h4>
                <p class="text-black/70 text-sm font-bold leading-relaxed mb-6">{{ $t['desc'] }}</p>
                <div class="pt-4 border-t-2 border-dashed border-black/20 group-hover:border-black/100 transition-colors">
                    <span class="text-[10px] font-black uppercase tracking-widest text-black/40 group-hover:text-black">Insert Coin to Start →</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── 5. MENGAPA KLIEN MEMILIH KAMI ───────────────────────────── --}}
<section class="py-24 bg-cyan-400 border-b-4 border-black relative overflow-hidden">
    <div class="absolute top-10 right-10 w-32 h-32 bg-yellow-400 border-4 border-black rounded-full mix-blend-multiply opacity-50 animate-pulse"></div>
    <div class="absolute bottom-10 left-10 w-24 h-24 bg-purple-600 border-4 border-black rotate-12 opacity-30"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="mb-16 max-w-3xl">
            <h2 class="text-5xl md:text-6xl font-black uppercase leading-none tracking-tighter text-black" style="font-family:'Unbounded', sans-serif">
                MENGAPA KLIEN <br>
                <span class="bg-white px-4 py-1 border-4 border-black inline-block mt-2 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    MEMILIH KAMI?
                </span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $features = [
                    ['title' => 'Proses Cepat', 'desc' => 'Tim profesional kami memastikan rilis Anda diproses dalam hitungan jam, bukan hari.', 'color' => 'bg-white', 'icon' => 'M13 10V3L4 14H11V21L20 10H13Z'],
                    ['title' => 'Garansi 100%', 'desc' => 'Jaminan tayang atau uang kembali 100% jika rilis tidak lolos kebijakan redaksi.', 'color' => 'bg-yellow-400', 'icon' => 'M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z'],
                    ['title' => 'Revisi Unlimited', 'desc' => 'Kepuasan Anda prioritas. Kami berikan revisi tanpa batas hingga narasi sempurna.', 'color' => 'bg-purple-500', 'icon' => 'M11 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17C18.1046 20 19 19.1046 19 18V13M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63317 20.4142 6.41421L11.8284 15H9V12.1716L17.5858 3.58579Z'],
                    ['title' => 'Admin Responsif', 'desc' => 'Konsultasi gratis kapan saja. Admin kami stand-by untuk menjawab setiap pertanyaan.', 'color' => 'bg-rose-400', 'icon' => 'M3 5H11M3 10H11M3 15H11M13 5H21M13 10H21M13 15H21M3 20H21'],
                    ['title' => 'Biaya Kompetitif', 'desc' => 'Harga paling masuk akal di kelasnya tanpa menurunkan standar kualitas publikasi.', 'color' => 'bg-green-400', 'icon' => 'M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z'],
                    ['title' => '200+ Media', 'desc' => 'Akses ke jaringan media nasional terbesar mulai dari portal berita hingga koran cetak.', 'color' => 'bg-orange-400', 'icon' => 'M19 20H5C3.89543 20 3 19.1046 3 18V6C3 4.89543 3.89543 4 5 4H19C20.1046 4 21 4.89543 21 6V18C21 19.1046 20.1046 20 19 20ZM5 8H19M7 12H17M7 16H13'],
                    ['title' => 'Gratis Penulisan', 'desc' => 'Belum ada draft? Tim editor kami buatkan artikel rilis profesional secara gratis.', 'color' => 'bg-indigo-400', 'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                    ['title' => 'Bonus Media', 'desc' => 'Setiap pembelian paket tertentu, dapatkan ekstra publikasi di media mitra kami.', 'color' => 'bg-white', 'icon' => 'M12 8V12L15 15M21 12C21 17.1364 16.8636 21.2727 12 21.2727C7.13636 21.2727 3 17.1364 3 12C3 7.13636 7.13636 3 12 3C16.8636 3 21 7.13636 21 12Z'],
                ];
            @endphp

            @foreach($features as $f)
            <div class="{{ $f['color'] }} border-4 border-black p-6 group hover:-translate-y-2 hover:-translate-x-2 transition-all duration-200 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-[15px_15px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-12 h-12 bg-black flex items-center justify-center mb-6 border-2 border-white shadow-[4px_4px_0px_0px_rgba(255,255,255,0.3)]">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $f['icon'] }}"></path>
                    </svg>
                </div>
                <h4 class="font-black text-xl uppercase mb-3 leading-tight tracking-tighter">{{ $f['title'] }}</h4>
                <p class="text-sm font-bold text-black/80 leading-snug">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── 6. PAKET HARGA ───────────────────────────────────────────── --}}
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

{{-- ── 7. MITRA ─────────────────────────────────────────────────── --}}
<section class="bg-purple-950 border-b-4 border-black py-20 px-6 lg:px-16 relative overflow-hidden" id="clients">
    <div class="max-w-7xl mx-auto relative z-10">

        <div class="flex flex-col md:flex-row border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-12">
            <div class="bg-purple-950 text-yellow-400 px-8 py-6 border-b-4 md:border-b-0 md:border-r-4 border-black flex flex-col justify-center min-w-[300px]">
                <h2 class="font-black text-2xl uppercase tracking-widest mb-1" style="font-family:'Unbounded',sans-serif">
                    100+ MITRA.
                </h2>
                <p class="text-xs font-bold uppercase opacity-80 leading-tight">Terpercaya di Seluruh Indonesia</p>
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
                                <svg class="w-8 h-8 scale-x-[-1]" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16.5C21 16.88 20.79 17.21 20.47 17.38L12.57 21.82C12.41 21.94 12.21 22 12 22C11.79 22 11.59 21.94 11.43 21.82L3.53 17.38C3.21 17.21 3 16.88 3 16.5V7.5C3 7.12 3.21 6.79 3.53 6.62L11.43 2.18C11.59 2.06 11.79 2 12 2C12.21 2 12.41 2.06 12.57 2.18L20.47 6.62C20.79 6.79 21 7.12 21 7.5V16.5Z"/></svg>
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
                @php
                    $clientLogos = [
                        'tugu.png', 'lunas.png', 'kuliner.png', 'dog.png',
                        'hikmat.png', 'indo.png', 'kids.png', 'bio.png',
                        'praja.png','price.png','volantis.png','gorem.png',
                    ];
                @endphp

                @foreach($clientLogos as $logo)
                <div class="bg-yellow-400 aspect-square flex items-center justify-center p-8
                            hover:bg-cyan-400 transition-all duration-500 group cursor-pointer relative overflow-hidden">
                    <img src="{{ asset('images/clients/' . $logo) }}"
                         alt="Client Logo {{ $logo }}"
                         class="w-full h-full object-contain
                                opacity-60 group-hover:opacity-100
                                scale-90 group-hover:scale-110
                                transition-all duration-500 ease-out
                                transform-gpu will-change-transform">
                    <div class="absolute inset-0 border-0 group-hover:border-[6px] border-black transition-all duration-200 pointer-events-none"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── 8. CTA FOOTER ────────────────────────────────────────────── --}}
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