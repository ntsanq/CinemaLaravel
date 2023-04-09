<?php

namespace App\Http\Controllers\API;

use App\Models\FilmCategory;

class FilmCategoryController
{
    public function index()
    {
        $filmCategories = FilmCategory::query()
            ->get()
            ->toArray();

        return response()->json($filmCategories)->header('X-Total-Count', count($filmCategories));
    }
}
