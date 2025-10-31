<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/library', function () {
    $games = [];

    return view('library', compact('games'));
});

Route::get('/collection', function () {
    $games = [];

    return view('collection', compact('games'));
});

Route::get('/newsletter', function () {
    $games = [];

    return view('newsletter', compact('games'));
});

Route::get('/welcome', function () {
    $games = [];

    return view('welcome', compact('games'));
});
Route::get('/account', function () {
    $games = [];

    return view('account', compact('games'));
});

Route::get('/articles/silksong', function () {
    return view('articles.silksong');
});

Route::get('/articles/hades2', function () {
    return view('articles.hades2');
});

Route::get('/articles/ssg', function () {
    return view('articles.ssg');
});

Route::get('/articles/goy', function () {
    return view('articles.goy');
});

Route::get('/articles/terminus', function () {
    return view('articles.terminus');
});

Route::get('/articles/bd4', function () {
    return view('articles.bd4');
});

Route::get('/articles/ananta', function () {
    return view('articles.ananta');
});

Route::get('/articles/doomTDA', function () {
    return view('articles.doomTDA');
});

use App\Http\Controllers\RegisterController;

Route::get('/register', function () {
    return view('account');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');