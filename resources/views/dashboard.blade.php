{{-- resources/views/pricing.blade.php --}}
@extends('layouts.app')
@section('title', 'Paket Harga')

@section('content')
<section class="py-24 bg-white border-b-4 border-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-3">Investasi Terbaik untuk Brand Anda</p>
            <h1 class="font-black text-5xl md:text-7xl text-black leading-none mb-4"
                style="font-family:'Unbounded',sans-serif">
                Paket Harga
            </h1>
            <div class="divider-neo max-w-xs mx-auto mb-6"><span>✦</span></div>
            <p class="font-bold text-black/60 text-base max-w-xl mx-auto">
                Harga super terjangkau tanpa mengorbankan kualitas. Semua paket sudah termasuk garansi tayang dan laporan URL terbit.
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            @foreach($packages as $i => $pkg)
            <div class="reveal {{ $pkg['highlight']
                    ? 'bg-purple-950 border-4 border-black shadow-[8px_8px_0px_0px_#facc15] md:scale-105 md:z-10'
                    : 'card-retro bg-white' }} p-8 rounded-2xl"
                 style="animation-delay:{{ $i * 0.15 }}s">

                @if($pkg['badge'])
                <div class="flex justify-center mb-4">
                    <span class="stamp {{ $pkg['highlight'] ? 'text-yellow-400 border-yellow-400' : 'text-red-500 border-red-500' }}">
                        {{ $pkg['badge'] }}
                    </span>
                </div>
                @endif

                <p class="font-black text-xs tracking-widest uppercase mb-2
                          {{ $pkg['highlight'] ? 'text-yellow-400/60' : 'text-black/40' }}">
                    Paket
                </p>
                <h3 class="font-black text-4xl tracking-tight mb-4
                           {{ $pkg['highlight'] ? 'text-yellow-400' : 'text-black' }}"
                    style="font-family:'Unbounded',sans-serif">
                    {{ strtoupper($pkg['name']) }}
                </h3>

                <div class="divider-neo mb-6 {{ $pkg['highlight'] ? 'opacity-30' : 'opacity-20' }}">
                    <span>✦</span>
                </div>

                <div class="mb-6">
                    <span class="font-black text-4xl {{ $pkg['highlight'] ? 'text-white' : 'text-black' }}"
                          style="font-family:'Unbounded',sans-serif">
                        Rp {{ $pkg['price'] }}
                    </span>
                    <span class="font-bold text-sm ml-1 {{ $pkg['highlight'] ? 'text-white/50' : 'text-black/40' }}">
                        {{ $pkg['period'] }}
                    </span>
                </div>

                <ul class="space-y-3 mb-8">
                    @foreach($pkg['features'] as $feat)
                    <li class="flex items-start gap-2 font-bold text-sm
                               {{ $pkg['highlight'] ? 'text-white/80' : 'text-black/70' }}">
                        <span class="text-yellow-400 mt-0.5 shrink-0 font-black">✓</span>
                        {{ $feat }}
                    </li>
                    @endforeach
                </ul>

                <a href="https://wa.me/6281234567890?text=Halo, saya ingin pesan paket {{ $pkg['name'] }}"
                   class="{{ $pkg['highlight']
                       ? 'block w-full text-center bg-yellow-400 text-black font-black uppercase tracking-widest text-sm px-6 py-4 border-4 border-black shadow-neo-sm hover:translate-y-1 hover:shadow-none transition-all'
                       : 'btn-pop block w-full text-center py-4' }}">
                    {{ $pkg['cta'] }} →
                </a>
            </div>
            @endforeach
        </div>

        {{-- Custom Note --}}
        <div class="text-center mt-16 reveal">
            <div class="inline-block border-4 border-black bg-yellow-400 px-8 py-5 shadow-neo">
                <p class="font-bold text-black">
                    Butuh paket custom untuk volume besar?
                    <a href="https://wa.me/6281234567890"
                       class="font-black underline underline-offset-2 ml-1 hover:text-purple-950 transition-colors">
                        Hubungi kami →
                    </a>
                </p>
            </div>
        </div>

    </div>
</section>
@endsection