<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardNomination extends Model
{
    protected $table = 'award_nominations';

    protected $fillable = [
        'user_id',
        'game_id',
        'category_id',
    ];
}
