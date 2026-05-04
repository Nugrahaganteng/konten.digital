@extends('layouts.app')

@section('title', 'Jasa Press Release Media Online Nasional - Konten Digital')

@section('content')

{{-- 1. HERO SECTION (Berdasarkan Konten Baru) --}}
<section class="relative pt-32 pb-24 overflow-hidden border-b-4 border-black bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
        <h1 class="text-5xl md:text-7xl font-black mb-6 leading-none uppercase italic">
            Jasa Press Release <br>
            <span class="bg-black text-yellow-400 px-4 inline-block rotate-1 mt-2 tracking-tighter text-6xl md:text-8xl">Kontendigital.id</span>
        </h1>
        <p class="max-w-4xl mx-auto text-xl font-bold mb-10">
            Kontendigital.id menjadi rekomendasi jasa press release dan publikasi media nasional yang mudah, murah, cepat, dan terjamin kualitasnya.
        </p>
        <div class="flex justify-center">
            <a href="https://api.whatsapp.com/send?phone=6287786000919" 
               class="bg-black text-white px-10 py-5 font-black text-xl uppercase shadow-[8px_8px_0px_0px_rgba(250,204,21,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                KONSULTASI SEKARANG →
            </a>
        </div>
    </div>
</section>

{{-- 2. MENGAPA HARUS PRESS RELEASE (Berdasarkan Gambar 5) --}}
<section class="py-24 bg-[#1a88d1] border-b-4 border-black text-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black uppercase italic mb-4">Mengapa Harus Press Release?</h2>
            <p class="font-bold">Press release memiliki peran penting dalam strategi pemasaran dan branding suatu perusahaan di antaranya:</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span> Sarana Promosi Bisnis yang Efektif
                </h3>
                <p class="text-sm font-medium leading-relaxed">Press release dapat menjadi sarana promosi produk dan jasa Anda. Pilihan media online yang relevan dengan kanal bisnis membantu mengerucutkan target pemasaran. Sasarannya tidak lagi skala lokal melainkan nasional.</p>
            </div>
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span> Media Branding yang Powerfull
                </h3>
                <p class="text-sm font-medium leading-relaxed">Tampil eksklusif dan diliput banyak media besar akan membuat reputasi dan kredibilitas bisnis Anda meroket. Lewat media placement, visibilitas brand, produk, atau kegiatan Anda lebih terekspose sehingga bisnis makin dikenal luas.</p>
            </div>
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span> Memudahkan Urusan Public Relation
                </h3>
                <p class="text-sm font-medium leading-relaxed">Berbagai urusan publikasi bisnis, baik itu peluncuran produk, penyelenggaraan event, hingga klarifikasi masalah perusahaan, kini bisa dilakukan dengan mudah & cepat lewat media placement atau jasa press release berbiaya murah.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span> Syarat Verifikasi di Media Sosial dan Marketplace
                </h3>
                <p class="text-sm font-medium leading-relaxed">Tunjukkan bahwa brand Anda populer dan pernah muncul di media-media online ternama. Dengan bukti publikasi media, verifikasi centang biru di Instagram, Facebook page, Tiktok dan Youtube, hingga pendaftaran akun bisnis di Shopee Mall menjadi jauh lebih mudah.</p>
            </div>
            <div class="bg-white text-black p-8 border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-black mb-4 flex items-center gap-2">
                    <span class="bg-blue-100 p-1 rounded-full text-blue-600">✓</span> Konten Iklan yang Sangat Kuat
                </h3>
                <p class="text-sm font-medium leading-relaxed">Anda bisa memaksimalkan press release yang sudah terbit di media online sebagai konten iklan di berbagai platform. Cukup screenshot press release yang sudah tayang, kemudian iklankan. Konten iklan seperti ini jauh lebih powerfull dibanding desain atau copywriting biasa.</p>
            </div>
        </div>
    </div>
</section>

{{-- 3. MATERI PUBLIKASI (Berdasarkan Gambar 4) --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="relative border-4 border-black p-12 bg-[url('https://images.unsplash.com/photo-1495020689067-958852a7765e?q=80&w=2069&auto=format&fit=crop')] bg-cover bg-center">
            <div class="absolute inset-0 bg-white/90"></div>
            <div class="relative z-10 text-center">
                <h2 class="text-3xl font-black uppercase mb-8">Pilih Materi Publikasi Sesuai Kebutuhan Anda!</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-left max-w-4xl mx-auto font-bold">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Promosi launching/peluncuran bisnis atau brand
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Kegiatan sosial atau kemasyarakatan
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Memperkenalkan produk atau jasa baru
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">•</span> Promosi perusahaan, event, seminar, kegiatan kampus, dll
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. COCOK UNTUK SIAPA (Berdasarkan Gambar 4 Bawah) --}}
<section class="py-24 bg-[#f8f9fa] border-y-4 border-black">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-center text-3xl font-black uppercase mb-16 italic">Jasa Press Release Ini Cocok untuk Siapa Saja?</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center p-4">
                <div class="text-5xl mb-4 flex justify-center">🏢</div>
                <h4 class="font-black uppercase mb-2">Brand, Perusahaan, maupun UMKM</h4>
                <p class="text-xs font-bold opacity-70 leading-relaxed">Langkah tepat untuk menambah calon customer atau calon klien dari brand, perusahaan, maupun UMKM.</p>
            </div>
            <div class="text-center p-4">
                <div class="text-5xl mb-4 flex justify-center">👤</div>
                <h4 class="font-black uppercase mb-2">Entrepreneur dan Profesional</h4>
                <p class="text-xs font-bold opacity-70 leading-relaxed">Reputasi dan elektabilitas Anda akan melesat karena nama Anda tercantum di media-media nasional.</p>
            </div>
            <div class="text-center p-4">
                <div class="text-5xl mb-4 flex justify-center">📱</div>
                <h4 class="font-black uppercase mb-2">Selebgram, Influencer, Youtuber</h4>
                <p class="text-xs font-bold opacity-70 leading-relaxed">Komisi endorsement Anda akan jauh lebih tinggi karena pernah diliput media nasional.</p>
            </div>
            <div class="text-center p-4">
                <div class="text-5xl mb-4 flex justify-center">👥</div>
                <h4 class="font-black uppercase mb-2">Institusi dan Komunitas</h4>
                <p class="text-xs font-bold opacity-70 leading-relaxed">Institusi atau komunitas Anda akan jauh lebih dipercaya sehingga banyak anggota baru berdatangan.</p>
            </div>
        </div>
    </div>
</section>

{{-- 5. MENGAPA KLIEN MEMILIH KAMI (Berdasarkan Gambar 2) --}}
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-black mb-12">Mengapa Klien Memilih Jasa Press Release <span class="text-blue-600 italic">Kontendigital.id?</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            {{-- Row 1 --}}
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">⏱️ Proses Cepat dan Mudah</h4>
                <p class="text-sm font-medium opacity-80">Tim kami berpengalaman dan profesional sehingga prosesnya bisa dilakukan dengan cepat dan mudah.</p>
            </div>
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">🛡️ Garansi 100% Tayang</h4>
                <p class="text-sm font-medium opacity-80">Jika tidak bisa tayang karena kebijakan redaksi, kami akan memberikan alternatif media sepadan atau full refund.</p>
            </div>
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">✍️ Revisi Sepuasnya</h4>
                <p class="text-sm font-medium opacity-80">Kami memberikan garansi revisi sepuasnya, terutama dalam penulisan artikel jika ada kesalahan dari kami.</p>
            </div>
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">📞 Admin Cepat Tanggap</h4>
                <p class="text-sm font-medium opacity-80">Admin kami segera merespon pertanyaan atau permintaan Anda dengan cepat dan tanggap.</p>
            </div>
            {{-- Row 2 --}}
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">💰 Biaya Murah</h4>
                <p class="text-sm font-medium opacity-80">Kontendigital.id memberikan harga yang super murah tanpa mengorbankan kualitas press release Anda.</p>
            </div>
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">📰 Banyak Pilihan Media</h4>
                <p class="text-sm font-medium opacity-80">Kami memiliki lebih dari 200 list media sehingga Anda bisa memilih media sesuai dengan kebutuhan Anda.</p>
            </div>
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">📝 Gratis Penulisan Draft</h4>
                <p class="text-sm font-medium opacity-80">Jika Anda belum memiliki artikel, kami akan membuatkan draft artikel tanpa biaya tambahan.</p>
            </div>
            <div>
                <h4 class="font-black mb-2 flex items-center gap-2 uppercase">🎁 Bonus Media</h4>
                <p class="text-sm font-medium opacity-80">Setiap pembelian paket minimal 5 media, kami akan memberikan bonus media dari kami.</p>
            </div>
        </div>
    </div>
</section>

{{-- 6. PAKET HARGA (Berdasarkan Gambar 1 - DATA SANGAT PENTING) --}}
<section class="py-24 bg-[#1a88d1] border-y-4 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-black uppercase mb-16 text-white italic">Paket Harga Jasa Press Release Media Online</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            {{-- BRONZE --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-purple-600 uppercase mb-2">BRONZE</h3>
                <div class="text-sm line-through text-red-500 font-bold">Rp 3.750.000,-</div>
                <div class="text-3xl font-black mb-6">Rp 3.000.000</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di 3 media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                </ul>
                <a href="#" class="mt-auto block w-full bg-gradient-to-r from-cyan-400 to-purple-500 text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">Konsultasi Sekarang</a>
            </div>

            {{-- SILVER --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-gray-500 uppercase mb-2">SILVER</h3>
                <div class="text-sm line-through text-red-500 font-bold">Rp 5.750.000,-</div>
                <div class="text-3xl font-black mb-6">Rp 4.750.000</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di 5 media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                </ul>
                <a href="#" class="mt-auto block w-full bg-[#333] text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">Konsultasi Sekarang</a>
            </div>

            {{-- GOLD --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-yellow-600 uppercase mb-2">GOLD</h3>
                <div class="text-sm line-through text-red-500 font-bold">Rp 11.000.000,-</div>
                <div class="text-3xl font-black mb-6">Rp 9.000.000</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di 10 media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                </ul>
                <a href="#" class="mt-auto block w-full bg-yellow-600 text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">Konsultasi Sekarang</a>
            </div>

            {{-- PLATINUM --}}
            <div class="bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex flex-col h-full">
                <h3 class="text-2xl font-black text-blue-800 uppercase mb-2">PLATINUM</h3>
                <div class="text-sm line-through text-red-500 font-bold">Rp 15.750.000,-</div>
                <div class="text-3xl font-black mb-6">Rp 12.750.000</div>
                <ul class="text-[11px] font-bold space-y-2 mb-8 text-left uppercase">
                    <li>✔️ Artikel terbit di 15 media</li>
                    <li>✔️ Bebas pilih media*</li>
                    <li>✔️ Berita tayang permanen</li>
                    <li>✔️ Garansi tayang</li>
                    <li>✔️ Garansi uang kembali</li>
                    <li>✔️ Gratis pembuatan artikel</li>
                    <li>✔️ Index Google</li>
                    <li>✔️ Laporan tautan URL</li>
                    <li>✔️ Proses tayang 1-3 hari</li>
                    <li class="text-blue-600">✔️ Bonus media dari kami</li>
                </ul>
                <a href="#" class="mt-auto block w-full bg-gradient-to-r from-cyan-400 to-blue-700 text-white py-3 font-black uppercase text-sm rounded-lg border-2 border-black">Konsultasi Sekarang</a>
            </div>
        </div>
    </div>
</section>

{{-- 7. MITRA (Berdasarkan Gambar 3) --}}
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-black uppercase mb-4">Lebih dari 100+ Mitra di Seluruh Indonesia</h2>
        <p class="font-bold mb-12 opacity-70">Kontendigital.id telah digunakan oleh berbagai klien, mulai dari personal, organisasi, BUMN, perusahaan nasional, hingga perusahaan multinasional.</p>
        
        {{-- Grid Logo (Placeholder Representatif sesuai gambar) --}}
        <div class="grid grid-cols-3 md:grid-cols-6 gap-8 items-center opacity-80 grayscale hover:grayscale-0 transition-all">
            <div class="font-black text-xl">PATRIOSA</div>
            <div class="font-black text-xl italic text-red-600">Pengusaha Kuliner</div>
            <div class="font-black text-xl text-green-600">INFRGY</div>
            <div class="font-black text-xl">PGS</div>
            <div class="font-black text-xl">DOGUE</div>
            <div class="font-black text-xl">BIODERMA</div>
            <div class="font-black text-xl">CLEAN LIVING</div>
            <div class="font-black text-xl">VOLANTIS</div>
            <div class="font-black text-xl text-red-500">Indotrading</div>
            <div class="font-black text-xl">UMROH.IN</div>
            <div class="font-black text-xl">Fortglass</div>
            <div class="font-black text-xl italic">tugu jogja</div>
        </div>
    </div>
</section>

<footer class="py-20 bg-black text-white text-center border-t-4 border-black">
    <h2 class="text-5xl font-black uppercase mb-8 italic text-yellow-400">SIAP UNTUK GO NATIONAL?</h2>
    <a href="https://api.whatsapp.com/send?phone=6287786000919" class="inline-block bg-white text-black px-12 py-6 font-black text-2xl uppercase shadow-[8px_8px_0px_0px_rgba(250,204,21,1)]">
        HUBUNGI KAMI SEKARANG →
    </a>
</footer>

@endsection