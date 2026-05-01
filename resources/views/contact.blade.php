{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
<section class="py-24 bg-cream">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-3">Hubungi Kami</p>
            <h1 class="headline-retro text-5xl md:text-7xl mb-4">Konsultasi Gratis</h1>
            <div class="divider-retro max-w-xs mx-auto"><span>✦</span></div>
        </div>

        @if(session('success'))
        <div class="border-2 border-sage bg-sage/10 p-5 mb-8 text-center reveal">
            <p class="font-typewriter text-sage tracking-widest">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- Form --}}
            <div class="lg:col-span-3 card-retro p-8 reveal">
                <h2 class="font-serif-display font-bold text-ink text-2xl mb-6">Kirim Pesan</h2>
                <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="label-retro" for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="input-retro @error('name') border-rust @enderror"
                                placeholder="Nama Anda">
                            @error('name')<p class="font-mono text-rust text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="label-retro" for="phone">No. WhatsApp</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="input-retro" placeholder="08xx-xxxx-xxxx">
                        </div>
                    </div>
                    <div>
                        <label class="label-retro" for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="input-retro @error('email') border-rust @enderror"
                            placeholder="email@domain.com">
                        @error('email')<p class="font-mono text-rust text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label-retro" for="service">Layanan yang Diinginkan</label>
                        <select id="service" name="service" class="input-retro @error('service') border-rust @enderror">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach(['Press Release','Backlink Media Nasional','Penulisan Artikel','Press Conference','Script Video / TV','Pelatihan Konten Kreator','Lainnya'] as $s)
                            <option value="{{ $s }}" {{ old('service') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('service')<p class="font-mono text-rust text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label-retro" for="message">Pesan / Kebutuhan Anda</label>
                        <textarea id="message" name="message" rows="5"
                            class="input-retro @error('message') border-rust @enderror"
                            placeholder="Ceritakan kebutuhan press release Anda...">{{ old('message') }}</textarea>
                        @error('message')<p class="font-mono text-rust text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn-retro w-full py-3 text-center">Kirim Pesan →</button>
                </form>
            </div>

            {{-- Info --}}
            <div class="lg:col-span-2 space-y-5 reveal">
                @foreach([
                    ['✉','Email','hello@kontendigital.id'],
                    ['☎','WhatsApp','+62 821-xxxx-xxxx'],
                    ['◉','Lokasi','Jakarta, Indonesia'],
                    ['◈','Jam Kerja','Sen–Jum: 09:00–17:00 WIB'],
                ] as [$icon, $label, $val])
                <div class="card-retro p-5 flex gap-4 items-start">
                    <span class="text-gold text-xl w-6 shrink-0 text-center">{{ $icon }}</span>
                    <div>
                        <p class="font-typewriter text-sepia text-xs tracking-widest uppercase mb-1">{{ $label }}</p>
                        <p class="font-mono text-ink text-sm">{{ $val }}</p>
                    </div>
                </div>
                @endforeach

                <div class="card-retro p-5 bg-ink">
                    <p class="font-typewriter text-gold text-xs tracking-widest mb-2">RESPON CEPAT</p>
                    <div class="divider-retro mb-3"><span class="text-gold/30">✦</span></div>
                    <p class="font-mono text-cream/70 text-xs leading-relaxed">
                        Admin kami merespon dalam waktu kurang dari 1 jam di hari kerja. Untuk keperluan mendesak, hubungi via WhatsApp.
                    </p>
                    <a href="https://wa.me/6281234567890" class="btn-retro w-full text-center block mt-4 text-xs">
                        Chat WhatsApp →
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection