<?php

namespace App\Http\Controllers\API;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController
{
    public function index(Request $request)
    {
        $search = !empty($request->search) ? $request->search : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $languages = Language::query()
            ->where('name', 'like', '%' . $search . '%')
            ->get();


        $data = $languages->skip($start)->take($end - $start);
        $data = array_values($data->toArray());

        return response()->json($data)->header('X-Total-Count', count($languages));
    }

    public function infoForAdmin($id)
    {
        $language = Language::findOrFail($id);

        return response()->json($language);
    }

    public function updateForAdmin($id, Request $request)
    {
        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->save();

        return response()->json($language);
    }

    public function createForAdmin(Request $request)
    {
        $language = new Language();
        $language->name = $request->name;
        $language->save();

        return response()->json($language);
    }

    public function deleteForAdmin($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();

        return response()->json('success');
    }
}
