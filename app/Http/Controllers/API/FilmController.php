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

    public function index(Request $request)
    {

        $firstThreeWords = substr($request->server('QUERY_STRING'), 0, 3);
        if ($firstThreeWords === "id=") {
            $queryParams = explode('&', $request->server('QUERY_STRING'));
            $ids = array_map(function ($param) {
                return intval(urldecode(explode('id=', $param)[1]));
            }, $queryParams);

            $filmDetails = [];
            foreach ($ids as $id) {
                $filmDetails[] = $this->queryFilmInfo($id);
            }

            return response()->json($filmDetails);
        }

        $search = !empty($request->search) ? $request->search : '';
        $productionId = !empty($request->production_id) ? $request->production_id : '';
        $languageId = !empty($request->language_id) ? $request->language_id : '';
        $filmCategoryId = !empty($request->film_category_id) ? $request->film_category_id : '';
        $filmRuleId = !empty($request->film_rule_id) ? $request->film_rule_id : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $sort = $request->input('_sort', '');
        $order = $request->input('_order', '');

        $filmsQuery = Film::query()
            ->join('media_links', 'media_links.id', 'films.media_link_id')
            ->join('languages', 'languages.id', 'films.language_id')
            ->join('productions', 'productions.id', 'films.production_id')
            ->select([
                'films.*',
                'media_links.image_link as path',
                'media_links.trailer_link as trailer',
                'productions.id as production_id',
                'languages.id as language_id',
                'languages.name as language',
                'productions.name as production',
            ])
            ->where('films.name', 'like', '%' . $search . '%')
            ->where('productions.id', 'like', '%' . $productionId . '%')
            ->where('languages.id', 'like', '%' . $languageId . '%')
            ->where('films.film_category_id', 'like', '%' . $filmCategoryId . '%')
            ->where('films.film_rule_id', 'like', '%' . $filmRuleId . '%');
        // Avoid $sort is not 'path'
        if ($sort !== 'path') {
            $filmsQuery->orderBy('films.' . $sort, $order);
        }

        $films = $filmsQuery->get()->toArray();

        $films = array_map(function ($film) {
            $rules = json_decode($film['film_rule_id']);
            $film['film_rule_id'] = $rules;
            $categories = json_decode($film['film_category_id']);
            $film['film_category_id'] = $categories;
            return $film;
        }, $films);

        $total = count($films);
        $query = collect($films)->skip($start)->take($end - $start);
        $data = array_values($query->toArray());

        return response()->json($data)->header('X-Total-Count', $total);
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
        $film->language_id = $request->language_id;
        $film->production_id = $request->production_id;
        $film->duration = $request->duration;

        if ($request->path) {
            $mediaLinkIns = MediaLink::findOrFail($film->media_link_id);
            $mediaLinkIns->image_link = $request->path;
            $mediaLinkIns->save();
        }
        if ($request->trailer) {
            $mediaLinkIns = MediaLink::findOrFail($film->media_link_id);
            $mediaLinkIns->trailer_link = $this->convertYoutubeLinkToEmbed($request->trailer);
            $mediaLinkIns->save();
        }

        $film->save();

        return response()->json($film);
    }

    public function createForAdmin(Request $request)
    {
        $media = new MediaLink();
        $media->image_link = $request->path;
        $media->trailer_link = $this->convertYoutubeLinkToEmbed($request->trailer);
        $media->save();

        $film = new Film();
        $film->media_link_id = $media->id;
        $film->name = $request->name;
        $film->film_category_id = json_encode($request->film_category_id);
        $film->film_rule_id = json_encode($request->film_rule_id);
        $film->production_id = $request->production_id;
        $film->language_id = $request->language_id;
        $film->description = $request->description;
        $film->duration = $request->duration;
        $film->save();

        return response()->json($film);
    }

    public function deleteForAdmin($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return response()->json(['message'=>'success']);
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
                'media_links.trailer_link as trailer',
                'languages.name as language',
                'productions.name as production',
            ])
            ->get()
            ->first()
            ->toArray();
    }

    private function convertYoutubeLinkToEmbed($link)
    {
        $trailerUrl = $link;
        $start_index = strpos($trailerUrl, "v=") + 2;
        $end_index = strpos($trailerUrl, "&", $start_index);
        $video_id = substr($trailerUrl, $start_index, $end_index - $start_index);
        return "https://www.youtube.com/embed/" . $video_id;
    }
}
