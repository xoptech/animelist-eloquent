<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;

#[UseModel(User::class)]
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $username = fake()->unique()->userName();

        return [
            'username' => $username,
            'email' => $username . '@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'user'
        ];
    }
}
