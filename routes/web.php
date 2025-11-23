<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\GameController;
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

Route::get('/welcome', function () {
    $games = [];

    return view('welcome', compact('games'));
});
Route::get('/account', function () {
    $games = [];

    return view('account', compact('games'));
});

Route::get('/admin', function () {
    return view('admin');
});
Route::post('/admin', [GameController::class, 'add'])->name('admin.add');

// I, Serafeim put the routing for the hardcoded articles here, because if put after the /articles/{slug},
// it get overriden by it and it doesnt show the articles, only database ones

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

Route::get('/newsletter', [ArticleController::class, 'index'])->name('newsletter.index');
Route::get('/add-article', [ArticleController::class, 'create'])->name('add-article.create');
Route::post('/add-article', [ArticleController::class, 'store'])->name('add-article.add');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::post('/articles/{id}/edit', [ArticleController::class, 'saveEdit'])->name('articles.saveEdit');
Route::post('/articles/{id}/delete', [ArticleController::class, 'destroy'])->name('articles.delete');

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

Route::get('/library', [GameController::class, 'index']);

Route::post('/library/add', [LibraryController::class, 'add'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/collection', [CollectionController::class, 'index'])->name('collection.index');
    Route::post('/collection/add/{gameLibrary}', [CollectionController::class, 'add'])->name('collection.add');
    Route::post('/collection/remove/{gameLibrary}', [CollectionController::class, 'remove'])->name('collection.remove');
    Route::get('/myaccount', function () {
        return view('myaccount');
    })->name('myaccount');
});

Route::get('/library', [CollectionController::class, 'library_index'])->name('library.index');
