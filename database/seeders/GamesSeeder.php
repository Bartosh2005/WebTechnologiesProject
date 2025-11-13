<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{

    public function run(): void
    {
        $json = File::get(database_path('seeders/gameslist.json'));

        $data = json_decode($json, true);

        foreach ($data as &$game) {
        if (isset($game['tags']) && is_array($game['tags'])) {
            $game['tags'] = json_encode($game['tags']);
        }
        }
        
        DB::table('games_library')->insert($data);
    }
}
