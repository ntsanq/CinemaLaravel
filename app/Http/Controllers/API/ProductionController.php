<?php

namespace App\Http\Controllers\API;

use App\Models\Production;

class ProductionController
{
    public function index()
    {
        $productions = Production::query()
            ->get()->toArray();

        return response()->json($productions)->header('X-Total-Count', count($productions));
    }

    public function infoForAdmin($id)
    {
        $production = Production::findOrFail($id);

        return response()->json($production);
    }
}
