{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <p class="section-eyebrow mb-1">Selamat Datang Kembali</p>
            <h1 class="font-black text-4xl text-black leading-none"
                style="font-family:'Unbounded',sans-serif">Dashboard Admin</h1>
        </div>
        <div class="text-right">
            <p class="font-bold text-black/50 text-xs tracking-widest uppercase">
                {{ now()->format('l, d F Y') }}
            </p>
            <p class="font-bold text-black/30 text-xs">{{ now()->format('H:i') }} WIB</p>
        </div>
    </div>

    <div class="divider-neo"><span>✦</span></div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach([
            ['Pesanan Masuk',   '128',   '↑ 12% bulan ini', 'bg-red-500',    'text-white'],
            ['Press Release',   '1,045', 'Total terbit',    'bg-yellow-400', 'text-black'],
            ['Media Partner',   '200+',  'Aktif',           'bg-purple-950', 'text-white'],
            ['Klien Aktif',     '87',    'Bulan ini',       'bg-black',      'text-yellow-400'],
        ] as [$label, $val, $sub, $bg, $textColor])
        <div class="border-4 border-black {{ $bg }} p-6 shadow-neo-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-12 h-12 border-b-4 border-l-4 border-black/20"></div>
            <p class="font-black text-xs tracking-widest uppercase {{ $textColor }} opacity-70 mb-2">
                {{ $label }}
            </p>
            <p class="font-black text-4xl leading-none {{ $textColor }} mb-1"
               style="font-family:'Unbounded',sans-serif">{{ $val }}</p>
            <p class="font-bold text-xs {{ $textColor }} opacity-50">{{ $sub }}</p>
        </div>
        @endforeach
    </div>

    {{-- Recent Articles + Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Articles (pakai route yang sudah ada) --}}
        <div class="lg:col-span-2 card-retro p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-black text-xl text-black uppercase tracking-tight"
                    style="font-family:'Unbounded',sans-serif">Artikel Terbaru</h3>
                <a href="{{ route('admin.articles.index') }}"
                   class="border-4 border-black bg-white text-black font-black text-xs
                          uppercase tracking-widest px-4 py-2 shadow-neo-sm
                          hover:bg-yellow-400 hover:translate-y-0.5 hover:shadow-none transition-all">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-4 border-black">
                            @foreach(['#','Judul','Status','Tanggal']) as $h)
                            <th class="font-black text-xs tracking-widest text-left pb-3 pr-4 uppercase">
                                {{ $h }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black/10">
                        {{-- Data artikel dari database --}}
                        @forelse(\App\Models\Article::latest()->take(5)->get() as $article)
                        <tr class="hover:bg-yellow-400/20 transition-colors">
                            <td class="font-black text-yellow-600 text-sm py-3 pr-4">
                                #{{ $article->id }}
                            </td>
                            <td class="font-bold text-black text-sm py-3 pr-4 max-w-[200px] truncate">
                                {{ $article->title }}
                            </td>
                            <td class="py-3 pr-4">
                                @php
                                $badges = [
                                    'published' => 'bg-green-400 text-black',
                                    'draft'     => 'bg-yellow-400 text-black',
                                    'rejected'  => 'bg-red-400 text-white',
                                ];
                                $badge = $badges[$article->status] ?? 'bg-black text-white';
                                @endphp
                                <span class="font-black text-xs tracking-widest uppercase
                                             border-2 border-black px-2 py-0.5 {{ $badge }}">
                                    {{ $article->status }}
                                </span>
                            </td>
                            <td class="font-bold text-black/40 text-xs py-3">
                                {{ $article->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="text-4xl mb-2">📝</div>
                                <p class="font-black text-black/40 text-sm uppercase tracking-widest">
                                    Belum ada artikel
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="space-y-4">
            <div class="card-retro p-6">
                <h4 class="font-black text-lg text-black uppercase tracking-tight mb-4"
                    style="font-family:'Unbounded',sans-serif">Aksi Cepat</h4>
                <div class="space-y-3">

                    {{-- Route yang sudah ada --}}
                    <a href="{{ route('admin.articles.index') }}"
                       class="block w-full text-center border-4 border-black bg-white text-black
                              font-black text-xs uppercase tracking-widest px-4 py-3 shadow-neo-sm
                              hover:bg-yellow-400 hover:translate-y-0.5 hover:shadow-none transition-all">
                        ✦ Kelola Artikel
                    </a>

                    <a href="{{ route('articles.create') }}"
                       class="block w-full text-center border-4 border-black bg-white text-black
                              font-black text-xs uppercase tracking-widest px-4 py-3 shadow-neo-sm
                              hover:bg-yellow-400 hover:translate-y-0.5 hover:shadow-none transition-all">
                        ✏ Tulis Artikel Baru
                    </a>

                    {{-- Route belum ada — Coming Soon --}}
                    @foreach([
                        ['+ Kelola Pesanan'],
                        ['◈ Kelola Media'],
                        ['◉ Laporan Tayang'],
                    ] as [$label])
                    <div class="relative">
                        <div class="block w-full text-center border-4 border-black/30 bg-white/50
                                    text-black/30 font-black text-xs uppercase tracking-widest
                                    px-4 py-3 cursor-not-allowed select-none">
                            {{ $label }}
                        </div>
                        <span class="absolute -top-2 -right-2 bg-black text-yellow-400 font-black
                                     text-[9px] uppercase tracking-widest px-2 py-0.5 border-2 border-black">
                            Soon
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Tip Card --}}
            <div class="border-4 border-black bg-purple-950 p-6">
                <h4 class="font-black text-yellow-400 text-lg uppercase tracking-tight mb-3"
                    style="font-family:'Unbounded',sans-serif">Tip Hari Ini</h4>
                <div class="divider-neo opacity-30 mb-4">
                    <span class="text-yellow-400">✦</span>
                </div>
                <p class="text-white/70 text-xs leading-relaxed font-bold">
                    Press release dengan angle berita yang kuat dan newsworthy memiliki kemungkinan terbit 3x lebih tinggi di media tier-1.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection