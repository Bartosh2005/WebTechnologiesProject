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

    <center><div style="color: yellow;">
        @if(session('status') == 'two-factor-authentication-disabled')
            <br>
            2FA has been successfully disabled.
        @endif
        @if(session('status') == 'two-factor-authentication-enabled')
            <br>
            2FA has been successfully enabled.<br>
            Please scan the QR code below using your authenticator app.
        @endif
    </div></center>

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
                        @method ('DELETE')

                        <h2 style="color: green;">2FA enabled.</h2>

                        <div class='pb-5' style="background: #ffffff; display: inline-block; padding: 8px; border-radius: 4px;">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>

                        <div>
                            <h3>Recovery Codes:</h3>

                            <ul style="text-align:left;">
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                    <li>{{ $code }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <button style="color: black; background: #ffffff;" class="btn btn-danger"><strong>Disable 2FA</strong></button>
                    @else
                        <h2 style="color: red;">2FA not enabled.</h2>

                        <button style="color: black; background: #ffffff;" class="btn btn-primary"><strong>Enable 2FA</strong></button>
                    @endif

                    
                </form>




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
