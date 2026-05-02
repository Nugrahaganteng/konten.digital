{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title') | KontenDigital.id</title>

    {{-- Fonts (sama dengan app.blade.php) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700;900&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">

    {{-- Hanya satu CSS, tidak ada retro.css --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

{{-- Admin body: putih bukan kuning (override body default) --}}
<body class="bg-white min-h-screen flex antialiased" style="font-family:'Space Grotesk',sans-serif;">

    {{-- ── SIDEBAR ─────────────────────────────────────────────────── --}}
    <aside id="sidebar">

        {{-- Sidebar Header / Logo --}}
        <div class="p-5 border-b-4 border-black">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-400 border-4 border-black rounded-lg
                            flex items-center justify-center shrink-0">
                    <span class="font-black text-black text-sm"
                          style="font-family:'Unbounded',sans-serif">KD</span>
                </div>
                <div>
                    <p class="font-black text-white text-sm tracking-widest uppercase"
                       style="font-family:'Unbounded',sans-serif">KontenDigital</p>
                    <p class="text-yellow-400/70 text-[0.6rem] font-bold tracking-widest uppercase">
                        Admin Panel
                    </p>
                </div>
            </a>
        </div>

        {{-- Nav Links --}}
        <nav class="flex-1 py-6 px-3 overflow-y-auto">
            <p class="text-yellow-400/40 text-[0.6rem] font-black tracking-widest uppercase px-3 mb-3">
                Menu Utama
            </p>
            <ul class="space-y-1">
                @foreach([
                    [route('admin.dashboard'),       '◈', 'Dashboard'],
                    [route('admin.orders'),          '◉', 'Pesanan'],
                    [route('admin.articles.index'),  '✦', 'Artikel'],
                    [route('admin.media.index'),     '⬡', 'Media Partner'],
                    [route('admin.clients.index'),   '✧', 'Klien'],
                    [route('admin.reports.index'),   '◆', 'Laporan Tayang'],
                ] as [$href, $icon, $label])
                <li>
                    <a href="{{ $href }}"
                       class="sidebar-link {{ request()->url() === $href ? 'active' : '' }}">
                        <span>{{ $icon }}</span>
                        {{ strtoupper($label) }}
                    </a>
                </li>
                @endforeach
            </ul>

            <p class="text-yellow-400/40 text-[0.6rem] font-black tracking-widest uppercase px-3 mb-3 mt-8">
                Pengaturan
            </p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.settings') }}" class="sidebar-link">
                        <span>⚙</span> PENGATURAN
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-3 font-black text-xs
                                       tracking-widest uppercase text-red-400/80 border border-transparent
                                       hover:text-red-400 hover:bg-red-400/10 hover:border-red-400/30
                                       transition-all">
                            <span class="w-5 text-center text-base">⏻</span> KELUAR
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        {{-- User Info --}}
        <div class="p-4 border-t-4 border-black">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-yellow-400 border-2 border-black rounded-lg
                            flex items-center justify-center shrink-0">
                    <span class="font-black text-black text-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                    </span>
                </div>
                <div class="min-w-0">
                    <p class="text-white font-bold text-xs truncate">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </p>
                    <p class="text-yellow-400/50 text-[0.65rem] truncate">
                        {{ auth()->user()->email ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ── MAIN AREA ────────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col lg:ml-64">

        {{-- Top Bar --}}
        <header class="bg-yellow-400 border-b-4 border-black px-6 py-3
                       flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                {{-- Burger Mobile --}}
                <button id="sidebar-toggle" class="lg:hidden text-black p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 font-black text-xs tracking-widest uppercase text-black">
                    <a href="{{ route('admin.dashboard') }}"
                       class="hover:text-purple-950 transition-colors">ADMIN</a>
                    <span class="text-black/40">/</span>
                    <span>@yield('title', 'Dashboard')</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" target="_blank"
                   class="font-black text-xs text-black/60 hover:text-black tracking-widest uppercase transition-colors">
                    ↗ LIHAT WEBSITE
                </a>
                <div class="font-bold text-black/50 text-xs tracking-widest">
                    {{ now()->format('H:i') }}
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6 lg:p-8 bg-gray-50">
            @yield('content')
        </main>
    </div>

    {{-- Sidebar overlay (mobile) --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

    {{-- ── SCRIPTS ─────────────────────────────────────────────────── --}}
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