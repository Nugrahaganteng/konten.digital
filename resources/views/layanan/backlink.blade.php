@extends('layouts.app')

@section('title', 'Jasa Backlink Media Nasional - Kontendigital.id')

@section('content')

{{-- HERO SECTION - Berdasarkan Foto 1 & 2 --}}
<section class="relative pt-32 pb-24 bg-white overflow-hidden border-b-8 border-black">
    <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
        <div class="inline-block px-6 py-2 border-4 border-black bg-[#F2B038] transform -rotate-2 mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <span class="text-black font-black text-sm tracking-widest uppercase italic">JASA PRESS RELEASE</span>
        </div>

        <h1 class="text-5xl md:text-8xl font-black text-black leading-none uppercase tracking-tighter mb-8">
            <span class="bg-black text-white px-4">KONTENDIGITAL.ID</span>
        </h1>

        <p class="text-xl md:text-2xl font-bold text-black max-w-3xl mx-auto mb-10 leading-relaxed">
            Kontendigital.id menjadi rekomendasi jasa press release dan publikasi media nasional yang mudah, murah, cepat, dan terjamin kualitasnya.
        </p>

        <a href="https://api.whatsapp.com/send?phone=6287786000919" 
           class="inline-block px-10 py-5 bg-black text-[#F2B038] font-black text-2xl border-4 border-black hover:bg-[#F2B038] hover:text-black transition-all transform hover:-translate-y-2 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] uppercase">
            Konsultasi Sekarang →
        </a>
    </div>
</section>

{{-- MANFAAT SECTION (BIRU) - Berdasarkan Foto 1 & 5 --}}
<section class="py-24 bg-[#3B82F6] border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="inline-block text-4xl md:text-5xl font-black text-white uppercase italic mb-4">
                Manfaat Backlink Media Nasional
            </h2>
            <p class="text-white font-bold text-lg">Backlink media nasional memiliki beberapa manfaat sebagai berikut:</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Card 1 --}}
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <img src="/icons/visitor.svg" alt="Icon" class="w-10 h-10">
                </div>
                <h3 class="text-xl font-black uppercase mb-4">Meningkatkan Jumlah Pengunjung (Visitor)</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">
                    Backlink dapat meningkatkan visibilitas di kalangan audiens yang lebih luas. Pengunjung website media nasional yang tertarik dengan topik website Anda dapat diarahkan melalui backlink ini.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <img src="/icons/google.svg" alt="Icon" class="w-10 h-10">
                </div>
                <h3 class="text-xl font-black uppercase mb-4">Memudahkan Google Menemukan Website Anda</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">
                    Memudahkan mesin pencarian Google dalam menemukan website yang Anda miliki. Ketika seseorang memasukkan kata kunci yang sesuai, Google akan memberikan referensi website Anda.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-white p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <div class="w-16 h-16 bg-[#F2B038] border-4 border-black flex items-center justify-center mb-6">
                    <img src="/icons/authority.svg" alt="Icon" class="w-10 h-10">
                </div>
                <h3 class="text-xl font-black uppercase mb-4">Meningkatkan Authority Website</h3>
                <p class="font-bold text-black/70 text-sm leading-relaxed">
                    Meningkatkan reputasi yang tinggi dan dianggap sebagai sumber berita terpercaya. Google memberikan nilai tambah pada website yang menerima backlink dari sumber otoritatif.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- WHY CHOOSE US - Berdasarkan Foto 6 --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-black uppercase mb-16">
            Mengapa Klien Memilih Jasa <span class="text-[#3B82F6]">Kontendigital.id?</span>
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12">
            {{-- Item 1 --}}
            <div class="flex gap-6">
                <div class="text-4xl">⏱️</div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Proses Cepat dan Mudah</h4>
                    <p class="font-bold text-black/60 text-sm">Tim kami berpengalaman dan profesional sehingga prosesnya bisa dilakukan dengan cepat.</p>
                </div>
            </div>
            {{-- Item 2 --}}
            <div class="flex gap-6">
                <div class="text-4xl">✅</div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Garansi 100% Tayang</h4>
                    <p class="font-bold text-black/60 text-sm">Garansi tayang di media online, jika tidak bisa tayang kami berikan alternatif media sepadan atau full refund.</p>
                </div>
            </div>
            {{-- Item 3 --}}
            <div class="flex gap-6">
                <div class="text-4xl">✍️</div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Revisi Sepuasnya</h4>
                    <p class="font-bold text-black/60 text-sm">Kami memberikan garansi revisi sepuasnya, terutama dalam penulisan artikel jika ada kesalahan dari kami.</p>
                </div>
            </div>
            {{-- Item 4 --}}
            <div class="flex gap-6">
                <div class="text-4xl">💰</div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Biaya Murah</h4>
                    <p class="font-bold text-black/60 text-sm">Memberikan harga yang super murah tanpa mengorbankan kualitas press release Anda.</p>
                </div>
            </div>
            {{-- Item 5 --}}
            <div class="flex gap-6">
                <div class="text-4xl">📰</div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Banyak Pilihan Media</h4>
                    <p class="font-bold text-black/60 text-sm">Memiliki lebih dari 200 list media sehingga Anda bisa memilih media sesuai kebutuhan.</p>
                </div>
            </div>
            {{-- Item 6 --}}
            <div class="flex gap-6">
                <div class="text-4xl">📄</div>
                <div>
                    <h4 class="font-black uppercase text-lg mb-2">Gratis Penulisan Draft</h4>
                    <p class="font-bold text-black/60 text-sm">Jika Anda belum memiliki artikel, kami akan membuatkan draft artikel tanpa biaya tambahan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MEDIA PARTNER LOGO - Berdasarkan Foto 3 --}}
<section class="py-20 bg-gray-50 border-t-8 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-center font-black uppercase tracking-widest mb-12">Partner Media Kami</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-70 grayscale">
            {{-- Gunakan teks jika logo belum ada, atau ganti ke <img> --}}
            <span class="text-center font-black">DETIK.COM</span>
            <span class="text-center font-black">LIPUTAN6</span>
            <span class="text-center font-black">KOMPAS.COM</span>
            <span class="text-center font-black">SINDONEWS</span>
            <span class="text-center font-black">VIVA.CO.ID</span>
            <span class="text-center font-black">TRIBUNNEWS</span>
        </div>
    </div>
</section>

{{-- CTA FINAL --}}
<section class="py-24 bg-black text-center">
    <h2 class="text-4xl md:text-6xl font-black text-[#F2B038] uppercase mb-10">SIAP UNTUK GO NATIONAL?</h2>
    <a href="https://api.whatsapp.com/send?phone=6287786000919" 
       class="inline-block px-12 py-6 bg-white text-black font-black text-2xl border-4 border-[#F2B038] hover:bg-[#F2B038] transition-all uppercase">
        Hubungi Kami Sekarang →
    </a>
</section>

@endsection