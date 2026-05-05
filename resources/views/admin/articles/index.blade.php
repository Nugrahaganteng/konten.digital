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
        :root { --ink:#0e0b14; --yellow:#f5c518; --purple:#2d1b4e; --punch:#e8402a; --cream:#f7f2e8; --teal:#00a896; --sidebar:#1a0f2e; }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'DM Sans',sans-serif; background:#f0edf7; display:flex; min-height:100vh; }

        /* Sidebar (same as dashboard) */
        .sidebar { width:260px; background:var(--sidebar); border-right:4px solid var(--ink); display:flex; flex-direction:column; position:fixed; top:0; left:0; height:100vh; z-index:30; overflow-y:auto; }
        .sidebar-logo { padding:1.5rem; border-bottom:2px solid rgba(255,255,255,0.08); display:flex; align-items:center; gap:0.75rem; }
        .sidebar-logo-box { width:40px; height:40px; background:var(--yellow); border:2px solid var(--ink); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .sidebar-logo-text { font-family:'Anton',sans-serif; font-size:0.9rem; color:white; }
        .sidebar-logo-sub { font-size:0.55rem; color:var(--punch); letter-spacing:0.15em; text-transform:uppercase; }
        .sidebar-nav { flex:1; padding:1.5rem 0; }
        .nav-section-title { font-family:'Anton',sans-serif; font-size:0.6rem; letter-spacing:0.2em; text-transform:uppercase; color:rgba(255,255,255,0.25); padding:0 1.5rem; margin-bottom:0.5rem; margin-top:1.25rem; }
        .nav-item { display:flex; align-items:center; gap:0.75rem; padding:0.75rem 1.5rem; color:rgba(255,255,255,0.55); font-weight:700; font-size:0.85rem; text-decoration:none; transition:background 0.15s,color 0.15s; border-left:3px solid transparent; }
        .nav-item:hover { background:rgba(255,255,255,0.06); color:white; }
        .nav-item.active { background:rgba(245,197,24,0.1); color:var(--yellow); border-left-color:var(--yellow); }
        .nav-icon { font-size:1rem; width:20px; text-align:center; }
        .sidebar-footer { padding:1.5rem; border-top:2px solid rgba(255,255,255,0.08); }
        .user-info { display:flex; align-items:center; gap:0.75rem; margin-bottom:1rem; }
        .user-avatar { width:36px; height:36px; background:var(--punch); border-radius:50%; border:2px solid var(--ink); display:flex; align-items:center; justify-content:center; font-family:'Anton',sans-serif; color:white; font-size:0.9rem; flex-shrink:0; }
        .user-name { font-weight:700; font-size:0.85rem; color:white; }
        .user-role { font-size:0.65rem; color:var(--yellow); text-transform:uppercase; letter-spacing:0.1em; font-weight:700; }
        .logout-btn { width:100%; background:transparent; border:2px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.5); font-family:'Anton',sans-serif; font-size:0.75rem; letter-spacing:0.1em; padding:0.6rem; cursor:pointer; transition:background 0.15s,color 0.15s,border-color 0.15s; }
        .logout-btn:hover { background:var(--punch); color:white; border-color:var(--punch); }

        .main { margin-left:260px; flex:1; display:flex; flex-direction:column; min-height:100vh; }
        .topbar { background:white; border-bottom:3px solid var(--ink); padding:1rem 2rem; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:20; }
        .topbar-title { font-family:'Anton',sans-serif; font-size:1.4rem; color:var(--purple); }
        .topbar-breadcrumb { font-size:0.75rem; font-weight:600; color:rgba(14,11,20,0.4); margin-top:0.1rem; }
        .content { padding:2rem; flex:1; }

        /* Filter tabs */
        .filter-tabs { display:flex; gap:0; border:3px solid var(--ink); margin-bottom:1.5rem; background:white; overflow-x:auto; }
        .ftab { font-family:'Anton',sans-serif; font-size:0.75rem; letter-spacing:0.1em; padding:0.8rem 1.5rem; border:none; background:transparent; color:rgba(14,11,20,0.4); cursor:pointer; border-right:2px solid var(--ink); white-space:nowrap; text-decoration:none; transition:background 0.15s,color 0.15s; }
        .ftab:last-child { border-right:none; }
        .ftab:hover, .ftab.active { background:var(--purple); color:var(--yellow); }

        /* Search bar */
        .search-row { display:flex; gap:1rem; margin-bottom:1.5rem; align-items:center; flex-wrap:wrap; }
        .search-field { border:3px solid var(--ink); background:white; padding:0.65rem 1rem; font-family:'DM Sans',sans-serif; font-weight:700; font-size:0.9rem; outline:none; min-width:280px; }
        .search-field:focus { box-shadow:3px 3px 0 var(--purple); }
        .search-submit { font-family:'Anton',sans-serif; font-size:0.8rem; letter-spacing:0.1em; padding:0.65rem 1.5rem; border:3px solid var(--ink); background:var(--ink); color:var(--yellow); cursor:pointer; transition:background 0.15s; }
        .search-submit:hover { background:var(--purple); }

        /* Table */
        .table-wrap { background:white; border:3px solid var(--ink); box-shadow:5px 5px 0 var(--ink); }
        .table-header { display:flex; align-items:center; justify-content:space-between; padding:1.25rem 1.5rem; border-bottom:2px solid var(--ink); flex-wrap:wrap; gap:0.75rem; }
        .table-header-title { font-family:'Anton',sans-serif; font-size:1.1rem; color:var(--purple); }
        .btn-new { font-family:'Anton',sans-serif; font-size:0.8rem; letter-spacing:0.1em; background:var(--punch); color:white; padding:0.6rem 1.25rem; border:2px solid var(--ink); text-decoration:none; box-shadow:3px 3px 0 var(--ink); transition:transform 0.15s,box-shadow 0.15s; }
        .btn-new:hover { transform:translate(2px,2px); box-shadow:1px 1px 0 var(--ink); }
        table { width:100%; border-collapse:collapse; }
        th { background:var(--purple); color:var(--yellow); font-family:'Anton',sans-serif; font-size:0.68rem; letter-spacing:0.12em; text-transform:uppercase; padding:0.75rem 1rem; text-align:left; border-right:1px solid rgba(255,255,255,0.1); white-space:nowrap; }
        th:last-child { border-right:none; }
        td { padding:0.9rem 1rem; font-size:0.875rem; font-weight:600; border-bottom:1px solid rgba(14,11,20,0.07); color:var(--ink); vertical-align:middle; }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background:rgba(245,197,24,0.04); }

        .status-badge { display:inline-block; font-family:'Anton',sans-serif; font-size:0.6rem; letter-spacing:0.1em; padding:0.25rem 0.65rem; text-transform:uppercase; }
        .badge-draft     { background:rgba(245,197,24,0.2); color:#7c6200; border:1px solid var(--yellow); }
        .badge-published { background:rgba(0,168,150,0.15); color:#004d47; border:1px solid var(--teal); }
        .badge-rejected  { background:rgba(232,64,42,0.15); color:var(--punch); border:1px solid var(--punch); }

        .btn-action { font-family:'Anton',sans-serif; font-size:0.62rem; letter-spacing:0.08em; padding:0.28rem 0.65rem; text-decoration:none; border:2px solid var(--ink); display:inline-block; margin-right:3px; margin-bottom:3px; cursor:pointer; background:transparent; transition:transform 0.1s; white-space:nowrap; }
        .btn-action:hover { transform:translate(1px,1px); }
        .btn-publish { background:var(--teal); color:white; }
        .btn-edit    { background:var(--yellow); color:var(--purple); }
        .btn-reject  { background:rgba(232,64,42,0.1); color:var(--punch); }
        .btn-delete  { background:var(--punch); color:white; }
        .btn-view    { background:var(--purple); color:white; }

        .thumb-sm { width:60px; height:44px; object-fit:cover; border:2px solid var(--ink); }
        .thumb-sm-placeholder { width:60px; height:44px; background:var(--purple); border:2px solid var(--ink); display:flex; align-items:center; justify-content:center; font-size:1.2rem; }

        .alert-success { background:rgba(0,168,150,0.12); border:2px solid var(--teal); padding:0.75rem 1.25rem; font-weight:700; font-size:0.85rem; color:#004d47; margin-bottom:1.5rem; }

        .pagination-row { padding:1.25rem 1.5rem; border-top:2px solid var(--ink); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:0.75rem; }
        .page-info { font-size:0.8rem; font-weight:600; color:rgba(14,11,20,0.45); }
        .page-links { display:flex; gap:0; }
        .page-link { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border:2px solid rgba(14,11,20,0.2); color:rgba(14,11,20,0.5); font-family:'Anton',sans-serif; font-size:0.8rem; text-decoration:none; margin:0 2px; transition:background 0.15s,color 0.15s; }
        .page-link:hover, .page-link.active { background:var(--purple); color:var(--yellow); border-color:var(--purple); }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
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

{{-- MAIN --}}
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">MANAJEMEN ARTIKEL</div>
            <div class="topbar-breadcrumb">Admin / Artikel</div>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn-new">+ ARTIKEL BARU</a>
    </div>

    <div class="content">
        @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        {{-- Filter status tabs --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.articles.index') }}"
               class="ftab {{ !request('status') ? 'active' : '' }}">
                SEMUA ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.articles.index', ['status'=>'draft']) }}"
               class="ftab {{ request('status')==='draft' ? 'active' : '' }}">
                ⏳ DRAFT ({{ $counts['draft'] }})
            </a>
            <a href="{{ route('admin.articles.index', ['status'=>'published']) }}"
               class="ftab {{ request('status')==='published' ? 'active' : '' }}">
                ✅ PUBLISHED ({{ $counts['published'] }})
            </a>
            <a href="{{ route('admin.articles.index', ['status'=>'rejected']) }}"
               class="ftab {{ request('status')==='rejected' ? 'active' : '' }}">
                ✗ DITOLAK ({{ $counts['rejected'] }})
            </a>
        </div>

        {{-- Search --}}
        <form action="{{ route('admin.articles.index') }}" method="GET" class="search-row">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <input type="text" name="search" class="search-field"
                   placeholder="Cari judul artikel..."
                   value="{{ request('search') }}">
            <button type="submit" class="search-submit">CARI</button>
            @if(request('search'))
                <a href="{{ route('admin.articles.index', request()->only('status')) }}"
                   style="font-size:0.8rem;font-weight:700;color:var(--punch);text-decoration:none;">× Reset</a>
            @endif
        </form>

        {{-- Table --}}
        <div class="table-wrap">
            <div class="table-header">
                <div class="table-header-title">
                    {{ $articles->total() }} Artikel
                    @if(request('search')) — hasil pencarian "{{ request('search') }}" @endif
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/'.$article->thumbnail) }}"
                                     alt="" class="thumb-sm">
                            @else
                                @php $emojis=['🚀','📱','📰','🎨','📊']; @endphp
                                <div class="thumb-sm-placeholder">
                                    {{ $emojis[$article->id % count($emojis)] }}
                                </div>
                            @endif
                        </td>
                        <td style="max-width:200px;">
                            <div style="font-weight:700;color:var(--purple);">
                                {{ Str::limit($article->title,45) }}
                            </div>
                        </td>
                        <td>{{ $article->user->name }}</td>
                        <td><span style="font-size:0.8rem;">{{ $article->category }}</span></td>
                        <td>
                            <span class="status-badge badge-{{ $article->status }}">
                                {{ $article->status }}
                            </span>
                        </td>
                        <td style="white-space:nowrap;font-size:0.8rem;">
                            {{ $article->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <a href="{{ route('articles.show', $article->slug) }}" target="_blank"
                               class="btn-action btn-view">👁 LIHAT</a>

                            @if($article->status === 'draft')
                                <form action="{{ route('admin.articles.publish', $article) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-action btn-publish">✓ PUBLISH</button>
                                </form>
                                <form action="{{ route('admin.articles.reject', $article) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-action btn-reject">✗ TOLAK</button>
                                </form>
                            @elseif($article->status === 'published')
                                <form action="{{ route('admin.articles.reject', $article) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-action btn-reject">↩ UNPUBLISH</button>
                                </form>
                            @elseif($article->status === 'rejected')
                                <form action="{{ route('admin.articles.publish', $article) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-action btn-publish">↺ PUBLISH</button>
                                </form>
                            @endif

                            <a href="{{ route('admin.articles.edit', $article) }}"
                               class="btn-action btn-edit">✏️ EDIT</a>

                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Yakin hapus artikel ini? Tidak bisa dikembalikan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">🗑</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:3rem;color:rgba(14,11,20,0.4);font-weight:700;">
                            Tidak ada artikel ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($articles->hasPages())
            <div class="pagination-row">
                <div class="page-info">
                    Menampilkan {{ $articles->firstItem() }}–{{ $articles->lastItem() }} dari {{ $articles->total() }}
                </div>
                <div class="page-links">
                    @if($articles->onFirstPage())
                        <span class="page-link" style="opacity:0.3;">‹</span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}" class="page-link">‹</a>
                    @endif

                    @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="page-link {{ $page === $articles->currentPage() ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}" class="page-link">›</a>
                    @else
                        <span class="page-link" style="opacity:0.3;">›</span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
