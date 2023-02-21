<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function select(Request $request)
    {
        $film = Film::where('films.id', $request->filmId)
            ->join('images', 'images.id', 'films.image_id')
            ->select([
                'films.*',
                'images.path',
            ])
            ->get()->first();

        $user = $this->getUserInfo();

        return view('ticket.booking', [
            'film' => $film,
            'user' => $user
        ]);
    }
}
