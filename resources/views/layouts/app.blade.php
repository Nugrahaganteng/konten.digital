<<<<<<< HEAD
{{-- resources/views/layouts/app.blade.php --}}
=======
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'KontenDigital.id') }} — @yield('title')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<<<<<<< HEAD
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700;900&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">
=======
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&family=Syne:wght@700;800&family=Unbounded:wght@400;900&family=Anton&display=swap" rel="stylesheet">
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835

    {{-- Vite: hanya app.css + app.js, tidak perlu retro.css lagi --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<<<<<<< HEAD
    @stack('styles')
</head>

<body class="antialiased min-h-screen bg-yellow-400">

    {{-- ── NAVBAR ─────────────────────────────────────────────────── --}}
=======
    <style>
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-ticker {
            display: flex;
            width: max-content;
            animation: ticker 30s linear infinite;
        }

        #main-nav {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            z-index: 50;
            background: transparent;
            transition: background 0.35s ease, box-shadow 0.35s ease;
        }
        #main-nav.scrolled {
            background: #ffffff;
            box-shadow: 0 4px 0 0 #000;
        }

        .nav-link-pop {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a1a2e;
            transition: color 0.2s;
            text-decoration: none;
        }
        .nav-link-pop:hover { color: #ef4444; }

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
            text-decoration: none;
        }
        .btn-pop:hover { transform: translateY(3px); box-shadow: none; }

        .btn-pop-outline {
            background: transparent;
            color: #1a1a2e;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 900;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.45rem 1.1rem;
            border-radius: 0.75rem;
            border: 3px solid #1a1a2e;
            transition: background 0.15s, color 0.15s;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-pop-outline:hover { background: #1a1a2e; color: #facc15; }

        .search-btn {
            width: 2.2rem; height: 2.2rem;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            border: 2px solid #1a1a2e;
            background: transparent;
            cursor: pointer;
            transition: background 0.2s;
        }
        .search-btn:hover { background: #1a1a2e; color: #facc15; }
        .search-btn svg { width: 1rem; height: 1rem; stroke: currentColor; }

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
            text-decoration: none;
        }

        .user-dropdown { position: relative; }
        .user-dropdown-menu {
            display: none;
            position: absolute;
            right: 0; top: calc(100% + 0.5rem);
            background: white;
            border: 3px solid #000;
            box-shadow: 5px 5px 0 #000;
            min-width: 180px;
            z-index: 100;
        }
        .user-dropdown:hover .user-dropdown-menu,
        .user-dropdown-menu:hover { display: block; }
        .user-dropdown-menu a,
        .user-dropdown-menu button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.65rem 1rem;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a1a2e;
            text-decoration: none;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            cursor: pointer;
            transition: background 0.15s;
        }
        .user-dropdown-menu a:hover,
        .user-dropdown-menu button:hover { background: #facc15; }
        .user-dropdown-menu a:last-child,
        .user-dropdown-menu button:last-child { border-bottom: none; }

        .user-avatar-btn {
            width: 2.2rem; height: 2.2rem;
            background: #3b0764;
            border: 2px solid #000;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #facc15;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 900;
            font-size: 0.85rem;
            cursor: pointer;
        }

        /* Alert flash */
        .flash-success {
            background: rgba(0,168,150,0.12);
            border: 2px solid #00a896;
            padding: 0.75rem 1.25rem;
            font-weight: 700;
            font-size: 0.9rem;
            color: #004d47;
            position: fixed;
            top: 5.5rem; right: 1.5rem;
            z-index: 999;
            max-width: 380px;
            box-shadow: 4px 4px 0 #000;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn { from { opacity:0; transform:translateX(20px); } to { opacity:1; transform:translateX(0); } }
    </style>

    @stack('styles')
</head>
<body class="antialiased min-h-screen bg-yellow-400 font-['Space_Grotesk']">

    {{-- ── FLASH MESSAGE ──────────────────────────────────────── --}}
    @if(session('success'))
        <div class="flash-success" id="flash-msg">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- ── NAVBAR ─────────────────────────────────────────────── --}}
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
    <nav id="main-nav">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
<<<<<<< HEAD
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
=======
                    <div class="w-11 h-11 bg-purple-900 rounded-xl flex items-center justify-center
                                transform group-hover:rotate-6 transition-transform"
                         style="border:3px solid #000;">
                        <span class="text-yellow-400 font-black text-lg" style="font-family:'Unbounded',sans-serif">K</span>
                    </div>
                    <div class="leading-none">
                        <p style="font-family:'Unbounded',sans-serif;font-weight:900;font-size:1rem;color:#1a1a2e;letter-spacing:-0.02em;text-transform:uppercase;">
                            KontenDigital
                        </p>
                        <p style="font-size:0.6rem;font-weight:700;color:#ef4444;text-transform:uppercase;letter-spacing:0.15em;">
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
                            Growth Partner
                        </p>
                    </div>
                </a>

<<<<<<< HEAD
                {{-- Menu Desktop --}}
        {{-- Menu Desktop --}}
<div class="hidden md:flex items-center gap-8">
    <a href="{{ route('home') }}" class="nav-link-pop">Home</a>
    <a href="#about" class="nav-link-pop">About Us</a>
    
    {{-- Dropdown Services --}}
    <div class="relative group">
        <button class="nav-link-pop flex items-center gap-1 focus:outline-none">
            Services
            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        
        {{-- Dropdown Menu --}}
        <div class="absolute left-0 mt-2 w-72 bg-white border-[3px] border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] 
                    opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                    transition-all duration-200 z-50 overflow-hidden">
            <div class="flex flex-col">
                <a href="#" class="px-6 py-4 text-sm font-bold text-gray-700 hover:bg-yellow-400 border-b-[2px] border-black transition-colors">Jasa Press Release</a>
                <a href="#" class="px-6 py-4 text-sm font-bold text-gray-700 hover:bg-yellow-400 border-b-[2px] border-black transition-colors">Jasa Backlink Media Nasional</a>
                <a href="#" class="px-6 py-4 text-sm font-bold text-gray-700 hover:bg-yellow-400 border-b-[2px] border-black transition-colors">Jasa Press Conference / Konferensi Pers</a>
                <a href="#" class="px-6 py-4 text-sm font-bold text-gray-700 hover:bg-yellow-400 border-b-[2px] border-black transition-colors">Jasa Penulisan Artikel</a>
                <a href="#" class="px-6 py-4 text-sm font-bold text-gray-700 hover:bg-yellow-400 border-b-[2px] border-black transition-colors">Jasa Penulisan Script Video / Televisi</a>
                <a href="#" class="px-6 py-4 text-sm font-bold text-gray-700 hover:bg-yellow-400 transition-colors">Jasa Pelatihan Konten Kreator</a>
            </div>
        </div>
    </div>

    <a href="#blog" class="nav-link-pop">Blog</a>
    <a href="#career" class="nav-link-pop">Career</a>
    <a href="#contact" class="nav-link-pop">Contact</a>
</div>
                {{-- Kanan: Search + CTA + Burger --}}
                <div class="flex items-center gap-3">
                    <button class="search-btn" id="search-toggle" aria-label="Search">
=======
                {{-- Menu Tengah (desktop) --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"          class="nav-link-pop">Home</a>
                    <a href="{{ route('services') }}"      class="nav-link-pop">Services</a>
                    <a href="{{ route('articles.index') }}" class="nav-link-pop">Blog</a>
                    <a href="{{ route('pricing') }}"       class="nav-link-pop">Pricing</a>
                    <a href="{{ route('contact') }}"       class="nav-link-pop">Contact</a>
                </div>

                {{-- Kanan: Search + Auth/User --}}
                <div class="flex items-center gap-3">
                    <button class="search-btn hidden md:flex" id="search-toggle" aria-label="Search">
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                    </button>

<<<<<<< HEAD
                    <a href="https://wa.me/6281234567890" class="btn-pop hidden sm:inline-block">
                        Contact Us
                    </a>

                    {{-- Burger Mobile --}}
=======
                    @auth
                        <div class="user-dropdown hidden sm:block">
                            <div class="user-avatar-btn">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="user-dropdown-menu">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}">⚙️ Admin Panel</a>
                                @endif
                                <a href="{{ route('articles.create') }}">✏️ Tulis Artikel</a>
                                <a href="{{ route('articles.index') }}">📖 Blog</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">⏻ Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"    class="btn-pop-outline hidden sm:inline-block">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-pop hidden sm:inline-block">Daftar</a>
                    @endauth

                    {{-- Hamburger --}}
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
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
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('articles.index') }}">Blog</a>
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="{{ route('contact') }}">Contact</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">⚙️ Admin Panel</a>
                @endif
                <a href="{{ route('articles.create') }}">✏️ Tulis Artikel</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="font-family:'Unbounded',sans-serif;font-weight:900;font-size:1.25rem;text-transform:uppercase;color:#e8402a;background:none;border:none;cursor:pointer;text-align:left;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}" class="btn-pop text-center">Daftar</a>
            @endauth
        </div>

<<<<<<< HEAD
        {{-- Search Bar Dropdown --}}
        <div id="search-bar">
            <form action="#" method="GET" class="max-w-2xl mx-auto flex gap-2">
                <input type="text" name="q" placeholder="Cari layanan, artikel..."
                       class="input-neo flex-1">
=======
        {{-- Search Bar --}}
        <div id="search-bar"
             class="hidden absolute left-0 w-full bg-white border-b-4 border-black px-6 py-4">
            <form action="{{ route('articles.index') }}" method="GET" class="max-w-2xl mx-auto flex gap-2">
                <input type="text" name="search" placeholder="Cari artikel..."
                       class="flex-1 border-black rounded-xl px-4 py-2 font-bold text-sm focus:outline-none"
                       style="border-width:3px;">
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
                <button type="submit" class="btn-pop">Cari</button>
            </form>
        </div>
    </nav>

<<<<<<< HEAD
    {{-- ── MAIN CONTENT ────────────────────────────────────────────── --}}
=======
    {{-- ── MAIN CONTENT ──────────────────────────────────────── --}}
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
    <main>
        @yield('content')
    </main>

    {{-- ── FOOTER ─────────────────────────────────────────────── --}}
    <footer class="bg-purple-950 pt-24 pb-12 border-t-8 border-black text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">

                {{-- Kolom 1: Brand + Nav --}}
                <div>
<<<<<<< HEAD
                    <p class="font-black text-[1.75rem] leading-none mb-8"
                       style="font-family:'Unbounded',sans-serif">
=======
                    <div style="font-family:'Unbounded',sans-serif;font-weight:900;font-size:1.75rem;letter-spacing:-0.02em;margin-bottom:2rem;">
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
                        KONTEN<span class="text-yellow-400">DIGITAL</span>
                    </p>
                    <ul class="space-y-4 font-bold text-sm uppercase opacity-80">
<<<<<<< HEAD
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Portfolio</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-colors">Career</a></li>
=======
                        <li><a href="{{ route('home') }}"           class="hover:text-yellow-400">Home</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-yellow-400">Blog</a></li>
                        <li><a href="{{ route('services') }}"       class="hover:text-yellow-400">Services</a></li>
                        <li><a href="{{ route('pricing') }}"        class="hover:text-yellow-400">Pricing</a></li>
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
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
                        Jl. Bering 1 No. 4,<br>Kota Bogor, Jawa Barat<br>Indonesia, 16115
                    </p>
                </div>

                {{-- Kolom 4: Kontak + Sosial --}}
                <div>
                    <h4 class="font-black uppercase mb-8 text-yellow-400 tracking-widest text-lg">Business</h4>
                    <p class="font-black text-lg mb-2">hello@kontendigital.id</p>
                    <p class="font-bold mb-8 opacity-70">+62 21-2273-3333</p>
                    <div class="flex gap-4">
                        @foreach(['TW','FB','IN','IG'] as $social)
<<<<<<< HEAD
                        <a href="#"
                           class="w-10 h-10 bg-yellow-400 rounded-full border-2 border-black
                                  flex items-center justify-center text-black font-black
                                  uppercase text-xs hover:scale-110 transition-transform">
                            {{ $social }}
                        </a>
=======
                            <a href="#" class="w-10 h-10 bg-yellow-400 rounded-full border-2 border-black
                                               flex items-center justify-center text-black font-black
                                               uppercase text-xs hover:scale-110 transition-transform">
                                {{ $social }}
                            </a>
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
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
<<<<<<< HEAD
        // Navbar scroll effect
=======
        // Navbar scroll
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
        const nav = document.getElementById('main-nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        });

<<<<<<< HEAD
        // Burger mobile
=======
        // Burger
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835
        const burger     = document.getElementById('burger');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen   = document.getElementById('burger-open');
        const iconClose  = document.getElementById('burger-close');
        burger.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('open');
            iconOpen.classList.toggle('hidden', isOpen);
            iconClose.classList.toggle('hidden', !isOpen);
        });

<<<<<<< HEAD
        // Search toggle
        const searchToggle = document.getElementById('search-toggle');
        const searchBar    = document.getElementById('search-bar');
        searchToggle.addEventListener('click', () => {
            searchBar.classList.toggle('hidden');
            if (!searchBar.classList.contains('hidden')) {
                searchBar.querySelector('input').focus();
            }
        });
=======
        // Search
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

        // Auto-hide flash
        const flash = document.getElementById('flash-msg');
        if (flash) {
            setTimeout(() => {
                flash.style.opacity = '0';
                flash.style.transition = 'opacity 0.5s';
                setTimeout(() => flash.remove(), 500);
            }, 4000);
        }
>>>>>>> 313b8541b317e9e018aa1257747803400b8e1835

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