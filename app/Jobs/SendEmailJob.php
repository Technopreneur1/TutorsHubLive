<?php

namespace App\Jobs;

use App\Mail\ThreeHoursMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        new ThreeHoursMail($this->session, $this->user, $this->teacher,$this->forTutor, $this->forStudent);
    }
}
