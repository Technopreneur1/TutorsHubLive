<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sessionAccepted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $session;
    public $user;
    public $teacher;
    public $forTutor;
    public $forStudent;

    public function __construct($session, $user, $teacher, $forTutor, $forStudent)
    {
        $this->session = $session;
        $this->user = $user;
        $this->teacher = $teacher;
        $this->forTutor = $forTutor;
        $this->forStudent = $forStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Session Accepted')->from('noreply@tutors-hub.com')->view('mail.sessionAccepted');
    }
}
