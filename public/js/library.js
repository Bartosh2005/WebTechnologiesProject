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
        var addLabel = (window.__labels && window.__labels.add_to_collection) ? window.__labels.add_to_collection : 'Add to MyCollection';
        addButton = `<button class="add-button" onclick="saveToMyCollection('${item.title}')"> ${addLabel} </button>`;
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
        var addLabel = (window.__labels && window.__labels.add_to_collection) ? window.__labels.add_to_collection : 'Add to MyCollection';
        addButton = `<button class="add-button" onclick="saveToMyCollection('Clash of Clans')"> ${addLabel} </button>`;
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

function toggleMyCollection(title, btn) {
    // Decide action based on current button text
    const action = btn.textContent.includes('Add') ? 'add' : 'remove';

    fetch(`/api/mycollection/${action}`, {
        method: action === 'add' ? 'POST' : 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ title })
    })
    .then(res => res.json())
    .then(() => {
        // Update button text dynamically
        var addedLabel = (window.__labels && window.__labels.added) ? window.__labels.added : 'Added';
        var addLabel = (window.__labels && window.__labels.add_to_collection) ? window.__labels.add_to_collection : 'Add to MyCollection';
        btn.textContent = action === 'add' ? addedLabel : addLabel;
    })
    .catch(err => console.error(err));
}