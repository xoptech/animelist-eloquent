<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Anime;
use App\Models\Studio;

class AnimeStudioSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::connection()->disableQueryLog();

        $maxAnimes = 500; 
        $collected = 0;
        $page = 1;

        while (true) {
            $query = '
                query ($page: Int, $perPage: Int) {
                    Page(page: $page, perPage: $perPage) {
                        pageInfo { hasNextPage }
                        media(type: ANIME, sort: POPULARITY_DESC) {
                            idMal
                            title { romaji english }
                            description
                            coverImage { large }
                            episodes
                            duration
                            status
                            startDate { year month day }
                            endDate { year month day }
                            genres
                            studios(isMain: true) { edges { node { name } } }
                        }
                    }
                }
            ';

            $response = Http::timeout(30)
                ->withOptions(['verify' => false])
                ->withHeaders(['User-Agent' => 'Laravel-AnimeSeeder/1.0'])
                ->post('https://graphql.anilist.co', [
                    'query' => $query,
                    'variables' => ['page' => $page, 'perPage' => 50],
                ]);

            if (!$response->successful()) {
                $this->command->error('HTTP error: ' . $response->status());
                break;
            }

            $data = $response->json('data.Page.media') ?? [];
            $hasNextPage = $response->json('data.Page.pageInfo.hasNextPage') ?? false;

            DB::transaction(function () use ($data, $maxAnimes, &$collected) {
                foreach ($data as $item) {
                    if ($maxAnimes !== null && $collected >= $maxAnimes) break;

                    $title = $item['title']['english'] ?? $item['title']['romaji'] ?? 'Untitled';

                    $anime = Anime::updateOrCreate(
                        ['title' => $title],
                        [
                            'synopsis' => strip_tags($item['description'] ?? ''),
                            'thumbnail' => $item['coverImage']['large'] ?? '',
                            'episode' => (int) ($item['episodes'] ?? 0),
                            'duration' => (int) ($item['duration'] ?? 0),
                            'status' => ucwords(strtolower(str_replace('_', ' ', $item['status'] ?? 'UNKNOWN'))),
                            'aired_from' => $this->formatDate($item['startDate'] ?? null),
                            'aired_to' => $this->formatDate($item['endDate'] ?? null),
                            'genre' => implode(', ', $item['genres'] ?? ['Unknown']),
                        ]
                    );

                    $studioIds = [];
                    foreach ($item['studios']['edges'] ?? [] as $edge) {
                        $studioName = $edge['node']['name'] ?? null;
                        if ($studioName) {
                            $studio = Studio::updateOrCreate(
                                ['name' => $studioName],
                                ['description' => '', 'established_at' => null]
                            );
                            $studioIds[] = $studio->id;
                        }
                    }
                    $anime->studios()->syncWithoutDetaching($studioIds);

                    $collected++;
                }
            });

            if ($maxAnimes !== null && $collected >= $maxAnimes) break;
            if (!$hasNextPage) break;

            $page++;
            sleep(1);
        }
    }

    private function formatDate($date): ?string
    {
        return !$date || empty($date['year']) ? null : sprintf('%04d-%02d-%02d', $date['year'], $date['month'] ?? 1, $date['day'] ?? 1);
    }
}
