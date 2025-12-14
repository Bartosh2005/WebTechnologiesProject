<?php

namespace App\Http\Controllers;

use App\Models\GameLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class CollectionController extends Controller
{

    public function getDataFromIGDB(string $query)//, int $userId = -1)
    {
        //exrernal search
        $userId = auth()->id();
        $url = "https://api.igdb.com/v4/games";
        $igdb = require 'igdb.php';
        $client_id = $igdb['client_id'];
        $auth = $igdb['auth'];

        $exgames = Http::withHeaders([
            'Client-ID' => $client_id,
            'Authorization' => $auth,
        ])->withBody($body, 'text/plain')->post($url);

        $exgames = $exgames->json();

        foreach ($exgames as &$exgame) {
            $body2 = "fields cover.url; where id=".strval($exgame['id']).";";

            $coverurl = Http::withHeaders([
                'Client-ID' => $client_id,
                'Authorization' => $auth,
            ])->withBody($body2, 'text/plain')->post($url);
            $coverurl = $coverurl->json();
            $exgame['coverurl'] = Str::replace("t_thumb", "t_cover_big", $coverurl[0]['cover']['url']) ?? "";

            $exgame['owned'] = DB::table('external_library_game_user')->where('game_id', "=", $exgame['id'])->where('user_id', '=', $userId)->exists();


            $exgame['id'] = "IGDB_".$exgame['id'];
        }
        return $exgames;
    }

    public function getDataFromIGDBcustomquery(string $query)//, int $userId = -1)
    {
        //exrernal search
        $userId = auth()->id();
        $url = "https://api.igdb.com/v4/games";
        $igdb = require 'igdb.php';
        $client_id = $igdb['client_id'];
        $auth = $igdb['auth'];
        $exgames = Http::withHeaders([
            'Client-ID' => $client_id,
            'Authorization' => $auth,
        ])->withBody($query, 'text/plain')->post($url);

        $exgames = $exgames->json();

        foreach ($exgames as &$exgame) {
            $body2 = "fields cover.url; where id=".strval($exgame['id']).";";

            $coverurl = Http::withHeaders([
                'Client-ID' => $client_id,
                'Authorization' => $auth,
            ])->withBody($body2, 'text/plain')->post($url);
            $coverurl = $coverurl->json();
            $exgame['coverurl'] = Str::replace("t_thumb", "t_cover_big", $coverurl[0]['cover']['url']) ?? "";

            $exgame['owned'] = DB::table('external_library_game_user')->where('game_id', "=", $exgame['id'])->where('user_id', '=', $userId)->exists();


            $exgame['id'] = "IGDB_".$exgame['id'];
        }
        return $exgames;
    }


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
            return view('collection-list', compact('games', 'exgames'))->render();
        }

        $exids = DB::table('external_library_game_user')->where('user_id', '=', $user->id)->pluck('game_id')->toArray();
        $querylist = "";
        foreach($exids as $exid){
            $querylist=$querylist.strval($exid).",";
        }
        $querylist = substr($querylist, 0, -1);
        $exgames = $this->getDataFromIGDBcustomquery("fields *; where id=(".$querylist.");");
        // $querylist = "fields *; where id=(".$querylist.");";
        return view('collection', compact('games', 'exgames'));
    }

    public function library_index(Request $request)
    {
        $user = $request->user();
        $query = $request->input('q');

        // show featured game if there's nothing in the search bar
        $featuredgame = empty($query) ? GameLibrary::first() : null;

        // get all games/ filter if search done
        $games = GameLibrary::when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%");
        })->get();
        $exgames = [];
        // if AJAX search, just a partial view is returned
        if ($request->ajax()) {
            return view('library-list', compact('featuredgame', 'games', 'exgames'))->render();
        }

        $exgames = $this->getDataFromIGDB($query ?? "");

        return view('library', compact('featuredgame', 'games', 'exgames'));
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

    public function addEx(string $gameId, Request $request)
    {
        $user = $request->user();
        DB::table('external_library_game_user')->insert([
            'user_id' => $user->id,
            'game_id' => intval(explode("_", $gameId)[1]),
            'database' => explode("_", $gameId)[0],
            'created_at' => now(),
            'updated_at' => now(),
        ]);


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

    public function removeEx(string $gameId, Request $request)
    {
        $user = $request->user();

        DB::table('external_library_game_user')->where('game_id', "=", intval(explode("_", $gameId)[1]))->where('database', '=', explode("_", $gameId)[0])->delete();


        // For AJAX requests, return success, since it worked
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Game removed from your collection.');
    }
}
