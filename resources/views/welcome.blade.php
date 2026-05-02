{{-- resources/views/welcome.blade.php --}}
{{--
    Catatan: File ini adalah halaman default Laravel (route '/').
    Disarankan route '/' langsung diarahkan ke home.blade.php.
    Tapi kalau tetap mau pakai welcome.blade.php, ini versi neubrutalism-nya.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'KontenDigital.id') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700;900&family=Unbounded:wght@400;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-yellow-400 flex items-center justify-center px-4"
      style="background-image:radial-gradient(circle,#000 1px,transparent 1px);background-size:24px 24px;">

    <div class="text-center max-w-2xl">

        {{-- Logo --}}
        <div class="flex items-center justify-center gap-4 mb-12">
            <div class="w-16 h-16 bg-purple-950 border-4 border-black rounded-2xl
                        flex items-center justify-center shadow-neo">
                <span class="text-yellow-400 font-black text-2xl"
                      style="font-family:'Unbounded',sans-serif">K</span>
            </div>
            <div class="text-left">
                <p class="font-black text-2xl text-black leading-none uppercase"
                   style="font-family:'Unbounded',sans-serif">KontenDigital</p>
                <p class="text-xs font-bold text-red-600 uppercase tracking-widest">.id</p>
            </div>
        </div>

        {{-- Headline --}}
        <h1 class="font-black text-6xl md:text-8xl text-black leading-none mb-6"
            style="font-family:'Unbounded',sans-serif">
            GROW<br><span class="text-purple-950">YOUR<br>BRAND.</span>
        </h1>

        <p class="font-bold text-black/60 text-lg mb-10 max-w-md mx-auto">
            Partner kreatif untuk press release, SEO, digital ads, dan visual design yang berkesan.
        </p>

        <div class="flex items-center justify-center gap-4 flex-wrap">
            <a href="{{ route('home') }}" class="btn-pop text-base px-8 py-4">
                Masuk ke Website →
            </a>

            @if(Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}"
                   class="border-4 border-black bg-white text-black font-black uppercase
                          tracking-widest text-sm px-8 py-4 shadow-neo-sm
                          hover:bg-yellow-400 hover:translate-y-1 hover:shadow-none transition-all">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}"
                   class="border-4 border-black bg-white text-black font-black uppercase
                          tracking-widest text-sm px-8 py-4 shadow-neo-sm
                          hover:bg-yellow-400 hover:translate-y-1 hover:shadow-none transition-all">
                    Login
                </a>
                @if(Route::has('register'))
                <a href="{{ route('register') }}"
                   class="font-bold text-black/60 underline underline-offset-2
                          hover:text-black transition-colors text-sm">
                    Daftar
                </a>
                @endif
                @endauth
            @endif
        </div>

        <p class="mt-12 text-xs font-bold text-black/30 uppercase tracking-widest">
            Laravel v{{ app()->version() }} · PHP v{{ PHP_VERSION }}
        </p>
    </div>

</body>
</html>