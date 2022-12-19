<?php

namespace App\Http\Controllers\API;

use App\Http\Traits\ResponseTrait;
use App\Models\Film;

class FilmController
{
    use ResponseTrait;

    public function getById(string $id)
    {
        $film = Film::query()
            ->where('films.id', $id)
            ->join('images', 'images.id', 'films.image_id')
            ->get();

        return $this->success($film);
    }
}
