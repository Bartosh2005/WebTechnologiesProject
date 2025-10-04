var games;


function addGame(item) {
    var collection = document.getElementById("gamesCollection");
    collection.innerHTML += `
        <div class="game">
            <img src="imgs/${item.img}" style="max-width:50%; float: left; border-radius:15px; margin-right:1rem;"/>
            <div class="game-text" style="overflow:hidden;">
                <i class="fa-solid fa-trash" onclick="removeFromMyCollection('${item.title}')" style="color:red;float:right;"></i>
                <h3 style="margin-bottom:0.5rem;">${item.title}</h3>
                <p><strong>Genre:</strong> ${item.genre || "N/A"}</p>
                <p><strong>Release Year:</strong> ${item.year && item.year !== 0 ? item.year : "N/A"}</p>
                <p><strong>Company:</strong> ${item.company || "N/A"}</p>
                <p><strong>Description:</strong> ${item.description || "No description available."}</p>
            </div>
        </div>`;
    console.log(`Added ${item.title}`);
}
function clearGames() {
    var collection = document.getElementById("gamesCollection");
    collection.innerHTML = "";
}

function addGames(collection = games) {
    // var collection = document.getElementById("gamesCollection");
    collection.forEach(addGame);
}


function loadSavedGames() {
    var gamesTitlesSaved = getCookieList("MyCollection2");
    console.log(gamesTitlesSaved);
    games = gamesLibrary.filter(x => gamesTitlesSaved.includes(x.title));
    addGames();
}

function removeFromMyCollection(title) {
    removeFromCookieList("MyCollection2", title);
    //TODO: make so that reload is unneccesary
    location.reload();

}