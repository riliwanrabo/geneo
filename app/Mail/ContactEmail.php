<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $message;
    private $email;


    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param $message
     */
    public function __construct(string $name, string $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $msg = $this->message;
        $email = $this->email;
        return $this
            ->subject("Geneo Test Application")
            ->view('emails.contact', compact('name', 'email', 'msg'));
    }
}
