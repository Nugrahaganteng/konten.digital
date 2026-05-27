@extends('layouts.app')

@section('title', 'Jasa Penulisan Script Video - HNP Communications.id')

@section('content')

@php
    $heroS      = $sections->get('hero');
    $whyS       = $sections->get('why_script');
    $servicesS  = $sections->get('services_list');
    $processS   = $sections->get('process');
    $pricingS   = $sections->get('pricing');
    $ctaS       = $sections->get('cta');

    /**
     * Helper: ambil field dari section dengan FULL hidden support.
     * - Menggunakan getField() agar hidden_fields dihormati.
     * - Jika nilai === FIELD_HIDDEN → return null (field disembunyikan admin).
     * - Jika null/kosong → return $default.
     */
    $field = function($section, string $key, mixed $default = '') {
        if (!$section) return $default;
        $val = $section->getField($key);
        if (\App\Models\PageSection::isHiddenValue($val)) return null; // hidden → null
        return $val ?: $default;
    };

    // Shorthand per-section
    $hv = fn($k, $d = '') => $field($heroS,     $k, $d);
    $wv = fn($k, $d = '') => $field($whyS,      $k, $d);
    $sv = fn($k, $d = '') => $field($servicesS, $k, $d);
    $prv= fn($k, $d = '') => $field($processS,  $k, $d);
    $pv = fn($k, $d = '') => $field($pricingS,  $k, $d);
    $cv = fn($k, $d = '') => $field($ctaS,      $k, $d);
@endphp

{{-- ── HERO SECTION ─────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 bg-[#FFD217] overflow-hidden border-b-8 border-black">
    <div class="absolute top-20 left-10 w-16 h-16 bg-[#430A5D] opacity-10 rounded-lg rotate-12 animate-bounce-slow"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        {{-- Text Side --}}
        <div class="space-y-6">
            @if($hv('badge_text') !== null)
            <div class="inline-block px-4 py-1 border-4 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA PENULISAN SCRIPT VIDEO') }}
                </span>
            </div>
            @endif

            <h1 class="text-5xl md:text-7xl font-black text-[#3D0066] leading-[0.95] uppercase tracking-tighter">
                @if($hv('title_line1') !== null)
                    {{ $hv('title_line1', 'SCRIPT VIDEO') }}<br>
                @endif
                @if($hv('title_line2') !== null)
                    {{ $hv('title_line2', 'YANG MEMIKAT &') }}<br>
                @endif
                @if($hv('title_line3') !== null)
                <span class="bg-black text-[#FFD200] px-2 inline-block my-1 transform rotate-1">
                    {{ $hv('title_line3', 'KONVERSI TINGGI') }}
                </span>
                @endif
            </h1>

            @if($hv('quote') !== null)
            <div class="border-l-8 border-black pl-4 py-2 bg-white/40 border-y-2 border-r-2 border-t-black border-b-black border-r-black/20">
                <p class="text-xl font-black text-black italic">
                    "{{ $hv('quote', 'Dari ide menjadi naskah yang siap produksi.') }}"
                </p>
            </div>
            @endif

            @if($hv('description') !== null)
            <p class="text-lg font-bold text-black leading-snug max-w-xl">
                {{ $hv('description', 'Kami merancang naskah video yang engaging, sesuai target audiens Anda, dan siap langsung digunakan untuk produksi iklan, konten sosial media, atau video korporat.') }}
            </p>
            @endif

            @if($hv('cta_text') !== null)
            <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
               class="inline-flex items-center gap-3 px-10 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] hover:text-[#FFD200] transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                {{ $hv('cta_text', 'KONSULTASI SEKARANG') }}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
            @endif
        </div>

        {{-- Image Side --}}
        <div class="relative flex justify-center items-center min-h-[450px]">
            <div class="absolute w-[340px] h-[340px] md:w-[400px] md:h-[400px] border-4 border-black bg-white rounded-3xl translate-x-4 translate-y-4"></div>

            <div class="relative w-[320px] h-[320px] md:w-[380px] md:h-[380px] bg-[#E61E50] border-4 border-black rounded-full shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">

                @php $heroImg = $heroS ? $heroS->getField('image') : null; @endphp
                @if($heroImg && !\App\Models\PageSection::isHiddenValue($heroImg))
                    <img src="{{ Storage::url($heroImg) }}" alt="Script Video"
                         class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-6 drop-shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                @else
                    <img src="{{ asset('images/vidio1.png') }}" alt="Script Video"
                         class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-6 drop-shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                @endif

                <div class="absolute -top-4 -right-6 bg-white border-4 border-black rounded-xl px-4 py-2 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-20">
                    <span class="font-black text-sm uppercase tracking-wider text-black">ACTION!!! 🎬</span>
                </div>
                <div class="absolute bottom-12 -right-10 bg-[#3D0066] text-white border-4 border-black px-4 py-2 font-black text-xs uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-6 z-30">
                    ✦ CREATIVE TEAM
                </div>
                <div class="absolute -bottom-4 -left-6 bg-white text-black border-4 border-black px-4 py-2 font-black text-xs uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform rotate-3 z-30">
                    ✦ SIAP PRODUKSI
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0) rotate(12deg); }
        50%       { transform: translateY(-15px) rotate(8deg); }
    }
    .animate-bounce-slow { animation: bounce-slow 6s ease-in-out infinite; }
</style>


{{-- ── MENGAPA JASA SCRIPT VIDEO ──────────────────────────────── --}}
@if($whyS && $whyS->is_active)
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">

        @if($wv('title') !== null)
        <div class="inline-block border-4 border-black bg-[#FFD200] p-4 transform -rotate-1 mb-8 mx-auto block text-center max-w-2xl shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <h2 class="text-3xl md:text-5xl font-black uppercase text-[#3D0066] tracking-tighter">
                {{ $wv('title', 'Mengapa Harus Jasa Script Video?') }}
            </h2>
        </div>
        @endif

        @if($wv('subtitle') !== null)
        <p class="text-center font-bold mb-16 text-xl text-black/80 max-w-xl mx-auto">
            {{ $wv('subtitle', 'Script yang baik adalah pondasi utama dari video yang sukses menghasilkan konversi.') }}
        </p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @foreach([1, 2, 3, 4] as $i)
                @php
                    $reasonTitle = $wv("reason_{$i}_title");
                    $reasonDesc  = $wv("reason_{$i}_desc");
                @endphp
                @if($reasonTitle !== null && $reasonTitle !== '')
                <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:bg-[#3D0066] transition-all hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
                    <div class="w-12 h-12 bg-[#FFD200] border-4 border-black flex items-center justify-center mb-6 group-hover:bg-white transition-colors transform -rotate-6">
                        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-black text-xl uppercase mb-3 group-hover:text-[#FFD200] transition-colors leading-tight border-b-2 border-black pb-2 group-hover:border-[#FFD200]">
                        {{ $reasonTitle }}
                    </h3>
                    @if($reasonDesc !== null)
                    <p class="text-sm font-bold leading-relaxed text-black/70 group-hover:text-white/90 transition-colors">
                        {{ $reasonDesc }}
                    </p>
                    @endif
                </div>
                @endif
            @endforeach
        </div>

        {{-- Kartu ke-5 jika ada --}}
        @php
            $reason5Title = $wv("reason_5_title");
            $reason5Desc  = $wv("reason_5_desc");
        @endphp
        @if($reason5Title !== null && $reason5Title !== '')
        <div class="max-w-xl mx-auto mt-8">
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:bg-[#3D0066] transition-all hover:-translate-y-1">
                <div class="w-12 h-12 bg-[#FFD200] border-4 border-black flex items-center justify-center mb-6 group-hover:bg-white transition-colors transform -rotate-6">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="font-black text-xl uppercase mb-3 group-hover:text-[#FFD200] transition-colors leading-tight border-b-2 border-black pb-2">
                    {{ $reason5Title }}
                </h3>
                @if($reason5Desc !== null)
                <p class="text-sm font-bold leading-relaxed text-black/70 group-hover:text-white/90 transition-colors">
                    {{ $reason5Desc }}
                </p>
                @endif
            </div>
        </div>
        @endif

    </div>
</section>
@endif


{{-- ── LAYANAN SCRIPT ────────────────────────────────────────── --}}
@if($servicesS && $servicesS->is_active)
@php
    $defaultServices = [
        ['Script Video Pendek', 'Naskah tajam, fast-paced, dan hook memikat di 3 detik pertama untuk Reels, TikTok, dan Shorts.'],
        ['Script Perusahaan',   'Penyampaian profil bisnis, nilai corporate, dan visi misi dengan alur formal namun tetap bernyawa.'],
        ['Script Video Iklan',  'Menggunakan formula copywriting psikologis tinggi untuk memicu konversi pembelian seketika.'],
        ['Script YouTube',      'Menjaga retention rate penonton tetap tinggi untuk video berdurasi panjang, tutorial, atau edukasi.'],
        ['Script Sosmed',       'Konsep kreatif organik yang relevan dengan tren terkini demi memicu interaksi dan potensi viral.'],
        ['Script Dokumenter',   'Alur storytelling sinematik mendalam yang informatif, berbasis riset data, serta menggugah emosi.'],
    ];

    $services = [];
    for ($i = 1; $i <= 6; $i++) {
        $t = $sv("service_{$i}_title");
        $d = $sv("service_{$i}_desc");
        // skip jika hidden (null) atau kosong
        if ($t !== null && $t !== '') {
            $services[] = [$t, ($d !== null ? $d : '')];
        }
    }
    if (empty($services)) $services = $defaultServices;

    $sectionTitle = $sv('title', 'LAYANAN KAMI');
    $sectionSub   = $sv('subtitle', 'Struktur naskah profesional yang dirancang khusus untuk mendominasi platform digital.');
@endphp

<section class="py-24 bg-[#3D0066] border-b-8 border-black relative">
    <div class="absolute inset-0 bg-[radial-gradient(rgba(0,0,0,0.15)_1px,transparent_1px)] [background-size:16px_16px]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        @if($sectionTitle !== null)
        <h2 class="text-4xl md:text-6xl font-black text-[#FFD200] uppercase text-center mb-4 tracking-tighter">
            <span class="bg-black text-white px-4 py-1 inline-block border-4 border-white shadow-[6px_6px_0px_0px_#E61E50]">
                {{ $sectionTitle }}
            </span>
        </h2>
        @endif

        @if($sectionSub !== null)
        <p class="text-center font-bold text-white/80 mb-16 text-lg max-w-md mx-auto">
            {{ $sectionSub }}
        </p>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_#FFD200] hover:shadow-[12px_12px_0px_0px_#E61E50] hover:-translate-y-2 transition-all group">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-5 h-5 bg-[#E61E50] border-2 border-black flex-shrink-0 transform rotate-45"></div>
                    <div class="w-full h-[3px] bg-black"></div>
                </div>
                <h3 class="font-black text-2xl uppercase mb-3 text-black tracking-tight leading-none">
                    {{ $service[0] }}
                </h3>
                @if($service[1])
                <p class="font-bold text-black/70 leading-relaxed text-sm italic bg-stone-100 p-3 border-l-4 border-[#3D0066]">
                    "{{ $service[1] }}"
                </p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ── PROSES KERJA ──────────────────────────────────────────── --}}
@if($processS && $processS->is_active)
@php
    $defaultSteps = [
        ['01', 'KONSULTASI AWAL',   'Membedah visi produk, detail brief, serta segmentasi audiens yang disasar.'],
        ['02', 'RANCANG KONSEP',    'Penyusunan premis cerita, angle penulisan, dan penentuan hook utama.'],
        ['03', 'PENULISAN DRAFT',   'Eksekusi naskah baris per baris lengkap dengan instruksi visual/audio.'],
        ['04', 'REVISI & FINAL',    'Penyelarasan feedback berkala hingga naskah dinilai solid & siap rekam.'],
        ['05', 'DUKUNGAN PRODUKSI', 'Pendampingan interpretasi naskah agar proses syuting tidak melenceng dari konsep.'],
    ];

    $steps = [];
    for ($i = 1; $i <= 5; $i++) {
        $t = $prv("step_{$i}_title");
        $d = $prv("step_{$i}_desc");
        if ($t !== null && $t !== '') {
            $num    = str_pad($i, 2, '0', STR_PAD_LEFT);
            $steps[] = [$num, $t, ($d !== null ? $d : '')];
        }
    }
    if (empty($steps)) $steps = $defaultSteps;

    $processTitle = $prv('title', 'Alur Kerja Pembuatan Naskah');
@endphp

<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-5xl mx-auto px-6">

        @if($processTitle !== null)
        <h2 class="text-4xl md:text-5xl font-black text-center uppercase mb-20 tracking-tighter text-[#3D0066]">
            {{ $processTitle }}
        </h2>
        @endif

        <div class="space-y-6 relative">
            @foreach($steps as $step)
            <div class="flex flex-col md:flex-row items-center gap-6 p-6 border-4 border-black bg-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:bg-[#FFD200] transition-all group">
                <div class="text-4xl md:text-5xl font-black text-[#E61E50] group-hover:text-black transition-colors w-full md:w-20 flex-shrink-0 text-center bg-black text-white md:bg-transparent md:text-[#E61E50] py-2 md:py-0 border-b-4 border-black md:border-none">
                    {{ $step[0] }}
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h4 class="text-xl md:text-2xl font-black uppercase leading-none mb-2 text-black">
                        {{ $step[1] }}
                    </h4>
                    @if($step[2])
                    <p class="font-bold text-black/70 text-sm md:text-base">
                        {{ $step[2] }}
                    </p>
                    @endif
                </div>
                <div class="hidden md:block">
                    <svg class="w-8 h-8 transform group-hover:translate-x-2 transition-transform text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ── PAKET HARGA ───────────────────────────────────────────── --}}
@if($pricingS && $pricingS->is_active)
<section class="py-24 bg-[#1a88d1] border-b-8 border-black relative">
    <div class="max-w-7xl mx-auto px-6">

        @if($pv('title') !== null)
        <h2 class="text-4xl font-black uppercase mb-16 text-center text-white tracking-tight drop-shadow-[3px_3px_0px_rgba(0,0,0,1)] italic">
            {{ $pv('title', 'Paket Harga Jasa Penulisan Script Video') }}
        </h2>
        @endif

        @php
            $checkTeal   = '<svg class="w-5 h-5 text-[#14b8a6] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';
            $checkPurple = '<svg class="w-5 h-5 text-[#430A5D] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>';

            $ctaUrl  = $pv('cta_url',  'https://wa.me/6287786000919');
            $ctaText = $pv('cta_text', 'Pesan Sekarang');
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto items-stretch">

            {{-- ── SHORT ── --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between transform hover:-translate-y-1 transition-all">
                <div>
                    <h3 class="text-2xl font-black text-[#14b8a6] uppercase mb-2 tracking-tight">SHORT</h3>

                    @if($pv('short_price_ori') !== null && $pv('short_price_ori') !== '')
                    <div class="text-sm line-through text-red-500 font-extrabold">{{ $pv('short_price_ori') }}</div>
                    @endif

                    @if($pv('short_price') !== null)
                    <div class="text-4xl font-black text-black my-1">{{ $pv('short_price', 'Rp 250.000') }}</div>
                    @endif

                    @if($pv('short_duration') !== null)
                    <div class="text-xs bg-stone-200 border-2 border-black inline-block px-2 py-0.5 font-black uppercase mb-6">
                        {{ $pv('short_duration', '< 1 Menit') }}
                    </div>
                    @endif

                    <ul class="text-xs font-bold space-y-3 text-left uppercase border-t-2 border-black pt-4">
                        @for($i = 1; $i <= 5; $i++)
                            @php $feat = $pv("short_feature_{$i}"); @endphp
                            @if($feat !== null && $feat !== '')
                            <li class="flex items-center gap-2">{!! $checkTeal !!} {{ $feat }}</li>
                            @endif
                        @endfor
                    </ul>
                </div>
                @if($ctaText !== null)
                <a href="{{ $ctaUrl ?? 'https://wa.me/6287786000919' }}"
                   class="mt-8 block w-full bg-[#14b8a6] text-white py-3 text-center font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                    {{ $ctaText }}
                </a>
                @endif
            </div>

            {{-- ── MEDIUM ── --}}
            <div class="bg-[#FFD217] border-4 border-black p-8 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between relative transform md:-translate-y-2 z-10">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-black text-[#FFD217] text-xs font-black px-4 py-1 border-2 border-white uppercase tracking-wider shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    TERPOPULER
                </div>
                <div>
                    <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2 tracking-tight mt-2">MEDIUM</h3>

                    @if($pv('medium_price_ori') !== null && $pv('medium_price_ori') !== '')
                    <div class="text-sm line-through text-red-600 font-extrabold">{{ $pv('medium_price_ori') }}</div>
                    @endif

                    @if($pv('medium_price') !== null)
                    <div class="text-4xl font-black text-black my-1">{{ $pv('medium_price', 'Rp 500.000') }}</div>
                    @endif

                    @if($pv('medium_duration') !== null)
                    <div class="text-xs bg-black text-white inline-block px-2 py-0.5 font-black uppercase mb-6">
                        {{ $pv('medium_duration', '1 - 3 Menit') }}
                    </div>
                    @endif

                    <ul class="text-xs font-bold space-y-3 text-left uppercase border-t-2 border-black pt-4">
                        @for($i = 1; $i <= 6; $i++)
                            @php $feat = $pv("medium_feature_{$i}"); @endphp
                            @if($feat !== null && $feat !== '')
                            <li class="flex items-center gap-2">{!! $checkPurple !!} {{ $feat }}</li>
                            @endif
                        @endfor
                    </ul>
                </div>
                @if($ctaText !== null)
                <a href="{{ $ctaUrl ?? 'https://wa.me/6287786000919' }}"
                   class="mt-8 block w-full bg-black text-white py-4 text-center font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(67,10,93,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                    {{ $ctaText }}
                </a>
                @endif
            </div>

            {{-- ── LONG ── --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between transform hover:-translate-y-1 transition-all">
                <div>
                    <h3 class="text-2xl font-black text-[#430A5D] uppercase mb-2 tracking-tight">LONG</h3>

                    @if($pv('long_price_ori') !== null && $pv('long_price_ori') !== '')
                    <div class="text-sm line-through text-red-500 font-extrabold">{{ $pv('long_price_ori') }}</div>
                    @endif

                    @if($pv('long_price') !== null)
                    <div class="text-4xl font-black text-black my-1">{{ $pv('long_price', 'Rp 1.000.000') }}</div>
                    @endif

                    @if($pv('long_duration') !== null)
                    <div class="text-xs bg-stone-200 border-2 border-black inline-block px-2 py-0.5 font-black uppercase mb-6">
                        {{ $pv('long_duration', '3 - 10 Menit') }}
                    </div>
                    @endif

                    <ul class="text-xs font-bold space-y-3 text-left uppercase border-t-2 border-black pt-4">
                        @for($i = 1; $i <= 7; $i++)
                            @php
                                $feat = $pv("long_feature_{$i}");
                                // Feature 4 (REVISI SEPUASNYA) tampil merah
                                $isHighlight = ($i === 4);
                            @endphp
                            @if($feat !== null && $feat !== '')
                            <li class="flex items-center gap-2 {{ $isHighlight ? 'text-red-600' : '' }}">
                                {!! $checkPurple !!} {{ $feat }}
                            </li>
                            @endif
                        @endfor
                    </ul>
                </div>
                @if($ctaText !== null)
                <a href="{{ $ctaUrl ?? 'https://wa.me/6287786000919' }}"
                   class="mt-8 block w-full bg-gradient-to-r from-[#430A5D] to-[#3B82F6] text-white py-3 text-center font-black uppercase text-sm border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                    {{ $ctaText }}
                </a>
                @endif
            </div>

        </div>
    </div>
</section>
@endif


{{-- ── CTA FINAL FOOTER ─────────────────────────────────────── --}}
@if($ctaS && $ctaS->is_active)
<footer class="py-24 bg-black text-white text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <div class="inline-block p-3 border-4 border-dashed border-[#FFD200] mb-8 animate-pulse transform -rotate-1">
            <span class="font-black text-lg md:text-2xl uppercase tracking-wider text-[#FFD200]">
                Don't Let Your Video Flop! 💥
            </span>
        </div>

        @if($cv('title') !== null)
        <h2 class="text-4xl md:text-7xl font-black uppercase mb-12 tracking-tighter text-yellow-400 leading-none">
            {{ $cv('title', 'SIAP BIKIN VIDEO YANG VIRAL?') }}
        </h2>
        @endif

        @if($cv('cta_text') !== null)
        <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
           class="inline-flex items-center gap-4 bg-white text-black px-8 md:px-16 py-6 md:py-8 font-black text-2xl md:text-4xl uppercase border-4 border-white shadow-[12px_12px_0px_0px_rgba(250,204,21,1)] hover:bg-[#3B82F6] hover:text-white hover:border-black hover:shadow-[6px_6px_0px_0px_rgba(255,255,255,1)] hover:translate-x-1 hover:translate-y-1 transition-all italic tracking-tight">
            {{ $cv('cta_text', 'PESAN SCRIPT SEKARANG') }}
            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
            </svg>
        </a>
        @endif
    </div>
</footer>
@endif

@endsection