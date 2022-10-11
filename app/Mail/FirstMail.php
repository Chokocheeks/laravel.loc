<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $mailMessage;
    public $tries = 3;


    public function __construct($mailMessage)
    {
        $this->mailMessage = $mailMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('choko@mail.ru', 'Choko Prodaction')
        ->to('pigasi4ek@mail.ru')
        ->cc(['vip1@mail.ru', 'vip2@mail.ru'])
        ->view('emails.first')
        ->with([
            'message2' => 'alohha cruel',
            'mailMessage' => $this->mailMessage
        ]);
    }
}
