<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLibrary extends Model
{
    protected $table = 'games_library';

    protected $fillable = [
        'title',        // Game name
        'description',  // description
        'img',          // Background image URL
        'genre',        // Comma-separated genres
        'company',      // Developers / publishers
        'released_at',  // Release date
        'rating',       // Rating (decimal)
    ];

}
