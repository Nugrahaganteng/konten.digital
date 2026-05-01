{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'KontenDigital.id') }} — @yield('title', 'Jasa Press Release Profesional')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Bebas+Neue&family=Special+Elite&family=Courier+Prime:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/retro.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="antialiased min-h-screen">

    {{-- ── TICKER TAPE TOP ────────────────────── --}}
    <div class="ticker-wrap py-1.5">
        <div class="ticker-inner gap-12">
            @foreach(range(1,4) as $i)
            <span class="text-gold font-typewriter text-xs tracking-widest mx-8">✦ PRESS RELEASE</span>
            <span class="text-cream font-typewriter text-xs tracking-widest mx-8">200+ MEDIA NASIONAL</span>
            <span class="text-gold font-typewriter text-xs tracking-widest mx-8">✦ GARANSI TAYANG</span>
            <span class="text-cream font-typewriter text-xs tracking-widest mx-8">20 TAHUN PENGALAMAN</span>
            <span class="text-gold font-typewriter text-xs tracking-widest mx-8">✦ FULL REFUND POLICY</span>
            <span class="text-cream font-typewriter text-xs tracking-widest mx-8">KONSULTASI GRATIS</span>
            @endforeach
        </div>
    </div>

    {{-- ── NAVBAR ──────────────────────────────── --}}
    <nav class="bg-ink border-b-2 border-gold sticky top-0 z-50" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 border-2 border-gold flex items-center justify-center relative">
                        <span class="font-display text-gold text-lg leading-none">KD</span>
                        <div class="absolute -top-1 -right-1 w-2 h-2 bg-gold"></div>
                    </div>
                    <div class="hidden sm:block">
                        <p class="font-display text-cream text-xl leading-none tracking-widest">KontenDigital</p>
                        <p class="font-typewriter text-gold text-xs tracking-[0.3em]">.id — Est. 2004</p>
                    </div>
                </a>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link-retro">Beranda</a>
                    <a href="{{ route('services') }}" class="nav-link-retro">Layanan</a>
                    <a href="{{ route('pricing') }}" class="nav-link-retro">Harga</a>
                    <a href="{{ route('about') }}" class="nav-link-retro">Tentang</a>
                    <a href="{{ route('contact') }}" class="nav-link-retro">Kontak</a>
                </div>

                {{-- CTA --}}
                <div class="flex items-center gap-3">
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn-retro text-xs hidden sm:inline-block">
                        Konsultasi Gratis
                    </a>
                    {{-- Mobile burger --}}
                    <button id="burger" class="md:hidden text-cream p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden bg-ink-light border-t border-gold/30">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="nav-link-retro block py-1">Beranda</a>
                <a href="{{ route('services') }}" class="nav-link-retro block py-1">Layanan</a>
                <a href="{{ route('pricing') }}" class="nav-link-retro block py-1">Harga</a>
                <a href="{{ route('about') }}" class="nav-link-retro block py-1">Tentang</a>
                <a href="{{ route('contact') }}" class="nav-link-retro block py-1">Kontak</a>
                <a href="https://wa.me/6281234567890" class="btn-retro text-xs block text-center mt-2">Konsultasi Gratis</a>
            </div>
        </div>
    </nav>

    {{-- ── MAIN CONTENT ────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── FOOTER ──────────────────────────────── --}}
    <footer class="bg-ink border-t-2 border-gold mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="md:col-span-2">
                    <p class="font-display text-gold text-3xl tracking-widest mb-1">KontenDigital.id</p>
                    <p class="font-typewriter text-gold/50 text-xs tracking-widest mb-4">MITRA PUBLIKASI MEDIA ANDA — EST. 2004</p>
                    <div class="w-16 h-0.5 bg-gold mb-4"></div>
                    <p class="font-mono text-cream/70 text-sm leading-relaxed">
                        Kami adalah mitra terpercaya Anda dalam menghasilkan konten berkualitas tinggi. Dengan pengalaman lebih dari 20 tahun di industri media, kami hadir untuk membantu Anda mencapai tujuan bisnis.
                    </p>
                    <div class="flex gap-3 mt-6">
                        <a href="#" class="w-9 h-9 border border-gold/50 flex items-center justify-center text-gold hover:bg-gold hover:text-ink transition-colors text-xs font-display">WA</a>
                        <a href="#" class="w-9 h-9 border border-gold/50 flex items-center justify-center text-gold hover:bg-gold hover:text-ink transition-colors text-xs font-display">IG</a>
                        <a href="#" class="w-9 h-9 border border-gold/50 flex items-center justify-center text-gold hover:bg-gold hover:text-ink transition-colors text-xs font-display">FB</a>
                    </div>
                </div>

                {{-- Layanan --}}
                <div>
                    <p class="section-eyebrow text-gold mb-4">Layanan Kami</p>
                    <ul class="space-y-2">
                        @foreach(['Press Release','Backlink Media','Press Conference','Penulisan Artikel','Script Video','Pelatihan Konten'] as $svc)
                        <li>
                            <a href="#" class="font-mono text-cream/60 text-sm hover:text-gold transition-colors flex items-center gap-2">
                                <span class="text-gold/40">›</span> {{ $svc }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <p class="section-eyebrow text-gold mb-4">Hubungi Kami</p>
                    <ul class="space-y-3">
                        <li class="font-mono text-cream/60 text-sm flex gap-2">
                            <span class="text-gold shrink-0">✉</span>
                            <span>hello@kontendigital.id</span>
                        </li>
                        <li class="font-mono text-cream/60 text-sm flex gap-2">
                            <span class="text-gold shrink-0">☎</span>
                            <span>+62 821-xxxx-xxxx</span>
                        </li>
                        <li class="font-mono text-cream/60 text-sm flex gap-2">
                            <span class="text-gold shrink-0">◉</span>
                            <span>Jakarta, Indonesia</span>
                        </li>
                    </ul>
                    <div class="mt-6 border border-gold/30 p-3">
                        <p class="font-typewriter text-gold text-xs tracking-widest mb-1">JAM OPERASIONAL</p>
                        <p class="font-mono text-cream/60 text-xs">Senin – Jumat: 09:00 – 17:00</p>
                        <p class="font-mono text-cream/60 text-xs">Sabtu: 09:00 – 13:00</p>
                    </div>
                </div>

            </div>

            {{-- Bottom bar --}}
            <div class="border-t border-gold/20 mt-12 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3">
                <p class="font-typewriter text-cream/40 text-xs tracking-widest">© {{ date('Y') }} KONTENDIGITAL.ID — ALL RIGHTS RESERVED</p>
                <p class="font-typewriter text-gold/40 text-xs tracking-widest">PROFESSIONAL PRESS RELEASE SERVICE SINCE 2004</p>
            </div>
        </div>
    </footer>

    {{-- ── GLOBAL SCRIPTS ──────────────────────── --}}
    <script>
    // Mobile Menu
    document.getElementById('burger').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('navbar');
        nav.classList.toggle('shadow-lg', window.scrollY > 20);
    });

    // Scroll Reveal
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 100);
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>