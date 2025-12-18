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

        $gamesQuery = $user->gameLibrary()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%");
            });

        $games = $gamesQuery->paginate(9)->withQueryString();

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

        //getting paginated games, 9 games per page, featured game is excluded
        if ($featuredgame) {
            $perPage = 9;
            $games = GameLibrary::when($query, function ($q) use ($query, $featuredgame) {
                $q->where('title', 'like', "%{$query}%")->where('id', '!=', $featuredgame->id);
            })->paginate($perPage)->withQueryString();
        } else {
            $games = GameLibrary::when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%");
            })->paginate(9)->withQueryString();
        }

        // if AJAX search, just a partial view is returned
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

        // For AJAX requests, return success, since it worked
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Game removed from your collection.');
    }
}
