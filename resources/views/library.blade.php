<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('Logo.ico') }}?v={{ time() }}">
    <script src="{{ asset('js/library.js') }}"></script>
    <script src="{{ asset('js/cookies.js') }}"></script>
    <script src="{{ asset('js/gameslist.js') }}"></script>
    <script src="{{ asset('js/gamebrowser.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>

</head>

<body onload="addGames()">
    <header>
        <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
         <a href="{{ url('/account') }}"><button class="MyAccount-button">MyAccount</button></a>
    </header>

    <main>
        <section>    
        <div class="game-library">
            <center>
                <p><br><br></p>
                <h2 class="title-size">Browse the full library of GameVault and add games to MyCollection!</h2><br>
                <input id="search-bar" type="text" placeholder="Search any game in MyGameBrowser to add to MyCollection..">
            </center>

            <div class="grid-container" id="girdlibrary">
                
                <div class="featured-article gamepop" style="background-image: url('/imgs/coc.jpg')" onclick="openPopup('featured-popup')">
                    <button class="add-button" onclick="saveToMyCollection('Clash of Clans')"> Add to MyCollection </button>
                    <a href="{{ url('/library/clash-of-clans') }}">
                    <div class="overlay">
                        <h2>bla bla bla</h2>
                        <p>bla bla bla</p><br></a>
                    </div>
                    <div class="popup" id="featured-popup">
                        <img src="/imgs/coc.jpg">
                        <!-- The event.stopPropagation() is a prebuilt function that stops the parent's function from retriggering -->
                        <button type="button" onclick="event.stopPropagation(); closePopup('featured-popup')">X</button>
                        <div class="overlay">     
                            <h2>this is a popped-up version</h2>          
                        </div>
                    </div>
                </div>
<!--
                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p class ="game">Clash of Clans</p>
                    </div>
                </div>

                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p class ="game">Clash Royale</p>
                    </div>
                </div>

                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p class ="game">Silksong</p>
                    </div>
                </div>

                <div class="sub-article" style="background-image: url('/image/coc.jpg')">
                    <div class="overlay">
                        <p class ="game">Witcher</p>
                    </div>
                </div>
-->
            </div>
        <br><br><br><br><br><br><br>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>

</body>
</html>