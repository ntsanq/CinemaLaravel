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
        $filmCategoryIds = DB::table('film_categories')->pluck('id')->toArray();
        do {
            $uniqueFilmCategoryIds = fake()->randomElements($filmCategoryIds, 2);
        } while (count(array_unique($uniqueFilmCategoryIds)) < 2);

        $filmRuleIds = DB::table('film_rules')->pluck('id')->toArray();
        do {
            $uniqueFilmRuleIds = fake()->randomElements($filmRuleIds, 2);
        } while (count(array_unique($uniqueFilmRuleIds)) < 2);

        $imageIds = DB::table('images')->select('id')->get();
        $productionIds = DB::table('productions')->select('id')->get();
        $languageIds = DB::table('languages')->select('id')->get();

        return [
            'film_category_id' => json_encode($uniqueFilmCategoryIds),
            'image_id' => fake()->unique()->randomElement($imageIds)->id,
            'name' => fake()->sentence(2),
            'description' => fake()->sentences(20, true),
            'language_id' => fake()->randomElement($languageIds)->id,
            'film_rule_id' => json_encode($uniqueFilmRuleIds),
            'production_id' => fake()->randomElement($productionIds)->id,
        ];
    }
}
