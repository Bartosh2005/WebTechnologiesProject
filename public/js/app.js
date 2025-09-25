const games = [
    {
        title: "The Witcher 3",
        genre: "RPG",
        year: 2015,
        company: "CD Projekt",
        description: "An open-world fantasy RPG about a monster hunter."
    },
    {
        title: "Hollow Knight",
        genre: "Metroidvania",
        year: 2017,
        company: "Team Cherry",
        description: "A 2D action-adventure set in a bug-infested kingdom."
    },
    {
        title: "Portal 2",
        genre: "Puzzle",
        year: 2011,
        company: "Valve",
        description: "A first-person puzzle game with portals and sarcasm."
    }
];

// Step 2: Populate the dropdown
const select = document.getElementById('game-select');
games.forEach((game, index) => {
    const option = document.createElement('option');
    option.value = index;
    option.textContent = `${game.title} (${game.year})`;
    select.appendChild(option);
});

// Step 3: Handle selection
select.addEventListener('change', function () {
    const selectedGame = games[this.value];

    if (selectedGame) {
        document.querySelector('[name="title"]').value = selectedGame.title;
        document.querySelector('[name="genre"]').value = selectedGame.genre;
        document.querySelector('[name="year"]').value = selectedGame.year;
        document.querySelector('[name="company"]').value = selectedGame.company;
        document.querySelector('[name="description"]').value = selectedGame.description;
    } else {
        // Clear form if "select a game" is chosen
        document.getElementById('add-game-form').reset();
    }
});

// Optional: Handle form submission (e.g., log to console)
document.getElementById('add-game-form').addEventListener('submit', function (e) {
    e.preventDefault(); // prevent actual submission
    const formData = new FormData(this);
    const gameData = Object.fromEntries(formData.entries());
    console.log("Game added:", gameData);
    alert("Game added: " + JSON.stringify(gameData, null, 2));
});
