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

    {{-- Vite: hanya app.css + app.js, tidak perlu retro.css lagi --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="antialiased min-h-screen bg-yellow-400">

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
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"     class="nav-link-pop">Home</a>
                    <a href="#about"                  class="nav-link-pop">About Us</a>
                    <a href="{{ route('services') }}" class="nav-link-pop">Services</a>
                    <a href="#blog"                   class="nav-link-pop">Blog</a>
                    <a href="#career"                 class="nav-link-pop">Career</a>
                    <a href="#contact"                class="nav-link-pop">Contact</a>
                </div>

                {{-- Kanan: Search + CTA + Burger --}}
                <div class="flex items-center gap-3">
                    <button class="search-btn" id="search-toggle" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </button>

                    <a href="https://wa.me/6281234567890" class="btn-pop hidden sm:inline-block">
                        Contact Us
                    </a>

                    {{-- Burger Mobile --}}
                    <button id="burger" class="md:hidden text-black" aria-label="Toggle menu">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path id="burger-open"  stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 8h16M4 16h16"/>
                            <path id="burger-close" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" class="hidden"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu">
            <a href="{{ route('home') }}">Home</a>
            <a href="#about">About Us</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="#portfolio">Portfolio</a>
            <a href="#career">Career</a>
            <a href="#contact">Contact Us</a>
            <a href="https://wa.me/6281234567890" class="btn-pop text-center">Contact Us</a>
        </div>

        {{-- Search Bar Dropdown --}}
        <div id="search-bar">
            <form action="#" method="GET" class="max-w-2xl mx-auto flex gap-2">
                <input type="text" name="q" placeholder="Cari layanan, artikel..."
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

                {{-- Kolom 1: Brand + Nav --}}
                <div>
                    <p class="font-black text-[1.75rem] leading-none mb-8"
                       style="font-family:'Unbounded',sans-serif">
                        KONTEN<span class="text-yellow-400">DIGITAL</span>
                    </p>
                    <ul class="space-y-4 font-bold text-sm uppercase opacity-80">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Portfolio</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Career</a></li>
                    </ul>
                </div>

                {{-- Kolom 2: Services --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Services</h4>
                    <ul class="space-y-4 font-bold text-sm opacity-80 uppercase">
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Press Release</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">SEO Management</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Visual Design</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Digital Ads</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Alamat --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Reach Us</h4>
                    <p class="font-bold opacity-80 leading-relaxed text-sm">
                        Jl. Bering 1 No. 4,<br>
                        Kota Bogor, Jawa Barat<br>
                        Indonesia, 16115
                    </p>
                </div>

                {{-- Kolom 4: Kontak + Sosial --}}
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
        // Navbar scroll effect
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
        searchToggle.addEventListener('click', () => {
            searchBar.classList.toggle('hidden');
            if (!searchBar.classList.contains('hidden')) {
                searchBar.querySelector('input').focus();
            }
        });

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