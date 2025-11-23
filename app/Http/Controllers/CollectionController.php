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

        // Show the featured game only if there's no search query
        $featuredgame = empty($query) ? GameLibrary::first() : null;

        // Fetch all games, or filter them if a search is done
        $games = GameLibrary::when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%");
        })->get();

        // if an AJAX search, return only the partial view
        if ($request->ajax()) {
            return view('library-list', compact('featuredgame', 'games'))->render();
        }

        return view('library', compact('featuredgame', 'games'));
    }

    public function add(GameLibrary $gameLibrary, Request $request)
    {
        $user = $request->user();
        $user->gameLibrary()->syncWithoutDetaching([$gameLibrary->id]);

        // If request is AJAX, respond with JSON
        if ($request->ajax()) {
            return response()->json(['success' => true, 'added' => true]);
        }

        return back()->with('success', 'Game added to your collection.');
    }

    public function remove(GameLibrary $gameLibrary, Request $request)
    {
        $user = $request->user();
        $user->gameLibrary()->detach($gameLibrary->id);

        // For AJAX requests, just returning a success
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Game removed from your collection.');
    }
}
