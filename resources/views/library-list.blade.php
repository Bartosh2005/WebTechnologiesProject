@if ($featuredgame)
<div class="featured-card-wrapper featured-article1" style="position: relative;">
    <a class="featured-article1 gamepop" href="{{ route('games.show', $featuredgame) }}">
        <div class="featured-article gamepop" style="background-image: url('{{ $featuredgame->img }}')">
            <div class="overlay">
                <h2>{{ $featuredgame->title }}</h2>

                @php
                    $text = $featuredgame->description;
                    $sentences = preg_split('/(?<=[.?!])\s+/', $text);
                    $limited = implode(' ', array_slice($sentences, 0, 3));
                @endphp

                <p>{{ $limited }}</p>
            </div>
        </div>
    </a>

    @auth
        @php
            $owned = auth()->user()->gameLibrary()
                ->where('games_library.id', $featuredgame->id)
                ->exists();
        @endphp

        <button 
            class="add-button {{ $owned ? 'remove-from-library-btn' : 'add-to-library-btn' }}" 
            data-game-id="{{ $featuredgame->id }}"
            style="position: absolute; top: 10px; right: 10px; z-index: 10;">
            {{ $owned ? 'Remove from MyCollection' : 'Add to MyCollection' }}
        </button>
    @endauth
</div>
@endif

@foreach ($games->skip(1) as $game)
<div class="sub-article-wrapper" style="position: relative;">
    <a href="{{ route('games.show', $game) }}">
        <div class="sub-article" style="background-image: url('{{ $game->img }}')">
            <div class="overlay">
                <p class="game">{{ $game->title }}</p>

                @php
                    $text = $game->description;
                    $sentences = preg_split('/(?<=[.?!])\s+/', $text);
                    $limited = implode(' ', array_slice($sentences, 0, 3));
                @endphp

                <p>{{ $limited }}</p>
            </div>
        </div>
    </a>

    @auth
        @php
            $owned = auth()->user()->gameLibrary()
                ->where('games_library.id', $game->id)
                ->exists();
        @endphp

        <button 
            class="add-button {{ $owned ? 'remove-from-library-btn' : 'add-to-library-btn' }}" 
            data-game-id="{{ $game->id }}">
            {{ $owned ? 'Remove from MyCollection' : 'Add to MyCollection' }}
        </button>
    @endauth
</div>
@endforeach
