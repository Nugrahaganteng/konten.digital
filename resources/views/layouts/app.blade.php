<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blog') — MyBlog</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Tailwind CDN (dev) — ganti dengan Vite build di production --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body: ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        ink: '#111118',
                        cream: '#faf8f3',
                        accent: '#e8402a',
                        muted: '#6b7280',
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Playfair Display', serif; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #faf8f3; }
        ::-webkit-scrollbar-thumb { background: #e8402a; border-radius: 2px; }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Navbar link underline animation */
        .nav-link::after {
            content: '';
            display: block;
            height: 2px;
            background: #e8402a;
            transform: scaleX(0);
            transition: transform .25s ease;
            transform-origin: left;
        }
        .nav-link:hover::after,
        .nav-link.active::after { transform: scaleX(1); }

        /* Fade in animation */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp .5s ease forwards; }
    </style>

    @stack('styles')
</head>
<body class="bg-cream text-ink min-h-screen flex flex-col">

{{-- ═══════════════════════════════ NAVBAR ═══════════════════════════════ --}}
<header class="sticky top-0 z-50 bg-cream/95 backdrop-blur border-b border-ink/8">
    <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="font-display font-black text-2xl tracking-tight">
            My<span class="text-accent">Blog</span>
        </a>

        {{-- Desktop Nav --}}
        <ul class="hidden md:flex items-center gap-8 text-sm font-medium">
            <li><a href="{{ route('home') }}"            class="nav-link pb-1 {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('articles.index') }}"  class="nav-link pb-1 {{ request()->routeIs('articles.*') ? 'active' : '' }}">Artikel</a></li>
            <li><a href="{{ route('about') }}"           class="nav-link pb-1 {{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('contact') }}"         class="nav-link pb-1 {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
        </ul>

        {{-- Auth / CTA --}}
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('articles.create') }}"
                   class="hidden md:inline-flex items-center gap-1.5 text-sm font-medium bg-ink text-cream px-4 py-2 rounded-full hover:bg-accent transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tulis
                </a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-sm font-medium text-accent hover:underline">Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-sm text-muted hover:text-ink transition-colors">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-muted hover:text-ink transition-colors">Masuk</a>
                <a href="{{ route('register') }}"
                   class="text-sm font-medium bg-accent text-white px-4 py-2 rounded-full hover:bg-accent/80 transition-colors">Daftar</a>
            @endauth

            {{-- Mobile hamburger --}}
            <button id="menu-toggle" class="md:hidden p-2 rounded-lg hover:bg-ink/5 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-ink/8 bg-cream px-6 py-4 space-y-3 text-sm font-medium">
        <a href="{{ route('home') }}" class="block">Beranda</a>
        <a href="{{ route('articles.index') }}" class="block">Artikel</a>
        <a href="{{ route('about') }}" class="block">Tentang</a>
        <a href="{{ route('contact') }}" class="block">Kontak</a>
        @auth
            <a href="{{ route('articles.create') }}" class="block text-accent">+ Tulis Artikel</a>
        @else
            <a href="{{ route('login') }}" class="block">Masuk</a>
            <a href="{{ route('register') }}" class="block text-accent">Daftar</a>
        @endauth
    </div>
</header>

{{-- ═══════════════════════════════ FLASH ════════════════════════════════ --}}
@if(session('success'))
    <div class="max-w-6xl mx-auto px-6 mt-4 fade-up">
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center justify-between">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </span>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">✕</button>
        </div>
    </div>
@endif

{{-- ═══════════════════════════════ CONTENT ═══════════════════════════════ --}}
<main class="flex-1">
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
    // Mobile menu toggle
    document.getElementById('menu-toggle').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

@stack('scripts')
</body>
</html>
