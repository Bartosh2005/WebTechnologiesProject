<?php

namespace App\Http\Controllers;

use App\Models\AwardCategory;
use Illuminate\Support\Facades\DB;

class AwardController extends Controller
{
    public function index()
    {
        // Load all categories
        $categories = AwardCategory::all();

        // Build leaderboards per category
        $leaderboards = [];

        foreach ($categories as $category) {
            $leaderboards[$category->id] = DB::table('award_nominations')
                ->join('games_library', 'games_library.id', '=', 'award_nominations.game_id')
                ->where('award_nominations.category_id', $category->id)
                ->select(
                    'games_library.id',
                    'games_library.title',
                    'games_library.img',
                    DB::raw('COUNT(award_nominations.id) as votes')
                )
                ->groupBy(
                    'games_library.id',
                    'games_library.title',
                    'games_library.img'
                )
                ->orderByDesc('votes')
                ->get();
        }

        return view('gameawards', compact('categories', 'leaderboards'));
    }
}
