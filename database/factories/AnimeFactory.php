<?php

namespace Database\Factories;

use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;

#[UseModel(Anime::class)]
class AnimeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(3),
            'synopsis' => fake()->paragraph(),
            'thumbnail' => 'https://placehold.co/400x600?text=Anime',
            'episode' => fake()->numberBetween(12, 24),
            'status' => 'Finished Airing',
            'genre' => fake()->word(),
        ];
    }
}
