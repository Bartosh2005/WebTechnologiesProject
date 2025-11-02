<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.header')

    <main>
    <section style="text-align: center; margin-top: 50px;">
        <h2>Featured Games TODAY!</h2>
        <div id="games-gallery" class="games-gallery">
        </div>
    </section>

    <section class="sliding-gallery">
        <h2>See what we can offer you!</h2>
        <div id="sliding-gallery-container" class="sliding-gallery-container">
        </div>
    </section>
    
    <script src="{{ asset('js/gameslist.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
    </main>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>
