@extends('layouts.app')
@section('title', 'Jasa Press Release & Digital Agency')

@section('content')

@php
    // ── Ambil data section dari CMS ─────────────────────────────────
    $hero    = $sections->get('hero');
    $stats   = $sections->get('stats');
    $marquee = $sections->get('marquee');
    $about   = $sections->get('about_agency');
    $svcSec  = $sections->get('services');
    $clients = $sections->get('clients');
    $cta     = $sections->get('contact_cta');

    // ── Helper: ambil nilai field (null jika hidden, fallback jika kosong) ──
    // Bedakan 3 kondisi:
    //   - field hidden  → return null  (elemen HTML tidak dirender)
    //   - field ada & isi → return nilai
    //   - field kosong  → return $default
    $val = function(?\App\Models\PageSection $section, string $key, string $default = '') {
        if (!$section) return $default;
        if ($section->isFieldHidden($key)) return null;   // ← hidden = null
        $v = data_get($section->content, $key);
        return ($v !== null && $v !== '') ? $v : $default;
    };

    $h  = fn(string $key, string $default = '') => $val($hero,    $key, $default);
    $st = fn(string $key, string $default = '') => $val($stats,   $key, $default);
    $mq = fn(string $key, string $default = '') => $val($marquee, $key, $default);
    $a  = fn(string $key, string $default = '') => $val($about,   $key, $default);
    $sv = fn(string $key, string $default = '') => $val($svcSec,  $key, $default);
    $cl = fn(string $key, string $default = '') => $val($clients, $key, $default);
    $ct = fn(string $key, string $default = '') => $val($cta,     $key, $default);
@endphp

{{-- ══ HERO ═════════════════════════════════════════════ --}}
<section class="min-h-screen border-b-4 border-black flex flex-col pt-20 overflow-hidden relative"
         style="background-color: {{ $h('bg_color', '#facc15') }}">

    <div class="absolute top-20 left-10 animate-float opacity-40 text-6xl hidden lg:block select-none">⭐</div>
    <div class="absolute top-40 right-20 animate-float-slow opacity-30 text-7xl hidden lg:block select-none">🚀</div>
    <div class="absolute bottom-20 left-1/4 animate-ufo opacity-20 text-5xl hidden lg:block select-none">👾</div>
    <div class="absolute top-1/2 right-10 animate-spin-slow opacity-20 text-8xl hidden lg:block select-none">⚙️</div>

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-3 gap-8 px-6 lg:px-16 items-center py-12 relative z-10">

        {{-- Kiri --}}
        <div class="flex flex-col gap-6 reveal">

            {{-- Badge: hanya render jika TIDAK hidden --}}
            @if($h('badge_text') !== null)
            <span class="inline-flex items-center gap-2 bg-red-500 text-white font-black text-xs
                         tracking-widest uppercase px-4 py-2 border-[2.5px] border-black w-fit
                         -rotate-1 group hover:rotate-2 transition-transform cursor-default shadow-neo-sm"
                  style="font-family:'Unbounded',sans-serif">
                ✦ {{ $h('badge_text', 'DIGITAL AGENCY') }}
            </span>
            @endif

            {{-- Subtitle --}}
            @if($h('subtitle') !== null)
            <p class="text-lg font-bold text-purple-950 max-w-xs leading-relaxed text-glitch cursor-default">
                {!! nl2br(e($h('subtitle', "Kami bukan agensi biasa.\nKami adalah partner kreatif yang bikin brand kamu berkesan di galaksi ini."))) !!}
            </p>
            @endif

            {{-- CTA --}}
            @if($h('cta_url') !== null || $h('cta_text') !== null)
            <a href="{{ $h('cta_url', 'https://wa.me/6281234567890') }}"
               class="btn-pop w-fit text-base px-8 py-3 group">
                <span class="inline-block group-hover:translate-x-2 transition-transform">
                    {{ $h('cta_text', 'MULAI SEKARANG →') }}
                </span>
            </a>
            @endif
        </div>

        {{-- Tengah --}}
        <div class="flex flex-col items-center reveal relative">
            <h1 class="font-black leading-none text-center text-purple-950 text-glitch-heavy"
                 style="font-family:'Unbounded',sans-serif; font-size:clamp(4rem,10vw,8rem);">
                @if($h('title_line1') !== null)
                <span class="block">{{ $h('title_line1', 'KONTEN') }}</span>
                @endif
                @if($h('title_line2') !== null)
                <span class="block text-transparent" style="-webkit-text-stroke:3px #2d1b4e">
                    {{ $h('title_line2', 'DIGITAL') }}
                </span>
                @endif
            </h1>

            {{-- Maskot --}}
            @php $heroImage = ($hero && !$hero->isFieldHidden('image')) ? data_get($hero->content, 'image') : null; @endphp
            <div class="animate-ufo">
                @if($heroImage)
                    <img src="{{ Storage::url($heroImage) }}"
                         alt="HNP Communications — Jasa PR dan Digital Marketing Indonesia"
                         class="w-56 mt-4"
                         style="filter:drop-shadow(8px 8px 0 #000)">
                @else
                    <svg width="220" height="175" viewBox="0 0 220 175" fill="none"
                         style="margin-top:1rem; filter:drop-shadow(8px 8px 0 #000)">
                        <ellipse cx="110" cy="108" rx="68" ry="20" fill="#000"/>
                        <ellipse cx="110" cy="104" rx="68" ry="20" fill="#3b0764" stroke="#facc15" stroke-width="3"/>
                        <ellipse cx="110" cy="88" rx="40" ry="26" fill="#00a896"/>
                        <ellipse cx="110" cy="84" rx="36" ry="22" fill="#0dcfba"/>
                        <circle cx="97" cy="84" r="7" fill="#facc15"/><circle cx="110" cy="79" r="7" fill="#facc15"/>
                        <circle cx="123" cy="84" r="7" fill="#facc15"/>
                        <circle cx="97" cy="84" r="3.5" fill="#000"/><circle cx="110" cy="79" r="3.5" fill="#000"/>
                        <circle cx="123" cy="84" r="3.5" fill="#000"/>
                        <line x1="110" y1="62" x2="110" y2="48" stroke="#facc15" stroke-width="3" stroke-linecap="round"/>
                        <circle cx="110" cy="44" r="6" fill="#ef4444" stroke="#000" stroke-width="2" class="animate-radar"/>
                    </svg>
                @endif
            </div>
        </div>

        {{-- Kanan: Stats --}}
        <div class="flex flex-col items-end gap-4 reveal">
            {{-- Stat 1 --}}
            @if($st('stat_1_number') !== null || $st('stat_1_label') !== null)
            <div class="border-4 border-black shadow-neo p-5 text-right hover:-translate-y-2 hover:-translate-x-2 transition-transform cursor-pointer"
                 style="background-color: {{ $st('stat_1_color', '#3b0764') }}">
                @if($st('stat_1_number') !== null)
                <span class="block font-black text-5xl leading-none text-yellow-400"
                      style="font-family:'Unbounded',sans-serif">
                    {{ $st('stat_1_number', '200+') }}
                </span>
                @endif
                @if($st('stat_1_label') !== null)
                <span class="block text-xs font-bold uppercase tracking-widest text-yellow-400/60 mt-1">
                    {{ $st('stat_1_label', 'Media Partner') }}
                </span>
                @endif
            </div>
            @endif

            {{-- Stat 2 --}}
            @if($st('stat_2_number') !== null || $st('stat_2_label') !== null)
            <div class="border-4 border-black shadow-neo p-5 text-right hover:-translate-y-2 hover:-translate-x-2 transition-transform cursor-pointer"
                 style="background-color: {{ $st('stat_2_color', '#ef4444') }}">
                @if($st('stat_2_number') !== null)
                <span class="block font-black text-5xl leading-none text-white"
                      style="font-family:'Unbounded',sans-serif">
                    {{ $st('stat_2_number', '5+') }}
                </span>
                @endif
                @if($st('stat_2_label') !== null)
                <span class="block text-xs font-bold uppercase tracking-widest text-white/60 mt-1">
                    {{ $st('stat_2_label', 'Tahun Pengalaman') }}
                </span>
                @endif
            </div>
            @endif

            {{-- Stat 3 --}}
            @if($st('stat_3_number') !== null || $st('stat_3_label') !== null)
            <div class="border-4 border-black shadow-neo p-5 text-right hover:-translate-y-2 hover:-translate-x-2 transition-transform cursor-pointer"
                 style="background-color: {{ $st('stat_3_color', '#14b8a6') }}">
                @if($st('stat_3_number') !== null)
                <span class="block font-black text-5xl leading-none text-black"
                      style="font-family:'Unbounded',sans-serif">
                    {{ $st('stat_3_number', '1K+') }}
                </span>
                @endif
                @if($st('stat_3_label') !== null)
                <span class="block text-xs font-bold uppercase tracking-widest text-black/60 mt-1">
                    {{ $st('stat_3_label', 'Klien Puas') }}
                </span>
                @endif
            </div>
            @endif
        </div>
    </div>

    {{-- Mountain SVG --}}
    <svg viewBox="0 0 1440 160" fill="none" preserveAspectRatio="none" class="w-full block mt-auto">
        <path d="M0,160 L0,90 L60,30 L120,90 L200,10 L280,70 L360,0 L440,60 L520,15 L600,70 L680,5
                 L760,65 L840,20 L920,80 L1000,15 L1080,75 L1160,25 L1240,80 L1320,35 L1380,70
                 L1440,40 L1440,160 Z" fill="#3b0764"/>
    </svg>
</section>

{{-- ══ MARQUEE ════════════════════════════════════════════ --}}
<div class="overflow-hidden border-t-4 border-b-4 border-black py-3"
     style="background-color: {{ $mq('bg_color', '#ef4444') }}">
    <div class="animate-ticker">
        @for($i = 0; $i < 8; $i++)
        <div class="flex items-center gap-10 px-10 whitespace-nowrap font-black text-sm
                    uppercase tracking-widest text-white"
             style="font-family:'Unbounded',sans-serif">
            @if($mq('item_1') !== null) {{ $mq('item_1', 'PRESS RELEASE') }} @endif
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            @if($mq('item_2') !== null) {{ $mq('item_2', '200+ MEDIA NASIONAL') }} @endif
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            @if($mq('item_3') !== null) {{ $mq('item_3', 'GARANSI TAYANG') }} @endif
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            @if($mq('item_4') !== null) {{ $mq('item_4', 'PROSES CEPAT') }} @endif
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            @if($mq('item_5') !== null) {{ $mq('item_5', 'KONTEN DIGITAL') }} @endif
        </div>
        @endfor
    </div>
</div>

{{-- ══ ABOUT ══════════════════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-20 px-6 lg:px-16 relative overflow-hidden bg-space-stars" id="about">
    <div class="absolute -top-10 -right-10 w-40 h-40 border-4 border-yellow-400/20 rounded-full animate-spin-slow"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">

        {{-- Gambar --}}
        <div class="relative reveal">
            <div class="border-4 border-yellow-400 bg-yellow-400 overflow-hidden aspect-[4/3]
                        flex items-center justify-center shadow-[14px_14px_0px_0px_#ef4444] group">
                @php $aboutImage = ($about && !$about->isFieldHidden('image')) ? data_get($about->content, 'image') : null; @endphp
                @if($aboutImage)
                    <img src="{{ Storage::url($aboutImage) }}"
                         alt="{{ $a('title', 'Tentang HNP Communications — Tim PR dan Digital Marketing Profesional') }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                         loading="lazy">
                @else
                    <svg width="380" height="280" viewBox="0 0 380 280" fill="none" class="group-hover:scale-110 transition-transform duration-500">
                        <circle cx="190" cy="140" r="120" fill="#facc15" opacity="0.15"/>
                        <circle cx="190" cy="100" r="65" fill="#3b82f6"/>
                        <circle cx="190" cy="100" r="52" fill="#60a5fa"/>
                        <circle cx="172" cy="95" r="9" fill="white"/><circle cx="208" cy="95" r="9" fill="white"/>
                        <circle cx="175" cy="97" r="5" fill="#1e3a8a"/><circle cx="211" cy="97" r="5" fill="#1e3a8a"/>
                        <path d="M175 112 Q190 124 205 112" stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round"/>
                        <ellipse cx="190" cy="205" rx="58" ry="52" fill="#3b82f6"/>
                        <circle cx="55" cy="70" r="22" fill="#ef4444" opacity="0.85" class="animate-bounce-heavy"/>
                        <circle cx="325" cy="60" r="15" fill="#22c55e" opacity="0.85" class="animate-radar"/>
                    </svg>
                @endif
            </div>
            {{-- Badge pojok kanan bawah --}}
            @if($a('badge_stat') !== null || $a('badge_label') !== null)
            <div class="absolute -bottom-4 -right-4 bg-red-500 border-4 border-black shadow-neo p-4 animate-float">
                @if($a('badge_stat') !== null)
                <div class="font-black text-white text-3xl leading-none"
                     style="font-family:'Unbounded',sans-serif">
                    {{ $a('badge_stat', '98%') }}
                </div>
                @endif
                @if($a('badge_label') !== null)
                <div class="text-white/60 text-xs font-bold uppercase tracking-widest mt-1">
                    {{ $a('badge_label', 'Tingkat Kepuasan') }}
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Teks --}}
        <div class="reveal">
            <span class="inline-block bg-yellow-400 text-purple-950 font-black text-xs
                         tracking-widest uppercase px-4 py-2 border-[2.5px] border-black mb-6 shadow-neo-sm"
                  style="font-family:'Unbounded',sans-serif">
                ABOUT US
            </span>
            @if($a('title') !== null)
            <h2 class="font-black text-white leading-none mb-6 text-glitch-heavy"
                style="font-family:'Unbounded',sans-serif; font-size:clamp(3rem,5vw,5rem)">
                {!! nl2br(e($a('title', "Wish\nGranted!"))) !!}
            </h2>
            @endif
            @if($a('description') !== null)
            <p class="text-white/80 font-bold leading-relaxed mb-8">
                {{ $a('description', 'Berbasis di Bogor, Indonesia, kami adalah agensi digital kreatif yang berspesialisasi memberikan solusi dengan formula ideal.') }}
            </p>
            @endif

            <div class="grid grid-cols-2 gap-px bg-black border-4 border-black shadow-neo">
                @foreach([['200+','Media Partner'],['1K+','Happy Clients'],['5+','Tahun Berdiri'],['8','Jenis Layanan']] as [$v,$l])
                <div class="bg-purple-900 p-5 hover:bg-yellow-400 group transition-all cursor-default">
                    <div class="font-black text-yellow-400 text-4xl leading-none group-hover:text-purple-950 transition-colors"
                         style="font-family:'Unbounded',sans-serif">{{ $v }}</div>
                    <div class="text-white/70 text-xs uppercase font-bold tracking-widest mt-2 group-hover:text-black transition-colors">{{ $l }}</div>
                </div>
                @endforeach
            </div>

            @if($a('cta_url') !== null || $a('cta_text') !== null)
            <div class="mt-8">
                <a href="{{ $a('cta_url', '/about') }}" class="btn-pop inline-block">
                    {{ $a('cta_text', 'Pelajari Lebih →') }}
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- ══ SERVICES ═══════════════════════════════════════════ --}}
<section class="bg-cyan-400 bg-retro-grid border-b-4 border-black py-20 px-6 lg:px-16 relative" id="services">
    <div class="max-w-7xl mx-auto relative z-10">
        @if($sv('section_title') !== null)
        <div class="flex items-center gap-6 mb-8 reveal bg-white border-4 border-black p-4 shadow-neo w-fit">
            <span class="font-black text-black text-2xl whitespace-nowrap uppercase"
                  style="font-family:'Unbounded',sans-serif">
                {{ $sv('section_title', 'Our Services.') }}
            </span>
            <div class="w-5 h-5 bg-red-500 border-2 border-black rounded-full flex-shrink-0 animate-radar"></div>
        </div>
        @endif

        @php
        $svcDefaults = [
            ['tab'=>'Press Release',     'title'=>"Jasa Press\nRelease",           'body'=>'Layanan publikasi informasi resmi brand Anda ke berbagai media massa.',        'bg'=>'SOCIAL', 'img'=>'r.png', 'route'=>'layanan.press.release'],
            ['tab'=>'Backlink Media',    'title'=>"Jasa Backlink\nMedia Nasional", 'body'=>'Tingkatkan otoritas domain dan peringkat SEO website Anda.',                   'bg'=>'NEWS',   'img'=>'i.png', 'route'=>'layanan.backlink'],
            ['tab'=>'Press Conference',  'title'=>"Jasa Press\nConference / Pers", 'body'=>'Pengorganisasian konferensi pers profesional untuk komunikasi pesan penting.', 'bg'=>'ART',    'img'=>'k.png', 'route'=>'layanan.press.conference'],
            ['tab'=>'Penulisan Artikel', 'title'=>"Jasa Penulisan\nArtikel",       'body'=>'Pembuatan konten artikel yang menarik, informatif, dan dioptimasi.',           'bg'=>'GROW',   'img'=>'c.png', 'route'=>'layanan.penulisan.artikel'],
            ['tab'=>'Buzzer',            'title'=>"Jasa\nBuzzer",                  'body'=>'Tingkatkan eksposur brand Anda melalui jaringan buzzer digital yang luas dan terpercaya.', 'bg'=>'NEWS', 'img'=>'u.png', 'route'=>'layanan.buzzer'],
            ['tab'=>'Pelatihan Kreator', 'title'=>"Jasa Pelatihan\nKonten Kreator",'body'=>'Program pelatihan intensif menciptakan konten digital yang berdampak.',        'bg'=>'ART',    'img'=>'p.png', 'route'=>'layanan.pelatihan.konten'],
        ];

        $svcs = [];
        foreach ($svcDefaults as $i => $def) {
            $n = $i + 1;
            $imgHidden = $svcSec && $svcSec->isFieldHidden("svc_{$n}_img");
            $svcs[] = [
                'tab'          => $sv("svc_{$n}_tab",   $def['tab']),
                'title'        => $sv("svc_{$n}_title", $def['title']),
                'body'         => $sv("svc_{$n}_body",  $def['body']),
                'bg'           => $sv("svc_{$n}_bg",    $def['bg']),
                'route'        => $sv("svc_{$n}_route", $def['route']),
                'img'          => (!$imgHidden && $svcSec) ? data_get($svcSec->content, "svc_{$n}_img") : null,
                'img_fallback' => $def['img'],
            ];
        }
        @endphp

        <div class="reveal">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 border-4 border-black mt-8 overflow-hidden shadow-neo bg-black gap-[4px]">
                @foreach($svcs as $i => $s)
                <button class="stab font-black text-[10px] md:text-xs px-2 py-4 transition-all uppercase tracking-tighter md:tracking-widest
                               {{ $i === 0 ? 'bg-black text-yellow-400' : 'bg-white text-black hover:bg-yellow-400' }}"
                        data-idx="{{ $i }}"
                        style="font-family:'Unbounded',sans-serif">
                    {{ $s['tab'] }}
                </button>
                @endforeach
            </div>

            @foreach($svcs as $i => $s)
            <div id="spanel-{{ $i }}"
                 class="{{ $i === 0 ? 'grid' : 'hidden' }} grid-cols-1 md:grid-cols-2
                        border-4 border-black border-t-0 overflow-hidden shadow-neo bg-white">
                <div class="p-8 md:p-12 relative flex flex-col justify-center">
                    <div class="corner-ornament tl"></div>
                    <div class="corner-ornament br"></div>
                    @if($s['title'] !== null)
                    <h3 class="font-black leading-none text-purple-950 mb-6 text-glitch-heavy"
                        style="font-family:'Unbounded',sans-serif; font-size:clamp(2rem,4vw,3.5rem)">
                        {!! nl2br(e($s['title'])) !!}
                    </h3>
                    @endif
                    @if($s['body'] !== null)
                    <p class="text-black/80 font-bold leading-relaxed mb-8 max-w-sm">{{ $s['body'] }}</p>
                    @endif
                    <div>
                        <a href="{{ route($s['route']) }}" class="btn-pop inline-block">PELAJARI LEBIH →</a>
                    </div>
                </div>
                <div class="group bg-purple-950 min-h-[350px] md:min-h-[450px] flex items-center justify-center relative overflow-hidden border-t-4 md:border-t-0 md:border-l-4 border-black">
                    <div class="absolute inset-0 flex items-center justify-center select-none pointer-events-none">
                        <span class="font-black opacity-10 text-[6rem] md:text-[10rem] text-white tracking-tighter transition-transform duration-700 group-hover:scale-125 group-hover:rotate-6"
                              style="font-family:'Unbounded',sans-serif">{{ $s['bg'] }}</span>
                    </div>
                    <div class="relative z-10 w-4/5 h-4/5 transform transition-all duration-500 group-hover:scale-105 group-hover:-rotate-3">
                        @if($s['img'])
                            <img src="{{ Storage::url($s['img']) }}"
                                 alt="Layanan {{ $s['tab'] }} — HNP Communications"
                                 class="w-full h-full object-cover border-4 border-black shadow-neo-lg rounded-sm animate-float-slow"
                                 loading="lazy">
                        @else
                            <img src="{{ asset('images/' . $s['img_fallback']) }}"
                                 alt="Layanan {{ $s['tab'] }} — HNP Communications"
                                 class="w-full h-full object-cover border-4 border-black shadow-neo-lg rounded-sm animate-float-slow"
                                 loading="lazy">
                        @endif
                    </div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-yellow-400 border-4 border-black rounded-full mix-blend-difference animate-radar"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ OUR CLIENTS ════════════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-20 px-6 lg:px-16 relative overflow-hidden bg-space-stars" id="clients">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex flex-col md:flex-row border-4 border-black shadow-neo mb-12 reveal">
            <div class="bg-purple-950 text-yellow-400 px-8 py-5 border-b-4 md:border-b-0 md:border-r-4 border-black flex items-center justify-center lg:justify-start min-w-[250px]">
                @if($cl('section_title') !== null)
                <h2 class="font-black text-2xl uppercase tracking-widest text-glitch"
                    style="font-family:'Unbounded',sans-serif">
                    {{ $cl('section_title', 'Our Clients.') }}
                </h2>
                @endif
            </div>
            <div class="bg-yellow-400 flex-1 relative overflow-hidden flex items-center py-4 px-6">
                <div class="absolute inset-0 flex items-center px-6">
                    <div class="w-full border-t-[8px] border-dotted border-purple-950/40"></div>
                </div>
                <div class="relative w-full h-full flex items-center overflow-hidden">
                    <div class="animate-ticker w-max flex items-center gap-6 text-4xl text-purple-950">
                        @for($i=0; $i<4; $i++)
                            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">🚀</span>
                            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
                            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">🐈</span>
                            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
                            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">👾</span>
                            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
                            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">👻</span>
                            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
                            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">🛸</span>
                            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <div class="border-4 border-black bg-black shadow-neo reveal">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-1">
                @php
                $staticLogos = ['tugu.png','lunas.png','kuliner.png','dog.png','hikmat.png','indo.png','kids.png','bio.png','praja.png','price.png','volantis.png','gorem.png'];
                @endphp

                @for($n = 1; $n <= 12; $n++)
                @php
                    $logoHidden     = $clients && $clients->isFieldHidden("logo_{$n}");
                    $logoPath       = (!$logoHidden && $clients) ? data_get($clients->content, "logo_{$n}") : null;
                    $staticFallback = $logoHidden ? null : ($staticLogos[$n - 1] ?? null);
                @endphp
                @if(!$logoHidden && ($logoPath || $staticFallback))
                <div class="bg-yellow-400 aspect-square flex items-center justify-center p-8
                            hover:bg-cyan-400 transition-all duration-500 group cursor-pointer relative overflow-hidden">
                    <img src="{{ $logoPath ? Storage::url($logoPath) : asset('images/clients/' . $staticFallback) }}"
                         alt="Logo Klien HNP Communications"
                         class="w-full h-full object-contain opacity-50 group-hover:opacity-100
                                scale-90 group-hover:scale-100 transition-all duration-500 ease-out
                                transform-gpu will-change-transform filter blur-[0.5px] group-hover:blur-0"
                         loading="lazy">
                    <div class="absolute inset-0 border-0 group-hover:border-[6px] border-black transition-all duration-200 pointer-events-none"></div>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 group-hover:bg-white transition-opacity duration-300 pointer-events-none"></div>
                </div>
                @endif
                @endfor
            </div>
        </div>
    </div>
</section>

{{-- ══ CONTACT CTA ════════════════════════════════════════ --}}
<section class="border-b-4 border-black py-20 px-6 lg:px-16 relative overflow-hidden" id="contact"
         style="background-color: {{ $ct('bg_color', '#ef4444') }}">
    <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400 border-8 border-black rounded-full translate-x-1/2 -translate-y-1/2 animate-spin-slow"></div>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-12 items-center reveal relative z-10">
            <div>
                @if($ct('badge') !== null || $ct('badge_text') !== null)
                <span class="inline-block bg-black text-yellow-400 font-black text-xs
                             tracking-widest uppercase px-4 py-2 mb-5 animate-bounce-heavy border-2 border-transparent shadow-neo-sm"
                      style="font-family:'Unbounded',sans-serif">
                    {{ $ct('badge') ?? $ct('badge_text', '✦ HUBUNGI KAMI') }}
                </span>
                @endif

                @if($ct('title_line1') !== null || $ct('title_line2') !== null || $ct('title_line3') !== null)
                <h2 class="font-black text-white leading-none mb-5 text-glitch-heavy"
                    style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,5vw,5rem)">
                    @if($ct('title_line1') !== null) {{ $ct('title_line1', "Let's Build") }}<br> @endif
                    @if($ct('title_line2') !== null) {{ $ct('title_line2', 'Something') }}<br> @endif
                    @if($ct('title_line3') !== null)
                    <span class="text-black" style="-webkit-text-stroke: 1px white;">
                        {{ $ct('title_line3', 'Different.') }}
                    </span>
                    @endif
                </h2>
                @endif

                @if($ct('description') !== null)
                <p class="text-white font-bold leading-relaxed max-w-lg bg-black/20 p-4 border-l-4 border-yellow-400">
                    {{ $ct('description', 'Punya ide gila untuk brand kamu? Kami siap dengar dan wujudkan.') }}
                </p>
                @endif
            </div>

            @if($ct('cta_url') !== null || $ct('cta_text') !== null)
            <a href="{{ $ct('cta_url', 'https://wa.me/6287786000919') }}"
               class="bg-yellow-400 text-purple-950 font-black text-xl px-10 py-6
                      border-4 border-black shadow-neo hover:translate-x-1 hover:translate-y-1
                      hover:shadow-none transition-all whitespace-nowrap animate-float"
               style="font-family:'Unbounded',sans-serif">
                {{ $ct('cta_text', "LET'S CHAT →") }}
            </a>
            @endif
        </div>

        <div class="flex justify-center gap-12 pt-10 mt-10 border-t-4 border-black text-5xl relative z-10">
            <span class="animate-ufo">🛸</span>
            <span class="animate-float" style="animation-delay:.2s">📡</span>
            <span class="animate-rocket">🚀</span>
            <span class="animate-spin-slow" style="animation-delay:.4s">⭐</span>
            <span class="animate-bounce-heavy" style="animation-delay:.6s">🎯</span>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Tab logic handled in app.js
</script>
@endpush