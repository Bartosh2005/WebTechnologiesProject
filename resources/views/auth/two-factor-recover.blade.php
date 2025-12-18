<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Two-Factor Recovery - Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('layouts.header')
    <main>
    <center><div class="auth-form lessmargin">

        @error('recovery_code')
            <span class="invalid-feedback" role="alert">
                <strong style="color: red;">{{ $message }}</strong>
            </span><br>
        @enderror

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf
            <div style="color: white; margin-bottom: 12px;">Enter one of your recovery codes to sign in:</div>
            <input id="recovery_code" type="text" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" placeholder="Recovery code" required>
            <button type="submit" class="btn btn-primary" style="margin-top:8px;">Submit</button>
        </form>

    </div></center>
    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
    </main>
</body>
</html>
