function saveToMyCollection(title) {
    let collectionCookieName = "MyCollection2_" + userId;
    addToCookieList(collectionCookieName, title);
    var cookie = getCookieList(collectionCookieName);
    console.log("Stored Cookies:" + cookie)
}

function addGame(item) {
    var collection = document.getElementById("girdlibrary");
    let safeId = "popup-" + item.title.replace(/\s+/g, '-');
    let addButton = '';
    if (typeof isAuthenticated !== 'undefined' && isAuthenticated) {
        addButton = `<button class="add-button" onclick="saveToMyCollection('${item.title}')"> Add to MyCollection </button>`;
    }
    collection.innerHTML += `
        <div class="sub-article" style="background-image: url('/imgs/${item.img}')" onclick="openPopup('${safeId}')">
        ${addButton}
            <div class="overlay">
                <p class ="game">${item.title}</p>
            </div>
        </div>
        <div class="popup" id="${safeId}">
            <img src="/imgs/${item.img}" alt="${item.title}">
            <button type="button" onclick="event.stopPropagation(); closePopup('${safeId}')">X</button>
            <div class="overlay">     
                <h2>${item.title}</h2>
                <p>${item.description}</p>         
            </div>
        </div>`;
}


function clearGames() {
    var collection = document.getElementById("girdlibrary");
    let addButton = '';
    if (typeof isAuthenticated !== 'undefined' && isAuthenticated) {
        addButton = `<button class="add-button" onclick="saveToMyCollection('Clash of Clans')"> Add to MyCollection </button>`;
    }
    collection.innerHTML = `
    <div class="featured-article" style="background-image: url('/imgs/coc.jpg')">
        ${addButton}
        <a href="/library/clash-of-clans">
        <div class="overlay">
            <h2>bla bla bla</h2>
            <p>bla bla bla</p><br></a>
        </div>
    </div>`;
}

function addGames(collection = gamesLibrary) {
    collection.forEach(addGame);
}

function openPopup(id) {
    var popup = document.getElementById(id);
    if (popup) {
        popup.classList.add("open-popup");
    }
}

function closePopup(id) {
    var popup = document.getElementById(id);
    if (popup) {
        popup.classList.remove("open-popup");
    }
}