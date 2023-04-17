<?php

namespace App\Http\Controllers\API;

use App\Models\FilmRule;
use Illuminate\Validation\Rule;

class FilmRuleController
{
    public function index()
    {
        $rules = FilmRule::query()
            ->get()->toArray();

        return response()->json($rules)->header('X-Total-Count', count($rules));
    }
}
