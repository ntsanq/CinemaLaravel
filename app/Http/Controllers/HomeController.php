<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmCategory;
use App\Models\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $this->getUserInfo();

        $interested = [];
        if (!empty($user)) {
            $interested = $this->getInterested($user['id']);
        }
        $filmsData = $this->getFilmsData($request);

        return view('home.index', [
            'user' => $user,
            'data' => $filmsData,
            'interested' => $interested
        ]);
    }

    private function getFilmsData($request)
    {
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

        return $filmsWithPagination;
    }

    private function getInterested($userId)
    {
        $userTickets = Ticket::query()
            ->join('schedules', 'schedules.id', 'tickets.schedule_id')
            ->join('films', 'films.id', 'schedules.film_id')
            ->select([
                'tickets.*',
                'schedules.*',
                'films.*',
            ])
            ->where('user_id', $userId)
            ->get()->toArray();

        $list = [];
        foreach ($userTickets as $ticket) {
            $categories = json_decode($ticket['film_category_id']);
            $categoryList = [];
            foreach ($categories as $categoryId) {
                $categoryIns = FilmCategory::findOrFail($categoryId);
                $categoryList[] = $categoryIns->id;
            }
            $list = array_merge($list, $categoryList);
        }

        //get 2 most frequent
        $counted = array_count_values($list);
        arsort($counted);
        $twoMostFrequent = array_slice(array_keys($counted), 0, 2);

        return $this->getRecommendedFilms($twoMostFrequent);
    }

    private function getRecommendedFilms($twoMostFrequent)
    {
        $filmsData = [];
        foreach ($twoMostFrequent as $item) {
            $film = Film::query()
                ->join('media_links', 'media_links.id', 'films.media_link_id')
                ->join('languages', 'languages.id', 'films.language_id')
                ->select([
                    'films.*',
                    'media_links.image_link as path',
                    'languages.name as language',
                ])
                ->whereRaw("JSON_CONTAINS(film_category_id, CAST('$item' AS JSON))")
                ->take(2)->get()->toArray();
            $filmsData = array_merge($filmsData, $film);
        }

        $finalFilmData = [];
        foreach ($filmsData as $film) {
            $film['duration'] = $this->durationCalculate($film['id']);
            $finalFilmData[] = $film;
        }

        return $finalFilmData;
    }
}
