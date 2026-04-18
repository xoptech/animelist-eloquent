<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'established_at'];

    public function animeStudio()
    {
        return $this->hasMany(Anime::class, 'anime_studio')
                    ->withTimestamps();
    }
}
