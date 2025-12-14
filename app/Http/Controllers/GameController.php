<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\GameLibrary;

class GameController extends Controller
{
    public function index()
    {
        $games = DB::table('games_library')->get();
        $featuredgame = DB::table('games_library')->first();

        //exrernal search
        // $url = "https://api.igdb.com/v4/games";
        // $client_id = "b8ekm56793nybq49it7gxdenjanfkl";
        // $auth = "Bearer 32ismcwqybbvryrt81wrzi9i8kpqxc";
        // $body = 'search "Halo"; fields *;';

        // $exgames = Http::withHeaders([
        //     'Client-ID' => $client_id,
        //     'Authorization' => $auth,
        // ])->withBody($body, 'text/plain')->post($url);
        // $exgames = $exgames->json();

        // foreach($exgames as &$exgame){
        //     $exgame['id']="IGDB_".$exgame['id'];
        // }

        return view('library', [
            'games' => $games,
            'featuredgame' => $featuredgame,
            // 'exgames' => $exgames,
        ]);
    }

    public function add(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        $filename = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

           
            $filename = time() . '_' . $file->getClientOriginalName();

            
            $file->move(public_path('imgs'), $filename);
        }

        $tagsJSON = json_encode(preg_replace('/\s+/', '', explode(",", $request->tags)));

        
        GameLibrary::create([
            'title'       => $request->title,
            'genre'       => $request->genre,
            'year'        => $request->year,
            'company'     => $request->company,
            'description' => $request->description,
            'img'         => $filename,
            'tags'        =>$tagsJSON,
        ]);


        return redirect()->back()->with('success', 'Game added successfully!');
    }
}
