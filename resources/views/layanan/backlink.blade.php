@extends('layouts.app')

@section('title', 'Jasa Backlink Media Nasional - Kontendigital.id')

@section('content')

{{-- HERO SECTION --}}
{{-- HERO SECTION - UPDATED COLOR PALETTE --}}
<section class="relative pt-32 pb-24 bg-[#FFD217] overflow-hidden border-b-8 border-black">
    {{-- Animasi Background: Floating Icons (Optional) --}}
    <div class="absolute top-20 left-10 w-16 h-16 bg-[#430A5D] opacity-10 rounded-lg rotate-12 animate-bounce-slow"></div>
    <div class="absolute bottom-20 right-10 w-20 h-20 border-4 border-[#430A5D] opacity-10 rounded-full animate-pulse"></div>

    <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
        {{-- Badge Atas --}}
        <div class="inline-block px-6 py-2 border-4 border-black bg-white transform -rotate-2 mb-8 shadow-[4px_4px_0px_0px_rgba(67,10,93,1)]">
            <span class="text-[#430A5D] font-black text-sm tracking-widest uppercase italic">✦ JASA PRESS RELEASE</span>
        </div>

        {{-- Judul Utama dengan Warna Ungu Referensi --}}
        <h1 class="text-6xl md:text-9xl font-black text-[#430A5D] leading-none uppercase tracking-tighter mb-8 drop-shadow-[6px_6px_0px_#000]">
            KONTENDIGITAL<span class="text-white">.ID</span>
        </h1>

        {{-- Deskripsi --}}
        <p class="text-xl md:text-2xl font-bold text-black max-w-3xl mx-auto mb-10 leading-relaxed">
            "Mitra terpercaya dalam komunikasi dan pemasaran digital yang mudah, murah, cepat, dan terjamin kualitasnya."
        </p>

        {{-- Button dengan Hover Efek --}}
        <div class="relative inline-block group">
            {{-- Bayangan Button (Layer Belakang) --}}
            <div class="absolute inset-0 bg-[#430A5D] translate-x-2 translate-y-2 group-hover:translate-x-0 group-hover:translate-y-0 transition-all border-4 border-black"></div>
            
            <a href="https://api.whatsapp.com/send?phone=6287786000919" 
               class="relative flex items-center justify-center px-10 py-5 bg-black text-white font-black text-2xl border-4 border-black group-hover:bg-[#430A5D] group-hover:text-[#FFD217] transition-all uppercase">
                Konsultasi Sekarang 
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-3 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0) rotate(12deg); }
        50% { transform: translateY(-20px) rotate(15deg); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 5s ease-in-out infinite;
    }
</style>



{{-- MANFAAT SECTION (BIRU) --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="inline-block text-4xl md:text-5xl font-black text-white uppercase italic mb-4 text-shadow">
                Manfaat Backlink Media Nasional
            </h2>
            <p class="text-white font-bold text-lg">Backlink media nasional memiliki beberapa manfaat sebagai berikut:</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Card 1 --}}
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="text-xl font-black uppercase mb-4">Meningkatkan Jumlah Pengunjung (Visitor)</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">
                    Backlink dapat meningkatkan visibilitas di kalangan audiens yang lebih luas. Pengunjung website media nasional yang tertarik dengan topik website Anda dapat diarahkan melalui backlink ini.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <h3 class="text-xl font-black uppercase mb-4">Memudahkan Google Menemukan Website Anda</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">
                    Memudahkan mesin pencarian Google dalam menemukan website yang Anda miliki. Ketika seseorang memasukkan kata kunci yang sesuai, Google akan memberikan referensi website Anda.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3 class="text-xl font-black uppercase mb-4">Meningkatkan Authority Website</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">
                    Meningkatkan reputasi yang tinggi dan dianggap sebagai sumber berita terpercaya. Google memberikan nilai tambah pada website yang menerima backlink dari sumber otoritatif.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- SECTION: APA ITU BACKLINK (NEW) --}}
{{-- SECTION: APA ITU BACKLINK (UPGRADED VERSION) --}}
<section class="py-24 bg-white border-b-8 border-black overflow-hidden relative">
    {{-- Background Decoration: Floating Shapes --}}
    <div class="absolute top-10 right-10 w-24 h-24 bg-[#F2B038] border-4 border-black rounded-full opacity-20 animate-bounce -z-0"></div>
    <div class="absolute bottom-10 left-10 w-16 h-16 bg-[#3B82F6] border-4 border-black rotate-45 opacity-20 animate-pulse -z-0"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-20">
            
            {{-- Image Laptop with Double Shadow & Floating Animation --}}
            <div class="w-full lg:w-1/2 relative group">
                {{-- Layer Dekoratif 1 --}}
                <div class="absolute -inset-6 bg-black border-4 border-black -rotate-3 group-hover:rotate-0 transition-all duration-500 shadow-[15px_15px_0px_0px_rgba(242,176,56,1)]"></div>
                {{-- Layer Dekoratif 2 (Biru) --}}
                <div class="absolute -inset-3 bg-[#3B82F6] border-4 border-black rotate-2 group-hover:-rotate-1 transition-all duration-500 delay-75"></div>
                
                {{-- Main Image Container dengan Efek "Goyang" Pelan --}}
                <div class="relative bg-white border-4 border-black overflow-hidden shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] animate-float-slow">
                    <img src="{{ asset('images/leptop.png') }}" alt="Apa itu Backlink Media Nasional" 
                         class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                    
                    {{-- Glitch/Scanner Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
                    <div class="absolute top-0 left-0 w-full h-1 bg-[#F2B038]/50 animate-scanline"></div>
                </div>

                {{-- Floating Tag --}}
                <div class="absolute -bottom-10 -right-5 bg-black text-white px-6 py-3 font-black uppercase italic border-4 border-white shadow-[8px_8px_0px_0px_rgba(59,130,246,1)] animate-bounce-slow">
                    #SEO_BOOSTER
                </div>
            </div>

            {{-- Text Content with Reveal Animation --}}
            <div class="w-full lg:w-1/2 space-y-8">
                <div class="space-y-4">
                    <h2 class="text-5xl md:text-7xl font-black text-black uppercase leading-[0.9] italic">
                        APA <span class="text-[#3B82F6] drop-shadow-[4px_4px_0px_rgba(0,0,0,1)]">ITU</span> <br>
                        <span class="relative inline-block mt-2">
                            BACKLINK
                            <div class="absolute -bottom-2 left-0 w-full h-6 bg-[#F2B038]/40 -z-10 skew-x-12"></div>
                        </span>
                    </h2>
                    <p class="text-2xl font-black text-black/40 uppercase tracking-widest">Media Nasional Expertise</p>
                </div>

                <div class="space-y-6">
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-4 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)] group-hover:translate-x-1 group-hover:translate-y-1 group-hover:shadow-none transition-all">
                            <span class="text-white font-black">01</span>
                        </div>
                        <p class="text-xl font-bold text-black/80 leading-tight">
                            Tautan atau hyperlink strategis yang ditempatkan pada <span class="border-b-4 border-[#3B82F6]">portal berita raksasa</span> di Indonesia.
                        </p>
                    </div>

                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#F2B038] flex items-center justify-center border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] group-hover:translate-x-1 group-hover:translate-y-1 group-hover:shadow-none transition-all">
                            <span class="text-black font-black">02</span>
                        </div>
                        <p class="text-xl font-bold text-black/80 leading-tight">
                            Senjata utama untuk memicu algoritma Google agar mengenali website Anda sebagai <span class="bg-black text-white px-2">Otoritas Tinggi</span>.
                        </p>
                    </div>
                </div>
                
                {{-- Action Badge --}}
                <div class="inline-flex items-center gap-4 bg-white border-4 border-black p-2 pr-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all cursor-pointer">
                    <div class="bg-black p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#F2B038] animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                    </div>
                    <span class="font-black uppercase italic tracking-tighter text-xl">High Otority Link Juices</span>
                </div>
            </div>
        </div>
    </div>
</section>



{{-- WHY CHOOSE US --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-black uppercase mb-16 leading-tight">
            Mengapa Klien Memilih Jasa <span class="text-[#3B82F6]">Kontendigital.id?</span>
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12">
            {{-- Item 1 --}}
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Proses Cepat dan Mudah</h4>
                    <p class="font-bold text-black/60 text-sm">Tim kami berpengalaman dan profesional sehingga prosesnya bisa dilakukan dengan cepat.</p>
                </div>
            </div>
            {{-- Item 2 --}}
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Garansi 100% Tayang</h4>
                    <p class="font-bold text-black/60 text-sm">Garansi tayang di media online, jika tidak bisa tayang kami berikan alternatif media sepadan atau full refund.</p>
                </div>
            </div>
            {{-- Item 3 --}}
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Revisi Sepuasnya</h4>
                    <p class="font-bold text-black/60 text-sm">Kami memberikan garansi revisi sepuasnya, terutama dalam penulisan artikel jika ada kesalahan dari kami.</p>
                </div>
            </div>
            {{-- Item 4 --}}
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Biaya Murah</h4>
                    <p class="font-bold text-black/60 text-sm">Memberikan harga yang super murah tanpa mengorbankan kualitas press release Anda.</p>
                </div>
            </div>
            {{-- Item 5 --}}
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Banyak Pilihan Media</h4>
                    <p class="font-bold text-black/60 text-sm">Memiliki lebih dari 200 list media sehingga Anda bisa memilih media sesuai kebutuhan.</p>
                </div>
            </div>
            {{-- Item 6 --}}
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-black flex items-center justify-center border-2 border-black shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Gratis Penulisan Draft</h4>
                    <p class="font-bold text-black/60 text-sm">Jika Anda belum memiliki artikel, kami akan membuatkan draft artikel tanpa biaya tambahan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MEDIA PARTNERS --}}
{{-- MEDIA PARTNERS SECTION - UPDATED COLOR PALETTE --}}
<section class="py-24 bg-white border-t-8 border-black overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 mb-16">
        <div class="flex justify-center">
            {{-- Badge Judul: Putih dengan Bayangan Ungu --}}
            <h3 class="bg-white text-[#430A5D] px-10 py-3 font-black uppercase tracking-[0.2em] text-2xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(67,10,93,1)] -rotate-1 hover:rotate-0 transition-transform cursor-default">
                Partner Media Kami
            </h3>
        </div>
    </div>

    {{-- Baris Pertama: Background Ungu Tua (Referensi Warna) --}}
    <div class="relative flex overflow-x-hidden mb-10 border-y-4 border-black bg-[#430A5D] py-8 shadow-[inset_0px_4px_10px_rgba(0,0,0,0.3)]">
        <div class="flex items-center animate-marquee whitespace-nowrap gap-16 w-max">
            @php $media1 = ['tribun.png', 'liputan.png', 'detik.png', 'kompas.png', 'antara.png', 'okzone.png']; @endphp
            @foreach(array_merge($media1, $media1) as $m)
                {{-- Filter brightness diperkuat agar logo putih/terang terlihat jelas di bg ungu --}}
                <img src="{{ asset('images/media/' . $m) }}" alt="Media" 
                     class="h-10 md:h-14 object-contain brightness-0 invert opacity-80 hover:opacity-100 transition-all mx-12">
            @endforeach
        </div>
    </div>

    {{-- Baris Kedua: Background Kuning (Referensi Warna) --}}
    <div class="relative flex overflow-x-hidden border-b-4 border-black bg-[#FFD217] py-8">
        <div class="flex items-center animate-marquee-reverse whitespace-nowrap gap-16 w-max">
            @php $media2 = ['sindo.png', 'tvone.png', 'jawa.png', 'konten.png', 'suara.png', 'media.png']; @endphp
            @foreach(array_merge($media2, $media2) as $m)
                {{-- Di bg kuning, kita gunakan grayscale ke hitam agar gaya Neo-Brutalism tetap kuat --}}
                <img src="{{ asset('images/media/' . $m) }}" alt="Media" 
                     class="h-10 md:h-14 object-contain grayscale hover:grayscale-0 contrast-125 transition-all mx-12">
            @endforeach
        </div>
    </div>
</section>

<style>
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    @keyframes marquee-reverse { 0% { transform: translateX(-50%); } 100% { transform: translateX(0); } }
    .animate-marquee { animation: marquee 40s linear infinite; }
    .animate-marquee-reverse { animation: marquee-reverse 35s linear infinite; }
</style>

{{-- CTA FINAL --}}
<section class="py-24 bg-black text-center">
    <h2 class="text-4xl md:text-6xl font-black text-[#F2B038] uppercase mb-10 leading-tight">SIAP UNTUK GO NATIONAL?</h2>
    <a href="https://api.whatsapp.com/send?phone=6287786000919" 
       class="inline-block px-12 py-6 bg-white text-black font-black text-2xl border-4 border-[#F2B038] hover:bg-[#F2B038] transition-all uppercase shadow-[8px_8px_0px_0px_rgba(242,176,56,1)]">
        Hubungi Kami Sekarang →
    </a>
</section>

<style>
    @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    @keyframes marquee-reverse { 0% { transform: translateX(-50%); } 100% { transform: translateX(0); } }
    .animate-marquee { animation: marquee 30s linear infinite; }
    .animate-marquee-reverse { animation: marquee-reverse 30s linear infinite; }
    .animate-marquee:hover, .animate-marquee-reverse:hover { animation-play-state: paused; }
    .text-shadow { text-shadow: 4px 4px 0px rgba(0,0,0,1); }
</style>

@endsection