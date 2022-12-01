<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function date()
    {
        return view('ticket.datePick');
    }
}
