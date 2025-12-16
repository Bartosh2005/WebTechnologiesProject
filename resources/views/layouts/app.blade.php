<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Game Library</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <header>
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
        @if(auth()->check())
            <a href="{{ route('myaccount') }}"><button class="MyAccount-button">MyAccount</button></a>
        @endif
        @if(auth()->check() || session('role') === 'admin')
            @if(session('role') === 'admin')
                <span class="adminMessage">Logged in as Admin</span>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="MyAccount-button">Logout</button>
            </form>
        @else
            <a href="{{ route('register') }}"><button class="MyAccount-button">Register</button></a>
            <a href="{{ route('login', ['redirect' => url()->current()])}}"><button class="MyAccount-button">Login</button></a>
        @endif
    </header>



    <main>
        <div class="back-container">
            <button onclick="history.back()" class="back-button">← Back</button>
        </div>
        @yield('content')
    </main>


    <footer>
        <p>&copy; {{ date('Y') }} My Game Library</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/addbutton.js') }}"></script>
</body>
</html>
