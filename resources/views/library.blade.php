<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('betterfavicon.ico') }}?v={{ time() }}">
</head>

<body>
    <header>
        <a href="{{ url('/welcome') }}"><h1>LOGO</h1></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
    </header>

    <main>
        <center>
        <h2>Browse the full library of GameVault and add games to MyCollection!</h2>
        <input id="search-bar" type="text" placeholder="Search..">
        </center>
        <section>
        
        <div class="game-library">

            <div class="valid-games">
                <div class="overlay">
                    <p>description</p>
                </div>
            </div>
            <h2>Game List</h2>
            <div class="game-list" id="game-list">
                <div id="game-card" class="game-card">
                    <h3>The Legend of Zelda</h3>
                    <p><strong>Genre:</strong> Action-adventure</p>
                    <p><strong>Release Year:</strong> 1986</p>
                    <p><strong>Company:</strong> Nintendo</p>
                    <p>An epic fantasy game featuring Link on a quest to rescue Princess Zelda and defeat Ganon.</p>
                    <button class="delete-btn">Remove</button>
            </div>

            <div id="game-card" class="game-card">
                    <h3>Super Mario Bros.</h3>
                    <p><strong>Genre:</strong> Platformer</p>
                    <p><strong>Release Year:</strong> 1985</p>
                    <p><strong>Company:</strong> Nintendo</p>
                    <p>Join Mario on his adventure to rescue Princess Peach from Bowser.</p>
                    <button class="delete-btn">Remove</button>
            </div>

                <article id="game-card" class="game-card">
                    <h3>Halo: Combat Evolved</h3>
                    <p><strong>Genre:</strong> First-person shooter</p>
                    <p><strong>Release Year:</strong> 2001</p>
                    <p><strong>Company:</strong> Bungie</p>
                    <p>Master Chief fights to save humanity against the Covenant in this sci-fi shooter.</p>
                    <button class="delete-btn">Remove</button>
                </article>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>