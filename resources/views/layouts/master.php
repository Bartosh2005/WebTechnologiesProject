<!-- Stored in resources/views/layouts/master.blade.php -->
 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Game Vault - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <header>
            <a href="{{ url('/welcome') }}"><h1>LOGO</h1></a>
            <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
            <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
            <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
        </header>

        @section('content')
            <p>Main content here</p>
        @endsection

        @yield('content2')

        <footer>
            <p>&copy; 2025 Game Library</p>
        </footer>
    </body>
</html>