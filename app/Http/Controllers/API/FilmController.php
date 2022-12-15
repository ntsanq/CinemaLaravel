<?php

namespace App\Http\Controllers\API;

use App\Models\Film;

class FilmController
{
    public function getById(string $id)
    {
        $film   = Film::query()
            ->where('films.id', $id)
            ->join('images', 'images.id', 'films.image_id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $film
        ]);
    }
}
