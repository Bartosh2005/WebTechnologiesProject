<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\GameLibrary;

class GameController extends Controller
{
    public function index()
    {
        $games = DB::table('games_library')->get();
        $featuredgame = DB::table('games_library')->first();

        return view('library', [
            'games' => $games,
            'featuredgame' => $featuredgame,
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
