<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;

#[UseModel(Favorite::class)]
class FavoriteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'anime_id' => Anime::factory(),
        ];
    }
}
