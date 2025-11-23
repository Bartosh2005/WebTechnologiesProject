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

        <section style="display:flex;justify-content:center;margin:40px 0;">
            <div class="about-dev">
                <h3>Greetings from the Developers</h3>
                <p>
                    We are a small group of passionate game lovers and web develop students building GameVault to help players discover and collect their favorite titles. Our goal is to provide a clean, attractive library experience and bring game information directly to you.<br>
                    <br>Visit <strong>MyGamebrowser</strong> to search through all of our available cross-platform games.<br>
                    <br>Read through <strong>MyNewsletter</strong> to stay updated with the latest gaming news and starter stories to help you to get started!<br>
                    <br>Organize your personal game collection with <strong>MyCollection</strong> and keep track of the games you own and love. Be sure to create an account first!<br>
                </p>
            </div>
        </section>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>
