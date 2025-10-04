<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('Logo.ico') }}?v={{ time() }}">
</head>
<body>
    <header>
      <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
      <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
      <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
      <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
      <a href="{{ url('/account') }}"><button class="MyAccount-button">MyAccount</button></a>
    </header>

            
    <div class="grid-container">

      <a href="{{ url('/articles/silksong') }}" class="featured-article">
        <div class="overlay">
          <h2>After 6 years - HollowKnight: SilkSong is finally here</h2>
          <p>It's been a long wait, but gamers are excited to finally play the PEAK release</p>
        </div>
      </a>

      <a href="{{ url('/articles/doomTDA') }}" class="sub-article" style="background-image: url('/images/doomTDA.jpg')">
        <div class="overlay">
          <p>The gates of Hell open once more, this time on a medieval battlefield</p>
        </div>
      </a>

      <a href="{{ url('/articles/hades2') }}" class="sub-article" style="background-image: url('/images/Hades2.jpg')">
        <div class="overlay">
          <p>Hades II - finally out of early access</p>
        </div>
      </a>

      <a href="{{ url('/articles/terminus') }}" class="sub-article" style="background-image: url('/images/ReTerminus.png')">
        <div class="overlay">
          <p>MarTek, the famous game company is rumored to be working on a new game</p>
        </div>
      </a>

      <a href="{{ url('/articles/bd4') }}" class="sub-article" style="background-image: url('/images/BorderLands2.png')">
        <div class="overlay">
          <p>BorderLands IV - Performance Issues, CEO says 'Get a better PC'</p>
        </div>
      </a>

      <a href="{{ url('/articles/ananta') }}" class="sub-article" style="background-image: url('/images/Ananta.png')">
        <div class="overlay">
          <p>Ananta - the anime-styled GTA game just got a new trailer</p>
        </div>
      </a>

      <a href="{{ url('/articles/goy') }}" class="sub-article" style="background-image: url('/images/GOY.jpg')">
        <div class="overlay">
          <p>Ghost of Yotei - Masterpiece or Reused Content?</p>
        </div>
      </a>

      <a href="{{ url('/articles/ssg') }}" class="sub-article" style="background-image: url('/images/SSG.jpeg')">
        <div class="overlay">
          <p>SilkSong: learn how to 'GIT GUD' with this new guide</p>
        </div>
      </a>
    </div>
          
    <footer>
      <p>&copy; 2025 Game Library</p>
    </footer>

  </body>
</html>
