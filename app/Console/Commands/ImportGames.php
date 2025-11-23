<?php

namespace App\Console\Commands;

use App\Models\GameLibrary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:import {count=200}';

    /**
     *The console command description.
     *
      @var string
     */
    protected $description = 'Import games from RAWG API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->argument('count');
        $perPage = 40;
        $pages = ceil($count / $perPage);

        $this->info("Fetching $count games from RAWG API...");

        for ($page = 1; $page <= $pages; $page++) {
            $response = Http::get('https://api.rawg.io/api/games', [
                'key' => env('RAWG_API_KEY'),
                'page' => $page,
                'page_size' => $perPage,
            ]);
            $this->info('HTTP status: '.$response->status());

            $games = $response->json('results');

            if ($games === null) {
                $this->error('RAWG returned no results:');
                dd($response->json());
            }

            foreach ($games as $game) {
                $this->info('Importing game: '.$game['name']);

                if (GameLibrary::where('title', $game['name'])->exists()) {
                    continue;
                }

                $genre = null;

                if (! empty($game['genres'])) {
                    $genre = implode(', ', array_column($game['genres'], 'name'));
                }

                $company = null;

                if (! empty($game['developers'])) {
                    $company = implode(', ', array_column($game['developers'], 'name'));
                }

                $details = Http::get("https://api.rawg.io/api/games/{$game['id']}", [
                    'key' => env('RAWG_API_KEY'),
                ])->json();

                $description = $details['description_raw'] ?? null;

                $company = null;
                if (! empty($details['developers'])) {
                    $company = implode(', ', array_column($details['developers'], 'name'));
                }

                GameLibrary::create([
                    'rawg_id' => $game['id'],
                    'title' => $game['name'],
                    'description' => $description,
                    'img' => $game['background_image'] ?? null,
                    'genre' => $genre,
                    'company' => $company,
                    'released_at' => $game['released'] ?? null,
                    'rating' => $game['rating'] ?? null,
                ]);
            }
            sleep(1);
            $this->info("Page $page imported.");
        }

        $this->info('Import completed!');
    }
}
