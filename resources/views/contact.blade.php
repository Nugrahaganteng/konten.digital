{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Hubungi Kami - Konsultasi Gratis')

@section('content')

{{-- ── HERO SECTION (Sesuai Referensi Gambar) ──────────────── --}}
<section class="bg-[#FFD200] border-b-8 border-black pt-32 pb-24 relative overflow-hidden">
    {{-- Dekorasi Latar Belakang --}}
    <div class="absolute top-10 right-10 w-24 h-24 border-4 border-black rotate-12 opacity-10"></div>
    <div class="absolute bottom-10 left-10 w-32 h-32 bg-[#3D0066] border-4 border-black -rotate-6 opacity-10"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="max-w-3xl">
            <div class="inline-block bg-[#3D0066] text-white font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-6 transform -rotate-1">
                ✦ Let's Talk Business
            </div>
            <h1 class="font-black text-6xl md:text-8xl leading-[0.9] uppercase text-[#3D0066] mb-8 tracking-tighter">
                KONSULTASI <br><span class="bg-black text-[#FFD200] px-4 inline-block transform rotate-1">GRATIS!</span>
            </h1>
            <div class="border-l-8 border-black pl-6 py-2 mb-8">
                <p class="font-bold text-2xl text-black italic leading-tight">
                    "Ubah statement menjadi berita nasional dalam sekejap."
                </p>
            </div>
            <p class="font-bold text-lg text-black/80 max-w-xl leading-relaxed mb-10">
                Siap meledakkan brand Anda di media nasional? Ceritakan kebutuhan Anda dan biar tim ahli kami yang mengurus sisanya.
            </p>
            <a href="#form-pesan" class="inline-block bg-black text-white px-10 py-5 font-black text-xl uppercase border-4 border-black shadow-[8px_8px_0px_0px_rgba(230,30,80,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all">
                Mulai Diskusi Sekarang →
            </a>
        </div>

        {{-- Visual Side (Style ala Referensi Gambar) --}}
        <div class="relative flex justify-center items-center h-[500px]">
            {{-- Frame Belakang --}}
            <div class="absolute w-[400px] h-[400px] border-8 border-black rounded-[40px] translate-x-6 translate-y-6"></div>
            {{-- Lingkaran Merah --}}
            <div class="relative w-[380px] h-[380px] bg-[#E61E50] border-8 border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-hidden">
                <img src="/images/kontak.png" alt="Consultation" 
                     class="absolute w-[120%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-6">
            </div>
            
            {{-- Badge Melayang --}}
            <div class="absolute -top-5 -right-5 bg-white text-black border-4 border-black px-4 py-2 font-black rotate-12 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                ✦ FAST RESPONSE
            </div>
        </div>
    </div>
</section>

{{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
<section class="bg-white py-24" id="form-pesan">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

            {{-- KOLOM FORM (7/12) --}}
            <div class="lg:col-span-7 bg-[#F8F8F8] border-8 border-black p-8 md:p-12 shadow-[16px_16px_0px_0px_rgba(61,0,102,1)] relative">
                {{-- Aksen Kuning di Pojok --}}
                <div class="absolute -top-4 -left-4 w-12 h-12 bg-[#FFD200] border-4 border-black rotate-45"></div>
                
                <h2 class="font-black text-4xl uppercase mb-10 italic tracking-tighter">
                    KIRIM <span class="text-[#E61E50]">PESAN</span> CEPAT
                </h2>

                {{-- Status Alerts --}}
                @if(session('success'))
                    <div class="bg-[#FFD200] border-4 border-black p-5 mb-8 flex items-center gap-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        <p class="font-black uppercase text-sm italic">{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"
                                placeholder="Siapa nama Anda?">
                        </div>
                        <div class="space-y-2">
                            <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">No. WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"
                                placeholder="0812xxxx">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"
                            placeholder="email@bisnisanda.com">
                    </div>

                    <div class="space-y-2">
                        <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Layanan Utama</label>
                        <select name="service" required
                            class="w-full border-4 border-black p-4 font-black uppercase text-sm appearance-none bg-white focus:bg-[#FFD200]/20 focus:outline-none shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] cursor-pointer">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach(['Press Release','Backlink Media','Penulisan Artikel','Press Conference','Script Video'] as $s)
                                <option value="{{ $s }}">{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Detail Kebutuhan</label>
                        <textarea name="message" rows="5" required
                            class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"
                            placeholder="Apa target yang ingin Anda capai?">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#3D0066] text-white font-black uppercase py-6 text-2xl border-4 border-black shadow-[10px_10px_0px_0px_rgba(255,210,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all italic">
                        Kirim Pesan Sekarang →
                    </button>
                </form>
            </div>

            {{-- KOLOM INFO (5/12) --}}
            <div class="lg:col-span-5 space-y-8">
                <div class="grid grid-cols-1 gap-6">
                    @php
                        $contacts = [
                            ['M3 8L12 13L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z', 'Email Official', 'kontendigitalid10@gmail.com', 'bg-[#FFD200]'],
                            ['M12 18L12 21M12 3L12 6M3 12L6 12M18 12L21 12M17 17L19 19M5 5L7 7M17 7L19 5M5 17L7 15', 'WhatsApp 1', '+62 877-8600-0919', 'bg-[#E61E50] text-white'],
                            ['M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'Head Office', 'Jakarta, Indonesia', 'bg-[#3D0066] text-white'],
                        ];
                    @endphp

                    @foreach($contacts as [$path, $label, $val, $color])
                    <div class="border-4 border-black p-6 flex items-center gap-6 group hover:translate-x-2 transition-transform bg-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                        <div class="w-16 h-16 {{ $color }} border-4 border-black flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"></path></svg>
                        </div>
                        <div>
                            <p class="font-black uppercase text-[10px] tracking-widest opacity-60">{{ $label }}</p>
                            <p class="font-black text-lg">{{ $val }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Fast Response Card --}}
                <div class="bg-black text-white p-10 border-4 border-black relative overflow-hidden shadow-[12px_12px_0px_0px_rgba(230,30,80,1)]">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-[#FFD200] rotate-45 border-4 border-black flex items-end justify-center pb-2">
                        <span class="text-black font-black text-xs">READY</span>
                    </div>
                    <h3 class="font-black text-3xl uppercase mb-4 text-[#FFD200] italic">RESPON < 1 JAM</h3>
                    <p class="font-bold text-gray-400 leading-relaxed mb-8">
                        Tim admin kami standby di jam kerja (09:00 - 17:00 WIB) untuk memastikan setiap pertanyaan Anda terjawab dengan tuntas.
                    </p>
                    <a href="https://wa.me/6287786000919" class="block text-center bg-[#E61E50] text-white font-black uppercase py-4 border-4 border-black hover:bg-white hover:text-black transition-all">
                        Chat Via WhatsApp Sekarang →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MAPS SECTION (Tambahkan di bawah Section Main Content) ── --}}
<section class="bg-white pb-24 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="relative">
            {{-- Judul Kecil/Badge --}}
            <div class="absolute -top-6 left-10 z-30 bg-[#E61E50] text-white border-4 border-black px-6 py-2 font-black uppercase italic shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
                ✦ Lokasi Workshop Kami
            </div>

            {{-- Container Map --}}
            <div class="relative z-10 border-8 border-black shadow-[20px_20px_0px_0px_rgba(255,210,0,1)] overflow-hidden bg-gray-200">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.541432426!2d110.326699!3d-7.8710662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af9d7b99c960b%3A0x8b4b7b8be95d72f1!2sKontendigital.id!5e0!3m2!1sid!2sid!4v1714392000000!5m2!1sid!2sid" 
                    class="w-full h-[450px] grayscale contrast-125 hover:grayscale-0 transition-all duration-700 block" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            {{-- Aksen Tombol --}}
            <div class="mt-8 flex justify-end relative z-20">
                <a href="https://www.google.com/maps/dir//Kontendigital.id/@-7.8710662,110.326699,20z" 
                   target="_blank"
                   class="bg-black text-white px-8 py-4 font-black uppercase border-4 border-black shadow-[6px_6px_0px_0px_rgba(230,30,80,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all italic inline-block">
                    Buka Petunjuk Arah →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── SOCIAL FOOTER (Re-Styled) ───────────────────────────── --}}
<section class="bg-[#3D0066] py-16 border-t-8 border-black">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h3 class="text-[#FFD200] font-black text-3xl uppercase italic mb-10 tracking-tighter">KONEKSIKAN BRAND ANDA</h3>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach(['Instagram' => 'instagram.com/kontendigitalid/', 'Facebook' => 'facebook.com/people/Kontendigitalid/61564783021098/', 'TikTok' => 'tiktok.com/@kontendigitalid'] as $name => $link)
                <a href="https://{{ $link }}" target="_blank" 
                   class="px-8 py-4 bg-white border-4 border-black font-black uppercase hover:bg-[#FFD200] hover:-translate-y-2 transition-all shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    {{ $name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

@endsection