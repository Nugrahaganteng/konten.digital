@extends('layouts.app')

@section('title', 'Pelatihan Konten Kreator - Kontendigital.id')

@section('content')

{{-- HERO SECTION --}}
<section class="relative pt-32 pb-24 bg-white border-b-8 border-black overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="space-y-8">
            <div class="inline-block px-6 py-2 border-4 border-black bg-[#F2B038] transform -rotate-1 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <span class="text-black font-black text-sm tracking-widest uppercase">UPGRADE SKILL KONTEN KREATORMU</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-black leading-none uppercase tracking-tighter">
                Ciptakan Konten <span class="bg-[#3B82F6] text-white px-4 inline-block transform rotate-1">Inovatif</span> dengan Smartphone
            </h1>

            <p class="text-xl font-bold text-black/80 leading-relaxed">
                Ikuti pelatihan konten kreator bersama Kontendigital.id. Materi ini akan membantu kamu menjadi kreator handal mulai dari proses pengambilan video, editing, hingga publikasi yang sesuai platform.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="https://api.whatsapp.com/send?phone=6287786000919" 
                   class="btn-pop bg-[#3B82F6] text-white px-10 py-5 text-2xl">
                    KONSULTASI SEKARANG →
                </a>
            </div>
        </div>

        <div class="relative flex justify-center">
            <div class="absolute inset-0 bg-[#F2B038] border-4 border-black rounded-full translate-x-4 translate-y-4 -z-10"></div>
            {{-- Image reference from Screen Shot 2026-05-05 at 13.48.xx --}}
            <img src="/images/creator-training-hero.png" alt="Pelatihan Konten Kreator" class="w-full max-w-md h-auto border-8 border-black shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] grayscale hover:grayscale-0 transition-all duration-500">
            
            <div class="absolute -bottom-5 right-0 bg-white border-4 border-black p-4 font-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                ✅ Pengajar Bersertifikasi BNSP
            </div>
        </div>
    </div>
</section>

{{-- MENGAPA HARUS IKUT --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-6xl font-black uppercase mb-16 italic text-center underline decoration-8 decoration-[#3B82F6]">Mengapa Harus Ikut Pelatihan Kami?</h2>
        <div class="grid md:grid-cols-4 gap-8">
            @php
                $reasons = [
                    ['Belajar Dari Ahlinya', 'Tim pengajar kami adalah mantan produser senior TV nasional dengan pengalaman lebih dari 20 tahun.'],
                    ['Pengajar BNSP', 'Tim bersertifikasi Badan Nasional Sertifikasi Profesi (BNSP) dengan gelar Certified Content Creator.'],
                    ['Materi Komprehensif', 'Mencakup seluruh aspek creation mulai dari teknik pengambilan gambar hingga strategi engagement.'],
                    ['Metode Fleksibel', 'Tersedia format kolektif maupun privat, cocok untuk perusahaan, instansi, maupun UMKM.']
                ];
            @endphp
            @foreach($reasons as $reason)
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:-translate-y-2 transition-all">
                <h3 class="font-black text-xl uppercase mb-4 leading-tight">{{ $reason[0] }}</h3>
                <p class="font-bold text-sm text-black/70">{{ $reason[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- MODUL MATERI (ACCORDION STYLE) --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-black text-white uppercase mb-4">Apa Saja Materi Pelatihan Kami?</h2>
            <p class="text-white font-bold">Pelatihan ini mencakup berbagai aspek penting dalam pembuatan konten.</p>
        </div>

        <div class="space-y-4">
            @php
                $modules = [
                    ['Modul 1: Pengenalan Dunia Konten Kreator', 'Niche content, personal branding, dan peran kreator di industri digital.'],
                    ['Modul 2: Persiapan dan Perencanaan', 'Ide konten, scriptwriting yang efektif, riset audiens, dan pembuatan storyboard.'],
                    ['Modul 3: Produksi Konten', 'Teknik kamera (angle, framing, lighting) dan penggunaan aksesoris smartphone.'],
                    ['Modul 4: Editing Video dengan Smartphone', 'Pengenalan aplikasi CapCut, dasar editing, transisi, musik, dan color correction.'],
                    ['Modul 5: Distribusi dan Promosi Video', 'Optimasi video untuk platform YouTube, Instagram, TikTok, dan Facebook.'],
                    ['Modul 6: Cuan dari Ngonten', 'Strategi monetisasi, affiliate marketing, endorse, dan penjualan produk/jasa.']
                ];
            @endphp
            @foreach($modules as $index => $module)
            <div class="bg-white border-4 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="p-6 flex justify-between items-center cursor-pointer hover:bg-gray-50 transition-colors">
                    <h3 class="font-black text-xl uppercase">{{ $module[0] }}</h3>
                    <span class="text-3xl font-black">+</span>
                </div>
                <div class="px-6 pb-6 pt-2 border-t-2 border-black/10">
                    <p class="font-bold text-black/70">{{ $module[1] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SIAPA YANG COCOK --}}
<section class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-5xl font-black text-center uppercase mb-20 tracking-tighter italic">Siapa Saja yang Cocok Mengikuti Pelatihan Ini?</h2>
        <div class="grid md:grid-cols-4 gap-8 text-center">
            @php
                $targets = [
                    ['Perusahaan Profesional', 'Perusahaan yang concern terhadap konten (properti, travel, RS, dsb).'],
                    ['Instansi & Lembaga', 'Sekolah, ponpes, universitas, dan lembaga pemerintahan.'],
                    ['Individu Kreator', 'Individu yang ingin menjadi kreator profesional atau meningkatkan kompetensi.'],
                    ['Business Owner & UMKM', 'Pemilik bisnis yang ingin mempromosikan produk melalui konten kreatif.']
                ];
            @endphp
            @foreach($targets as $target)
            <div class="flex flex-col items-center">
                <div class="w-20 h-20 bg-[#F2B038] border-4 border-black mb-6 rotate-3"></div>
                <h3 class="font-black text-xl uppercase mb-3 leading-tight">{{ $target[0] }}</h3>
                <p class="font-bold text-sm text-black/60">{{ $target[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FINAL CTA --}}
<section class="py-32 bg-[#F2B038] text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-5xl md:text-7xl font-black uppercase mb-10 leading-none">Siap Menciptakan Konten Berkualitas?</h2>
        <a href="https://api.whatsapp.com/send?phone=6287786000919" 
           class="inline-block bg-black text-white px-12 py-6 text-2xl font-black border-4 border-black shadow-[10px_10px_0px_0px_rgba(255,255,255,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all">
            HUBUNGI KAMI SEKARANG →
        </a>
    </div>
</section>

@endsection