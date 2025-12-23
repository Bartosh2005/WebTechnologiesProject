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

        // show featured game if there's nothing in the search bar
        $featuredgame = empty($query) ? GameLibrary::first() : null;

        // get all games/ filter if search done
        $games = GameLibrary::when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%");
        })->get();

        // if AJAX search, just a partial view is returned
        if ($request->ajax()) {
            return view('library-list', compact('featuredgame', 'games'))->render();
        }

        return view('library', compact('featuredgame', 'games'));
    }

    public function add($locale = null, GameLibrary $gameLibrary, Request $request)
    {
        // $locale originates from the optional route prefix, we don't need it here but accept it
        $user = $request->user();
        $user->gameLibrary()->syncWithoutDetaching([$gameLibrary->id]);

        // If request is AJAX, respond with JSON
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['success' => true, 'added' => true]);
        }

        return back()->with('success', 'Game added to your collection.');
    }

    public function remove($locale = null, GameLibrary $gameLibrary, Request $request)
    {
        $user = $request->user();
        $user->gameLibrary()->detach($gameLibrary->id);

        // For AJAX requests, return success, since it worked
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Game removed from your collection.');
    }
}
