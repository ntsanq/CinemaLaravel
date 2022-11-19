<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\FilmCategory;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = null;
        $token = PersonalAccessToken::findToken(session()->get('token'));
        if (!empty($token)) {
            $user = $token->tokenable->toArray();
        }

        if (!empty($request->category)) {
            $categoryName = $request->category;
        } else {
            $categoryName = '';
        }

        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }
        $categories = FilmCategory::all()->toArray();
        $filmsWithPagination = Film::query()
            ->join('images', 'images.id', 'films.image_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->join('film_categories', 'film_categories.id', 'films.film_category_id')
            ->select([
                'films.*',
                'images.path as path',
                'languages.name as language',
            ])
            ->where('films.deleted_at', null)
            ->where('film_categories.name', 'like', '%' . $categoryName . '%')
            ->where('films.name', 'like', '%' . $search . '%')
            ->orderBy('name', 'ASC')
            ->paginate(8)
            ->appends($request->query())
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

        $filmsWithPagination['data'] = $filmData;
        $filmsWithPagination['categories'] = $categories;

        return view('home.index', [
            'user' => $user,
            'data' => $filmsWithPagination,
            'search' => $search
        ]);
    }
}
