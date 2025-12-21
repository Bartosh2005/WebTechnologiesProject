<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/awards.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>

<body>
    @include('layouts.header')

<main style="padding: 2rem; color: white;">

    <h1 style="text-align:center; margin-bottom:2rem;">
        My Game Awards
    </h1>
<div class="awards-grid">

@foreach($categories as $category)
    <section class="award-column">
      <div>
            <h2 style="color:#ff5555;">
                {{ $category->name }}
            </h2>
          </div>

            @if(empty($leaderboards[$category->id]) || $leaderboards[$category->id]->isEmpty())
                <p>No nominations yet.</p>
            @else
                <ol>
                    @foreach($leaderboards[$category->id] as $index => $game)
                        <li style="
                            margin: 0.5rem 0;
                            font-weight: {{ $index === 0 ? 'bold' : 'normal' }};
                            color: {{ $index === 0 ? '#ffd700' : '#eee' }};
                        ">
                          <div style="display:flex; justify-content:center;">
        {{ $game->title }} — {{ $game->votes }} votes
    </div>
<div style="display:flex; justify-content:center;">
    <img
        src="{{ $game->img }}"
        alt="{{ $game->title }}"
        style="
            margin-top: 0.5rem;
            width: 300px;
            max-width: 100%;
            border-radius: 10px;
            display: block;
        "
    >
</div>
                        </li>
                    @endforeach
                </ol>
            @endif
        </section>
    @endforeach
    </div>

</main>
    
          
    <footer>
      <p>&copy; 2025 Game Library</p>
    </footer>

  </body>
</html>