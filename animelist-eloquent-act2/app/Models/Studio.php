<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['name', 'description', 'established_at'];

    public function animeStudio()
    {
        return $this->hasMany(AnimeStudio::class);
    }
}
