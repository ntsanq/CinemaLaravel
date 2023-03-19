<?php

namespace Database\Factories;

use Faker\Provider\Youtube;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaLink>
 */
class MediaLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new Youtube($faker));

        return [
            'image_link' => fake()->imageUrl('300','450'),
//            'trailer_link' => $faker->youtubeEmbedUri(),
            'trailer_link' => "https://www.youtube.com/embed/2QKg5SZ_35I",
        ];
    }
}
