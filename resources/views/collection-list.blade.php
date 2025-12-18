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
        $current = $games->currentPage();
        $first = max(1, $current - 1);
        $last = min($games->lastPage(), $current + 1);
    @endphp

    <a class="page-btn {{ $games->onFirstPage() ? 'disabled' : '' }}" href="{{ $games->previousPageUrl() ?? '#' }}">&lsaquo;</a>

    @for($p = $first; $p <= $last; $p++)
        @if($p == $current)
            <span class="page-btn current">{{ $p }}</span>
        @else
            <a href="{{ $games->url($p) }}" class="page-btn">{{ $p }}</a>
        @endif
    @endfor

    <a class="page-btn {{ $games->hasMorePages() ? '' : 'disabled' }}" href="{{ $games->nextPageUrl() ?? '#' }}">&rsaquo;</a>
</div>

<style>
.pagination-controls{display:flex;gap:8px;justify-content:center;align-items:center;margin:18px 0 6vh 0}
.pagination-controls .page-btn{background:#B23535;color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;border:none}
.pagination-controls .page-btn.disabled{opacity:.4;cursor:default}
.pagination-controls .page-btn.current{background:#7a7676}
</style>
