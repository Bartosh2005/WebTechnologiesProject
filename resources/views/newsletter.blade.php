<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.header')

    @php
        $locale = app()->getLocale();
        $localePrefix = $locale ? '/'.$locale : '';
    @endphp

    @if (session('role') === 'admin')
      <div class="button-container">
        <a href="{{ url($localePrefix . '/add-article') }}"><button class="add-article">{{ __('Add a new captivating article') }}</button></a>
      </div>
    @endif
    
      
    <div class="grid-container">

      <a href="{{ url($localePrefix . '/articles/silksong') }}" class="featured-article" style="background-image: url('/images/silksong.jpg')">
        <div class="overlay">
          <h2>After 6 years - HollowKnight: SilkSong is finally here</h2>
          <p>It's been a long wait, but gamers are excited to finally play the PEAK release</p>
        </div>
      </a>

      <a href="{{ url($localePrefix . '/articles/doomTDA') }}" class="sub-article" style="background-image: url('/images/doomTDA.jpg')">
        <div class="overlay">
          <p>The gates of Hell open once more, this time on a medieval battlefield</p>
        </div>
      </a>

      <a href="{{ url($localePrefix . '/articles/hades2') }}" class="sub-article" style="background-image: url('/images/Hades2.jpg')">
        <div class="overlay">
          <p>Hades II - finally out of early access</p>
        </div>
      </a>

      <a href="{{ url($localePrefix . '/articles/terminus') }}" class="sub-article" style="background-image: url('/images/ReTerminus.png')">
        <div class="overlay">
          <p>MarTek, the famous game company is rumored to be working on a new game</p>
        </div>
      </a>

      <a href="{{ url($localePrefix . '/articles/bd4') }}" class="sub-article" style="background-image: url('/images/BorderLands2.png')">
        <div class="overlay">
          <p>BorderLands IV - Performance Issues, CEO says 'Get a better PC'</p>
        </div>
      </a>

      <a href="{{ url($localePrefix . '/articles/ananta') }}" class="sub-article" style="background-image: url('/images/Ananta.png')">
        <div class="overlay">
          <p>Ananta - the anime-styled GTA game just got a new trailer</p>
        </div>
      </a>

      <a href="{{ url($localePrefix . '/articles/goy') }}" class="sub-article" style="background-image: url('/images/GOY.jpg')">
        <div class="overlay">
          <p>Ghost of Yotei - Masterpiece or Reused Content?</p>
        </div>
      </a>

      <a href="{{ url($localePrefix . '/articles/ssg') }}" class="sub-article" style="background-image: url('/images/SSG.jpeg')">
        <div class="overlay">
          <p>SilkSong: learn how to 'GIT GUD' with this new guide</p>
        </div>
      </a>
    </div>

    <div class="grid-container">

      @foreach($articles as $article)
        <a href="{{ route('articles.show', ['locale' => $locale, 'slug' => $article->slug]) }}" class="sub-article" style="background-image: url('{{ asset('storage/' . $article->image) }}')">
          <div class="overlay">
            <p>{{ $article->short_description }}</p>
          </div>
        </a>
      @endforeach
    </div>
          
    <footer>
      <p>&copy; 2025 Game Library</p>
    </footer>

  </body>
</html>
