{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>

    {{-- Header --}}
    <div class="text-center mb-8">
        <h1 class="font-black text-2xl text-black uppercase tracking-tight mb-1"
            style="font-family:'Unbounded',sans-serif">Daftar</h1>
        <p class="font-bold text-black/50 text-xs uppercase tracking-widest">
            Buat akun baru
        </p>
        <div class="divider-neo mt-4 max-w-xs mx-auto opacity-30"><span>✦</span></div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <label class="label-neo" for="name">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   placeholder="Nama kamu"
                   required autofocus autocomplete="name"
                   class="input-neo @error('name') border-red-500 @enderror">
            @error('name')
            <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="label-neo" for="email">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   placeholder="email@domain.com"
                   required autocomplete="username"
                   class="input-neo @error('email') border-red-500 @enderror">
            @error('email')
            <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="label-neo" for="password">Kata Sandi</label>
            <input id="password" type="password" name="password"
                   placeholder="Min. 8 karakter"
                   required autocomplete="new-password"
                   class="input-neo @error('password') border-red-500 @enderror">
            @error('password')
            <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label class="label-neo" for="password_confirmation">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   placeholder="Ulangi kata sandi"
                   required autocomplete="new-password"
                   class="input-neo">
            @error('password_confirmation')
            <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit + Login link --}}
        <div class="flex items-center justify-between gap-4 pt-2">
            <a href="{{ route('login') }}"
               class="font-bold text-xs text-black/50 hover:text-black underline
                      underline-offset-2 transition-colors">
                Sudah punya akun?
            </a>
            <button type="submit" class="btn-pop px-8 py-3">
                Daftar →
            </button>
        </div>
    </form>

</x-guest-layout>