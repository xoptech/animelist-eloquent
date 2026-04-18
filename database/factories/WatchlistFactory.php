<?php

namespace Database\Factories;

use App\Models\Watchlist;
use App\Models\User;
use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;

#[UseModel(Watchlist::class)]
class WatchlistFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'anime_id' => Anime::factory(),
            'status' => fake()->randomElement(['Watching', 'Completed', 'Plan to Watch', 'Dropped']),
        ];
    }
}
