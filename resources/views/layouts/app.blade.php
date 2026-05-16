{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HNP Communications.id') }} — @yield('title')</title>

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

{{-- ── LOADING SCREEN ─────────────────────────────────────────── --}}
{{-- ── LOADING SCREEN SPLIT REVEAL ───────────────────────────── --}}
<div id="ls-wrap" style="position:fixed;inset:0;z-index:9999;overflow:hidden;font-family:'Space Grotesk',sans-serif;">

    {{-- Panel atas (kuning) --}}
    <div id="ls-top"
         style="position:absolute;top:0;left:0;right:0;height:50%;
                background:#facc15;border-bottom:4px solid black;
                transition:transform 1s cubic-bezier(.77,0,.18,1);z-index:10;">
    </div>

    {{-- Panel bawah (navy) --}}
    <div id="ls-bottom"
         style="position:absolute;bottom:0;left:0;right:0;height:50%;
                background:#1a1a2e;border-top:4px solid black;
                transition:transform 1s cubic-bezier(.77,0,.18,1);z-index:10;">
    </div>

    {{-- Konten tengah --}}
    <div id="ls-center"
         style="position:absolute;inset:0;z-index:20;
                display:flex;flex-direction:column;align-items:center;
                justify-content:center;gap:28px;
                transition:opacity 0.3s ease;">

        {{-- Logo --}}
        <div style="display:flex;align-items:center;gap:18px;
                    animation:ls-pop 0.5s cubic-bezier(.34,1.56,.64,1) 0.2s both;">
     <div class="w-11 h-11 bg-purple-950 border-[3px] border-black rounded-xl
            flex items-center justify-center
            group-hover:rotate-6 transition-transform">
    <img src="{{ asset('images/hikeandpeak.png') }}" style="width: 36px; height: 36px; object-fit: contain;" alt="Logo">
</div>
            <div style="line-height:1.1;">
                <p style="margin:0;font-weight:900;font-size:22px;color:#1a1a2e;
                          text-transform:uppercase;font-family:'Unbounded',sans-serif;
                          letter-spacing:-0.5px;">HNP Communications</p>
                <p style="margin:0;font-size:12px;font-weight:800;color:#ef4444;
                          text-transform:uppercase;letter-spacing:4px;">Your Strategic PR and Digital Partner</p>
            </div>
        </div>

        {{-- Garis --}}
        <div style="width:120px;height:5px;background:black;
                    animation:ls-line 0.6s ease 0.5s both;"></div>

        {{-- Label --}}
        <p style="margin:0;font-size:14px;font-weight:800;color:#1a1a2e;
                  text-transform:uppercase;letter-spacing:4px;
                  animation:ls-pop 0.5s cubic-bezier(.34,1.56,.64,1) 0.4s both;">
            Memuat halaman…
        </p>
    </div>
</div>

    {{-- ── NAVBAR ─────────────────────────────────────────────────── --}}
    <nav id="main-nav">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                   <div class="w-11 h-11 bg-purple-950 border-[3px] border-black rounded-xl
            flex items-center justify-center
            group-hover:rotate-6 transition-transform">
    <img src="{{ asset('images/hikeandpeak.png') }}" style="width: 36px; height: 36px; object-fit: contain;" alt="Logo">
</div>
                    <div class="leading-none">
                        <p class="font-black text-base uppercase tracking-tight text-[#1a1a2e]"
                           style="font-family:'Unbounded',sans-serif">HNP Communications</p>
                        <p class="text-[0.6rem] font-bold text-red-500 uppercase tracking-[0.15em]">
                            Your Strategic PR and Digital Partner
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

                    {{-- ── ORDER NOW BUTTON ── --}}
               

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
                    @endauth

                    {{-- Burger Mobile --}}
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
    <div id="mobile-menu"
         class="md:hidden fixed inset-0 z-[100] bg-yellow-400 overflow-y-auto"
         style="display: none;">

        {{-- Header Mobile --}}
        <div class="flex items-center justify-between h-20 px-6 border-b-4 border-black sticky top-0 bg-yellow-400 z-10">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 bg-purple-950 border-[3px] border-black rounded-xl flex items-center justify-center">
                    <img src="images/hikeandpeak.png" style="width: 36px; height: 36px; object-fit: contain;" alt="Logo">
                </div>
                <div class="leading-none">
                    <p class="font-black text-base uppercase tracking-tight text-[#1a1a2e]" style="font-family:'Unbounded',sans-serif">HNP Communications</p>
                    <p class="text-[0.6rem] font-bold text-red-500 uppercase tracking-[0.15em]">Your Strategic PR and Digital Partner</p>
                </div>
            </a>
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

            {{-- Order Now Mobile --}}
            <a href="https://wa.me/6287786000919"
               target="_blank"
               rel="noopener noreferrer"
               class="mt-6 flex items-center justify-center gap-2 w-full py-4
                      bg-[#1a1a2e] border-4 border-black font-black text-base uppercase
                      tracking-tight text-yellow-400 shadow-neo">
                <i class="fab fa-whatsapp text-lg"></i>
                Order Now
                <i class="fa-solid fa-arrow-right text-sm"></i>
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
            @endauth
        </div>

    </div>
    {{-- ── END MOBILE MENU ─────────────────────────────────────────── --}}

    {{-- ── MAIN CONTENT ────────────────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── JAVASCRIPT ──────────────────────────────────────────────── --}}
    <script>
        // ── Mobile Menu ──────────────────────────────────────────────
        const burger      = document.getElementById('burger');
        const mobileMenu  = document.getElementById('mobile-menu');
        const closeMenu   = document.getElementById('close-menu');

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

        // Loading screen
        window.addEventListener('load', function () {
            setTimeout(function () {
                document.getElementById('ls-top').style.transform    = 'translateY(-100%)';
                document.getElementById('ls-bottom').style.transform = 'translateY(100%)';
                document.getElementById('ls-center').style.opacity   = '0';
                setTimeout(function () {
                    document.getElementById('ls-wrap').remove();
                }, 1100);
            }, 1800);
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
@include('components.site-footer')
</html>