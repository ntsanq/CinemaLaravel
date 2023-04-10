<?php

namespace App\Http\Controllers\API;

use App\Models\Language;

class LanguageController
{
    public function index()
    {
        $languages = Language::query()
            ->get()->toArray();

        return response()->json($languages)->header('X-Total-Count', count($languages));
    }

    public function infoForAdmin($id)
    {
        $language = Language::findOrFail($id);

        return response()->json($language);
    }

}
