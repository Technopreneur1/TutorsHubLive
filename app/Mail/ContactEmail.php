<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public $type;
    public $email;
    public $qry;
    public $ticket;


    public function __construct($user = null, $type, $email, $qry, $ticket)
    {
        $this->user = $user;
        $this->type = $type;
        $this->email = $email;
        $this->qry = $qry;
        $this->ticket = $ticket;
        // dd($qry);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tutors-Hub Support')->view('mail.contact');
    }
}
