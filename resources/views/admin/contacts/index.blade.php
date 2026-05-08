{{-- resources/views/admin/contacts/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Pesan — Admin KontenDigital</title>

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { 
            --ink: #0e0b14; 
            --yellow: #f5c518; 
            --purple: #2d1b4e; 
            --punch: #e8402a; 
            --teal: #00a896; 
            --sidebar: #1a0f2e; 
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            font-family: 'DM Sans', sans-serif; 
            background: #f0edf7; 
            display: flex; 
            min-height: 100vh; 
            overflow-x: hidden; 
        }

        /* --- SIDEBAR & OVERLAY --- */
        .sidebar { 
            width: 260px; background: var(--sidebar); border-right: 4px solid var(--ink); 
            display: flex; flex-direction: column; position: fixed; 
            top: 0; left: 0; height: 100vh; z-index: 100; 
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        
        .sidebar-overlay { 
            display: none; position: fixed; inset: 0; 
            background: rgba(14, 11, 20, 0.7); z-index: 90; backdrop-filter: blur(4px); 
        }

        .sidebar-overlay.active { display: block; }
        .sidebar.active { transform: translateX(0); }

        .sidebar-logo { padding: 1.5rem; border-bottom: 2px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 0.75rem; }
        .sidebar-logo-box { width: 40px; height: 40px; background: var(--yellow); border: 2px solid var(--ink); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sidebar-nav { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
        .nav-section-title { font-family: 'Anton', sans-serif; font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.25); padding: 0 1.5rem; margin: 1.25rem 0 0.5rem 0; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.5rem; color: rgba(255,255,255,0.55); font-weight: 700; font-size: 0.85rem; text-decoration: none; transition: all 0.2s; border-left: 4px solid transparent; position: relative; }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: white; }
        .nav-item.active { background: rgba(245,197,24,0.1); color: var(--yellow); border-left-color: var(--yellow); }
        .nav-badge { position: absolute; right: 1rem; background: var(--punch); color: white; font-family: 'Anton'; font-size: 0.6rem; padding: 2px 6px; border: 1.5px solid var(--ink); }

        /* --- MAIN CONTENT --- */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; width: 100%; transition: margin 0.3s; }
        .topbar { background: white; border-bottom: 4px solid var(--ink); padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 20; }
        .topbar-title { font-family: 'Anton', sans-serif; font-size: 1.4rem; color: var(--purple); }
        .menu-toggle { display: none; background: var(--yellow); border: 3px solid var(--ink); padding: 5px 8px; cursor: pointer; box-shadow: 3px 3px 0 var(--ink); }
        .content { padding: 2rem; flex: 1; }

        /* --- CONTACTS UI --- */
        .filter-tabs { display: flex; border: 4px solid var(--ink); margin-bottom: 1.5rem; background: white; box-shadow: 4px 4px 0 var(--ink); }
        .ftab { padding: 1rem; font-family: 'Anton', sans-serif; text-decoration: none; color: var(--ink); border-right: 3px solid var(--ink); flex: 1; text-align: center; font-size: 0.8rem; transition: 0.2s; }
        .ftab:last-child { border-right: none; }
        .ftab:hover, .ftab.active { background: var(--purple); color: var(--yellow); }

        .search-row { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .search-field { border: 3px solid var(--ink); padding: 0.75rem 1rem; font-family: 'DM Sans', sans-serif; font-weight: 700; flex: 1; outline: none; }
        .search-submit { font-family: 'Anton', sans-serif; padding: 0 2rem; border: 3px solid var(--ink); background: var(--ink); color: var(--yellow); cursor: pointer; }

        .table-container { background: white; border: 4px solid var(--ink); box-shadow: 8px 8px 0 var(--ink); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th { background: var(--purple); color: var(--yellow); font-family: 'Anton', sans-serif; padding: 1rem; text-align: left; border-right: 2px solid var(--ink); font-size: 0.75rem; }
        td { padding: 1.2rem 1rem; font-weight: 700; border-bottom: 3px solid var(--ink); border-right: 1px solid rgba(0,0,0,0.05); }

        .status-badge { border: 2px solid var(--ink); padding: 4px 10px; font-family: 'Anton'; font-size: 0.65rem; box-shadow: 2px 2px 0 var(--ink); text-transform: uppercase; }
        .btn-action { font-family: 'Anton', sans-serif; font-size: 0.7rem; padding: 0.5rem 0.8rem; border: 2px solid var(--ink); background: var(--yellow); box-shadow: 3px 3px 0 var(--ink); text-decoration: none; color: var(--ink); display: inline-block; transition: 0.1s; }
        .btn-action:active { transform: translate(2px, 2px); box-shadow: 0 0 0 var(--ink); }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .menu-toggle { display: block; }
            .topbar { padding: 1rem; }
            .content { padding: 1rem; }
        }

        @media (max-width: 640px) {
            .filter-tabs { display: grid; grid-template-columns: 1fr 1fr; }
            .ftab { border-bottom: 3px solid var(--ink); }
            .search-row { flex-direction: column; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="overlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-box">
                <span style="font-family:'Anton'; font-size:1.2rem; color:var(--purple);">K</span>
            </div>
            <div>
                <div class="sidebar-logo-text">KONTENDIGITAL</div>
                <div class="sidebar-logo-sub">Admin Panel</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <span>📊</span> Dashboard
            </a>
            <a href="{{ route('admin.articles.index') }}" class="nav-item">
                <span>📰</span> Manajemen Artikel
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="nav-item active">
                <span>💬</span> Pesan Masuk
                @if($counts['new'] > 0)
                    <span class="nav-badge">{{ $counts['new'] }}</span>
                @endif
            </a>

            <div class="nav-section-title">Site</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank"><span>🌐</span> Lihat Website</a>
            <a href="{{ route('articles.index') }}" class="nav-item" target="_blank">
            <span class="nav-icon">📖</span> Halaman Blog
        </a>
        </nav>

        <div class="sidebar-footer" style="padding:1.5rem; border-top:2px solid rgba(255,255,255,0.08);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%; background:transparent; border:2px solid rgba(255,255,255,0.15); color:white; font-family:'Anton'; font-size:0.75rem; padding:0.6rem; cursor:pointer;">⏻ LOGOUT</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <header class="topbar">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button class="menu-toggle" id="menuBtn">☰</button>
                <div>
                    <div class="topbar-title">MANAJEMEN PESAN</div>
                    <div style="font-size: 0.7rem; font-weight: 700; color: rgba(0,0,0,0.3); text-transform: uppercase;">ADMIN / CONTACTS</div>
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
                                <div style="font-size: 0.7rem; opacity: 0.5;">{{ $contact->email }}</div>
                            </td>
                            <td>
                                <span style="background: var(--cream); border: 1px solid var(--ink); padding: 2px 6px; font-size: 0.75rem;">
                                    {{ $contact->service }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge" style="background: {{ $contact->status == 'new' ? '#ff8a80' : '#b9f6ca' }};">
                                    {{ $contact->status }}
                                </span>
                            </td>
                            <td style="font-size: 0.8rem;">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-action">DETAIL</a>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action" style="background: var(--punch); color: white;">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 4rem;">
                                <div style="font-size: 3rem;">📥</div>
                                <div style="font-family: 'Anton'; opacity: 0.2; letter-spacing: 2px;">TIDAK ADA PESAN MASUK</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($submissions, 'links'))
            <div style="margin-top: 1.5rem;">
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