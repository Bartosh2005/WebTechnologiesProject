<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
</head>
<title>Image Grid</title>

<body>
     <header>
        <a href="{{ url('/welcome') }}"><h1>LOGO</h1></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
    </header>

        

<div class="grid-container">
  <div class="featured-article">
    <div class="overlay">
      <h2>After 6 years - HollowKnight:SilkSong is finally here</h2>
      <p>It's been a long wait, but gamers are excited to finally play the PEAK release</p>
    </div>
  </div>

  
  <div class="sub-article" style="background-image: url('/images/Hades2.jpg')">
    <div class="overlay">
      <p>Hades II - finally out of early access</p>
    </div>
  </div>

  <div class="sub-article" style="background-image: url('/images/ReTerminus.png')">
    <div class="overlay">
      <p>MarTek, the famous game company is rumored to be working on a new game</p>
    </div>
  </div>

  <div class="sub-article" style="background-image: url('/images/BorderLands2.png')">
    <div class="overlay">
      <p>BorderLands IV - Performance Issues, CEO says 'Get a better PC'</p>
    </div>
  </div>

  <div class="sub-article" style="background-image: url('/images/Ananta.png')">
    <div class="overlay">
      <p>Ananta - the anime-styled GTA game just got a new trailer</p>
    </div>
  </div>

  <div class="sub-article" style="background-image: url('/images/GOY.jpg')">
    <div class="overlay">
      <p>Ghost of Yotei - Masterpiece or Reused Content?</p>
    </div>
  </div>

  <div class="sub-article" style="background-image: url('/images/SSG.jpeg')">
    <div class="overlay">
      <p>SilkSong: learn how to 'GIT GUD' with this new guide</p>
    </div>
  </div>
</div>
        
    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>
