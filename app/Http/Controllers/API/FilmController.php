<?php

namespace App\Http\Controllers\API;

use App\Http\Traits\ResponseTrait;
use App\Models\Film;
use App\Models\FilmCategory;
use App\Models\FilmRule;

class FilmController
{
    use ResponseTrait;

    public function info($id)
    {
        $filmDetails = Film::query()
            ->where('films.id', $id)
            ->join('images', 'images.id', 'films.image_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->join('productions', 'productions.id', 'films.production_id')
            ->select([
                'films.*',
                'images.path',
                'languages.name as language',
                'productions.name as production',
            ])
            ->get()
            ->first()
            ->toArray();

        $rules = json_decode($filmDetails['film_rule_id']);

        $categories = json_decode($filmDetails['film_category_id']);

        $ruleData = [];
        foreach ($rules as $rule) {
            $ruleName = FilmRule::findOrFail($rule);
            $ruleData[] = $ruleName->name;
        }
        $filmDetails['rules'] = $ruleData;

        $filmCategories = [];
        foreach ($categories as $category) {
            $categoryName = FilmCategory::findOrFail($category);
            $filmCategories[] = $categoryName->name;
        }
        $filmDetails['categories'] = $filmCategories;

        unset($filmDetails['film_rule_id'], $filmDetails['language_id'], $filmDetails['language_id'],
            $filmDetails['image_id'], $filmDetails['film_category_id'], $filmDetails['production_id']);

        return $this->success($filmDetails);

    }

}
