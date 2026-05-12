@extends('layouts.admin.app')
@section('title', 'Dashboard')

@section('content')
<div class="p-6 lg:p-8">

    {{-- Welcome Bar --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="font-black text-2xl uppercase tracking-tight" style="font-family:'Unbounded',sans-serif">Dashboard</h1>
            <p class="text-sm text-gray-500 font-medium mt-1">
                Selamat datang kembali, <span class="font-black text-purple-900">{{ auth()->user()->name }}</span> 👋
            </p>
        </div>
        <div class="flex items-center gap-3">
            @if($contactCounts['new'] > 0)
            <a href="{{ route('admin.contacts.index') }}"
               class="bg-red-500 text-white border-4 border-black font-black text-xs uppercase tracking-widest
                      px-5 py-2.5 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                      hover:shadow-none transition-all whitespace-nowrap">
                🔔 {{ $contactCounts['new'] }} PESAN BARU
            </a>
            @endif
            <a href="{{ route('admin.articles.create') }}"
               class="bg-yellow-400 border-4 border-black font-black text-xs uppercase tracking-widest
                      px-5 py-2.5 shadow-[4px_4px_0_#000] hover:translate-x-1 hover:translate-y-1
                      hover:shadow-none transition-all whitespace-nowrap">
                + ARTIKEL BARU
            </a>
        </div>
    </div>

    {{-- ── STATS ARTIKEL ────────────────────────────────────────────── --}}
    <p class="font-black text-[0.65rem] uppercase tracking-[0.2em] text-gray-400 mb-3">Artikel</p>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="bg-yellow-400 border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-black/50 mb-2">Total Artikel</p>
            <p class="font-black text-5xl" style="font-family:'Unbounded',sans-serif">{{ $stats['total_articles'] }}</p>
        </div>

        <div class="bg-white border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-black/50 mb-2">Published</p>
            <p class="font-black text-5xl text-teal-500" style="font-family:'Unbounded',sans-serif">{{ $stats['published_articles'] }}</p>
        </div>

        <div class="bg-purple-950 border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-white/50 mb-2">Draft</p>
            <p class="font-black text-5xl text-white" style="font-family:'Unbounded',sans-serif">{{ $stats['draft_articles'] }}</p>
        </div>

        <div class="bg-red-500 border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-white/70 mb-2">Total Users</p>
            <p class="font-black text-5xl text-white" style="font-family:'Unbounded',sans-serif">{{ $stats['total_users'] }}</p>
        </div>
    </div>

    {{-- ── STATS PESAN ──────────────────────────────────────────────── --}}
    <p class="font-black text-[0.65rem] uppercase tracking-[0.2em] text-gray-400 mb-3">Pesan Masuk</p>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="bg-blue-800 border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-white/60 mb-2">Total Pesan</p>
            <p class="font-black text-5xl text-white" style="font-family:'Unbounded',sans-serif">{{ $contactCounts['all'] }}</p>
        </div>

        <div class="bg-blue-500 border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-white/60 mb-2">Baru</p>
            <p class="font-black text-5xl text-white" style="font-family:'Unbounded',sans-serif">{{ $contactCounts['new'] }}</p>
        </div>

        <div class="bg-yellow-400 border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-black/50 mb-2">Diproses</p>
            <p class="font-black text-5xl" style="font-family:'Unbounded',sans-serif">{{ $contactCounts['in_progress'] }}</p>
        </div>

        <div class="bg-teal-500 border-4 border-black shadow-[5px_5px_0_#000] p-5">
            <p class="font-black text-[0.65rem] uppercase tracking-widest text-white/70 mb-2">Selesai</p>
            <p class="font-black text-5xl text-white" style="font-family:'Unbounded',sans-serif">{{ $contactCounts['resolved'] }}</p>
        </div>
    </div>

    {{-- ── TABEL BAWAH ──────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Artikel Terbaru --}}
        <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b-4 border-black">
                <h2 class="font-black text-sm uppercase tracking-widest" style="font-family:'Unbounded',sans-serif">Artikel Terbaru</h2>
                <a href="{{ route('admin.articles.index') }}"
                   class="bg-white border-2 border-black font-black text-[10px] uppercase tracking-widest
                          px-3 py-1.5 shadow-[3px_3px_0_#000] hover:translate-x-0.5 hover:translate-y-0.5
                          hover:shadow-[2px_2px_0_#000] transition-all">
                    SEMUA →
                </a>
            </div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-purple-950 text-yellow-400">
                        <th class="px-4 py-3 text-left font-black text-[10px] uppercase tracking-widest">Judul</th>
                        <th class="px-4 py-3 text-left font-black text-[10px] uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/10">
                    @forelse($latestArticles as $article)
                    <tr class="hover:bg-yellow-400/10 transition-colors">
                        <td class="px-4 py-3 font-semibold text-xs">{{ Str::limit($article->title, 45) }}</td>
                        <td class="px-4 py-3">
                            @if($article->status === 'published')
                            <span class="inline-block bg-teal-100 text-teal-700 border border-teal-400 font-black text-[10px] uppercase px-2 py-0.5">
                                PUBLISHED
                            </span>
                            @else
                            <span class="inline-block bg-yellow-100 text-yellow-700 border border-yellow-400 font-black text-[10px] uppercase px-2 py-0.5">
                                DRAFT
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-4 py-10 text-center text-gray-400 font-bold text-sm">
                            Belum ada artikel.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pesan Terbaru --}}
        <div class="bg-white border-4 border-black shadow-[6px_6px_0_#000] overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b-4 border-black">
                <h2 class="font-black text-sm uppercase tracking-widest" style="font-family:'Unbounded',sans-serif">Pesan Terbaru</h2>
                <a href="{{ route('admin.contacts.index') }}"
                   class="bg-white border-2 border-black font-black text-[10px] uppercase tracking-widest
                          px-3 py-1.5 shadow-[3px_3px_0_#000] hover:translate-x-0.5 hover:translate-y-0.5
                          hover:shadow-[2px_2px_0_#000] transition-all">
                    SEMUA →
                </a>
            </div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-purple-950 text-yellow-400">
                        <th class="px-4 py-3 text-left font-black text-[10px] uppercase tracking-widest">Nama</th>
                        <th class="px-4 py-3 text-left font-black text-[10px] uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/10">
                    @forelse($latestContacts as $contact)
                    @php $badge = $contact->statusBadge(); @endphp
                    <tr class="hover:bg-yellow-400/10 transition-colors">
                        <td class="px-4 py-3 font-semibold text-xs">
                            @if(!$contact->isRead())
                            <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-2 mb-0.5"></span>
                            @endif
                            {{ $contact->name }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block font-black text-[10px] uppercase px-2 py-0.5 border {{ $badge['class'] }}">
                                {{ $badge['label'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-4 py-10 text-center text-gray-400 font-bold text-sm">
                            Belum ada pesan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection