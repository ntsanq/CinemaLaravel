<?php

namespace App\Http\Controllers\API;


use App\Http\Traits\ResponseTrait;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController
{
    use ResponseTrait;
    public function getTickets(Request $request)
    {
        $sessionId = $request->sessionId;
        $ticketIds = Ticket::query()->where('session_id', $sessionId)->get('id')->toArray();

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
        }

        return $this->success($ticketData);
    }
}
