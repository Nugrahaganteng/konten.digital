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

    {{-- Recent Orders + Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Orders --}}
        <div class="lg:col-span-2 card-retro p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-black text-xl text-black uppercase tracking-tight"
                    style="font-family:'Unbounded',sans-serif">Pesanan Terbaru</h3>
                <a href="{{ route('admin.orders') }}"
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
                            @foreach(['#ID','Klien','Layanan','Status','Tanggal'] as $h)
                            <th class="font-black text-xs tracking-widest text-left pb-3 pr-4 uppercase">
                                {{ $h }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black/10">
                        @foreach([
                            ['#1042','PT Maju Jaya',  'Press Release',     'Tayang',  '2 jam lalu'],
                            ['#1041','Startup XYZ',   'Backlink Media',    'Proses',  '5 jam lalu'],
                            ['#1040','Brand ABC',     'Penulisan Artikel', 'Revisi',  'Kemarin'],
                            ['#1039','CV Sejahtera',  'Press Release',     'Tayang',  'Kemarin'],
                            ['#1038','Tokopedia',     'Press Conference',  'Selesai', '2 hari lalu'],
                        ] as [$id, $client, $svc, $status, $date])
                        <tr class="hover:bg-yellow-400/20 transition-colors">
                            <td class="font-black text-yellow-600 text-sm py-3 pr-4">{{ $id }}</td>
                            <td class="font-bold text-black text-sm py-3 pr-4">{{ $client }}</td>
                            <td class="font-bold text-black/60 text-sm py-3 pr-4">{{ $svc }}</td>
                            <td class="py-3 pr-4">
                                @php
                                $badges = [
                                    'Tayang'  => 'bg-green-400  text-black',
                                    'Proses'  => 'bg-yellow-400 text-black',
                                    'Revisi'  => 'bg-red-400    text-white',
                                    'Selesai' => 'bg-purple-950 text-white',
                                ];
                                $badge = $badges[$status] ?? 'bg-black text-white';
                                @endphp
                                <span class="font-black text-xs tracking-widest uppercase
                                             border-2 border-black px-2 py-0.5 {{ $badge }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="font-bold text-black/40 text-xs py-3">{{ $date }}</td>
                        </tr>
                        @endforeach
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
                    @foreach([
                        [route('admin.orders.create'),   '+ Buat Pesanan Baru'],
                        [route('admin.media.index'),     '◈ Kelola Media'],
                        [route('admin.articles.index'),  '✦ Buat Artikel'],
                        [route('admin.reports.index'),   '◉ Laporan Tayang'],
                    ] as [$href, $label])
                    <a href="{{ $href }}"
                       class="block w-full text-center border-4 border-black bg-white text-black
                              font-black text-xs uppercase tracking-widest px-4 py-3 shadow-neo-sm
                              hover:bg-yellow-400 hover:translate-y-0.5 hover:shadow-none transition-all">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Tip Card --}}
            <div class="border-4 border-black bg-purple-950 p-6">
                <h4 class="font-black text-yellow-400 text-lg uppercase tracking-tight mb-3"
                    style="font-family:'Unbounded',sans-serif">Tip Hari Ini</h4>
                <div class="divider-neo opacity-30 mb-4"><span class="text-yellow-400">✦</span></div>
                <p class="text-white/70 text-xs leading-relaxed font-bold">
                    Press release dengan angle berita yang kuat dan newsworthy memiliki kemungkinan terbit 3x lebih tinggi di media tier-1.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection