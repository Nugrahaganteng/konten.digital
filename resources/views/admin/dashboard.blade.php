{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard — KontenDigital</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    {{-- Pastikan Vite sudah terkonfigurasi atau ganti dengan link CSS manual jika diperlukan --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { 
            --ink:#0e0b14; 
            --yellow:#f5c518; 
            --purple:#2d1b4e; 
            --punch:#e8402a; 
            --cream:#f7f2e8; 
            --teal:#00a896; 
            --sidebar:#1a0f2e; 
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            font-family: 'DM Sans', sans-serif; 
            background: #f0edf7; 
            color: var(--ink);
            display: flex; 
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px;
            background: var(--sidebar);
            border-right: 4px solid var(--ink);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 50;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 2px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; gap: 0.75rem;
        }

        .sidebar-logo-box {
            width: 40px; height: 40px; background: var(--yellow);
            border: 2px solid var(--ink); display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-nav { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
        
        .nav-section-title {
            font-family: 'Anton', sans-serif; font-size: 0.65rem; letter-spacing: 0.2em;
            text-transform: uppercase; color: rgba(255,255,255,0.3);
            padding: 0 1.5rem; margin: 1.25rem 0 0.5rem;
        }

        .nav-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.8rem 1.5rem; color: rgba(255,255,255,0.6);
            font-weight: 700; font-size: 0.85rem; text-decoration: none;
            border-left: 4px solid transparent; transition: 0.2s;
        }

        .nav-item:hover, .nav-item.active { background: rgba(255,255,255,0.08); color: white; }
        .nav-item.active { border-left-color: var(--yellow); color: var(--yellow); background: rgba(245,197,24,0.1); }

        .sidebar-footer { padding: 1.25rem; border-top: 2px solid rgba(255,255,255,0.1); }
        
        .user-info { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; color: white; }
        .user-avatar { 
            width: 35px; height: 35px; background: var(--punch); border-radius: 50%; 
            border: 2px solid var(--ink); display: flex; align-items: center; justify-content: center;
            font-family: 'Anton', sans-serif; font-size: 0.8rem;
        }

        .logout-btn {
            width: 100%; background: transparent; border: 2px solid rgba(255,255,255,0.2);
            color: white; font-family: 'Anton', sans-serif; padding: 0.6rem; cursor: pointer; transition: 0.2s;
            font-size: 0.75rem; letter-spacing: 1px;
        }
        .logout-btn:hover { background: var(--punch); border-color: var(--ink); box-shadow: 3px 3px 0 var(--ink); color: white; }

        /* ── MAIN CONTENT ── */
        .main { 
            margin-left: 260px; 
            flex: 1; 
            width: 100%;
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white; border-bottom: 4px solid var(--ink);
            padding: 1rem 1.5rem; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 40;
        }

        .content { padding: 1.5rem; max-width: 1400px; width: 100%; margin: 0 auto; }

        /* ── STATS (Responsive Auto-Grid) ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white; border: 3px solid var(--ink);
            box-shadow: 5px 5px 0 var(--ink); padding: 1.5rem;
            display: flex; flex-direction: column; gap: 0.5rem;
        }
        .stat-num { font-family: 'Anton', sans-serif; font-size: 2.5rem; line-height: 1; color: var(--purple); }
        .stat-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.5; }

        /* Modifiers */
        .yellow { background: var(--yellow); }
        .purple { background: var(--purple); color: white; }
        .purple .stat-num { color: white; }
        .punch { background: var(--punch); color: white; }
        .punch .stat-num { color: white; }

        /* ── TABLE SECTION ── */
        .table-section {
            background: white; border: 3px solid var(--ink);
            box-shadow: 5px 5px 0 var(--ink); margin-bottom: 2rem;
        }

        .table-header {
            padding: 1.25rem; border-bottom: 3px solid var(--ink);
            display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;
        }

        .table-responsive { width: 100%; overflow-x: auto; }
        
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th { 
            background: var(--purple); color: var(--yellow); font-family: 'Anton', sans-serif;
            text-align: left; padding: 1rem; font-size: 0.75rem; letter-spacing: 1px;
        }
        td { padding: 1rem; border-bottom: 1px solid rgba(0,0,0,0.1); font-weight: 600; font-size: 0.9rem; }
        tr:hover td { background: rgba(245,197,24,0.05); }

        /* ── BADGES & BUTTONS ── */
        .status-badge {
            font-family: 'Anton', sans-serif; font-size: 0.6rem; padding: 0.3rem 0.6rem;
            border: 2px solid var(--ink); text-transform: uppercase; display: inline-block;
        }
        .badge-published { background: var(--teal); color: white; }
        .badge-draft { background: var(--yellow); color: var(--ink); }

        .btn-neo {
            font-family: 'Anton', sans-serif; padding: 0.5rem 1rem;
            border: 2px solid var(--ink); text-decoration: none;
            display: inline-flex; align-items: center; justify-content: center;
            box-shadow: 3px 3px 0 var(--ink); transition: 0.1s; cursor: pointer; 
            font-size: 0.75rem; color: var(--ink);
        }
        .btn-neo:hover { transform: translate(-1px, -1px); box-shadow: 4px 4px 0 var(--ink); }
        .btn-neo:active { transform: translate(2px, 2px); box-shadow: 1px 1px 0 var(--ink); }

        /* ── MOBILE UI ── */
        .hamburger {
            display: none; background: var(--yellow); border: 2px solid var(--ink);
            padding: 0.5rem; cursor: pointer; box-shadow: 3px 3px 0 var(--ink);
            flex-direction: column; gap: 4px;
        }
        .hamburger span { width: 20px; height: 3px; background: var(--ink); display: block; }

        .sidebar-overlay {
            position: fixed; inset: 0; background: rgba(14,11,20,0.7);
            z-index: 45; opacity: 0; pointer-events: none; transition: 0.3s;
            backdrop-filter: blur(4px);
        }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); box-shadow: 10px 0 0 var(--ink); }
            .main { margin-left: 0; }
            .hamburger { display: flex; }
            .sidebar-overlay.show { opacity: 1; pointer-events: auto; }
        }

        @media (max-width: 640px) {
            .content { padding: 1rem; }
            .topbar { padding: 0.75rem 1rem; }
            .topbar-title { font-size: 1.1rem; }
            .btn-text-hide { display: none; } /* Sembunyikan teks panjang di HP */
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-box">
            <span style="font-family:'Anton'; font-size:1.2rem; color:var(--purple)">K</span>
        </div>
        <div>
            <div style="font-family:'Anton'; color:white; font-size:0.9rem; letter-spacing:1px;">KONTENDIGITAL</div>
            <div style="font-size:0.55rem; color:var(--punch); font-weight:bold; letter-spacing:2px;">ADMIN PANEL</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">Main Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item active">
            <span>📊</span> Dashboard
        </a>
        <a href="{{ route('admin.articles.index') }}" class="nav-item">
            <span>📰</span> Manajemen Artikel
        </a>
        
        <div class="nav-section-title">Site</div>
        <a href="{{ route('home') }}" class="nav-item" target="_blank">
            <span>🌐</span> Lihat Website
        </a>
          <a href="{{ route('articles.index') }}" class="nav-item" target="_blank">
            <span class="nav-icon">📖</span> Halaman Blog
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-size:0.85rem; font-weight:bold;">{{ auth()->user()->name }}</div>
                <div style="font-size:0.65rem; color:var(--yellow); text-transform:uppercase;">Administrator</div>
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
        <div style="display:flex; align-items:center; gap:1rem;">
            <button class="hamburger" id="menuBtn" aria-label="Toggle Menu">
                <span></span><span></span><span></span>
            </button>
            <div>
                <h1 class="topbar-title" style="font-family:'Anton'; letter-spacing:1px; line-height:1;">DASHBOARD</h1>
                <p style="font-size:0.65rem; font-weight:800; opacity:0.5; text-transform:uppercase; margin-top:3px;">Admin / Overview</p>
            </div>
        </div>
        
        <a href="{{ route('admin.articles.create') }}" class="btn-neo" style="background:var(--punch); color:white;">
            + <span class="btn-text-hide" style="margin-left:5px;">ARTIKEL BARU</span>
        </a>
    </header>

    <main class="content">
        @if(session('success'))
            <div style="background:var(--teal); color:white; padding:1rem; border:3px solid var(--ink); box-shadow:4px 4px 0 var(--ink); margin-bottom:1.5rem; font-weight:bold;">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- STATS GRID --}}
        <div class="stats-grid">
            <div class="stat-card yellow">
                <span class="stat-label">Total Artikel</span>
                <span class="stat-num">{{ $stats['total_articles'] }}</span>
                <span style="font-size:1.5rem;">📰</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Published</span>
                <span class="stat-num" style="color:var(--teal)">{{ $stats['published_articles'] }}</span>
                <span style="font-size:1.5rem;">✅</span>
            </div>
            <div class="stat-card purple">
                <span class="stat-label">Reviewing</span>
                <span class="stat-num">{{ $stats['draft_articles'] }}</span>
                <span style="font-size:1.5rem;">⏳</span>
            </div>
            <div class="stat-card punch">
                <span class="stat-label">Total Users</span>
                <span class="stat-num">{{ $stats['total_users'] }}</span>
                <span style="font-size:1.5rem;">👥</span>
            </div>
        </div>

        {{-- LATEST ARTICLES TABLE --}}
        <div class="table-section">
            <div class="table-header">
                <h2 style="font-family:'Anton'; font-size:1.1rem; letter-spacing:1px;">ARTIKEL TERBARU</h2>
                <a href="{{ route('admin.articles.index') }}" class="btn-neo" style="background:var(--yellow)">LIHAT SEMUA →</a>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>JUDUL</th>
                            <th>PENULIS</th>
                            <th>STATUS</th>
                            <th>TANGGAL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestArticles as $article)
                        <tr>
                            <td style="max-width:300px;">
                                <a href="{{ route('articles.show', $article->slug) }}" target="_blank" style="text-decoration:none; color:var(--purple); font-weight:bold;">
                                    {{ Str::limit($article->title, 50) }}
                                </a>
                            </td>
                            <td>{{ $article->user->name }}</td>
                            <td>
                                <span class="status-badge badge-{{ $article->status }}">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td style="white-space:nowrap;">{{ $article->created_at->format('d M Y') }}</td>
                            <td style="white-space:nowrap;">
                                <div style="display:flex; gap:5px;">
                                    @if($article->status === 'draft')
                                    <form action="{{ route('admin.articles.publish', $article) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn-neo" style="background:var(--teal); color:white; padding:0.3rem 0.6rem; font-size:0.6rem;">PUBLISH</button>
                                    </form>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn-neo" style="background:var(--yellow); padding:0.3rem 0.6rem; font-size:0.6rem;">EDIT</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:3rem; opacity:0.5;">Belum ada artikel terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    function toggleMenu() {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
        // Prevent scroll when menu is open
        document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
    }

    menuBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);

    // Close menu when clicking nav item (for mobile)
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', () => {
            if(window.innerWidth <= 1024) toggleMenu();
        });
    });

    // Handle Resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
</script>

</body>
</html>