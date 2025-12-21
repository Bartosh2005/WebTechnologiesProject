<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        var userId = {{ Auth::check() ? Auth::user()->id : 'null' }};
    </script>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/searchbar.js') }}"></script>
    <script src="{{ asset('js/removebutton.js') }}"></script>
    <!-- <script src="{{ asset('js/gameslist.js') }}"></script> -->
    <!-- <script src="{{ asset('js/cookies.js') }}"></script> -->
    <script src="https://kit.fontawesome.com/56dbcf3753.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script> -->
    <style>
        .games {
        display: grid;
        grid-template-columns: auto auto auto;
        padding: 1%;
        text-align: center;
        }
        .game{
            border: 2px solid #edeae9ff; 
            border-radius: 1.5rem;
            padding:2%;
            margin:2%;
            color: #ebe5e5ff;
            background: #181818;
        }
        .game-text {
            background: #222;
            color: #fff;
            padding: 1rem;
            border-radius: 0 0 1.5rem 1.5rem;
        }
        .searchicon{
            align-content: center;
            margin:0.5rem;
            color: #efe6e6ff;
        }
        .searchicon:hover{
            color:gray;
        }
    */</style>
    
</head>
<body>
    @include('layouts.header')

    <main>
        <h2 style="text-align:center; color:#c83f3f; font-size:2.2rem; margin-top: 24px; margin-bottom: 10px; letter-spacing: 1px;">
            {{ Auth::user()->name }}'s Collection
        </h2>
        <!--<div class="search" style="display:grid;grid-template-columns: 2% auto 2% 2%;padding:1%;">
            <div class="searchicon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <input class="search-bar" id="search-bar" type="text" style="border-radius:1rem;margin:0.5rem;height:30px;font-size:2rem;" autocapitalize="sentences" autofocus/>
            <div class="searchicon"><i class="fa-solid fa-sort" style=""></i></div>
            <div class="searchicon"><i class="fa-solid fa-filter" style=""></i></div>
        </div>-->
        {{--var_dump($exgames)--}}
        {{--var_dump($querylist)--}}
        <div class="games" id="gamesCollection">
            @include('collection-list', ['games' => $games, 'exgames' => $exgames])
        </div>
        <center><h3 style='color:white;'>Some of the games are provided via <a href="https://www.igdb.com/">IGDB</a>, a public game info library</h3></center>
        <center><div id="loaderhere"></div></center>
        </div>
    </main>


    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>

</html>