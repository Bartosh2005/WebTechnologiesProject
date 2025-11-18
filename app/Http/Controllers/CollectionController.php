<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameLibrary;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $games = $user->gameLibrary()->paginate(12); // get user’s games
        return view('collection', compact('games'));
    }

    public function add(GameLibrary $gameLibrary, Request $request)
    {
        $user = $request->user();
        $user->gameLibrary()->syncWithoutDetaching([$gameLibrary->id]);
        return back()->with('success', 'Game added to your collection.');
    }

    public function remove(GameLibrary $gameLibrary, Request $request)
    {
        $user = $request->user();
        $user->gameLibrary()->detach($gameLibrary->id);
        return back()->with('success', 'Game removed from your collection.');
    }
}
