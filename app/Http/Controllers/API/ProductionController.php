<?php

namespace App\Http\Controllers\API;

use App\Models\Production;
use Illuminate\Http\Request;

class ProductionController
{
    public function index(Request $request)
    {
        $search = !empty($request->search) ? $request->search : '';
        $start = $request->input('_start', 0);
        $end = $request->input('_end', 10);

        $productions = Production::query()
            ->where('name','like', '%' . $search . '%')
            ->get();

        $data = $productions->skip($start)->take($end - $start);
        $data = array_values($data->toArray());

        return response()->json($data)->header('X-Total-Count', count($productions));
    }

    public function infoForAdmin($id)
    {
        $production = Production::findOrFail($id);

        return response()->json($production);
    }



    public function updateForAdmin($id, Request $request)
    {
        $production = Production::findOrFail($id);
        $production->name = $request->name;
        $production->save();

        return response()->json($production);
    }

    public function createForAdmin( Request $request)
    {
        $production = new Production();
        $production->name = $request->name;
        $production->save();

        return response()->json($production);
    }

    public function deleteForAdmin($id)
    {
        $production = Production::findOrFail($id);
        $production->delete();

        return response()->json(['success']);
    }
}
