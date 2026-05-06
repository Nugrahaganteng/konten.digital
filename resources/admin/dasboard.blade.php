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
        body { font-family:'DM Sans',sans-serif; background:#f0edf7; display:flex; min-height:100vh; overflow-x: hidden; }

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
            overflow-x: hidden;
            transition: width 0.3s ease, transform 0.3s ease;
        }

        /* Sidebar Mini State (Desktop) */
        .sidebar.mini { width: 80px; }
        .sidebar.mini .sidebar-logo { justify-content: center; padding: 1.5rem 0; }
        .sidebar.mini .sidebar-logo-text,
        .sidebar.mini .sidebar-logo-sub,
        .sidebar.mini .nav-section-title,
        .sidebar.mini .nav-item span:not(.nav-icon),
        .sidebar.mini .user-info-text,
        .sidebar.mini .logout-text { display: none; }
        .sidebar.mini .nav-item { justify-content: center; padding: 0.75rem 0; }
        .sidebar.mini .nav-icon { margin: 0; font-size: 1.25rem; }
        .sidebar.mini .user-info { justify-content: center; }

        .sidebar-logo { padding: 1.5rem; border-bottom: 2px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 0.75rem; white-space: nowrap; }
        .sidebar-logo-box { width: 40px; height: 40px; background: var(--yellow); border: 2px solid var(--ink); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sidebar-logo-text { font-family:'Anton',sans-serif; font-size:0.9rem; color:white; letter-spacing:0.02em; }
        .sidebar-logo-sub { font-size:0.55rem; color:var(--punch); letter-spacing:0.15em; text-transform:uppercase; }

        .sidebar-nav { flex: 1; padding: 1.5rem 0; }
        .nav-section-title { font-family:'Anton',sans-serif; font-size:0.6rem; letter-spacing:0.2em; text-transform:uppercase; color:rgba(255,255,255,0.25); padding: 0 1.5rem; margin-bottom: 0.5rem; margin-top: 1.25rem; white-space: nowrap; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.5rem; color: rgba(255,255,255,0.55); font-weight: 700; font-size: 0.85rem; text-decoration: none; transition: background 0.15s, color 0.15s; border-left: 3px solid transparent; white-space: nowrap; }
        .nav-item:hover { background: rgba(255,255,255,0.06); color: white; }
        .nav-item.active { background: rgba(245,197,24,0.1); color: var(--yellow); border-left-color: var(--yellow); }
        .nav-icon { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }

        .sidebar-footer { padding: 1.5rem; border-top: 2px solid rgba(255,255,255,0.08); }
        .user-info { display:flex; align-items:center; gap:0.75rem; margin-bottom:1rem; white-space: nowrap; }
        .user-avatar { width: 36px; height: 36px; background: var(--punch); border-radius: 50%; border: 2px solid var(--ink); display: flex; align-items: center; justify-content: center; font-family: 'Anton', sans-serif; color: white; font-size: 0.9rem; flex-shrink: 0; }
        .user-name { font-weight: 700; font-size: 0.85rem; color: white; }
        .user-role { font-size: 0.65rem; color: var(--yellow); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700; }
        .logout-btn { width: 100%; background: transparent; border: 2px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.5); font-family: 'Anton', sans-serif; font-size: 0.75rem; letter-spacing: 0.1em; padding: 0.6rem; cursor: pointer; transition: background 0.15s, color 0.15s, border-color 0.15s; white-space: nowrap; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .logout-btn:hover { background: var(--punch); color: white; border-color: var(--punch); }

        /* ── MAIN ── */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; transition: margin-left 0.3s ease; width: calc(100% - 260px); }
        .main.mini { margin-left: 80px; width: calc(100% - 80px); }

        .topbar { background: white; border-bottom: 3px solid var(--ink); padding: 1rem 2rem; display: flex; align-items: center; gap: 1rem; position: sticky; top: 0; z-index: 20; }
        
        .hamburger { display: flex; background: transparent; border: 2px solid var(--ink); padding: 0.4rem 0.55rem; cursor: pointer; flex-direction: column; gap: 4px; flex-shrink: 0; transition: transform 0.2s; background: var(--yellow); box-shadow: 2px 2px 0 var(--ink); }
        .hamburger:hover { transform: translate(1px, 1px); box-shadow: 1px 1px 0 var(--ink); }
        .hamburger span { display: block; width: 20px; height: 2px; background: var(--ink); transition: 0.3s ease; }
        
        /* Hamburger Active (X) animation for mobile */
        .hamburger.active span:nth-child(1) { transform: translateY(6px) rotate(45deg); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-6px) rotate(-45deg); }

        .topbar-info { flex: 1; }
        .topbar-title { font-family:'Anton',sans-serif; font-size:1.4rem; color:var(--purple); letter-spacing:0.02em; line-height: 1.2; }
        .topbar-breadcrumb { font-size:0.75rem; font-weight:600; color:rgba(14,11,20,0.4); }

        .btn-new { font-family:'Anton',sans-serif; font-size:0.8rem; letter-spacing:0.1em; background:var(--punch); color:white; padding:0.6rem 1.25rem; border:2px solid var(--ink); text-decoration:none; box-shadow:3px 3px 0 var(--ink); white-space:nowrap; transition: transform 0.15s, box-shadow 0.15s; display: flex; align-items: center; gap: 0.4rem; }
        .btn-new:hover { transform: translate(2px, 2px); box-shadow: 1px 1px 0 var(--ink); }

        .content { padding: 2rem; flex: 1; overflow-x: hidden; }

        /* ── STAT CARDS ── */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem; }
        .stat-card { background: white; border: 3px solid var(--ink); box-shadow: 5px 5px 0 var(--ink); padding: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; }
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
        .table-section { background: white; border: 3px solid var(--ink); box-shadow: 5px 5px 0 var(--ink); margin-bottom: 2rem; }
        .table-header { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.5rem; border-bottom: 2px solid var(--ink); flex-wrap: wrap; gap: 1rem; }
        .table-header-title { font-family:'Anton',sans-serif; font-size:1.1rem; color:var(--purple); }
        .table-header-link { font-family:'Anton',sans-serif; font-size:0.75rem; letter-spacing:0.1em; color:var(--purple); text-decoration:none; border:2px solid var(--ink); padding:0.4rem 1rem; background:var(--yellow); box-shadow:3px 3px 0 var(--ink); transition:transform 0.15s,box-shadow 0.15s; white-space: nowrap; }
        .table-header-link:hover { transform:translate(2px,2px); box-shadow:1px 1px 0 var(--ink); }

        .table-responsive { overflow-x: auto; width: 100%; }
        table { width: 100%; border-collapse: collapse; min-width: 700px; }
        th { background: var(--purple); color: var(--yellow); font-family: 'Anton', sans-serif; font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.75rem 1rem; text-align: left; border-right: 1px solid rgba(255,255,255,0.1); }
        th:last-child { border-right: none; }
        td { padding: 0.9rem 1rem; font-size: 0.875rem; font-weight: 600; border-bottom: 1px solid rgba(14,11,20,0.07); color: var(--ink); }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(245,197,24,0.05); }

        .status-badge { display: inline-block; font-family: 'Anton', sans-serif; font-size: 0.6rem; letter-spacing: 0.12em; padding: 0.25rem 0.65rem; text-transform: uppercase; }
        .badge-draft     { background: rgba(245,197,24,0.2); color: #7c6200; border: 1px solid var(--yellow); }
        .badge-published { background: rgba(0,168,150,0.15); color: #004d47; border: 1px solid var(--teal); }
        .badge-rejected  { background: rgba(232,64,42,0.15);  color: var(--punch); border: 1px solid var(--punch); }

        .action-link { font-family: 'Anton', sans-serif; font-size: 0.68rem; letter-spacing: 0.08em; padding: 0.3rem 0.75rem; text-decoration: none; border: 2px solid var(--ink); display: inline-block; margin-right: 4px; transition: transform 0.1s; background: none; cursor: pointer; }
        .action-link:hover { transform: translate(1px,1px); }
        .link-publish { background: var(--teal); color: white; }
        .link-edit    { background: var(--yellow); color: var(--purple); }
        .link-reject  { background: var(--punch); color: white; }

        .alert-success { background: rgba(0,168,150,0.12); border: 2px solid var(--teal); padding: 0.75rem 1.25rem; font-weight: 700; font-size: 0.85rem; color: #004d47; margin-bottom: 1.5rem; }

        /* ══════════════════════════════════
           MOBILE RESPONSIVE
        ══════════════════════════════════ */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 29; backdrop-filter: blur(2px); }
        .sidebar-overlay.open { display: block; }

        @media (max-width: 992px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            /* Sidebar hidden off-screen by default on mobile */
            .sidebar { transform: translateX(-100%); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); width: 260px !important; }
            .sidebar.mini { transform: translateX(-100%); width: 260px !important; } /* Reset mini behavior on mobile */
            .sidebar.open { transform: translateX(0); box-shadow: 8px 0 30px rgba(0,0,0,0.35); }
            
            /* Restore full content of sidebar in mobile view */
            .sidebar .sidebar-logo-text, .sidebar .sidebar-logo-sub, .sidebar .nav-section-title, .sidebar .nav-item span:not(.nav-icon), .sidebar .user-info-text, .sidebar .logout-text { display: block !important; }
            .sidebar .nav-item { justify-content: flex-start !important; padding: 0.75rem 1.5rem !important; }
            .sidebar .sidebar-logo { justify-content: flex-start !important; padding: 1.5rem !important; }
            .sidebar .user-info { justify-content: flex-start !important; }

            /* Main panel full-width */
            .main, .main.mini { margin-left: 0 !important; width: 100% !important; }

            .topbar { padding: 0.75rem 1.25rem; gap: 0.75rem; }
            .topbar-title { font-size: 1.15rem; }
            .content { padding: 1.25rem; }
            
            .stat-num { font-size: 2rem; }
            .stat-card { padding: 1.25rem; box-shadow: 3px 3px 0 var(--ink); border-width: 2px; }

            .table-section { box-shadow: 3px 3px 0 var(--ink); border-width: 2px; }
            .table-header { padding: 1rem 1.25rem; }
        }

        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; gap: 1rem; }
            .btn-new span.btn-text { display: none; } /* Hide "ARTIKEL BARU" text on very small screens, show only "+" */
            .btn-new { padding: 0.6rem 1rem; }
        }
    </style>
</head>
<body>

{{-- ── OVERLAY (mobile) ── --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar" id="sidebar">
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
            <span class="nav-icon">📊</span> <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.articles.index') }}" class="nav-item">
            <span class="nav-icon">📰</span> <span>Manajemen Artikel</span>
        </a>

        <div class="nav-section-title">Site</div>
        <a href="{{ route('home') }}" class="nav-item" target="_blank">
            <span class="nav-icon">🌐</span> <span>Lihat Website</span>
        </a>
        <a href="{{ route('articles.index') }}" class="nav-item" target="_blank">
            <span class="nav-icon">📖</span> <span>Halaman Blog</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="user-info-text">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <span>⏻</span> <span class="logout-text">LOGOUT</span>
            </button>
        </form>
    </div>
</aside>

{{-- ── MAIN ── --}}
<div class="main" id="mainContent">
    <div class="topbar">
        {{-- Hamburger (Berfungsi untuk minimize di desktop, dan slide di mobile) --}}
        <button class="hamburger" id="hamburgerBtn" aria-label="Buka/Tutup Menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="topbar-info">
            <div class="topbar-title">DASHBOARD</div>
            <div class="topbar-breadcrumb">Admin / Overview</div>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn-new">
            <span>+</span> <span class="btn-text">ARTIKEL BARU</span>
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
                <div class="stat-num">{{ $stats['total_articles'] ?? 0 }}</div>
                <div class="stat-label">Total Artikel</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-num" style="color:var(--teal);">{{ $stats['published_articles'] ?? 0 }}</div>
                <div class="stat-label">Dipublish</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon">⏳</div>
                <div class="stat-num">{{ $stats['draft_articles'] ?? 0 }}</div>
                <div class="stat-label">Menunggu Review</div>
            </div>
            <div class="stat-card punch">
                <div class="stat-icon">👥</div>
                <div class="stat-num">{{ $stats['total_users'] ?? 0 }}</div>
                <div class="stat-label">Total User</div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-section">
            <div class="table-header">
                <div class="table-header-title">ARTIKEL TERBARU</div>
                <a href="{{ route('admin.articles.index') }}" class="table-header-link">LIHAT SEMUA →</a>
            </div>
            
            {{-- Wrapper responsif khusus untuk tabel --}}
            <div class="table-responsive">
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
                        @forelse($latestArticles ?? [] as $article)
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
</div>

<script>
(function () {
    const btn = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const overlay = document.getElementById('sidebarOverlay');

    // Cek apakah device saat ini sedang di mode desktop
    const isDesktop = () => window.innerWidth > 768;

    function toggleSidebar() {
        if (isDesktop()) {
            // Mode Desktop: Dikecil-besarin (Mini Sidebar)
            sidebar.classList.toggle('mini');
            mainContent.classList.toggle('mini');
        } else {
            // Mode Mobile: Slide In/Out
            const isOpen = sidebar.classList.contains('open');
            if (isOpen) {
                closeMobileSidebar();
            } else {
                openMobileSidebar();
            }
        }
    }

    function openMobileSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('open');
        btn.classList.add('active'); // Animasi tanda 'X'
        btn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden'; // Stop scrolling di belakang
    }

    function closeMobileSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
        btn.classList.remove('active'); // Kembalikan ke hamburger
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    // Event Listener untuk Hamburger Button
    btn.addEventListener('click', toggleSidebar);

    // Event Listener untuk Overlay Mode Mobile
    overlay.addEventListener('click', closeMobileSidebar);

    // Tutup otomatis saat link diklik (khusus mobile)
    document.querySelectorAll('.nav-item').forEach(function (link) {
        link.addEventListener('click', function () {
            if (!isDesktop()) closeMobileSidebar();
        });
    });

    // Reset state saat ukuran layar di-resize
    window.addEventListener('resize', function () {
        if (isDesktop()) {
            closeMobileSidebar();
            // Optional: reset animasi hamburger
            btn.classList.remove('active'); 
        } else {
            // Reset state dari class 'mini' desktop
            sidebar.classList.remove('mini');
            mainContent.classList.remove('mini');
        }
    });
})();
</script>

</body>
</html>