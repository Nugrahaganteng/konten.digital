{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')
@section('title', 'Hubungi Kami - Konsultasi Gratis')

@section('content')

@php
    $heroS = $sections->get('hero');
    $infoS = $sections->get('info');
    $ctaS  = $sections->get('cta_bottom');

    // ── Helper: sama persis seperti di home ──────────────────────────────────
    // null  = field HIDDEN  → jangan render elemen HTML-nya
    // string = field aktif  → tampilkan nilainya (atau $default jika kosong)
    $val = function(?\App\Models\PageSection $section, string $key, string $default = '') {
        if (!$section) return $default;
        if ($section->isFieldHidden($key)) return null;
        $v = data_get($section->content, $key);
        return ($v !== null && $v !== '') ? $v : $default;
    };

    $hv = fn(string $k, string $d = '') => $val($heroS, $k, $d);
    $iv = fn(string $k, string $d = '') => $val($infoS, $k, $d);
    $bv = fn(string $k, string $d = '') => $val($ctaS,  $k, $d);

    // ── FIX Maps: handle full <iframe> HTML, embed URL, atau URL biasa ──
    $mapsRaw = $iv('maps_embed', '');

    if ($mapsRaw !== null && str_contains($mapsRaw, '<iframe')) {
        preg_match('/src=["\']([^"\']+)["\']/', $mapsRaw, $m);
        $mapsEmbed = $m[1] ?? '';
    } elseif ($mapsRaw !== null && str_contains($mapsRaw, 'google.com/maps/embed')) {
        $mapsEmbed = $mapsRaw;
    } elseif ($mapsRaw !== null && str_contains($mapsRaw, 'google.com/maps')) {
        $mapsEmbed = 'https://maps.google.com/maps?output=embed&' . parse_url($mapsRaw, PHP_URL_QUERY);
    } else {
        $mapsEmbed = '';
    }

    $mapsDefault = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.541432426!2d110.326699!3d-7.8710662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af9d7b99c960b%3A0x8b4b7b8be95d72f1!2sKontendigital.id!5e0!3m2!1sid!2sid!4v1714392000000!5m2!1sid!2sid';
    $finalEmbed  = (!empty($mapsEmbed)) ? $mapsEmbed : $mapsDefault;

    $mapsUrl = $iv('maps_url', 'https://www.google.com/maps/dir//Kontendigital.id');
@endphp

{{-- ── HERO SECTION ──────────────────────────────────────────────────────────── --}}
<section class="bg-[#FFD200] border-b-8 border-black pt-32 pb-24 relative overflow-hidden">
    <div class="absolute top-10 right-10 w-24 h-24 border-4 border-black rotate-12 opacity-10"></div>
    <div class="absolute bottom-10 left-10 w-32 h-32 bg-[#3D0066] border-4 border-black -rotate-6 opacity-10"></div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="max-w-3xl">

            {{-- Badge --}}
            @if($hv('badge_text') !== null)
            <div class="inline-block bg-[#3D0066] text-white font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-6 transform -rotate-1">
                {{ $hv('badge_text', "✦ Let's Talk Business") }}
            </div>
            @endif

            {{-- Title --}}
            @if($hv('title') !== null)
            <h1 class="font-black text-6xl md:text-8xl leading-[0.9] uppercase text-[#3D0066] mb-8 tracking-tighter">
                {{ $hv('title', 'KONSULTASI') }}
                <br><span class="bg-black text-[#FFD200] px-4 inline-block transform rotate-1">GRATIS!</span>
            </h1>
            @endif

            {{-- Subtitle --}}
            @if($hv('subtitle') !== null)
            <div class="border-l-8 border-black pl-6 py-2 mb-8">
                <p class="font-bold text-2xl text-black italic leading-tight">
                    "{{ $hv('subtitle', 'Ubah statement menjadi berita nasional dalam sekejap.') }}"
                </p>
            </div>
            @endif

            {{-- Description --}}
            @if($hv('description') !== null)
            <p class="font-bold text-lg text-black/80 max-w-xl leading-relaxed mb-10">
                {{ $hv('description', 'Siap meledakkan brand Anda di media nasional? Ceritakan kebutuhan Anda dan biar tim ahli kami yang mengurus sisanya.') }}
            </p>
            @endif

            {{-- CTA --}}
            @if($hv('cta_text') !== null || $hv('cta_url') !== null)
            <a href="#form-pesan"
               class="inline-block bg-black text-white px-10 py-5 font-black text-xl uppercase border-4 border-black shadow-[8px_8px_0px_0px_rgba(230,30,80,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all">
                {{ $hv('cta_text', 'Mulai Diskusi Sekarang →') }}
            </a>
            @endif
        </div>

        <div class="relative flex justify-center items-center h-[500px]">
            <div class="absolute w-[400px] h-[400px] border-8 border-black rounded-[40px] translate-x-6 translate-y-6"></div>
            <div class="relative w-[380px] h-[380px] bg-[#E61E50] border-8 border-black rounded-full shadow-[20px_20px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-hidden">
                @php $heroContactImage = ($heroS && !$heroS->isFieldHidden('image')) ? data_get($heroS->content, 'image') : null; @endphp
                @if($heroContactImage)
                    <img src="{{ Storage::url($heroContactImage) }}" alt="Consultation"
                         class="absolute w-[120%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-6">
                @else
                    <img src="/images/kontak.png" alt="Consultation"
                         class="absolute w-[120%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-6">
                @endif
            </div>
            <div class="absolute -top-5 -right-5 bg-white text-black border-4 border-black px-4 py-2 font-black rotate-12 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                ✦ FAST RESPONSE
            </div>
        </div>
    </div>
</section>

{{-- ── MAIN CONTENT ──────────────────────────────────────────────────────────── --}}
<section class="bg-white py-24" id="form-pesan">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

            {{-- ── KOLOM FORM ── --}}
            <div class="lg:col-span-7 bg-[#F8F8F8] border-8 border-black p-8 md:p-12 shadow-[16px_16px_0px_0px_rgba(61,0,102,1)] relative">
                <div class="absolute -top-4 -left-4 w-12 h-12 bg-[#FFD200] border-4 border-black rotate-45"></div>

                <h2 class="font-black text-4xl uppercase mb-10 italic tracking-tighter">
                    KIRIM <span class="text-[#E61E50]">PESAN</span> CEPAT
                </h2>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-4 border-green-600 text-green-800 font-bold p-4">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-6 bg-red-100 border-4 border-red-600 text-red-800 font-bold p-4">
                        ❌ {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" id="contact-form">
                    @csrf

                    <div class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Nama Lengkap</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="wa_name"
                                    class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] @error('name') border-red-500 @enderror"
                                    placeholder="Siapa nama Anda?"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="space-y-2">
                                <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">No. WhatsApp</label>
                                <input
                                    type="tel"
                                    name="phone"
                                    id="wa_phone"
                                    class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] @error('phone') border-red-500 @enderror"
                                    placeholder="0812xxxx"
                                    inputmode="numeric"
                                    pattern="[0-9+]*"
                                    maxlength="15"
                                    value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Alamat Email</label>
                            <input
                                type="email"
                                name="email"
                                id="wa_email"
                                class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] @error('email') border-red-500 @enderror"
                                placeholder="email@bisnisanda.com"
                                value="{{ old('email') }}">
                        </div>

                        <div class="space-y-2">
                            <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Layanan Utama</label>
                            <select
                                name="service"
                                id="wa_service"
                                class="w-full border-4 border-black p-4 font-black uppercase text-sm appearance-none bg-white focus:bg-[#FFD200]/20 focus:outline-none shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] cursor-pointer @error('service') border-red-500 @enderror">
                                <option value="">-- Pilih Layanan --</option>
                                @foreach(['Press Release','Backlink Media','Penulisan Artikel','Press Conference','Script Video','Pelatihan Konten Kreator'] as $svc)
                                    <option value="{{ $svc }}" {{ old('service') == $svc ? 'selected' : '' }}>{{ $svc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="font-black uppercase text-xs tracking-widest text-[#3D0066]">Detail Kebutuhan</label>
                            <textarea
                                name="message"
                                id="wa_message"
                                rows="5"
                                class="w-full border-4 border-black p-4 font-bold focus:bg-[#FFD200]/20 focus:outline-none transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] @error('message') border-red-500 @enderror"
                                placeholder="Apa target yang ingin Anda capai?">{{ old('message') }}</textarea>
                        </div>

                        <button
                            type="submit"
                            id="submit-btn"
                            class="w-full bg-[#3D0066] text-white font-black uppercase py-6 text-2xl border-4 border-black shadow-[10px_10px_0px_0px_rgba(255,210,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all italic disabled:opacity-60 disabled:cursor-not-allowed">
                            Kirim Pesan Sekarang →
                        </button>
                    </div>
                </form>
            </div>

            {{-- ── KOLOM INFO ── --}}
            <div class="lg:col-span-5 space-y-8">
                <div class="grid grid-cols-1 gap-6">
                    @php
                        $contactItems = [
                            [
                                'icon'    => 'M3 8L12 13L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z',
                                'label'   => 'Email Official',
                                'value'   => $iv('email', 'kontendigitalid10@gmail.com'),
                                'hidden'  => $iv('email') === null,
                                'bg'      => 'bg-[#FFD200]',
                            ],
                            [
                                'icon'    => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
                                'label'   => 'WhatsApp',
                                'value'   => $iv('whatsapp', '+62 877-8600-0919'),
                                'hidden'  => $iv('whatsapp') === null,
                                'bg'      => 'bg-[#E61E50] text-white',
                            ],
                            [
                                'icon'    => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',
                                'label'   => 'Head Office',
                                'value'   => $iv('address', 'Kaligawe, RT.02, Gandekan, Bantul, DIY 55711'),
                                'hidden'  => $iv('address') === null,
                                'bg'      => 'bg-[#3D0066] text-white',
                            ],
                        ];
                    @endphp

                    @foreach($contactItems as $item)
                    @if(!$item['hidden'])
                    <div class="border-4 border-black p-6 flex items-center gap-6 group hover:translate-x-2 transition-transform bg-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                        <div class="w-16 h-16 {{ $item['bg'] }} border-4 border-black flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-black uppercase text-[10px] tracking-widest opacity-60">{{ $item['label'] }}</p>
                            <p class="font-black text-lg">{{ $item['value'] }}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                {{-- Fast Response Card --}}
                <div class="bg-black text-white p-10 border-4 border-black relative overflow-hidden shadow-[12px_12px_0px_0px_rgba(230,30,80,1)]">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-[#FFD200] rotate-45 border-4 border-black flex items-end justify-center pb-2">
                        <span class="text-black font-black text-xs">READY</span>
                    </div>

                    @if($bv('response_time') !== null)
                    <h3 class="font-black text-3xl uppercase mb-4 text-[#FFD200] italic">
                        {{ $bv('response_time', 'RESPON < 1 JAM') }}
                    </h3>
                    @endif

                    @if($bv('description') !== null)
                    <p class="font-bold text-gray-400 leading-relaxed mb-8">
                        {{ $bv('description', 'Tim admin kami standby di jam kerja (09:00 - 17:00 WIB) untuk memastikan setiap pertanyaan Anda terjawab dengan tuntas.') }}
                    </p>
                    @endif

                    @if($bv('cta_url') !== null || $bv('cta_text') !== null)
                    <a href="{{ $bv('cta_url', 'https://wa.me/6287786000919') }}"
                       class="block text-center bg-[#E61E50] text-white font-black uppercase py-4 border-4 border-black hover:bg-white hover:text-black transition-all">
                        {{ $bv('cta_text', 'Chat Via WhatsApp Sekarang →') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── MAPS SECTION ──────────────────────────────────────────────────────────── --}}
@if($iv('maps_embed') !== null || $iv('maps_url') !== null)
<section class="bg-white pb-24 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="relative">
            <div class="absolute -top-6 left-10 z-30 bg-[#E61E50] text-white border-4 border-black px-6 py-2 font-black uppercase italic shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] pointer-events-none">
                ✦ Lokasi Workshop Kami
            </div>

            <div class="relative z-10 border-8 border-black shadow-[20px_20px_0px_0px_rgba(255,210,0,1)] overflow-hidden bg-gray-200">
                <iframe
                    src="{{ $finalEmbed }}"
                    class="w-full h-[450px] grayscale contrast-125 hover:grayscale-0 transition-all duration-700 block"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            @if($mapsUrl !== null)
            <div class="mt-8 flex justify-end relative z-20">
                <a href="{{ $mapsUrl }}"
                   target="_blank"
                   class="bg-black text-white px-8 py-4 font-black uppercase border-4 border-black shadow-[6px_6px_0px_0px_rgba(230,30,80,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all italic inline-block">
                    Buka Petunjuk Arah →
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ── SCRIPT ────────────────────────────────────────────────────────────────── --}}
<script>
    // ── Blokir huruf pada input No. WhatsApp ──────────────────────────────────
    const phoneInput = document.getElementById('wa_phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function () {
            const val = this.value;
            this.value = val.replace(/[^0-9+]/g, '');
        });
        phoneInput.addEventListener('keypress', function (e) {
            const allowed = /[0-9+]/;
            if (!allowed.test(e.key) && e.key.length === 1) {
                e.preventDefault();
            }
        });
        phoneInput.addEventListener('paste', function (e) {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData).getData('text');
            const cleaned = pasted.replace(/[^0-9+]/g, '');
            this.value = cleaned;
        });
    }

    // ── Disable tombol saat form sedang disubmit ──────────────────────────────
    const contactForm = document.getElementById('contact-form');
    const submitBtn   = document.getElementById('submit-btn');
    if (contactForm && submitBtn) {
        contactForm.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengirim... ⏳';
        });
    }
</script>

@endsection