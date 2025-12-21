<link rel="stylesheet" href="{{ asset('css/library.css') }}">

@forelse($games as $game)
    <div class="game">
        <div style="background-image: url('{{ $game->img }}'); height: 200px; background-size: cover; border-radius: 1.5rem;"></div>
        <div class="game-text">
            <h3>{{ $game->title }}</h3>
            <p>{{ \Illuminate\Support\Str::limit($game->description, 100) }}</p>
            <button class="remove-from-library-btn" data-game-id="{{ $game->id }}">
                Remove from MyCollection
            </button>
            <div class="nomination-area">
                <select class="nomination-category" data-game-id="{{ $game->id }}">
                    <option value="">Nominate for...</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <button class="nominate-btn" data-game-id="{{ $game->id }}">
                Nominate
                </button>
            </div>
        </div>
        
    </div>
   
@empty
    <p>No games match your search.</p>
@endforelse
