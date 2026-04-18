<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;

#[UseModel(Review::class)]
class ReviewFactory extends Factory
{
    private static int $i = 0;

    public function definition(): array
    {
        $reviews = [
            "A complete masterpiece. The pacing is flawless, the characters are incredibly well-written with believable motivations, and the OST elevates every single scene. The studio clearly put their heart and soul into this. Story: 10, Art: 10, Sound: 10, Character: 10.",
            "I honestly don't get the hype. It started off with a really interesting premise, but by the halfway point, the plot completely derailed. The main character becomes unbearable, and the ending felt totally rushed. Huge letdown. Overall: 4/10.",
            "This is the definition of a hidden gem. While the animation might seem a bit dated or quirky at first, the writing carries the entire show. The character dynamics feel so natural. Don't let the first episode fool you, stick with it.",
            "If you can't handle dark themes, skip this. It doesn't pull any punches. The atmosphere is oppressive, and the psychological aspects of the characters are explored in such a raw way. Not an easy watch, but a brilliant one.",
            "It's exactly what you expect. It doesn't reinvent the wheel, but it executes the standard tropes competently. The art is decent, the OP is a banger, but the story is pretty predictable. A solid 6 or 7/10 to pass the time.",
            "As a source material reader, I'm pretty conflicted. They adapted the main beats okay, but skipped so much crucial inner monologue and world-building. Anime-onlys will probably enjoy it, but it could have been so much better.",
            "Story-wise? Absolutely brain-dead. Animation-wise? Pure cinematic perfection. The sakuga in the action sequences is jaw-dropping. If you just want to turn your brain off and watch pretty colors and insane camera work, this is for you.",
            "I went into this expecting a normal show and came out emotionally devastated. The way they build up your attachment to the cast only to rip your heart out is cruel but brilliant. Bring tissues. You've been warned.",
            "Complete garbage. The writing relies entirely on cheap cliffhangers and plot armor. The villains have zero depth, and the power scaling makes absolutely no sense. I only finished it so I could rate it a 1.",
            "The definition of a slow burn. The first few episodes require a lot of patience as it sets up the world and the rules. But once the payoff hits in the second half, every single slow moment feels justified. Incredible storytelling.",
            "I haven't laughed this hard in ages. The comedic timing is perfect, and the voice actors completely nailed their deliveries. The facial expressions alone are worth a 10/10. Highly recommend if you need a mood booster.",
            "Great concept ruined by awful pacing. They stretched a 12-episode story into 24 episodes, resulting in mind-numbing filler and dragged-out conversations. It completely killed the tension. Such a waste of potential.",
            "They don't make them like this anymore. It captures that classic aesthetic perfectly. No over-reliance on bad CGI, just solid, hand-drawn art and a straightforward, compelling narrative without the modern cringe tropes.",
            "Nobody is talking about the sound design, but it's the best part of the show. The ambient noises, the voice acting, and especially the insert songs during the climax. The composer carried this series on their back. Sound: 10/10.",
            "I've watched the whole thing and I still have no idea what actually happened. It tries way too hard to be deep and philosophical, but ends up just being pretentious and convoluted. The visual symbolism was cool though, I guess.",
            "The main plot is pretty weak, but the supporting cast is so incredibly charming that you don't even care. The interactions and banter between the side characters kept me coming back every week.",
            "It's good, but it's not the 'second coming of anime' like everyone on Twitter was saying. It has noticeable flaws, especially in the middle arc. Still worth a watch, but keep your expectations in check. Enjoyment: 7/10.",
            "This is my absolute comfort show. There's no massive stakes or stressful drama, just a really pleasant atmosphere and lovable characters. I rewatch this whenever I'm feeling down. A pure 10/10 experience.",
            "The chemistry between the leads felt so forced. They go from hating each other to being madly in love over the course of two episodes with zero actual development. Really ruined the immersion for me.",
            "It is so rare to get an anime that actually has a conclusive, satisfying ending nowadays. They tied up all the loose ends, gave the characters proper send-offs, and left me feeling completely fulfilled. An absolute triumph.",
            "The animation studio clearly ran out of budget in the last 3 episodes. It turned into a PowerPoint presentation.",
            "A 10/10 opening song attached to a 3/10 show. I just listened to the OP on YouTube and skipped the rest.",
            "I am dropping this purely because of the mascot character. The high-pitched voice is unbearable.",
            "It started as a generic isekai but actually subverted my expectations. The world-building is surprisingly deep.",
            "The CGI dragon in episode 3 is the worst thing I have ever seen. My eyes are bleeding.",
            "Why does every single female character exist just to fall in love with the bland protagonist? Terrible writing.",
            "The beach episode was entirely unnecessary and ruined the pacing of the main arc.",
            "This show proves you don't need a massive budget if your directing and storyboarding are top-notch.",
            "I read the light novel, and they skipped the entire training arc. The power scaling makes no sense now.",
            "Absolutely carried by the voice acting. The seiyuu gave the performance of a lifetime in episode 8.",
            "A beautifully crafted love letter to the mecha genre. It pays homage to the classics while doing its own thing.",
            "The protagonist is basically just a self-insert with no personality. Very hard to get invested.",
            "This is just edgy for the sake of being edgy. Gore and shock value do not equal a mature storyline.",
            "I've been watching anime for 15 years, and this is the first time I've given a show a perfect 10.",
            "The ending left so many unanswered questions. Read the manga if you want actual closure.",
            "It's basically a commercial for the mobile game, but it's a surprisingly well-animated commercial.",
            "The villain was right. The protagonist is incredibly naive and his ideals make no sense.",
            "Every frame of this anime could be used as a desktop wallpaper. Makoto Shinkai levels of background art.",
            "The tournament arc dragged on way too long. I lost interest halfway through the quarter-finals.",
            "I forced myself to watch 12 episodes because everyone said 'it gets good later.' It never got good.",
            "A masterclass in tension and suspense. I was literally holding my breath during the climax.",
            "The power of friendship strikes again. I'm so tired of this trope resolving every major conflict.",
            "They really adapted 10 chapters into one episode. The pacing gave me whiplash.",
            "I didn't expect a sports anime to make me cry, but here we are. The character arcs are phenomenal.",
            "The OP and ED are unskippable. I watch them every single time.",
            "This show desperately needed a second season. The anime original ending they tacked on was terrible.",
            "The translation and subtitles for this were awful. Half the jokes didn't land because of localization changes.",
            "Pure brain-rot, but in the best way possible. I turn off my brain and just enjoy the chaos.",
            "An absolute stylistic triumph. The use of color theory and abstract imagery is mind-blowing.",
            "It’s mid. Not terrible, not great. Just the most perfectly average 5/10 anime ever created."
        ];

        return [
            'user_id' => User::factory(),
            'anime_id' => Anime::factory(),
            'body' => $reviews[self::$i++ % 50],
        ];
    }
}