{{-- resources/views/admin/articles/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Artikel — Admin KontenDigital</title>

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { 
            --ink: #0e0b14; 
            --yellow: #f5c518; 
            --purple: #2d1b4e; 
            --punch: #e8402a; 
            --cream: #f7f2e8; 
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

        /* --- SIDEBAR --- */
        .sidebar { 
            width: 260px; 
            background: var(--sidebar); 
            border-right: 4px solid var(--ink); 
            display: flex; 
            flex-direction: column; 
            position: fixed; 
            top: 0; 
            left: 0; 
            height: 100vh; 
            z-index: 50; 
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        
        .sidebar-overlay { 
            display: none; 
            position: fixed; 
            inset: 0; 
            background: rgba(14, 11, 20, 0.5); 
            z-index: 40; 
            backdrop-filter: blur(4px); 
        }

        .sidebar-overlay.active { display: block; }

        .sidebar-logo { 
            padding: 1.5rem; 
            border-bottom: 2px solid rgba(255,255,255,0.08); 
            display: flex; 
            align-items: center; 
            gap: 0.75rem; 
        }

        .sidebar-logo-box { 
            width: 40px; 
            height: 40px; 
            background: var(--yellow); 
            border: 2px solid var(--ink); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0; 
        }

        .sidebar-logo-text { font-family: 'Anton', sans-serif; font-size: 0.9rem; color: white; }
        .sidebar-logo-sub { font-size: 0.55rem; color: var(--punch); letter-spacing: 0.15em; text-transform: uppercase; }

        .sidebar-nav { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
        .nav-section-title { 
            font-family: 'Anton', sans-serif; 
            font-size: 0.6rem; 
            letter-spacing: 0.2em; 
            text-transform: uppercase; 
            color: rgba(255,255,255,0.25); 
            padding: 0 1.5rem; 
            margin: 1.25rem 0 0.5rem 0; 
        }

        .nav-item { 
            display: flex; 
            align-items: center; 
            gap: 0.75rem; 
            padding: 0.75rem 1.5rem; 
            color: rgba(255,255,255,0.55); 
            font-weight: 700; 
            font-size: 0.85rem; 
            text-decoration: none; 
            transition: all 0.2s; 
            border-left: 4px solid transparent; 
        }

        .nav-item:hover { background: rgba(255,255,255,0.06); color: white; }
        .nav-item.active { background: rgba(245,197,24,0.1); color: var(--yellow); border-left-color: var(--yellow); }

        .sidebar-footer { padding: 1.5rem; border-top: 2px solid rgba(255,255,255,0.08); }
        .user-avatar { 
            width: 36px; height: 36px; background: var(--punch); border-radius: 50%; 
            border: 2px solid var(--ink); display: flex; align-items: center; 
            justify-content: center; font-family: 'Anton', sans-serif; color: white; 
        }

        .logout-btn { 
            width: 100%; background: transparent; border: 2px solid rgba(255,255,255,0.15); 
            color: rgba(255,255,255,0.5); font-family: 'Anton', sans-serif; 
            font-size: 0.75rem; padding: 0.6rem; cursor: pointer; transition: all 0.2s; 
        }
        .logout-btn:hover { background: var(--punch); color: white; border-color: var(--ink); }

        /* --- MAIN CONTENT --- */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; width: 100%; transition: margin 0.3s; }
        
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

        .topbar-title { font-family: 'Anton', sans-serif; font-size: 1.4rem; color: var(--purple); }
        .menu-toggle { display: none; background: white; border: 3px solid var(--ink); padding: 5px 8px; cursor: pointer; box-shadow: 3px 3px 0 var(--ink); }

        .content { padding: 1.5rem; flex: 1; }

        /* --- BRUTALIST UI ELEMENTS --- */
        .filter-tabs { display: flex; border: 4px solid var(--ink); margin-bottom: 1.5rem; background: white; box-shadow: 4px 4px 0 var(--ink); }
        .ftab { 
            padding: 1rem; font-family: 'Anton', sans-serif; text-decoration: none; 
            color: var(--ink); border-right: 2px solid var(--ink); flex: 1; 
            text-align: center; font-size: 0.8rem; transition: background 0.2s; 
        }
        .ftab:last-child { border-right: none; }
        .ftab:hover, .ftab.active { background: var(--purple); color: var(--yellow); }

        .search-row { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .search-field { 
            border: 3px solid var(--ink); padding: 0.65rem 1rem; 
            font-family: 'DM Sans', sans-serif; font-weight: 700; flex: 1; outline: none; 
        }
        .search-field:focus { box-shadow: 4px 4px 0 var(--yellow); }
        .search-submit { 
            font-family: 'Anton', sans-serif; padding: 0 1.5rem; 
            border: 3px solid var(--ink); background: var(--ink); 
            color: var(--yellow); cursor: pointer; 
        }

        .table-container { 
            background: white; border: 4px solid var(--ink); 
            box-shadow: 8px 8px 0 var(--ink); overflow-x: auto; 
        }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th { 
            background: var(--purple); color: var(--yellow); font-family: 'Anton', sans-serif; 
            padding: 1rem; text-align: left; border-right: 2px solid var(--ink); font-size: 0.75rem; 
        }
        td { padding: 1rem; font-weight: 700; border-bottom: 2px solid var(--ink); border-right: 2px solid rgba(14,11,20,0.05); }

        .btn-action { 
            font-family: 'Anton', sans-serif; font-size: 0.65rem; padding: 0.4rem 0.75rem; 
            border: 2px solid var(--ink); background: var(--yellow); 
            box-shadow: 2px 2px 0 var(--ink); text-decoration: none; color: var(--ink); 
            display: inline-block; transition: 0.1s;
        }
        .btn-action:active { transform: translate(2px, 2px); box-shadow: 0 0 0 var(--ink); }
        
        .btn-new { 
            font-family: 'Anton', sans-serif; background: var(--punch); color: white; 
            padding: 0.7rem 1.2rem; border: 3px solid var(--ink); 
            box-shadow: 4px 4px 0 var(--ink); text-decoration: none; 
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main { margin-left: 0; }
            .menu-toggle { display: block; }
            .topbar { padding: 1rem; }
        }

        @media (max-width: 640px) {
            .filter-tabs { display: grid; grid-template-columns: 1fr 1fr; }
            .search-row { flex-direction: column; }
        }
    </style>
</head>
<body>

    <!-- Overlay untuk mobile -->
    <div class="sidebar-overlay" id="overlay"></div>

    <!-- Sidebar -->
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
                <span class="nav-icon">📊</span> Dashboard
            </a>
            <a href="{{ route('admin.articles.index') }}" class="nav-item active">
                <span class="nav-icon">📰</span> Manajemen Artikel
            </a>

            <div class="nav-section-title">Site</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank">
                <span class="nav-icon">🌐</span> Lihat Website
            </a>
             <a href="{{ route('articles.index') }}" class="nav-item" target="_blank">
            <span class="nav-icon">📖</span> Halaman Blog
        </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-name" style="color: white; font-weight: 700; font-size: 0.85rem;">{{ auth()->user()->name }}</div>
                    <div class="user-role" style="color: var(--yellow); font-size: 0.6rem; text-transform: uppercase;">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">⏻ LOGOUT</button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="main">
        <header class="topbar">
            <div class="topbar-left" style="display: flex; align-items: center; gap: 1rem;">
                <button class="menu-toggle" id="menuBtn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <div>
                    <div class="topbar-title">MANAJEMEN ARTIKEL</div>
                    <div class="topbar-breadcrumb" style="font-size: 0.7rem; font-weight: 700; color: rgba(0,0,0,0.3);">ADMIN / ARTIKEL</div>
                </div>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="btn-new">+ ARTIKEL BARU</a>
        </header>

        <main class="content">
            <!-- Filter Status -->
            <div class="filter-tabs">
                <a href="{{ route('admin.articles.index') }}" class="ftab {{ !request('status') ? 'active' : '' }}">SEMUA</a>
                <a href="{{ route('admin.articles.index', ['status'=>'published']) }}" class="ftab {{ request('status')==='published' ? 'active' : '' }}">PUBLISHED</a>
                <a href="{{ route('admin.articles.index', ['status'=>'draft']) }}" class="ftab {{ request('status')==='draft' ? 'active' : '' }}">DRAFT</a>
            </div>

            <!-- Form Pencarian -->
            <form action="{{ route('admin.articles.index') }}" method="GET" class="search-row">
                <input type="text" name="search" class="search-field" placeholder="Cari judul artikel..." value="{{ request('search') }}">
                <button type="submit" class="search-submit">CARI</button>
            </form>

            <!-- Tabel Data -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td style="color: var(--purple);">{{ Str::limit($article->title, 45) }}</td>
                            <td>{{ $article->user->name }}</td>
                            <td><span style="font-size: 0.8rem;">{{ $article->category }}</span></td>
                            <td>
                                <span style="background: #e0f2f1; color: #00796b; border: 2px solid var(--ink); padding: 4px 10px; font-family: 'Anton'; font-size: 0.65rem; box-shadow: 2px 2px 0 var(--ink);">
                                    {{ strtoupper($article->status) }}
                                </span>
                            </td>
                            <td style="font-size: 0.8rem;">{{ $article->created_at->format('d M Y') }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn-action">EDIT</a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action" style="background: var(--punch); color: white;">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: rgba(0,0,0,0.2);">
                                <div style="font-size: 2rem;">📭</div>
                                <div style="font-family: 'Anton';">BELUM ADA ARTIKEL</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination (Jika ada) -->
            <div style="margin-top: 1.5rem;">
                {{ $articles->links() }}
            </div>
        </main>
    </div>

    <!-- Script Sidebar Mobile -->
    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        menuBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>

</body>
</html>