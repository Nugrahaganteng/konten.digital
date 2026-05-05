{{-- resources/views/pages/cara-order.blade.php --}}
@extends('layouts.app')

@section('title', 'Cara Order - KontenDigital.id')

@section('content')

{{-- ── HERO SECTION ────────────────────────────────────────── --}}
<section class="bg-[#FFD200] border-b-8 border-black pt-32 pb-24 relative overflow-hidden">
    {{-- Dekorasi Latar Belakang SVG --}}
  

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="max-w-3xl">
            <div class="inline-block bg-[#3D0066] text-white font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-6 transform -rotate-1">
                ✦ Panduan Pemesanan
            </div>
            <h1 class="font-black text-6xl md:text-8xl leading-[0.9] uppercase text-[#3D0066] mb-8 tracking-tighter">
                ALUR KERJA<br><span class="bg-black text-[#FFD200] px-4 inline-block transform rotate-1">ORDER</span>
            </h1>
            <div class="border-l-4 border-black pl-4 py-2 mb-8">
                <p class="font-bold text-xl text-black italic leading-tight">
                    "Proses transparan, hasil maksimal untuk pesan Anda."
                </p>
            </div>
            <p class="font-bold text-lg text-black/80 max-w-xl leading-relaxed">
                Kami memastikan setiap langkah pengerjaan Press Release dilakukan secara profesional agar pesan Anda sampai ke audiens yang tepat melalui media ternama.
            </p>
        </div>

        {{-- Visual Side (Sama seperti halaman lainnya) --}}
        <div class="relative flex justify-center items-center h-[450px]">
            <div class="absolute w-[380px] h-[380px] border-[6px] border-black rounded-[40px] -translate-x-4 -translate-y-4"></div>
            <div class="relative w-[350px] h-[350px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                <img src="/images/order1.png" alt="Cara Order" 
                     class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
                
                {{-- Floating Tailwind Icon --}}
                <div class="absolute -top-10 -right-5 bg-[#3D0066] text-white border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform rotate-12">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── 10 STEPS WORKFLOW ──────────────── --}}
<section class="bg-white border-b-8 border-black py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="font-black text-5xl md:text-7xl uppercase text-[#3D0066] italic tracking-tighter">
                10 Langkah <span class="bg-[#FFD200] text-black px-4 not-italic">Pemesanan</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $steps = [
                    ['no' => '01', 'title' => 'Konsultasi', 'desc' => 'Konsultasikan rencana, tujuan, dan materi press release Anda. Semua jenis event dan branding bisa.', 'bg' => 'bg-white', 'text' => 'text-black'],
                    ['no' => '02', 'title' => 'Pilih Paket', 'desc' => 'Pilih paket layanan press release yang paling sesuai dengan target audiens dan budget Anda.', 'bg' => 'bg-[#3D0066]', 'text' => 'text-white'],
                    ['no' => '03', 'title' => 'Isi Form Order', 'desc' => 'Lengkapi data detail pemesanan melalui form praktis yang kami kirimkan via WhatsApp.', 'bg' => 'bg-white', 'text' => 'text-black'],
                    ['no' => '04', 'title' => 'Invoice', 'desc' => 'Kami akan mengirimkan rincian biaya resmi (invoice) setelah form order kami validasi.', 'bg' => 'bg-black', 'text' => 'text-white'],
                    ['no' => '05', 'title' => 'Pembayaran', 'desc' => 'Lakukan pembayaran. Pesanan Anda segera masuk antrian prioritas produksi kami.', 'bg' => 'bg-[#FFD200]', 'text' => 'text-black'],
                    ['no' => '06', 'title' => 'Materi Press', 'desc' => 'Kirimkan draf artikel Anda. Jika belum ada, tim kami siap membantu koordinasi konten.', 'bg' => 'bg-white', 'text' => 'text-black'],
                    ['no' => '07', 'title' => 'Wawancara', 'desc' => 'Tim kami akan melakukan penggalian data (interview) untuk menyusun naskah yang kuat.', 'bg' => 'bg-[#E61E50]', 'text' => 'text-white'],
                    ['no' => '08', 'title' => 'Review Klien', 'desc' => 'Anda mendapatkan kesempatan meninjau draf artikel sebelum benar-benar dipublikasikan.', 'bg' => 'bg-white', 'text' => 'text-black'],
                    ['no' => '09', 'title' => 'Penerbitan', 'desc' => 'Artikel Anda tayang di jaringan media online nasional pilihan secara serentak.', 'bg' => 'bg-[#3D0066]', 'text' => 'text-white'],
                    ['no' => '10', 'title' => 'Monitoring', 'desc' => 'Laporan lengkap berupa tautan/link berita yang tayang akan dikirimkan langsung kepada Anda.', 'bg' => 'bg-black', 'text' => 'text-white'],
                ];
            @endphp

            @foreach($steps as $step)
            <div class="border-4 border-black {{ $step['bg'] }} p-8 relative shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:-translate-y-1 transition-all">
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 border-4 border-black flex items-center justify-center bg-white flex-shrink-0 transform -rotate-3">
                        <span class="font-black text-2xl text-black">{{ $step['no'] }}</span>
                    </div>
                    <div>
                        <h3 class="font-black text-2xl uppercase mb-3 leading-tight {{ $step['text'] }}">{{ $step['title'] }}</h3>
                        <p class="font-bold leading-relaxed {{ $step['text'] }} {{ $step['text'] === 'text-white' ? 'opacity-90' : 'text-black/70' }}">
                            {{ $step['desc'] }}
                        </p>
                    </div>
                    {{-- Tailwind Icon Placeholder --}}
                    <div class="absolute top-4 right-4 opacity-10 group-hover:opacity-100 transition-opacity">
                        <svg class="w-6 h-6 {{ $step['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA ──────────────────────────────────────────────────── --}}
<section class="bg-[#3D0066] border-b-8 border-black py-32 text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="font-black text-5xl md:text-8xl uppercase text-white leading-[0.8] mb-12 tracking-tighter">
            SIAP UNTUK <br><span class="text-[#FFD200]">GO PUBLIC?</span>
        </h2>
        <a href="https://api.whatsapp.com/send?phone=6287786000919"
           class="inline-block bg-[#E61E50] text-white font-black text-2xl uppercase tracking-tighter px-12 py-6 border-4 border-black shadow-[10px_10px_0px_0px_rgba(255,255,255,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all">
            Order via WhatsApp →
        </a>
    </div>
</section>

@endsection