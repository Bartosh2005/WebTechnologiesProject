<!DOCTYPE html>
<html lang="en">
<head>
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
     <header>
        <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
         <a href="{{ url('/account') }}"><button class="MyAccount-button">MyAccount</button></a>
    </header>

    <main>
        <div class="search" style="display:grid;grid-template-columns: 2% auto 2% 2%;padding:1%;">
            <div class="searchicon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <input id="search-bar" type="text" style="border-radius:1rem;margin:0.5rem;height:30px;font-size:2rem;" autocapitalize="sentences" autofocus/>
            <div class="searchicon"><i class="fa-solid fa-sort" style=""></i></div>
            <div class="searchicon"><i class="fa-solid fa-filter" style=""></i></div>
        </div>
        <div class="games" id="gamesCollection">
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