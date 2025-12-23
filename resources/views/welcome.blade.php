<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
    <style>
    /* Modal styles for language chooser */
    #language-modal { position:fixed; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.6); z-index:1000; }
    #language-modal .modal-box { background:#fff; padding:20px; border-radius:8px; max-width:420px; width:90%; text-align:center; }
    #language-modal .languages { display:flex; flex-wrap:wrap; gap:8px; justify-content:center; margin-top:12px; }
    #language-modal button.lang-btn { padding:8px 12px; border:1px solid #ccc; background:#f9f9f9; border-radius:4px; cursor:pointer; }
    #language-modal .close-btn { margin-top:14px; background:#eee; padding:6px 10px; border-radius:4px; }
    </style>
</head>
<body>
    @include('layouts.header')
    {{-- Language modal (appears first time only) --}}

    <div id="language-modal" aria-hidden="true" style="display:none" data-locales='@json(config("app.available_locales"))'>
        <div class="modal-box" role="dialog" aria-modal="true" aria-label="{{ __('Choose language') }}">
            <h3>{{ __('Choose your language') }}</h3>
            <p>{{ __('Select the language you want the page to be displayed in.') }}</p>
            <div class="languages">
                @foreach(config('app.available_locales') as $code => $name)
                    <button class="lang-btn" data-locale="{{ $code }}">{{ $name }}</button>
                @endforeach
            </div>
            <button class="close-btn" id="language-modal-skip">{{ __('Use English') }}</button>
        </div>
    </div>

    <script>
        // expose whether a locale cookie exists so JS can avoid showing modal unnecessarily
        window.__locale_cookie = document.cookie.split(';').some(c=>c.trim().startsWith('locale='));
        // current server-detected locale (from route or cookie)
        window.__current_locale = '{{ app()->getLocale() }}';
    </script>
    <script src="{{ asset('js/language-popup.js') }}"></script>

    <main>
        <section style="text-align: center; margin-top: 50px;">
            <h2>{{ __('Featured Games TODAY!') }}</h2>

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
                <center><h3>{{__('Greetings from the Developers')}}</h3></center>
                <p>
                    {{__('We are a small group of passionate game lovers and web develop students building GameVault to help players discover and collect their favorite titles. Our goal is to provide a clean, attractive library experience and bring game information directly to you.') }}<br>
                    <br>{{__('Visit MyGamebrowser to search through all of our available cross-platform games.')}}<br>
                    <br>{{__('Read through MyNewsletter to stay updated with the latest gaming news and starter stories to help you to get started!') }}<br>
                    <br>{{__('Organize your personal game collection with MyCollection and keep track of the games you own and love. Be sure to create an account first!') }}<br>
                </p>
            </div>
        </section>

    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>
