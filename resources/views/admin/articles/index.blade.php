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

        /* --- SIDEBAR & OVERLAY --- */
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
            z-index: 100; 
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        
        .sidebar-overlay { 
            display: none; 
            position: fixed; 
            inset: 0; 
            background: rgba(14, 11, 20, 0.7); 
            z-index: 90; 
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
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; width: 100%; transition: margin 0.3s ease; }
        
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
        .menu-toggle { display: none; background: var(--yellow); border: 2px solid var(--ink); padding: 8px; cursor: pointer; box-shadow: 3px 3px 0 var(--ink); margin-right: 15px; }

        .content { padding: 2rem; flex: 1; }

        /* --- BRUTALIST UI ELEMENTS --- */
        .filter-tabs { display: flex; border: 4px solid var(--ink); margin-bottom: 1.5rem; background: white; box-shadow: 4px 4px 0 var(--ink); }
        .ftab { 
            padding: 1rem; font-family: 'Anton', sans-serif; text-decoration: none; 
            color: var(--ink); border-right: 3px solid var(--ink); flex: 1; 
            text-align: center; font-size: 0.8rem; transition: 0.2s; 
        }
        .ftab:last-child { border-right: none; }
        .ftab:hover, .ftab.active { background: var(--purple); color: var(--yellow); }

        .search-row { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .search-field { 
            border: 3px solid var(--ink); padding: 0.75rem 1rem; 
            font-family: 'DM Sans', sans-serif; font-weight: 700; flex: 1; outline: none; 
        }
        .search-field:focus { box-shadow: 4px 4px 0 var(--purple); }
        .search-submit { 
            font-family: 'Anton', sans-serif; padding: 0 2rem; 
            border: 3px solid var(--ink); background: var(--ink); 
            color: var(--yellow); cursor: pointer; transition: 0.1s;
        }
        .search-submit:hover { background: var(--purple); }

        .table-container { 
            background: white; border: 4px solid var(--ink); 
            box-shadow: 8px 8px 0 var(--ink); overflow-x: auto; 
        }
        table { width: 100%; border-collapse: collapse; min-width: 850px; }
        th { 
            background: var(--purple); color: var(--yellow); font-family: 'Anton', sans-serif; 
            padding: 1rem; text-align: left; border-right: 2px solid var(--ink); font-size: 0.75rem; 
            letter-spacing: 0.05em;
        }
        td { padding: 1.2rem 1rem; font-weight: 700; border-bottom: 3px solid var(--ink); border-right: 1px solid rgba(14,11,20,0.1); color: var(--ink); font-size: 0.9rem; }

        .status-badge {
            display: inline-block;
            border: 2px solid var(--ink); 
            padding: 4px 10px; 
            font-family: 'Anton', sans-serif; 
            font-size: 0.65rem; 
            box-shadow: 2px 2px 0 var(--ink);
            text-transform: uppercase;
        }
        
        .btn-action { 
            font-family: 'Anton', sans-serif; font-size: 0.7rem; padding: 0.5rem 0.8rem; 
            border: 2px solid var(--ink); background: var(--yellow); 
            box-shadow: 3px 3px 0 var(--ink); text-decoration: none; color: var(--ink); 
            display: inline-block; transition: 0.1s; margin: 2px;
        }
        .btn-action:hover { transform: translate(2px, 2px); box-shadow: 1px 1px 0 var(--ink); }
        
        .btn-new { 
            font-family: 'Anton', sans-serif; background: var(--punch); color: white; 
            padding: 0.8rem 1.5rem; border: 3px solid var(--ink); 
            box-shadow: 4px 4px 0 var(--ink); text-decoration: none; transition: 0.15s;
            display: inline-block;
        }
        .btn-new:hover { transform: translate(2px, 2px); box-shadow: 2px 2px 0 var(--ink); }

        /* --- RESPONSIVE --- */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main { margin-left: 0; }
            .menu-toggle { display: block; }
            .topbar { padding: 1rem; }
        }

        @media (max-width: 640px) {
            .topbar-breadcrumb, .topbar-title { font-size: 1.1rem; }
            .topbar-breadcrumb { display: none; }
            .filter-tabs { display: grid; grid-template-columns: 1fr 1fr; }
            .ftab { border-bottom: 2px solid var(--ink); border-right: 3px solid var(--ink); }
            .ftab:nth-child(even) { border-right: none; }
            .search-row { flex-direction: column; }
            .search-submit { padding: 0.8rem; }
            .btn-new { font-size: 0.8rem; padding: 0.6rem 1rem; }
            .content { padding: 1rem; }
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

    <div class="main">
        <header class="topbar">
            <div style="display: flex; align-items: center;">
                <button class="menu-toggle" id="menuBtn">☰</button>
                <div>
                    <div class="topbar-title">DAFTAR ARTIKEL</div>
                    <div class="topbar-breadcrumb" style="font-size: 0.7rem; font-weight: 700; color: rgba(0,0,0,0.3); text-transform: uppercase;">ADMIN / MANAJEMEN ARTIKEL</div>
                </div>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="btn-new">+ ARTIKEL</a>
        </header>

        <main class="content">
            @if(session('success'))
                <div style="background: var(--teal); color: white; padding: 1rem; border: 3px solid var(--ink); box-shadow: 4px 4px 0 var(--ink); margin-bottom: 1.5rem; font-weight: 700;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="filter-tabs">
                <a href="{{ route('admin.articles.index') }}" class="ftab {{ !request('status') ? 'active' : '' }}">SEMUA</a>
                <a href="{{ route('admin.articles.index', ['status'=>'published']) }}" class="ftab {{ request('status')==='published' ? 'active' : '' }}">PUBLISHED</a>
                <a href="{{ route('admin.articles.index', ['status'=>'draft']) }}" class="ftab {{ request('status')==='draft' ? 'active' : '' }}">DRAFT</a>
            </div>

            <form action="{{ route('admin.articles.index') }}" method="GET" class="search-row">
                <input type="text" name="search" class="search-field" placeholder="Cari judul artikel..." value="{{ request('search') }}">
                <button type="submit" class="search-submit">CARI</button>
            </form>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Judul Artikel</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Buat</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td style="color: var(--purple); max-width: 300px;">
                                <div style="font-weight: 800;">{{ Str::limit($article->title, 60) }}</div>
                                <div style="font-size: 0.7rem; color: rgba(0,0,0,0.4); margin-top: 4px;">Oleh: {{ $article->user->name }}</div>
                            </td>
                            <td><span style="background: var(--cream); padding: 4px 8px; border: 1px solid var(--ink);">{{ $article->category }}</span></td>
                            <td>
                                @php
                                    $statusColor = $article->status === 'published' ? '#e0f2f1' : '#fff3e0';
                                    $textColor = $article->status === 'published' ? '#00796b' : '#ef6c00';
                                @endphp
                                <span class="status-badge" style="background: {{ $statusColor }}; color: {{ $textColor }};">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td style="font-size: 0.8rem;">{{ $article->created_at->format('d/m/Y') }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn-action">EDIT</a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus artikel ini selamanya?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action" style="background: var(--punch); color: white;">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 4rem; color: rgba(0,0,0,0.2);">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📂</div>
                                <div style="font-family: 'Anton'; letter-spacing: 0.1em;">TIDAK ADA DATA ARTIKEL</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 2rem; display: flex; justify-content: center;">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        </main>
    </div>

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