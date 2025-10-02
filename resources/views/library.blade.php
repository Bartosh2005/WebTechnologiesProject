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
        <section>    
        <div class="game-library">
            <center>
                <p><br><br></p>
                <h2 class="title-size">Browse the full library of GameVault and add games to MyCollection!</h2><br>
                <input id="search-bar" type="text" placeholder="Search any game in MyGameBrowser to add to MyCollection..">
            </center>

            <div class="grid-container" class="hover">
                <a href="{{ url('/library/clash-of-clans') }}">
                <div class="featured-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <h2>bla bla bla</h2>
                        <p>bla bla bla</p></a><br>
                            <a>
                                <button class="add-button">Add to MyCollection</button>
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
        <br><br>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>