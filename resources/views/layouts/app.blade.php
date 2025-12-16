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

    <!-- Header -->
    <header>
        <h1>My Game Library</h1>
    </header>

    <!-- Main content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} My Game Library</p>
    </footer>

    <!-- jQuery (required for addbutton.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- App JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Add/Remove Game Button JS -->
    <script src="{{ asset('js/addbutton.js') }}"></script>
</body>
</html>
