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
    public $totalAmount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticketsData, $totalAmount)
    {
        $this->ticketsData = $ticketsData;
        $this->totalAmount = $totalAmount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Successfully booking - SAN Cinema')->markdown('mail.success-message', [
            'ticketsData' => $this->ticketsData,
            'totalAmount' => $this->totalAmount
        ]);
    }
}
