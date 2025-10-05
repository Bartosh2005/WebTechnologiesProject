function addToCookieList(cookieName, value) {
  let list = Cookies.get(cookieName);
  list = list ? JSON.parse(list) : [];

  if (!list.includes(value)) {
    list.push(value);
    Cookies.set(cookieName, JSON.stringify(list), { expires: 7 }); 
  }
}

function getCookieList(cookieName) {
  let list = Cookies.get(cookieName);
  return list ? JSON.parse(list) : [];
}


function removeFromCookieList(cookieName, value) {
  let list = Cookies.get(cookieName);
  list = list ? JSON.parse(list) : [];

  list = list.filter(item => item !== value);
  Cookies.set(cookieName, JSON.stringify(list), { expires: 7 });
}