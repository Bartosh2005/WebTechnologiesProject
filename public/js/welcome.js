//gallary js for welcome page
function getDateBasedSeed() {
    const today = new Date();
    return today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate();
}

function seededRandom(seed) {
    const x = Math.sin(seed++) * 10000;
    return x - Math.floor(x);
}

function getDailyFeaturedGames() {
    const seed = getDateBasedSeed();
    const gameIndices = new Set();
    let seedIncrement = 0;

    // Create a shuffled array of indices
    while (gameIndices.size < 4) {
        const randomIndex = Math.floor(seededRandom(seed + seedIncrement) * gamesLibrary.length);
        gameIndices.add(randomIndex);
        seedIncrement++;
    }

    return Array.from(gameIndices).map(index => gamesLibrary[index]);
}

function initializeFeaturedGames() {
    const galleryContainer = document.getElementById('games-gallery');
    const featuredGames = getDailyFeaturedGames();
    
    featuredGames.forEach(game => {
        const gameCard = document.createElement('div');
        gameCard.className = 'game-card';
        
        gameCard.innerHTML = `
            <img src="/imgs/${game.img}" alt="${game.title}" onerror="this.src='/image/Logo.png'">
            <div class="game-info">
                <h3 class="game-title">${game.title}</h3>
                <div class="game-genre">${game.genre}</div>
                <p class="game-description">${game.description}</p>
                <div class="game-company">${game.company} (${game.year})</div>
            </div>
        `;
        
        galleryContainer.appendChild(gameCard);
    });
}

class SlidingGallery {
    constructor() {
        this.slidingContainer = document.getElementById('sliding-gallery-container');
        this.currentIndex = 0;
        this.cards = {};
    }

    isGameVisible(title) {
        return Object.values(this.cards).some(card => {
            return card && card.querySelector('.sliding-game-title').textContent === title;
        });
    }

    getNextUniqueGameIndex(baseIndex) {
        let index = baseIndex;
        while (this.isGameVisible(gamesLibrary[index].title)) {
            index = (index + 1) % gamesLibrary.length;
        }
        return index;
    }

    getGameIndex(offset) {
        let index = (this.currentIndex + offset + gamesLibrary.length) % gamesLibrary.length;
        if (offset === 1) {
            index = this.getNextUniqueGameIndex(index);
        }
        return index;
    }

    createSlidingCard(game) {
        const card = document.createElement('div');
        card.className = 'sliding-game-card';
        card.innerHTML = `
            <img src="/imgs/${game.img}" alt="${game.title}" onerror="this.src='/image/Logo.png'">
            <div class="sliding-game-info">
                <h3 class="sliding-game-title">${game.title}</h3>
            </div>
        `;
        return card;
    }

    initializeGallery() {
        // first game (blurred)
        const previewGame = gamesLibrary[this.getGameIndex(1)];
        const previewCard = this.createSlidingCard(previewGame);
        this.slidingContainer.appendChild(previewCard);
        previewCard.classList.add('preview');

        // second game (main, focus)
        const activeGame = gamesLibrary[this.currentIndex];
        const activeCard = this.createSlidingCard(activeGame);
        this.slidingContainer.appendChild(activeCard);
        activeCard.classList.add('active');

        // third game (blurred)
        const exitGame = gamesLibrary[this.getGameIndex(-1)];
        const exitCard = this.createSlidingCard(exitGame);
        this.slidingContainer.appendChild(exitCard);
        exitCard.classList.add('exit');

        // Set up initial card references
        this.cards = {
            preview: previewCard,
            active: activeCard,
            exit: exitCard
        };
    }

    updateSlidingGallery() {
        // Remove vanishing card
        const vanishCard = this.slidingContainer.querySelector('.vanish');
        if (vanishCard) {
            vanishCard.remove();
        }

        // update all three of the existing games (gamecards)
        if (this.cards.exit) {
            this.cards.exit.classList.remove('exit');
            this.cards.exit.classList.add('vanish');
        }
        if (this.cards.active) {
            this.cards.active.classList.remove('active');
            this.cards.active.classList.add('exit');
        }
        if (this.cards.preview) {
            this.cards.preview.classList.remove('preview');
            this.cards.preview.classList.add('active');
        }

        // creating a new "first" gamecard
        const previewGame = gamesLibrary[this.getGameIndex(1)];
        const previewCard = this.createSlidingCard(previewGame);
        this.slidingContainer.appendChild(previewCard);
        
        // update cards
        this.cards = {
            preview: previewCard,
            active: this.cards.preview,
            exit: this.cards.active
        };

        // animation of preview
        setTimeout(() => {
            previewCard.classList.add('preview');
        }, 50);

        // update index
        this.currentIndex = this.getGameIndex(1);
    }

    start() {
        // Set a random starting game and initialise that gallery switch every 2.5s
        this.currentIndex = Math.floor(Math.random() * gamesLibrary.length);
        this.initializeGallery();
        setInterval(() => this.updateSlidingGallery(), 2500);
    }
}

// Initialize everything on welcome page when the Document Object Model(DOM) is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeFeaturedGames();
    
    const slidingGallery = new SlidingGallery();
    slidingGallery.start();
}); /*  that above waits for the "DOMContentLoaded" event, which fires when 
        the initial HTML document has been completely loaded and parsed. 
        This ensures that all HTML elements are available before the JavaScript tries to interact with them. */