<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard') | HNP Communications.id</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700;900&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        #sidebar {
            position: fixed;
            inset-y: 0;
            left: 0;
            width: 16rem;
            background: #300066;
            display: flex;
            flex-direction: column;
            z-index: 40;
            transition: transform .3s;
            border-right: 4px solid #000;
        }
        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.75rem;
            font-size: 0.68rem;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            border: 2px solid transparent;
            transition: all .15s;
            border-radius: 2px;
        }
        .sidebar-link:hover {
            color: #FFD200;
            background: rgba(255,210,0,0.08);
            border-color: rgba(255,210,0,0.2);
        }
        .sidebar-link.active {
            color: #FFD200;
            background: rgba(255,210,0,0.15);
            border-color: #FFD200;
        }
        .sidebar-section-label {
            color: rgba(255,210,0,0.35);
            font-size: 0.58rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            padding: 0 0.75rem;
            margin-bottom: 0.4rem;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex antialiased" style="font-family:'Space Grotesk',sans-serif;">

    {{-- ── SIDEBAR ──────────────────────────────────────────────────── --}}
    <aside id="sidebar">

        {{-- Logo --}}
        <div class="p-5 border-b-4 border-black shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-yellow-400 border-4 border-black rounded-lg flex items-center justify-center shrink-0">
                    <span class="font-black text-black text-sm" style="font-family:'Unbounded',sans-serif">HC</span>
                </div>
                <div>
                    <p class="font-black text-white text-xs tracking-widest uppercase leading-tight" style="font-family:'Unbounded',sans-serif">HNP Communications</p>
                    <p class="text-yellow-400/60 text-[0.58rem] font-bold tracking-widest uppercase mt-0.5">Admin Panel</p>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 py-5 px-3 overflow-y-auto space-y-5">

            {{-- MAIN MENU --}}
            <div>
                <p class="sidebar-section-label mb-2">Main Menu</p>
                <ul class="space-y-0.5">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="text-base leading-none">◈</span> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles.index') }}"
                           class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                            <span class="text-base leading-none">✍</span> Manajemen Artikel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.index') }}"
                           class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                            <span class="text-base leading-none">✉</span> Pesan Masuk
                        </a>
                    </li>
                       <li>
                        <a href="{{ route('admin.cms.page-sections.index') }}"
                           class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                            <span class="text-base leading-none">✉</span> cms kontrol
                        </a>
                    </li>
                </ul>
            </div>

          
           

            {{-- SITE --}}
            <div>
                <p class="sidebar-section-label mb-2">Site</p>
                <ul class="space-y-0.5">
                    <li>
                        <a href="{{ route('home') }}" target="_blank"
                           class="sidebar-link">
                            <span class="text-base leading-none">↗</span> Lihat Website
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}" target="_blank"
                           class="sidebar-link">
                            <span class="text-base leading-none">📰</span> Halaman Blog
                        </a>
                    </li>
                </ul>
            </div>

            {{-- LOGOUT --}}
            <div>
                <p class="sidebar-section-label mb-2">Akun</p>
                <ul class="space-y-0.5">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="sidebar-link w-full text-left text-red-400/70 hover:text-red-400 hover:bg-red-400/10 hover:border-red-400/30">
                                <span class="text-base leading-none">⏻</span> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </nav>

        {{-- User Info --}}
        <div class="p-4 border-t-4 border-black shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-yellow-400 border-2 border-black rounded-lg flex items-center justify-center shrink-0">
                    <span class="font-black text-black text-xs">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</span>
                </div>
                <div class="min-w-0">
                    <p class="text-white font-bold text-xs truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                    <p class="text-yellow-400/50 text-[0.62rem] truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- ── MAIN AREA ────────────────────────────────────────────────── --}}
    <div class="flex-1 flex flex-col lg:ml-64 min-h-screen">

        {{-- Top Bar --}}
        <header class="bg-yellow-400 border-b-4 border-black px-6 py-3 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                {{-- Burger Mobile --}}
                <button id="sidebar-toggle" class="lg:hidden text-black p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 font-black text-xs tracking-widest uppercase text-black">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-purple-950 transition-colors">ADMIN</a>
                    <span class="text-black/30">/</span>
                    <span>@yield('title', 'Dashboard')</span>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" target="_blank"
                   class="hidden sm:block font-black text-xs text-black/60 hover:text-black tracking-widest uppercase transition-colors">
                    ↗ LIHAT WEBSITE
                </a>
                <div id="clock-wib" class="font-bold text-black/70 text-xs tracking-widest hidden sm:block"></div>
            </div>
        </header>

        {{-- Flash: Success --}}
        @if(session('success'))
        <div class="mx-6 mt-4" x-data="{ show: true }" x-show="show">
            <div class="bg-green-100 border-4 border-green-600 text-green-800 font-bold px-4 py-3 flex items-center justify-between text-sm">
                <span>✓ {{ session('success') }}</span>
                <button onclick="this.closest('.mx-6').remove()" class="ml-4 text-green-600 hover:text-green-900 font-black">✕</button>
            </div>
        </div>
        @endif

        {{-- Flash: Error --}}
        @if(session('error'))
        <div class="mx-6 mt-4">
            <div class="bg-red-100 border-4 border-red-600 text-red-800 font-bold px-4 py-3 flex items-center justify-between text-sm">
                <span>✕ {{ session('error') }}</span>
                <button onclick="this.closest('.mx-6').remove()" class="ml-4 text-red-600 hover:text-red-900 font-black">✕</button>
            </div>
        </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="mx-6 mt-4">
            <div class="bg-red-100 border-4 border-red-600 text-red-800 font-bold px-4 py-3 text-sm">
                <p class="font-black mb-1">⚠ Terdapat {{ $errors->count() }} kesalahan:</p>
                <ul class="list-disc list-inside space-y-0.5 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 bg-gray-50">
            @yield('content')
        </main>

        {{-- Footer Admin --}}
        <footer class="border-t-2 border-black/10 px-6 py-3 bg-white">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest text-center">
                © {{ date('Y') }} HNP Communications.id — Admin Panel
            </p>
        </footer>
    </div>

    {{-- Sidebar overlay (mobile) --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

    {{-- Scripts --}}
    <script>
        // ── Sidebar toggle (mobile) ───────────────────────────────────
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle  = document.getElementById('sidebar-toggle');

        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        });
        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
        });

        // ── Jam WIB Realtime ──────────────────────────────────────────
        function updateClock() {
            const now = new Date();
            const wib = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
            const h   = String(wib.getHours()).padStart(2, '0');
            const m   = String(wib.getMinutes()).padStart(2, '0');
            const s   = String(wib.getSeconds()).padStart(2, '0');
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const day = days[wib.getDay()];
            const el = document.getElementById('clock-wib');
            if (el) el.textContent = day + ', ' + h + ':' + m + ':' + s + ' WIB';
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ── Auto-dismiss flash (4 detik) ──────────────────────────────
        setTimeout(() => {
            document.querySelectorAll('.mx-6.mt-4').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);
    </script>

    @stack('scripts')
</body>
</html>