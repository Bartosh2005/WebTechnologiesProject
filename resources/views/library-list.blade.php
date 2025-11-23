@if ($featuredgame)
    <div class="featured-article gamepop" style="background-image: url('{{ $featuredgame->img }}')">

        @auth
            @php
                $owned = auth()->user()->gameLibrary->pluck('id')->contains($featuredgame->id);
            @endphp

            <button 
                class="add-button {{ $owned ? 'remove-from-library-btn' : 'add-to-library-btn' }}" 
                data-game-id="{{ $featuredgame->id }}" 
                style="{{ $owned ? 'background-color: #515151; color: #fff;' : '' }}">
                {{ $owned ? 'Remove from MyCollection' : 'Add to MyCollection' }}
            </button>
        @endauth

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
@endif




@foreach ($games->skip(1) as $game)
    <div class="sub-article" style="background-image: url('{{ $game->img }}')">

        <div class="overlay">

            <p class="game">{{ $game->title }}</p>

            @php
                $text = $game->description;
                $sentences = preg_split('/(?<=[.?!])\s+/', $text);
                $limited = implode(' ', array_slice($sentences, 0, 3));
            @endphp

            <p>{{ $limited }}</p>

            
            @auth
                @php
                    $owned = auth()->user()->gameLibrary->pluck('id')->contains($game->id);
                @endphp

                <button 
                    class="add-button {{ $owned ? 'remove-from-library-btn' : 'add-to-library-btn' }}" 
                    data-game-id="{{ $game->id }}" 
                    style="{{ $owned ? 'background-color: #515151; color: #fff;' : '' }}">
                    {{ $owned ? 'Remove from MyCollection' : 'Add to MyCollection' }}
                </button>
            @endauth

        </div>

    </div>
@endforeach

</div>