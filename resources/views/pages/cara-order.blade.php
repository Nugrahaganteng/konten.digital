{{-- resources/views/pages/cara-order.blade.php --}}
@extends('layouts.app')
@section('title', 'Cara Order - KontenDigital.id')

@section('content')

@php
    $heroS  = $sections->get('hero');
    $stepsS = $sections->get('steps');
    $ctaS   = $sections->get('cta');

    $hv = fn($k, $d = '') => $heroS  ? ($heroS->get($k)  ?: $d) : $d;
    $sv = fn($k, $d = '') => $stepsS ? ($stepsS->get($k) ?: $d) : $d;
    $cv = fn($k, $d = '') => $ctaS   ? ($ctaS->get($k)   ?: $d) : $d;

    // Build steps array dari CMS dengan fallback hardcode
    $defaultSteps = [
        ['Konsultasi',   'Konsultasikan rencana, tujuan, dan materi press release Anda. Semua jenis event dan branding bisa.'],
        ['Pilih Paket',  'Pilih paket layanan press release yang paling sesuai dengan target audiens dan budget Anda.'],
        ['Isi Form Order','Lengkapi data detail pemesanan melalui form praktis yang kami kirimkan via WhatsApp.'],
        ['Invoice',      'Kami akan mengirimkan rincian biaya resmi (invoice) setelah form order kami validasi.'],
        ['Pembayaran',   'Lakukan pembayaran. Pesanan Anda segera masuk antrian prioritas produksi kami.'],
        ['Materi Press', 'Kirimkan draf artikel Anda. Jika belum ada, tim kami siap membantu koordinasi konten.'],
        ['Wawancara',    'Tim kami akan melakukan penggalian data (interview) untuk menyusun naskah yang kuat.'],
        ['Review Klien', 'Anda mendapatkan kesempatan meninjau draf artikel sebelum benar-benar dipublikasikan.'],
        ['Penerbitan',   'Artikel Anda tayang di jaringan media online nasional pilihan secara serentak.'],
        ['Monitoring',   'Laporan lengkap berupa tautan/link berita yang tayang akan dikirimkan langsung kepada Anda.'],
    ];

    $stepColors = [
        'bg-white',        // 1
        'bg-[#3D0066]',    // 2
        'bg-white',        // 3
        'bg-black',        // 4
        'bg-[#FFD200]',    // 5
        'bg-white',        // 6
        'bg-[#E61E50]',    // 7
        'bg-white',        // 8
        'bg-[#3D0066]',    // 9
        'bg-black',        // 10
    ];
    $stepTextColors = [
        'text-black', 'text-white', 'text-black', 'text-white', 'text-black',
        'text-black', 'text-white', 'text-black', 'text-white', 'text-white',
    ];

    $builtSteps = [];
    for ($i = 1; $i <= 10; $i++) {
        $builtSteps[] = [
            'no'    => str_pad($i, 2, '0', STR_PAD_LEFT),
            'title' => $sv("step_{$i}_title", $defaultSteps[$i-1][0]),
            'desc'  => $sv("step_{$i}_desc",  $defaultSteps[$i-1][1]),
            'bg'    => $stepColors[$i-1],
            'text'  => $stepTextColors[$i-1],
        ];
    }
@endphp

{{-- ── HERO SECTION ────────────────────────────────────────── --}}
<section class="bg-[#FFD200] border-b-8 border-black pt-32 pb-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div class="max-w-3xl">
            <div class="inline-block bg-[#3D0066] text-white font-black text-xs uppercase tracking-widest px-4 py-2 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] mb-6 transform -rotate-1">
                {{ $hv('badge_text', '✦ Panduan Pemesanan') }}
            </div>
            <h1 class="font-black text-6xl md:text-8xl leading-[0.9] uppercase text-[#3D0066] mb-8 tracking-tighter">
                {{ $hv('title', 'ALUR KERJA') }}
                <br><span class="bg-black text-[#FFD200] px-4 inline-block transform rotate-1">ORDER</span>
            </h1>
            <div class="border-l-4 border-black pl-4 py-2 mb-8">
                <p class="font-bold text-xl text-black italic leading-tight">
                    "{{ $hv('subtitle', 'Proses transparan, hasil maksimal untuk pesan Anda.') }}"
                </p>
            </div>
            <p class="font-bold text-lg text-black/80 max-w-xl leading-relaxed">
                {{ $hv('description', 'Kami memastikan setiap langkah pengerjaan Press Release dilakukan secara profesional agar pesan Anda sampai ke audiens yang tepat melalui media ternama.') }}
            </p>
        </div>

        <div class="relative flex justify-center items-center h-[450px]">
            <div class="absolute w-[380px] h-[380px] border-[6px] border-black rounded-[40px] -translate-x-4 -translate-y-4"></div>
            <div class="relative w-[350px] h-[350px] bg-[#E61E50] border-[6px] border-black rounded-full shadow-[15px_15px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center overflow-visible">
                @if($heroS && $heroS->get('image'))
                    <img src="{{ Storage::url($heroS->get('image')) }}"
                         alt="Cara Order"
                         class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
                @else
                    <img src="/images/order1.png" alt="Cara Order"
                         class="absolute w-[110%] max-w-none grayscale hover:grayscale-0 transition-all duration-500 z-10 transform -translate-y-4">
                @endif
                <div class="absolute -top-10 -right-5 bg-[#3D0066] text-white border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform rotate-12">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── 10 STEPS WORKFLOW ──────────────────────────────────── --}}
<section class="bg-white border-b-8 border-black py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <h2 class="font-black text-5xl md:text-7xl uppercase text-[#3D0066] italic tracking-tighter">
                10 Langkah <span class="bg-[#FFD200] text-black px-4 not-italic">Pemesanan</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($builtSteps as $step)
            <div class="border-4 border-black {{ $step['bg'] }} p-8 relative shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group hover:-translate-y-1 transition-all">
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 border-4 border-black flex items-center justify-center bg-white flex-shrink-0 transform -rotate-3">
                        <span class="font-black text-2xl text-black">{{ $step['no'] }}</span>
                    </div>
                    <div>
                        <h3 class="font-black text-2xl uppercase mb-3 leading-tight {{ $step['text'] }}">{{ $step['title'] }}</h3>
                        <p class="font-bold leading-relaxed {{ $step['text'] }} {{ $step['text'] === 'text-white' ? 'opacity-90' : 'text-black/70' }}">
                            {{ $step['desc'] }}
                        </p>
                    </div>
                    <div class="absolute top-4 right-4 opacity-10 group-hover:opacity-100 transition-opacity">
                        <svg class="w-6 h-6 {{ $step['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA ──────────────────────────────────────────────────── --}}
<section class="bg-[#3D0066] border-b-8 border-black py-32 text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="font-black text-5xl md:text-8xl uppercase text-white leading-[0.8] mb-12 tracking-tighter">
            {{ $cv('title', 'SIAP UNTUK') }}
            <br><span class="text-[#FFD200]">GO PUBLIC?</span>
        </h2>
        <a href="{{ $cv('cta_url', 'https://api.whatsapp.com/send?phone=6287786000919') }}"
           class="inline-block bg-[#E61E50] text-white font-black text-2xl uppercase tracking-tighter px-12 py-6 border-4 border-black shadow-[10px_10px_0px_0px_rgba(255,255,255,1)] hover:shadow-none hover:translate-x-2 hover:translate-y-2 transition-all">
            {{ $cv('cta_text', 'Order via WhatsApp →') }}
        </a>
    </div>
</section>

@endsection