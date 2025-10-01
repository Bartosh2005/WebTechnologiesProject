<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/library', function () {
    $games=[];
    return view('library', compact('games'));
});

Route::get('/collection', function () {
    $games=[];
    return view('collection', compact('games'));
});

Route::get('/newsletter', function () {
    $games=[];
    return view('newsletter', compact('games'));
});

Route::get('/welcome', function () {
    $games=[];
    return view('welcome', compact('games'));
});