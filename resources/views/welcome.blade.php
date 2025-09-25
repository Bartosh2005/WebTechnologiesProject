<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Game Library</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>🎮 Welcome to the Game Library</h1>
    </header>

    <main>
        <section style="text-align: center; margin-top: 50px;">
            <p>Explore classic and modern games, manage your collection, and more!</p>
            <a href="{{ url('/library') }}">
                <button class="primary-btn">Enter Game Library</button>
            </a>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>
