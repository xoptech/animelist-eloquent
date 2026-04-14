<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{

    protected $fillable = ['title', 'synopsis', 'thumbnail', 'episode', 'aired_from', 'aired_to', 'duration', 'status', 'genre'];

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function animeStudio()
    {
        return $this->hasMany(AnimeStudio::class);
    }
}
