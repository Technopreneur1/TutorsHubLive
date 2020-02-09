<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sessionCanceledToAdmin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $sname;
    public $tname;
    public $smail;
    public $tmail;
    public $total;
    public $hours;
    public $rate;
    public $fee;
    public function __construct($sname, $tname, $smail, $tmail, $total, $hours, $rate, $fee)
    {
        $this->sname = $sname;
        $this->tname = $tname;
        $this->smail = $smail;
        $this->tmail = $tmail;
        $this->total = $total;
        $this->hours = $hours;
        $this->rate = $rate;
        $this->fee = $fee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Canceled Session Details')->from('noreply@tutors-hub.com')->view('mail.sessionCanceledToAdmin');;
    }
}
