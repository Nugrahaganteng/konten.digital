@extends('layouts.app')

@section('title', 'Jasa Buzzer Indonesia - HNP Communications.id')

@section('content')

@php
    $heroS     = $sections->get('hero');
    $problemsS = $sections->get('problems');
    $whyS      = $sections->get('why_buzzer');
    $servicesS = $sections->get('services_list');
    $processS  = $sections->get('process');
    $pricingS  = $sections->get('pricing');
    $ctaS      = $sections->get('cta');

    $field = function($section, string $key, mixed $default = '') {
        if (!$section) return $default;
        $val = $section->getField($key);
        if (\App\Models\PageSection::isHiddenValue($val)) return null;
        return $val ?: $default;
    };

    $hv  = fn($k, $d = '') => $field($heroS,     $k, $d);
    $pbv = fn($k, $d = '') => $field($problemsS, $k, $d);
    $wv  = fn($k, $d = '') => $field($whyS,      $k, $d);
    $sv  = fn($k, $d = '') => $field($servicesS, $k, $d);
    $prv = fn($k, $d = '') => $field($processS,  $k, $d);
    $pv  = fn($k, $d = '') => $field($pricingS,  $k, $d);
    $cv  = fn($k, $d = '') => $field($ctaS,      $k, $d);
@endphp

{{-- ── HERO SECTION ──────────────────────────────────────────────────────────── --}}
<section class="relative pt-32 pb-24 bg-[#3D0066] overflow-hidden border-b-8 border-black">
    <div class="absolute top-20 left-10 w-16 h-16 bg-[#FFD217] opacity-10 rounded-lg rotate-12 animate-bounce-slow"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        {{-- Text Side --}}
        <div class="space-y-6 order-2 md:order-1">
            @if($hv('badge_text') !== null)
            <div class="inline-block px-4 py-1 border-4 border-black bg-[#FFD217] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-black font-black text-xs tracking-widest uppercase">
                    {{ $hv('badge_text', '✦ JASA BUZZER MEDIA SOSIAL') }}
                </span>
            </div>
            @endif

            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white leading-[0.95] uppercase tracking-tighter">
                @if($hv('title_line1') !== null)
                    {{ $hv('title_line1', 'JASA BUZZER') }}<br>
                @endif
                @if($hv('title_line2') !== null)
                    {{ $hv('title_line2', 'INDONESIA') }}<br>
                @endif
                @if($hv('title_line3') !== null)
                <span class="bg-[#FFD217] text-black px-3 inline-block my-2 transform rotate-1 border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] text-3xl sm:text-5xl md:text-6xl">
                    {{ $hv('title_line3', '+20.000 MEMBER') }}
                </span>
                @endif
            </h1>

            @if($hv('tagline') !== null)
            <p class="text-xl sm:text-2xl font-black text-[#FFD217] tracking-tight uppercase">
                {{ $hv('tagline', 'Bantu Branding Bisnis & Naikkan Interaksi') }}
            </p>
            @endif

            @if($hv('description') !== null)
            <p class="text-base sm:text-lg font-bold text-white/90 leading-relaxed max-w-xl">
                {{ $hv('description', 'Ingin memperkuat citra dan promosi brand Anda? Jasa Buzzer Indonesia dengan lebih dari 20.000 member siap bantu branding bisnis agar lebih dikenal luas.') }}
            </p>
            @endif

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-4">
                <a href="#pricing" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-white text-black font-black text-lg border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:bg-[#FFD217] transition-all hover:translate-x-1 hover:translate-y-1 hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Rate Card
                </a>
                <a href="{{ $hv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="inline-flex justify-center items-center gap-3 px-8 py-4 bg-[#E61E50] text-white font-black text-lg border-4 border-black hover:bg-white hover:text-black transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                    {{ $hv('cta_text', 'Hubungi Tim') }}
                    <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Image Side --}}
        <div class="relative flex justify-center items-center min-h-[400px] sm:min-h-[500px] order-1 md:order-2">
            <div class="absolute w-[280px] h-[280px] sm:w-[380px] sm:h-[380px] border-4 border-black bg-[#E61E50] rounded-full translate-x-4 translate-y-4"></div>
            <div class="relative w-[260px] h-[260px] sm:w-[360px] sm:h-[360px] bg-[#1a88d1] border-4 border-black rounded-full shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">

                @php $heroImg = $heroS ? $heroS->getField('image') : null; @endphp
                <img src="{{ $heroImg && !\App\Models\PageSection::isHiddenValue($heroImg) ? Storage::url($heroImg) : asset('images/buzzer-hero.png') }}"
                     alt="Jasa Buzzer Indonesia"
                     class="absolute w-[110%] max-w-none transition-all duration-500 z-10 transform -translate-y-6 drop-shadow-[8px_8px_0px_rgba(0,0,0,1)] hover:scale-105">

            

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



{{-- ── SECTION 2: PROBLEM IDENTIFICATION (CMS-CONNECTED) ─────────────────────── --}}
@if($problemsS && $problemsS->is_active)
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

        {{-- Left Side: Image --}}
        <div class="relative flex justify-center items-center min-h-[350px] sm:min-h-[400px]">
            <div class="absolute w-[260px] h-[260px] sm:w-[340px] sm:h-[340px] border-4 border-black bg-[#3D0066] rounded-full"></div>
            <div class="relative w-[240px] h-[240px] sm:w-[320px] sm:h-[320px] bg-stone-100 border-4 border-black rounded-full shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">

                @php
                    $problemImg = $problemsS ? $problemsS->getField('image') : null;
                    $problemImgUrl = ($problemImg && !\App\Models\PageSection::isHiddenValue($problemImg))
                        ? Storage::url($problemImg)
                        : asset('images/sad-persona.png');
                @endphp
                <img src="{{ $problemImgUrl }}" alt="Masalah Bisnis"
                     class="absolute w-[105%] max-w-none z-10 transform -translate-y-4 drop-shadow-[6px_6px_0px_rgba(0,0,0,0.15)]">

                
            </div>
        </div>

        {{-- Right Side: Problem Points dari CMS --}}
        <div class="space-y-6">
            @if($pbv('title') !== null)
            <div class="inline-block border-4 border-black bg-[#E61E50] p-4 transform -rotate-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-2xl sm:text-4xl font-black uppercase text-white tracking-tighter">
                    {{ $pbv('title', 'Apakah Anda pernah merasakan hal ini?') }}
                </h2>
            </div>
            @endif

            @if($pbv('description') !== null)
            <p class="text-base sm:text-lg font-bold text-black/80 leading-snug">
                {{ $pbv('description', 'Branding sosial media hingga marketplace tidak kunjung berhasil dan tidak kunjung membuat perkembangan yang signifikan.') }}
            </p>
            @endif

            @php
            $problemIcons = [
                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0zM7 10a2 2 0 11-4 0 2 2 0z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
            ];
            $problemBgColors   = ['bg-[#3D0066]','bg-[#1a88d1]','bg-[#FFD217]','bg-[#E61E50]','bg-black','bg-[#3D0066]'];
            $problemIconColors = ['text-white','text-white','text-black','text-white','text-white','text-white'];
            @endphp

            <div class="space-y-4 pt-2">
                @for($i = 1; $i <= 6; $i++)
                @php $problemText = $pbv("problem_{$i}"); @endphp
                @if($problemText !== null && $problemText !== '')
                <div class="flex items-start gap-4 p-4 border-4 border-black bg-stone-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="p-2 {{ $problemBgColors[$i-1] }} border-2 border-black {{ $problemIconColors[$i-1] }} flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            {!! $problemIcons[$i-1] !!}
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-black text-base uppercase text-black">{{ $problemText }}</h4>
                    </div>
                </div>
                @endif
                @endfor
            </div>
        </div>
    </div>
</section>
@endif


{{-- ── SECTION 3: MANFAAT / SERVICES LIST ────────────────────────────────────── --}}
<section class="py-24 bg-[#FFD217] border-b-8 border-black relative">
    <div class="absolute inset-0 bg-[radial-gradient(rgba(0,0,0,0.1)_1px,transparent_1px)] [background-size:20px_20px]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            @if($sv('title') !== null)
            <h2 class="text-3xl sm:text-5xl font-black text-black uppercase tracking-tighter leading-tight">
                {{ $sv('title', 'LAYANAN KAMI') }}<br>
                <span class="bg-black text-white px-4 py-1 inline-block border-4 border-white shadow-[6px_6px_0px_0px_#E61E50] transform -rotate-1 mt-2">
                    HNP Communications.id
                </span>
            </h2>
            @endif
            @if($sv('subtitle') !== null)
            <p class="font-bold text-black/80 text-base sm:text-lg max-w-xl mx-auto">
                {{ $sv('subtitle', 'Strategi buzzer profesional yang dirancang khusus untuk mendominasi platform digital.') }}
            </p>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $serviceCards = [
                ['key_t' => 'service_1_title', 'key_d' => 'service_1_desc', 'default_t' => 'BUZZER CAMPAIGN',        'default_d' => 'Buzzer kami siap membantu sukseskan campaign Anda, interaksi yang tinggi pada campaign membantu perluas jangkauan sehingga campaign dapat dilihat banyak orang.', 'icon_color' => 'bg-[#E61E50]', 'hover' => 'hover:shadow-[12px_12px_0px_0px_#E61E50]', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>', 'icon_text' => 'text-white'],
                ['key_t' => 'service_2_title', 'key_d' => 'service_2_desc', 'default_t' => 'BUZZER TRENDING TOPIK',  'default_d' => 'Naiknya hashtag dan keyword di trending topik twitter dengan bantuan buzzer membantu campaign bisnis viral bahkan dilirik media nasional.', 'icon_color' => 'bg-[#1a88d1]', 'hover' => 'hover:shadow-[12px_12px_0px_0px_#3D0066]', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>', 'icon_text' => 'text-white'],
                ['key_t' => 'service_3_title', 'key_d' => 'service_3_desc', 'default_t' => 'BUZZER FYP',             'default_d' => 'Ribuan akun buzzer aktif dapat menghasilkan konten tiktok Anda mudah masuk FYP dan hasilkan interaksi yang tinggi.', 'icon_color' => 'bg-[#3D0066]', 'hover' => 'hover:shadow-[12px_12px_0px_0px_#E61E50]', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>', 'icon_text' => 'text-white'],
                ['key_t' => 'service_4_title', 'key_d' => 'service_4_desc', 'default_t' => 'BUZZER REVIEW & RATING', 'default_d' => 'Tempat bisnis Anda di google maps bisa menghasilkan ribuan review dan rating bintang 5 dengan buzzer kami.', 'icon_color' => 'bg-[#FFD217]', 'hover' => 'hover:shadow-[12px_12px_0px_0px_#1a88d1]', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>', 'icon_text' => 'text-black'],
                ['key_t' => 'service_5_title', 'key_d' => 'service_5_desc', 'default_t' => 'BUZZER CLIPPER',         'default_d' => 'Konten original Anda dapat menghasilkan ribuan clip dan posting yang dilakukan oleh buzzer clipper video dari kami.', 'icon_color' => 'bg-[#3D0066]', 'hover' => 'hover:shadow-[12px_12px_0px_0px_#E61E50]', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>', 'icon_text' => 'text-white'],
                ['key_t' => 'service_6_title', 'key_d' => 'service_6_desc', 'default_t' => 'BUZZER TERJUAL & ULASAN','default_d' => 'Ribuan buzzer kami mampu menghasilkan ribuan bahkan puluhan ribu jumlah terjual serta ulasan pada produk Anda di marketplace.', 'icon_color' => 'bg-[#E61E50]', 'hover' => 'hover:shadow-[12px_12px_0px_0px_#1a88d1]', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>', 'icon_text' => 'text-white'],
            ];
            @endphp

            @foreach($serviceCards as $card)
            @php
                $cardTitle = $sv($card['key_t'], $card['default_t']);
                $cardDesc  = $sv($card['key_d'],  $card['default_d']);
            @endphp
            @if($cardTitle !== null)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] {{ $card['hover'] }} hover:-translate-y-2 transition-all group">
                <div class="w-12 h-12 {{ $card['icon_color'] }} border-4 border-black {{ $card['icon_text'] }} flex items-center justify-center mb-6 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        {!! $card['icon'] !!}
                    </svg>
                </div>
                <h3 class="font-black text-xl uppercase mb-3 text-black tracking-tight">
                    {{ $cardTitle }}
                </h3>
                @if($cardDesc !== null)
                <p class="font-bold text-black/70 text-sm leading-relaxed">
                    {{ $cardDesc }}
                </p>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>


{{-- ── SECTION 4: PROSES KERJA ────────────────────────────────────────────────── --}}
@if($processS && $processS->is_active)
<section class="py-24 bg-[#3D0066] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        @if($prv('title') !== null)
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-5xl font-black text-white uppercase tracking-tighter">
                {{ $prv('title', 'Alur Kerja Kampanye Buzzer') }}
            </h2>
        </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @php
            $steps = [
                ['key_t' => 'step_1_title', 'key_d' => 'step_1_desc', 'default_t' => 'KONSULTASI AWAL',    'default_d' => 'Membedah tujuan kampanye, target audiens, dan platform yang disasar.', 'num' => '01', 'color' => 'bg-[#FFD217] text-black'],
                ['key_t' => 'step_2_title', 'key_d' => 'step_2_desc', 'default_t' => 'RANCANG STRATEGI',   'default_d' => 'Penyusunan narasi, hashtag, dan jadwal penyebaran yang optimal.', 'num' => '02', 'color' => 'bg-[#E61E50] text-white'],
                ['key_t' => 'step_3_title', 'key_d' => 'step_3_desc', 'default_t' => 'EKSEKUSI KAMPANYE',  'default_d' => 'Penyebaran konten secara masif dan terkoordinasi di semua platform.', 'num' => '03', 'color' => 'bg-white text-black'],
                ['key_t' => 'step_4_title', 'key_d' => 'step_4_desc', 'default_t' => 'MONITORING',         'default_d' => 'Pemantauan engagement, reach, dan respons audiens secara langsung.', 'num' => '04', 'color' => 'bg-[#1a88d1] text-white'],
                ['key_t' => 'step_5_title', 'key_d' => 'step_5_desc', 'default_t' => 'LAPORAN & ANALISIS', 'default_d' => 'Laporan lengkap performa kampanye beserta rekomendasi lanjutan.', 'num' => '05', 'color' => 'bg-[#FFD217] text-black'],
            ];
            @endphp

            @foreach($steps as $step)
            @php
                $stepTitle = $prv($step['key_t'], $step['default_t']);
                $stepDesc  = $prv($step['key_d'],  $step['default_d']);
            @endphp
            @if($stepTitle !== null)
            <div class="border-4 border-black shadow-[6px_6px_0px_0px_rgba(255,210,23,1)] p-6 {{ $step['color'] }}">
                <div class="text-5xl font-black opacity-20 mb-3">{{ $step['num'] }}</div>
                <h4 class="font-black text-sm uppercase tracking-tight mb-2">{{ $stepTitle }}</h4>
                @if($stepDesc !== null)
                <p class="text-xs font-bold opacity-80 leading-relaxed">{{ $stepDesc }}</p>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ── SECTION 5: PAKET HARGA ─────────────────────────────────────────────────── --}}
@if($pricingS && $pricingS->is_active)
<section id="pricing" class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        @if($pv('title') !== null)
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-5xl font-black text-black uppercase tracking-tighter">
                {{ $pv('title', 'Paket Harga Jasa Buzzer') }}
            </h2>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">

            {{-- BASIC --}}
            @if($pv('basic_price') !== null)
            <div class="border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 bg-stone-50 flex flex-col">
                <div class="mb-6">
                    <div class="inline-block bg-black text-white px-4 py-1 font-black text-xs uppercase tracking-widest mb-4">BASIC</div>
                    @if($pv('basic_duration') !== null)
                    <p class="font-bold text-black/60 text-sm mb-2">{{ $pv('basic_duration') }}</p>
                    @endif
                    @if($pv('basic_price_ori') !== null)
                    <p class="text-black/40 line-through font-bold text-lg">{{ $pv('basic_price_ori') }}</p>
                    @endif
                    <p class="text-4xl font-black text-black">{{ $pv('basic_price') }}</p>
                </div>
                <ul class="space-y-3 flex-1 mb-8">
                    @foreach(['basic_feature_1','basic_feature_2','basic_feature_3','basic_feature_4','basic_feature_5'] as $feat)
                    @if($pv($feat) !== null && $pv($feat) !== '')
                    <li class="flex items-start gap-2 font-bold text-sm">
                        <span class="text-[#3D0066] mt-0.5">✓</span>{{ $pv($feat) }}
                    </li>
                    @endif
                    @endforeach
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="block text-center px-6 py-3 bg-black text-white font-black uppercase border-4 border-black shadow-[4px_4px_0px_0px_rgba(61,0,102,1)] hover:bg-[#3D0066] transition-all text-sm">
                    {{ $pv('cta_text', 'Pesan Sekarang') }}
                </a>
            </div>
            @endif

            {{-- STANDARD --}}
            @if($pv('standard_price') !== null)
            <div class="border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 bg-[#FFD217] flex flex-col relative">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#E61E50] text-white px-4 py-1 font-black text-xs uppercase tracking-widest border-4 border-black whitespace-nowrap">
                    ⭐ TERPOPULER
                </div>
                <div class="mb-6 mt-4">
                    <div class="inline-block bg-black text-white px-4 py-1 font-black text-xs uppercase tracking-widest mb-4">STANDARD</div>
                    @if($pv('standard_duration') !== null)
                    <p class="font-bold text-black/60 text-sm mb-2">{{ $pv('standard_duration') }}</p>
                    @endif
                    @if($pv('standard_price_ori') !== null)
                    <p class="text-black/40 line-through font-bold text-lg">{{ $pv('standard_price_ori') }}</p>
                    @endif
                    <p class="text-4xl font-black text-black">{{ $pv('standard_price') }}</p>
                </div>
                <ul class="space-y-3 flex-1 mb-8">
                    @foreach(['standard_feature_1','standard_feature_2','standard_feature_3','standard_feature_4','standard_feature_5','standard_feature_6'] as $feat)
                    @if($pv($feat) !== null && $pv($feat) !== '')
                    <li class="flex items-start gap-2 font-bold text-sm">
                        <span class="text-[#3D0066] mt-0.5">✓</span>{{ $pv($feat) }}
                    </li>
                    @endif
                    @endforeach
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="block text-center px-6 py-3 bg-black text-white font-black uppercase border-4 border-black shadow-[4px_4px_0px_0px_rgba(230,30,80,1)] hover:bg-[#E61E50] transition-all text-sm">
                    {{ $pv('cta_text', 'Pesan Sekarang') }}
                </a>
            </div>
            @endif

            {{-- PREMIUM --}}
            @if($pv('premium_price') !== null)
            <div class="border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 bg-[#3D0066] flex flex-col">
                <div class="mb-6">
                    <div class="inline-block bg-[#FFD217] text-black px-4 py-1 font-black text-xs uppercase tracking-widest mb-4">PREMIUM</div>
                    @if($pv('premium_duration') !== null)
                    <p class="font-bold text-white/60 text-sm mb-2">{{ $pv('premium_duration') }}</p>
                    @endif
                    @if($pv('premium_price_ori') !== null)
                    <p class="text-white/40 line-through font-bold text-lg">{{ $pv('premium_price_ori') }}</p>
                    @endif
                    <p class="text-4xl font-black text-white">{{ $pv('premium_price') }}</p>
                </div>
                <ul class="space-y-3 flex-1 mb-8">
                    @foreach(['premium_feature_1','premium_feature_2','premium_feature_3','premium_feature_4','premium_feature_5','premium_feature_6','premium_feature_7'] as $feat)
                    @if($pv($feat) !== null && $pv($feat) !== '')
                    <li class="flex items-start gap-2 font-bold text-sm text-white">
                        @if($pv($feat) === 'GARANSI VIRAL')
                        <span class="bg-[#FFD217] text-black px-2 py-0.5 font-black text-xs border-2 border-black">🔥 {{ $pv($feat) }}</span>
                        @else
                        <span class="text-[#FFD217] mt-0.5">✓</span>{{ $pv($feat) }}
                        @endif
                    </li>
                    @endif
                    @endforeach
                </ul>
                <a href="{{ $pv('cta_url', 'https://wa.me/6287786000919') }}"
                   class="block text-center px-6 py-3 bg-[#FFD217] text-black font-black uppercase border-4 border-black shadow-[4px_4px_0px_0px_rgba(230,30,80,1)] hover:bg-white transition-all text-sm">
                    {{ $pv('cta_text', 'Pesan Sekarang') }}
                </a>
            </div>
            @endif

        </div>
    </div>
</section>
@endif


{{-- ── CTA FINAL ────────────────────────────────────────────────────────────── --}}
@if($ctaS && $ctaS->is_active)
<footer class="py-24 bg-black text-white text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:24px_24px]"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <div class="inline-block p-3 border-4 border-dashed border-[#FFD200] mb-8 animate-pulse transform -rotate-1">
            <span class="font-black text-base sm:text-xl md:text-2xl uppercase tracking-wider text-[#FFD200]">
                Boost Your Digital Authority Now! 🚀
            </span>
        </div>

        @if($cv('title') !== null)
        <h2 class="text-3xl sm:text-5xl md:text-7xl font-black uppercase mb-12 tracking-tighter text-yellow-400 leading-none">
            {{ $cv('title', 'SIAP BUAT BRAND ANDA VIRAL SEKARANG?') }}
        </h2>
        @endif

        @if($cv('cta_text') !== null)
        <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
           class="inline-flex items-center gap-4 bg-white text-black px-6 sm:px-12 py-5 sm:py-7 font-black text-xl sm:text-3xl md:text-4xl uppercase border-4 border-white shadow-[12px_12px_0px_0px_rgba(250,204,21,1)] hover:bg-[#3B82F6] hover:text-white hover:border-black hover:shadow-[6px_6px_0px_0px_rgba(255,255,255,1)] hover:translate-x-1 hover:translate-y-1 transition-all italic tracking-tight w-full sm:w-auto justify-center">
            {{ $cv('cta_text', 'KONSULTASI BERSAMA TIM') }}
            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
            </svg>
        </a>
        @endif

        <p class="text-xs font-mono text-stone-500 mt-12 uppercase tracking-widest">
            © {{ date('Y') }} HNP Communications.id. All rights reserved.
        </p>
    </div>
</footer>
@endif

@endsection