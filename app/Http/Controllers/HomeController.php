<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $this->getUserInfo();

        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }
        $categories = FilmCategory::all()->toArray();

        $filmsWithPagination = Film::query()
            ->join('media_links', 'media_links.id', 'films.media_link_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->select([
                'films.*',
                'media_links.image_link as path',
                'languages.name as language',
            ])
            ->where('films.deleted_at', null)
            ->where('films.name', 'like', '%' . $search . '%');

        if (!empty($request->category)) {
            $categoryId = FilmCategory::query()->where('name', $request->category)->first()->id;
            $filmsWithPagination->whereRaw("JSON_CONTAINS(film_category_id, CAST('$categoryId' AS JSON))");
        }
        $filmsWithPagination = $filmsWithPagination->orderBy('name', 'ASC')
            ->paginate(8)
            ->appends($request->query())
            ->toArray();

        $filmData = [];
        foreach ($filmsWithPagination['data'] as $film) {
            $film['duration'] = $this->durationCalculate($film['id']);
            $filmData[] = $film;
        }

        $filmsWithPagination['data'] = $filmData;
        $filmsWithPagination['categories'] = $categories;

        return view('home.index', [
            'user' => $user,
            'data' => $filmsWithPagination
        ]);
    }
}
