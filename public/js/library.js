function saveToMyCollection(title) {
    addToCookieList("MyCollection2", title);
    var cookie = getCookieList("MyCollection2");
    console.log("Stored Cookies:" + cookie)
}

function addGame(item) {
    var collection = document.getElementById("girdlibrary");
    // create the IDs for the popup before 
    let safeId = "popup-" + item.title.replace(/\s+/g, '-');
    collection.innerHTML += `
        <div class="sub-article" style="background-image: url('/imgs/${item.img}')" onclick="openPopup('${safeId}')">
            <button class="add-button" onclick="saveToMyCollection('${item.title}')"> Add to MyCollection </button>
            <div class="overlay">
                <p class ="game">${item.title}</p>
            </div>
        </div>
        <div class="popup" id="${safeId}">
            <img src="/imgs/${item.img}" alt="${item.title}">
            <button type="button" onclick="event.stopPropagation(); closePopup('${safeId}')">X</button>
            <div class="overlay">     
                <h2>this is a popped-up version</h2>          
            </div>
        </div>`;
    // console.log(`Added ${item.title}`);
}


function clearGames() {
    var collection = document.getElementById("girdlibrary");
    collection.innerHTML = `
    <div class="featured-article" style="background-image: url('/imgs/coc.jpg')">
        <button class="add-button" onclick="saveToMyCollection("Clash of Clans")"> Add to MyCollection </button>
        <a href="{{ url('/library/clash-of-clans') }}">
        <div class="overlay">
            <h2>bla bla bla</h2>
            <p>bla bla bla</p><br></a>
        </div>
    </div>`;
}

function addGames(collection = gamesLibrary) {
    // var collection = document.getElementById("gamesCollection");
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