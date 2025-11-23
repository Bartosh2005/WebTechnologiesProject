<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'image',
        'content',
    ];

    // Cast content to array automatically
    protected $casts = [
        'content' => 'array',
    ];

    // Auto-generate slug from title if not supplied
    public static function booted()
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title).'-'.Str::random(6);
            }
        });
    }
}
