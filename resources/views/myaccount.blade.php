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
        <div class="account-center">
            <div class="account-card">
                <img src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=c83f3f&color=fff&size=128' alt="Avatar" class="account-avatar">
                <h2 class="account-title">My Account</h2>
                <div class="account-info">
                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Role:</strong> {{ auth()->user()->role ?? 'User' }}</p>
                    <p><strong>Registered:</strong> {{ auth()->user()->created_at ? auth()->user()->created_at->format('Y-m-d') : 'N/A' }}</p>
                </div>
                <button class="edit-account-btn">Edit Account</button>
                <hr class="account-hr">
                <div class="user-stats">
                    <h3 class="user-stats-title">Your Stats</h3>
                    <ul class="user-stats-list">
                        <li class="user-stats-item">
                            <span style="font-size: 24px;">🎮</span>
                            <span>Games in collection: <strong>{{ auth()->user()->gameLibrary->count() }}</strong></span>
                        </li>
                    </ul>
                </div>
                <a href="{{ route('collection.index') }}" style="display: inline-block; margin-top: 8px; text-decoration: none;">
                    <button class="goto-collection-btn">Go to My Collection</button>
                </a>
            </div>
        </div>
        <footer>
            <p>&copy; 2025 Game Library</p>
        </footer>
    </main>
</body>
</html>
