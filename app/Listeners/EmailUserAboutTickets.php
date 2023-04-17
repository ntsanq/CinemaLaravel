<?php

namespace App\Listeners;

use App\Events\SuccessTicketBooked;
use App\Mail\SuccessTicketMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserAboutTickets
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
     * @param  object  $event
     * @return void
     */
    public function handle(SuccessTicketBooked $event)
    {
        Mail::to($event->email)->send(new SuccessTicketMessage($event->sessionId));
    }
}
