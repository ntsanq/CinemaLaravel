<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Events\SuccessTicketBooked;
use App\Models\Film;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TicketController extends Controller
{
    public function select(Request $request)
    {
        $film = Film::where('films.id', $request->filmId)
            ->join('media_links', 'media_links.id', 'films.media_link_id')
            ->select([
                'films.*',
                'media_links.image_link as path',
            ])
            ->get()->first();

        $user = $this->getUserInfo();

        return view('ticket.booking', [
            'film' => $film,
            'user' => $user
        ]);
    }

    public function success(Request $request)
    {
        $sessionId = $request->input('sessionId');
        $tickets = Ticket::query()->where('session_id', $sessionId)->get()->toArray();

        if (empty($tickets)) {
            throw new NotFoundHttpException;
        }

        $this->ticketsPaid($sessionId);

        $user = $this->getUserInfo();

        event(new SuccessTicketBooked($user['email'], $sessionId));

        return view('checkout.success', [
            'user' => $user,
            'tickets' => $tickets
        ]);
    }

    public function cancel()
    {
        $user = $this->getUserInfo();
        return view('checkout.failed', [
            'user' => $user
        ]);
    }

    public function repay(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $checkout_session = Session::retrieve($request->sessionId);
        if ($checkout_session->url === null) {
            throw new  NotFoundHttpException;
        };

        return redirect($checkout_session->url);
    }

    private function ticketsPaid($sessionId)
    {
        return Ticket::query()->where('session_id', $sessionId)
            ->update(['status' => TicketStatus::Paid]);
    }
}
