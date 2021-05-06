<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sessionCompleted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $session;
    public $user;
    public $student;
    public function __construct($session, $user, $student)
    {
        $this->session = $session;
        $this->student = $student;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Session Completed')->from('noreply@tutors-hub.com')->view('mail.sessionCompleted');
    }
}
