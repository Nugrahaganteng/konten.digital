{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
<section class="py-24 bg-white border-b-4 border-black">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-3">Hubungi Kami</p>
            <h1 class="font-black text-5xl md:text-7xl text-black leading-none mb-4"
                style="font-family:'Unbounded',sans-serif">
                Konsultasi<br>Gratis
            </h1>
            <div class="divider-neo max-w-xs mx-auto mt-6"><span>✦</span></div>
        </div>

        {{-- Flash Success --}}
        @if(session('success'))
        <div class="border-4 border-black bg-yellow-400 p-5 mb-8 text-center shadow-neo reveal">
            <p class="font-black uppercase tracking-widest text-black">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- ── FORM ── --}}
            <div class="lg:col-span-3 card-retro p-8 reveal">
                <h2 class="font-black text-2xl text-black mb-6 uppercase tracking-tight"
                    style="font-family:'Unbounded',sans-serif">Kirim Pesan</h2>

                <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="label-neo" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   placeholder="Nama Anda"
                                   class="input-neo @error('name') border-red-500 @enderror">
                            @error('name')
                            <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="label-neo" for="phone">No. WhatsApp</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                   placeholder="08xx-xxxx-xxxx"
                                   class="input-neo">
                        </div>
                    </div>

                    <div>
                        <label class="label-neo" for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               placeholder="email@domain.com"
                               class="input-neo @error('email') border-red-500 @enderror">
                        @error('email')
                        <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label-neo" for="service">Layanan yang Diinginkan</label>
                        <select id="service" name="service"
                                class="input-neo @error('service') border-red-500 @enderror">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach(['Press Release','Backlink Media Nasional','Penulisan Artikel',
                                      'Press Conference','Script Video / TV','Pelatihan Konten Kreator','Lainnya'] as $s)
                            <option value="{{ $s }}" {{ old('service') == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                            @endforeach
                        </select>
                        @error('service')
                        <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="label-neo" for="message">Pesan / Kebutuhan Anda</label>
                        <textarea id="message" name="message" rows="5"
                                  placeholder="Ceritakan kebutuhan press release Anda..."
                                  class="input-neo @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-pop w-full py-4 text-center text-base">
                        Kirim Pesan →
                    </button>
                </form>
            </div>

            {{-- ── INFO ── --}}
            <div class="lg:col-span-2 space-y-4 reveal">
                @foreach([
                    ['✉','Email','hello@kontendigital.id'],
                    ['☎','WhatsApp','+62 821-xxxx-xxxx'],
                    ['◉','Lokasi','Bogor, Indonesia'],
                    ['◈','Jam Kerja','Sen–Jum: 09:00–17:00 WIB'],
                ] as [$icon, $label, $val])
                <div class="card-retro p-5 flex gap-4 items-start">
                    <span class="text-yellow-400 text-xl w-6 shrink-0 text-center font-bold">{{ $icon }}</span>
                    <div>
                        <p class="font-black text-xs tracking-widest uppercase text-black/50 mb-1">{{ $label }}</p>
                        <p class="font-bold text-black text-sm">{{ $val }}</p>
                    </div>
                </div>
                @endforeach

                {{-- WA Card --}}
                <div class="card-retro p-6 bg-purple-950 text-white">
                    <p class="font-black text-yellow-400 text-xs tracking-widest uppercase mb-3">
                        RESPON CEPAT
                    </p>
                    <div class="divider-neo mb-4 opacity-30"><span>✦</span></div>
                    <p class="text-white/70 text-sm leading-relaxed mb-5">
                        Admin kami merespon dalam waktu kurang dari 1 jam di hari kerja. Untuk keperluan mendesak, hubungi via WhatsApp.
                    </p>
                    <a href="https://wa.me/6281234567890"
                       class="block w-full text-center bg-yellow-400 text-black font-black
                              uppercase tracking-widest text-sm px-6 py-3
                              border-4 border-black shadow-neo-sm
                              hover:translate-y-1 hover:shadow-none transition-all">
                        Chat WhatsApp →
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection