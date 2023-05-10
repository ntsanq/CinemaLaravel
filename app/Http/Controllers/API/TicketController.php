<?php

namespace App\Http\Controllers\API;


use App\Enums\TicketStatus;
use App\Http\Traits\ResponseTrait;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class TicketController
{
    use ResponseTrait;

    public function printed(Request $request)
    {
        $sessionId = $request->sessionId;
        $ticketIds = Ticket::query()->where('session_id', $sessionId)->get('id')->toArray();

        if ($ticketIds === []) {
            return response()->json([
                'status' => false,
                'message' => 'failed'
            ], 400);
        }
        foreach ($ticketIds as $ticketId) {
            Ticket::query()
                ->where('tickets.id', $ticketId)
                ->update([
                    'status' => TicketStatus::Printed
                ]) ;
        }

        return $this->successMessage('success');
    }
    public function getTickets(Request $request)
    {
        $sessionId = $request->sessionId;
        $ticketIds = Ticket::query()->where('session_id', $sessionId)->get('id')->toArray();

        if ($ticketIds === []) {
            return response()->json([
                'status' => false,
                'message' => 'failed'
            ], 400);
        }
        $ticketData = [];
        foreach ($ticketIds as $ticketId) {
            $ticket = Ticket::query()
                ->join('schedules', 'schedules.id', 'tickets.schedule_id')
                ->join('films', 'films.id', 'schedules.film_id')
                ->join('seats', 'seats.id', 'tickets.seat_id')
                ->join('seat_categories', 'seat_categories.id', 'seats.seat_category_id')
                ->join('users', 'users.id', 'tickets.user_id')
                ->select([
                    'tickets.id',
                    'tickets.id',
                    'schedules.start as start_time',
                    'schedules.end as end_time',
                    'films.name as film_name',
                    'seats.name as seat_name',
                    'users.name as user_name',
                    'seat_categories.name as seat_type',
                ])
                ->where('tickets.id', $ticketId)->first()->toArray();

            $ticketData[] = $ticket;
        }

        foreach ($ticketData as &$ticketItem) {
            $ticketItem['start_time'] = date("H:i", strtotime($ticketItem['start_time']));
            $ticketItem['start_date'] = date("d-m-Y", strtotime($ticketItem['start_time']));
            $ticketItem['start_datetime'] = date("d-m-Y H:iA", strtotime($ticketItem['start_time']));
            unset($ticketItem['end_time']);
        }

        return $this->success($ticketData);
    }

    public function getTotalBySessionId(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $checkout_session = Session::retrieve($request->sessionId);


        return $this->success(
            $checkout_session->toArray()
        );
    }
}
