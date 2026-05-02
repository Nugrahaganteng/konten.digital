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
        body { background: var(--yellow); min-height: 100vh; font-family: 'DM Sans', sans-serif; }
        .card {
            background: var(--cream);
            border: 4px solid var(--ink);
            box-shadow: 10px 10px 0 var(--ink);
            border-radius: 0;
        }
        .logo-box {
            background: var(--purple);
            border: 3px solid var(--ink);
            width: 52px; height: 52px;
            display: flex; align-items: center; justify-content: center;
        }
        .field {
            width: 100%;
            border: 3px solid var(--ink);
            background: white;
            padding: 0.7rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            outline: none;
            transition: box-shadow 0.15s;
        }
        .field:focus { box-shadow: 4px 4px 0 var(--purple); }
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
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-primary:hover { transform: translate(4px,4px); box-shadow: 2px 2px 0 var(--ink); }
        label { font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--ink); display: block; margin-bottom: 0.4rem; }
        .error-msg { color: var(--punch); font-size: 0.8rem; font-weight: 700; margin-top: 0.3rem; }
        .tag { background: var(--punch); color: white; font-family: 'Anton', sans-serif; font-size: 0.7rem; letter-spacing: 0.15em; padding: 0.3rem 0.75rem; }
        .divider { display: flex; align-items: center; gap: 1rem; margin: 1rem 0; }
        .divider-line { flex: 1; height: 2px; background: var(--ink); opacity: 0.15; }
        .link { color: var(--purple); font-weight: 700; text-decoration: underline; }
        .link:hover { color: var(--punch); }
        :root{--ink:#0e0b14;--yellow:#f5c518;--purple:#2d1b4e;--punch:#e8402a;--cream:#f7f2e8;}
        body{background:var(--yellow);min-height:100vh;font-family:'DM Sans',sans-serif;}
        .card{background:var(--cream);border:4px solid var(--ink);box-shadow:10px 10px 0 var(--ink);}
        .logo-box{background:var(--purple);border:3px solid var(--ink);width:52px;height:52px;display:flex;align-items:center;justify-content:center;}
        .field{width:100%;border:3px solid var(--ink);background:white;padding:0.7rem 1rem;font-family:'DM Sans',sans-serif;font-weight:700;font-size:0.95rem;outline:none;transition:box-shadow 0.15s;}
        .field:focus{box-shadow:4px 4px 0 var(--purple);}
        .btn-primary{width:100%;background:var(--purple);color:var(--yellow);font-family:'Anton',sans-serif;font-size:1.1rem;letter-spacing:0.08em;padding:0.9rem;border:3px solid var(--ink);box-shadow:6px 6px 0 var(--ink);cursor:pointer;transition:transform 0.15s,box-shadow 0.15s;}
        .btn-primary:hover{transform:translate(4px,4px);box-shadow:2px 2px 0 var(--ink);}
        label{font-weight:700;font-size:0.8rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink);display:block;margin-bottom:0.4rem;}
        .error-msg{color:var(--punch);font-size:0.8rem;font-weight:700;margin-top:0.3rem;}
        .tag{background:var(--punch);color:white;font-family:'Anton',sans-serif;font-size:0.7rem;letter-spacing:0.15em;padding:0.3rem 0.75rem;}
        .divider{display:flex;align-items:center;gap:1rem;margin:1rem 0;}
        .divider-line{flex:1;height:2px;background:var(--ink);opacity:0.15;}
        .link{color:var(--purple);font-weight:700;text-decoration:underline;}
        .link:hover{color:var(--punch);}
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    {{-- Background decoration --}}
    <div style="position:fixed;top:0;right:0;width:300px;height:300px;background:var(--purple);opacity:0.08;border-radius:0 0 0 100%;pointer-events:none;"></div>
    <div style="position:fixed;bottom:0;left:0;width:200px;height:200px;background:var(--punch);opacity:0.08;border-radius:0 100% 0 0;pointer-events:none;"></div>

    <div style="width:100%;max-width:440px;">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-8">
            <div class="logo-box">
                <span style="font-family:'Anton',sans-serif;font-size:1.4rem;color:var(--yellow);">K</span>
            </div>
            <div>
                <p style="font-family:'Anton',sans-serif;font-size:1.1rem;color:var(--ink);letter-spacing:0.02em;">KONTENDIGITAL</p>
                <p style="font-size:0.6rem;font-weight:700;color:var(--punch);text-transform:uppercase;letter-spacing:0.15em;">Growth Partner</p>
            </div>
        </a>

        <div class="card p-8">
            {{-- Header --}}
            <div class="mb-6">
                <span class="tag">✦ SELAMAT DATANG</span>
                <h1 style="font-family:'Anton',sans-serif;font-size:2.5rem;color:var(--purple);margin-top:0.75rem;line-height:0.95;">
                    MASUK<br>AKUN
                </h1>
            </div>

<<<<<<< HEAD
            {{-- Session Error --}}
            @if (session('status'))
=======
            @if(session('status'))
                <div style="background:rgba(0,168,150,0.12);border:2px solid #00a896;padding:0.75rem 1rem;margin-bottom:1rem;font-weight:700;font-size:0.85rem;color:#004d47;">
                    {{ session('status') }}
                </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

<<<<<<< HEAD
                {{-- Email --}}
=======
>>>>>>> f331462 (pembuatan admin form dll)
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="field"
                           value="{{ old('email') }}" required autofocus
                           placeholder="nama@email.com">
<<<<<<< HEAD
                    @error('email')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
=======
                    @error('email') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

>>>>>>> f331462 (pembuatan admin form dll)
                <div class="mb-4">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="field"
                           required placeholder="••••••••">
<<<<<<< HEAD
                    @error('password')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember --}}
=======
                    @error('password') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

>>>>>>> f331462 (pembuatan admin form dll)
                <div class="flex items-center justify-between mb-6">
                    <label style="flex-direction:row;align-items:center;gap:0.5rem;display:flex;text-transform:none;letter-spacing:0;" class="cursor-pointer">
                        <input type="checkbox" name="remember" style="width:16px;height:16px;accent-color:var(--purple);">
                        <span style="font-size:0.85rem;font-weight:600;">Ingat saya</span>
                    </label>
<<<<<<< HEAD
                    @if (Route::has('password.request'))
=======
                    @if(Route::has('password.request'))
>>>>>>> f331462 (pembuatan admin form dll)
                        <a href="{{ route('password.request') }}" class="link" style="font-size:0.8rem;">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-primary">MASUK →</button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span style="font-size:0.75rem;font-weight:700;opacity:0.4;text-transform:uppercase;">atau</span>
                <div class="divider-line"></div>
            </div>

            <p style="text-align:center;font-size:0.9rem;font-weight:600;">
                Belum punya akun?
                <a href="{{ route('register') }}" class="link">Daftar sekarang</a>
            </p>
        </div>

        <p style="text-align:center;margin-top:1.5rem;font-size:0.75rem;font-weight:700;opacity:0.5;text-transform:uppercase;letter-spacing:0.1em;">
            © {{ date('Y') }} KontenDigital.id
        </p>
    </div>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> f331462 (pembuatan admin form dll)
