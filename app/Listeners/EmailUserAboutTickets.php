<?php

namespace App\Listeners;

use App\Events\SuccessTicketBooked;
use App\Mail\SuccessTicketMessage;
use App\Models\Ticket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class EmailUserAboutTickets implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(SuccessTicketBooked $event)
    {
        $ticketIds = Ticket::query()->where('session_id', $event->sessionId)->get('id')->toArray();
        $ticketData = [];
        foreach ($ticketIds as $ticketId) {
            $ticket = Ticket::query()
                ->join('schedules', 'schedules.id', 'tickets.schedule_id')
                ->join('films', 'films.id', 'schedules.film_id')
                ->join('seats', 'seats.id', 'tickets.seat_id')
                ->join('seat_categories', 'seat_categories.id', 'seats.seat_category_id')
                ->join('users', 'users.id', 'tickets.user_id')
                ->select([
                    'tickets.*',
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


        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $checkout_session = Session::retrieve($ticketData[0]['session_id']);

        foreach ($ticketData as &$ticketItem) {
            $ticketItem['start_time'] = date("H:i", strtotime($ticketItem['start_time']));
        }


        Mail::to($event->email)->send(new SuccessTicketMessage($ticketData, $checkout_session->amount_total));
    }
}
