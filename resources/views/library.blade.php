<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/addbutton.js') }}"></script>
    <script src="{{ asset('js/library-search.js') }}"></script>
    <script src="{{ asset('js/animations.js') }}"></script>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>


<body>
    @include('layouts.header')

    <main>
        <section>    
            <div class="game-library">

                @if (session('role') === 'admin')
                    <center>
                        <a href="{{ url('/admin') }}"><button class="add-button-admin">Admin Panel</button></a>
                        <p><br><br></p>
                    </center>
                @endif

                <center>
                    <p><br><br></p>
                    <h2 class="title-size">Browse the full library of GameVault and add games to MyCollection!</h2><br>
                    <input id="search-bar-library" type="text" placeholder="Search any game in MyGameBrowser to add to MyCollection.."><br>
                </center>

                <div class="grid-container" id="girdlibrary">
                    @include('library-list', ['featuredgame' => $featuredgame, 'games' => $games])
                </div>
            </div>
        </section>

        <footer>
            <p>&copy; 2025 Game Library</p>
        </footer>
        
    </main>
</body>
</html>