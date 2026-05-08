{{-- resources/views/admin/contacts/show.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pesan — Admin KontenDigital</title>

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { 
            --ink: #0e0b14; --yellow: #f5c518; --purple: #2d1b4e; 
            --punch: #e8402a; --teal: #00a896; --sidebar: #1a0f2e; 
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #f0edf7; display: flex; min-height: 100vh; overflow-x: hidden; }

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
        .nav-section-title { font-family: 'Anton', sans-serif; font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.25); padding: 0 1.5rem; margin: 1.25rem 0 0.5rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.5rem; color: rgba(255,255,255,0.55); font-weight: 700; font-size: 0.85rem; text-decoration: none; transition: all 0.2s; border-left: 4px solid transparent; }
        .nav-item:hover, .nav-item.active { background: rgba(255,255,255,0.06); color: white; }
        .nav-item.active { color: var(--yellow); border-left-color: var(--yellow); background: rgba(245,197,24,0.1); }

        /* --- MAIN CONTENT --- */
        .main { margin-left: 260px; flex: 1; display: flex; flex-direction: column; width: 100%; transition: margin 0.3s; min-width: 0; }
        .topbar { background: white; border-bottom: 4px solid var(--ink); padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 20; }
        .menu-toggle { display: none; background: var(--yellow); border: 3px solid var(--ink); padding: 5px 8px; cursor: pointer; box-shadow: 3px 3px 0 var(--ink); }
        .content { padding: 2rem; max-width: 900px; margin: 0 auto; width: 100%; }

        /* --- DETAIL CARD --- */
        .detail-card { background: white; border: 4px solid var(--ink); box-shadow: 12px 12px 0 var(--ink); padding: 2.5rem; }
        .back-link { font-family: 'Anton', sans-serif; text-decoration: none; color: var(--ink); font-size: 0.75rem; margin-bottom: 1.5rem; display: inline-block; transition: 0.2s; }
        .back-link:hover { color: var(--punch); transform: translateX(-5px); }

        .detail-header { border-bottom: 4px solid var(--ink); padding-bottom: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; }
        .sender-name { font-family: 'Anton', sans-serif; font-size: 2.5rem; color: var(--purple); line-height: 1; text-transform: uppercase; }
        
        .section-label { font-family: 'Anton', sans-serif; font-size: 0.9rem; text-transform: uppercase; color: var(--punch); margin-bottom: 0.75rem; display: block; }
        .service-box { background: var(--yellow); border: 3px solid var(--ink); padding: 0.5rem 1rem; font-weight: 900; text-transform: uppercase; display: inline-block; box-shadow: 4px 4px 0 var(--ink); margin-bottom: 2rem; }
        
        /* FIX UNTUK TEKS MELUBER */
        .message-box { 
            background: #f9fafb; 
            border: 3px solid var(--ink); 
            padding: 1.5rem; 
            font-weight: 600; 
            line-height: 1.6; 
            color: var(--ink); 
            position: relative;
            word-break: break-all; /* Memecah kata panjang tanpa spasi */
            overflow-wrap: break-word; /* Menjaga teks tetap di dalam container */
        }

        .action-footer { border-top: 4px solid var(--ink); margin-top: 2.5rem; padding-top: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; }
        
        .status-select { border: 3px solid var(--ink); padding: 0.6rem; font-family: 'Anton', sans-serif; outline: none; background: white; }
        .btn-neo { font-family: 'Anton', sans-serif; padding: 0.6rem 1.5rem; border: 3px solid var(--ink); cursor: pointer; text-decoration: none; font-size: 0.8rem; transition: 0.1s; box-shadow: 4px 4px 0 var(--ink); }
        .btn-neo:active { transform: translate(2px, 2px); box-shadow: 2px 2px 0 var(--ink); }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .menu-toggle { display: block; }
            .content { padding: 1.5rem; }
            .sender-name { font-size: 1.8rem; }
            .detail-card { padding: 1.5rem; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="overlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-box"><span style="font-family:'Anton'; font-size:1.2rem; color:var(--purple)">K</span></div>
        <div style="font-family:'Anton'; color:white; font-size:0.9rem; letter-spacing:1px;">KONTENDIGITAL</div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-title">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item"><span>📊</span> Dashboard</a>
        <a href="{{ route('admin.articles.index') }}" class="nav-item"><span>📰</span> Manajemen Artikel</a>
        <a href="{{ route('admin.contacts.index') }}" class="nav-item active"><span>💬</span> Pesan Masuk</a>
         <div class="nav-section-title">Site</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank"><span>🌐</span> Lihat Website</a>
            <a href="{{ route('articles.index') }}" class="nav-item" target="_blank">
            <span class="nav-icon">📖</span> Halaman Blog
        </a>
    </nav>
</aside>

<div class="main">
    <header class="topbar">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="menu-toggle" id="menuBtn">☰</button>
            <h1 style="font-family:'Anton'; font-size:1.2rem; letter-spacing:1px;">DETAIL PESAN</h1>
        </div>
    </header>

    <main class="content">
        <a href="{{ route('admin.contacts.index') }}" class="back-link">← KEMBALI KE DAFTAR</a>

        <div class="detail-card">
            <div class="detail-header">
                <div>
                    <h2 class="sender-name">{{ $contact->name }}</h2>
                    <p style="font-weight: 800; color: #6b7280; margin-top: 0.5rem;">
                        {{ $contact->email }} <span style="margin: 0 0.5rem;">|</span> {{ $contact->whatsapp ?? '-' }}
                    </p>
                </div>
                <div style="text-align: right;">
                    <span class="section-label" style="color: #9ca3af; font-size: 0.7rem;">Tanggal Masuk</span>
                    <p style="font-weight: 800;">{{ $contact->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <div class="section">
                <span class="section-label">Layanan Yang Diminati</span>
                <div class="service-box">{{ $contact->service }}</div>
            </div>

            <div class="section" style="margin-top: 1rem;">
                <span class="section-label">Isi Pesan</span>
                <div class="message-box">
                    {{ $contact->message }}
                </div>
            </div>

            <div class="action-footer">
                <form action="{{ route('admin.contacts.updateStatus', $contact) }}" method="POST" style="display: flex; align-items: center; gap: 0.75rem;">
                    @csrf @method('PATCH')
                    <span class="section-label" style="margin: 0; color: var(--ink); font-size: 0.7rem;">Update Status:</span>
                    <select name="status" class="status-select">
                        <option value="new" {{ $contact->status == 'new' ? 'selected' : '' }}>BARU</option>
                        <option value="in_progress" {{ $contact->status == 'in_progress' ? 'selected' : '' }}>PROSES</option>
                        <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>SELESAI</option>
                    </select>
                    <button type="submit" class="btn-neo" style="background: var(--purple); color: var(--yellow);">UPDATE</button>
                </form>

                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini secara permanen?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-neo" style="background: var(--punch); color: white;">HAPUS PESAN</button>
                </form>
            </div>
        </div>
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

    if(menuBtn) menuBtn.addEventListener('click', toggleMenu);
    if(overlay) overlay.addEventListener('click', toggleMenu);
</script>

</body>
</html>