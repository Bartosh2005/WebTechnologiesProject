<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account - Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.header')
    <main>
        <div style="display: flex; justify-content: center; align-items: flex-start; min-height: 70vh;">
            <div class="account-card" style="background: #181818; border-radius: 22px; box-shadow: 0 4px 32px #000a; padding: 40px 54px; margin-top: 32px; min-width: 370px; max-width: 420px; text-align: center; color: #fff; border-top: 6px solid #c83f3f;">
                <img src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=c83f3f&color=fff&size=128' alt="Avatar" style="border-radius: 50%; margin-bottom: 18px; box-shadow: 0 2px 8px #c83f3f55; border: 3px solid #c83f3f;">
                <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 10px; color: #fff; text-shadow: 0 2px 8px #c83f3f55;">My Account</h2>
                <div class="account-info" style="text-align: left; margin: 0 auto 18px auto; max-width: 320px;">
                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Role:</strong> {{ auth()->user()->role ?? 'User' }}</p>
                    <p><strong>Registered:</strong> {{ auth()->user()->created_at ? auth()->user()->created_at->format('Y-m-d') : 'N/A' }}</p>
                </div>
                <button style="margin-top: 10px; background: #c83f3f; color: #fff; border: none; border-radius: 6px; padding: 10px 28px; font-size: 1rem; cursor: pointer; transition: background 0.2s; font-weight: 600;">Edit Account</button>
                <hr style="margin: 32px 0 18px 0; border: none; border-top: 2px solid #c83f3f;">
                <div class="user-stats" style="text-align: left; margin-bottom: 18px;">
                    <h3 style="color: #c83f3f; margin-bottom: 10px;">Your Stats</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.5em;">🎮</span>
                            <span>Games in collection: <strong>{{ auth()->user()->gameLibrary->count() }}</strong></span>
                        </li>
                    </ul>
                </div>
                <a href="{{ route('collection.index') }}" style="display: inline-block; margin-top: 8px; text-decoration: none;">
                    <button style="background: #c83f3f; color: #fff; border: none; border-radius: 6px; padding: 10px 28px; font-size: 1rem; cursor: pointer; transition: background 0.2s; font-weight: 600;">Go to My Collection</button>
                </a>
            </div>
        </div>
        <footer>
            <p>&copy; 2025 Game Library</p>
        </footer>
    </main>
</body>
</html>
