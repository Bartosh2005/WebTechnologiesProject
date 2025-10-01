<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
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

            
            <h2>Game List</h2>

            <div class="grid-container">
                <a href="{{ url('/library/clash-of-clans') }}">
                <div class="featured-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <h2>bla bla bla</h2>
                        <p>bla bla bla</p>
                </a>
                    </div>
                </div>

  
                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p>bla bla bla</p>
                    </div>
                </div>

                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p>bla bla bla</p>
                    </div>
                </div>

                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p>bla bla bla</p>
                    </div>
                </div>

                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p>bla bla bla</p>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>