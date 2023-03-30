<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;
    public $body;
    public $subject;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $body, $url)
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->url = $url;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.common')
            ->subject($this->subject)
            ->with('body', $this->body)
            ->with('url', $this->url);
    }
}
