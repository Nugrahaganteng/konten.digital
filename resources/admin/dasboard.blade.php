{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <p class="section-eyebrow mb-1">Selamat Datang Kembali</p>
            <h1 class="font-serif-display font-bold text-ink text-4xl">Dashboard Admin</h1>
        </div>
        <div class="text-right">
            <p class="font-typewriter text-sepia text-xs tracking-widest">{{ now()->format('l, d F Y') }}</p>
            <p class="font-mono text-ink/40 text-xs">{{ now()->format('H:i') }} WIB</p>
        </div>
    </div>

    <div class="divider-retro"><span>✦</span></div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach([
            ['Pesanan Masuk','128','↑ 12% bulan ini','rust'],
            ['Press Release Tayang','1,045','Total terbit','sage'],
            ['Media Partner','200+','Aktif','sepia'],
            ['Klien Aktif','87','Bulan ini','burgundy'],
        ] as [$label, $val, $sub, $color])
        <div class="card-retro p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-16 h-16 border-b-2 border-l-2 border-gold/20 -mr-2 -mt-2"></div>
            <p class="font-typewriter text-{{ $color }} text-xs tracking-widest uppercase mb-2">{{ $label }}</p>
            <p class="font-display text-ink text-4xl leading-none mb-1">{{ $val }}</p>
            <p class="font-mono text-ink/40 text-xs">{{ $sub }}</p>
        </div>
        @endforeach
    </div>

    {{-- Recent Orders + Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Orders --}}
        <div class="lg:col-span-2 card-retro p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="font-serif-display font-bold text-ink text-xl">Pesanan Terbaru</h3>
                <a href="{{ route('admin.orders') }}" class="btn-retro btn-retro-outline text-xs py-1 px-4">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gold/30">
                            @foreach(['#ID','Klien','Layanan','Status','Tanggal'] as $h)
                            <th class="font-typewriter text-sepia text-xs tracking-widest text-left py-2 pr-4">{{ $h }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gold/10">
                        @foreach([
                            ['#1042','PT Maju Jaya','Press Release','Tayang','2 jam lalu'],
                            ['#1041','Startup XYZ','Backlink Media','Proses','5 jam lalu'],
                            ['#1040','Brand ABC','Penulisan Artikel','Revisi','Kemarin'],
                            ['#1039','CV Sejahtera','Press Release','Tayang','Kemarin'],
                            ['#1038','Tokopedia','Press Conference','Selesai','2 hari lalu'],
                        ] as [$id, $client, $svc, $status, $date])
                        <tr class="hover:bg-gold/5 transition-colors">
                            <td class="font-mono text-gold text-sm py-3 pr-4">{{ $id }}</td>
                            <td class="font-mono text-ink text-sm py-3 pr-4">{{ $client }}</td>
                            <td class="font-mono text-ink-light text-sm py-3 pr-4">{{ $svc }}</td>
                            <td class="py-3 pr-4">
                                @php
                                $colors = ['Tayang'=>'sage','Proses'=>'sepia','Revisi'=>'rust','Selesai'=>'burgundy'];
                                $c = $colors[$status] ?? 'sepia';
                                @endphp
                                <span class="font-typewriter text-{{ $c }} text-xs tracking-widest border border-{{ $c }}/40 px-2 py-0.5">{{ $status }}</span>
                            </td>
                            <td class="font-mono text-ink/40 text-xs py-3">{{ $date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="space-y-4">
            <div class="card-retro p-5">
                <h4 class="font-serif-display font-bold text-ink text-lg mb-4">Aksi Cepat</h4>
                <div class="space-y-3">
                    @foreach([
                        [route('admin.orders.create'),'+ Buat Pesanan Baru'],
                        [route('admin.media.index'),'◈ Kelola Media'],
                        [route('admin.articles.index'),'✦ Buat Artikel'],
                        [route('admin.reports.index'),'◉ Laporan Tayang'],
                    ] as [$href, $label])
                    <a href="{{ $href }}" class="btn-retro btn-retro-outline w-full text-center text-xs py-2 block">{{ $label }}</a>
                    @endforeach
                </div>
            </div>

            <div class="card-retro p-5 bg-ink">
                <h4 class="font-serif-display font-bold text-gold text-lg mb-3">Tip Hari Ini</h4>
                <div class="divider-retro mb-3"><span class="text-gold/40">✦</span></div>
                <p class="font-mono text-cream/70 text-xs leading-relaxed">
                    Press release dengan angle berita yang kuat dan newsworthy memiliki kemungkinan terbit 3x lebih tinggi di media tier-1.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection