<?php

namespace App\Http\Controllers;

use App\Models\AwardCategory;
use App\Models\GameLibrary;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = $request->input('q');

        // Load all games in the user's collection
        $games = $user->gameLibrary()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%");
            })
            ->get();

        // LOAD AWARD CATEGORIES FOR NOMINATIONS
        $categories = AwardCategory::all();

        // If the request is AJAX (search bar), return only the partial view
        if ($request->ajax()) {
            return view('collection-list', compact('games', 'categories'))->render();
        }

        // If not AJAX, return full page
        return view('collection', compact('games', 'categories'));
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
