{{-- resources/views/admin/articles/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Artikel — Admin KontenDigital</title>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --ink:#0e0b14; --yellow:#f5c518; --purple:#2d1b4e; --punch:#e8402a; --cream:#f7f2e8; --teal:#00a896; --sidebar:#1a0f2e; }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'DM Sans',sans-serif; background:#f0edf7; display:flex; min-height:100vh; overflow-x: hidden; }

        /* --- SIDEBAR & OVERLAY --- */
        .sidebar { width:260px; background:var(--sidebar); border-right:4px solid var(--ink); display:flex; flex-direction:column; position:fixed; top:0; left:0; height:100vh; z-index:100; overflow-y:auto; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-overlay { position: fixed; inset: 0; background: rgba(14, 11, 20, 0.7); z-index: 90; display: none; backdrop-filter: blur(4px); }
        
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
        .user-avatar { width:36px; height:36px; background:var(--punch); border-radius:50%; border:2px solid var(--ink); display:flex; align-items:center; justify-content:center; font-family:'Anton',sans-serif; color:white; font-size:0.9rem; }
        .user-name { font-weight:700; font-size:0.85rem; color:white; }
        .user-role { font-size:0.65rem; color:var(--yellow); text-transform:uppercase; letter-spacing:0.1em; font-weight:700; }
        .logout-btn { width:100%; background:transparent; border:2px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.5); font-family:'Anton',sans-serif; font-size:0.75rem; letter-spacing:0.1em; padding:0.6rem; cursor:pointer; transition:background 0.15s,color 0.15s; }
        .logout-btn:hover { background:var(--punch); color:white; border-color:var(--punch); }

        /* --- MAIN CONTENT --- */
        .main { margin-left:260px; flex:1; display:flex; flex-direction:column; min-height:100vh; transition: margin 0.3s ease; }
        .topbar { background:white; border-bottom:3px solid var(--ink); padding:1rem 2rem; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:20; }
        .topbar-title { font-family:'Anton',sans-serif; font-size:1.4rem; color:var(--purple); line-height: 1.2; }
        .topbar-breadcrumb { font-size:0.75rem; font-weight:600; color:rgba(14,11,20,0.4); margin-top:0.1rem; }
        .content { padding:2rem; flex:1; }

        /* --- MOBILE TOGGLE BUTTON --- */
        .menu-toggle { display: none; background: var(--yellow); border: 2px solid var(--ink); padding: 8px; cursor: pointer; box-shadow: 3px 3px 0 var(--ink); margin-right: 15px; }

        /* --- FORM ELEMENTS --- */
        .form-card { background:var(--cream); border:4px solid var(--ink); box-shadow:8px 8px 0 var(--ink); padding:2.5rem; max-width:800px; }
        label { display:block; font-weight:700; font-size:0.78rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--ink); margin-bottom:0.4rem; }
        label span { color:var(--punch); }
        .field { width:100%; border:3px solid var(--ink); background:white; padding:0.75rem 1rem; font-family:'DM Sans',sans-serif; font-weight:600; font-size:0.95rem; outline:none; transition:box-shadow 0.15s; color:var(--ink); }
        .field:focus { box-shadow:4px 4px 0 var(--purple); }
        textarea.field { resize:vertical; min-height:250px; line-height:1.7; }
        .field-group { margin-bottom:1.75rem; }
        .form-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
        .btn-submit { background:var(--purple); color:var(--yellow); font-family:'Anton',sans-serif; font-size:1rem; letter-spacing:0.08em; padding:0.9rem 2rem; border:3px solid var(--ink); box-shadow:5px 5px 0 var(--ink); cursor:pointer; transition:0.15s; }
        .btn-submit:hover { transform:translate(3px,3px); box-shadow:2px 2px 0 var(--ink); }
        .btn-cancel { font-family:'Anton',sans-serif; font-size:0.85rem; letter-spacing:0.08em; padding:0.9rem 1.5rem; border:3px solid var(--ink); background:white; color:var(--ink); text-decoration:none; display:inline-block; box-shadow:4px 4px 0 var(--ink); transition:0.15s; text-align: center; }

        /* --- MEDIA QUERIES (RESPONSIVE) --- */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .sidebar-overlay.active { display: block; }
            .main { margin-left: 0; }
            .menu-toggle { display: block; }
            .topbar { padding: 1rem; }
        }

        @media (max-width: 600px) {
            .form-grid-2 { grid-template-columns: 1fr; }
            .topbar-title { font-size: 1.1rem; }
            .topbar-breadcrumb { display: none; }
            .content { padding: 1rem; }
            .form-card { padding: 1.5rem; border-width: 3px; box-shadow: 4px 4px 0 var(--ink); }
            .btn-submit, .btn-cancel { width: 100%; margin-bottom: 0.5rem; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="overlay"></div>

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
            <a href="{{ route('admin.dashboard') }}" class="nav-item"><span class="nav-icon">📊</span> Dashboard</a>
            <a href="{{ route('admin.articles.index') }}" class="nav-item active"><span class="nav-icon">📰</span> Manajemen Artikel</a>
            <div class="nav-section-title">Site</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank"><span class="nav-icon">🌐</span> Lihat Website</a>
            <a href="{{ route('articles.index') }}" class="nav-item" target="_blank"><span class="nav-icon">📖</span> Halaman Blog</a>
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

    <div class="main">
        <div class="topbar">
            <div style="display: flex; align-items: center;">
                <button class="menu-toggle" id="btnToggle">☰</button>
                <div>
                    <div class="topbar-title">BUAT ARTIKEL</div>
                    <div class="topbar-breadcrumb">Admin / Artikel / Buat Baru</div>
                </div>
            </div>
            <a href="{{ route('admin.articles.index') }}" class="btn-cancel" style="box-shadow:none; padding: 0.5rem 0.8rem; font-size: 0.7rem;">← KEMBALI</a>
        </div>

        <div class="content">
            @if(session('success'))
                <div style="background:var(--teal); color:white; padding:1rem; border:3px solid var(--ink); margin-bottom:1.5rem; font-weight:700;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="form-card">
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="field-group">
                        <label for="title">Judul Artikel <span>*</span></label>
                        <input id="title" name="title" type="text" class="field" value="{{ old('title') }}" required maxlength="255" oninput="updateCharCount(this,'title-count',255)">
                        <div style="font-size:0.7rem; text-align:right; margin-top:5px;"><span id="title-count">0</span>/255</div>
                        @error('title') <p style="color:var(--punch); font-size:0.8rem; font-weight:700;">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-grid-2">
                        <div class="field-group">
                            <label for="category">Kategori <span>*</span></label>
                            <select id="category" name="category" class="field" required>
                                <option value="">-- Pilih --</option>
                                @foreach(['Digital Marketing','Social Media','SEO','Branding','Tips & Trick','Lainnya'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field-group">
                            <label for="status">Status <span>*</span></label>
                            <select id="status" name="status" class="field" required>
                                <option value="draft" {{ old('status','draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="field" accept="image/*" style="padding:0.4rem;">
                        @error('thumbnail') <p style="color:var(--punch); font-size:0.8rem;">{{ $message }}</p> @enderror
                    </div>

                    <div class="field-group">
                        <label for="content">Isi Artikel <span>*</span></label>
                        <textarea id="content" name="content" class="field" required oninput="updateCharCount(this,'content-count',null)">{{ old('content') }}</textarea>
                        <div style="font-size:0.7rem; text-align:right; margin-top:5px;"><span id="content-count">0</span> karakter</div>
                    </div>

                    <div style="display:flex; gap:1rem; flex-wrap:wrap;">
                        <button type="submit" class="btn-submit">SIMPAN ARTIKEL →</button>
                        <a href="{{ route('admin.articles.index') }}" class="btn-cancel">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Logika Sidebar Mobile
        const btnToggle = document.getElementById('btnToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        btnToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Penghitung Karakter
        function updateCharCount(el, counterId, max) {
            document.getElementById(counterId).textContent = el.value.length;
        }
        
        // Init counts
        window.onload = () => {
            updateCharCount(document.getElementById('title'), 'title-count', 255);
            updateCharCount(document.getElementById('content'), 'content-count', null);
        };
    </script>
</body>
</html>