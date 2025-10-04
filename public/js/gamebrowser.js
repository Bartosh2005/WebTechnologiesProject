
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-bar');
    const grid = document.getElementById('girdlibrary');
    const featuredHTML = grid.querySelector('.featured-article')?.outerHTML || '';
    searchInput.addEventListener('input', function () {
        const query = searchInput.value.toLowerCase();
        if (query === '') {
            grid.innerHTML = featuredHTML;
            gamesLibrary.forEach(addGame);
        } else {
            grid.innerHTML = '';
            const filteredGames = gamesLibrary.filter(game => game.title.toLowerCase().includes(query));
            filteredGames.forEach(addGame);
        }
    });
});