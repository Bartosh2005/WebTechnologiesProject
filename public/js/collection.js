var games;


function addGame(item){
    var collection = document.getElementById("gamesCollection");
    collection.innerHTML+=`
        <div class="game">
            <img src="imgs/${item.img}" style="max-width:50%; float: left; border-radius:15px;"/>
            <div>
                <i class="fa-solid fa-trash" onclick="removeFromMyCollection('${item.title}')" style="color:red;float:right;"></i>
                <h3 style="float:rigth;">${item.title}</h3>
                <small style="vertical-align: text-top;">${item.company}</small>
                <p style="float:rigth;">${item.description}</p>
            </div>
        </div>`;
    console.log(`Added ${item.title}`);
}
function clearGames(){
    var collection = document.getElementById("gamesCollection");
    collection.innerHTML="";
}

function addGames(collection = games) {
    // var collection = document.getElementById("gamesCollection");
    collection.forEach(addGame);
}


function loadSavedGames(){
    var gamesTitlesSaved = getCookieList("MyCollection2");
    console.log(gamesTitlesSaved);
    games = gamesLibrary.filter(x => gamesTitlesSaved.includes(x.title));
    addGames();
}

function removeFromMyCollection(title){
    removeFromCookieList("MyCollection2", title);
    //TODO: make so that reload is unneccesary
    location.reload();
    
}