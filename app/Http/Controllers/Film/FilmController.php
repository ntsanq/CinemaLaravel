<?php

namespace App\Http\Controllers\Film;

use App\Http\Controllers\Controller;
use App\Models\Film;

class FilmController extends Controller
{
    public function index($id)
    {
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        $filmDetails = Film::query()
            ->where('films.id', $id)
            ->where('films.deleted_at', null)
            ->join('images','images.id', 'films.image_id')
            ->join('languages','languages.id', 'films.language_id')
            ->join('film_categories','film_categories.id', 'films.film_category_id')
            ->join('film_rules','film_rules.id', 'films.film_rule_id')
            ->select([
               'films.*',
                'images.path',
                'languages.name as language',
                'film_categories.name as category',
                'film_rules.name as rule'
            ])
            ->get()
            ->first()
            ->toArray();

        return view('film.index',[
            'filmDetails' => $filmDetails,
            'search' => $search
        ]);
    }
}
