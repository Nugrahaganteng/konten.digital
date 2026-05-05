{{-- resources/views/pages/syarat-ketentuan.blade.php --}}
@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - KontenDigital.id')

@section('content')

{{-- ── HERO SECTION ────────────────────────────────────────── --}}
{{-- Menggunakan latar belakang terang sesuai watermarked_img_17674889967128246522.png --}}
<section class="bg-[#fcfcfc] border-b-8 border-black pt-44 pb-24 md:pt-56 md:pb-32 relative overflow-hidden">
    {{-- Elemen dekoratif garis tipis di sudut kanan bawah agar tidak menabrak tombol navbar --}}
    <div class="absolute -bottom-10 -right-10 w-80 h-80 border-2 border-black/5 rotate-12 pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl">
            {{-- Badge Label --}}
            <div class="inline-block bg-[#F2B038] text-black font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-8">
                Legal & Kebijakan
            </div>
            
            {{-- Judul Utama dengan kontras warna gelap dan kuning --}}
            <h1 class="font-black text-6xl md:text-8xl leading-[0.85] uppercase text-[#1a1a2e] mb-8">
                SYARAT &<br>
                <span class="text-[#F2B038]">KETENTUAN</span>
            </h1>
            
            {{-- Garis aksen pemisah --}}
            <div class="w-24 h-4 bg-[#F2B038] mb-10 border-2 border-black"></div>
            
            {{-- Deskripsi --}}
            <p class="font-bold text-[#1a1a2e]/70 text-lg md:text-xl max-w-2xl leading-relaxed">
                Harap baca ketentuan penerbitan Press Release dan penulisan artikel kami secara seksama untuk kenyamanan bersama.
            </p>
        </div>
    </div>
</section>

{{-- ── CONTENT SECTION ─────────────────────────────────────── --}}
{{-- Latar belakang menggunakan subtle grid pattern untuk kesan profesional --}}
<section class="bg-white border-b-8 border-black py-24" style="background-image: radial-gradient(#000000 1px, transparent 1px); background-size: 40px 40px;">
    <div class="max-w-5xl mx-auto px-6 space-y-28">

        {{-- Syarat Umum Press Release --}}
        <div class="scroll-mt-32">
            <div class="inline-block bg-[#3B82F6] text-white px-8 py-4 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-14 transform -rotate-1">
                <h2 class="font-black text-2xl md:text-3xl uppercase tracking-tighter">Syarat & Ketentuan Umum Press Release</h2>
            </div>
            
            <div class="grid gap-6">
                @php
                    $pr_rules = [
                        'Berita yang diterbitkan menonjolkan memiliki news value (informasi benefit atau manfaat bagi pembaca).',
                        'Berita yang terbit bukan berisi ajakan membeli atau bergabung, teknikal penggunaan, cara belanja, atau promosi hard selling.',
                        'Draft rilis yang dikirim sifatnya rekomendasi. Hasil penerbitan disesuaikan oleh editor media untuk memenuhi standar.',
                        'Jika draft rilis dibuat oleh klien, akan kami sesuaikan lebih dulu dengan gaya bahasa media.',
                        'Media memiliki kewenangan untuk mengedit JUDUL, GAMBAR, maupun TEKS berita sesuai aturan masing-masing media.',
                        'Tidak menerima revisi setelah terbit, kecuali kesalahan penyebutan gelar, nama, tanggal acara, dan typo.',
                        'Press release TIDAK BISA insert hyperlink/backlink (domain, url mati, atau anchor teks).',
                        'Waktu penayangan sepenuhnya kewenangan media, biasanya diproses dalam 1-3 hari kerja.',
                        'Media berhak MENOLAK atau TIDAK MENAYANGKAN rilis jika dinilai tidak sesuai kebijakan redaksi.',
                        'Berita yang sudah tayang tidak bisa di-TAKE DOWN sesuai aturan media nasional.',
                        'Kami menjamin pesan utama dari artikel press release akan tersampaikan kepada pembaca.'
                    ];
                @endphp

                @foreach($pr_rules as $rule)
                <div class="group flex items-start gap-5 p-6 border-4 border-black bg-white hover:bg-gray-50 transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-black text-[#F2B038] flex items-center justify-center font-black text-xl border-2 border-black group-hover:bg-[#F2B038] group-hover:text-black transition-colors">
                        ✓
                    </div>
                    <p class="font-bold text-black/80 text-lg leading-snug pt-1">{{ $rule }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Ketentuan Penulisan Artikel --}}
        <div class="scroll-mt-32">
            <div class="inline-block bg-red-500 text-white px-8 py-4 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-14 transform rotate-1">
                <h2 class="font-black text-2xl md:text-3xl uppercase tracking-tighter">Ketentuan Penulisan Artikel</h2>
            </div>

            <div class="bg-[#1a1a2e] text-white p-10 md:p-16 border-4 border-black shadow-[12px_12px_0px_0px_rgba(242,176,56,1)] relative">
                {{-- Decorative Dots --}}
                <div class="absolute top-4 right-4 w-24 h-24 opacity-10" style="background-image: radial-gradient(#fff 2px, transparent 2px); background-size: 12px 12px;"></div>
                
                <ul class="grid md:grid-cols-2 gap-x-12 gap-y-10">
                    @php
                        $article_rules = [
                            'Standar penulisan jurnalistik (5W + 1H).',
                            'Wajib ada narasumber di dalam artikel.',
                            'Panjang artikel berkisar 200-500 kata.',
                            'Judul minimal 50 karakter & maksimal 70 karakter.',
                            'Menyiapkan 2-3 foto cadangan beresolusi tinggi.',
                            'Format foto landscape (tidak blur).',
                            'Foto terlalu iklan akan diganti oleh media.'
                        ];
                    @endphp
                    @foreach($article_rules as $ar)
                    <li class="flex items-center gap-4 group border-b border-white/10 pb-4 last:border-0">
                        <div class="w-4 h-4 bg-[#F2B038] border-2 border-white rotate-45 group-hover:rotate-180 transition-all duration-500"></div>
                        <span class="font-bold text-lg md:text-xl">{{ $ar }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- FAQ --}}
        <div class="scroll-mt-32 pt-10">
            <div class="text-center mb-16">
                <h2 class="font-black text-4xl md:text-6xl uppercase italic tracking-tighter">Frequently Asked</h2>
                <div class="w-20 h-2 bg-black mx-auto mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8" x-data="{ open: null }">
                @php
                    $faqs = [
                        ['q' => 'Berapa lama artikel saya terbit?', 'a' => 'Artikel umumnya tayang 1-3 hari kerja setelah draf disetujui, tergantung antrean redaksi media.'],
                        ['q' => 'Boleh taruh brand di judul?', 'a' => 'Boleh diajukan, namun keputusan penempatan brand tetap menjadi hak prerogatif editor media.'],
                        ['q' => 'Apakah tayang permanen?', 'a' => 'Ya, artikel bersifat permanen selama situs berita tersebut masih aktif beroperasi.'],
                        ['q' => 'Boleh pakai foto produk?', 'a' => 'Boleh, selama foto memiliki nilai jurnalistik dan tidak terlihat seperti banner iklan kaku.'],
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div class="border-4 border-black bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <button @click="open === {{ $index }} ? open = null : open = {{ $index }}" 
                            class="w-full flex justify-between items-center p-6 text-left hover:bg-gray-50 transition-colors">
                        <span class="font-black uppercase text-lg leading-tight">{{ $faq['q'] }}</span>
                        <div class="flex-shrink-0 w-10 h-10 border-4 border-black flex items-center justify-center bg-black text-white text-2xl font-black">
                            <span x-text="open === {{ $index }} ? '-' : '+'"></span>
                        </div>
                    </button>
                    <div x-show="open === {{ $index }}" x-collapse class="p-6 border-t-4 border-black bg-gray-50 font-bold text-black/70 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- ── CTA SECTION ─────────────────────────────────────────── --}}
<section class="bg-[#F2B038] border-b-8 border-black py-24 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <h2 class="font-black text-5xl md:text-7xl uppercase mb-12 leading-none">Ada Hal Yang<br>Kurang Jelas?</h2>
        <a href="{{ route('contact') }}" class="inline-block bg-black text-white px-16 py-6 font-black text-2xl uppercase border-4 border-black shadow-[10px_10px_0px_0px_rgba(255,255,255,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all">
            Hubungi Admin Sekarang →
        </a>
    </div>
</section>

@endsection