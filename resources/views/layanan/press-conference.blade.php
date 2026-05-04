@extends('layouts.app')

@section('title', 'Jasa Konferensi Pers (Khusus Jogja) - Kontendigital.id')

@section('content')

{{-- HERO SECTION - Berdasarkan Foto 1 --}}
<section class="relative pt-32 pb-24 bg-white overflow-hidden border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div>
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#F2B038] transform -rotate-1 mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="text-black font-black text-sm tracking-widest uppercase italic">JASA KONFERENSI PERS (KHUSUS JOGJA)</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-black leading-none uppercase tracking-tighter mb-8">
                Bersama Wartawan dari <span class="bg-black text-white px-2">Media Ternama</span>
            </h1>

            <p class="text-xl font-bold text-black/80 mb-10 leading-relaxed">
                Selain membantu mengundang wartawan/media untuk Anda. Kami juga akan berperan dalam pembuatan artikel press release, membuat undangan untuk wartawan/media massa ke lokasi acara, distribusi berita ke media massa, follow up pemuatan berita, dan media monitoring.
            </p>

            <a href="https://api.whatsapp.com/send?phone=6287786000919" 
               class="inline-block px-10 py-5 bg-[#3B82F6] text-white font-black text-2xl border-4 border-black hover:bg-black hover:text-[#3B82F6] transition-all transform hover:-translate-y-2 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] uppercase">
                Konsultasi Sekarang →
            </a>
        </div>
        
        <div class="relative">
            <div class="absolute -z-10 top-10 right-10 w-full h-full bg-[#F2B038] border-4 border-black rounded-full shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]"></div>
            <img src="/images/press-conference-hero.png" alt="Konferensi Pers" class="w-full h-auto rounded-2xl grayscale hover:grayscale-0 transition-all duration-500 border-4 border-black shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
            
            {{-- Floating Badges --}}
            <div class="absolute -bottom-6 -left-6 bg-white border-4 border-black p-4 font-black transform rotate-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] uppercase text-sm">
                ✦ Launching Produk
            </div>
        </div>
    </div>
</section>

{{-- MENGAPA DIBUTUHKAN - Berdasarkan Foto 2 --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black text-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-6xl font-black uppercase italic mb-6">Mengapa Dibutuhkan Konferensi Pers?</h2>
            <p class="max-w-4xl mx-auto font-bold text-lg leading-relaxed">
                Dalam konferensi pers, narasumber bisa menjawab pertanyaan secara langsung dari para wartawan sehingga suatu statement dapat dilakukan sekali tuntas tanpa harus menjelaskan satu per satu melalui telepon dan sebagainya.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Loop data berdasarkan Foto 2 --}}
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
                <span class="text-4xl mb-4 block">{{ $item['icon'] }}</span>
                <h3 class="text-xl font-black uppercase mb-3">{{ $item['title'] }}</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SIAPA SAJA - Berdasarkan Foto 3 --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
        <div class="grid grid-cols-2 gap-4">
            <img src="/images/pc-1.jpg" class="border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-2">
            <img src="/images/pc-2.jpg" class="border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform rotate-2 mt-8">
        </div>
        <div>
            <h2 class="text-4xl font-black uppercase mb-8 leading-tight">Siapa Saja yang Dapat Menggunakan Jasa Konferensi Pers?</h2>
            <div class="grid grid-cols-2 gap-4">
                @php
                    $users = ['Perusahaan', 'Pengusaha atau pebisnis', 'Perguruan tinggi atau sekolah', 'Komunitas', 'Instansi pemerintahan', 'Selebriti', 'Konten creator', 'Dll'];
                @endphp
                @foreach($users as $user)
                <div class="flex items-center gap-3 font-bold text-lg">
                    <span class="w-6 h-6 bg-[#3B82F6] border-2 border-black flex items-center justify-center text-white text-xs">✔</span>
                    {{ $user }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- PERSIAPAN - Berdasarkan Foto 4 --}}
<section class="py-24 bg-black text-white overflow-hidden">
    <div class="max-w-5xl mx-auto px-6 relative">
        <div class="absolute -top-10 -right-10 text-9xl opacity-20 font-black">PREP</div>
        <h2 class="text-4xl font-black uppercase mb-12 text-center text-[#F2B038]">Apa yang Perlu Disiapkan?</h2>
        
        <div class="space-y-6">
            @php
                $preps = [
                    'Menyiapkan ruang press conference seperti ruang konferensi hotel, ruang meeting, atau ruang event hall.',
                    'Menetapkan narasumber, moderator, dsb.',
                    'Menyiapkan poin-poin informasi yang akan disampaikan.',
                    'Menyiapkan alat-alat pendukung kegiatan seperti meja, kursi, pengeras suara, dll.'
                ];
            @endphp
            @foreach($preps as $index => $prep)
            <div class="flex gap-6 items-start p-6 border-4 border-[#3B82F6] bg-white text-black shadow-[8px_8px_0px_0px_#3B82F6]">
                <span class="bg-black text-white w-10 h-10 flex-shrink-0 flex items-center justify-center font-black border-2 border-black">{{ $index + 1 }}</span>
                <p class="font-black text-lg">{{ $prep }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- APA YANG KAMI KERJAKAN - Berdasarkan Foto 5 --}}
<section class="py-24 bg-[#F2B038] border-t-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-center uppercase mb-16 italic">Apa Saja yang Kami Kerjakan untuk Anda?</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            @php
                $works = [
                    'Mengatur persiapan press conference dengan mengundang media.',
                    'Melakukan proses distribusi press release.',
                    'Melakukan pembuatan press release.',
                    'Media monitoring (follow up penayangan media).',
                    'Report link URL.'
                ];
            @endphp
            @foreach($works as $work)
            <div class="flex items-center gap-6 p-8 bg-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-x-2 transition-transform">
                <div class="w-12 h-12 bg-[#3B82F6] border-4 border-black flex items-center justify-center text-white text-xl">✔</div>
                <p class="font-black text-xl uppercase">{{ $work }}</p>
            </div>
            @endforeach
        </div>

        {{-- CTA FINAL --}}
        <div class="mt-20 text-center">
            <a href="https://api.whatsapp.com/send?phone=6287786000919" 
               class="inline-block px-16 py-8 bg-black text-white font-black text-3xl border-4 border-white shadow-[12px_12px_0px_0px_rgba(255,255,255,1)] hover:bg-[#3B82F6] transition-all uppercase italic">
                Hubungi Kami Sekarang →
            </a>
        </div>
    </div>
</section>

@endsection