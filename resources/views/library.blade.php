<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
    <script>
        var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        var userId = {{ Auth::check() ? Auth::user()->id : 'null' }};
    </script>
    <script src="{{ asset('js/library.js') }}"></script>
    <script src="{{ asset('js/cookies.js') }}"></script>
    <script src="{{ asset('js/gameslist.js') }}"></script>
    <script src="{{ asset('js/gamebrowser.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>

</head>

<body>
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
                
                <div class="featured-article gamepop" 
                    style="background-image: url('/imgs/{{ $featuredgame->img }}')" 
                    onclick="openPopup('popup-{{ $featuredgame->id }}')">

                    @auth
                    <button class="add-button" 
                            onclick="event.stopPropagation(); saveToMyCollection('{{ $featuredgame->title }}')">
                        Add to MyCollection
                    </button>
                    @endauth

                    <a href="{{ url('/library/' . Str::slug($featuredgame->title)) }}">
                        <div class="overlay">
                            <h2>{{ $featuredgame->title }}</h2>
                            <p>{{ $featuredgame->description }}</p>
                        </div>
                    </a>

                    <div class="popup" id="popup-{{ $featuredgame->id }}">
                        <img src="/imgs/{{ $featuredgame->img }}">
                        <button type="button" onclick="event.stopPropagation(); closePopup('popup-{{ $featuredgame->id }}')">X</button>
                        <div class="overlay">
                            <h2>Download {{ $featuredgame->title }} today!</h2>
                        </div>
                    </div>
                </div>
                
                @foreach ($games->skip(1) as $game)
                    @php
                        $safeId = 'popup-' . $game->id;
                    @endphp

                    <div class="sub-article"
                        style="background-image: url('{{ asset('imgs/' . $game->img) }}')"
                        onclick="openPopup('{{ $safeId }}')">

                        @auth
                            <button class="add-button"
                                    onclick="event.stopPropagation(); saveToMyCollection('{{ addslashes($game->title) }}')">
                                Add to MyCollection
                            </button>
                        @endauth

                        <div class="overlay">
                            <p class="game">{{ $game->title }}</p>
                        </div>
                    </div>

                    <div class="popup" id="{{ $safeId }}">
                        <img src="{{ asset('imgs/' . $game->img) }}" alt="{{ $game->title }}">
                        <button type="button" onclick="event.stopPropagation(); closePopup('{{ $safeId }}')">X</button>
                        <div class="overlay">
                            <h2>{{ $game->title }}</h2>
                            <p>{{ $game->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </section>

        <footer>
        <p>&copy; 2025 Game Library</p>
        </footer>
        
    </main>

    

</body>
</html>