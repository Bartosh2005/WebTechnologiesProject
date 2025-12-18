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

        <h2>Confirm Identity</h2>

        @error('code')
            <span class="invalid-feedback" role="alert">
                <strong style="color: red;">{{ $message }}</strong>
            </span><br>
        @enderror

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf
            <strong style="color: white;">You have enabled Two Factor Authentication for your account.</strong>
            <div style="color: white;">Open your Authenticator app and enter your 6-digit one time code:</div>
            <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="6-digit code" required autocomplete="current-code">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-link" style="color: cyan;" href="{{ route('two-factor.recover') }}">Use Recovery Code</a>
        </form>
                
    </div></center>
    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
    </main>
</body>
</html>