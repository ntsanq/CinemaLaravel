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
     * @return array|mixed[]
     */
    public function definition()
    {
        $filmCategoryIds = DB::table('film_categories')->select('id')->get();
        $imageIds = DB::table('images')->select('id')->get();
        $filmRuleIds = DB::table('film_rules')->select('id')->get();
        $languageIds = DB::table('languages')->select('id')->get();

        return [
            'film_category_id' => fake()->randomElement($filmCategoryIds)->id,
            'image_id' => fake()->unique()->randomElement($imageIds)->id,
            'name' => fake()->name(),
            'description' => fake()->paragraph(2),
            'language_id' => fake()->randomElement($languageIds)->id,
            'film_rule_id' => fake()->randomElement($filmRuleIds)->id,
        ];
    }
}
