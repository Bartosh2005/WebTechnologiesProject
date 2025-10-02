<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/56dbcf3753.js" crossorigin="anonymous"></script>
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
<body>
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
        <div class="games">
            <div class="game">
                <img src="imgs/apex.jpg" style="max-width:50%; float: left; border-radius:15px;"/>
                <div>
                    <h3 style="float:rigth;">APEX Legends</h3>
                    <small style="vertical-align: text-top;">Electronics Arts</small>
                    <p style="float:rigth;">Apex is bla bla bla bla</p>
                </div>
            </div>
            <div class="game">
                <img src="imgs/fort.png" style="max-width:50%; float: left; border-radius:15px;"/>
                <div>
                    <h3 style="float:rigth;">Fortnite</h3>
                    <small style="vertical-align: text-top;">Epic games</small>
                    <p style="float:rigth;">Fortnite is the 3rd person shooter developed by Epic Games</p>
                </div>
            </div>
            <div class="game">
                <img src="imgs/csgo.jpg" style="max-width:50%; float: left; border-radius:15px;"/>
                <div>
                    <h3 style="float:rigth;">CS:GO 2</h3>
                    <small style="vertical-align: text-top;">Valve</small>
                    <p style="float:rigth;">CS:GO 2 is the first person shooter developed by Valve</p>
                </div>
            </div>
        </div>
    </main>


    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>