<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body: ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        ink: '#111118',
                        sidebar: '#0d0d14',
                        accent: '#e8402a',
                        muted: '#6b7280',
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        /* Sidebar active link */
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm text-white/60 hover:text-white hover:bg-white/8 transition-all; }
        .sidebar-link.active { @apply bg-accent/20 text-accent font-semibold; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #0d0d14; }
        ::-webkit-scrollbar-thumb { background: #e8402a; border-radius: 2px; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp .4s ease forwards; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#f5f5f0] min-h-screen flex">

{{-- ═══════════════════════════════ SIDEBAR ═══════════════════════════════ --}}
<aside id="sidebar" class="w-64 bg-sidebar flex-shrink-0 flex flex-col fixed inset-y-0 left-0 z-40 transition-transform duration-300 md:translate-x-0 -translate-x-full">

    {{-- Logo --}}
    <div class="px-6 py-5 border-b border-white/8">
        <a href="{{ route('admin.dashboard') }}" class="font-display font-black text-xl text-white">
            My<span class="text-accent">Blog</span>
            <span class="text-xs font-body font-normal text-white/40 ml-2">Admin</span>
        </a>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
        <p class="text-white/25 text-xs font-semibold uppercase tracking-widest px-4 mb-3">Menu</p>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('admin.articles.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Artikel
            @php $pendingCount = \App\Models\Article::where('status','draft')->count(); @endphp
            @if($pendingCount > 0)
                <span class="ml-auto bg-accent text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
            @endif
        </a>

        <a href="{{ route('articles.create') }}"
           class="sidebar-link">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
            </svg>
            Tulis Artikel
        </a>

        <div class="pt-4">
            <p class="text-white/25 text-xs font-semibold uppercase tracking-widest px-4 mb-3">Akun</p>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Blog
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left text-red-400 hover:text-red-300 hover:bg-red-500/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </nav>

    {{-- User info --}}
    <div class="px-4 py-4 border-t border-white/8">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-accent/20 flex items-center justify-center text-accent font-bold text-sm">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                <p class="text-white/40 text-xs truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>
</aside>

{{-- Sidebar overlay (mobile) --}}
<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/50 z-30 md:hidden" onclick="toggleSidebar()"></div>

{{-- ═══════════════════════════════ MAIN ═══════════════════════════════ --}}
<div class="flex-1 md:ml-64 flex flex-col min-h-screen">

    {{-- Topbar --}}
    <header class="bg-white border-b border-ink/8 px-6 h-14 flex items-center justify-between sticky top-0 z-20">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg hover:bg-ink/5 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h1 class="font-semibold text-ink text-base">@yield('title', 'Dashboard')</h1>
                @hasSection('breadcrumb')
                    <p class="text-muted text-xs">@yield('breadcrumb')</p>
                @endif
            </div>
        </div>
        <span class="text-xs text-muted">{{ now()->format('d M Y') }}</span>
    </header>

    {{-- Flash --}}
    @if(session('success'))
        <div class="mx-6 mt-4 fade-up">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center justify-between text-sm">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </span>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-600">✕</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mx-6 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center justify-between text-sm">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.parentElement.remove()">✕</button>
            </div>
        </div>
    @endif

    {{-- Page content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>

@stack('scripts')
</body>
</html>
