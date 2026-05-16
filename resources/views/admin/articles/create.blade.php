{{-- resources/views/admin/articles/create.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Artikel — Admin KontenDigital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;600;700&family=Space+Grotesk:wght@500;700;900&family=Unbounded:wght@900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { 
            --ink: #000000; 
            --yellow: #FFD200; 
            --purple: #300066; 
            --punch: #e8402a; 
            --cream: #f7f2e8; 
            --teal: #00a896; 
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Space Grotesk', sans-serif; background: #f0edf7; display: flex; min-height: 100vh; overflow-x: hidden; }

        /* --- SIDEBAR & OVERLAY (Premium & Panjang Kebawah) --- */
        #sidebar { 
            position: fixed; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            width: 16rem; 
            background: var(--purple); 
            display: flex; 
            flex-direction: column; 
            border-right: 4px solid var(--ink); 
            z-index: 100; 
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .sidebar-overlay { 
            position: fixed; 
            inset: 0; 
            background: rgba(0, 0, 0, 0.6); 
            z-index: 90; 
            display: none; 
            backdrop-filter: blur(4px); 
        }
        
        .sidebar-logo-container { 
            padding: 1.5rem 1.25rem; 
            border-bottom: 4px solid var(--ink); 
            flex-shrink: 0; 
            background-color: rgba(0,0,0,0.05); 
        }
        .sidebar-logo-link { 
            display: flex; 
            align-items: center; 
            gap: 0.85rem; 
            text-decoration: none; 
        }
        .sidebar-logo-box { 
            width: 2.75rem; 
            height: 2.75rem; 
            background-color: var(--yellow); 
            border: 4px solid var(--ink); 
            border-radius: 0.5rem; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0; 
            box-shadow: 2px 2px 0px var(--ink); 
        }
        .sidebar-logo-title { 
            font-family: 'Unbounded', sans-serif; 
            color: #ffffff; 
            font-weight: 900; 
            font-size: 0.75rem; 
            letter-spacing: 0.08em; 
            text-transform: uppercase; 
            margin: 0; 
            line-height: 1.2; 
        }
        .sidebar-logo-sub { 
            color: rgba(255, 210, 0, 0.65); 
            font-size: 0.58rem; 
            font-weight: 700; 
            letter-spacing: 0.15em; 
            text-transform: uppercase; 
            margin: 0; 
            margin-top: 0.25rem; 
        }
        
        .sidebar-nav { 
            flex: 1 1 0%; 
            padding: 1.75rem 0.85rem; 
            overflow-y: auto; 
            display: flex; 
            flex-direction: column; 
            gap: 1.75rem; 
        }
        .sidebar-section-label { 
            color: rgba(255, 210, 0, 0.35); 
            font-size: 0.58rem; 
            font-weight: 900; 
            letter-spacing: 0.18em; 
            text-transform: uppercase; 
            padding: 0 0.75rem; 
            margin-bottom: 0.65rem; 
            margin-top: 0; 
        }
        .sidebar-link { 
            display: flex; 
            align-items: center; 
            gap: 0.85rem; 
            padding: 0.75rem 0.85rem; 
            font-size: 0.7rem; 
            font-weight: 900; 
            letter-spacing: 0.08em; 
            text-transform: uppercase; 
            color: rgba(255, 255, 255, 0.5); 
            border: 2px solid transparent; 
            text-decoration: none; 
            transition: all 0.2s ease-in-out; 
            border-radius: 4px; 
        }
        .sidebar-icon { 
            width: 1.15rem; 
            height: 1.15rem; 
            flex-shrink: 0; 
            transition: transform 0.2s ease-in-out; 
        }
        .sidebar-link:hover { 
            color: var(--yellow); 
            background: rgba(255, 210, 0, 0.06); 
            border-color: rgba(255, 210, 0, 0.2); 
        }
        .sidebar-link:hover .sidebar-icon { 
            transform: translateX(2px); 
        }
        .sidebar-link.active { 
            color: var(--yellow); 
            background: rgba(255, 210, 0, 0.12); 
            border-color: var(--yellow); 
        }
        .button-logout { 
            color: rgba(248, 113, 113, 0.7); 
        }
        .button-logout:hover { 
            color: #f87171 !important; 
            background: rgba(248, 113, 113, 0.1) !important; 
            border-color: rgba(248, 113, 113, 0.3) !important; 
        }
        
        .sidebar-footer { 
            border-top: 4px solid var(--ink); 
            padding: 1.25rem 1rem; 
            flex-shrink: 0; 
            background-color: rgba(0,0,0,0.15); 
        }
        .user-info { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0; }
        .user-avatar { 
            width: 2.5rem; 
            height: 2.5rem; 
            background-color: var(--yellow); 
            border: 2px solid var(--ink); 
            border-radius: 0.5rem; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            flex-shrink: 0; 
            box-shadow: 1.5px 1.5px 0px var(--ink); 
            font-weight: 900; 
            color: var(--ink); 
            font-size: 0.75rem; 
            letter-spacing: 0.05em; 
        }
        .user-name { color: #ffffff; font-weight: 700; font-size: 0.75rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; letter-spacing: 0.02em; }
        .user-role { color: rgba(255, 210, 0, 0.5); font-size: 0.62rem; font-weight: 500; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 0.1rem; }

        /* --- MAIN CONTENT --- */
        .main { margin-left: 16rem; flex: 1; display: flex; flex-direction: column; min-height: 100vh; transition: margin 0.3s ease; }
        .topbar { background: white; border-bottom: 4px solid var(--ink); padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 20; }
        .topbar-title { font-family: 'Anton', sans-serif; font-size: 1.4rem; color: var(--purple); line-height: 1.2; letter-spacing: 0.03em; }
        .topbar-breadcrumb { font-size: 0.75rem; font-weight: 600; color: rgba(14,11,20,0.4); margin-top: 0.1rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .content { padding: 2rem; flex: 1; }

        /* --- MOBILE TOGGLE BUTTON --- */
        .menu-toggle { display: none; background: var(--yellow); border: 2px solid var(--ink); padding: 8px; cursor: pointer; box-shadow: 3px 3px 0 var(--ink); margin-right: 15px; font-weight: bold; }

        /* --- FORM ELEMENTS --- */
        .form-card { background: var(--cream); border: 4px solid var(--ink); box-shadow: 8px 8px 0 var(--ink); padding: 2.5rem; max-width: 800px; }
        label { display: block; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--ink); margin-bottom: 0.4rem; }
        label span { color: var(--punch); }
        .field { width: 100%; border: 3px solid var(--ink); background: white; padding: 0.75rem 1rem; font-family: 'Space Grotesk', sans-serif; font-weight: 600; font-size: 0.95rem; outline: none; transition: box-shadow 0.15s; color: var(--ink); }
        .field:focus { box-shadow: 4px 4px 0 var(--purple); }
        textarea.field { resize: vertical; min-height: 250px; line-height: 1.7; }
        .field-group { margin-bottom: 1.75rem; }
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
        .btn-submit { background: var(--purple); color: var(--yellow); font-family: 'Space Grotesk', sans-serif; font-weight: 900; font-size: 1rem; letter-spacing: 0.08em; padding: 0.9rem 2rem; border: 3px solid var(--ink); box-shadow: 5px 5px 0 var(--ink); cursor: pointer; transition: 0.15s; text-transform: uppercase; }
        .btn-submit:hover { transform: translate(3px,3px); box-shadow: 2px 2px 0 var(--ink); }
        .btn-cancel { font-family: 'Space Grotesk', sans-serif; font-weight: 900; font-size: 0.85rem; letter-spacing: 0.08em; padding: 0.9rem 1.5rem; border: 3px solid var(--ink); background: white; color: var(--ink); text-decoration: none; display: inline-block; box-shadow: 4px 4px 0 var(--ink); transition: 0.15s; text-align: center; text-transform: uppercase; }
        .btn-cancel:hover { transform: translate(2px,2px); box-shadow: 2px 2px 0 var(--ink); }

        /* --- MEDIA QUERIES (RESPONSIVE) --- */
        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.active { transform: translateX(0); }
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

    {{-- ── PREMIUM MODERN SIDEBAR ── --}}
    <aside id="sidebar">
        <div class="sidebar-logo-container">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo-link">
                {{-- Ganti bagian logo box lama dengan ini --}}
<div class="sidebar-logo-box">
    <img src="{{ asset('images/hikeandpeak.png') }}" style="width: 30px; height: 30px; object-fit: contain;" alt="Logo">
</div>
                <div>
                    <div class="sidebar-logo-title">HNP Communications</div>
                    <div class="sidebar-logo-sub">Admin Panel</div>
                </div>
            </a>
        </div>

        <nav class="sidebar-nav">
            {{-- Kelompok: MAIN MENU --}}
            <div>
                <p class="sidebar-section-label">Main Menu</p>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.35rem;">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles.index') }}" class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                            <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Manajemen Artikel
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Kelompok: SITE --}}
            <div>
                <p class="sidebar-section-label">Site</p>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.35rem;">
                    <li>
                        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                            <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Lihat Website
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}" target="_blank" class="sidebar-link">
                            <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            Halaman Blog
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info" style="margin-bottom: 1rem;">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
                <div style="min-width:0; flex:1 1 0%;">
                    <div class="user-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="sidebar-link button-logout" style="width: 100%; text-align: left; background: transparent; cursor: pointer;">
                    <svg class="sidebar-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ── MAIN AREA ── --}}
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