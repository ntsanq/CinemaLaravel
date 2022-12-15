<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function date(Request $request)
    {
        $film = Film::where('films.id', $request->filmId)
            ->join('images','images.id', 'films.image_id')
            ->select([
                'films.*',
                'images.path',
            ])
            ->get()->first();

        return view('ticket.master', [
            'film' => $film
        ]);
    }

    public function dateList(Request $request)
    {

    }

    public function seat()
    {
        return view('ticket.seatPick');
    }

}
