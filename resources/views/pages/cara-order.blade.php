{{-- resources/views/pages/cara-order.blade.php --}}
@extends('layouts.app')

@section('title', 'Cara Order - KontenDigital.id')

@section('content')

{{-- ── HERO SECTION ────────────────────────────────────────── --}}
<section class="bg-[#F2B038] border-b-8 border-black pt-32 pb-20 relative overflow-hidden">
    {{-- Dekorasi Latar Belakang --}}
    <div class="absolute top-10 right-10 w-40 h-40 bg-black/10 border-4 border-black rotate-12 hidden md:block"></div>
    <div class="absolute bottom-0 left-16 w-24 h-24 bg-red-500 border-4 border-black -rotate-6 opacity-30 hidden md:block"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl">
            <div class="inline-block bg-black text-[#F2B038] font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-6">
                Panduan Pemesanan
            </div>
            <h1 class="font-black text-5xl md:text-8xl leading-none uppercase text-black mb-6 tracking-tighter">
                ALUR KERJA<br><span class="text-white [-webkit-text-stroke:2px_black]">ORDER</span>
            </h1>
            <p class="font-bold text-xl text-black/80 max-w-xl leading-relaxed">
                Kami memastikan setiap langkah pengerjaan Press Release dilakukan secara profesional dan transparan agar pesan Anda sampai ke audiens yang tepat.
            </p>
        </div>
    </div>
</section>

{{-- ── 10 STEPS WORKFLOW (DATA DARI SCREENSHOT) ──────────────── --}}
<section class="bg-white border-b-8 border-black py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="font-black text-4xl md:text-6xl uppercase text-black italic">
                10 Langkah <span class="text-[#3B82F6]">Pemesanan</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @php
                $steps = [
                    [
                        'no' => '01',
                        'title' => 'Konsultasi',
                        'desc' => 'Konsultasikan rencana, tujuan, dan materi press release Anda. CSR? Launching produk? Event? Program kegiatan? Artis? Selebgram? Rebranding? Semua bisa.',
                        'bg' => 'bg-white',
                        'text' => 'text-black'
                    ],
                    [
                        'no' => '02',
                        'title' => 'Pilih Paket Press Release',
                        'desc' => 'Anda bisa memilih paket layanan press release sesuai kebutuhan Anda.',
                        'bg' => 'bg-[#3B82F6]',
                        'text' => 'text-white'
                    ],
                    [
                        'no' => '03',
                        'title' => 'Isi Form Order',
                        'desc' => 'Isi form order yang kami kirimkan melalui WhatsApp.',
                        'bg' => 'bg-white',
                        'text' => 'text-black'
                    ],
                    [
                        'no' => '04',
                        'title' => 'Invoice',
                        'desc' => 'Setelah Anda mengisi form order, kami akan mengirimkan invoice untuk Anda.',
                        'bg' => 'bg-black',
                        'text' => 'text-white' // DIPERBAIKI: Text putih di bg hitam
                    ],
                    [
                        'no' => '05',
                        'title' => 'Pembayaran',
                        'desc' => 'Silakan lakukan pembayaran sesuai dengan invoice yang kami kirimkan. Setelah pembayaran kami terima, pesanan akan kami proses sesuai antrian.',
                        'bg' => 'bg-[#F2B038]',
                        'text' => 'text-black'
                    ],
                    [
                        'no' => '06',
                        'title' => 'Siapkan Materi Press Release',
                        'desc' => 'Kirimkan artikel atau naskah press release yang sudah Anda siapkan. Jika belum ada, koordinasikan pembuatannya dengan kami.',
                        'bg' => 'bg-white',
                        'text' => 'text-black'
                    ],
                    [
                        'no' => '07',
                        'title' => 'Wawancara & Pembuatan Artikel',
                        'desc' => 'Jika Anda belum punya materi, kami akan membantu Anda dalam pembuatan artikelnya. Kami akan melakukan wawancara dan melanjutkannya dengan pembuatan artikel.',
                        'bg' => 'bg-red-500',
                        'text' => 'text-white'
                    ],
                    [
                        'no' => '08',
                        'title' => 'Review & Persetujuan Klien',
                        'desc' => 'Kami akan mengirimkan draft artikel yang kami buat untuk Anda review lebih dahulu.',
                        'bg' => 'bg-white',
                        'text' => 'text-black'
                    ],
                    [
                        'no' => '09',
                        'title' => 'Penerbitan Artikel ke Media',
                        'desc' => 'Kami akan menerbitkan artikel Anda di media online sesuai dengan pilihan Anda atau alternatif yang kami berikan.',
                        'bg' => 'bg-[#3B82F6]',
                        'text' => 'text-white'
                    ],
                    [
                        'no' => '10',
                        'title' => 'Monitoring & Laporan Link URL',
                        'desc' => 'Kami akan melakukan monitoring dan mengirimkan report berupa tautan atau link pemberitaan yang sudah tayang di media online.',
                        'bg' => 'bg-black',
                        'text' => 'text-white' // DIPERBAIKI: Text putih di bg hitam
                    ],
                ];
            @endphp

            @foreach($steps as $step)
            <div class="border-4 border-black {{ $step['bg'] }} p-8 relative shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:-translate-y-1 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all">
                <div class="flex items-start gap-6">
                    <span class="font-black text-4xl {{ $step['text'] }} opacity-30 tracking-tighter">{{ $step['no'] }}</span>
                    <div>
                        <h3 class="font-black text-2xl uppercase mb-3 leading-tight {{ $step['text'] }}">{{ $step['title'] }}</h3>
                        <p class="font-bold leading-relaxed {{ $step['text'] }} {{ $step['text'] === 'text-white' ? 'opacity-90' : 'text-black/70' }}">
                            {{ $step['desc'] }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA ──────────────────────────────────────────────────── --}}
<section class="bg-black border-b-8 border-black py-24">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="font-black text-4xl md:text-7xl uppercase text-white leading-none mb-10 tracking-tighter">
            MULAI PROMOSI <span class="text-[#F2B038]">SEKARANG!</span>
        </h2>
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="https://api.whatsapp.com/send?phone=6287786000919"
               class="bg-[#F2B038] text-black font-black text-lg uppercase tracking-widest px-10 py-5 border-4 border-black shadow-[6px_6px_0px_0px_rgba(255,255,255,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                Order via WhatsApp →
            </a>
        </div>
    </div>
</section>

@endsection