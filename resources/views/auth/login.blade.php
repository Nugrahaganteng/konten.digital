{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin — KontenDigital.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400&family=Bebas+Neue&family=Special+Elite&family=Courier+Prime:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/css/retro.css'])
</head>
<body class="min-h-screen bg-ink flex items-center justify-center p-4 relative overflow-hidden">

    {{-- BG Grid Lines --}}
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        @for($i=0;$i<16;$i++)
        <div class="absolute border-t border-gold" style="top:{{$i*7}}%;width:100%;"></div>
        @endfor
        @for($i=0;$i<10;$i++)
        <div class="absolute border-l border-gold h-full" style="left:{{$i*12}}%;"></div>
        @endfor
    </div>

    {{-- Floating circles --}}
    <div class="absolute top-16 left-16 w-40 h-40 border border-gold/10 rounded-full animate-spin-slow pointer-events-none"></div>
    <div class="absolute bottom-20 right-16 w-56 h-56 border border-gold/10 rounded-full animate-spin-slow pointer-events-none" style="animation-direction:reverse;"></div>
    <div class="absolute top-1/2 left-6 w-20 h-20 border border-gold/15 rounded-full animate-float pointer-events-none"></div>

    {{-- Login Card --}}
    <div class="relative w-full max-w-md z-10">

        {{-- Top ornament --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent to-gold/60"></div>
            <span class="text-gold font-typewriter text-xs tracking-widest">✦ ADMIN PORTAL ✦</span>
            <div class="flex-1 h-px bg-gradient-to-l from-transparent to-gold/60"></div>
        </div>

        <div class="bg-paper border-2 border-gold shadow-[8px_8px_0_rgba(201,168,76,0.4)] relative p-8">
            {{-- Corner ornaments --}}
            <div class="corner-ornament tl"></div>
            <div class="corner-ornament tr"></div>
            <div class="corner-ornament bl"></div>
            <div class="corner-ornament br"></div>

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="w-16 h-16 border-2 border-gold mx-auto mb-4 flex items-center justify-center relative">
                    <span class="font-display text-gold text-2xl">KD</span>
                    <div class="absolute -top-1.5 -right-1.5 w-3 h-3 bg-gold"></div>
                </div>
                <h1 class="font-display text-ink text-3xl tracking-widest mb-1">ADMIN PANEL</h1>
                <p class="font-typewriter text-sepia text-xs tracking-widest">KONTENDIGITAL.ID — SISTEM MANAJEMEN</p>
                <div class="divider-retro mt-4 max-w-xs mx-auto"><span>✦</span></div>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
            <div class="border border-sage bg-sage/10 px-4 py-2 mb-6">
                <p class="font-mono text-sage text-sm">{{ session('status') }}</p>
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="label-retro" for="email">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="input-retro @error('email') border-rust @enderror"
                        placeholder="admin@kontendigital.id" required autofocus autocomplete="username">
                    @error('email')
                    <p class="font-mono text-rust text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="label-retro" for="password">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                            class="input-retro pr-10 @error('password') border-rust @enderror"
                            placeholder="••••••••" required autocomplete="current-password">
                        <button type="button" onclick="togglePwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-sepia hover:text-gold transition-colors">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="font-mono text-rust text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember & Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember" class="w-3.5 h-3.5 border border-gold accent-gold">
                        <span class="font-typewriter text-ink-light text-xs tracking-wide">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="font-typewriter text-sepia text-xs tracking-wide hover:text-gold border-b border-transparent hover:border-gold transition-all">
                        Lupa kata sandi?
                    </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-retro w-full text-center py-3 mt-2 text-sm">
                    Masuk ke Sistem →
                </button>
            </form>

            {{-- Footer --}}
            <p class="font-typewriter text-ink/30 text-xs text-center tracking-widest mt-8 border-t border-gold/20 pt-5">
                © {{ date('Y') }} KONTENDIGITAL.ID — RESTRICTED ACCESS
            </p>
        </div>

        {{-- Bottom ornament --}}
        <div class="flex items-center gap-3 mt-6">
            <div class="flex-1 h-px bg-gradient-to-r from-transparent to-gold/30"></div>
            <span class="text-gold/40 font-typewriter text-xs tracking-widest">AUTHORIZED PERSONNEL ONLY</span>
            <div class="flex-1 h-px bg-gradient-to-l from-transparent to-gold/30"></div>
        </div>
    </div>

    <script>
    function togglePwd() {
        const pwd = document.getElementById('password');
        pwd.type = pwd.type === 'password' ? 'text' : 'password';
    }
    </script>
</body>
</html>