<?php

namespace App\Http\Controllers\API;

use App\Models\FilmRule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FilmRuleController
{
    public function index(Request $request)
    {
        $search = !empty($request->search) ? $request->search : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);


        $rules = FilmRule::query()
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        $data = $rules->skip($start)->take($end - $start);
        $data = array_values($data->toArray());

        return response()->json($data)->header('X-Total-Count', count($rules));
    }

    public function infoForAdmin($id)
    {
        $filmRule = FilmRule::findOrFail($id);

        return response()->json($filmRule);
    }

    public function updateForAdmin($id, Request $request)
    {
        $filmRule = FilmRule::findOrFail($id);
        $filmRule->name = $request->name;
        $filmRule->save();

        return response()->json($filmRule);
    }

    public function createForAdmin(Request $request)
    {
        $filmRule = new FilmRule();
        $filmRule->name = $request->name;
        $filmRule->save();

        return response()->json($filmRule);
    }

    public function deleteForAdmin($id)
    {
        $filmRule = FilmRule::findOrFail($id);
        $filmRule->delete();

        return response()->json('success');
    }
}
