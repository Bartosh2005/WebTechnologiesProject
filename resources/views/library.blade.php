<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
    <script src="{{ asset('js/library.js') }}"></script>
    <script src="{{ asset('js/cookies.js') }}"></script>
    <script src="{{ asset('js/gameslist.js') }}"></script>
    <script src="{{ asset('js/gamebrowser.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>

</head>

<body onload="addGames()">
    @include('layouts.header')

    <main>
        <section>    
        <div class="game-library">
            
                @if (session('role') === 'admin')
                    <center>
                        <button class="add-button-admin" >Add game to library</button>
                        <p><br><br></p>
                    </center>
                @endif
            

            <center>
                <p><br><br></p>
                <h2 class="title-size">Browse the full library of GameVault and add games to MyCollection!</h2><br>
                <input id="search-bar" type="text" placeholder="Search any game in MyGameBrowser to add to MyCollection.."><br>
            </center>

            <div class="grid-container" id="girdlibrary">
                
                <div class="featured-article gamepop" style="background-image: url('/imgs/clashroyale.jpg')" onclick="openPopup('featured-popup')">
                    <button class="add-button" onclick="saveToMyCollection('Clash Royale')"> Add to MyCollection </button>
                    <a href="{{ url('/library/clash-of-clans') }}">
                    <div class="overlay">
                        <h2>Clash Royale</h2>
                        <p>Spam emotes and places your troops exclusively in the center!</p><br></a>
                    </div>
                    <div class="popup" id="featured-popup">
                        <img src="/imgs/clashroyale.jpg">
                        <button type="button" onclick="event.stopPropagation(); closePopup('featured-popup')">X</button>
                        <div class="overlay">     
                            <h2>Download Clash Royale today!</h2>          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>

        <footer>
        <p>&copy; 2025 Game Library</p>
        </footer>
        
    </main>

    

</body>
</html>