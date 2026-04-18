<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Database\Factories\WatchlistFactory;

#[UseFactory(WatchlistFactory::class)]
class Watchlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'anime_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
