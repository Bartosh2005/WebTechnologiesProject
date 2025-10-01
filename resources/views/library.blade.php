<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Library</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <a href="{{ url('library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('collection') }}"><h1>MyCollection</h1></a>
    </header>

    <main>
        <section>
            <h2>Add a Game</h2>
            <form id="add-game-form">
                <input type="text" name="title" placeholder="Game Title" required>
                <input type="text" name="genre" placeholder="Genre" required>
                <input type="number" name="year" placeholder="Release Year" required>
                <input type="text" name="company" placeholder="Company" required>
                <textarea name="description" placeholder="Description" required></textarea>
                <button type="submit">Add Game</button>
            </form>
        </section>

        <section>
            <h2>Game List</h2>
            <div class="game-list" id="game-list">
                <article class="game-card">
                    <h3>The Legend of Zelda</h3>
                    <p><strong>Genre:</strong> Action-adventure</p>
                    <p><strong>Release Year:</strong> 1986</p>
                    <p><strong>Company:</strong> Nintendo</p>
                    <p>An epic fantasy game featuring Link on a quest to rescue Princess Zelda and defeat Ganon.</p>
                    <button class="delete-btn">Remove</button>
                </article>

                <article class="game-card">
                    <h3>Super Mario Bros.</h3>
                    <p><strong>Genre:</strong> Platformer</p>
                    <p><strong>Release Year:</strong> 1985</p>
                    <p><strong>Company:</strong> Nintendo</p>
                    <p>Join Mario on his adventure to rescue Princess Peach from Bowser.</p>
                    <button class="delete-btn">Remove</button>
                </article>

                <article class="game-card">
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