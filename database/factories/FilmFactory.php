<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $filmCategoryIds = DB::table('film_categories')->select('id')->get();
        $imageIds = DB::table('images')->select('id')->get();

        return [
            'film_category_id' => fake()->randomElement($filmCategoryIds)->id,
            'image_id' => fake()->unique()->randomElement($imageIds)->id,
            'name' => fake()->name(),
        ];
    }
}
