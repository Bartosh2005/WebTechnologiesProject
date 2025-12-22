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
        </div>
    </div>
@empty
    <p>No games match your search.</p>
@endforelse

<div class="pagination-controls">
    @php
        $q = request('q');
        $qs = $q ? '&q='.urlencode($q) : '';
        $current = $games->currentPage();
        $last = $games->lastPage();
        $pages = collect([$current - 1, $current, $current + 1])
            ->filter(fn($p) => $p >= 1 && $p <= $last)
            ->unique()
            ->values();
    @endphp

    <a
        class="page-btn {{ $games->onFirstPage() ? 'disabled' : '' }}"
        href="{{ $games->onFirstPage() ? '#' : ('?page='.($current - 1).$qs) }}">&lsaquo;</a>

    @foreach($pages as $p)
        @if($p == $current)
            <span class="page-btn current">{{ $p }}</span>
        @else
            <a href="{{ '?page='.$p.$qs }}" class="page-btn">{{ $p }}</a>
        @endif
    @endforeach

    <a
        class="page-btn {{ $games->hasMorePages() ? '' : 'disabled' }}"
        href="{{ $games->hasMorePages() ? ('?page='.($current + 1).$qs) : '#' }}">&rsaquo;</a>
</div>

<div class="pagination-jump">
    <label for="page-select">Go to page:</label>
    <select id="page-select" class="page-select page-btn" onchange="location.href='?page='+this.value+'{{ $qs }}'">
        @for($p = 1; $p <= $last; $p++)
            <option value="{{ $p }}" {{ $p == $current ? 'selected' : '' }}>{{ $p }}</option>
        @endfor
    </select>
    <span class="total-pages">/ {{ $last }}</span>
    
</div>

 
