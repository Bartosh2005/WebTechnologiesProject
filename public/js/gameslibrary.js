const gamesNew = [
    {
        title: "The Witcher 3",
        genre: "RPG",
        year: 2015,
        company: "CD Projekt",
        description: "An open-world fantasy RPG about a monster hunter.",
        img:""
    },
    {
        title: "Hollow Knight",
        genre: "Metroidvania",
        year: 2017,
        company: "Team Cherry",
        description: "A 2D action-adventure set in a bug-infested kingdom.",
        img:""
    },
    {
        title: "Portal 2",
        genre: "Puzzle",
        year: 2011,
        company: "Valve",
        description: "A first-person puzzle game with portals and sarcasm.",
        img:""
    },
    {
        title: "Fortnite",
        genre: "Shooter",
        year: 0,
        company: "Epic Games",
        description: "Fortnite is the 3rd person shooter developed by Epic Games",
        img:"fort.png"
    },
    {
        title: "Apex Legends",
        genre: "Shooter",
        year: 0,
        company: "Electronics Arts",
        description: "Apex is bla bla bla bla",
        img:"apex.jpg"
    },
    {
        title: "Apex Favorites",
        genre: "Shooter",
        year: 0,
        company: "Electronics Arts",
        description: "Apex is bla bla bla bla",
        img:"apex.jpg"
    },
    {
        title: "CS:GO 2",
        genre: "Shooter",
        year: 0,
        company: "Valve",
        description: "CS:GO 2 is the first person shooter developed by Valve",
        img:"csgo.jpg"
    }
];
function addGame(item){
    var collection = document.getElementById("gamesCollection");
    collection.innerHTML+=`
        <div class="game">
            <img src="imgs/${item.img}" style="max-width:50%; float: left; border-radius:15px;"/>
            <div>
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

function addGames(collection = gamesNew) {
    // var collection = document.getElementById("gamesCollection");
    collection.forEach(addGame);
}

