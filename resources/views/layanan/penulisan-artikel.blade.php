@extends('layouts.app')

@section('title', 'Jasa Penulis Artikel SEO Terpercaya - Kontendigital.id')

@section('content')

{{-- HERO SECTION --}}
<section class="relative pt-32 pb-24 bg-white border-b-8 border-black overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="space-y-8">
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#F2B038] transform -rotate-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="text-black font-black text-sm tracking-widest uppercase">JASA PENULIS ARTIKEL SEO TERPERCAYA</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-black leading-none uppercase tracking-tighter">
                Dapatkan Konten <span class="bg-[#3B82F6] text-white px-4 inline-block transform rotate-1">Berkualitas</span> Tanpa Batas
            </h1>

            <p class="text-xl font-bold text-black/80 leading-relaxed">
                Jasa penulis artikel SEO, konten media, jasa copywriter, dan masih banyak lagi. Kami juga melayani pembuatan script untuk kebutuhan video di televisi, YouTube, maupun media social lainnya.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="https://api.whatsapp.com/send?phone=6287786000919" 
                   class="btn-pop bg-[#3B82F6] text-white px-10 py-5 text-2xl">
                    KONSULTASI SEKARANG →
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="absolute inset-0 bg-[#F2B038] border-4 border-black rounded-full translate-x-4 translate-y-4 -z-10"></div>
            <img src="/images/article-hero.png" alt="Penulisan Artikel" class="w-full h-auto border-8 border-black shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] grayscale hover:grayscale-0 transition-all duration-500">
            
            {{-- Floating Badges --}}
            <div class="absolute -top-5 -right-5 bg-white border-4 border-black p-4 font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] animate-bounce">
                ✅ SEO Friendly
            </div>
            <div class="absolute -bottom-5 -left-5 bg-black text-white border-4 border-white p-4 font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                Hasil Bergaransi
            </div>
        </div>
    </div>
</section>

{{-- MASALAH & SOLUSI --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <img src="/images/thinking-woman.png" class="w-full grayscale border-4 border-black shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
        </div>
        <div>
            <h2 class="text-4xl font-black uppercase mb-10 leading-tight">Apakah Anda Mengalami Hal Ini?</h2>
            <div class="space-y-4">
                @php
                    $problems = [
                        'Tidak tahu cara riset kata kunci',
                        'Merasa harga jasa penulisan artikel sangat mahal',
                        'Butuh banyak artikel dalam waktu cepat',
                        'Tidak punya ide untuk menulis',
                        'Trauma dengan jasa penulis artikel asal-asalan',
                        'Tidak punya banyak waktu'
                    ];
                @endphp
                @foreach($problems as $problem)
                <div class="flex items-center gap-4 p-4 bg-red-50 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <span class="text-red-600 font-black text-xl">✘</span>
                    <span class="font-bold">{{ $problem }}</span>
                </div>
                @endforeach
            </div>
            <p class="mt-10 text-2xl font-black italic text-[#3B82F6]">Jika iya, maka berarti Kontendigital.id solusinya!</p>
        </div>
    </div>
</section>

{{-- WHY TRUST US --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center text-white">
        <h2 class="text-4xl md:text-6xl font-black uppercase mb-16 italic">Mengapa Harus Percaya pada Kontendigital.id?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @php
                $trusts = [
                    'Konsultasi Gratis', 'Penulis Profesional & Berpengalaman', 'Lolos Copyright', 
                    'Revisi Sepuasnya', 'Harga Murah', 'Pengerjaan Cepat'
                ];
            @endphp
            @foreach($trusts as $trust)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-black">
                <div class="w-12 h-12 bg-[#F2B038] border-2 border-black mx-auto mb-4 flex items-center justify-center">
                    <span class="text-white">✔</span>
                </div>
                <h3 class="font-black text-xl uppercase">{{ $trust }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- GOOGLE VS AUDIENS --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-black text-center uppercase mb-16">Mengapa Brand Anda Membutuhkan Konten Artikel SEO yang Relevan dan Berkualitas?</h2>
        <div class="grid md:grid-cols-2 gap-10">
            {{-- Google Side --}}
            <div class="border-8 border-black shadow-[12px_12px_0px_0px_#ef4444]">
                <div class="bg-[#ef4444] p-4 text-white font-black uppercase border-b-4 border-black">Dari Sisi Google, Konten Tersebut Dapat:</div>
                <div class="p-8 space-y-6">
                    <div class="flex gap-4 font-bold"><span class="text-green-600">✔</span> Menunjukkan keahlian penulis</div>
                    <div class="flex gap-4 font-bold"><span class="text-green-600">✔</span> Menambah kredibilitas konten dan brand</div>
                    <div class="flex gap-4 font-bold"><span class="text-green-600">✔</span> Meningkatkan otoritas dan kewenangan website Anda</div>
                </div>
            </div>
            {{-- Audiens Side --}}
            <div class="border-8 border-black shadow-[12px_12px_0px_0px_#3B82F6]">
                <div class="bg-[#3B82F6] p-4 text-white font-black uppercase border-b-4 border-black">Dari Sisi Audiens, Konten Tersebut Bisa:</div>
                <div class="p-8 space-y-6">
                    <div class="flex gap-4 font-bold"><span class="text-green-600">✔</span> Menjawab kebutuhan atau masalah mereka</div>
                    <div class="flex gap-4 font-bold"><span class="text-green-600">✔</span> Meningkatkan keterlibatan (engagement)</div>
                    <div class="flex gap-4 font-bold"><span class="text-green-600">✔</span> Memperkuat kepercayaan karena informasi konten kredibel</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TOPIK --}}
<section class="py-24 bg-[#F2B038] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-4xl font-black uppercase mb-6">Jasa Penulisan Apa yang Anda Butuhkan?</h2>
            <p class="font-bold mb-10">Kami menyediakan berbagai jenis konten, mulai dari artikel ringan hingga yang membutuhkan riset mendalam.</p>
            <div class="grid grid-cols-2 gap-y-4 font-black">
                @php
                    $topics = ['Teknologi', 'Kesehatan', 'Website', 'Parenting', 'Pendidikan', 'Travel', 'Otomotif', 'Zakat', 'Musik', 'Gaya Hidup', 'Furniture', 'Kuliner', 'Haji & Umroh', 'Desain Grafis'];
                @endphp
                @foreach($topics as $topic)
                <div class="flex items-center gap-2 underline decoration-4 decoration-black">✦ {{ $topic }}</div>
                @endforeach
                <div class="italic">...dan masih banyak lagi</div>
            </div>
        </div>
        <img src="/images/woman-laptop.png" class="w-full border-8 border-black shadow-[15px_15px_0px_0px_rgba(0,0,0,1)]">
    </div>
</section>

{{-- CARA BEKERJA --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-center uppercase mb-20">Bagaimana Kami Bekerja?</h2>
        <div class="grid md:grid-cols-5 gap-4">
            @php
                $steps = [
                    ['1. Konsultasi', 'Sampaikan kebutuhan Anda dan target audiens.'],
                    ['2. Perencanaan', 'Kami merancang konten sesuai tujuan Anda.'],
                    ['3. Penulisan', 'Penulis mulai mengerjakan artikel sesuai brief.'],
                    ['4. Tahap Revisi', 'Layanan revisi untuk memastikan kepuasan Anda.'],
                    ['5. Pengiriman', 'Artikel siap meningkatkan kualitas konten Anda.']
                ];
            @endphp
            @foreach($steps as $step)
            <div class="p-6 border-4 border-black bg-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-2 transition-transform">
                <h3 class="font-black text-lg mb-4 uppercase leading-tight">{{ $step[0] }}</h3>
                <p class="text-sm font-bold text-black/70">{{ $step[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection