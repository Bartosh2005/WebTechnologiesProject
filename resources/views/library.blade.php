<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('css/libraryl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/addbutton.js') }}"></script>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('LogoJustIcon.ico') }}?v={{ time() }}">
</head>

<meta name="csrf-token" content="{{ csrf_token() }}">

<body>
    @include('layouts.header')

    <main>
        <section>    
            <div class="game-library">

                @if (session('role') === 'admin')
                    <center>
                        <button class="add-button-admin">Add game to library</button>
                        <p><br><br></p>
                    </center>
                @endif

                <center>
                    <p><br><br></p>
                    <h2 class="title-size">Browse the full library of GameVault and add games to MyCollection!</h2><br>
                    <input id="search-bar" type="text" placeholder="Search any game in MyGameBrowser to add to MyCollection.."><br>
                </center>

                <div class="grid-container" id="girdlibrary">
                    
                    {{-- Featured Game --}}
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

                        <div href="{{ url('/library/' . Str::slug($featuredgame->title)) }}">
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

                    </div>

                    {{-- Other Games --}}
                    @foreach ($games->skip(1) as $game)
                        <div class="sub-article" style="background-image: url('{{ $game->img }}')">

                           

                            <div class="overlay">
                                <p class="game">{{ $game->title }}</p>
                                @php
                                    $text = $game->description;
                                    $sentences = preg_split('/(?<=[.?!])\s+/', $text);
                                    $limited = implode(' ', array_slice($sentences, 0, 3));
                                @endphp
                                <p>{{ $limited }}

                                    <div>
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

                                </p>
                                    
                            </div>

                                    
                            
                                    
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <footer>
            <p>&copy; 2025 Game Library</p>
        </footer>
        
    </main>
</body>
</html>