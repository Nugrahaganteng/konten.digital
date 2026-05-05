{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Hubungi Kami - Konsultasi Gratis')

@section('content')

{{-- ── HERO SECTION ─────────────────────────────────────────── --}}
<section class="bg-[#F2B038] border-b-8 border-black pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-10 right-10 w-32 h-32 border-4 border-black rotate-12 opacity-20"></div>
    <div class="absolute bottom-[-20px] left-10 w-64 h-20 bg-red-500 border-4 border-black -rotate-3 hidden md:block"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center md:text-left">
        <div class="inline-block bg-black text-white font-black text-xs uppercase tracking-widest px-4 py-2 mb-6">
            Let's Talk Business
        </div>
        <h1 class="font-black text-5xl md:text-8xl leading-none uppercase text-black italic" style="font-family:'Unbounded',sans-serif">
            KONSULTASI <br><span class="text-white" style="-webkit-text-stroke: 3px black">GRATIS!</span>
        </h1>
        <p class="mt-6 font-bold text-black text-xl max-w-2xl border-l-8 border-black pl-6">
            Siap meledakkan brand Anda di media nasional? Ceritakan kebutuhan Anda dan biar tim ahli kami yang mengurus sisanya.
        </p>
    </div>
</section>

{{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
<section class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- KOLOM FORM (7/12) --}}
            <div class="lg:col-span-7 bg-white border-8 border-black p-8 md:p-12 shadow-[16px_16px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="font-black text-3xl uppercase mb-10 underline decoration-red-500 decoration-8 underline-offset-8">
                    Kirim Pesan Cepat
                </h2>

                {{-- ── FLASH SUCCESS ── --}}
                @if(session('success'))
                    <div class="bg-green-400 border-4 border-black p-5 mb-8 flex items-center gap-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <span class="text-3xl">✅</span>
                        <p class="font-black uppercase text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                {{-- ── FLASH ERROR (validasi) ── --}}
                @if($errors->any())
                    <div class="bg-red-400 border-4 border-black p-5 mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <p class="font-black uppercase text-xs tracking-widest mb-3">⚠ Mohon perbaiki kesalahan berikut:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="font-bold text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="font-black uppercase text-xs tracking-widest">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full border-4 border-black p-4 font-bold focus:bg-yellow-100 focus:outline-none transition-colors @error('name') border-red-500 bg-red-50 @enderror"
                                placeholder="Nama Anda...">
                            @error('name')
                                <p class="text-red-600 font-bold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="font-black uppercase text-xs tracking-widest">No. WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required
                                class="w-full border-4 border-black p-4 font-bold focus:bg-yellow-100 focus:outline-none transition-colors @error('phone') border-red-500 bg-red-50 @enderror"
                                placeholder="0812...">
                            @error('phone')
                                <p class="text-red-600 font-bold text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="font-black uppercase text-xs tracking-widest">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border-4 border-black p-4 font-bold focus:bg-yellow-100 focus:outline-none transition-colors @error('email') border-red-500 bg-red-50 @enderror"
                            placeholder="anda@email.com">
                        @error('email')
                            <p class="text-red-600 font-bold text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="font-black uppercase text-xs tracking-widest">Layanan Utama</label>
                        <select name="service" required
                            class="w-full border-4 border-black p-4 font-black uppercase text-sm appearance-none bg-white focus:bg-yellow-100 focus:outline-none @error('service') border-red-500 bg-red-50 @enderror">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach(['Press Release','Backlink Media','Penulisan Artikel','Press Conference','Script Video'] as $s)
                                <option value="{{ $s }}" {{ old('service') === $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('service')
                            <p class="text-red-600 font-bold text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="font-black uppercase text-xs tracking-widest">Detail Kebutuhan</label>
                        <textarea name="message" rows="5" required
                            class="w-full border-4 border-black p-4 font-bold focus:bg-yellow-100 focus:outline-none transition-colors @error('message') border-red-500 bg-red-50 @enderror"
                            placeholder="Apa yang bisa kami bantu?">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-600 font-bold text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-black text-white font-black uppercase py-6 text-xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(239,68,68,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                        Kirim Pesan Sekarang →
                    </button>
                </form>
            </div>

            {{-- KOLOM INFO (5/12) --}}
            <div class="lg:col-span-5 space-y-8">

                {{-- Quick Contact Cards --}}
                <div class="grid grid-cols-1 gap-6">
                    @php
                        $contacts = [
                            ['✉️', 'Email Official', 'kontendigitalid10@gmail.com', 'bg-blue-400'],
                            ['📱', 'WhatsApp Support', '+62 877-8600-0919', 'bg-green-400'],
                            ['📱', 'WhatsApp Support', '+62 812-1967-610', 'bg-green-400'],
                            ['📍', 'Head Office', 'Jakarta, Indonesia', 'bg-purple-400'],
                        ];
                    @endphp

                    @foreach($contacts as [$icon, $label, $val, $color])
                    <div class="border-4 border-black p-6 flex items-center gap-6 group hover:translate-x-2 transition-transform bg-white">
                        <div class="w-16 h-16 {{ $color }} border-4 border-black flex items-center justify-center text-3xl shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            {{ $icon }}
                        </div>
                        <div>
                            <p class="font-black uppercase text-[10px] tracking-widest opacity-50">{{ $label }}</p>
                            <p class="font-black text-lg">{{ $val }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Fast Response Notice --}}
                <div class="bg-black text-white p-8 border-4 border-black relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-red-500 rotate-12 flex items-center justify-center border-4 border-black font-black">
                        FAST
                    </div>
                    <h3 class="font-black text-2xl uppercase mb-4 text-yellow-400">Respon &lt; 1 Jam</h3>
                    <p class="font-bold text-gray-400 leading-relaxed mb-6">
                        Kami menghargai waktu Anda. Tim admin kami standby di jam kerja (09:00 - 17:00 WIB) untuk merespon pertanyaan Anda secepat kilat.
                    </p>
                    <a href="https://wa.me/6287786000919"
                        class="inline-block bg-yellow-400 text-black font-black uppercase px-6 py-3 border-2 border-black hover:bg-white transition-colors">
                        Langsung WA Admin →
                    </a>
                </div>

                {{-- Social Connect --}}
                <div class="p-8 border-4 border-black bg-gray-100 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="font-black uppercase mb-6 italic text-xl underline decoration-yellow-400 decoration-4">Ikuti Kami</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="https://www.instagram.com/kontendigitalid/" target="_blank"
                           class="flex items-center justify-center p-3 bg-white border-4 border-black font-black text-xs hover:bg-yellow-400 transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                            INSTAGRAM
                        </a>
                        <a href="https://www.facebook.com/people/Kontendigitalid/61564783021098/" target="_blank"
                           class="flex items-center justify-center p-3 bg-white border-4 border-black font-black text-xs hover:bg-blue-600 hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                            FACEBOOK
                        </a>
                        <a href="https://www.youtube.com/@kontendigitalid" target="_blank"
                           class="flex items-center justify-center p-3 bg-white border-4 border-black font-black text-xs hover:bg-red-600 hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                            YOUTUBE
                        </a>
                        <a href="https://www.tiktok.com/@kontendigitalid" target="_blank"
                           class="flex items-center justify-center p-3 bg-white border-4 border-black font-black text-xs hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px]">
                            TIKTOK
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ── CTA BOTTOM ────────────────────────────────────────────── --}}
<section class="bg-black py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-white font-black text-4xl md:text-6xl uppercase mb-8" style="font-family:'Unbounded',sans-serif">
            BANGUN <span class="text-red-500 underline">OTORITAS</span> BRAND ANDA SEKARANG
        </h2>
        <p class="text-gray-500 font-bold max-w-2xl mx-auto mb-10 uppercase tracking-widest text-sm">
            Lebih dari 500+ Brand telah mempercayakan publikasi media mereka kepada KontenDigital.id
        </p>
    </div>
</section>

@endsection