<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimeStudio extends Model
{
    protected $table = 'anime_studio';

    protected $fillable = ['anime_id', 'studio_id'];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
