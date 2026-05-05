@extends('layouts.app')

@section('title', 'Jasa Konferensi Pers (Khusus Jogja) - Kontendigital.id')

@section('content')

{{-- NAVBAR / LOGO SECTION --}}


{{-- HERO SECTION --}}
{{-- HERO SECTION - Warna Disesuaikan dengan Foto Branding --}}
<section class="relative pt-24 pb-24 bg-[#FFD200] overflow-hidden border-b-8 border-black">
    {{-- Elemen Dekoratif Animasi (Floating Icons) --}}
    <div class="absolute top-10 left-10 opacity-20 animate-bounce group">
        <span class="text-6xl">⭐</span>
    </div>
    <div class="absolute bottom-20 right-10 opacity-20 animate-pulse transition-all duration-1000">
        <span class="text-8xl">🚀</span>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="reveal-text">
            {{-- Badge Ungu Branding --}}
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#3D0066] transform -rotate-1 mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:rotate-0 transition-transform cursor-default">
                <span class="text-white font-black text-sm tracking-widest uppercase italic">✦ JASA KONFERENSI PERS (KHUSUS JOGJA)</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-[#3D0066] leading-none uppercase tracking-tighter mb-8 drop-shadow-sm">
                Bersama Wartawan dari <span class="bg-black text-[#FFD200] px-3 inline-block transform skew-x-2">Media Ternama</span>
            </h1>

            <p class="text-xl font-bold text-black/80 mb-10 leading-relaxed italic border-l-4 border-black pl-4">
                "Ubah statement menjadi berita nasional dalam sekejap."
            </p>

            <p class="text-lg font-bold text-black/70 mb-10 leading-relaxed">
                Selain membantu mengundang wartawan/media untuk Anda, kami menangani pembuatan artikel press release, undangan media, distribusi berita, hingga monitoring pemuatan berita secara tuntas.
            </p>

            {{-- Tombol Konsultasi dengan Efek Hover Khas --}}
            <a href="https://api.whatsapp.com/send?phone=6287786000919" 
               class="inline-block px-10 py-5 bg-black text-[#FFD200] font-black text-2xl border-4 border-black hover:bg-[#3D0066] hover:text-white transition-all transform hover:-translate-y-2 active:translate-y-0 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tight">
                Konsultasi Sekarang →
            </a>
        </div>
        
        <div class="relative group">
            {{-- Lingkaran Dekoratif Belakang Foto --}}
            <div class="absolute -z-10 top-10 right-10 w-full h-full bg-[#E61E50] border-4 border-black rounded-full shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] group-hover:scale-105 transition-transform duration-500"></div>
            
            {{-- Foto Utama --}}
            <div class="overflow-hidden border-4 border-black rounded-2xl shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
                <img src="/images/wartawan.png" alt="Konferensi Pers" class="w-full h-auto grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
            </div>
            
            {{-- Floating Badges dengan Animasi Mengambang --}}
            <div class="absolute -bottom-6 -left-6 bg-white border-4 border-black p-4 font-black transform rotate-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase text-sm animate-float">
                ✦ Launching Produk
            </div>
            <div class="absolute -top-6 -right-6 bg-[#3D0066] text-white border-4 border-black p-4 font-black transform -rotate-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase text-sm animate-float-delayed">
                ✦ Press Release
            </div>
        </div>
    </div>
</section>

<style>
    /* Animasi Mengambang Khas Neo-Brutalism */
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(3deg); }
        50% { transform: translateY(-10px) rotate(5deg); }
    }
    @keyframes float-delayed {
        0%, 100% { transform: translateY(0) rotate(-3deg); }
        50% { transform: translateY(-15px) rotate(-1deg); }
    }
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: float-delayed 4s ease-in-out infinite;
    }

    /* Efek teks muncul halus saat load */
    .reveal-text {
        animation: reveal 0.8s cubic-bezier(0.77, 0, 0.175, 1);
    }
    @keyframes reveal {
        0% { opacity: 0; transform: translateX(-30px); }
        100% { opacity: 1; transform: translateX(0); }
    }
</style>

{{-- MARQUEE LOGO MEDIA (Optional - Menambah kesan profesional) --}}
{{-- MARQUEE LOGO MEDIA - Diperbarui dengan Daftar Media Tambahan --}}
<div class="bg-black py-6 border-b-8 border-black overflow-hidden flex flex-nowrap">
    <div class="flex gap-12 items-center animate-marquee whitespace-nowrap px-4 grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all cursor-default">
        {{-- Media List Awal --}}
        <span class="text-white font-black text-2xl mx-8 uppercase">KR JOGJA</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">TRIBUN JOGJA</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">RADAR JOGJA</span>
        <span class="text-[#3B82F6] font-black text-2xl mx-8 uppercase italic">DETIK.COM</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">KOMPAS</span>

        {{-- Tambahan Media Baru --}}
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">INDO MEDIA</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">SUARA.COM</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">OKEZONE</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TVONE NEWS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">LIPUTAN 6</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TRIBUN NEWS</span>
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">JAWA POS</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">TIMES NEWS</span>
        
        {{-- Duplicate untuk Loop Tanpa Putus --}}
        <span class="text-[#FFD200] font-black text-2xl mx-8 uppercase italic">INDO MEDIA</span>
        <span class="text-white font-black text-2xl mx-8 uppercase">SUARA.COM</span>
    </div>
</div>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        display: inline-flex;
        animation: marquee 30s linear infinite; /* Durasi ditambah agar tidak terlalu cepat karena teks makin panjang */
    }
</style>

{{-- MENGAPA DIBUTUHKAN --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-6xl font-black uppercase italic mb-6">Mengapa Dibutuhkan Konferensi Pers?</h2>
            <p class="max-w-4xl mx-auto font-bold text-lg leading-relaxed">
                Dalam konferensi pers, narasumber bisa menjawab pertanyaan secara langsung dari para wartawan sehingga suatu statement dapat dilakukan sekali tuntas tanpa harus menjelaskan satu per satu melalui telepon dan sebagainya.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
                $benefits = [
                    ['icon' => '📢', 'title' => 'Statement / Informasi', 'desc' => 'Menyatakan suatu statement/informasi ke publik dan menyebarkannya secara luas melalui media.'],
                    ['icon' => '🚀', 'title' => 'Launching Produk/Brand', 'desc' => 'Ingin me-launching produk atau brand dan mengenalkan ke masyarakat luas.'],
                    ['icon' => '🤝', 'title' => 'Ajakan Kegiatan Sosial', 'desc' => 'Mengadakan kegiatan sosial/kemasyarakatan dan mengajak masyarakat luas ikut serta.'],
                    ['icon' => '📈', 'title' => 'Promosi & Pengenalan', 'desc' => 'Ingin melakukan promosi suatu produk, Perusahaan, seminar, atau acara kampus.'],
                    ['icon' => '📊', 'title' => 'Media Laporan Keuangan', 'desc' => 'Mengumumkan laporan keuangan suatu perusahaan.'],
                    ['icon' => '🏛️', 'title' => 'Pengumuman Pemerintah', 'desc' => 'Mengumumkan kebijakan baru pemerintahan.'],
                ];
            @endphp

            @foreach($benefits as $item)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-black group hover:bg-[#F2B038] transition-colors">
                <span class="text-4xl mb-4 block transform group-hover:scale-125 transition-transform">{{ $item['icon'] }}</span>
                <h3 class="text-xl font-black uppercase mb-3">{{ $item['title'] }}</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SIAPA SAJA --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
        <div class="grid grid-cols-2 gap-4">
            <img src="/images/pres1.jpg" class="border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 bg-gray-200 aspect-video object-cover">
            <img src="/images/pres2.jpg" class="border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform rotate-2 mt-8 bg-gray-200 aspect-video object-cover">
        </div>
        <div>
            <h2 class="text-4xl font-black uppercase mb-8 leading-tight">Siapa Saja yang Dapat Menggunakan Jasa Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $users = ['Perusahaan', 'Pengusaha / Pebisnis', 'Perguruan Tinggi', 'Komunitas', 'Instansi Pemerintah', 'Selebriti', 'Content Creator', 'Organisasi Sosial'];
                @endphp
                @foreach($users as $user)
                <div class="flex items-center gap-3 font-black text-lg p-3 border-2 border-black bg-[#F2B038] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <span class="flex-shrink-0 w-6 h-6 bg-black border-2 border-white flex items-center justify-center text-white text-[10px]">✔</span>
                    {{ $user }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- PERSIAPAN --}}
<section class="py-24 bg-black text-white overflow-hidden border-b-8 border-black">
    <div class="max-w-5xl mx-auto px-6 relative">
        <div class="absolute -top-10 -right-10 text-9xl opacity-10 font-black">PREP</div>
        <h2 class="text-4xl font-black uppercase mb-12 text-center text-[#F2B038]">Apa yang Perlu Disiapkan?</h2>
        
        <div class="space-y-6">
            @php
                $preps = [
                    'Menyiapkan ruang press conference (Hotel, Meeting Room, atau Event Hall).',
                    'Menetapkan Narasumber & Moderator utama.',
                    'Menyiapkan Key Points atau informasi inti yang akan disampaikan.',
                    'Fasilitas teknis pendukung (Meja, Sound System, Mic, dll).'
                ];
            @endphp
            @foreach($preps as $index => $prep)
            <div class="flex gap-6 items-start p-6 border-4 border-[#3B82F6] bg-white text-black shadow-[8px_8px_0px_0px_#3B82F6] group">
                <span class="bg-black text-white w-10 h-10 flex-shrink-0 flex items-center justify-center font-black border-2 border-white group-hover:rotate-12 transition-transform">{{ $index + 1 }}</span>
                <p class="font-black text-lg">{{ $prep }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- APA YANG KAMI KERJAKAN --}}
<section class="py-24 bg-[#F2B038]">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-center uppercase mb-16 italic underline decoration-black">Apa Saja yang Kami Kerjakan?</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $works = [
                    'Mengatur persiapan & mengundang media.',
                    'Distribusi Press Release ke Jaringan Media.',
                    'Pembuatan naskah Press Release profesional.',
                    'Media monitoring (Follow up penayangan).',
                    'Report Link URL & dokumentasi berita.',
                    'Konsultasi strategi media.'
                ];
            @endphp
            @foreach($works as $work)
            <div class="flex items-center gap-6 p-8 bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:bg-[#3B82F6] hover:text-white transition-all group">
                <div class="w-12 h-12 bg-black text-white border-2 border-white flex items-center justify-center text-xl font-bold group-hover:scale-110">✔</div>
                <p class="font-black text-lg uppercase leading-tight">{{ $work }}</p>
            </div>
            @endforeach
        </div>

        {{-- CTA FINAL --}}
        <div class="mt-20 text-center">
            <div class="inline-block p-4 border-4 border-dashed border-black mb-8 animate-pulse">
                <span class="font-black text-xl uppercase italic">Siap Menjadi Headline Besok Pagi?</span>
            </div>
            <br>
            <a href="https://api.whatsapp.com/send?phone=6287786000919" 
               class="inline-block px-16 py-8 bg-black text-white font-black text-3xl border-4 border-white shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] hover:bg-[#3B82F6] hover:translate-y-2 transition-all uppercase italic">
                Hubungi Kami Sekarang →
            </a>
        </div>
    </div>
</section>

@endsection

{{-- Tambahkan CSS di file layout atau di sini --}}
<style>
    @keyframes marquee {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }
    .animate-marquee {
        display: inline-flex;
        animation: marquee 20s linear infinite;
    }
</style>