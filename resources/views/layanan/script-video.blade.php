@extends('layouts.app')

@section('title', 'Jasa Pembuatan Script Video Profesional - Kontendigital.id')

@section('content')

{{-- HERO SECTION --}}
<section class="relative pt-32 pb-24 bg-white border-b-8 border-black overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="space-y-8">
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#3B82F6] text-white transform -rotate-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="font-black text-sm tracking-widest uppercase">BUAT VIDEO YANG MENGINSPIRASI</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-black leading-none uppercase tracking-tighter">
                Jasa Pembuatan <span class="bg-[#F2B038] px-4 inline-block transform rotate-2">Script Video</span> Profesional
            </h1>

            <p class="text-xl font-bold text-black/80 leading-relaxed">
                Kontendigital.id mengerti betapa pentingnya memiliki script video yang tidak hanya menarik perhatian, tetapi juga menceritakan kisah Anda dengan cara yang mempengaruhi dan menginspirasi audiens.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="https://api.whatsapp.com/send?phone=6287786000919" 
                   class="btn-pop bg-[#F2B038] text-black px-10 py-5 text-2xl">
                    KONSULTASI SEKARANG →
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="absolute inset-0 bg-[#3B82F6] border-4 border-black rounded-full translate-x-4 translate-y-4 -z-10"></div>
            {{-- Image placeholder sesuai gambar --}}
            <img src="/images/script-hero.png" alt="Jasa Script Video" class="w-full h-auto border-8 border-black shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] grayscale hover:grayscale-0 transition-all duration-500">
            
            <div class="absolute -top-5 -left-5 bg-white border-4 border-black p-4 font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                Tim Berpengalaman & Professional
            </div>
        </div>
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black uppercase mb-16 text-center italic tracking-tighter">Kenapa Memilih Kontendigital.id?</h2>
        <div class="grid md:grid-cols-4 gap-8">
            @php
                $reasons = [
                    ['Penulis Berpengalaman', 'Tim kami terdiri dari penulis yang telah berpengalaman lebih dari 15 tahun dalam industri video dan televisi.'],
                    ['Tim Kreatif & Inovatif', 'Kami mengerti betapa pentingnya ide-ide segar dan orisinal dalam dunia hiburan.'],
                    ['Sesuai Kebutuhan', 'Kami menyesuaikan penulisan sesuai dengan kebutuhan dan gaya Anda, baik iklan maupun YouTube.'],
                    ['Proses Kolaboratif', 'Kolaborasi adalah kunci kesuksesan, maka Kami selalu terbuka untuk feedback/revisi.']
                ];
            @endphp
            @foreach($reasons as $reason)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:bg-[#3B82F6] transition-colors">
                <h3 class="font-black text-xl uppercase mb-4 group-hover:text-white">{{ $reason[0] }}</h3>
                <p class="font-bold text-sm leading-relaxed group-hover:text-white/90">{{ $reason[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SERVICES LIST --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-white uppercase text-center mb-20 tracking-tighter underline decoration-8 decoration-black underline-offset-8">Apa Saja Layanan Kami?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @php
                $services = [
                    ['Script Video Pendek', 'Buat video pendek yang mengesankan dengan naskah yang kuat dan persuasif.'],
                    ['Script Video Perusahaan', 'Menciptakan script yang mampu menggambarkan nilai, visi, dan misi perusahaan Anda.'],
                    ['Script Video Iklan', 'Buat iklan yang mencuri perhatian dan meningkatkan konversi dengan narasi memikat.'],
                    ['Script Konten YouTube', 'Script yang tepat untuk vlog, tutorial, atau cerita dalam konten Anda.'],
                    ['Script Konten Sosmed', 'Script menarik yang mendukung video konten sosial media Anda berpotensi viral.'],
                    ['Script Feature/Dokumenter', 'Penulisan naskah video feature atau dokumenter yang informatif dan menginspirasi.']
                ];
            @endphp
            @foreach($services as $service)
            <div class="bg-white p-10 border-4 border-black shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-12 h-12 bg-[#F2B038] border-4 border-black rotate-12 group-hover:rotate-45 transition-transform"></div>
                <h3 class="font-black text-2xl uppercase mb-6 leading-none">{{ $service[0] }}</h3>
                <p class="font-bold text-black/70 leading-relaxed">{{ $service[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WORK PROCESS --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-center uppercase mb-20 tracking-tighter">Proses Kerja Kami Dalam Pembuatan Script</h2>
        <div class="space-y-6">
            @php
                $steps = [
                    ['01. Konsultasi Awal', 'Kami berdiskusi dengan Anda untuk memahami visi, tujuan, dan target audiens.'],
                    ['02. Rancang Konsep', 'Kami mengembangkan konsep cerita dan struktur naskah.'],
                    ['03. Penulisan Draft', 'Kami menulis draft pertama naskah dan menyerahkannya untuk review Anda.'],
                    ['04. Revisi/Finalisasi', 'Berdasarkan feedback Anda, kami melakukan revisi hingga naskah siap untuk produksi.'],
                    ['05. Dukungan Produksi', 'Kami tetap mendampingi selama proses produksi untuk memastikan naskah diterapkan sempurna.']
                ];
            @endphp
            @foreach($steps as $step)
            <div class="flex flex-col md:flex-row items-center gap-8 p-8 border-4 border-black bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:translate-x-2 transition-transform">
                <div class="text-4xl font-black uppercase text-[#3B82F6] min-w-[300px]">
                    {{ $step[0] }}
                </div>
                <p class="font-bold text-xl leading-relaxed">
                    {{ $step[1] }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection