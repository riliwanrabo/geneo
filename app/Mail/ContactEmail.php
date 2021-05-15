<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $message
     */
    public function __construct(private string $name, private string $email, private string $message)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $message = $this->message;
        $email = $this->email;
        return $this->view('emails.contact', compact('name', 'email', 'message'));
    }
}
