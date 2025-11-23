<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page with daily picks
     */
    public function index()
    {
        $games = DB::table('games_library')->get();
        $featuredgame = DB::table('games_library')->first();

        // Select 4 "random" games that change once per day
        $randomGames = collect();
        $allIds = DB::table('games_library')->pluck('id')->toArray();
        if (!empty($allIds)) {
            $date = date('Y-m-d');
            $scores = [];
            foreach ($allIds as $id) {
                $scores[$id] = crc32($id . $date);
            }
            asort($scores);
            $selected = array_slice(array_keys($scores), 0, 4);
            $randomGames = DB::table('games_library')->whereIn('id', $selected)->get()
                ->sortBy(function ($g) use ($selected) {
                    return array_search($g->id, $selected);
                })->values();
        }

        // Slider with games
        $sliderGames = DB::table('games_library')->inRandomOrder()->limit(8)->get();

        return view('welcome', compact('games', 'featuredgame', 'randomGames', 'sliderGames'));
    }
}
