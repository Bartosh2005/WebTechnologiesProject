<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.header')
    <main>
    <center><div class="auth-form lessmargin">
        
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong style="color: red;">{{ $message }}</strong>
            </span><br>
        @enderror

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div style="color: white;">Please confirm password:</div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
            <button type="submit" class="btn btn-primary">Submit</button>

            <!--@if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            @endif-->
        </form>

    </div></center>
    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
    </main>
</body>
</html>
