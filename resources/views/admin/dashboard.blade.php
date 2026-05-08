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
        :root { 
            --ink:#0e0b14; --yellow:#f5c518; --purple:#2d1b4e; 
            --punch:#e8402a; --cream:#f7f2e8; --teal:#00a896; --sidebar:#1a0f2e; 
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #f0edf7; color: var(--ink); display: flex; min-height: 100vh; overflow-x: hidden; }

        /* SIDEBAR */
        .sidebar { width: 260px; background: var(--sidebar); border-right: 4px solid var(--ink); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 50; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-logo { padding: 1.5rem; border-bottom: 2px solid rgba(255,255,255,0.1); display: flex; align-items: center; gap: 0.75rem; }
        .sidebar-logo-box { width: 40px; height: 40px; background: var(--yellow); border: 2px solid var(--ink); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sidebar-nav { flex: 1; padding: 1.5rem 0; overflow-y: auto; }
        .nav-section-title { font-family: 'Anton', sans-serif; font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.3); padding: 0 1.5rem; margin: 1.25rem 0 0.5rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.8rem 1.5rem; color: rgba(255,255,255,0.6); font-weight: 700; font-size: 0.85rem; text-decoration: none; border-left: 4px solid transparent; transition: 0.2s; position: relative; }
        .nav-item:hover, .nav-item.active { background: rgba(255,255,255,0.08); color: white; }
        .nav-item.active { border-left-color: var(--yellow); color: var(--yellow); background: rgba(245,197,24,0.1); }
        .nav-badge { position: absolute; right: 1.25rem; top: 50%; transform: translateY(-50%); background: var(--punch); color: white; font-size: 0.6rem; font-family: 'Anton', sans-serif; padding: 2px 6px; border: 1.5px solid var(--ink); min-width: 20px; text-align: center; }
        
        /* MAIN CONTENT */
        .main { margin-left: 260px; flex: 1; width: 100%; transition: margin-left 0.3s ease; display: flex; flex-direction: column; }
        .topbar { background: white; border-bottom: 4px solid var(--ink); padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 40; }
        .content { padding: 1.5rem; max-width: 1400px; width: 100%; margin: 0 auto; }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
        .stat-card { background: white; border: 3px solid var(--ink); box-shadow: 5px 5px 0 var(--ink); padding: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .stat-num { font-family: 'Anton', sans-serif; font-size: 2.5rem; line-height: 1; color: var(--purple); }
        .stat-label { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.5; }
        .yellow { background: var(--yellow); }
        .purple { background: var(--purple); color: white; } .purple .stat-num { color: white; }
        .punch { background: var(--punch); color: white; } .punch .stat-num { color: white; }
        .teal-card { background: var(--teal); color: white; } .teal-card .stat-num { color: white; }

        /* TABLES */
        .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem; }
        .table-section { background: white; border: 3px solid var(--ink); box-shadow: 5px 5px 0 var(--ink); margin-bottom: 2rem; }
        .table-header { padding: 1.25rem; border-bottom: 3px solid var(--ink); display: flex; justify-content: space-between; align-items: center; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--purple); color: var(--yellow); font-family: 'Anton', sans-serif; text-align: left; padding: 1rem; font-size: 0.75rem; }
        td { padding: 0.85rem 1rem; border-bottom: 1px solid rgba(0,0,0,0.08); font-weight: 600; font-size: 0.87rem; }
        
        .status-badge { font-family: 'Anton', sans-serif; font-size: 0.6rem; padding: 0.3rem 0.6rem; border: 2px solid var(--ink); text-transform: uppercase; display: inline-block; }
        .badge-published { background: var(--teal); color: white; }
        .badge-draft { background: var(--yellow); color: var(--ink); }
        .badge-new { background: #3b82f6; color: white; }
        .badge-in_progress { background: #f59e0b; color: var(--ink); }
        .badge-resolved { background: var(--teal); color: white; }
        
        .btn-neo { font-family: 'Anton', sans-serif; padding: 0.5rem 1rem; border: 2px solid var(--ink); text-decoration: none; display: inline-flex; align-items: center; justify-content: center; box-shadow: 3px 3px 0 var(--ink); transition: 0.1s; cursor: pointer; font-size: 0.75rem; color: var(--ink); background: white; }
        .btn-neo:hover { transform: translate(-1px, -1px); box-shadow: 4px 4px 0 var(--ink); }
        .unread-dot { width: 8px; height: 8px; background: var(--punch); border-radius: 50%; display: inline-block; margin-right: 6px; }

        @media (max-width: 1024px) { .sidebar { transform: translateX(-100%); } .sidebar.open { transform: translateX(0); } .main { margin-left: 0; } .two-col { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-box"><span style="font-family:'Anton'; font-size:1.2rem; color:var(--purple)">K</span></div>
        <div>
            <div style="font-family:'Anton'; color:white; font-size:0.9rem; letter-spacing:1px;">KONTENDIGITAL</div>
            <div style="font-size:0.55rem; color:var(--punch); font-weight:bold; letter-spacing:2px;">ADMIN PANEL</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">Main Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item active"><span>📊</span> Dashboard</a>
        <a href="{{ route('admin.articles.index') }}" class="nav-item"><span>📰</span> Manajemen Artikel</a>
        <a href="{{ route('admin.contacts.index') }}" class="nav-item">
            <span>💬</span> Pesan Masuk
            @if($contactCounts['new'] > 0)
                <span class="nav-badge">{{ $contactCounts['new'] }}</span>
            @endif
        </a>
    </nav>

    <div class="sidebar-footer" style="padding:1.25rem; border-top:2px solid rgba(255,255,255,0.1);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width:100%; background:transparent; border:2px solid rgba(255,255,255,0.2); color:white; font-family:'Anton'; padding:0.6rem; cursor:pointer;">⏻ LOGOUT</button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div>
            <h1 class="topbar-title" style="font-family:'Anton'; letter-spacing:1px; line-height:1;">DASHBOARD</h1>
            <p style="font-size:0.65rem; font-weight:800; opacity:0.5; text-transform:uppercase;">Admin / Overview</p>
        </div>
        <div style="display:flex; gap:0.75rem;">
            @if($contactCounts['new'] > 0)
            <a href="{{ route('admin.contacts.index') }}" class="btn-neo" style="background:var(--punch); color:white;">🔔 {{ $contactCounts['new'] }} PESAN BARU</a>
            @endif
            <a href="{{ route('admin.articles.create') }}" class="btn-neo" style="background:var(--yellow);">+ ARTIKEL BARU</a>
        </div>
    </header>

    <main class="content">
        <p style="font-family:'Anton'; font-size:0.7rem; letter-spacing:3px; opacity:0.4; margin-bottom:0.75rem; text-transform:uppercase;">Artikel</p>
        <div class="stats-grid">
            <div class="stat-card yellow"><span class="stat-label">Total Artikel</span><span class="stat-num">{{ $stats['total_articles'] }}</span></div>
            <div class="stat-card"><span class="stat-label">Published</span><span class="stat-num" style="color:var(--teal)">{{ $stats['published_articles'] }}</span></div>
            <div class="stat-card purple"><span class="stat-label">Draft</span><span class="stat-num">{{ $stats['draft_articles'] }}</span></div>
            <div class="stat-card punch"><span class="stat-label">Total Users</span><span class="stat-num">{{ $stats['total_users'] }}</span></div>
        </div>

        <p style="font-family:'Anton'; font-size:0.7rem; letter-spacing:3px; opacity:0.4; margin-bottom:0.75rem; text-transform:uppercase; margin-top:1rem;">Pesan Masuk</p>
        <div class="stats-grid">
            <div class="stat-card" style="background:#1d4ed8; color:white;"><span class="stat-label">Total Pesan</span><span class="stat-num" style="color:white">{{ $contactCounts['all'] }}</span></div>
            <div class="stat-card" style="background:#3b82f6; color:white;"><span class="stat-label">Baru</span><span class="stat-num" style="color:white">{{ $contactCounts['new'] }}</span></div>
            <div class="stat-card yellow"><span class="stat-label">Diproses</span><span class="stat-num">{{ $contactCounts['in_progress'] }}</span></div>
            <div class="stat-card teal-card"><span class="stat-label">Selesai</span><span class="stat-num">{{ $contactCounts['resolved'] }}</span></div>
        </div>

        <div class="two-col">
            <div class="table-section">
                <div class="table-header"><h2 style="font-family:'Anton'; font-size:1rem;">ARTIKEL TERBARU</h2><a href="{{ route('admin.articles.index') }}" class="btn-neo">SEMUA →</a></div>
                <table>
                    <thead><tr><th>JUDUL</th><th>STATUS</th></tr></thead>
                    <tbody>
                        @forelse($latestArticles as $article)
                        <tr>
                            <td>{{ Str::limit($article->title, 35) }}</td>
                            <td><span class="status-badge badge-{{ $article->status }}">{{ $article->status }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="2" style="text-align:center; opacity:0.5;">Belum ada artikel.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-section">
                <div class="table-header"><h2 style="font-family:'Anton'; font-size:1rem;">PESAN TERBARU</h2><a href="{{ route('admin.contacts.index') }}" class="btn-neo">SEMUA →</a></div>
                <table>
                    <thead><tr><th>NAMA</th><th>STATUS</th></tr></thead>
                    <tbody>
                        @forelse($latestContacts as $contact)
                        @php $badge = $contact->statusBadge(); @endphp
                        <tr>
                            <td>
                                @if(!$contact->isRead()) <span class="unread-dot"></span> @endif
                                {{ $contact->name }}
                            </td>
                            <td><span class="status-badge {{ $badge['class'] }}">{{ $badge['label'] }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="2" style="text-align:center; opacity:0.5;">Belum ada pesan.</td></tr>
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
    function toggleMenu() { sidebar.classList.toggle('open'); overlay.classList.toggle('show'); }
    if(menuBtn) menuBtn.addEventListener('click', toggleMenu);
    if(overlay) overlay.addEventListener('click', toggleMenu);
</script>

</body>
</html>