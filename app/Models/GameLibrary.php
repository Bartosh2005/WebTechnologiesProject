<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameLibrary extends Model
{
    protected $table = 'games_library';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',        // Game name
        'description',  // description
        'year',
        'img',          // Background image URL
        'genre',        // Comma-separated genres
        'company',      // Developers / publishers
        'released_at',  // Release date
        'rating',       // Rating (decimal)
        'tags'
    ];

    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,        // related model
            'user_game_library',            // pivot table name
            'game_library_id',              // this model's FK on pivot
            'user_id'                       // related model's FK on pivot
        )->withTimestamps();
    }
}
