{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HNP Communications.id') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700;900&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Background: pola kotak-kotak retro kuning --}}
<body class="min-h-screen bg-yellow-400 antialiased flex items-center justify-center px-4"
      style="background-image: radial-gradient(circle, #000 1px, transparent 1px);
             background-size: 24px 24px;">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center justify-center gap-3 mb-8 group">
            <div class="w-12 h-12 bg-purple-950 border-4 border-black rounded-xl
                        flex items-center justify-center
                        group-hover:rotate-6 transition-transform shadow-neo-sm">
                <span class="text-yellow-400 font-black text-xl"
                      style="font-family:'Unbounded',sans-serif">H</span>
            </div>
            <div class="leading-none">
                <p class="font-black text-lg uppercase tracking-tight text-black"
                   style="font-family:'Unbounded',sans-serif">HNP Communications</p>
                <p class="text-[0.6rem] font-bold text-red-600 uppercase tracking-[0.15em]">
                    Your Strategic PR and Digital Partner
                </p>
            </div>
        </a>

        {{-- Card Auth --}}
        <div class="bg-white border-4 border-black rounded-2xl shadow-neo p-8">
            {{ $slot }}
        </div>

        {{-- Back to home --}}
        <p class="text-center mt-6 text-sm font-bold text-black/60">
            <a href="{{ route('home') }}"
               class="hover:text-black underline underline-offset-2 transition-colors">
                ← Kembali ke Beranda
            </a>
        </p>
    </div>

</body>
</html>