<?php

namespace App\Http\Controllers;

use App\Models\GameLibrary;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = $request->input('q');

        $games = $user->gameLibrary()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%");
            })
            ->get();

        if ($request->ajax()) {
            return view('collection-list', compact('games'))->render();
        }

        return view('collection', compact('games'));
    }

    public function library_index(Request $request)
{
    $query = $request->input('q');

    // Force reload of the user's library for accurate $owned checks
    $user = $request->user();
    if ($user) {
        $user->load('gameLibrary');
    }

    $featuredgame = empty($query) ? GameLibrary::first() : null;

    $games = GameLibrary::when($query, function ($q) use ($query) {
        $q->where('title', 'like', "%{$query}%");
    })->get();

    if ($request->ajax()) {
        return view('library-list', compact('featuredgame', 'games'))->render();
    }

    return view('library', compact('featuredgame', 'games'));
}


    public function add(GameLibrary $gameLibrary, Request $request)
    {
        $user = $request->user();
        $user->gameLibrary()->syncWithoutDetaching([$gameLibrary->id]);

        // Reload relationship to get updated library
        $user->load('gameLibrary');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'owned' => $user->gameLibrary->pluck('id')->contains($gameLibrary->id)
            ]);
        }

        return back()->with('success', 'Game added to your collection.');
    }

    public function remove(GameLibrary $gameLibrary, Request $request)
    {
        $user = $request->user();
        $user->gameLibrary()->detach($gameLibrary->id);

        // Reload relationship
        $user->load('gameLibrary');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'owned' => $user->gameLibrary->pluck('id')->contains($gameLibrary->id)
            ]);
        }

        return back()->with('success', 'Game removed from your collection.');
    }

    public function status(Request $request)
    {
        $user = $request->user();
        $ownedIds = $user->gameLibrary()->pluck('games_library.id'); // get all owned game IDs
        return response()->json([
            'owned' => $ownedIds
        ]);
    }

}
