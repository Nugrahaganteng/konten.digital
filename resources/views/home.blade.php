{{-- resources/views/home.blade.php --}}
@extends('layouts.app')
@section('title', 'Jasa Press Release & Digital Agency')

@section('content')

{{-- ══ HERO ═════════════════════════════════════════════ --}}
<section class="min-h-screen bg-yellow-400 border-b-4 border-black flex flex-col pt-20 overflow-hidden relative">
    <div class="flex-1 grid grid-cols-1 lg:grid-cols-3 gap-8 px-6 lg:px-16 items-center py-12">

        {{-- Kiri --}}
        <div class="flex flex-col gap-6 reveal">
            <span class="inline-flex items-center gap-2 bg-red-500 text-white font-black text-xs
                         tracking-widest uppercase px-4 py-2 border-[2.5px] border-black w-fit
                         -rotate-1" style="font-family:'Unbounded',sans-serif">
                ✦ DIGITAL AGENCY
            </span>
            <p class="text-lg font-bold text-purple-950 max-w-xs leading-relaxed">
                Kami bukan agensi biasa.<br>
                Kami adalah <strong>partner kreatif</strong> yang bikin brand kamu berkesan.
            </p>
            <a href="https://wa.me/6281234567890"
               class="btn-pop w-fit text-base px-8 py-3">
                MULAI SEKARANG →
            </a>
        </div>

        {{-- Tengah --}}
        <div class="flex flex-col items-center reveal">
            <div class="font-black leading-none text-center text-purple-950"
                 style="font-family:'Unbounded',sans-serif; font-size:clamp(4rem,10vw,8rem);">
                <div>KONTEN</div>
                <div class="text-transparent" style="-webkit-text-stroke:3px #2d1b4e">DIGITAL</div>
            </div>
            <svg width="220" height="175" viewBox="0 0 220 175" fill="none"
                 style="margin-top:1rem; filter:drop-shadow(0 8px 0 #000)">
                <ellipse cx="110" cy="108" rx="68" ry="20" fill="#000"/>
                <ellipse cx="110" cy="104" rx="68" ry="20" fill="#3b0764" stroke="#facc15" stroke-width="3"/>
                <ellipse cx="110" cy="88" rx="40" ry="26" fill="#00a896"/>
                <ellipse cx="110" cy="84" rx="36" ry="22" fill="#0dcfba"/>
                <circle cx="97" cy="84" r="7" fill="#facc15"/><circle cx="110" cy="79" r="7" fill="#facc15"/>
                <circle cx="123" cy="84" r="7" fill="#facc15"/>
                <circle cx="97" cy="84" r="3.5" fill="#000"/><circle cx="110" cy="79" r="3.5" fill="#000"/>
                <circle cx="123" cy="84" r="3.5" fill="#000"/>
                <line x1="110" y1="62" x2="110" y2="48" stroke="#facc15" stroke-width="3" stroke-linecap="round"/>
                <circle cx="110" cy="44" r="6" fill="#ef4444" stroke="#000" stroke-width="2"/>
            </svg>
        </div>

        {{-- Kanan: Stats --}}
        <div class="flex flex-col items-end gap-4 reveal">
            <div class="bg-purple-950 text-yellow-400 border-4 border-black shadow-neo p-5 text-right">
                <span class="block font-black text-5xl leading-none"
                      style="font-family:'Unbounded',sans-serif">200+</span>
                <span class="block text-xs font-bold uppercase tracking-widest text-yellow-400/60 mt-1">
                    Media Partner
                </span>
            </div>
            <div class="bg-red-500 text-white border-4 border-black shadow-neo p-5 text-right">
                <span class="block font-black text-5xl leading-none"
                      style="font-family:'Unbounded',sans-serif">5+</span>
                <span class="block text-xs font-bold uppercase tracking-widest text-white/60 mt-1">
                    Tahun Pengalaman
                </span>
            </div>
            <div class="bg-teal-500 text-black border-4 border-black shadow-neo p-5 text-right">
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
            <span class="w-2 h-2 bg-yellow-400 rounded-full flex-shrink-0"></span>
            200+ MEDIA NASIONAL
            <span class="w-2 h-2 bg-yellow-400 rounded-full flex-shrink-0"></span>
            GARANSI TAYANG
            <span class="w-2 h-2 bg-yellow-400 rounded-full flex-shrink-0"></span>
            PROSES CEPAT
            <span class="w-2 h-2 bg-yellow-400 rounded-full flex-shrink-0"></span>
            KONTEN DIGITAL
            <span class="w-2 h-2 bg-yellow-400 rounded-full flex-shrink-0"></span>
        </div>
        @endfor
    </div>
</div>

{{-- ══ ABOUT ══════════════════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-20 px-6 lg:px-16">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        {{-- Gambar --}}
        <div class="relative reveal">
            <div class="border-4 border-yellow-400 bg-yellow-400 overflow-hidden aspect-[4/3]
                        flex items-center justify-center shadow-[14px_14px_0px_0px_#ef4444]">
                <svg width="380" height="280" viewBox="0 0 380 280" fill="none">
                    <circle cx="190" cy="140" r="120" fill="#facc15" opacity="0.15"/>
                    <circle cx="190" cy="100" r="65" fill="#3b82f6"/>
                    <circle cx="190" cy="100" r="52" fill="#60a5fa"/>
                    <circle cx="172" cy="95" r="9" fill="white"/><circle cx="208" cy="95" r="9" fill="white"/>
                    <circle cx="175" cy="97" r="5" fill="#1e3a8a"/><circle cx="211" cy="97" r="5" fill="#1e3a8a"/>
                    <path d="M175 112 Q190 124 205 112" stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round"/>
                    <ellipse cx="190" cy="205" rx="58" ry="52" fill="#3b82f6"/>
                    <circle cx="55" cy="70" r="22" fill="#ef4444" opacity="0.85"/>
                    <circle cx="325" cy="60" r="15" fill="#22c55e" opacity="0.85"/>
                    <rect x="28" y="170" width="42" height="42" rx="10" fill="#facc15" stroke="#3b0764" stroke-width="3"/>
                    <circle cx="350" cy="190" r="26" fill="#a855f7" opacity="0.7"/>
                </svg>
            </div>
            <div class="absolute -bottom-4 -right-4 bg-red-500 border-4 border-black shadow-neo p-4">
                <div class="font-black text-white text-3xl leading-none"
                     style="font-family:'Unbounded',sans-serif">98%</div>
                <div class="text-white/60 text-xs font-bold uppercase tracking-widest mt-1">Tingkat Kepuasan</div>
            </div>
        </div>

        {{-- Teks --}}
        <div class="reveal">
            <span class="inline-block bg-yellow-400 text-purple-950 font-black text-xs
                         tracking-widest uppercase px-4 py-2 border-[2.5px] border-black mb-6"
                  style="font-family:'Unbounded',sans-serif">
                ABOUT US
            </span>
            <h2 class="font-black text-white leading-none mb-6"
                style="font-family:'Unbounded',sans-serif; font-size:clamp(3rem,5vw,5rem)">
                Wish<br><span class="text-yellow-400">Granted!</span>
            </h2>
            <p class="text-white/70 leading-relaxed mb-8">
                Berbasis di Bogor, Indonesia, kami adalah agensi digital kreatif yang berspesialisasi memberikan solusi dengan formula ideal — sebagai wujud nyata impian brand kamu. Mengutamakan kekeluargaan sebagai kunci membawa brand ke fase pertumbuhan yang luar biasa.
            </p>
            <div class="grid grid-cols-2 gap-px bg-white/10 border-2 border-white/10">
                @foreach([['200+','Media Partner'],['1K+','Happy Clients'],['5+','Tahun Berdiri'],['8','Jenis Layanan']] as [$v,$l])
                <div class="bg-white/5 p-5">
                    <div class="font-black text-yellow-400 text-4xl leading-none"
                         style="font-family:'Unbounded',sans-serif">{{ $v }}</div>
                    <div class="text-white/50 text-xs uppercase tracking-widest mt-1">{{ $l }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ CLIENTS ════════════════════════════════════════════ --}}
<section class="bg-black border-b-4 border-black py-20 px-6 lg:px-16">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-6 mb-12 reveal">
            <span class="font-black text-white text-2xl whitespace-nowrap"
                  style="font-family:'Unbounded',sans-serif">Our Clients.</span>
            <div class="flex-1 h-[2px] bg-yellow-400/30 bg-[repeating-linear-gradient(90deg,rgba(250,204,21,0.4)_0,rgba(250,204,21,0.4)_8px,transparent_8px,transparent_16px)]"></div>
            <div class="w-5 h-5 bg-red-500 rounded-full flex-shrink-0"></div>
        </div>

        @php
        $clients = ['Wardah','Good Day','Milo','Hoko Krunch','Hometown','Kopi Kenangan',
                    'Relaxa','Cerelac','Sasa','Lactogrow','TotalCare','Daikin',
                    'Vaseline','Excelso','Indomaret','Dancow','Nestle','Sampoerna'];
        @endphp

        <div class="grid grid-cols-3 md:grid-cols-6 border-[3px] border-yellow-400/25 reveal">
            @foreach($clients as $c)
            <div class="border border-yellow-400/15 aspect-video flex items-center justify-center
                        font-black text-xs tracking-widest text-yellow-400/30 uppercase
                        hover:bg-yellow-400 hover:text-purple-950 transition-colors cursor-pointer
                        text-center p-2"
                 style="font-family:'Unbounded',sans-serif">
                {{ $c }}
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 reveal">
            <button class="border-[2.5px] border-yellow-400/40 text-yellow-400/70 font-black text-sm
                           tracking-widest uppercase px-10 py-3
                           hover:bg-yellow-400 hover:text-purple-950 hover:border-yellow-400
                           transition-all"
                    style="font-family:'Unbounded',sans-serif">
                VIEW MORE
            </button>
        </div>
    </div>
</section>

{{-- ══ SERVICES ═══════════════════════════════════════════ --}}
<section class="bg-white border-b-4 border-black py-20 px-6 lg:px-16" id="services">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-6 mb-0 reveal">
            <span class="font-black text-black text-2xl whitespace-nowrap"
                  style="font-family:'Unbounded',sans-serif">Our Services.</span>
            <div class="flex-1 h-[2px] bg-black/20"></div>
            <div class="w-5 h-5 bg-teal-500 rounded-full flex-shrink-0"></div>
        </div>

        @php
        $svcs = [
            ['tab'=>'Social Media','title'=>"Social Media\nManagement",'body'=>'Tingkatkan engagement brand kamu di media sosial dengan konten berkualitas tinggi bersama tim kami.','bg'=>'SOCIAL','emoji'=>'📱'],
            ['tab'=>'Press Release','title'=>"Press\nRelease",'body'=>'Publikasikan brand kamu ke 200+ media nasional terpercaya untuk kredibilitas maksimal.','bg'=>'NEWS','emoji'=>'📰'],
            ['tab'=>'Visual Design','title'=>"Visual\nDesign",'body'=>'Desain visual yang bold, unik, dan berkesan untuk identitas brand kamu agar tampil beda.','bg'=>'ART','emoji'=>'🎨'],
            ['tab'=>'SEO','title'=>"SEO\nManagement",'body'=>'Strategi SEO memastikan website kamu mudah ditemukan oleh target audiens yang tepat secara organik.','bg'=>'GROW','emoji'=>'📈'],
            ['tab'=>'Digital Ads','title'=>"Digital\nAds",'body'=>'Iklan digital yang efisien dan tepat sasaran untuk hasil maksimal sesuai budget kampanye kamu.','bg'=>'ADS','emoji'=>'🚀'],
        ];
        @endphp

        <div class="reveal">
            {{-- Tabs --}}
            <div class="flex flex-wrap border-4 border-black mt-8 overflow-hidden shadow-neo-sm">
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
                         border-4 border-black border-t-0">

                {{-- Teks --}}
                <div class="p-8 md:p-12 bg-white relative">
                    <div class="corner-ornament tl"></div>
                    <div class="corner-ornament br"></div>
                    <h3 class="font-black leading-none text-purple-950 mb-6"
                        style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,4vw,4rem)">
                        {!! nl2br(e($s['title'])) !!}
                    </h3>
                    <p class="text-black/65 leading-relaxed mb-8 max-w-sm">{{ $s['body'] }}</p>
                    <a href="#contact" class="btn-pop">PELAJARI LEBIH →</a>
                </div>

                {{-- Visual --}}
                <div class="bg-purple-950 min-h-80 flex items-center justify-center relative
                             overflow-hidden border-l-4 border-black">
                    <div class="text-8xl animate-bounce">{{ $s['emoji'] }}</div>
                    <div class="absolute right-4 bottom-0 font-black opacity-5 text-[8rem] text-white pointer-events-none"
                         style="font-family:'Unbounded',sans-serif">
                        {{ $s['bg'] }}
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Dots --}}
            <div class="flex gap-2 mt-4">
                @foreach($svcs as $i => $s)
                <button class="sdot h-[5px] transition-all border-none cursor-pointer
                               {{ $i === 0 ? 'w-12 bg-purple-950' : 'w-7 bg-black/20' }}"
                        data-idx="{{ $i }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ CONTACT CTA ════════════════════════════════════════ --}}
<section class="bg-red-500 border-b-4 border-black py-20 px-6 lg:px-16" id="contact">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-12 items-center reveal">
            <div>
                <span class="inline-block bg-black text-yellow-400 font-black text-xs
                             tracking-widest uppercase px-4 py-2 mb-5"
                      style="font-family:'Unbounded',sans-serif">
                    ✦ HUBUNGI KAMI
                </span>
                <h2 class="font-black text-white leading-none mb-5"
                    style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,5vw,5rem)">
                    Let's Build<br>Something<br>Different.
                </h2>
                <p class="text-white/75 leading-relaxed max-w-lg">
                    Punya ide gila untuk brand kamu? Kami siap dengar dan wujudkan. Hubungi kami sekarang dan mulai perjalanan pertumbuhan brand kamu bersama KontenDigital.id
                </p>
            </div>
            <a href="https://wa.me/6281234567890"
               class="bg-yellow-400 text-purple-950 font-black text-lg px-10 py-5
                      border-4 border-black shadow-neo hover:translate-x-1 hover:translate-y-1
                      hover:shadow-none transition-all whitespace-nowrap"
               style="font-family:'Unbounded',sans-serif">
                LET'S CHAT →
            </a>
        </div>

        <div class="flex justify-center gap-12 pt-10 mt-10 border-t-4 border-black/20 text-4xl">
            <span class="animate-bounce">🛸</span>
            <span class="animate-bounce" style="animation-delay:.2s">📡</span>
            <span class="animate-bounce" style="animation-delay:.4s">🚀</span>
            <span class="animate-bounce" style="animation-delay:.6s">⭐</span>
            <span class="animate-bounce" style="animation-delay:.8s">🎯</span>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const tabs   = document.querySelectorAll('.stab');
    const panels = document.querySelectorAll('[id^="spanel-"]');
    const sdots  = document.querySelectorAll('.sdot');
    let cur = 0, timer;

    function goSvc(n) {
        panels[cur].classList.replace('grid', 'hidden');
        tabs[cur].classList.remove('bg-black', 'text-yellow-400');
        tabs[cur].classList.add('bg-white', 'text-black');
        sdots[cur].classList.remove('w-12', 'bg-purple-950');
        sdots[cur].classList.add('w-7', 'bg-black/20');

        cur = (n + tabs.length) % tabs.length;

        panels[cur].classList.replace('hidden', 'grid');
        tabs[cur].classList.remove('bg-white', 'text-black');
        tabs[cur].classList.add('bg-black', 'text-yellow-400');
        sdots[cur].classList.remove('w-7', 'bg-black/20');
        sdots[cur].classList.add('w-12', 'bg-purple-950');
    }

    tabs.forEach(t  => t.addEventListener('click',  () => { clearInterval(timer); goSvc(+t.dataset.idx); startTimer(); }));
    sdots.forEach(d => d.addEventListener('click',  () => { clearInterval(timer); goSvc(+d.dataset.idx); startTimer(); }));
    function startTimer() { timer = setInterval(() => goSvc(cur + 1), 4500); }
    startTimer();
</script>
@endpush