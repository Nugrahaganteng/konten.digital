@extends('layouts.app')

@section('title', 'Jasa Pelatihan Konten Kreator - HNP Communications.id')

@section('content')

@php
    $heroS     = $sections->get('hero');
    $whyS      = $sections->get('why_pelatihan');
    $materiS   = $sections->get('materi');
    $pricingS  = $sections->get('pricing');
    $ctaS      = $sections->get('cta');

    $hv  = fn($k, $d = '') => $heroS    ? ($heroS->get($k)    ?: $d) : $d;
    $wv  = fn($k, $d = '') => $whyS     ? ($whyS->get($k)     ?: $d) : $d;
    $mv  = fn($k, $d = '') => $materiS  ? ($materiS->get($k)  ?: $d) : $d;
    $pv  = fn($k, $d = '') => $pricingS ? ($pricingS->get($k) ?: $d) : $d;
    $cv  = fn($k, $d = '') => $ctaS     ? ($ctaS->get($k)     ?: $d) : $d;
@endphp

{{-- ── HERO ──────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 overflow-hidden border-b-8 border-black bg-[#FFD200]">
    <div class="absolute top-20 left-10 w-16 h-16 bg-[#430A5D] opacity-10 rounded-lg rotate-12 animate-bounce-slow"></div>
    <div class="absolute bottom-20 right-10 w-20 h-20 border-4 border-[#430A5D] opacity-10 rounded-full animate-pulse"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center relative z-10">
        <div class="space-y-6">
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PELATIHAN KONTEN KREATOR') }}
                </span>
            </div>

            <h1 class="text-6xl md:text-7xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                {{ $hv('title_line1', 'JADILAH KONTEN') }}<br>
                {{ $hv('title_line2', 'KREATOR YANG') }}<br>
                <span class="bg-black text-[#FFD200] px-2 italic">
                    {{ $hv('title_line3', 'BERDAMPAK') }}
                </span>
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-lg font-bold text-black italic">
                    "{{ $hv('quote', 'Kuasai skill konten digital dari praktisi berpengalaman.') }}"
                </p>
            </div>

            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">
                {{ $hv('description', 'Program pelatihan intensif yang dirancang untuk individu, tim, maupun korporat yang ingin menguasai dunia konten digital secara strategis dan terukur.') }}
            </p>

            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-block px-10 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'DAFTAR SEKARANG →') }}
            </a>
        </div>

        <div class="relative flex justify-center items-center h-[480px]">
            <div class="absolute w-[400px] h-[400px] border-[6px] border-black rounded-[40px] -translate-x-6 -translate-y-4"></div>
            <div class="relative w-[380px] h-[380px] bg-[#430A5D] border-[6px] border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}" alt="Pelatihan Konten Kreator"
                         class="absolute bottom-0 w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform translate-y-6">
                @else
                    <div class="flex flex-col items-center justify-center text-white">
                        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                        </svg>
                        <span class="font-black text-xl uppercase">PELATIHAN</span>
                    </div>
                @endif
                <div class="absolute top-10 -right-16 bg-white border-4 border-black rounded-full px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-20">
                    <span class="font-black text-sm text-black uppercase">CERTIFIED!</span>
                    <div class="absolute -bottom-2 left-4 w-4 h-4 bg-white border-b-4 border-r-4 border-black rotate-45"></div>
                </div>
                <div class="absolute -top-12 -right-8 bg-[#FFD200] text-black border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-30">
                    ✦ PELATIHAN KONTEN
                </div>
                <div class="absolute -bottom-10 -left-12 bg-white text-black border-4 border-black px-5 py-2 font-black text-xs uppercase shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 z-30">
                    ✦ ONLINE & OFFLINE
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow { 0%,100%{transform:translateY(0) rotate(12deg)}50%{transform:translateY(-20px) rotate(15deg)} }
    .animate-bounce-slow{animation:bounce-slow 5s ease-in-out infinite}
</style>

{{-- ── MENGAPA IKUT PELATIHAN INI ───────────────────────────── --}}
<section class="py-24 bg-[#1a88d1] border-b-4 border-black text-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black uppercase italic mb-4">
                {{ $wv('title', 'Mengapa Harus Ikut Pelatihan Konten?') }}
            </h2>
            <p class="font-bold">{{ $wv('subtitle', 'Di era digital, skill membuat konten yang baik adalah aset berharga.') }}</p>
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

{{-- ── MATERI PELATIHAN ─────────────────────────────────────── --}}
@if($materiS && $materiS->is_active)
<section class="py-24 bg-[#430A5D] border-b-8 border-black">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black uppercase italic mb-4 text-[#FFD200]">
                {{ $mv('title', 'Apa yang Akan Kamu Pelajari?') }}
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @for($i = 1; $i <= 8; $i++)
            @php $item = $mv("materi_{$i}", ''); @endphp
            @if($item)
            <div class="bg-white border-4 border-black p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex items-start gap-4 hover:shadow-none transition-all hover:-translate-y-1">
                <span class="text-3xl font-black text-[#430A5D] leading-none min-w-[40px]">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</span>
                <p class="font-black text-sm text-black uppercase leading-tight">{{ $item }}</p>
            </div>
            @endif
            @endfor
        </div>
    </div>
</section>
@endif

{{-- ── PAKET HARGA ───────────────────────────────────────────── --}}
<section class="py-24 bg-[#1a88d1] border-y-4 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-black uppercase mb-16 text-white italic">
            {{ $pv('title', 'Paket Harga Pelatihan Konten Kreator') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            {{-- PERSONAL --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#14b8a6] uppercase mb-2">PERSONAL</h3>
                @if($pv('personal_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('personal_price_ori', 'Rp 1.500.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('personal_price', 'Rp 1.200.000') }}</div>
                @if($pv('personal_desc'))
                <p class="text-xs font-bold text-black/60 mb-6 leading-relaxed">{{ $pv('personal_desc') }}</p>
                @else
                <p class="text-xs font-bold text-black/60 mb-6">Untuk individu, 1 hari pelatihan online, sertifikat digital.</p>
                @endif
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ 1 hari pelatihan (6 jam)</li>
                    <li>✔️ Materi lengkap</li>
                    <li>✔️ Sertifikat digital</li>
                    <li>✔️ Rekaman sesi</li>
                    <li>✔️ Grup WhatsApp alumni</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-[#14b8a6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Daftar Sekarang
                </a>
            </div>

            {{-- GROUP --}}
            <div class="bg-[#FFD217] border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full relative">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-black text-white text-xs font-black px-4 py-1 uppercase">TERPOPULER</div>
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">GROUP</h3>
                @if($pv('group_price_ori'))
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('group_price_ori', 'Rp 800.000,-') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('group_price', 'Rp 650.000') }}</div>
                <p class="text-xs font-bold text-black/70 mb-6">per orang</p>
                @if($pv('group_desc'))
                <p class="text-xs font-bold text-black/60 mb-6 leading-relaxed">{{ $pv('group_desc') }}</p>
                @else
                <p class="text-xs font-bold text-black/60 mb-6">Min. 5 peserta, 1 hari pelatihan online, sertifikat digital.</p>
                @endif
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Min. 5 peserta</li>
                    <li>✔️ 1 hari pelatihan (6 jam)</li>
                    <li>✔️ Materi lengkap</li>
                    <li>✔️ Sertifikat digital</li>
                    <li>✔️ Rekaman sesi</li>
                    <li class="text-blue-600">✔️ Harga lebih hemat</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-black text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(67,10,93,1)] hover:shadow-none transition-all">
                    Daftar Sekarang
                </a>
            </div>

            {{-- CORPORATE --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2">CORPORATE</h3>
                @if($pv('corporate_price_ori') && $pv('corporate_price_ori') !== 'Hubungi Kami')
                <div class="text-sm line-through text-red-500 font-bold">{{ $pv('corporate_price_ori') }}</div>
                @endif
                <div class="text-3xl font-black mb-2">{{ $pv('corporate_price', 'Custom') }}</div>
                @if($pv('corporate_desc'))
                <p class="text-xs font-bold text-black/60 mb-6 leading-relaxed">{{ $pv('corporate_desc') }}</p>
                @else
                <p class="text-xs font-bold text-black/60 mb-6">Untuk perusahaan/instansi, kurikulum custom, online/offline, sertifikat resmi.</p>
                @endif
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase flex-1">
                    <li>✔️ Kurikulum custom</li>
                    <li>✔️ Online atau offline</li>
                    <li>✔️ Sertifikat resmi</li>
                    <li>✔️ Trainer berpengalaman</li>
                    <li class="text-blue-600">✔️ Modul eksklusif</li>
                    <li class="text-blue-600">✔️ Follow-up mentoring</li>
                    <li class="text-blue-600">✔️ Laporan progres peserta</li>
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="mt-auto block w-full bg-gradient-to-r from-[#430A5D] to-[#3B82F6] text-white py-3 font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transition-all">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA FINAL ────────────────────────────────────────────── --}}
<footer class="py-20 bg-black text-white text-center border-t-4 border-black">
    <h2 class="text-5xl font-black uppercase mb-8 italic text-yellow-400">
        {{ $cv('title', 'SIAP JADI KONTEN KREATOR PROFESIONAL?') }}
    </h2>
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="inline-block bg-white text-black px-12 py-6 font-black text-2xl uppercase shadow-[8px_8px_0px_0px_rgba(250,204,21,1)]">
        {{ $cv('cta_text', 'DAFTAR PELATIHAN SEKARANG →') }}
    </a>
</footer>

@endsection