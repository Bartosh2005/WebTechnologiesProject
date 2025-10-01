<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
</head>
<title>Image Grid</title>
  <style>
    .grid-container {
      display: grid;
      grid-template-columns: 1fr 2fr; /* image takes 1 part, text takes 2 */
      gap: 20px; /* spacing */
      max-width: 800px;
      margin: auto;
    }

    .grid-item {
      display: contents; /* lets children span the grid cells directly */
    }

    .grid-item img {
      width: 100%;
      border-radius: 8px;
    }

    .grid-item .text {
      display: flex;
      align-items: center; /* vertically center text */
      font-size: 1.2rem;
    }
  </style>
<body>
     <header>
        <a href="{{ url('/welcome') }}"><h1>LOGO</h1></a>
        <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
        <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
        <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
    </header>

        <div class="hero-image">
                <div class="hero-text">
                <h1>After 6 long years</h1>
                <p>Silksong is finally out</p>
            </div>
        </div>
        
        <div class="terminus-image">
                <div class="terminus-text">
                <h1>MarTak is rumored to be working on a new game</h1>
                <p>It'll be awesome</p>
            </div>
        </div>
        
    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>
