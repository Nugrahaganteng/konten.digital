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
    /* HAPUS CSS LAMA, GANTI DENGAN YANG INI */
    #sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 16rem;
        background: #300066;
        display: flex;
        flex-direction: column;
        border-right: 4px solid #000000;
        z-index: 40;
        transition: transform .3s;
    }
    @media (max-width: 1023px) {
        #sidebar { transform: translateX(-100%); }
        #sidebar.open { transform: translateX(0); }
    }

    /* Label judul seksi menu (Main Menu, Site, Akun) */
    .sidebar-section-label {
        color: rgba(255, 210, 0, 0.35); 
        font-size: 0.58rem; 
        font-weight: 900; 
        letter-spacing: 0.18em; 
        text-transform: uppercase; 
        padding: 0 0.75rem; 
        margin-bottom: 0.65rem;
        margin-top: 0;
    }

    /* Gaya dasar link menu */
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.75rem 0.85rem;
        font-size: 0.7rem;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.5);
        border: 2px solid transparent;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
        border-radius: 4px;
    }

    /* Ukuran Ikon SVG ala Tailwind Heroicons */
    .sidebar-icon {
        width: 1.15rem;
        height: 1.15rem;
        flex-shrink: 0;
        transition: transform 0.2s ease-in-out;
    }

    /* Efek Hover (Kursor di atas menu) */
    .sidebar-link:hover {
        color: #FFD200;
        background: rgba(255, 210, 0, 0.06);
        border-color: rgba(255, 210, 0, 0.2);
    }

    /* Animasi ikon sedikit bergeser ke kanan saat di-hover */
    .sidebar-link:hover .sidebar-icon {
        transform: translateX(2px);
    }

    /* Menu Aktif / Terpilih */
    .sidebar-link.active {
        color: #FFD200;
        background: rgba(255, 210, 0, 0.12);
        border-color: #FFD200;
    }

    /* Khusus Tombol Keluar / Logout */
    .button-logout {
        color: rgba(248, 113, 113, 0.7);
    }
    .button-logout:hover {
        color: #f87171 !important;
        background: rgba(248, 113, 113, 0.1) !important;
        border-color: rgba(248, 113, 113, 0.3) !important;
    }
</style>

    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen flex antialiased" style="font-family:'Space Grotesk',sans-serif;">

    {{-- ── SIDEBAR ──────────────────────────────────────────────────── --}}
   {{-- ── PREMIUM MODERN SIDEBAR START ────────────────────────────────────────────────── --}}
<aside id="sidebar" style="
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    width: 16rem;
    background: #300066;
    display: flex;
    flex-direction: column;
    border-right: 4px solid #000000;
    font-family: 'Space Grotesk', sans-serif;
    z-index: 40;
">

    {{-- 1. HEADER LOGO (Dibuat lebih tebal & kontras) --}}
    <div style="padding: 1.5rem 1.25rem; border-bottom: 4px solid #000000; flex-shrink: 0; background-color: rgba(0,0,0,0.05);">
        <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; gap: 0.85rem; text-decoration: none;">
            <div style="width: 2.75rem; height: 2.75rem; background-color: #FFD200; border: 4px solid #000000; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 2px 2px 0px #000000;">
                <img src="images/hikeandpeak.png" style="width: 38px; height: 38px; object-fit: contain;" alt="Logo">
            </div>
            <div>
                <p style="font-family:'Unbounded',sans-serif; color: #ffffff; font-weight: 900; font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase; margin: 0; line-height: 1.2;">
                   HNP Communications
                </p>
                <p style="color: rgba(255, 210, 0, 0.65); font-size: 0.58rem; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; margin: 0; margin-top: 0.25rem;">
                   Admin Panel
                </p>
            </div>
        </a>
    </div>

    {{-- 2. NAVIGASI MENU (Memanjang ke bawah dengan scroll halus jika penuh) --}}
    <nav style="flex: 1 1 0%; padding: 1.75rem 0.85rem; overflow-y: auto; display: flex; flex-direction: column; gap: 1.75rem;">
        
        {{-- Kelompok: MAIN MENU --}}
        <div>
            <p class="sidebar-section-label">Main Menu</p>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.35rem;">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.articles.index') }}" class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Manajemen Artikel
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contacts.index') }}" class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Pesan Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.cms.page-sections.index') }}" class="sidebar-link {{ request()->routeIs('admin.cms.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        CMS Kontrol
                    </a>
                </li>
            </ul>
        </div>

        {{-- Kelompok: SITE --}}
        <div>
            <p class="sidebar-section-label">Site</p>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.35rem;">
                <li>
                    <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                        <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Lihat Website
                    </a>
                </li>
                <li>
                    <a href="{{ route('articles.index') }}" target="_blank" class="sidebar-link">
                        <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Halaman Blog
                    </a>
                </li>
            </ul>
        </div>

        {{-- Kelompok: AKUN --}}
        <div>
            <p class="sidebar-section-label">Akun</p>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="sidebar-link button-logout" style="width: 100%; text-align: left; background: transparent; cursor: pointer;">
                            <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </nav>

    {{-- 3. INFORMASI USER (Bagian Paling Bawah) --}}
    <div style="border-top: 4px solid #000000; padding: 1.25rem 1rem; flex-shrink: 0; background-color: rgba(0,0,0,0.15);">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 2.5rem; height: 2.5rem; background-color: #FFD200; border: 2px solid #000000; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 1.5px 1.5px 0px #000000;">
                <span style="font-weight: 900; color: #000000; font-size: 0.75rem; letter-spacing: 0.05em;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                </span>
            </div>
            <div style="min-width: 0; flex: 1 1 0%;">
                <p style="color: #ffffff; font-weight: 700; font-size: 0.75rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: 0.02em;">
                    {{ auth()->user()->name ?? 'Admin HNP' }}
                </p>
                <p style="color: rgba(255, 210, 0, 0.5); font-size: 0.62rem; font-weight: 500; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 0.1rem;">
                    {{ auth()->user()->email ?? 'admin@hnp.id' }}
                </p>
            </div>
        </div>
    </div>
</aside>
{{-- ── PREMIUM MODERN SIDEBAR END ──────────────────────────────────────────────────── --}}

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