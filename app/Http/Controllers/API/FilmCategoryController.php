<?php

namespace App\Http\Controllers\API;

use App\Models\FilmCategory;
use Illuminate\Http\Request;

class FilmCategoryController
{
    public function index(Request $request)
    {
        $search = !empty($request->search) ? $request->search : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $filmCategories = FilmCategory::query()
            ->where('name', 'like', '%' . $search . '%')
            ->get();

        $data = $filmCategories->skip($start)->take($end - $start);
        $data = array_values($data->toArray());

        return response()->json($data)->header('X-Total-Count', count($filmCategories));
    }

    public function infoForAdmin($id)
    {
        $filmCategory = FilmCategory::findOrFail($id);

        return response()->json($filmCategory);
    }

    public function updateForAdmin($id, Request $request)
    {
        $filmCategory = FilmCategory::findOrFail($id);
        $filmCategory->name = $request->name;
        $filmCategory->save();

        return response()->json($filmCategory);
    }

    public function createForAdmin(Request $request)
    {
        $filmCategory = new FilmCategory();
        $filmCategory->name = $request->name;
        $filmCategory->save();

        return response()->json($filmCategory);
    }

    public function deleteForAdmin($id)
    {
        $filmCategory = FilmCategory::findOrFail($id);
        $filmCategory->delete();

        return response()->json('success');
    }
}
