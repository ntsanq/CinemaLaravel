<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\FilmCategory;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $categories = FilmCategory::all()->toArray();
        $filmsWithPagination = Film::query()
            ->join('images', 'images.id', 'films.image_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->select([
                'films.*',
                'images.path as path',
                'languages.name as language'
            ])
            ->where('films.deleted_at', null)
            ->paginate(10)
            ->toArray();

        $filmData = [];
        foreach ($filmsWithPagination['data'] as $film) {
            $film['duration'] = $this->durationCalculate($film['id']);
            $filmData[] = $film;
            unset(
                $filmData['created_at'],
                $filmData['updated_at'],
                $filmData['deleted_at'],
            );
        }

        return view('home.index', [
            'categories' => $categories,
            'films' => $filmData
        ]);
    }
}
