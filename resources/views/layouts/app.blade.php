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
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700;900&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="antialiased min-h-screen bg-yellow-400" style="font-family:'Space Grotesk',sans-serif;">

    {{-- ── FLASH MESSAGE ───────────────────────────────────────────── --}}
    @if(session('success'))
    <div id="flash-msg"
         class="fixed top-24 right-6 z-[999] max-w-sm bg-yellow-400 border-4 border-black
                shadow-neo px-5 py-3 font-black text-black text-sm uppercase tracking-wide">
        ✓ {{ session('success') }}
    </div>
    @endif

    {{-- ── NAVBAR ─────────────────────────────────────────────────── --}}
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
             {{-- Menu Desktop --}}
<div class="hidden md:flex items-center gap-8">
    <a href="{{ route('home') }}" class="nav-link-pop">Home</a>

    {{-- FIX DI SINI --}}
    <a href="{{ route('about') }}" class="nav-link-pop">About Us</a>

    {{-- Dropdown Services --}}
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
            <a href="#" class="dropdown-item-neo">Jasa Press Release</a>
            <a href="#" class="dropdown-item-neo">Jasa Backlink Media Nasional</a>
            <a href="#" class="dropdown-item-neo">Jasa Press Conference</a>
            <a href="#" class="dropdown-item-neo">Jasa Penulisan Artikel</a>
            <a href="#" class="dropdown-item-neo">Jasa Script Video / Televisi</a>
            <a href="#" class="dropdown-item-neo">Jasa Pelatihan Konten Kreator</a>
        </div>
    </div>

    <a href="{{ route('articles.index') }}" class="nav-link-pop">Blog</a>
    <a href="{{ route('pricing') }}" class="nav-link-pop">Pricing</a>
    <a href="{{ route('contact') }}" class="nav-link-pop">Contact</a>
</div>
                {{-- Kanan: Search + Auth + Burger --}}
                <div class="flex items-center gap-3">
                    <button class="search-btn" id="search-toggle" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </button>

                    @auth
                    <div class="relative hidden sm:block" id="user-dropdown-wrap">
                        <button id="user-dropdown-btn"
                                class="w-10 h-10 bg-purple-950 border-4 border-black rounded-full
                                       flex items-center justify-center text-yellow-400 font-black
                                       shadow-neo-sm hover:translate-y-1 hover:shadow-none transition-all">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </button>
                        <div id="user-dropdown-menu"
                             class="hidden absolute right-0 mt-2 w-52 bg-white border-4 border-black
                                    shadow-neo z-50 overflow-hidden">
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="block px-4 py-3 font-black text-xs uppercase tracking-wide
                                      hover:bg-yellow-400 transition-colors border-b-2 border-black">
                                ⚙ Admin Panel
                            </a>
                            @endif
                            <a href="{{ route('articles.create') }}"
                               class="block px-4 py-3 font-black text-xs uppercase tracking-wide
                                      hover:bg-yellow-400 transition-colors border-b-2 border-black">
                                ✏ Tulis Artikel
                            </a>
                            <a href="{{ route('articles.index') }}"
                               class="block px-4 py-3 font-black text-xs uppercase tracking-wide
                                      hover:bg-yellow-400 transition-colors border-b-2 border-black">
                                📖 Blog
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-3 font-black text-xs
                                               uppercase tracking-wide text-red-500
                                               hover:bg-red-500 hover:text-white transition-colors">
                                    ⏻ Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}"
                       class="hidden sm:inline-block border-4 border-black bg-white text-black
                              font-black text-xs uppercase tracking-widest px-4 py-2 shadow-neo-sm
                              hover:bg-yellow-400 hover:translate-y-1 hover:shadow-none transition-all">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-pop hidden sm:inline-block">
                        Daftar
                    </a>
                    @endauth

                    {{-- Burger Mobile --}}
                    <button id="burger" class="md:hidden text-black" aria-label="Toggle menu">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="burger-open" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="3" d="M4 8h16M4 16h16"/>
                            <path id="burger-close" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="3" d="M6 18L18 6M6 6l12 12" class="hidden"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu">
            <a href="{{ route('home') }}">Home</a>
           <a href="{{ route('about') }}" class="nav-link-pop">About Us</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('articles.index') }}">Blog</a>
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="{{ route('contact') }}">Contact</a>
            @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">⚙ Admin Panel</a>
                @endif
                <a href="{{ route('articles.create') }}">✏ Tulis Artikel</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="font-black text-xl uppercase text-red-600
                                   bg-transparent border-none cursor-pointer text-left">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}" class="btn-pop text-center">Daftar</a>
            @endauth
        </div>

        {{-- Search Bar Dropdown --}}
        <div id="search-bar">
            <form action="{{ route('articles.index') }}" method="GET"
                  class="max-w-2xl mx-auto flex gap-2">
                <input type="text" name="search" placeholder="Cari artikel, layanan..."
                       class="input-neo flex-1">
                <button type="submit" class="btn-pop">Cari</button>
            </form>
        </div>
    </nav>

    {{-- ── MAIN CONTENT ────────────────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── FOOTER ─────────────────────────────────────────────────── --}}
    <footer class="bg-purple-950 pt-24 pb-12 border-t-8 border-black text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">

                {{-- Kolom 1 --}}
                <div>
                    <p class="font-black text-[1.75rem] leading-none mb-8"
                       style="font-family:'Unbounded',sans-serif">
                        KONTEN<span class="text-yellow-400">DIGITAL</span>
                    </p>
                    <ul class="space-y-4 font-bold text-sm uppercase opacity-80">
                        <li><a href="{{ route('home') }}"           class="hover:text-yellow-400 transition-colors">Home</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-yellow-400 transition-colors">Blog</a></li>
                        <li><a href="{{ route('services') }}"       class="hover:text-yellow-400 transition-colors">Services</a></li>
                        <li><a href="{{ route('pricing') }}"        class="hover:text-yellow-400 transition-colors">Pricing</a></li>
                    </ul>
                </div>

                {{-- Kolom 2 --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Services</h4>
                    <ul class="space-y-4 font-bold text-sm opacity-80 uppercase">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Press Release</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">SEO Management</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Visual Design</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Digital Ads</a></li>
                    </ul>
                </div>

                {{-- Kolom 3 --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Reach Us</h4>
                    <p class="font-bold opacity-80 leading-relaxed text-sm">
                        Jl. Bering 1 No. 4,<br>
                        Kota Bogor, Jawa Barat<br>
                        Indonesia, 16115
                    </p>
                </div>

                {{-- Kolom 4 --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Business</h4>
                    <p class="font-black text-lg mb-2">hello@kontendigital.id</p>
                    <p class="font-bold mb-8 opacity-70">+62 21-2273-3333</p>
                    <div class="flex gap-4">
                        @foreach(['TW','FB','IN','IG'] as $social)
                        <a href="#"
                           class="w-10 h-10 bg-yellow-400 rounded-full border-2 border-black
                                  flex items-center justify-center text-black font-black
                                  uppercase text-xs hover:scale-110 transition-transform">
                            {{ $social }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t-2 border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="font-bold text-[10px] uppercase tracking-widest opacity-40 text-center">
                    © {{ date('Y') }} KONTENDIGITAL.ID — ALL RIGHTS RESERVED
                </p>
                <div class="h-1 w-20 bg-yellow-400"></div>
            </div>
        </div>
    </footer>

    {{-- ── SCRIPTS ─────────────────────────────────────────────────── --}}
    <script>
        // Navbar scroll
        const nav = document.getElementById('main-nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        });

        // Burger mobile
        const burger     = document.getElementById('burger');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen   = document.getElementById('burger-open');
        const iconClose  = document.getElementById('burger-close');
        burger.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            iconOpen.classList.toggle('hidden', isOpen);
            iconClose.classList.toggle('hidden', !isOpen);
        });

        // Search toggle
        const searchToggle = document.getElementById('search-toggle');
        const searchBar    = document.getElementById('search-bar');
        if (searchToggle) {
            searchToggle.addEventListener('click', () => {
                searchBar.classList.toggle('hidden');
                if (!searchBar.classList.contains('hidden')) {
                    searchBar.querySelector('input').focus();
                }
            });
        }

        // User dropdown
        const dropBtn  = document.getElementById('user-dropdown-btn');
        const dropMenu = document.getElementById('user-dropdown-menu');
        dropBtn?.addEventListener('click', () => dropMenu.classList.toggle('hidden'));
        document.addEventListener('click', (e) => {
            if (!document.getElementById('user-dropdown-wrap')?.contains(e.target)) {
                dropMenu?.classList.add('hidden');
            }
        });

        // Auto-hide flash message
        const flash = document.getElementById('flash-msg');
        if (flash) {
            setTimeout(() => {
                flash.style.opacity = '0';
                flash.style.transition = 'opacity 0.5s';
                setTimeout(() => flash.remove(), 500);
            }, 4000);
        }

        // Scroll reveal
        const observer = new IntersectionObserver(
            entries => entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add('animate-in');
            }),
            { threshold: 0.1 }
        );
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>