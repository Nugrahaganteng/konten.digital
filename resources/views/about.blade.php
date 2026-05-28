{{-- resources/views/about.blade.php --}}
@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

@php
    $heroS    = $sections->get('hero');
    $tentangS = $sections->get('tentang');
    $vmS      = $sections->get('visi_misi');
    $ctaS     = $sections->get('cta');

    // ── Helper: sama persis seperti di home ──────────────────────────────────
    // null  = field HIDDEN  → jangan render elemen HTML-nya
    // string = field aktif  → tampilkan nilainya (atau $default jika kosong)
    $val = function(?\App\Models\PageSection $section, string $key, string $default = '') {
        if (!$section) return $default;
        if ($section->isFieldHidden($key)) return null;
        $v = data_get($section->content, $key);
        return ($v !== null && $v !== '') ? $v : $default;
    };

    $hv = fn(string $k, string $d = '') => $val($heroS,    $k, $d);
    $tv = fn(string $k, string $d = '') => $val($tentangS, $k, $d);
    $vm = fn(string $k, string $d = '') => $val($vmS,      $k, $d);
    $cv = fn(string $k, string $d = '') => $val($ctaS,     $k, $d);
@endphp

{{-- ══ HERO ═══════════════════════════════════════════════ --}}
<section class="min-h-screen bg-yellow-400 border-b-4 border-black flex flex-col pt-20 overflow-hidden relative">

    {{-- Dekorasi floating --}}
    <div class="absolute top-28 left-10 animate-float opacity-30 hidden lg:block select-none pointer-events-none text-purple-950">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-16 h-16">
            <path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
        </svg>
    </div>
    <div class="absolute top-40 right-16 animate-float-slow opacity-25 hidden lg:block select-none pointer-events-none text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699-2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
        </svg>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center px-6 py-20 relative z-10 text-center">

        {{-- Badge --}}
        @if($hv('badge_text') !== null)
        <div class="reveal mb-6">
            <span class="inline-flex items-center gap-2 bg-red-500 text-white font-black text-xs tracking-widest uppercase px-5 py-2 border-[3px] border-black shadow-neo-sm -rotate-1 hover:rotate-1 transition-transform cursor-default"
                  style="font-family:'Unbounded',sans-serif">
                {{ $hv('badge_text', 'SIAPA KAMI') }}
            </span>
        </div>
        @endif

        {{-- Title --}}
        @if($hv('title_line1') !== null || $hv('title_line2') !== null)
        <div class="reveal mb-4">
            <h1 class="font-black leading-none" style="font-family:'Unbounded',sans-serif; font-size:clamp(3.5rem,10vw,9rem);">
                @if($hv('title_line1') !== null)
                <span class="text-purple-950 text-glitch-heavy block">{{ $hv('title_line1', 'WHO') }}</span>
                @endif
                @if($hv('title_line2') !== null)
                <span class="text-transparent block" style="-webkit-text-stroke:4px #2d1b4e">{{ $hv('title_line2', 'WE ARE.') }}</span>
                @endif
            </h1>
        </div>
        @endif

        {{-- Subtitle --}}
        @if($hv('subtitle') !== null)
        <p class="reveal font-bold text-purple-950/70 text-lg md:text-xl max-w-xl mx-auto mb-12 italic">
            "{{ $hv('subtitle', 'Mitra terpercaya dalam komunikasi dan pemasaran digital.') }}"
        </p>
        @endif

        <div class="reveal animate-float text-purple-950">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32"
                 style="filter:drop-shadow(6px 6px 0 #ef4444)">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
            </svg>
        </div>
    </div>

    <svg viewBox="0 0 1440 160" fill="none" preserveAspectRatio="none" class="w-full block mt-auto">
        <path d="M0,160 L0,90 L80,20 L160,90 L240,5 L320,70 L400,0 L480,55 L560,10 L640,65 L720,0 L800,60 L880,15 L960,75 L1040,10 L1120,70 L1200,20 L1280,75 L1360,30 L1440,60 L1440,160 Z" fill="#3b0764"/>
    </svg>
</section>

{{-- ══ TENTANG KAMI ════════════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Gambar --}}
            @php
                $tentangImage = ($tentangS && !$tentangS->isFieldHidden('image'))
                    ? data_get($tentangS->content, 'image')
                    : null;
            @endphp
            <div class="relative reveal group">
                <div class="border-4 border-yellow-400 bg-yellow-400 overflow-hidden aspect-[4/3]
                            flex items-center justify-center shadow-[14px_14px_0px_0px_#ef4444]
                            group-hover:shadow-none group-hover:translate-x-2 group-hover:translate-y-2 transition-all duration-300">
                    @if($tentangImage)
                        <img src="{{ Storage::url($tentangImage) }}"
                             alt="{{ $tv('title', 'Tim') }}"
                             class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/r.png') }}" alt="Tim" class="w-full h-full object-cover">
                    @endif
                </div>
            </div>

            {{-- Teks --}}
            <div class="reveal">
                <span class="inline-block bg-yellow-400 text-purple-950 font-black text-xs
                             tracking-widest uppercase px-4 py-2 border-[2.5px] border-black mb-6 shadow-neo-sm"
                      style="font-family:'Unbounded',sans-serif">TENTANG KAMI</span>

                @if($tv('title') !== null)
                <h2 class="font-black text-white leading-tight mb-6"
                    style="font-family:'Unbounded',sans-serif; font-size:clamp(2rem,4vw,3.5rem)">
                    {!! nl2br(e($tv('title', "Mitra Digital\nTerpercaya"))) !!}
                </h2>
                @endif

                @if($tv('description') !== null)
                <p class="text-white/80 font-bold leading-relaxed mb-6">
                    {{ $tv('description', 'Kami adalah mitra terpercaya dalam komunikasi dan pemasaran digital, menawarkan layanan unggulan seperti Jasa Press Release dan Media Nasional.') }}
                </p>
                @endif

                <div class="grid grid-cols-2 gap-px bg-black border-4 border-black shadow-neo">
                    @foreach([['200+','Media Partner'],['1K+','Happy Clients'],['5+','Tahun Berdiri'],['8','Jenis Layanan']] as [$v, $l])
                    <div class="bg-purple-900 p-5 hover:bg-yellow-400 group/stat transition-all text-center text-white cursor-default">
                        <div class="font-black text-yellow-400 text-4xl group-hover/stat:text-purple-950"
                             style="font-family:'Unbounded',sans-serif">{{ $v }}</div>
                        <div class="text-xs uppercase font-bold group-hover/stat:text-black mt-1">{{ $l }}</div>
                    </div>
                    @endforeach
                </div>

                @if($tv('cta_url') !== null || $tv('cta_text') !== null)
                <div class="mt-8">
                    <a href="{{ $tv('cta_url', '/contact') }}" class="btn-pop inline-block">
                        {{ $tv('cta_text', 'Hubungi Kami →') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ══ VISI & MISI ═════════════════════════════════════════ --}}
<section class="bg-cyan-400 border-b-4 border-black py-24 px-6 lg:px-16 relative">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- VISI --}}
        @if($vm('vision') !== null)
        <div class="bg-white border-4 border-black shadow-neo p-8">
            <h3 class="font-black text-purple-950 text-xl uppercase mb-4"
                style="font-family:'Unbounded',sans-serif">Our Vision</h3>
            <p class="font-bold text-gray-700 leading-relaxed">
                {{ $vm('vision', 'Menjadi agensi digital terkemuka di Indonesia yang dipercaya brand nasional.') }}
            </p>
        </div>
        @endif

        {{-- MISI --}}
        <div class="bg-white border-4 border-black shadow-neo p-8">
            <h3 class="font-black text-red-500 text-xl uppercase mb-4"
                style="font-family:'Unbounded',sans-serif">Our Mission</h3>
            <ul class="space-y-2 font-bold text-sm text-gray-700">
                @foreach(['mission1' => 'Solusi komunikasi digital inovatif.', 'mission2' => 'Menghubungkan brand dengan 200+ media.', 'mission3' => 'Memberikan hasil nyata dan terukur.'] as $key => $default)
                    @php $mval = $vm($key, $default); @endphp
                    @if($mval !== null)
                        <li class="flex items-start gap-2">
                            <span class="text-red-500 font-black mt-0.5">•</span>
                            {{ $mval }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</section>

<!-- {{-- ══ WE ARE DIFFERENT ════════════════════════════════════ --}}
<section class="bg-red-500 border-b-4 border-black py-24 px-6 lg:px-16">
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-12">
        <h2 class="font-black text-white text-5xl" style="font-family:'Unbounded',sans-serif">
            We Are<br><span class="text-black">Different!</span>
        </h2>
        <a href="{{ route('contact') }}"
           class="bg-yellow-400 border-4 border-black px-10 py-4 font-black shadow-neo hover:shadow-none transition-all">
            HUBUNGI KAMI →
        </a>
    </div>
</section> -->

{{-- ══ CTA ════════════════════════════════════════════════ --}}
<section class="bg-white py-24 px-6 text-center">
    @if($cv('title') !== null)
    <h2 class="font-black text-black text-4xl md:text-6xl mb-10"
        style="font-family:'Unbounded',sans-serif">
        {!! nl2br(e($cv('title', "Siap Melejit\nBersama Kami?"))) !!}
    </h2>
    @endif

    @if($cv('cta_url') !== null || $cv('cta_text') !== null)
    <a href="{{ $cv('cta_url', 'https://wa.me/6287786000919') }}"
       class="bg-black text-white border-4 border-black px-12 py-5 font-black shadow-neo inline-flex items-center gap-3 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
        {{ $cv('cta_text', 'WhatsApp Sekarang') }}
    </a>
    @endif
</section>

@endsection

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush