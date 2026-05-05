{{-- resources/views/pages/syarat-ketentuan.blade.php --}}
@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - KontenDigital.id')

@section('content')

{{-- ── HERO SECTION ────────────────────────────────────────── --}}
<section class="bg-[#FFD200] border-b-8 border-black pt-32 pb-24 relative overflow-hidden">
    {{-- Dekorasi Latar Belakang SVG --}}
   

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="max-w-3xl">
            <div class="inline-block bg-[#3D0066] text-white font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-6 transform -rotate-1">
                ✦ Legal & Kebijakan
            </div>
            <h1 class="font-black text-6xl md:text-8xl leading-[0.9] uppercase text-[#3D0066] mb-8 tracking-tighter">
                SYARAT &<br><span class="bg-black text-[#FFD200] px-4 inline-block transform rotate-1">KETENTUAN</span>
            </h1>
            <div class="border-l-4 border-black pl-4 py-2 mb-8">
                <p class="font-bold text-xl text-black italic leading-tight">
                    "Transparansi adalah kunci kenyamanan kerjasama kita."
                </p>
            </div>
            <p class="font-bold text-lg text-black/80 max-w-xl leading-relaxed">
                Harap baca ketentuan penerbitan Press Release dan penulisan artikel kami secara seksama untuk hasil publikasi yang maksimal.
            </p>
        </div>

        {{-- Visual Side --}}
        <div class="relative flex justify-center items-center h-[450px]">
            <div class="absolute w-[380px] h-[380px] border-[6px] border-black rounded-[40px] -translate-x-4 -translate-y-4"></div>
            <div class="relative w-[350px] h-[350px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                <img src="/images/syarat.png" alt="Legal Terms" 
                     class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
                
                {{-- Floating Tailwind Icon --}}
                <div class="absolute -top-10 -right-5 bg-[#3D0066] text-white border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform rotate-12">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── CONTENT SECTION ─────────────────────────────────────── --}}
{{-- ── CONTENT SECTION ─────────────────────────────────────── --}}
{{-- Seksi 1: Syarat Umum (Latar Belakang Abu-abu Sangat Muda agar Kontras dengan Hero) --}}
<section class="bg-[#F8F8F8] border-b-8 border-black py-24">
    <div class="max-w-5xl mx-auto px-6">
        <div class="scroll-mt-32">
            <div class="inline-block bg-[#3D0066] text-white px-8 py-4 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-14 transform -rotate-1">
                <h2 class="font-black text-2xl md:text-3xl uppercase tracking-tighter italic">✦ Syarat Umum Press Release</h2>
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
                <div class="group flex items-start gap-5 p-6 border-4 border-black bg-white hover:bg-[#FFD200] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-black text-[#FFD200] flex items-center justify-center border-2 border-black group-hover:bg-[#3D0066] group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <p class="font-bold text-black text-lg leading-snug pt-1">{{ $rule }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Seksi 2: Ketentuan Penulisan (Latar Belakang Kuning Soft/Cream) --}}
<section class="bg-[#FFF9E5] border-b-8 border-black py-24">
    <div class="max-w-5xl mx-auto px-6">
        <div class="scroll-mt-32">
            <div class="inline-block bg-[#E61E50] text-white px-8 py-4 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mb-14 transform rotate-1">
                <h2 class="font-black text-2xl md:text-3xl uppercase tracking-tighter italic">✦ Ketentuan Penulisan Artikel</h2>
            </div>

            <div class="bg-white p-10 md:p-16 border-[6px] border-[#3D0066] shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
                <svg class="absolute -bottom-10 -right-10 w-40 h-40 text-[#3D0066]/5 rotate-12" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                </svg>
                
                <ul class="grid md:grid-cols-2 gap-x-12 gap-y-10 relative z-10">
                    @php
                        $article_rules = [
                            'Standar penulisan jurnalistik (5W + 1H).',
                            'Wajib mencantumkan narasumber.',
                            'Panjang artikel berkisar 200-500 kata.',
                            'Judul antara 50 hingga 70 karakter.',
                            'Menyiapkan 2-3 foto resolusi tinggi.',
                            'Format foto wajib Landscape (tidak blur).',
                            'Foto terlalu komersil akan diganti redaksi.'
                        ];
                    @endphp
                    
                    @foreach($article_rules as $ar)
                    <li class="flex items-center gap-4 group border-b-4 border-[#3D0066]/5 pb-4 last:border-0">
                        <div class="w-5 h-5 bg-[#FFD200] border-2 border-black rotate-45 group-hover:bg-[#E61E50] transition-all duration-300"></div>
                        <span class="font-black text-lg md:text-xl uppercase tracking-tight text-[#3D0066] group-hover:translate-x-2 transition-transform italic">
                            {{ $ar }}
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Seksi 3: FAQ (Latar Belakang Putih Bersih dengan Pattern Halus) --}}
<section class="bg-white border-b-8 border-black py-24 relative">
    {{-- Dekorasi Grid Pattern Halus --}}
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#3D0066 1px, transparent 1px); background-size: 20px 20px;"></div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
        <div class="scroll-mt-32 pt-10">
            <div class="text-center mb-16">
                <h2 class="font-black text-4xl md:text-6xl uppercase italic tracking-tighter text-[#3D0066]">
                    FREQUENTLY <span class="bg-[#FFD200] text-black px-4 not-italic shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">ASKED</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8" x-data="{ open: null }">
                @php
                    $faqs = [
                        ['q' => 'Berapa lama artikel saya terbit?', 'a' => 'Umumnya tayang dalam 1-3 hari kerja setelah draf disetujui, tergantung antrean redaksi masing-masing media.'],
                        ['q' => 'Boleh menaruh brand di judul?', 'a' => 'Boleh diajukan, namun keputusan final penempatan brand tetap ada pada editor media yang bersangkutan.'],
                        ['q' => 'Apakah artikel tayang permanen?', 'a' => 'Ya, artikel bersifat permanen selama situs berita tersebut masih aktif beroperasi dan tidak melanggar hukum.'],
                        ['q' => 'Boleh menggunakan foto produk?', 'a' => 'Boleh, pastikan foto memiliki nilai estetika jurnalistik dan bukan sekadar banner promosi yang kaku.'],
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div class="border-4 border-black bg-white shadow-[8px_8px_0px_0px_rgba(61,0,102,1)] group">
                    <button @click="open === {{ $index }} ? open = null : open = {{ $index }}" 
                            class="w-full flex justify-between items-center p-6 text-left hover:bg-[#3D0066] hover:text-white transition-all">
                        <span class="font-black uppercase text-lg leading-tight">{{ $faq['q'] }}</span>
                        <div class="flex-shrink-0 w-10 h-10 border-4 border-black flex items-center justify-center bg-[#FFD200] text-black text-2xl font-black group-hover:bg-white transition-colors">
                            <span x-text="open === {{ $index }} ? '-' : '+'"></span>
                        </div>
                    </button>
                    <div x-show="open === {{ $index }}" x-collapse class="p-6 border-t-4 border-black bg-[#FFF9E5] font-bold text-black/70 leading-relaxed italic">
                        "{{ $faq['a'] }}"
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── CTA SECTION ─────────────────────────────────────────── --}}
<section class="bg-[#3D0066] border-b-8 border-black py-24 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <h2 class="font-black text-5xl md:text-8xl uppercase text-white leading-[0.8] mb-12 tracking-tighter">
            ADA HAL YANG <br><span class="text-[#FFD200]">KURANG JELAS?</span>
        </h2>
        <a href="https://api.whatsapp.com/send?phone=6287786000919" 
           class="inline-block bg-[#E61E50] text-white px-16 py-6 font-black text-2xl uppercase border-4 border-black shadow-[10px_10px_0px_0px_rgba(255,255,255,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all">
            Tanya Admin Sekarang →
        </a>
    </div>
</section>

@endsection