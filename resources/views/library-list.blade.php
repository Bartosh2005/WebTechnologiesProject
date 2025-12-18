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




@foreach ($games as $game)
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

<style>
.pagination-controls{display:flex;gap:8px;justify-content:center;align-items:center;margin:18px 0 6vh 0}
.pagination-controls .page-btn{background:#B23535;color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none;display:inline-flex;align-items:center;justify-content:center;border:none}
.pagination-controls .page-btn.disabled{opacity:.4;cursor:default}
.pagination-controls .page-btn.current{background:#7a7676}
</style>