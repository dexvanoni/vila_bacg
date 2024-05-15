<?php
// app/Mail/UserNotification.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $message;


    public function __construct($message)
    {
        // Verifique se $message é uma string
        if (!is_string($message)) {
            throw new \InvalidArgumentException('Message must be a string');
        }
        $this->message = $message;
    }

    public function build()
    {

        return $this->view('emails.notifications')
                    ->with(['menssagem' => $this->message]);
    }
}