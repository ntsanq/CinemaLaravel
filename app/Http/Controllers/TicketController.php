<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Models\Film;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function showReceipt(Request $request)
    {
        $jsonString = json_decode($request->input('tickets'));

        dd($jsonString);
    }


    public function success(Request $request)
    {
        $sessionId = $request->input('sessionId');

        $tickets = Ticket::query()->where('session_id', $sessionId)->get()->toArray();

        if (empty($tickets)){
            throw new NotFoundHttpException;
        }

        $this->ticketsPaid($sessionId);


        return view('checkout.success', [
            'tickets' => $tickets
        ]);
    }

    public function cancel()
    {
        return view('checkout.failed', [
        ]);
    }

    private function ticketsPaid($sessionId)
    {
        return Ticket::query()->where('session_id', $sessionId)
            ->update(['status' => TicketStatus::Paid]);
    }
}
