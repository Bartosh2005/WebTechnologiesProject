<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>
<body>
    @include('layouts.header')

    <main>
        <section style="text-align: center; margin-top: 50px;">
            <h2>Featured Games TODAY!</h2>

            <div id="games-gallery" class="games-gallery">
                @if(isset($randomGames) && $randomGames->count())
                    @foreach($randomGames as $game)
                        <div class="game-card">
                            <img src="{{ $game->img }}" alt="{{ $game->title }}" loading="lazy">
                            <div class="game-info">
                                <h3 class="game-title">{{ $game->title }}</h3>
                                @php
                                    $text = $game->description ?? '';
                                    $sentences = preg_split('/(?<=[.?!])\s+/', $text);
                                    $limited = implode(' ', array_slice($sentences, 0, 2));
                                @endphp
                                <p class="game-description">{{ $limited }}</p>
                                @if(!empty($game->company))
                                    <p class="game-company">{{ $game->company }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No games available yet.</p>
                @endif
            </div>
        </section>

    </main>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>
