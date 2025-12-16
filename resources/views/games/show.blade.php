@extends('layouts.app')

@section('content')
<div class="game-page">
    <h1>{{ $gameLibrary->title }}</h1>

    <img src="{{ $gameLibrary->img }}" alt="{{ $gameLibrary->title }}">

    <p>{{ $gameLibrary->description }}</p>

    <p><strong>Year:</strong> {{ $gameLibrary->released_at }}</p>
    <p><strong>Genre:</strong> {{ $gameLibrary->genre }}</p>
    <p><strong>Company:</strong> {{ $gameLibrary->company }}</p>
    <p><strong>Rating:</strong> {{ $gameLibrary->rating }}</p>

    @auth
        @php
            $owned = auth()->user()->gameLibrary->pluck('id')->contains($gameLibrary->id);
        @endphp

        <button 
            class="add-button {{ $owned ? 'remove-from-library-btn' : 'add-to-library-btn' }}" 
            data-game-id="{{ $gameLibrary->id }}">
            {{ $owned ? 'Remove from MyCollection' : 'Add to MyCollection' }}
        </button>
    @endauth
</div>
@endsection
