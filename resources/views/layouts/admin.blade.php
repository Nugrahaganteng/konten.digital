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
        /* ══════════════════════════════════════════════
           BRUTALIST PREMIUM PANEL — FULL RESPONSIVE
           Fix utama: overflow-x: clip (bukan hidden)
           agar child element bisa scroll horizontal
           ══════════════════════════════════════════════ */

        *, *::before, *::after { box-sizing: border-box; }

        html {
            overflow-x: clip;
            max-width: 100%;
            scroll-behavior: smooth;
        }

        body {
            overflow-x: clip;
            max-width: 100%;
            font-family: 'Space Grotesk', sans-serif;
            background: #f0edf7;
            min-height: 100vh;
        }

        /* ── SIDEBAR ──────────────────────────────── */
        #sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 15rem;
            background: #300066;
            display: flex;
            flex-direction: column;
            border-right: 4px solid #000;
            z-index: 40;
            transition: transform .3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
        }

        /* Sidebar nav scrollable */
        .sidebar-nav-scroll {
            flex: 1 1 0%;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1.5rem 0.8rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            /* Custom scrollbar */
            scrollbar-width: thin;
            scrollbar-color: rgba(255,210,0,0.3) transparent;
        }
        .sidebar-nav-scroll::-webkit-scrollbar { width: 3px; }
        .sidebar-nav-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav-scroll::-webkit-scrollbar-thumb { background: rgba(255,210,0,0.3); border-radius: 2px; }

        .sidebar-section-label {
            color: rgba(255, 210, 0, 0.35);
            font-size: 0.56rem;
            font-weight: 900;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 0 0.6rem;
            margin-bottom: 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.75rem;
            font-size: 0.68rem;
            font-weight: 900;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            border: 2px solid transparent;
            text-decoration: none;
            transition: all 0.18s ease;
            border-radius: 3px;
        }

        .sidebar-icon {
            width: 1.05rem;
            height: 1.05rem;
            flex-shrink: 0;
            transition: transform 0.18s ease;
        }

        .sidebar-link:hover {
            color: #FFD200;
            background: rgba(255, 210, 0, 0.07);
            border-color: rgba(255, 210, 0, 0.2);
        }
        .sidebar-link:hover .sidebar-icon { transform: translateX(2px); }
        .sidebar-link.active {
            color: #FFD200;
            background: rgba(255, 210, 0, 0.13);
            border-color: #FFD200;
        }

        .button-logout { color: rgba(248, 113, 113, 0.7); }
        .button-logout:hover {
            color: #f87171 !important;
            background: rgba(248, 113, 113, 0.1) !important;
            border-color: rgba(248, 113, 113, 0.3) !important;
        }

        /* ── MAIN WRAPPER ──────────────────────────── */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* KUNCI: clip tidak blokir scroll context child */
            overflow-x: clip;
            max-width: 100%;
        }

        @media (min-width: 1024px) {
            .main-wrapper { margin-left: 15rem; }
        }

        /* ── HEADER ─────────────────────────────────── */
        .admin-header {
            background: #fff;
            border-bottom: 4px solid #000;
            padding: 0.9rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 30;
            /* clip bukan hidden agar child bisa scroll */
            overflow: clip;
            max-width: 100%;
        }

        .admin-header-left { display: flex; align-items: center; gap: 0.85rem; min-width: 0; }

        .burger-btn {
            display: none;
            background: #FFD200;
            border: 2px solid #000;
            padding: 6px;
            box-shadow: 2px 2px 0 #000;
            cursor: pointer;
            flex-shrink: 0;
            min-width: 36px;
            min-height: 36px;
            align-items: center;
            justify-content: center;
        }
        @media (max-width: 1023px) {
            .burger-btn { display: flex; }
        }

        .breadcrumb-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.1rem;
            font-weight: 900;
            color: #300066;
            letter-spacing: 0.02em;
            line-height: 1.1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 45vw;
        }
        @media (max-width: 640px) {
            .breadcrumb-title { font-size: 0.9rem; max-width: 35vw; }
        }

        .breadcrumb-sub {
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 900;
            font-size: 9px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(0,0,0,0.3);
            margin-top: 2px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            flex-shrink: 0;
        }

        .header-website-link {
            font-weight: 900;
            font-size: 11px;
            color: rgba(0,0,0,0.55);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: color 0.15s;
            white-space: nowrap;
        }
        .header-website-link:hover { color: #000; }

        @media (max-width: 640px) {
            .header-website-link, #clock-wib { display: none; }
        }

        /* ── MAIN CONTENT AREA ─────────────────────── */
        /* KRITIS: overflow-x: clip bukan hidden */
        .admin-main {
            flex: 1;
            background: #f0edf7;
            overflow-x: clip;
            max-width: 100%;
        }

        /* ── FOOTER ──────────────────────────────────── */
        .admin-footer {
            border-top: 4px solid #000;
            padding: 10px 20px;
            background: #fff;
        }

        /* ── FLASH MESSAGES ──────────────────────────── */
        .flash-wrap {
            padding: 0 1.25rem;
            margin-top: 0.85rem;
        }
        .flash-box {
            border: 3px solid;
            font-weight: 700;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            box-shadow: 3px 3px 0 #000;
            margin-bottom: 0.5rem;
        }
        .flash-success { background: #dcfce7; border-color: #16a34a; color: #14532d; }
        .flash-error   { background: #fee2e2; border-color: #dc2626; color: #7f1d1d; }
        .flash-close {
            background: none; border: none; cursor: pointer;
            font-weight: 900; font-size: 14px; margin-left: 14px;
            color: inherit; opacity: 0.7; line-height: 1; flex-shrink: 0;
        }
        .flash-close:hover { opacity: 1; }

        /* ── SMOOTH SCROLL untuk main content ─────────── */
        .admin-main {
            scroll-behavior: smooth;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex antialiased">

    {{-- Sidebar overlay (mobile) --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 z-30 hidden lg:hidden"
         style="background:rgba(0,0,0,0.55); backdrop-filter:blur(3px); -webkit-backdrop-filter:blur(3px);"></div>

    {{-- ── SIDEBAR ── --}}
    <aside id="sidebar">

        {{-- Logo --}}
        <div style="padding:1.25rem 1rem; border-bottom:4px solid #000; flex-shrink:0; background:rgba(0,0,0,0.06);">
            <a href="{{ route('admin.dashboard') }}" style="display:flex; align-items:center; gap:0.75rem; text-decoration:none;">
                <div style="width:2.5rem; height:2.5rem; background:#FFD200; border:3px solid #000; border-radius:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:2px 2px 0 #000;">
                    <img src="{{ asset('images/hikeandpeak.png') }}" style="width:28px; height:28px; object-fit:contain;" alt="Logo">
                </div>
                <div>
                    <p style="font-family:'Unbounded',sans-serif; color:#fff; font-weight:900; font-size:0.7rem; letter-spacing:0.07em; text-transform:uppercase; margin:0; line-height:1.2;">
                        HNP Communications
                    </p>
                    <p style="color:rgba(255,210,0,0.6); font-size:0.56rem; font-weight:700; letter-spacing:0.14em; text-transform:uppercase; margin:0; margin-top:0.2rem;">
                        Admin Panel
                    </p>
                </div>
            </a>
        </div>

        {{-- Navigasi --}}
        <nav class="sidebar-nav-scroll">

            <div>
                <p class="sidebar-section-label">Main Menu</p>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:0.3rem;">
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Pesan Masuk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cms.page-sections.index') }}" class="sidebar-link {{ request()->routeIs('admin.cms.*') ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            CMS Kontrol
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <p class="sidebar-section-label">Site</p>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:0.3rem;">
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

        </nav>

        {{-- User Info --}}
        <div style="border-top:4px solid #000; padding:1rem 0.9rem; flex-shrink:0; background:rgba(0,0,0,0.15);">
            <div style="display:flex; align-items:center; gap:0.65rem; margin-bottom:0.85rem;">
                <div style="width:2.25rem; height:2.25rem; background:#FFD200; border:2px solid #000; border-radius:6px; display:flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:1.5px 1.5px 0 #000;">
                    <span style="font-weight:900; color:#000; font-size:0.7rem; letter-spacing:0.04em;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                    </span>
                </div>
                <div style="min-width:0; flex:1 1 0%;">
                    <p style="color:#fff; font-weight:700; font-size:0.72rem; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        {{ auth()->user()->name ?? 'Admin HNP' }}
                    </p>
                    <p style="color:rgba(255,210,0,0.5); font-size:0.6rem; font-weight:500; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-top:1px;">
                        {{ auth()->user()->email ?? 'admin@hnp.id' }}
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="sidebar-link button-logout" style="width:100%; text-align:left; background:transparent; cursor:pointer; padding:0.48rem 0.7rem; border:none;">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ── MAIN WRAPPER ── --}}
    <div class="main-wrapper">

        {{-- TOP HEADER --}}
        <header class="admin-header">
            <div class="admin-header-left">
                <button id="sidebar-toggle" class="burger-btn" aria-label="Buka menu">
                    <svg style="width:18px; height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div style="min-width:0;">
                    <div class="breadcrumb-title">@yield('title', 'DASHBOARD')</div>
                    <div class="breadcrumb-sub">
                        <a href="{{ route('admin.dashboard') }}"
                           style="color:rgba(0,0,0,0.4); text-decoration:none; transition:color 0.15s;"
                           onmouseover="this.style.color='#300066'"
                           onmouseout="this.style.color='rgba(0,0,0,0.4)'">ADMIN</a>
                        <span>/</span>
                        <span style="color:rgba(0,0,0,0.8);">@yield('title', 'Dashboard')</span>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <a href="{{ route('home') }}" target="_blank" class="header-website-link">↗ LIHAT WEBSITE</a>
                <div id="clock-wib" style="font-weight:700; color:rgba(0,0,0,0.65); font-size:11px; letter-spacing:0.09em; white-space:nowrap;"></div>
            </div>
        </header>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
        <div class="flash-wrap">
            <div class="flash-box flash-success">
                <span>✓ {{ session('success') }}</span>
                <button class="flash-close" onclick="this.closest('.flash-wrap').remove()">✕</button>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="flash-wrap">
            <div class="flash-box flash-error">
                <span>✕ {{ session('error') }}</span>
                <button class="flash-close" onclick="this.closest('.flash-wrap').remove()">✕</button>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="flash-wrap">
            <div class="flash-box flash-error" style="flex-direction:column; align-items:flex-start; gap:6px;">
                <p style="font-weight:900; margin:0;">⚠ Terdapat {{ $errors->count() }} kesalahan:</p>
                <ul style="list-style:disc; padding-left:1.1rem; margin:0; font-weight:500; font-size:12px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- PAGE CONTENT --}}
        <main class="admin-main">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer class="admin-footer">
            <p style="font-size:9px; color:#6b7280; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; text-align:center; margin:0;">
                © {{ date('Y') }} HNP Communications.id — Admin Panel
            </p>
        </footer>
    </div>

    <script>
        /* ── Sidebar toggle ─────────────────────────── */
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle  = document.getElementById('sidebar-toggle');

        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        });
        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        });

        /* ── Jam WIB ─────────────────────────────────── */
        function updateClock() {
            const wib  = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
            const h    = String(wib.getHours()).padStart(2, '0');
            const m    = String(wib.getMinutes()).padStart(2, '0');
            const s    = String(wib.getSeconds()).padStart(2, '0');
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const el   = document.getElementById('clock-wib');
            if (el) el.textContent = days[wib.getDay()] + ', ' + h + ':' + m + ':' + s + ' WIB';
        }
        updateClock();
        setInterval(updateClock, 1000);

        /* ── Auto-dismiss flash (4 detik) ───────────── */
        setTimeout(() => {
            document.querySelectorAll('.flash-wrap').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);
    </script>

    @stack('scripts')
</body>
</html>