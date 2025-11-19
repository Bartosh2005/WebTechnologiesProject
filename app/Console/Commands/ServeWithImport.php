<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ServeWithImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:with-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports games if DB is empty before starting the webpage right after';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = \DB::table('games_library')->count();

        if ($count == 0) {
            $this->info("games_library is empty — importing...");
            $this->call('games:import', ['count' => 200]); // put your default number
        } else {
            $this->info("games_library already populated — skipping import.");
        }

        // Start Laravel's built-in server
        $this->call('serve');
    }
}
