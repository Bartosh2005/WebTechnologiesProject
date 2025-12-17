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
                
                <hr class="account-hr">
                <div class="user-stats">
                    <h3 class="user-stats-title">Two Factor Authentication</h3>
                </div>


                <!-- 
                @if (! session()->has('auth.password_confirmed_at'))
                <a href="{{ route('password.confirm', ['redirect' => url()->current()]) }}">
                    <button class="edit-account-btn" >
                        Confirm password to enable/disable 2FA
                    </button>
                </a>
                @else            

                @endif -->



                <form  method="POST" action="/user/two-factor-authentication">
                    @csrf

                    @if (optional(auth()->user())->two_factor_secret)
                        <h2>2FA enabled.</h2>

                        @method ('DELETE')

                        <div class='pb-5' style="background: #ffffff; display: inline-block; padding: 8px; border-radius: 4px;">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>

                        <button style="color: red;" class="btn btn-danger">Disable 2FA</button>
                    @else
                        <h2>2FA not enabled.</h2>

                        <button style="color: green;" class="btn btn-primary">Enable 2FA</button>
                    @endif

                    
                </form>

                @if(session('status') == 'two-factor-authentication-disabled')
                    <div style="color: yellow;">2FA has been successfully disabled.</div>
                @endif
                @if(session('status') == 'two-factor-authentication-enabled')
                    <div style="color: yellow;">2FA has been successfully enabled.</div>
                @endif




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
