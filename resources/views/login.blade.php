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
    <header>
        <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
            @guest
                <a href="{{ route('register') }}"><button class="MyAccount-button">Register</button></a>
                <a href="{{ route('login') }}"><button class="MyAccount-button">Login</button></a>
            @else
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                     @csrf
                     <button type="submit" class="MyAccount-button">Logout</button>
                </form>
            @endguest
    </header>

   <main>
    <center><div class="login" class="login-container" class="lessmargin">
        <h2>Login to GameVault</h2>
        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div></center>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
    </main>
</body>
</html>