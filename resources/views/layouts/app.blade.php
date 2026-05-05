{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KontenDigital.id') }} — @yield('title')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Space+Grotesk:wght@300;500;700;900&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Space Grotesk', sans-serif; }
        .font-plus { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* ── FIX: Navbar sticky + background ── */
        #main-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: #facc15; /* yellow-400 */
            border-bottom: 4px solid black;
        }

        /* Footer Deep Navy */
        .footer-modern {
            background-color: #1a1a2e; 
        }
        
        .wa-card-modern {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .wa-card-modern:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: #fbbf24;
            transform: translateY(-2px);
        }

        /* Shadow Neo */
        .shadow-neo { box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); }
        .shadow-neo-sm { box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }

        /* Avatar dropdown */
        .avatar-dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s ease;
        }
        .avatar-wrapper:hover .avatar-dropdown,
        .avatar-wrapper:focus-within .avatar-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Services accordion chevron */
        #services-chevron {
            transition: transform 0.2s ease;
        }
        #services-chevron.rotate {
            transform: rotate(180deg);
        }
    </style>
    @stack('styles')
</head>

<body class="antialiased min-h-screen bg-yellow-400">

    {{-- ── NAVBAR ─────────────────────────────────────────────────── --}}
    {{-- FIX: Hapus class inline bg/border/sticky dari sini karena sudah di CSS #main-nav --}}
    <nav id="main-nav">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 bg-purple-950 border-[3px] border-black rounded-xl
                                flex items-center justify-center
                                group-hover:rotate-6 transition-transform">
                        <span class="text-yellow-400 font-black text-lg"
                              style="font-family:'Unbounded',sans-serif">K</span>
                    </div>
                    <div class="leading-none">
                        <p class="font-black text-base uppercase tracking-tight text-[#1a1a2e]"
                           style="font-family:'Unbounded',sans-serif">KontenDigital</p>
                        <p class="text-[0.6rem] font-bold text-red-500 uppercase tracking-[0.15em]">
                            Growth Partner
                        </p>
                    </div>
                </a>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link-pop">Home</a>
                    <a href="{{ route('about') }}" class="nav-link-pop">About Us</a>

                    <div class="relative group">
                        <button class="nav-link-pop flex items-center gap-1 focus:outline-none">
                            Services
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="3" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-72 bg-white border-4 border-black
                                    shadow-neo opacity-0 invisible group-hover:opacity-100
                                    group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                            <a href="{{ route('layanan.press.release') }}" class="dropdown-item-neo">Press Release</a>
                            <a href="{{ route('layanan.backlink') }}" class="dropdown-item-neo">Backlink Media</a>
                            <a href="{{ route('layanan.press.conference') }}" class="dropdown-item-neo">Press Conference</a>
                            <a href="{{ route('layanan.penulisan.artikel') }}" class="dropdown-item-neo">Penulisan Artikel</a>
                            <a href="{{ route('layanan.script.video') }}" class="dropdown-item-neo">Script Video</a>
                            <a href="{{ route('layanan.pelatihan.konten') }}" class="dropdown-item-neo">Pelatihan Konten</a>
                        </div>
                    </div>

                    <a href="{{ route('articles.index') }}" class="nav-link-pop">Blog</a>
                    <a href="{{ route('cara-order') }}" class="nav-link-pop">Cara Order</a>
                    <a href="{{ route('syarat-ketentuan') }}" class="nav-link-pop">S&K</a>
                    <a href="{{ route('contact') }}" class="nav-link-pop">Contact</a>
                </div>

                {{-- Right Side: Auth --}}
                <div class="flex items-center gap-4">
                    @auth
                        {{-- ── AVATAR + DROPDOWN (Desktop) ── --}}
                        <div class="avatar-wrapper relative hidden md:block">
                            <button class="flex items-center gap-2 focus:outline-none group">
                                {{-- Avatar circle --}}
                                <div class="w-10 h-10 bg-purple-950 border-4 border-black rounded-full
                                            flex items-center justify-center overflow-hidden
                                            group-hover:border-yellow-400 transition-all shadow-neo-sm">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}"
                                             alt="{{ Auth::user()->name }}"
                                             class="w-full h-full object-cover">
                                    @elseif(Auth::user()->profile_photo_path)
                                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                                             alt="{{ Auth::user()->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="text-yellow-400 font-black text-sm"
                                              style="font-family:'Unbounded',sans-serif">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>
                                {{-- Chevron --}}
                                <svg class="w-4 h-4 text-black transition-transform group-hover:rotate-180"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="3" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            {{-- Dropdown Panel --}}
                            <div class="avatar-dropdown absolute right-0 mt-2 w-60 bg-white
                                        border-4 border-black shadow-neo z-50 overflow-hidden">

                                {{-- User Info Header --}}
                                <div class="px-4 py-3 border-b-2 border-black bg-yellow-400">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-purple-950 border-2 border-black rounded-full
                                                    flex items-center justify-center overflow-hidden flex-shrink-0">
                                            @if(Auth::user()->avatar)
                                                <img src="{{ Auth::user()->avatar }}"
                                                     alt="{{ Auth::user()->name }}"
                                                     class="w-full h-full object-cover">
                                            @elseif(Auth::user()->profile_photo_path)
                                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                                                     alt="{{ Auth::user()->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <span class="text-yellow-400 font-black text-xs"
                                                      style="font-family:'Unbounded',sans-serif">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="overflow-hidden">
                                            <p class="font-black text-xs uppercase tracking-tight truncate text-[#1a1a2e]">
                                                {{ Auth::user()->name }}
                                            </p>
                                            <p class="text-[10px] text-black/60 truncate">
                                                {{ Auth::user()->email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Menu Items --}}
                                @if(Route::has('dashboard'))
                                <a href="{{ route('dashboard') }}"
                                   class="dropdown-item-neo flex items-center gap-3">
                                    <i class="fa-solid fa-gauge-high w-4 text-center text-purple-700"></i>
                                    Dashboard
                                </a>
                                @endif

                                @if(Route::has('profile.edit'))
                                <a href="{{ route('profile.edit') }}"
                                   class="dropdown-item-neo flex items-center gap-3">
                                    <i class="fa-solid fa-user w-4 text-center text-blue-600"></i>
                                    Profil Saya
                                </a>
                                @endif

                                {{-- Admin Panel — hanya untuk role admin --}}
                                @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                   class="dropdown-item-neo flex items-center gap-3 bg-purple-950/5 hover:bg-purple-950 hover:text-yellow-400 group/admin">
                                    <i class="fa-solid fa-screwdriver-wrench w-4 text-center text-purple-700 group-hover/admin:text-yellow-400"></i>
                                    <span class="font-black tracking-tight">Admin Panel</span>
                                    <span class="ml-auto text-[9px] font-black uppercase tracking-widest bg-purple-950 text-yellow-400 px-2 py-0.5 rounded group-hover/admin:bg-yellow-400 group-hover/admin:text-purple-950 transition-all">
                                        ADMIN
                                    </span>
                                </a>
                                @endif

                                {{-- Divider --}}
                                <div class="border-t-2 border-black/10 mx-3"></div>

                                {{-- Logout --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="dropdown-item-neo w-full text-left flex items-center gap-3 text-red-600 hover:bg-red-50">
                                        <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- ── TOMBOL MASUK (Guest) ── --}}
                        <a href="{{ route('login') }}"
                           class="hidden md:inline-block border-4 border-black bg-white text-black
                                  font-black text-xs uppercase tracking-widest px-4 py-2 shadow-neo-sm
                                  hover:bg-yellow-400 hover:translate-y-1 hover:shadow-none transition-all">
                            Masuk
                        </a>
                    @endauth

                    {{-- Burger Mobile --}}
                    {{-- FIX: tambah min-w dan min-h agar area klik cukup besar di HP --}}
                    <button id="burger"
                            class="md:hidden text-black p-2 min-w-[44px] min-h-[44px] flex items-center justify-center"
                            aria-label="Buka menu">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 8h16M4 16h16"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    {{-- ── MOBILE MENU (Full Screen Overlay) ─────────────────────── --}}
    {{-- FIX: Hapus class 'hidden', ganti ke style="display:none" agar tidak konflik dengan Tailwind purge --}}
    <div id="mobile-menu"
         class="md:hidden fixed inset-0 z-[100] bg-yellow-400 overflow-y-auto"
         style="display: none;">

        {{-- Header Mobile --}}
        <div class="flex items-center justify-between h-20 px-6 border-b-4 border-black sticky top-0 bg-yellow-400 z-10">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 bg-purple-950 border-[3px] border-black rounded-xl flex items-center justify-center">
                    <span class="text-yellow-400 font-black text-lg" style="font-family:'Unbounded',sans-serif">K</span>
                </div>
                <div class="leading-none">
                    <p class="font-black text-base uppercase tracking-tight text-[#1a1a2e]" style="font-family:'Unbounded',sans-serif">KontenDigital</p>
                    <p class="text-[0.6rem] font-bold text-red-500 uppercase tracking-[0.15em]">Growth Partner</p>
                </div>
            </a>
            {{-- FIX: Tombol Close — tambah min-w/min-h agar mudah diklik di HP --}}
            <button id="close-menu"
                    class="text-black p-2 min-w-[44px] min-h-[44px] flex items-center justify-center"
                    aria-label="Tutup menu">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Nav Links --}}
        <div class="px-6 py-4">
            <a href="{{ route('home') }}"
               class="flex items-center justify-between font-black text-lg uppercase py-4 border-b-2 border-black/10 text-[#1a1a2e] hover:text-purple-950 transition-colors">
                Home
                <i class="fa-solid fa-arrow-right text-sm opacity-30"></i>
            </a>

            <a href="{{ route('about') }}"
               class="flex items-center justify-between font-black text-lg uppercase py-4 border-b-2 border-black/10 text-[#1a1a2e] hover:text-purple-950 transition-colors">
                About Us
                <i class="fa-solid fa-arrow-right text-sm opacity-30"></i>
            </a>

            {{-- Services Accordion --}}
            <div class="border-b-2 border-black/10">
                <button id="services-toggle"
                        class="w-full flex items-center justify-between font-black text-lg uppercase py-4 text-[#1a1a2e]">
                    Services
                    <svg id="services-chevron" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="services-sub" class="hidden pb-3 pl-2 space-y-1">
                    <a href="{{ route('layanan.press.release') }}"
                       class="flex items-center gap-3 py-2.5 px-3 text-[#1a1a2e]/80 font-semibold hover:bg-black/5 rounded-lg transition-colors">
                        <i class="fa-solid fa-newspaper w-4 text-center text-purple-700 text-sm"></i>
                        Press Release
                    </a>
                    <a href="{{ route('layanan.backlink') }}"
                       class="flex items-center gap-3 py-2.5 px-3 text-[#1a1a2e]/80 font-semibold hover:bg-black/5 rounded-lg transition-colors">
                        <i class="fa-solid fa-link w-4 text-center text-purple-700 text-sm"></i>
                        Backlink Media
                    </a>
                    <a href="{{ route('layanan.press.conference') }}"
                       class="flex items-center gap-3 py-2.5 px-3 text-[#1a1a2e]/80 font-semibold hover:bg-black/5 rounded-lg transition-colors">
                        <i class="fa-solid fa-microphone w-4 text-center text-purple-700 text-sm"></i>
                        Press Conference
                    </a>
                    <a href="{{ route('layanan.penulisan.artikel') }}"
                       class="flex items-center gap-3 py-2.5 px-3 text-[#1a1a2e]/80 font-semibold hover:bg-black/5 rounded-lg transition-colors">
                        <i class="fa-solid fa-pen-nib w-4 text-center text-purple-700 text-sm"></i>
                        Penulisan Artikel
                    </a>
                    <a href="{{ route('layanan.script.video') }}"
                       class="flex items-center gap-3 py-2.5 px-3 text-[#1a1a2e]/80 font-semibold hover:bg-black/5 rounded-lg transition-colors">
                        <i class="fa-solid fa-clapperboard w-4 text-center text-purple-700 text-sm"></i>
                        Script Video
                    </a>
                    <a href="{{ route('layanan.pelatihan.konten') }}"
                       class="flex items-center gap-3 py-2.5 px-3 text-[#1a1a2e]/80 font-semibold hover:bg-black/5 rounded-lg transition-colors">
                        <i class="fa-solid fa-chalkboard-user w-4 text-center text-purple-700 text-sm"></i>
                        Pelatihan Konten
                    </a>
                </div>
            </div>

            <a href="{{ route('articles.index') }}"
               class="flex items-center justify-between font-black text-lg uppercase py-4 border-b-2 border-black/10 text-[#1a1a2e] hover:text-purple-950 transition-colors">
                Blog
                <i class="fa-solid fa-arrow-right text-sm opacity-30"></i>
            </a>

            <a href="{{ route('cara-order') }}"
               class="flex items-center justify-between font-black text-lg uppercase py-4 border-b-2 border-black/10 text-[#1a1a2e] hover:text-purple-950 transition-colors">
                Cara Order
                <i class="fa-solid fa-arrow-right text-sm opacity-30"></i>
            </a>

            <a href="{{ route('syarat-ketentuan') }}"
               class="flex items-center justify-between font-black text-lg uppercase py-4 border-b-2 border-black/10 text-[#1a1a2e] hover:text-purple-950 transition-colors">
                Syarat &amp; Ketentuan
                <i class="fa-solid fa-arrow-right text-sm opacity-30"></i>
            </a>

            <a href="{{ route('contact') }}"
               class="flex items-center justify-between font-black text-lg uppercase py-4 border-b-2 border-black/10 text-[#1a1a2e] hover:text-purple-950 transition-colors">
                Contact
                <i class="fa-solid fa-arrow-right text-sm opacity-30"></i>
            </a>
        </div>

        {{-- Auth Section Mobile --}}
        <div class="px-6 py-6">
            @auth
                {{-- User Card --}}
                <div class="border-4 border-black bg-white shadow-neo mb-4 overflow-hidden">
                    {{-- User Header --}}
                    <div class="bg-yellow-400 border-b-2 border-black px-4 py-3 flex items-center gap-3">
                        <div class="w-12 h-12 bg-purple-950 border-4 border-black rounded-full flex items-center justify-center overflow-hidden flex-shrink-0">
                            @if(Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                            @elseif(Auth::user()->profile_photo_path)
                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-yellow-400 font-black text-base" style="font-family:'Unbounded',sans-serif">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                        <div class="overflow-hidden">
                            <p class="font-black text-sm uppercase tracking-tight text-[#1a1a2e] truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-black/60 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    {{-- Menu Items --}}
                    @if(Route::has('dashboard'))
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 border-b border-black/10 font-bold text-sm text-[#1a1a2e] hover:bg-yellow-400/30 transition-colors">
                        <i class="fa-solid fa-gauge-high w-4 text-center text-purple-700"></i>
                        Dashboard
                    </a>
                    @endif

                    @if(Route::has('profile.edit'))
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 border-b border-black/10 font-bold text-sm text-[#1a1a2e] hover:bg-yellow-400/30 transition-colors">
                        <i class="fa-solid fa-user w-4 text-center text-blue-600"></i>
                        Profil Saya
                    </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 border-b border-black/10 font-bold text-sm text-[#1a1a2e] hover:bg-purple-950 hover:text-yellow-400 transition-colors group">
                        <i class="fa-solid fa-screwdriver-wrench w-4 text-center text-purple-700 group-hover:text-yellow-400"></i>
                        Admin Panel
                        <span class="ml-auto text-[9px] font-black uppercase tracking-widest bg-purple-950 text-yellow-400 px-2 py-0.5 rounded">ADMIN</span>
                    </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 font-bold text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                            Logout
                        </button>
                    </form>
                </div>
            @else
                {{-- Guest: Tombol Login --}}
                <a href="{{ route('login') }}"
                   class="block w-full text-center border-4 border-black bg-[#1a1a2e] text-yellow-400
                          font-black text-sm uppercase tracking-widest px-4 py-4 shadow-neo
                          hover:bg-purple-950 transition-all">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>
                    Masuk Sekarang
                </a>
            @endauth
        </div>

    </div>
    {{-- ── END MOBILE MENU ─────────────────────────────────────────── --}}

    {{-- ── MAIN CONTENT ────────────────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── FOOTER ──────────────────────────────────────────────────── --}}
    <footer class="footer-modern pt-24 pb-12 text-white overflow-hidden relative border-t-8 border-black">
        {{-- Subtle Glow --}}
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-yellow-500/10 rounded-full blur-[120px]"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start mb-20">
                
                {{-- Column 1: Deskripsi --}}
                <div class="lg:col-span-7 space-y-8">
                    <h2 class="text-4xl md:text-6xl font-black leading-[1.1] tracking-tighter uppercase" 
                        style="font-family:'Unbounded',sans-serif">
                        Bersama Kami, <br>
                        <span class="text-yellow-400">Raih Kesuksesan</span> <br>
                        di Era Digital
                    </h2>
                    <p class="text-slate-400 text-lg md:text-xl font-medium max-w-xl leading-relaxed font-plus">
                        Bergabunglah dengan ratusan klien yang puas dan rasakan perbedaan dengan konten berkualitas dari Kontendigital.id. Mulailah sekarang dan bawa bisnis Anda ke level berikutnya.
                    </p>
                    
                    {{-- Social Media --}}
                    <div class="flex items-center gap-6">
                        <a href="https://www.instagram.com/kontendigitalid/" target="_blank" class="text-2xl text-slate-400 hover:text-white transition-all hover:scale-110"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/people/Kontendigitalid/61564783021098/" target="_blank" class="text-2xl text-slate-400 hover:text-white transition-all hover:scale-110"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/@kontendigitalid" target="_blank" class="text-2xl text-slate-400 hover:text-white transition-all hover:scale-110"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.tiktok.com/@kontendigitalid" target="_blank" class="text-2xl text-slate-400 hover:text-white transition-all hover:scale-110"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                {{-- Column 2: Kontak WhatsApp --}}
                <div class="lg:col-span-5 space-y-4 font-plus">
                    <p class="text-yellow-400 font-bold uppercase tracking-[0.2em] text-sm mb-6">Hubungi Kami</p>
                    
                    <a href="https://wa.me/6287786000919" target="_blank" class="wa-card-modern p-5 rounded-2xl flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center text-green-500">
                                <i class="fab fa-whatsapp text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Whatsapp Hotline</p>
                                <p class="text-lg font-bold tracking-tight">+62 877-8600-0919</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-slate-600 group-hover:translate-x-1 group-hover:text-white transition-all"></i>
                    </a>

                    <a href="https://wa.me/628121967610" target="_blank" class="wa-card-modern p-5 rounded-2xl flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center text-green-500">
                                <i class="fab fa-whatsapp text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Whatsapp Hotline</p>
                                <p class="text-lg font-bold tracking-tight">+62 812-1967-610</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-slate-600 group-hover:translate-x-1 group-hover:text-white transition-all"></i>
                    </a>
                </div>
            </div>

            {{-- Bottom Footer --}}
            <div class="pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                    © {{ date('Y') }} Kontendigital.id — ALL RIGHTS RESERVED
                </p>
                <a href="#" class="w-10 h-10 border border-white/10 rounded-full flex items-center justify-center hover:bg-yellow-400 hover:text-black transition-all">
                    <i class="fa-solid fa-arrow-up text-sm"></i>
                </a>
            </div>
        </div>
    </footer>

    {{-- ── JAVASCRIPT ──────────────────────────────────────────────── --}}
    <script>
        // ── Mobile Menu ──────────────────────────────────────────────
        const burger      = document.getElementById('burger');
        const mobileMenu  = document.getElementById('mobile-menu');
        const closeMenu   = document.getElementById('close-menu');

        // FIX: Ganti classList.add/remove('hidden') → style.display
        // supaya tidak konflik dengan Tailwind CSS purge
        function openMenu() {
            mobileMenu.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeMenuFn() {
            mobileMenu.style.display = 'none';
            document.body.style.overflow = '';
        }

        burger.addEventListener('click', openMenu);
        closeMenu.addEventListener('click', closeMenuFn);

        // Tutup menu jika user resize ke desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                closeMenuFn();
            }
        });

        // ── Services Accordion (Mobile) ───────────────────────────────
        const servicesToggle  = document.getElementById('services-toggle');
        const servicesSub     = document.getElementById('services-sub');
        const servicesChevron = document.getElementById('services-chevron');

        servicesToggle.addEventListener('click', function() {
            const isHidden = servicesSub.classList.toggle('hidden');
            servicesChevron.classList.toggle('rotate', !isHidden);
        });
    </script>

    @stack('scripts')
</body>
</html>