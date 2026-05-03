{{-- resources/views/contact.blade.php --}}
{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('content')

@push('styles')
<style>
    /* Taruh di sini agar khusus aktif di halaman kontak saja */
    .input-neo {
        @apply w-full bg-white border-4 border-black px-4 py-3 font-bold text-black 
               shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] outline-none transition-all
               focus:shadow-none focus:translate-x-1 focus:translate-y-1 focus:bg-yellow-50;
    }

    .label-neo {
        @apply block font-black uppercase text-xs tracking-widest text-black mb-2;
    }

    /* Memastikan select box tidak terlihat default browser */
    select.input-neo {
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
    }
</style>
@endpush

<section class="py-24 bg-cyan-400 bg-retro-grid min-h-screen border-b-4 border-black relative overflow-hidden">
    
    {{-- Elemen Dekoratif Melayang --}}
    <div class="absolute top-20 left-10 animate-ufo opacity-20 text-6xl hidden lg:block">🛸</div>
    <div class="absolute bottom-20 right-10 animate-float-slow opacity-20 text-7xl hidden lg:block">📞</div>
    <div class="absolute top-1/2 right-5 animate-rocket opacity-20 text-5xl hidden lg:block">🚀</div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">

        {{-- ── HEADER ── --}}
        <div class="text-center mb-16 reveal">
            <div class="inline-block bg-yellow-400 border-4 border-black px-4 py-1 mb-6 shadow-neo-sm -rotate-2">
                <p class="font-black uppercase tracking-[0.3em] text-xs text-black">Get In Touch</p>
            </div>
            <h1 class="font-black text-5xl md:text-8xl text-purple-950 leading-none mb-6 text-glitch-heavy"
                style="font-family:'Unbounded',sans-serif">
                KONSULTASI<br><span class="text-white" style="-webkit-text-stroke:3px #000">GRATIS!</span>
            </h1>
            <p class="font-bold text-purple-950/80 max-w-lg mx-auto italic">
                "Punya pertanyaan atau butuh penawaran khusus? Tim kami siap membantu melejitkan brand Anda."
            </p>
        </div>

        {{-- Flash Success --}}
        @if(session('success'))
        <div class="border-4 border-black bg-green-400 p-5 mb-10 text-center shadow-neo animate-bounce-heavy reveal">
            <p class="font-black uppercase tracking-widest text-black">⚡ {{ session('success') }} ⚡</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

           
            {{-- ── FORM KIRI ── --}}
<div class="lg:col-span-7 card-retro bg-white p-8 md:p-12 reveal relative">
    <div class="corner-ornament tl"></div>
    <div class="corner-ornament br"></div>
    
    <div class="mb-10">
        <h2 class="font-black text-4xl text-black uppercase tracking-tighter leading-none" style="font-family:'Unbounded',sans-serif">
            Kirim <span class="text-red-500 underline decoration-black decoration-8">Sinyal</span>
        </h2>
        <p class="font-bold text-black/60 mt-2 italic text-sm">Ceritakan ide gila Anda, kami akan mewujudkannya.</p>
    </div>

    <form method="POST" action="{{ route('contact.send') }}" class="space-y-8">
        @csrf

        {{-- Baris 1: Nama & WhatsApp --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="input-group">
                <label class="label-neo" for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       placeholder="Siapa nama Anda?"
                       class="input-neo @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-[10px] font-black mt-2 uppercase tracking-tight">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <label class="label-neo" for="phone">No. WhatsApp</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                       placeholder="08xx-xxxx-xxxx"
                       class="input-neo">
            </div>
        </div>

        {{-- Baris 2: Email & Layanan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="input-group">
                <label class="label-neo" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       placeholder="email@perusahaan.com"
                       class="input-neo @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-[10px] font-black mt-2 uppercase tracking-tight">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group">
                <label class="label-neo" for="service">Layanan Utama</label>
                <div class="relative w-full">
                    <select id="service" name="service"
                            class="input-neo appearance-none @error('service') border-red-500 @enderror">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach(['Press Release','Backlink Media Nasional','Penulisan Artikel','Press Conference','Lainnya'] as $s)
                            <option value="{{ $s }}" {{ old('service') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none font-black text-xl">▼</div>
                </div>
            </div>
        </div>

        {{-- Baris 3: Pesan --}}
        <div class="input-group">
            <label class="label-neo" for="message">Detail Kebutuhan</label>
            <textarea id="message" name="message" rows="4"
                      placeholder="Ceritakan detail proyek Anda..."
                      class="input-neo @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
        </div>

        {{-- Tombol Submit --}}
        <div class="pt-4">
            <button type="submit" class="btn-pop w-full py-6 text-xl group bg-purple-950 text-white border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                KIRIM PESAN SEKARANG <span class="inline-block group-hover:translate-x-3 transition-transform">🚀</span>
            </button>
        </div>
    </form>
</div>

            {{-- ── INFO KANAN ── --}}
            <div class="lg:col-span-5 space-y-6">
                
                {{-- Kontak Cards --}}
                <div class="grid grid-cols-1 gap-4">
                    @foreach([
                        ['✉','Email','hello@kontendigital.id', 'bg-yellow-400'],
                        ['📍','Lokasi','Bogor, Indonesia', 'bg-white'],
                        ['⏰','Jam Kerja','09:00 - 17:00 WIB', 'bg-red-500 text-white'],
                    ] as [$icon, $label, $val, $color])
                    <div class="card-retro {{ $color }} p-6 flex gap-5 items-center reveal group hover:-rotate-1 transition-transform">
                        <span class="text-3xl animate-float">{{ $icon }}</span>
                        <div>
                            <p class="font-black text-[10px] tracking-[0.2em] uppercase opacity-70 mb-1">{{ $label }}</p>
                            <p class="font-black text-lg leading-none">{{ $val }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- WhatsApp High-Visibility Card --}}
                <div class="card-retro p-8 bg-purple-950 text-white reveal relative overflow-hidden">
                    {{-- Radar effect --}}
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-400/20 rounded-full animate-radar"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <p class="font-black text-yellow-400 text-xs tracking-widest uppercase">
                                FAST RESPONSE ADMIN
                            </p>
                        </div>
                        
                        <h3 class="font-black text-2xl mb-4 leading-tight" style="font-family:'Unbounded',sans-serif">
                            Butuh Jawaban <span class="text-cyan-400">Instan?</span>
                        </h3>
                        
                        <p class="text-white/70 text-sm font-bold leading-relaxed mb-8">
                            Admin kami siap melayani konsultasi via WhatsApp dengan respon kurang dari 60 menit pada jam kerja.
                        </p>

                        <a href="https://wa.me/6287786000919"
                           class="block w-full text-center bg-yellow-400 text-black font-black
                                  uppercase tracking-widest text-sm px-6 py-4
                                  border-4 border-black shadow-[6px_6px_0px_0px_#ef4444]
                                  hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                            CHAT WHATSAPP SEKARANG →
                        </a>
                    </div>
                </div>

                {{-- Mini Map / Ornamen --}}
                <div class="card-retro bg-black h-32 flex items-center justify-center reveal overflow-hidden group">
                    <p class="text-white font-black text-4xl tracking-tighter opacity-20 group-hover:opacity-100 group-hover:scale-150 transition-all duration-700">
                        KONTEN DIGITAL
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- FAQ Simple Section --}}
<section class="py-20 bg-white border-b-4 border-black">
    <div class="max-w-4xl mx-auto px-6">
        <div class="divider-neo mb-12"><span>FREQUENTLY ASKED</span></div>
        
        <div class="space-y-4">
            @foreach([
                'Berapa lama proses pengerjaan Press Release?' => 'Rata-rata pengerjaan 1-3 hari kerja tergantung antrean media.',
                'Apakah ada garansi jika tidak tayang?' => 'Ya! Garansi 100% uang kembali jika artikel tidak terbit di media yang disepakati.',
                'Apakah bisa bantu buatkan naskahnya?' => 'Tentu, kami memiliki tim penulis profesional untuk membantu drafting naskah Anda.'
            ] as $q => $a)
            <div class="border-4 border-black p-5 hover:bg-yellow-50 transition-colors reveal">
                <p class="font-black text-black uppercase text-sm mb-2">Q: {{ $q }}</p>
                <p class="font-bold text-black/60 text-sm">A: {{ $a }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection