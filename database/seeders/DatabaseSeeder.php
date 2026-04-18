<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Anime;
use App\Models\Profile;
use App\Models\Rating;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Watchlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::connection()->disableQueryLog();

        $this->call(AnimeStudioSeeder::class);

        $animes = Anime::all();

        DB::transaction(function () use ($animes) {
            User::factory()
                ->has(Profile::factory()->state(fn (array $attr, User $user) => [
                    'username' => $user->username,
                    'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $user->username,
                ]))
                ->create([
                    'username' => 'admin',
					'password' => 'admin',
                    'email' => 'admin@gmail.com',
                    'role' => 'admin',
                ]);

            User::factory(50)
                ->recycle($animes)
                ->has(Profile::factory()->state(fn (array $attr, User $user) => [
                    'username' => $user->username,
                    'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $user->username,
                ]))
                ->has(Rating::factory()->count(rand(300, 500)))
                ->has(Favorite::factory()->count(rand(300, 500)))
                ->has(Review::factory()->count(rand(300, 500)))
                ->has(Watchlist::factory()->count(rand(300, 500)))
                ->create();
        });
    }
}
