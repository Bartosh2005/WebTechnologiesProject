<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        var userId = {{ Auth::check() ? Auth::user()->id : 'null' }};
    </script>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
    <script src="{{ asset('js/collection.js') }}"></script>
    <script src="{{ asset('js/gameslist.js') }}"></script>
    <script src="{{ asset('js/cookies.js') }}"></script>
    <script src="https://kit.fontawesome.com/56dbcf3753.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
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
<body onload="loadSavedGames()">
    @include('layouts.header')

    <main>
        <div class="search" style="display:grid;grid-template-columns: 2% auto 2% 2%;padding:1%;">
            <div class="searchicon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <input id="search-bar" type="text" style="border-radius:1rem;margin:0.5rem;height:30px;font-size:2rem;" autocapitalize="sentences" autofocus/>
            <div class="searchicon"><i class="fa-solid fa-sort" style=""></i></div>
            <div class="searchicon"><i class="fa-solid fa-filter" style=""></i></div>
        </div>
        <div class="games" id="gamesCollection">
            @forelse($games as $game)
                <div class="game">
                    <div style="background-image: url('{{ $game->img }}'); height: 200px; background-size: cover; border-radius: 1.5rem;"></div>
                    <div class="game-text">
                        <h3>{{ $game->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($game->description, 100) }}</p>

                        {{-- Remove from collection form --}}
                        <form action="{{ route('collection.remove', ['gameLibrary' => $game->id]) }}" method="POST">
                            @csrf
                            <button type="submit">Remove from MyCollection</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>You have no games in your collection yet.</p>
            @endforelse

            {{-- Pagination --}}
            {{ $games->links() }}
        </div>
    </main>


    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>

<script>
	 

    $("#search-bar").keyup(function() {
        var val = $.trim(this.value);
        console.log(val);
        if (val == ""){
            clearGames();
            addGames();
        }else {
            clearGames();
            var gamessearched = games.filter(x => x.title.includes(val) || x.description.includes(val) || x.company.includes(val) || x.genre.includes(val) || x.tags.find(a =>a.includes(val)));
            addGames(gamessearched);
        }
    });

    $("#search-bar").keyup(function() {
        var myElement = document.getElementById("search-bar");
        var query = myElement.value;
        
        let arr = query.split(" ");

        for (let i = 0; i < arr.length; i++) {
            arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
        }
        query = arr.join(" ");
        
        myElement.value = query;

    });
</script>

</html>