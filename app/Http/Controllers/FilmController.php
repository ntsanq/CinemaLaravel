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

        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $filmDetails = Film::query()
            ->where('films.id', $id)
            ->where('films.deleted_at', null)
            ->join('images', 'images.id', 'films.image_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->select([
                'films.*',
                'images.path',
                'languages.name as language'
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

        return view('film.index', [
            'user' => $user,
            'filmDetails' => $filmDetails,
            'search' => $search
        ]);
    }
}
