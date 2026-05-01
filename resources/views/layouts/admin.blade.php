{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — @yield('title') | KontenDigital.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900&family=Bebas+Neue&family=Special+Elite&family=Courier+Prime:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/css/retro.css'])
</head>
<body class="bg-cream min-h-screen flex antialiased">

    {{-- ── SIDEBAR ─────────────────────────────── --}}
    <aside id="sidebar" class="w-64 bg-ink border-r-2 border-gold flex flex-col shrink-0 min-h-screen fixed top-0 left-0 z-40 transition-transform duration-300 lg:translate-x-0 -translate-x-full">

        {{-- Sidebar Header --}}
        <div class="p-5 border-b border-gold/30">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 border-2 border-gold flex items-center justify-center shrink-0">
                    <span class="font-display text-gold text-lg">KD</span>
                </div>
                <div>
                    <p class="font-display text-cream text-lg leading-none tracking-widest">KontenDigital</p>
                    <p class="font-typewriter text-gold/60 text-xs tracking-widest">ADMIN PANEL</p>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 py-6 px-3 overflow-y-auto">
            <p class="font-typewriter text-gold/30 text-xs tracking-widest px-3 mb-3">MENU UTAMA</p>
            <ul class="space-y-1">
                @foreach([
                    [route('admin.dashboard'),'◈','Dashboard'],
                    [route('admin.orders'),'◉','Pesanan'],
                    [route('admin.articles.index'),'✦','Artikel'],
                    [route('admin.media.index'),'⬡','Media Partner'],
                    [route('admin.clients.index'),'✧','Klien'],
                    [route('admin.reports.index'),'◆','Laporan Tayang'],
                ] as [$href, $icon, $label])
                <li>
                    <a href="{{ $href }}"
                       class="flex items-center gap-3 px-3 py-2.5 font-typewriter text-xs tracking-widest text-cream/60 hover:text-gold hover:bg-gold/5 border border-transparent hover:border-gold/20 transition-all group {{ request()->routeIs(basename($href).'*') ? 'text-gold bg-gold/10 border-gold/20' : '' }}">
                        <span class="text-gold/60 group-hover:text-gold text-base w-5 text-center">{{ $icon }}</span>
                        {{ strtoupper($label) }}
                    </a>
                </li>
                @endforeach
            </ul>

            <p class="font-typewriter text-gold/30 text-xs tracking-widest px-3 mb-3 mt-8">PENGATURAN</p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 font-typewriter text-xs tracking-widest text-cream/60 hover:text-gold hover:bg-gold/5 border border-transparent hover:border-gold/20 transition-all">
                        <span class="text-gold/60 text-base w-5 text-center">⚙</span> PENGATURAN
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 font-typewriter text-xs tracking-widest text-rust/80 hover:text-rust hover:bg-rust/5 border border-transparent hover:border-rust/20 transition-all">
                            <span class="text-base w-5 text-center">⏻</span> KELUAR
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        {{-- User Info --}}
        <div class="p-4 border-t border-gold/20">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 border border-gold bg-gold/20 flex items-center justify-center">
                    <span class="font-display text-gold text-sm">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="font-typewriter text-cream text-xs truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                    <p class="font-mono text-gold/40 text-xs truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ── MAIN AREA ────────────────────────────── --}}
    <div class="flex-1 flex flex-col lg:ml-64">

        {{-- Top bar --}}
        <header class="bg-paper border-b border-gold/30 px-6 py-3 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                {{-- Mobile burger --}}
                <button id="sidebar-toggle" class="lg:hidden text-ink p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 font-typewriter text-xs tracking-widest text-sepia">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gold">ADMIN</a>
                    <span class="text-gold/40">/</span>
                    <span class="text-ink">@yield('title', 'Dashboard')</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="font-typewriter text-xs text-sepia hover:text-gold tracking-widest transition-colors">
                    ↗ LIHAT WEBSITE
                </a>
                <div class="font-mono text-ink/40 text-xs">{{ now()->format('H:i') }}</div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

    {{-- Sidebar overlay for mobile --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-ink/50 z-30 hidden lg:hidden"></div>

    <script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggle  = document.getElementById('sidebar-toggle');
    toggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });
    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
    </script>

    @stack('scripts')
</body>
</html>