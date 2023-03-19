<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmCategory;
use App\Models\FilmRule;

class FilmController extends Controller
{
    public function index($id)
    {
        $user = $this->getUserInfo();

        $filmDetails = Film::query()
            ->where('films.id', $id)
            ->where('films.deleted_at', null)
            ->join('media_links', 'media_links.id', 'films.image_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->join('productions', 'productions.id', 'films.production_id')
            ->select([
                'films.*',
                'media_links.image_link as path',
                'media_links.trailer_link as trailer_link',
                'languages.name as language',
                'productions.name as production'
            ])
            ->first()
            ->toArray();

        $categories = json_decode($filmDetails['film_category_id']);
        $categoriesData = [];
        foreach ($categories as $category) {
            $categoryName = FilmCategory::findOrFail($category)->name;
            $categoriesData[] = $categoryName;
        }

        $rulesData = [];
        $rules = json_decode($filmDetails['film_rule_id']);
        foreach ($rules as $rule) {
            $ruleName = FilmRule::findOrFail($rule)->name;
            $rulesData[] = $ruleName;
        }

        $filmDetails['categories'] = $categoriesData;
        $filmDetails['rules'] = $rulesData;

        $filmDetails['duration'] = $this->durationCalculate($filmDetails['id']);

        return view('film.index', [
            'user' => $user,
            'filmDetails' => $filmDetails
        ]);
    }
}
