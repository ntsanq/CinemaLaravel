<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessTicketMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketsData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticketsData)
    {
        $this->ticketsData = $ticketsData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.success-message', [
            'ticketsData' => $this->ticketsData
        ]);
    }
}
