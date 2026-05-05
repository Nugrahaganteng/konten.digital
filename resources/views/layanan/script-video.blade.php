@extends('layouts.app')

@section('title', 'Jasa Pembuatan Script Video Profesional - Kontendigital.id')

@section('content')

{{-- HERO SECTION - Berdasarkan Foto Referensi --}}
<section class="relative pt-32 pb-24 bg-[#FFD200] overflow-hidden border-b-8 border-black">
    {{-- Decorative Background Rocket --}}
    <div class="absolute bottom-10 right-10 opacity-30 animate-pulse hidden md:block">
        <svg class="w-32 h-32 text-[#E61E50]" fill="currentColor" viewBox="0 0 24 24"><path d="M13.13 14.71L8.5 10.08L10 8.58L14.63 13.21L13.13 14.71M16 11L11.5 6.5L12.58 5.42C13.08 4.92 13.9 4.92 14.41 5.42L18.58 9.58C19.08 10.09 19.08 10.91 18.58 11.42L16 11M5.41 18.59L2 22L5.41 18.59C5.91 19.09 6.74 19.09 7.24 18.59L11.38 14.45L6.75 9.82L2.61 13.96C2.11 14.46 2.11 15.29 2.61 15.79L5.41 18.59Z"/></svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-4 items-center relative z-10">
        {{-- Text Side --}}
        <div class="space-y-6">
            <div class="inline-block px-4 py-1 border-2 border-black bg-[#3D0066] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <span class="text-white font-black text-xs tracking-widest uppercase">✦ JASA SCRIPT VIDEO PROFESIONAL</span>
            </div>

            <h1 class="text-6xl md:text-8xl font-black text-[#3D0066] leading-[0.9] uppercase tracking-tighter">
                BUAT VIDEO <br>
                YANG LEBIH <br>
                <span class="bg-black text-[#FFD200] px-2 italic">BERPENGARUH</span>
            </h1>

            <div class="border-l-4 border-black pl-4 py-2">
                <p class="text-xl font-bold text-black italic">
                    "Ubah konsep Anda menjadi naskah yang menginspirasi audiens."
                </p>
            </div>

            <p class="text-lg font-bold text-black/80 max-w-md leading-tight">
                Kontendigital.id menciptakan script video yang tidak hanya menarik perhatian, tetapi juga menceritakan kisah Anda dengan cara yang mempengaruhi dan menginspirasi audiens.
            </p>

            <a href="https://api.whatsapp.com/send?phone=6287786000919" 
               class="inline-block px-8 py-4 bg-black text-white font-black text-xl border-4 border-black hover:bg-[#3D0066] transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-tighter">
                KONSULTASI SEKARANG →
            </a>
        </div>

        {{-- Image Side (Neo-Brutalism Frame) --}}
        <div class="relative flex justify-center items-center h-[550px]">
    {{-- Big Black Frame --}}
    <div class="absolute w-[420px] h-[420px] border-[6px] border-black rounded-[40px] -translate-x-6 -translate-y-6"></div>
    
    {{-- Pink Circle --}}
    <div class="relative w-[380px] h-[380px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center">
        
        {{-- Image: Menaikkan posisi dengan -translate-y agar tidak "tenggelam" --}}
        <img src="/images/vidio1.png" alt="Jasa Script Video" 
             class="absolute w-[115%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
        
        {{-- Floating Bubble --}}
        <div class="absolute top-10 -right-12 bg-white border-4 border-black rounded-full px-6 py-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-20">
            <span class="font-black text-sm uppercase">GREAT SCRIPT!!!</span>
            <div class="absolute -bottom-2 left-4 w-4 h-4 bg-white border-b-4 border-r-4 border-black rotate-45"></div>
        </div>
    </div>

    {{-- Floating Badges --}}
    <div class="absolute top-5 -right-4 bg-[#3D0066] text-white border-4 border-black px-4 py-2 font-black text-xs uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform rotate-6 z-30">
        ✦ CREATIVE TEAM
    </div>
    <div class="absolute -bottom-6 -left-10 bg-white text-black border-4 border-black px-4 py-2 font-black text-xs uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-3 z-30">
        ✦ PRODUKSI PROFESIONAL
    </div>
</div>
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black uppercase mb-16 text-center italic tracking-tighter text-[#3D0066]">Kenapa Memilih Kami?</h2>
        <div class="grid md:grid-cols-4 gap-8">
            @php
                $reasons = [
                    ['Penulis Berpengalaman', 'Tim kami terdiri dari penulis yang telah berpengalaman lebih dari 15 tahun.'],
                    ['Tim Kreatif', 'Kami mengerti betapa pentingnya ide-ide segar dan orisinal dalam dunia hiburan.'],
                    ['Sesuai Kebutuhan', 'Kami menyesuaikan penulisan sesuai dengan gaya Anda, baik iklan maupun YouTube.'],
                    ['Kolaboratif', 'Kami selalu terbuka untuk feedback dan revisi demi hasil yang sempurna.']
                ];
            @endphp
            @foreach($reasons as $reason)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:bg-[#3D0066] transition-all">
                <div class="w-12 h-12 bg-[#FFD200] border-2 border-black flex items-center justify-center mb-6 group-hover:bg-white transition-colors">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="font-black text-xl uppercase mb-4 group-hover:text-[#FFD200] transition-colors leading-none">{{ $reason[0] }}</h3>
                <p class="font-bold text-sm leading-tight group-hover:text-white transition-colors">{{ $reason[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SERVICES LIST --}}
<section class="py-24 bg-[#3D0066] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-[#FFD200] uppercase text-center mb-20 tracking-tighter underline decoration-8 decoration-black underline-offset-8">Layanan Kami</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @php
                $services = [
                    ['Script Video Pendek', 'Buat video pendek yang mengesankan dengan naskah yang kuat.'],
                    ['Script Perusahaan', 'Menciptakan script yang menggambarkan nilai dan visi perusahaan.'],
                    ['Script Video Iklan', 'Buat iklan yang mencuri perhatian dan meningkatkan konversi.'],
                    ['Script YouTube', 'Script yang tepat untuk vlog, tutorial, atau cerita konten Anda.'],
                    ['Script Sosmed', 'Script menarik yang mendukung video sosial media Anda viral.'],
                    ['Script Dokumenter', 'Penulisan naskah video dokumenter yang informatif.']
                ];
            @endphp
            @foreach($services as $service)
            <div class="bg-white p-10 border-4 border-black shadow-[10px_10px_0px_0px_#FFD200] group hover:-translate-y-2 transition-all">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-4 h-4 bg-[#E61E50] border-2 border-black"></div>
                    <div class="w-full h-1 bg-black"></div>
                </div>
                <h3 class="font-black text-2xl uppercase mb-4 leading-none">{{ $service[0] }}</h3>
                <p class="font-bold text-black/70 leading-relaxed italic">"{{ $service[1] }}"</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WORK PROCESS --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-center uppercase mb-20 tracking-tighter text-[#3D0066]">Proses Kerja</h2>
        <div class="space-y-4">
            @php
                $steps = [
                    ['01', 'KONSULTASI AWAL', 'Memahami visi, tujuan, dan target audiens Anda.'],
                    ['02', 'RANCANG KONSEP', 'Mengembangkan konsep cerita dan struktur naskah.'],
                    ['03', 'PENULISAN DRAFT', 'Menulis draft pertama naskah untuk review Anda.'],
                    ['04', 'REVISI & FINAL', 'Melakukan revisi hingga naskah siap untuk produksi.'],
                    ['05', 'DUKUNGAN PRODUKSI', 'Mendampingi proses produksi untuk hasil sempurna.']
                ];
            @endphp
            @foreach($steps as $step)
            <div class="flex flex-col md:flex-row items-center gap-6 p-6 border-4 border-black bg-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:bg-[#FFD200] transition-all group">
                <div class="text-5xl font-black text-[#E61E50] group-hover:text-black transition-colors">
                    {{ $step[0] }}
                </div>
                <div class="flex-1">
                    <h4 class="text-2xl font-black uppercase leading-none mb-1">{{ $step[1] }}</h4>
                    <p class="font-bold text-black/70">{{ $step[2] }}</p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-10 h-10 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection