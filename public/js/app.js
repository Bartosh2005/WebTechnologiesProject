
const searchInput = document.getElementById("search-bar"); 
const games = document.querySelectorAll(".grid-container > *"); 

searchInput.addEventListener("input", () => {
    const query = searchInput.value.toLowerCase();
    games.forEach(game => {
        const nameElement = game.querySelector("p");
        if (!nameElement) return; 
        const name = nameElement.textContent.toLowerCase();
        game.style.display = name.includes(query) ? "" : "none";
    });
});
