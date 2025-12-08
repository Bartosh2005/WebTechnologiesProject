<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('award_categories')->insert([
            ['name' => 'Best RPG', 'slug' => 'best-rpg'],
            ['name' => 'Best Music', 'slug' => 'best-music'],
            ['name' => 'Game of the Year', 'slug' => 'goty'],
        ]);
    }
}
