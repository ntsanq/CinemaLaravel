<?php

namespace Database\Seeders;

use App\Enums\MediaLinks;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filmCategoryIds = DB::table('film_categories')->pluck('id')->toArray();
        do {
            $uniqueFilmCategoryIds = fake()->randomElements($filmCategoryIds, 2);
        } while (count(array_unique($uniqueFilmCategoryIds)) < 2);

        $filmRuleIds = DB::table('film_rules')->pluck('id')->toArray();
        do {
            $uniqueFilmRuleIds = fake()->randomElements($filmRuleIds, 2);
        } while (count(array_unique($uniqueFilmRuleIds)) < 1);

        $productionIds = DB::table('productions')->select('id')->get();
        $languageIds = DB::table('languages')->select('id')->get();

        $filmCategories = MediaLinks::Categories;
        $filmNames = MediaLinks::Name;

        for ($i = 0; $i < 25; $i++) {
            Film::create([
                'film_category_id' => "[" . $filmCategories[$i] . "]",
                'media_link_id' => $i + 1,
                'name' => $filmNames[$i],
                'description' => fake()->sentences(20, true),
                'language_id' => fake()->randomElement($languageIds)->id,
                'film_rule_id' => "[" . $filmCategories[$i] . "]",    //cheat
                'production_id' => fake()->randomElement($productionIds)->id
            ]);
        }
    }
}
