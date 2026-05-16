{{-- resources/views/admin/contacts/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Pesan — Admin KontenDigital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&family=Space+Grotesk:wght@500;700;900&family=Unbounded:wght@900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { 
            --ink: #000000; 
            --yellow: #FFD200; 
            --purple: #300066; 
            --punch: #e8402a; 
            --cream: #f7f2e8; 
            --teal: #00a896; 
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            font-family: 'Space Grotesk', sans-serif; 
            background: #f0edf7; 
            display: flex; 
            min-height: 100vh; 
            overflow-x: hidden; 
        }

        /* --- SIDEBAR & OVERLAY (Premium & Panjang Kebawah) --- */
        #sidebar { 
            position: fixed; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            width: 16rem; 
            background: var(--purple); 
            display: flex; 
            flex-direction: column; 
            border-right: 4px solid var(--ink); 
            z-index: 100; 
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        
        .sidebar-overlay { 
            display: none; 
            position: fixed; 
            inset: 0; 
            background: rgba(0, 0, 0, 0.6); 
            z-index: 90; 
            backdrop-filter: blur(4px); 
        }

        .sidebar-overlay.active { display: block; }
        #sidebar.active { transform: translateX(0); }

        .sidebar-logo-container { 
            padding: 1.5rem 1.25rem; 
            border-bottom: 4px solid var(--ink); 
            flex-shrink: 0; 
            background-color: rgba(0,0,0,0.05); 
        }
        
        .sidebar-logo-link { 
            display: flex; 
            align-items: center; 
            gap: 0.85rem; 
            text-decoration: none; 
        }

        .sidebar-logo-box { 
            width: 2.75rem; 
            height: 2.75rem; 
            background-color: var(--yellow); 
            border: 4px solid var(--ink); 
            border-radius: 0.5rem; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0; 
            box-shadow: 2px 2px 0px var(--ink); 
        }

        .sidebar-logo-title { 
            font-family: 'Unbounded', sans-serif; 
            color: #ffffff; 
            font-weight: 900; 
            font-size: 0.75rem; 
            letter-spacing: 0.08em; 
            text-transform: uppercase; 
            margin: 0; 
            line-height: 1.2; 
        }
        
        .sidebar-logo-sub { 
            color: rgba(255, 210, 0, 0.65); 
            font-size: 0.58rem; 
            font-weight: 700; 
            letter-spacing: 0.15em; 
            text-transform: uppercase; 
            margin: 0; 
            margin-top: 0.25rem; 
        }

        .sidebar-nav { 
            flex: 1 1 0%; 
            padding: 1.75rem 0.85rem; 
            overflow-y: auto; 
            display: flex; 
            flex-direction: column; 
            gap: 1.75rem; 
        }
        
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
            position: relative;
        }

        .sidebar-icon { 
            width: 1.15rem; 
            height: 1.15rem; 
            flex-shrink: 0; 
            transition: transform 0.2s ease-in-out; 
        }
        
        .sidebar-link:hover { 
            color: var(--yellow); 
            background: rgba(255, 210, 0, 0.06); 
            border-color: rgba(255, 210, 0, 0.2); 
        }
        
        .sidebar-link:hover .sidebar-icon { 
            transform: translateX(2px); 
        }
        
        .sidebar-link.active { 
            color: var(--yellow); 
            background: rgba(255, 210, 0, 0.12); 
            border-color: var(--yellow); 
        }

        .nav-badge { 
            position: absolute; 
            right: 0.75rem; 
            background: var(--punch); 
            color: white; 
            font-family: 'Space Grotesk', sans-serif; 
            font-weight: 900;
            font-size: 0.6rem; 
            padding: 2px 6px; 
            border: 2px solid var(--ink); 
            box-shadow: 1.5px 1.5px 0 var(--ink);
        }

        .button-logout { 
            color: rgba(248, 113, 113, 0.7); 
        }
        
        .button-logout:hover { 
            color: #f87171 !important; 
            background: rgba(248, 113, 113, 0.1) !important; 
            border-color: rgba(248, 113, 113, 0.3) !important; 
        }

        .sidebar-footer { 
            border-top: 4px solid var(--ink); 
            padding: 1.25rem 1rem; 
            flex-shrink: 0; 
            background-color: rgba(0,0,0,0.15); 
        }
        
        .user-info { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0; }
        
        .user-avatar { 
            width: 2.5rem; 
            height: 2.5rem; 
            background-color: var(--yellow); 
            border: 2px solid var(--ink); 
            border-radius: 0.5rem; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0; 
            box-shadow: 1.5px 1.5px 0px var(--ink); 
            font-weight: 900; 
            color: var(--ink); 
            font-size: 0.75rem; 
            letter-spacing: 0.05em; 
        }
        
        .user-name { color: #ffffff; font-weight: 700; font-size: 0.75rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: 0.02em; }
        .user-role { color: rgba(255, 210, 0, 0.5); font-size: 0.62rem; font-weight: 500; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 0.1rem; }

        /* --- MAIN CONTENT --- */
        .main { margin-left: 16rem; flex: 1; display: flex; flex-direction: column; min-height: 100vh; width: 100%; transition: margin 0.3s ease; }
        
        .topbar { 
            background: white; 
            border-bottom: 4px solid var(--ink); 
            padding: 1rem 2rem; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            position: sticky; 
            top: 0; 
            z-index: 20; 
        }

        .topbar-title { font-family: 'Anton', sans-serif; font-size: 1.4rem; color: var(--purple); letter-spacing: 0.03em; }
        .menu-toggle { display: none; background: var(--yellow); border: 2px solid var(--ink); padding: 8px; cursor: pointer; box-shadow: 3px 3px 0 var(--ink); margin-right: 15px; font-weight: bold; }

        .content { padding: 2rem; flex: 1; }

        /* --- CONTACTS UI ELEMENTS --- */
        .filter-tabs { display: flex; border: 4px solid var(--ink); margin-bottom: 1.5rem; background: white; box-shadow: 4px 4px 0 var(--ink); }
        .ftab { 
            padding: 1rem; font-family: 'Space Grotesk', sans-serif; font-weight: 900; text-decoration: none; 
            color: var(--ink); border-right: 3px solid var(--ink); flex: 1; 
            text-align: center; font-size: 0.8rem; letter-spacing: 0.05em; transition: 0.2s; text-transform: uppercase;
        }
        .ftab:last-child { border-right: none; }
        .ftab:hover, .ftab.active { background: var(--purple); color: var(--yellow); }

        .search-row { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .search-field { 
            border: 3px solid var(--ink); padding: 0.75rem 1rem; 
            font-family: 'Space Grotesk', sans-serif; font-weight: 700; flex: 1; outline: none; 
        }
        .search-field:focus { box-shadow: 4px 4px 0 var(--purple); }
        .search-submit { 
            font-family: 'Space Grotesk', sans-serif; font-weight: 900; padding: 0 2rem; 
            border: 3px solid var(--ink); background: var(--ink); 
            color: var(--yellow); cursor: pointer; transition: 0.1s; text-transform: uppercase; letter-spacing: 0.05em;
        }
        .search-submit:hover { background: var(--purple); }

        .table-container { 
            background: white; border: 4px solid var(--ink); 
            box-shadow: 8px 8px 0 var(--ink); overflow-x: auto; 
        }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th { 
            background: var(--purple); color: var(--yellow); font-family: 'Space Grotesk', sans-serif; font-weight: 900;
            padding: 1rem; text-align: left; border-right: 2px solid var(--ink); font-size: 0.75rem; 
            letter-spacing: 0.08em; text-transform: uppercase;
        }
        td { padding: 1.2rem 1rem; font-weight: 700; border-bottom: 3px solid var(--ink); border-right: 1px solid rgba(0,0,0,0.05); color: var(--ink); font-size: 0.9rem; }

        .status-badge {
            display: inline-block;
            border: 2px solid var(--ink); 
            padding: 4px 10px; 
            font-family: 'Space Grotesk', sans-serif; font-weight: 900;
            font-size: 0.65rem; 
            box-shadow: 2px 2px 0 var(--ink);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .btn-action { 
            font-family: 'Space Grotesk', sans-serif; font-weight: 900; font-size: 0.7rem; padding: 0.5rem 0.8rem; 
            border: 2px solid var(--ink); background: var(--yellow); 
            box-shadow: 3px 3px 0 var(--ink); text-decoration: none; color: var(--ink); 
            display: inline-block; transition: 0.1s; margin: 2px; letter-spacing: 0.05em;
        }
        .btn-action:hover { transform: translate(2px, 2px); box-shadow: 1px 1px 0 var(--ink); }

        /* --- RESPONSIVE --- */
        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.active { transform: translateX(0); }
            .sidebar-overlay.active { display: block; }
            .main { margin-left: 0; }
            .menu-toggle { display: block; }
            .topbar { padding: 1rem; }
        }

        @media (max-width: 640px) {
            .filter-tabs { display: grid; grid-template-columns: 1fr 1fr; }
            .ftab { border-bottom: 2px solid var(--ink); }
            .search-row { flex-direction: column; }
            .search-submit { padding: 0.8rem; }
            .content { padding: 1rem; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="overlay"></div>

    {{-- ── PREMIUM MODERN SIDEBAR ── --}}
    <aside id="sidebar">
        <div class="sidebar-logo-container">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo-link">
                <div class="sidebar-logo-box">
                    <img src="{{ asset('images/hikeandpeak.png') }}" style="width: 30px; height: 30px; object-fit: contain;" alt="Logo">
                </div>
                <div>
                    <div class="sidebar-logo-title">HNP Communications</div>
                    <div class="sidebar-logo-sub">Admin Panel</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Pesan Masuk
                            @if(isset($counts['new']) && $counts['new'] > 0)
                                <span class="nav-badge">{{ $counts['new'] }}</span>
                            @endif
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
        </nav>

        <div class="sidebar-footer">
            <div class="user-info" style="margin-bottom: 1rem;">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
                <div style="min-width:0; flex:1 1 0%;">
                    <div class="user-name">{{ auth()->user()->name ?? 'Admin HNP' }}</div>
                    <div class="user-role">{{ auth()->user()->email ?? 'admin@hnp.id' }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="sidebar-link button-logout" style="width: 100%; text-align: left; background: transparent; cursor: pointer;">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ── MAIN AREA ── --}}
    <div class="main">
        <header class="topbar">
            <div style="display: flex; align-items: center;">
                <button class="menu-toggle" id="menuBtn">☰</button>
                <div>
                    <div class="topbar-title">MANAJEMEN PESAN</div>
                    <div class="topbar-breadcrumb" style="font-size: 0.7rem; font-weight: 700; color: rgba(0,0,0,0.3); text-transform: uppercase;">ADMIN / PESAN MASUK</div>
                </div>
            </div>
        </header>

        <main class="content">
            <div class="filter-tabs">
                <a href="{{ route('admin.contacts.index') }}" class="ftab {{ !request('status') ? 'active' : '' }}">
                    SEMUA <small>({{ $counts['all'] }})</small>
                </a>
                <a href="{{ route('admin.contacts.index', ['status'=>'new']) }}" class="ftab {{ request('status')==='new' ? 'active' : '' }}">
                    BARU <small>({{ $counts['new'] }})</small>
                </a>
                <a href="{{ route('admin.contacts.index', ['status'=>'resolved']) }}" class="ftab {{ request('status')==='resolved' ? 'active' : '' }}">
                    SELESAI <small>({{ $counts['resolved'] }})</small>
                </a>
            </div>

            <form action="{{ route('admin.contacts.index') }}" method="GET" class="search-row">
                <input type="text" name="search" class="search-field" placeholder="Cari nama, email, atau layanan..." value="{{ request('search') }}">
                <button type="submit" class="search-submit">CARI</button>
            </form>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $contact)
                        <tr>
                            <td>
                                <div style="color: var(--purple); font-weight: 800; text-transform: uppercase;">{{ $contact->name }}</div>
                                <div style="font-size: 0.7rem; opacity: 0.5; margin-top: 2px;">{{ $contact->email }}</div>
                            </td>
                            <td>
                                <span style="background: var(--cream); border: 1px solid var(--ink); padding: 4px 8px; font-size: 0.75rem;">
                                    {{ $contact->service }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColor = $contact->status === 'new' ? '#ff8a80' : '#b9f6ca';
                                    $textColor = $contact->status === 'new' ? '#b71c1c' : '#1b5e20';
                                @endphp
                                <span class="status-badge" style="background: {{ $statusColor }}; color: {{ $textColor }};">
                                    {{ $contact->status }}
                                </span>
                            </td>
                            <td style="font-size: 0.8rem;">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center; align-items: center;">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-action">DETAIL</a>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" style="margin:0;" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action" style="background: var(--punch); color: white;">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 4rem; color: rgba(0,0,0,0.2);">
                                <div style="display: flex; justify-content: center; margin-bottom: 1rem;">
                                    <svg style="width: 3.5rem; height: 3.5rem; color: rgba(0,0,0,0.15);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586 3.586a2 2 0 01-2.828 0L12 14M4 13a2 2 0 012-2h12a2 2 0 012 2m-18 0l3.586 3.586a2 2 0 012.828 0L16 14" />
                                    </svg>
                                </div>
                                <div style="font-family: 'Space Grotesk', sans-serif; font-weight: 900; letter-spacing: 0.1em;">TIDAK ADA PESAN MASUK</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($submissions, 'links'))
            <div style="margin-top: 2rem; display: flex; justify-content: center;">
                {{ $submissions->appends(request()->query())->links() }}
            </div>
            @endif
        </main>
    </div>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleMenu() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        menuBtn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
    </script>

</body>
</html>