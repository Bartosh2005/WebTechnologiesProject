<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function nominations()
    {
        return $this->hasMany(AwardNomination::class);
    }
}
