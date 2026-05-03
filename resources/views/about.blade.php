{{-- resources/views/about.blade.php --}}
@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

{{-- ══ HERO ═══════════════════════════════════════════════ --}}
<section class="min-h-screen bg-yellow-400 border-b-4 border-black flex flex-col pt-20 overflow-hidden relative">

    {{-- Dekorasi floating --}}
    <div class="absolute top-28 left-10 animate-float opacity-30 text-6xl hidden lg:block select-none pointer-events-none">⭐</div>
    <div class="absolute top-40 right-16 animate-float-slow opacity-25 text-7xl hidden lg:block select-none pointer-events-none">🚀</div>
    <div class="absolute bottom-48 left-1/3 animate-ufo opacity-20 text-5xl hidden lg:block select-none pointer-events-none">👾</div>
    <div class="absolute top-1/2 right-10 animate-spin-slow opacity-15 text-7xl hidden lg:block select-none pointer-events-none">⚙️</div>
    <div class="absolute bottom-32 right-1/3 animate-bounce-heavy opacity-20 text-5xl hidden lg:block select-none pointer-events-none">💡</div>

    <div class="flex-1 flex flex-col items-center justify-center px-6 py-20 relative z-10 text-center">
        {{-- Badge --}}
        <div class="reveal mb-6">
            <span class="inline-flex items-center gap-2 bg-red-500 text-white font-black text-xs
                         tracking-widest uppercase px-5 py-2 border-[3px] border-black shadow-neo-sm
                         -rotate-1 hover:rotate-1 transition-transform cursor-default"
                  style="font-family:'Unbounded',sans-serif">
                ✦ SIAPA KAMI
            </span>
        </div>

        {{-- Headline --}}
        <div class="reveal mb-4">
            <h1 class="font-black leading-none"
                style="font-family:'Unbounded',sans-serif; font-size:clamp(3.5rem,10vw,9rem);">
                <span class="text-purple-950 text-glitch-heavy block">WHO</span>
                <span class="text-transparent block" style="-webkit-text-stroke:4px #2d1b4e">WE ARE.</span>
            </h1>
        </div>

        <p class="reveal font-bold text-purple-950/70 text-lg md:text-xl max-w-xl mx-auto mb-12 italic">
            "Mitra terpercaya dalam komunikasi dan pemasaran digital."
        </p>

        {{-- UFO SVG --}}
        <div class="reveal animate-ufo">
            <svg width="180" height="140" viewBox="0 0 220 175" fill="none"
                 style="filter:drop-shadow(8px 8px 0 #000)">
                <ellipse cx="110" cy="108" rx="68" ry="20" fill="#000"/>
                <ellipse cx="110" cy="104" rx="68" ry="20" fill="#3b0764" stroke="#facc15" stroke-width="3"/>
                <ellipse cx="110" cy="88" rx="40" ry="26" fill="#00a896"/>
                <ellipse cx="110" cy="84" rx="36" ry="22" fill="#0dcfba"/>
                <circle cx="97" cy="84" r="7" fill="#facc15"/>
                <circle cx="110" cy="79" r="7" fill="#facc15"/>
                <circle cx="123" cy="84" r="7" fill="#facc15"/>
                <circle cx="97" cy="84" r="3.5" fill="#000"/>
                <circle cx="110" cy="79" r="3.5" fill="#000"/>
                <circle cx="123" cy="84" r="3.5" fill="#000"/>
                <line x1="110" y1="62" x2="110" y2="48" stroke="#facc15" stroke-width="3" stroke-linecap="round"/>
                <circle cx="110" cy="44" r="6" fill="#ef4444" stroke="#000" stroke-width="2"/>
            </svg>
        </div>
    </div>

    {{-- Mountain --}}
    <svg viewBox="0 0 1440 160" fill="none" preserveAspectRatio="none" class="w-full block mt-auto">
        <path d="M0,160 L0,90 L80,20 L160,90 L240,5 L320,70 L400,0 L480,55 L560,10
                 L640,65 L720,0 L800,60 L880,15 L960,75 L1040,10 L1120,70
                 L1200,20 L1280,75 L1360,30 L1440,60 L1440,160 Z" fill="#3b0764"/>
    </svg>
</section>

{{-- ══ TENTANG KAMI ════════════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden bg-space-stars">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Visual kiri --}}
            <div class="relative reveal group">
                <div class="border-4 border-yellow-400 bg-yellow-400 overflow-hidden aspect-[4/3]
                            flex items-center justify-center
                            shadow-[14px_14px_0px_0px_#ef4444] group-hover:shadow-none
                            group-hover:translate-x-2 group-hover:translate-y-2 transition-all duration-300">
                    <img src="{{ asset('images/r.png') }}" alt="Tim KontenDigital"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="hidden w-full h-full items-center justify-center bg-yellow-300 flex-col gap-4">
                        <span class="text-8xl animate-bounce-heavy">👥</span>
                        <p class="font-black text-purple-950 text-sm uppercase tracking-widest">Tim Kami</p>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 bg-red-500 border-4 border-black shadow-neo p-4 animate-float">
                    <div class="font-black text-white text-3xl leading-none" style="font-family:'Unbounded',sans-serif">5+</div>
                    <div class="text-white/70 text-xs font-bold uppercase tracking-widest mt-1">Tahun Berdiri</div>
                </div>
            </div>

            {{-- Teks kanan --}}
            <div class="reveal">
                <span class="section-eyebrow mb-6">TENTANG KAMI</span>
                <h2 class="font-black text-white leading-tight mb-6 text-glitch-heavy"
                    style="font-family:'Unbounded',sans-serif; font-size:clamp(2rem,4vw,3.5rem)">
                    Mitra Digital<br><span class="text-yellow-400">Terpercaya</span>
                </h2>
                <p class="text-white/80 font-bold leading-relaxed mb-6 text-base">
                    Kami adalah mitra terpercaya dalam komunikasi dan pemasaran digital, menawarkan layanan unggulan seperti Jasa Press Release, Jasa Backlink Media Nasional, dan Jasa Press Conference.
                </p>

                <div class="grid grid-cols-2 gap-px bg-black border-4 border-black shadow-neo">
                    @foreach([['200+','Media Partner'],['1K+','Happy Clients'],['5+','Tahun Berdiri'],['8','Jenis Layanan']] as [$v,$l])
                    <div class="bg-purple-900 p-5 hover:bg-yellow-400 group/stat transition-all cursor-default">
                        <div class="font-black text-yellow-400 text-4xl leading-none group-hover/stat:text-purple-950 transition-colors"
                             style="font-family:'Unbounded',sans-serif">{{ $v }}</div>
                        <div class="text-white/60 text-xs uppercase font-bold tracking-widest mt-2 group-hover/stat:text-black transition-colors">{{ $l }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ VISI & MISI ═════════════════════════════════════════ --}}
<section class="bg-cyan-400 bg-retro-grid border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex items-center gap-4 mb-16 reveal">
            <div class="bg-white border-4 border-black shadow-neo px-6 py-4 w-fit">
                <h2 class="font-black text-black text-2xl uppercase" style="font-family:'Unbounded',sans-serif">Visi & Misi</h2>
            </div>
            <div class="w-6 h-6 bg-red-500 border-2 border-black rounded-full animate-radar flex-shrink-0"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- VISI --}}
            <div class="reveal group">
                <div class="bg-white border-4 border-black shadow-neo overflow-hidden hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                    <div class="bg-purple-950 border-b-4 border-black px-8 py-5 flex items-center gap-4">
                        <div class="flex-1 relative h-6 flex items-center">
                            <div class="w-full border-t-4 border-dotted border-yellow-400/50"></div>
                            <span class="absolute left-0 text-2xl animate-bounce-heavy">🟡</span>
                        </div>
                        <h3 class="font-black text-yellow-400 text-xl uppercase whitespace-nowrap" style="font-family:'Unbounded',sans-serif">Our Vision</h3>
                    </div>
                    <div class="p-8 relative">
                        <div class="text-6xl mb-4 animate-float-slow">🔭</div>
                        <p class="font-bold text-black/80 leading-relaxed text-base">
                            Menjadi agensi digital terkemuka di Indonesia yang dipercaya oleh ratusan brand untuk meningkatkan visibilitas dan kredibilitas mereka.
                        </p>
                    </div>
                </div>
            </div>

            {{-- MISI --}}
            <div class="reveal group" style="transition-delay:0.15s">
                <div class="bg-white border-4 border-black shadow-neo overflow-hidden hover:translate-x-2 hover:translate-y-2 hover:shadow-none transition-all">
                    <div class="bg-red-500 border-b-4 border-black px-8 py-5 flex items-center gap-4">
                        <div class="flex-1 relative h-6 flex items-center">
                            <div class="w-full border-t-4 border-dotted border-white/50"></div>
                            <span class="absolute left-0 text-2xl animate-bounce-heavy">🚀</span>
                        </div>
                        <h3 class="font-black text-white text-xl uppercase whitespace-nowrap" style="font-family:'Unbounded',sans-serif">Our Mission</h3>
                    </div>
                    <div class="p-8 relative">
                        <ul class="space-y-4">
                            @foreach([
                                ['🎯','Solusi komunikasi digital inovatif dan terukur.'],
                                ['📡','Menghubungkan brand dengan 200+ media nasional.'],
                                ['🤝','Membangun hubungan jangka panjang berbasis kepercayaan.'],
                                ['🚀','Terus berinovasi dalam layanan konten digital.'],
                            ] as [$icon, $text])
                            <li class="flex items-start gap-3">
                                <span class="text-xl flex-shrink-0 mt-0.5">{{ $icon }}</span>
                                <p class="font-bold text-black/75 leading-relaxed text-sm">{{ $text }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ GALLERY (SLIDER VERSION) ════════════════════════════════ --}}
<section class="bg-purple-950 border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden bg-space-stars">
    <div class="max-w-7xl mx-auto relative z-10">
        
        {{-- Header Pac-Man Track --}}
        <div class="flex flex-col md:flex-row border-4 border-black shadow-neo mb-12 reveal overflow-hidden">
            <div class="bg-purple-950 text-yellow-400 px-8 py-5 border-b-4 md:border-b-0 md:border-r-4 border-black flex items-center min-w-[220px]">
                <h2 class="font-black text-2xl uppercase text-glitch" style="font-family:'Unbounded',sans-serif">Our Gallery</h2>
            </div>
            <div class="bg-yellow-400 flex-1 relative overflow-hidden flex items-center py-4 px-6">
                <div class="animate-ticker w-max flex items-center gap-6 text-3xl text-purple-950">
                    @for($i=0;$i<10;$i++)
                        <span class="animate-bounce-heavy">📸</span>
                        <span class="tracking-[0.5em] opacity-40 text-lg font-bold">••••</span>
                        <span class="animate-bounce-heavy">🎬</span>
                        <span class="tracking-[0.5em] opacity-40 text-lg font-bold">••••</span>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Container Slider --}}
        <div class="relative group reveal">
            {{-- Tombol Navigasi Desktop --}}
            <button onclick="scrollGallery('left')" 
                class="absolute left-[-20px] top-1/2 -translate-y-1/2 z-30 bg-yellow-400 border-4 border-black p-4 shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all hidden md:flex items-center justify-center">
                <span class="text-2xl font-black">←</span>
            </button>
            <button onclick="scrollGallery('right')" 
                class="absolute right-[-20px] top-1/2 -translate-y-1/2 z-30 bg-yellow-400 border-4 border-black p-4 shadow-neo hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all hidden md:flex items-center justify-center">
                <span class="text-2xl font-black">→</span>
            </button>

            {{-- Slider Wrapper --}}
            <div id="galleryContainer" 
                 class="flex gap-6 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-12 pt-4 px-4 scroll-smooth">
                
                @foreach([
                    ['images/gallery-1.jpg','Kantor Kami'],
                    ['images/gallery-2.jpg','Tim Kreatif'],
                    ['images/gallery-3.jpg','Workspace'],
                    ['images/gallery-4.jpg','Event Press Conference'],
                    ['images/gallery-1.jpg','Sudut Kreatif'],
                    ['images/gallery-2.jpg','Meeting Room'],
                ] as [$img, $caption])
                <div class="flex-none w-[85vw] md:w-[500px] snap-center">
                    <div class="relative aspect-video border-4 border-black shadow-neo overflow-hidden group/item bg-purple-900">
                        <img src="{{ asset($img) }}" 
                             alt="{{ $caption }}"
                             class="w-full h-full object-cover grayscale group-hover/item:grayscale-0 transition-all duration-500 group-hover/item:scale-110"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        
                        <div class="hidden w-full h-full items-center justify-center flex-col gap-4 absolute inset-0 bg-purple-900">
                            <span class="text-6xl">🖼️</span>
                            <p class="text-yellow-400 font-black uppercase tracking-widest text-xs">{{ $caption }}</p>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-0 group-hover/item:opacity-100 transition-opacity flex items-end p-6">
                            <span class="bg-yellow-400 text-black font-black px-4 py-2 border-2 border-black text-sm uppercase">
                                {{ $caption }}
                            </span> 
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Scroll Indicator --}}
       
    </div>
</section>

{{-- ══ WE ARE DIFFERENT ════════════════════════════════════ --}}
<section class="bg-red-500 border-b-4 border-black py-24 px-6 lg:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <span class="inline-block bg-black text-yellow-400 font-black text-xs tracking-widest uppercase px-4 py-2 mb-6 shadow-neo-sm animate-bounce-heavy">✦ KENAPA KAMI</span>
                <h2 class="font-black text-white leading-none mb-6 text-glitch-heavy" style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,5vw,5rem)">
                    We Are<br><span class="text-black" style="-webkit-text-stroke:1px white">Different!</span>
                </h2>
                <a href="{{ route('contact') }}" class="btn-pop bg-yellow-400 text-purple-950 !shadow-neo hover:!shadow-none animate-float">HUBUNGI KAMI →</a>
            </div>

            <div class="grid grid-cols-2 gap-4 reveal">
                @foreach([
                    ['🏆','200+ Media','Jaringan media nasional terluas'],
                    ['⚡','Respon Cepat','< 1 jam di hari kerja'],
                    ['✅','Garansi Tayang','Atau uang kembali'],
                    ['🤝','Tim Profesional','Berpengalaman 5+ tahun'],
                ] as [$icon, $title, $desc])
                <div class="bg-white border-4 border-black p-4 shadow-neo-sm hover:bg-yellow-400 hover:translate-y-[-4px] transition-all group cursor-default">
                    <div class="text-2xl mb-2">{{ $icon }}</div>
                    <p class="font-black text-black text-sm uppercase mb-1">{{ $title }}</p>
                    <p class="text-black/60 text-xs font-bold">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══ CTA ════════════════════════════════════════════════ --}}
<section class="bg-white border-b-4 border-black py-24 px-6 lg:px-16 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto relative z-10">
        <h2 class="reveal font-black text-black leading-none mb-10" style="font-family:'Unbounded',sans-serif; font-size:clamp(2.5rem,6vw,5.5rem)">
            Siap Melejit<br><span class="text-red-500">Bersama Kami?</span>
        </h2>
        <div class="reveal flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6287786000919" class="btn-pop text-base px-10 py-5">💬 WhatsApp Sekarang</a>
            <a href="{{ route('register') }}" class="border-4 border-black bg-white text-black font-black text-base uppercase px-10 py-5 shadow-neo hover:bg-yellow-400 transition-all">Daftar Akun</a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Menghilangkan scrollbar tapi tetap bisa di-scroll */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@push('scripts')
<script>
    // Fungsi Geser Gallery
    function scrollGallery(direction) {
        const container = document.getElementById('galleryContainer');
        const scrollAmount = window.innerWidth > 768 ? 524 : 320; // Sesuaikan dengan lebar item
        
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
</script>
@endpush