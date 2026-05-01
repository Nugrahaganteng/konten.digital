{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KontenDigital.id') }} — @yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&family=Syne:wght@700;800&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Ticker Tape Animation */
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-ticker {
            display: flex;
            width: max-content;
            animation: ticker 30s linear infinite;
        }

        /* ── NAVBAR ERTRI-STYLE ── */
        #main-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;
            /* mulai transparan di atas hero kuning */
            background: transparent;
            transition: background 0.35s ease, box-shadow 0.35s ease;
        }
        /* setelah scroll: menjadi putih dengan border bawah */
        #main-nav.scrolled {
            background: #ffffff;
            box-shadow: 0 4px 0 0 #000;
        }

        /* link navbar */
        .nav-link-pop {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a1a2e;
            transition: color 0.2s;
        }
        .nav-link-pop:hover { color: #ef4444; }

        /* tombol CTA */
        .btn-pop {
            background: #3b0764;
            color: #fff;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 900;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.5rem 1.25rem;
            border-radius: 0.75rem;
            border: 3px solid #000;
            box-shadow: 4px 4px 0 0 #000;
            transition: transform 0.15s, box-shadow 0.15s;
            display: inline-block;
        }
        .btn-pop:hover {
            transform: translateY(3px);
            box-shadow: none;
        }

        /* search icon */
        .search-btn {
            width: 2.2rem;
            height: 2.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid #1a1a2e;
            background: transparent;
            cursor: pointer;
            transition: background 0.2s;
        }
        .search-btn:hover { background: #1a1a2e; color: #facc15; }
        .search-btn svg { width: 1rem; height: 1rem; stroke: currentColor; }

        /* mobile menu */
        #mobile-menu {
            display: none;
            flex-direction: column;
            gap: 1.5rem;
            background: #facc15;
            border-top: 4px solid #000;
            padding: 2rem 1.5rem;
        }
        #mobile-menu.open { display: flex; }
        #mobile-menu a {
            font-family: 'Unbounded', sans-serif;
            font-weight: 900;
            font-size: 1.25rem;
            text-transform: uppercase;
            color: #1a1a2e;
        }

        /* card retro (untuk konten halaman) */
        .card-retro {
            background: #fff;
            border: 4px solid #000;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 8px 8px 0 0 #000;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .card-retro:hover {
            transform: translate(4px, 4px);
            box-shadow: none;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased min-h-screen bg-yellow-400 font-['Space_Grotesk']">

    {{-- ── NAVBAR (Ertri-style: transparan → putih saat scroll) ───── --}}
    <nav id="main-nav">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-20">

                {{-- Logo (kiri) --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 bg-purple-900 border-3 border-black rounded-xl flex items-center justify-center
                                transform group-hover:rotate-6 transition-transform"
                         style="border-width:3px; border-color:#000;">
                        <span class="text-yellow-400 font-black text-lg" style="font-family:'Unbounded',sans-serif">K</span>
                    </div>
                    <div class="leading-none">
                        <p style="font-family:'Unbounded',sans-serif; font-weight:900; font-size:1rem; color:#1a1a2e; letter-spacing:-0.02em; text-transform:uppercase;">
                            KontenDigital
                        </p>
                        <p style="font-size:0.6rem; font-weight:700; color:#ef4444; text-transform:uppercase; letter-spacing:0.15em;">
                            Growth Partner
                        </p>
                    </div>
                </a>

                {{-- Menu Tengah (desktop) --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"      class="nav-link-pop">Home</a>
                    <a href="#about"                   class="nav-link-pop">About Us</a>
                    <a href="{{ route('services') }}"  class="nav-link-pop">Services</a>
                    <a href="#portfolio"               class="nav-link-pop">Portfolio</a>
                    <a href="#career"                  class="nav-link-pop">Career</a>
                    <a href="#contact"                 class="nav-link-pop">Contact Us</a>
                </div>

                {{-- Search + CTA (kanan) --}}
                <div class="flex items-center gap-3">
                    {{-- Ikon Search --}}
                    <button class="search-btn hidden md:flex" id="search-toggle" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </button>

                    {{-- CTA Button --}}
                    <a href="https://wa.me/6281234567890" class="btn-pop hidden sm:inline-block">
                        Contact Us
                    </a>

                    {{-- Hamburger (mobile) --}}
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

        {{-- Search Bar (dropdown) --}}
        <div id="search-bar"
             class="hidden absolute left-0 w-full bg-white border-b-4 border-black px-6 py-4">
            <form action="#" method="GET" class="max-w-2xl mx-auto flex gap-2">
                <input type="text" name="q" placeholder="Cari layanan, artikel..."
                       class="flex-1 border-3 border-black rounded-xl px-4 py-2 font-bold text-sm focus:outline-none"
                       style="border-width:3px;">
                <button type="submit" class="btn-pop">Cari</button>
            </form>
        </div>
    </nav>

    {{-- Spacer agar konten tidak tertutup navbar fixed --}}
    {{-- Hero section biasanya full-screen jadi tidak perlu spacer --}}

    {{-- ── MAIN CONTENT ──────────────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── FOOTER ─────────────────────────────────────────────────── --}}
    <footer class="bg-purple-950 pt-24 pb-12 border-t-8 border-black text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">

                {{-- Col 1 --}}
                <div>
                    <div style="font-family:'Unbounded',sans-serif; font-weight:900; font-size:1.75rem; letter-spacing:-0.02em; margin-bottom:2rem;">
                        KONTEN<span class="text-yellow-400">DIGITAL</span>
                    </div>
                    <ul class="space-y-4 font-bold text-sm uppercase opacity-80">
                        <li><a href="#" class="hover:text-yellow-400">Home</a></li>
                        <li><a href="#" class="hover:text-yellow-400">About Us</a></li>
                        <li><a href="#" class="hover:text-yellow-400">Portfolio</a></li>
                        <li><a href="#" class="hover:text-yellow-400">Career</a></li>
                    </ul>
                </div>

                {{-- Col 2 --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Services</h4>
                    <ul class="space-y-4 font-bold text-sm opacity-80 uppercase">
                        <li><a href="#" class="hover:text-yellow-400">Press Release</a></li>
                        <li><a href="#" class="hover:text-yellow-400">SEO Management</a></li>
                        <li><a href="#" class="hover:text-yellow-400">Visual Design</a></li>
                        <li><a href="#" class="hover:text-yellow-400">Digital Ads</a></li>
                    </ul>
                </div>

                {{-- Col 3 --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Reach Us</h4>
                    <p class="font-bold opacity-80 leading-relaxed text-sm">
                        Jl. Bering 1 No. 4,<br>
                        Kota Bogor, Jawa Barat<br>
                        Indonesia, 16115
                    </p>
                </div>

                {{-- Col 4 --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Business</h4>
                    <p class="font-black text-lg mb-2">hello@kontendigital.id</p>
                    <p class="font-bold mb-8 opacity-70">+62 21-2273-3333</p>
                    <div class="flex gap-4">
                        @foreach(['TW','FB','IN','IG'] as $social)
                        <a href="#" class="w-10 h-10 bg-yellow-400 rounded-full border-2 border-black
                                           flex items-center justify-center text-black font-black
                                           uppercase text-xs hover:scale-110 transition-transform">
                            {{ $social }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="font-bold text-[10px] uppercase tracking-widest opacity-40 text-center">
                    © {{ date('Y') }} KONTENDIGITAL.ID — ALL RIGHTS RESERVED
                </p>
                <div class="h-1 w-20 bg-yellow-400"></div>
            </div>
        </div>
    </footer>

    <script>
        // ── Navbar: transparan → putih saat scroll ──
        const nav = document.getElementById('main-nav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // ── Burger Mobile ──
        const burger      = document.getElementById('burger');
        const mobileMenu  = document.getElementById('mobile-menu');
        const iconOpen    = document.getElementById('burger-open');
        const iconClose   = document.getElementById('burger-close');

        burger.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            iconOpen.classList.toggle('hidden', isOpen);
            iconClose.classList.toggle('hidden', !isOpen);
        });

        // ── Search Toggle ──
        const searchToggle = document.getElementById('search-toggle');
        const searchBar    = document.getElementById('search-bar');

        searchToggle.addEventListener('click', () => {
            searchBar.classList.toggle('hidden');
            if (!searchBar.classList.contains('hidden')) {
                searchBar.querySelector('input').focus();
            }
        });

        // ── IntersectionObserver untuk animasi reveal ──
        const observer = new IntersectionObserver(
            entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('animate-in'); }),
            { threshold: 0.1 }
        );
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>