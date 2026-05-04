@extends('layouts.app')
@section('title', 'Jasa Press Release & Digital Agency')

@section('content')

{{-- ══ HERO ═════════════════════════════════════════════ --}}
<section class="min-h-screen bg-yellow-400 border-b-4 border-black flex flex-col pt-20 overflow-hidden relative">
    <div class="absolute top-20 left-10 animate-float opacity-40 text-6xl hidden lg:block select-none">⭐</div>
    <div class="absolute top-40 right-20 animate-float-slow opacity-30 text-7xl hidden lg:block select-none">🚀</div>
    <div class="absolute bottom-20 left-1/4 animate-ufo opacity-20 text-5xl hidden lg:block select-none">👾</div>
    <div class="absolute top-1/2 right-10 animate-spin-slow opacity-20 text-8xl hidden lg:block select-none">⚙️</div>

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-3 gap-8 px-6 lg:px-16 items-center py-12 relative z-10">

        {{-- Kiri --}}
        <div class="flex flex-col gap-6 reveal">
            <span class="inline-flex items-center gap-2 bg-red-500 text-white font-black text-xs
                         tracking-widest uppercase px-4 py-2 border-[2.5px] border-black w-fit
                         -rotate-1 group hover:rotate-2 transition-transform cursor-default shadow-neo-sm" style="font-family:'Unbounded',sans-serif">
                ✦ DIGITAL AGENCY
            </span>
            <p class="text-lg font-bold text-purple-950 max-w-xs leading-relaxed text-glitch cursor-default">
                Kami bukan agensi biasa.<br>
                Kami adalah <strong class="text-red-600">partner kreatif</strong> yang bikin brand kamu berkesan di galaksi ini.
            </p>
            <a href="https://wa.me/6281234567890"
               class="btn-pop w-fit text-base px-8 py-3 group">
               <span class="inline-block group-hover:translate-x-2 transition-transform">MULAI SEKARANG →</span>
            </a>
        </div>

        {{-- Tengah --}}
        <div class="flex flex-col items-center reveal relative">
            <div class="font-black leading-none text-center text-purple-950 text-glitch-heavy"
                 style="font-family:'Unbounded',sans-serif; font-size:clamp(4rem,10vw,8rem);">
                <div>KONTEN</div>
                <div class="text-transparent" style="-webkit-text-stroke:3px #2d1b4e">DIGITAL</div>
            </div>
            
            <div class="animate-ufo">
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
            </div>
        </div>

        {{-- Kanan: Stats --}}
        <div class="flex flex-col items-end gap-4 reveal">
            <div class="bg-purple-950 text-yellow-400 border-4 border-black shadow-neo p-5 text-right hover:-translate-y-2 hover:-translate-x-2 transition-transform cursor-pointer">
                <span class="block font-black text-5xl leading-none"
                      style="font-family:'Unbounded',sans-serif">200+</span>
                <span class="block text-xs font-bold uppercase tracking-widest text-yellow-400/60 mt-1">
                    Media Partner
                </span>
            </div>
            <div class="bg-red-500 text-white border-4 border-black shadow-neo p-5 text-right hover:-translate-y-2 hover:-translate-x-2 transition-transform cursor-pointer">
                <span class="block font-black text-5xl leading-none"
                      style="font-family:'Unbounded',sans-serif">5+</span>
                <span class="block text-xs font-bold uppercase tracking-widest text-white/60 mt-1">
                    Tahun Pengalaman
                </span>
            </div>
            <div class="bg-teal-500 text-black border-4 border-black shadow-neo p-5 text-right hover:-translate-y-2 hover:-translate-x-2 transition-transform cursor-pointer">
                <span class="block font-black text-5xl leading-none"
                      style="font-family:'Unbounded',sans-serif">1K+</span>
                <span class="block text-xs font-bold uppercase tracking-widest text-black/60 mt-1">
                    Klien Puas
                </span>
            </div>
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
<div class="overflow-hidden bg-red-500 border-t-4 border-b-4 border-black py-3">
    <div class="animate-ticker">
        @for($i = 0; $i < 8; $i++)
        <div class="flex items-center gap-10 px-10 whitespace-nowrap font-black text-sm
                    uppercase tracking-widest text-white"
             style="font-family:'Unbounded',sans-serif">
            PRESS RELEASE
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            200+ MEDIA NASIONAL
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            GARANSI TAYANG
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            PROSES CEPAT
            <span class="w-3 h-3 bg-yellow-400 border-2 border-black rounded-full flex-shrink-0 animate-radar"></span>
            KONTEN DIGITAL
        </div>
        @endfor
    </div>
</div>

{{-- ══ ABOUT ══════════════════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-20 px-6 lg:px-16 relative overflow-hidden bg-space-stars">
    <div class="absolute -top-10 -right-10 w-40 h-40 border-4 border-yellow-400/20 rounded-full animate-spin-slow"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">

        {{-- Gambar --}}
        <div class="relative reveal">
            <div class="border-4 border-yellow-400 bg-yellow-400 overflow-hidden aspect-[4/3]
                         flex items-center justify-center shadow-[14px_14px_0px_0px_#ef4444] group">
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
            </div>
            <div class="absolute -bottom-4 -right-4 bg-red-500 border-4 border-black shadow-neo p-4 animate-float">
                <div class="font-black text-white text-3xl leading-none"
                     style="font-family:'Unbounded',sans-serif">98%</div>
                <div class="text-white/60 text-xs font-bold uppercase tracking-widest mt-1">Tingkat Kepuasan</div>
            </div>
        </div>

        {{-- Teks --}}
        <div class="reveal">
            <span class="inline-block bg-yellow-400 text-purple-950 font-black text-xs
                         tracking-widest uppercase px-4 py-2 border-[2.5px] border-black mb-6 shadow-neo-sm"
                  style="font-family:'Unbounded',sans-serif">
                ABOUT US
            </span>
            <h2 class="font-black text-white leading-none mb-6 text-glitch-heavy"
                style="font-family:'Unbounded',sans-serif; font-size:clamp(3rem,5vw,5rem)">
                Wish<br><span class="text-yellow-400">Granted!</span>
            </h2>
            <p class="text-white/80 font-bold leading-relaxed mb-8">
                Berbasis di Bogor, Indonesia, kami adalah agensi digital kreatif yang berspesialisasi memberikan solusi dengan formula ideal. Kami membawa brand ke fase pertumbuhan luar biasa melalui pendekatan kekeluargaan yang modern ala luar angkasa.
            </p>
            <div class="grid grid-cols-2 gap-px bg-black border-4 border-black shadow-neo">
                @foreach([['200+','Media Partner'],['1K+','Happy Clients'],['5+','Tahun Berdiri'],['8','Jenis Layanan']] as [$v,$l])
                <div class="bg-purple-900 p-5 hover:bg-yellow-400 group transition-all cursor-default">
                    <div class="font-black text-yellow-400 text-4xl leading-none group-hover:text-purple-950 transition-colors"
                         style="font-family:'Unbounded',sans-serif">{{ $v }}</div>
                    <div class="text-white/70 text-xs uppercase font-bold tracking-widest mt-2 group-hover:text-black transition-colors">{{ $l }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ SERVICES ═══════════════════════════════════════════ --}}
{{-- Perubahan Disini: Warna Cyan-400 dan ditambahkan kelas bg-retro-grid --}}
<section class="bg-cyan-400 bg-retro-grid border-b-4 border-black py-20 px-6 lg:px-16 relative" id="services">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex items-center gap-6 mb-8 reveal bg-white border-4 border-black p-4 shadow-neo w-fit">
            <span class="font-black text-black text-2xl whitespace-nowrap uppercase"
                  style="font-family:'Unbounded',sans-serif">Our Services.</span>
            <div class="w-5 h-5 bg-red-500 border-2 border-black rounded-full flex-shrink-0 animate-radar"></div>
        </div>

        @php
        $svcs = [
            ['tab'=>'Social Media','title'=>"Social Media\nManagement",'body'=>'Tingkatkan engagement brand kamu di media sosial dengan konten berkualitas tinggi.','bg'=>'SOCIAL','img'=>'r.png'],
            ['tab'=>'Press Release','title'=>"Press\nRelease",'body'=>'Publikasikan brand kamu ke 200+ media nasional terpercaya untuk kredibilitas maksimal.','bg'=>'NEWS','img'=>'i.png'],
            ['tab'=>'Visual Design','title'=>"Visual\nDesign",'body'=>'Desain visual yang bold, unik, dan berkesan untuk identitas brand kamu agar tampil beda.','bg'=>'ART','img'=>'k.png'],
            ['tab'=>'SEO','title'=>"SEO\nManagement",'body'=>'Strategi SEO memastikan website kamu mudah ditemukan oleh target audiens yang tepat.','bg'=>'GROW','img'=>'c.png'],
        ];
        @endphp

        <div class="reveal">
            {{-- Tabs --}}
            <div class="flex flex-wrap border-4 border-black mt-8 overflow-hidden shadow-neo">
                @foreach($svcs as $i => $s)
                <button class="stab font-black text-xs md:text-sm px-6 py-4 border-r-4 border-black
                               last:border-r-0 transition-all uppercase tracking-widest
                               {{ $i === 0 ? 'bg-black text-yellow-400' : 'bg-white text-black hover:bg-yellow-400' }}"
                        data-idx="{{ $i }}"
                        style="font-family:'Unbounded',sans-serif">
                    {{ $s['tab'] }}
                </button>
                @endforeach
            </div>

            {{-- Panels --}}
            @foreach($svcs as $i => $s)
            <div id="spanel-{{ $i }}"
                 class="{{ $i === 0 ? 'grid' : 'hidden' }} grid-cols-1 md:grid-cols-2
                        border-4 border-black border-t-0 overflow-hidden shadow-neo bg-white">

                {{-- Teks --}}
                <div class="p-8 md:p-12 relative flex flex-col justify-center">
                    <div class="corner-ornament tl"></div>
                    <div class="corner-ornament br"></div>
                    <h3 class="font-black leading-none text-purple-950 mb-6 text-glitch-heavy"
                        style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,4vw,4rem)">
                        {!! nl2br(e($s['title'])) !!}
                    </h3>
                    <p class="text-black/80 font-bold leading-relaxed mb-8 max-w-sm">{{ $s['body'] }}</p>
                    <div>
                        <a href="#contact" class="btn-pop inline-block">PELAJARI LEBIH →</a>
                    </div>
                </div>

                {{-- Visual --}}
                <div class="group bg-purple-950 min-h-[400px] flex items-center justify-center relative overflow-hidden border-l-4 border-black">
                    <div class="absolute inset-0 flex items-center justify-center select-none pointer-events-none">
                         <span class="font-black opacity-10 text-[10rem] text-white tracking-tighter transition-transform duration-700 group-hover:scale-125 group-hover:rotate-6" 
                               style="font-family:'Unbounded',sans-serif">
                            {{ $s['bg'] }}
                        </span>
                    </div>
                    <div class="relative z-10 w-4/5 h-4/5 transform transition-all duration-500 group-hover:scale-105 group-hover:-rotate-3">
                        <img src="{{ asset('images/' . $s['img']) }}" 
                             alt="{{ $s['tab'] }}" 
                             class="w-full h-full object-cover border-4 border-black shadow-neo-lg rounded-sm animate-float-slow">
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
        
        {{-- Header ala Arcade / Pac-Man --}}
        <div class="flex flex-col md:flex-row border-4 border-black shadow-neo mb-12 reveal">
            {{-- Bagian Judul Kiri --}}
            <div class="bg-purple-950 text-yellow-400 px-8 py-5 border-b-4 md:border-b-0 md:border-r-4 border-black flex items-center justify-center lg:justify-start min-w-[250px]">
                <h2 class="font-black text-2xl uppercase tracking-widest text-glitch" 
                    style="font-family:'Unbounded',sans-serif">
                    Our Clients.
                </h2>
            </div>
            
            {{-- Bagian Animasi Kanan --}}
            <div class="bg-yellow-400 flex-1 relative overflow-hidden flex items-center py-4 px-6">
                {{-- Dotted Line Track --}}
                <div class="absolute inset-0 flex items-center px-6">
                    <div class="w-full border-t-[8px] border-dotted border-purple-950/40"></div>
                </div>
                
                {{-- Karakter Bergerak (Pac-Man & Ghost / UFO) --}}
         <div class="relative w-full h-full flex items-center overflow-hidden">
    <div class="animate-ticker w-max flex items-center gap-6 text-4xl text-purple-950">
        @for($i=0; $i<4; $i++)
            {{-- 1. Roket --}}
            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">🚀</span>
            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
            
            {{-- 2. Kucing --}}
            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">🐈</span>
            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
            
            {{-- 3. Pac-Man (Pakai Simbol Teks agar natural) --}}
            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">👾</span>
            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
            
            {{-- 4. Hantu Pac-Man --}}
            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">👻</span>
            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
            
            {{-- 5. UFO / Alien --}}
            <span class="animate-bounce-heavy grayscale contrast-200 drop-shadow-md">🛸</span>
            <span class="tracking-[0.5em] opacity-50 text-xl font-bold mt-2">••••</span>
        @endfor
    </div>
</div>
            </div>
        </div>

 
   {{-- Grid Logo Klien --}}
<div class="border-4 border-black bg-black shadow-neo reveal">
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-1">
        
        {{-- 1. Array berisi nama file logo di folder clients kamu --}}
        @php
            $clientLogos = [
                'tugu.png', 'lunas.png', 'kuliner.png', 'dog.png', 
                'hikmat.png', 'indo.png', 'kids.png', 'bio.png',
                'praja.png','price.png','volantis.png','gorem.png',
                // Kalau nanti ada logo baru, tinggal tambahkan namanya di sini
            ];
        @endphp

        {{-- 2. Looping array logonya --}}
     {{-- Looping array logonya --}}
@foreach($clientLogos as $logo)
<div class="bg-yellow-400 aspect-square flex items-center justify-center p-8 
            hover:bg-cyan-400 transition-all duration-500 group cursor-pointer relative overflow-hidden">
    
    {{-- Gambar Logo dengan optimasi Smoothness --}}
    <img src="{{ asset('images/clients/' . $logo) }}" 
         alt="Client Logo {{ $logo }}" 
         class="w-full h-full object-contain 
                opacity-50 group-hover:opacity-100 
                scale-90 group-hover:scale-100
                transition-all duration-500 ease-out
                transform-gpu will-change-transform
                filter blur-[0.5px] group-hover:blur-0"> {{-- Blur halus dikit pas standby biar pas fokus keliatan tajam --}}
    
    {{-- Overlay Border yang muncul dari dalam --}}
    <div class="absolute inset-0 border-0 group-hover:border-[6px] border-black transition-all duration-200 pointer-events-none"></div>

    {{-- Efek bayangan tambahan saat hover agar terlihat 'naik' --}}
    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 group-hover:bg-white transition-opacity duration-300 pointer-events-none"></div>
</div>
@endforeach
        
    </div>
</div>
        
    </div>
</section>

{{-- ══ CONTACT CTA ════════════════════════════════════════ --}}
<section class="bg-red-500 border-b-4 border-black py-20 px-6 lg:px-16 relative overflow-hidden" id="contact">
    <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400 border-8 border-black rounded-full translate-x-1/2 -translate-y-1/2 animate-spin-slow"></div>

    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-12 items-center reveal relative z-10">
            <div>
                <span class="inline-block bg-black text-yellow-400 font-black text-xs
                             tracking-widest uppercase px-4 py-2 mb-5 animate-bounce-heavy border-2 border-transparent shadow-neo-sm"
                      style="font-family:'Unbounded',sans-serif">
                    ✦ HUBUNGI KAMI
                </span>
                <h2 class="font-black text-white leading-none mb-5 text-glitch-heavy"
                    style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,5vw,5rem)">
                    Let's Build<br>Something<br><span class="text-black" style="-webkit-text-stroke: 1px white;">Different.</span>
                </h2>
                <p class="text-white font-bold leading-relaxed max-w-lg bg-black/20 p-4 border-l-4 border-yellow-400">
                    Punya ide gila untuk brand kamu? Kami siap dengar dan wujudkan. Hubungi kami sekarang dan mulai perjalanan pertumbuhan brand kamu melintasi orbit digital.
                </p>
            </div>
            <a href="https://wa.me/6287786000919"
               class="bg-yellow-400 text-purple-950 font-black text-xl px-10 py-6
                      border-4 border-black shadow-neo hover:translate-x-1 hover:translate-y-1
                      hover:shadow-none transition-all whitespace-nowrap animate-float"
               style="font-family:'Unbounded',sans-serif">
               LET'S CHAT →
            </a>
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
    // Tab Logics and Mouse Parallax are handled in app.js for a cleaner setup
</script>
@endpush