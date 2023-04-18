<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessTicketMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $sessionId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.success-message', [
            'sessionId' => $this->sessionId
        ]);
    }
}
