<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;

#[UseModel(Profile::class)]
class ProfileFactory extends Factory
{
    private static int $i = 0;

    public function definition(): array
    {
        $bios = [
			'Best admin in the world 67 gyatttt',
            'Mean score: 4.5. Most of your favorites are mid. 🤷‍♂️',
            'I drop everything that has CGI. Hand-drawn or nothing.',
            'I spend more time editing my profile CSS than actually watching seasonal anime.',
            'Rating scale: 10 = Masterpiece, 5 = Average, 1 = I only finished it out of spite.',
            'Manga was better. The studio completely ruined the pacing in the second half.',
            'Currently surviving purely on seasonal trash and caffeine.',
            'If it doesn\'t have top-tier sakuga, I\'m dropping it by episode 3.',
            'My "Plan to Watch" list has been growing steadily since 2014. It is beyond saving.',
            'I only use MyAnimeList to track my 100+ days of wasted life.',
            'Don\'t trust my ratings, I give everything a 10 if I like the OP.',
            'Just here to complain in the weekly episode discussion threads.',
            'I dropped your favorite anime. It\'s nothing personal.',
            'Proud member of the "No Drop" club. I suffer through every 1/10 to the bitter end.',
            'I judge people entirely based on their 3x3 favorites grid.',
            'I refuse to watch anything mainstream until at least 5 years after it aired.',
            'Updating my list so I can pretend I achieved something today.',
            'A solid 7/10 is a good score, you guys just don\'t know how numbers work.',
            'Sub over Dub. Always. I prefer reading my TV shows.',
            'I rate based on pure enjoyment, not objective quality. Don\'t @ me.',
            'Rewatching the same 2000s anime because modern adaptations have pacing issues.',
            'I haven\'t watched anime since 2011, I just come here to argue.',
            'Only here to give Fullmetal Alchemist: Brotherhood a 1 to lower its score.',
            'Romcoms are the only thing keeping me sane.',
            'I base my entire personality on the main character of whatever I\'m currently watching.',
            'If the MC isn\'t overpowered in the first 5 minutes, I\'m out.',
            'Evangelion changed my life and I will not elaborate.',
            'Still waiting for No Game No Life Season 2.',
            'I watch anime at 2x speed to get through my backlog faster.',
            'I unironically enjoy filler episodes. More time with the characters.',
            'Slice of Life is the peak of human fiction.',
            'I only watch shows with cute girls doing cute things.',
            'Mecha is a dying genre and it breaks my heart.',
            'Power scaling debates are my true passion.',
            'The beach episode is the most important part of any anime.',
            'I don\'t actually watch anime, I just watch YouTube essays about anime.',
            'Your waifu is trash. Mine is objectively superior.',
            'I rank anime purely by the quality of its tournament arc.',
            'I pretend to understand the plot of Monogatari.',
            'If the protagonist has black hair and sits in the back window seat, it\'s a 10/10.',
            'I gave up on keeping track of Fate watch orders.',
            'Sports anime have better character development than actual shounen.',
            'Idol anime ruined a generation, myself included.',
            'I only watch anime from the 90s. The aesthetic is unmatched.',
            'Gintama ruined comedy for me because nothing else compares.',
            'I am legally obligated to defend Sword Art Online.',
            'I haven\'t updated this list in 3 years but I still log in daily.',
            'My taste is impeccable, your taste is garbage.',
            'The opening skipped, opinion rejected.',
            'I only read Light Novels with titles longer than 15 words.',
            'I miss the old days of torrenting fansubs.'
        ];

        $username = fake()->userName();

        return [
            'user_id' => User::factory(),
            'username' => $username,
            'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . $username,
            'bio' => $bios[self::$i++ % 50],
        ];
    }
}