{{-- resources/views/admin/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard — KontenDigital</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --ink:#0e0b14; --yellow:#f5c518; --purple:#2d1b4e; --punch:#e8402a; --cream:#f7f2e8; --teal:#00a896; --sidebar:#1a0f2e; }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'DM Sans',sans-serif; background:#f0edf7; display:flex; min-height:100vh; }

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
            z-index: 30;
            overflow-y: auto;
        }
        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 2px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar-logo-box {
            width: 40px; height: 40px;
            background: var(--yellow);
            border: 2px solid var(--ink);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sidebar-logo-text { font-family:'Anton',sans-serif; font-size:0.9rem; color:white; letter-spacing:0.02em; }
        .sidebar-logo-sub { font-size:0.55rem; color:var(--punch); letter-spacing:0.15em; text-transform:uppercase; }

        .sidebar-nav { flex: 1; padding: 1.5rem 0; }
        .nav-section-title {
            font-family:'Anton',sans-serif;
            font-size:0.6rem;
            letter-spacing:0.2em;
            text-transform:uppercase;
            color:rgba(255,255,255,0.25);
            padding: 0 1.5rem;
            margin-bottom: 0.5rem;
            margin-top: 1.25rem;
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
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
        }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: white; }
        .nav-item.active { background: rgba(245,197,24,0.1); color: var(--yellow); border-left-color: var(--yellow); }
        .nav-icon { font-size: 1rem; width: 20px; text-align: center; }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 2px solid rgba(255,255,255,0.08);
        }
        .user-info { display:flex; align-items:center; gap:0.75rem; margin-bottom:1rem; }
        .user-avatar {
            width: 36px; height: 36px;
            background: var(--punch);
            border-radius: 50%;
            border: 2px solid var(--ink);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Anton', sans-serif;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        .user-name { font-weight: 700; font-size: 0.85rem; color: white; }
        .user-role { font-size: 0.65rem; color: var(--yellow); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700; }
        .logout-btn {
            width: 100%;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.5);
            font-family: 'Anton', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            padding: 0.6rem;
            cursor: pointer;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }
        .logout-btn:hover { background: var(--punch); color: white; border-color: var(--punch); }

        /* ── MAIN ── */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        .topbar {
            background: white;
            border-bottom: 3px solid var(--ink);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .topbar-title { font-family:'Anton',sans-serif; font-size:1.4rem; color:var(--purple); letter-spacing:0.02em; }
        .topbar-breadcrumb { font-size:0.75rem; font-weight:600; color:rgba(14,11,20,0.4); margin-top:0.1rem; }

        .content { padding: 2rem; flex: 1; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        @media(max-width:900px){ .stats-grid { grid-template-columns: repeat(2,1fr); } }
        @media(max-width:500px){ .stats-grid { grid-template-columns: 1fr; } }

        .stat-card {
            background: white;
            border: 3px solid var(--ink);
            box-shadow: 5px 5px 0 var(--ink);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .stat-icon { font-size: 1.75rem; }
        .stat-num { font-family: 'Anton', sans-serif; font-size: 2.5rem; color: var(--purple); line-height: 1; }
        .stat-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(14,11,20,0.45); }
        .stat-card.yellow { background: var(--yellow); }
        .stat-card.purple { background: var(--purple); }
        .stat-card.purple .stat-num, .stat-card.purple .stat-label { color: white; }
        .stat-card.purple .stat-label { opacity: 0.6; }
        .stat-card.punch  { background: var(--punch); }
        .stat-card.punch  .stat-num, .stat-card.punch .stat-label { color: white; }
        .stat-card.punch  .stat-label { opacity: 0.65; }

        /* ── TABLE ── */
        .table-section {
            background: white;
            border: 3px solid var(--ink);
            box-shadow: 5px 5px 0 var(--ink);
        }
        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 2px solid var(--ink);
        }
        .table-header-title { font-family:'Anton',sans-serif; font-size:1.1rem; color:var(--purple); }
        .table-header-link {
            font-family:'Anton',sans-serif;
            font-size:0.75rem;
            letter-spacing:0.1em;
            color:var(--purple);
            text-decoration:none;
            border:2px solid var(--ink);
            padding:0.4rem 1rem;
            background:var(--yellow);
            box-shadow:3px 3px 0 var(--ink);
            transition:transform 0.15s,box-shadow 0.15s;
        }
        .table-header-link:hover { transform:translate(2px,2px); box-shadow:1px 1px 0 var(--ink); }

        table { width: 100%; border-collapse: collapse; }
        th {
            background: var(--purple);
            color: var(--yellow);
            font-family: 'Anton', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.75rem 1rem;
            text-align: left;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        th:last-child { border-right: none; }
        td {
            padding: 0.9rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-bottom: 1px solid rgba(14,11,20,0.07);
            color: var(--ink);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(245,197,24,0.05); }

        .status-badge {
            display: inline-block;
            font-family: 'Anton', sans-serif;
            font-size: 0.6rem;
            letter-spacing: 0.12em;
            padding: 0.25rem 0.65rem;
            text-transform: uppercase;
        }
        .badge-draft     { background: rgba(245,197,24,0.2); color: #7c6200; border: 1px solid var(--yellow); }
        .badge-published { background: rgba(0,168,150,0.15); color: #004d47; border: 1px solid var(--teal); }
        .badge-rejected  { background: rgba(232,64,42,0.15);  color: var(--punch); border: 1px solid var(--punch); }

        .action-link {
            font-family: 'Anton', sans-serif;
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            padding: 0.3rem 0.75rem;
            text-decoration: none;
            border: 2px solid var(--ink);
            display: inline-block;
            margin-right: 4px;
            transition: transform 0.1s;
        }
        .action-link:hover { transform: translate(1px,1px); }
        .link-publish { background: var(--teal); color: white; }
        .link-edit    { background: var(--yellow); color: var(--purple); }
        .link-reject  { background: var(--punch); color: white; }

        .alert-success {
            background: rgba(0,168,150,0.12);
            border: 2px solid var(--teal);
            padding: 0.75rem 1.25rem;
            font-weight: 700;
            font-size: 0.85rem;
            color: #004d47;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-box">
            <span style="font-family:'Anton',sans-serif;font-size:1.1rem;color:var(--purple);">K</span>
        </div>
        <div>
            <div class="sidebar-logo-text">KONTENDIGITAL</div>
            <div class="sidebar-logo-sub">Admin Panel</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item active">
            <span class="nav-icon">📊</span> Dashboard
        </a>
        <a href="{{ route('admin.articles.index') }}" class="nav-item">
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
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">⏻ LOGOUT</button>
        </form>
    </div>
</aside>

{{-- ── MAIN ── --}}
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">DASHBOARD</div>
            <div class="topbar-breadcrumb">Admin / Overview</div>
        </div>
        <a href="{{ route('admin.articles.create') }}" style="font-family:'Anton',sans-serif;font-size:0.8rem;letter-spacing:0.1em;background:var(--punch);color:white;padding:0.6rem 1.25rem;border:2px solid var(--ink);text-decoration:none;box-shadow:3px 3px 0 var(--ink);">
            + ARTIKEL BARU
        </a>
    </div>

    <div class="content">
        @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        {{-- STATS --}}
        <div class="stats-grid">
            <div class="stat-card yellow">
                <div class="stat-icon">📰</div>
                <div class="stat-num">{{ $stats['total_articles'] }}</div>
                <div class="stat-label">Total Artikel</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-num" style="color:var(--teal);">{{ $stats['published_articles'] }}</div>
                <div class="stat-label">Dipublish</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon">⏳</div>
                <div class="stat-num">{{ $stats['draft_articles'] }}</div>
                <div class="stat-label">Menunggu Review</div>
            </div>
            <div class="stat-card punch">
                <div class="stat-icon">👥</div>
                <div class="stat-num">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total User</div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-section">
            <div class="table-header">
                <div class="table-header-title">ARTIKEL TERBARU</div>
                <a href="{{ route('admin.articles.index') }}" class="table-header-link">LIHAT SEMUA →</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestArticles as $article)
                    <tr>
                        <td style="max-width:220px;">
                            <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                               style="color:var(--purple);font-weight:700;text-decoration:none;">
                                {{ Str::limit($article->title, 45) }}
                            </a>
                        </td>
                        <td>{{ $article->user->name }}</td>
                        <td>{{ $article->category }}</td>
                        <td>
                            <span class="status-badge badge-{{ $article->status }}">{{ $article->status }}</span>
                        </td>
                        <td style="white-space:nowrap;">{{ $article->created_at->format('d M Y') }}</td>
                        <td style="white-space:nowrap;">
                            @if($article->status === 'draft')
                                <form action="{{ route('admin.articles.publish', $article) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="action-link link-publish">✓ PUBLISH</button>
                                </form>
                                <form action="{{ route('admin.articles.reject', $article) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="action-link link-reject">✗ TOLAK</button>
                                </form>
                            @endif
                            <a href="{{ route('admin.articles.edit', $article) }}" class="action-link link-edit">EDIT</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:3rem;color:rgba(14,11,20,0.4);font-weight:700;">
                            Belum ada artikel
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> f331462 (pembuatan admin form dll)
