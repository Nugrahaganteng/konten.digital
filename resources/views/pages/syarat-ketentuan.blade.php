{{-- resources/views/pages/syarat-ketentuan.blade.php --}}
@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - KontenDigital.id')

@section('content')

{{-- ── SECTION 1: HERO (KUNING) ────────────────────────────── --}}
<section class="bg-[#FFD200] border-b-8 border-black pt-32 pb-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="max-w-3xl">
            <div class="inline-block bg-[#3D0066] text-white font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-6 transform -rotate-1">
                ✦ Legal & Kebijakan
            </div>
            <h1 class="font-black text-6xl md:text-8xl leading-[0.9] uppercase text-[#3D0066] mb-8 tracking-tighter">
                SYARAT &<br><span class="bg-black text-[#FFD200] px-4 inline-block transform rotate-1">KETENTUAN</span>
            </h1>
            <div class="border-l-8 border-black pl-6 py-2 mb-8">
                <p class="font-bold text-2xl text-black italic leading-tight">
                    "Transparansi adalah kunci kenyamanan kerjasama kita."
                </p>
            </div>
        </div>

        <div class="relative flex justify-center items-center h-[400px]">
            <div class="absolute w-[350px] h-[350px] bg-[#E61E50] border-8 border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                <img src="/images/syarat.png" alt="Legal Terms" 
                     class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
            </div>
        </div>
    </div>
</section>

{{-- ── SECTION 2: SYARAT UMUM (BIRU CERAH - Sesuai Gambar) ───── --}}
<section class="bg-[#3B82F6] border-b-8 border-black py-24 relative">
    {{-- Aksen Dekorasi --}}
    <div class="absolute top-10 right-10 w-20 h-20 bg-[#FFD200] border-4 border-black rounded-full opacity-50"></div>
    
    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="font-black text-4xl md:text-6xl uppercase text-white italic tracking-tighter drop-shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                ✦ SYARAT UMUM <span class="text-black">PRESS RELEASE</span>
            </h2>
        </div>
        
        <div class="grid gap-6">
            @php
                $pr_rules = [
                    'Berita yang diterbitkan wajib memiliki news value (informasi manfaat bagi pembaca).',
                    'Bukan berisi ajakan membeli langsung (hard selling), cara belanja, atau teknikal penggunaan.',
                    'Hasil penerbitan disesuaikan oleh editor media untuk memenuhi standar jurnalistik.',
                    'Media memiliki kewenangan penuh mengedit JUDUL, GAMBAR, maupun TEKS berita.',
                    'Tidak menerima revisi setelah terbit, kecuali kesalahan fatal (nama/gelar/tanggal).',
                    'Press release TIDAK BISA menyertakan hyperlink/backlink (aktif maupun mati).',
                    'Berita yang sudah tayang tidak bisa di-TAKE DOWN sesuai aturan media nasional.',
                    'Waktu penayangan diproses dalam 1-3 hari kerja sesuai antrean redaksi.'
                ];
            @endphp

            @foreach($pr_rules as $rule)
            <div class="group flex items-start gap-5 p-6 border-4 border-black bg-white hover:bg-black transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                <div class="flex-shrink-0 w-10 h-10 bg-[#FFD200] text-black flex items-center justify-center border-4 border-black group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="font-black text-black group-hover:text-[#FFD200] text-lg leading-snug pt-1 uppercase tracking-tight transition-colors">{{ $rule }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── SECTION 3: KETENTUAN PENULISAN (PUTIH BERSIH) ────────── --}}
<section class="bg-white border-b-8 border-black py-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-12 gap-12 items-center">
        
        {{-- Visual Side --}}
        <div class="md:col-span-5 relative">
            <div class="border-8 border-black p-4 bg-[#FFD200] shadow-[15px_15px_0px_0px_rgba(230,30,80,1)]">
                <img src="/images/skc.png" alt="Writing Rules" class="w-full border-4 border-black grayscale">
            </div>
        </div>

        {{-- Content Side --}}
        <div class="md:col-span-7">
            <div class="inline-block bg-[#E61E50] text-white px-8 py-4 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-10 transform rotate-1">
                <h2 class="font-black text-3xl md:text-4xl uppercase tracking-tighter italic">✦ Ketentuan Penulisan Artikel</h2>
            </div>

            <div class="grid md:grid-cols-1 gap-4">
                @php
                    $article_rules = [
                        'Standar penulisan jurnalistik (5W + 1H).',
                        'Wajib mencantumkan narasumber yang kredibel.',
                        'Panjang artikel berkisar antara 200-500 kata.',
                        'Judul menarik antara 50 hingga 70 karakter.',
                        'Menyiapkan 2-3 foto resolusi tinggi.',
                        'Format foto wajib Landscape (tidak pecah/blur).',
                        'Foto terlalu komersil akan diganti oleh redaksi.'
                    ];
                @endphp
                
                @foreach($article_rules as $ar)
                <div class="flex items-center gap-4 group">
                    <div class="w-8 h-8 bg-black border-2 border-black flex items-center justify-center group-hover:bg-[#FFD200] transition-colors">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    </div>
                    <span class="font-black text-xl uppercase tracking-tight text-black group-hover:text-[#E61E50] transition-colors italic">
                        {{ $ar }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── SECTION 4: FAQ (HITAM/UNGU GELAP) ────────────────────── --}}
<section class="bg-[#1A1A1A] border-b-8 border-black py-24 relative">
    {{-- Aksen Noise/Pattern --}}
    <div class="absolute inset-0 opacity-[0.1]" style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="font-black text-5xl md:text-7xl uppercase italic tracking-tighter text-white">
                ANY <span class="text-[#FFD200]">QUESTIONS?</span>
            </h2>
            <p class="text-[#FFD200] font-bold text-xl mt-4 uppercase tracking-[0.2em]">Frequently Asked Questions</p>
        </div>

        <div class="grid gap-6" x-data="{ open: null }">
            @php
                $faqs = [
                    ['q' => 'Berapa lama artikel saya terbit?', 'a' => 'Umumnya tayang dalam 1-3 hari kerja setelah draf disetujui, tergantung antrean redaksi masing-masing media.'],
                    ['q' => 'Boleh menaruh brand di judul?', 'a' => 'Boleh diajukan, namun keputusan final penempatan brand tetap ada pada editor media yang bersangkutan.'],
                    ['q' => 'Apakah artikel tayang permanen?', 'a' => 'Ya, artikel bersifat permanen selama situs berita tersebut masih aktif beroperasi dan tidak melanggar hukum.'],
                    ['q' => 'Boleh menggunakan foto produk?', 'a' => 'Boleh, pastikan foto memiliki nilai estetika jurnalistik dan bukan sekadar banner promosi yang kaku.'],
                ];
            @endphp

            @foreach($faqs as $index => $faq)
            <div class="border-4 border-black bg-[#222] hover:border-[#FFD200] transition-colors shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <button @click="open === {{ $index }} ? open = null : open = {{ $index }}" 
                        class="w-full flex justify-between items-center p-8 text-left group">
                    <span class="font-black uppercase text-xl text-white group-hover:text-[#FFD200] transition-colors leading-tight">{{ $faq['q'] }}</span>
                    <div class="flex-shrink-0 w-12 h-12 border-4 border-black flex items-center justify-center bg-[#E61E50] text-white text-3xl font-black group-hover:bg-[#FFD200] group-hover:text-black transition-all">
                        <span x-text="open === {{ $index }} ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === {{ $index }}" x-collapse class="px-8 pb-8 font-bold text-gray-300 text-lg leading-relaxed border-t-4 border-black pt-6">
                    <span class="text-[#FFD200] text-3xl mr-2 italic">"</span>{{ $faq['a'] }}<span class="text-[#FFD200] text-3xl ml-2 italic">"</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── SECTION 5: CTA (KUNING) ────────────────────────────── --}}
<section class="bg-[#FFD200] border-b-8 border-black py-24 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <h2 class="font-black text-6xl md:text-8xl uppercase text-[#3D0066] leading-[0.8] mb-12 tracking-tighter italic">
            BUTUH BANTUAN <br><span class="text-black bg-white px-4 inline-block transform rotate-2">LEBIH LANJUT?</span>
        </h2>
        <a href="https://api.whatsapp.com/send?phone=6287786000919" 
           class="inline-block bg-[#3D0066] text-white px-16 py-8 font-black text-3xl uppercase border-8 border-black shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-3 hover:translate-y-3 transition-all">
            HUBUNGI ADMIN SEKARANG →
        </a>
    </div>
</section>

@endsection