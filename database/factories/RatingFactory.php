<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\User;
use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;

#[UseModel(Rating::class)]
class RatingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'anime_id' => Anime::factory(),
            'score' => fake()->numberBetween(5, 10),
        ];
    }
}
