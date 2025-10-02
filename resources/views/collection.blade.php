<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/gameslibrary.js') }}"></script>
    <script src="https://kit.fontawesome.com/56dbcf3753.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .games {
        display: grid;
        grid-template-columns: auto auto auto;
        /* background-color: dodgerblue; */
        padding: 1%;
        text-align: center;
        }
        .game{
            border: 1px solid black;
            border-radius: 1.5rem;
            padding:2%;
            margin:2%;
        }
        .searchicon{
            align-content: center;
            margin:0.5rem;
        }
        .searchicon:hover{
            color:gray;
        }
    */</style>
</head>
<body onload="addGames()">
     <header>
        <a href="{{ url('/welcome') }}"><h1>LOGO</h1></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
    </header>

    <main>
        <div class="search" style="display:grid;grid-template-columns: 2% auto 2% 2%;padding:1%;">
            <div class="searchicon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <input id="searchbar" type="text" style="border-radius:1rem;margin:0.5rem;height:30px;font-size:2rem;" autocapitalize="words" autofocus/>
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
	 

    $("#searchbar").keyup(function() {
        var val = $.trim(this.value);
        console.log(val);
        if (val == ""){
            clearGames();
            addGames();
        }else {
            clearGames();
            var games = gamesNew.filter(x => x.title.includes(val) || x.description.includes(val) || x.company.includes(val) || x.genre.includes(val));// ||  x.description === val);
            addGames(games);
            //console.log(games);
        }
    });

    $("#searchbar").keyup(function() {//change first letter to uppercase
        var myElement = document.getElementById("searchbar");
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