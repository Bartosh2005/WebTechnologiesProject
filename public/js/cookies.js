function addToCookieList(cookieName, value) {
  // Get current list from cookie, or empty array if none
  let list = Cookies.get(cookieName);
  list = list ? JSON.parse(list) : [];

  // Add only if not already in the list
  if (!list.includes(value)) {
    list.push(value);
    Cookies.set(cookieName, JSON.stringify(list), { expires: 7 }); 
    // expires: 7 means it lasts 7 days
  }
}

// Function to get the list
function getCookieList(cookieName) {
  let list = Cookies.get(cookieName);
  return list ? JSON.parse(list) : [];
}

// Function to remove a value
function removeFromCookieList(cookieName, value) {
  let list = Cookies.get(cookieName);
  list = list ? JSON.parse(list) : [];

  list = list.filter(item => item !== value);
  Cookies.set(cookieName, JSON.stringify(list), { expires: 7 });
}