<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = DB::table('games_library')->get();
        $featuredgame = DB::table('games_library')->first();

        return view('library', [
            'games' => $games,
            'featuredgame' => $featuredgame,
    ]);
    }
}
