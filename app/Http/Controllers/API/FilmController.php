<?php

namespace App\Http\Controllers\API;

use App\Http\Traits\ResponseTrait;
use App\Models\Film;

class FilmController
{
    use ResponseTrait;

    public function info($id)
    {
        $filmDetails = Film::query()
            ->where('films.id', $id)
            ->join('images', 'images.id', 'films.image_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->join('film_categories', 'film_categories.id', 'films.film_category_id')
            ->join('film_rules', 'film_rules.id', 'films.film_rule_id')
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

        return $this->success($filmDetails);

    }

}
