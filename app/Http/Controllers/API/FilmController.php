<?php

namespace App\Http\Controllers\API;

use App\Enums\TicketStatus;
use App\Http\Traits\ResponseTrait;
use App\Models\Film;
use App\Models\FilmCategory;
use App\Models\FilmRule;
use App\Models\MediaLink;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmController
{
    use ResponseTrait;

    public function index()
    {
        $films = Film::query()
            ->join('media_links', 'media_links.id', 'films.media_link_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->join('productions', 'productions.id', 'films.production_id')
            ->select([
                'films.*',
                'media_links.image_link as path',
                'media_links.trailer_link as trailer',
                'languages.name as language',
                'productions.name as production',
            ])
            ->get()
            ->toArray();


        $filmsData = [];
        foreach ($films as $film) {
            $rules = json_decode($film['film_rule_id']);
            $film['film_rule_id'] = $rules;
            $categories = json_decode($film['film_category_id']);
            $film['film_category_id'] = $categories;
            $filmsData[] = $film;
        }

        return response()->json($filmsData)->header('X-Total-Count', count($filmsData));
    }

    public function infoForAdmin($id)
    {
        $filmDetails = $this->queryFilmInfo($id);
        $filmDetails['film_category_id'] = json_decode($filmDetails['film_category_id']);
        $filmDetails['film_rule_id'] = json_decode($filmDetails['film_rule_id']);

        return response()->json($filmDetails)->header('X-Total-Count', count($filmDetails));
    }

    public function updateForAdmin($id, Request $request)
    {
        $film = Film::findOrFail($id);
        $film->film_category_id = json_encode($request->film_category_id);
        $film->film_rule_id = json_encode($request->film_rule_id);
        $film->name = $request->name;
        $film->description = $request->description;

        if ($request->path) {
            $mediaLinkIns = MediaLink::findOrFail($film->media_link_id);
            $mediaLinkIns->image_link = $request->path;
            $mediaLinkIns->save();
        }

        $film->save();

        return response()->json($film);

    }

    public function info($id)
    {
        $filmDetails = $this->queryFilmInfo($id);

        $rules = json_decode($filmDetails['film_rule_id']);

        $categories = json_decode($filmDetails['film_category_id']);

        $ruleData = [];
        foreach ($rules as $rule) {
            $ruleName = FilmRule::findOrFail($rule);
            $ruleData[] = $ruleName->name;
        }
        $filmDetails['rules'] = $ruleData;

        $filmCategories = [];
        foreach ($categories as $category) {
            $categoryName = FilmCategory::findOrFail($category);
            $filmCategories[] = $categoryName->name;
        }
        $filmDetails['categories'] = $filmCategories;

        unset($filmDetails['film_rule_id'], $filmDetails['language_id'], $filmDetails['language_id'],
            $filmDetails['image_id'], $filmDetails['film_category_id'], $filmDetails['production_id']);

        return $this->success($filmDetails);
    }

    public function getWeekly()
    {
        $mostFilmBought = Ticket::query()
            ->join('schedules', 'schedules.id', '=', 'tickets.schedule_id')
            ->select('schedules.film_id', DB::raw('count(*) as total'))
            ->where('tickets.status', TicketStatus::Paid)
            ->whereBetween('tickets.updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('schedules.film_id')
            ->orderBy('total', 'desc')
            ->first();

        $film = $this->queryFilmInfo($mostFilmBought->film_id);
        $film['total'] = $mostFilmBought->total;

        return $this->success($film);
    }

    private function queryFilmInfo($id = '')
    {
        return Film::query()
            ->where('films.id', $id)
            ->join('media_links', 'media_links.id', 'films.media_link_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->join('productions', 'productions.id', 'films.production_id')
            ->select([
                'films.*',
                'media_links.image_link as path',
                'languages.name as language',
                'productions.name as production',
            ])
            ->get()
            ->first()
            ->toArray();
    }
}
