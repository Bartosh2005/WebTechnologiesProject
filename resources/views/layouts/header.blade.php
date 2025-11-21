<header>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
    <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
    <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
    <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
    <a href="{{ route('myaccount') }}"><button class="MyAccount-button">MyAccount</button></a>
    @if(auth()->check() || session('role') === 'admin')
        @if(session('role') === 'admin')
            <span class="adminMessage">
                Logged in as Admin
            </span>
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