{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — KontenDigital.id</title>

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { --ink:#0e0b14; --yellow:#f5c518; --purple:#2d1b4e; --punch:#e8402a; --cream:#f7f2e8; }

        body {
            background: var(--yellow);
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
        }

        .card {
            background: var(--cream);
            border: 4px solid var(--ink);
            box-shadow: 10px 10px 0 var(--ink);
        }

        .logo-box {
            background: var(--purple);
            border: 3px solid var(--ink);
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .field {
            width: 100%;
            border: 3px solid var(--ink);
            background: white;
            padding: 0.7rem 1rem;
            font-weight: 700;
            font-size: 0.95rem;
            outline: none;
        }

        .field:focus {
            box-shadow: 4px 4px 0 var(--purple);
        }

        .btn-primary {
            width: 100%;
            background: var(--purple);
            color: var(--yellow);
            font-family: 'Anton', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 0.08em;
            padding: 0.9rem;
            border: 3px solid var(--ink);
            box-shadow: 6px 6px 0 var(--ink);
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translate(4px,4px);
            box-shadow: 2px 2px 0 var(--ink);
        }

        label {
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
            display: block;
        }

        .error-msg {
            color: var(--punch);
            font-size: 0.8rem;
            font-weight: 700;
        }

        .link {
            color: var(--purple);
            font-weight: 700;
            text-decoration: underline;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6">

<div class="w-full max-w-md">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-8">
        <div class="logo-box">
            <span style="font-family:'Anton'; color:var(--yellow); font-size:1.4rem;">K</span>
        </div>
        <div>
            <p style="font-family:'Anton';">KONTENDIGITAL</p>
            <small>Growth Partner</small>
        </div>
    </a>

    <div class="card p-8">

        <h1 style="font-family:'Anton'; font-size:2rem; margin-bottom:1rem;">
            MASUK AKUN
        </h1>

        {{-- Status --}}
        @if(session('status'))
            <div style="margin-bottom:1rem; font-weight:700;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="field"
                       value="{{ old('email') }}" required>
                @error('email')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="field" required>
                @error('password')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="mb-4 flex justify-between items-center">
                <label style="text-transform:none;">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>

                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-primary">
                MASUK
            </button>
        </form>

        <p style="margin-top:1rem; text-align:center;">
            Belum punya akun?
            <a href="{{ route('register') }}" class="link">Daftar</a>
        </p>

    </div>

</div>

</body>
</html>