<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Database\Factories\AnimeFactory;

#[UseFactory(AnimeFactory::class)]
class Anime extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'synopsis', 'thumbnail', 'episode', 'aired_from', 'aired_to', 'duration', 'status', 'genre'];

    protected $casts = [
        'aired_from' => 'date',
        'aired_to' => 'date',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class, 'anime_studio')
                    ->withTimestamps();
    }

    public function watchlists()
    {
        return $this->hasMany(Watchlist::class);
    }
}
