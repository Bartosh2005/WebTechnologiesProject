<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ghost of Yotei - Game Vault</title>
  <link rel="stylesheet" href="{{ asset('css/article.css') }}">
</head>
<body>
  <header>
    <a href="{{ url('/welcome') }}"><img src="{{ asset('image/Logo.png') }}" alt="Logo" style="width: 150px;"></a>
    <a href="{{ url('/library') }}"><h1>MyGamebrowser</h1></a>
    <a href="{{ url('/newsletter') }}"><h1>MyNewsletter</h1></a>
    <a href="{{ url('/collection') }}"><h1>MyCollection</h1></a>
    <a href="{{ url('/account') }}"><button class="MyAccount-button">MyAccount</button></a>
  </header>

  <main class="article-container">
    <div class="article-hero" style="background-image: url('/images/GOY.jpg')">
      <div class="article-overlay">
        <h1>Ghost of Yotei</h1>
        <p>Masterpiece or Reused Content?</p>
      </div>
    </div>

    <article class="article-content">
      <section>
        <h2>Overview</h2>
        <p>
          <em>Ghost of Yōtei</em> is a 2025 action-adventure game developed by Sucker Punch and published by Sony. 
          Set in the frigid Ezo region of 1603 Japan (modern-day Hokkaidō), it follows <strong>Atsu</strong>, a ronin 
          seeking vengeance against the infamous <strong>Yōtei Six</strong>, who slaughtered her family sixteen years earlier.
        </p>
      </section>

      <section>
        <h2>Strengths & Praise</h2>
        <ul>
          <li><strong>Visuals & World Design:</strong> Stunning snow-covered vistas, dynamic weather, and deep environmental detail powered by PS5 hardware.</li>
          <li><strong>Cinematic Modes:</strong> New visual filters like “Miike Mode” and “Watanabe Mode” accompany the return of Kurosawa Mode, giving players stylized cinematic experiences.</li>
          <li><strong>Combat & Narrative:</strong> Tightly balanced gameplay blending stealth, swordplay, and exploration, with a somber story that echoes themes of loss and redemption.</li>
        </ul>
      </section>

      <section>
        <h2>Critiques & Concerns</h2>
        <ul>
          <li><strong>Too Familiar?</strong> While highly polished, the core gameplay borrows heavily from <em>Ghost of Tsushima</em> with few major mechanical innovations.</li>
          <li><strong>Visual Trade-offs:</strong> Kurosawa Mode, while gorgeous, can hinder visibility during stealth sequences or low-light areas.</li>
          <li><strong>Historical Accuracy:</strong> The name “Yōtei” is anachronistic, sparking debate among scholars about intentional symbolism vs oversight.</li>
        </ul>
      </section>

      <section>
        <h2>Final Verdict</h2>
        <p>
          While it may not reinvent the genre, <em>Ghost of Yōtei</em> elevates it. It offers a haunting, meditative 
          experience built on the shoulders of a modern classic. Whether that qualifies it as a masterpiece or a polished remix
          is up to the player — but few will walk away unimpressed.
        </p>
        <p>
          <strong>Rating:</strong> 8.8/10 – <em>Stylish, intense, and emotionally grounded.</em>
        </p>
      </section>
    </article>
  </main>

  <footer>
    <p>&copy; 2025 Game Vault</p>
  </footer>
</body>
</html>