<?php

namespace App\Console\Commands;

use App\Mail\ThreeHoursMail;
use App\Session;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ThreeHoursNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sessionEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will go through each session and checks if 3 or less hours are remaining in
                              the session and then sends and email to both Tutor and Student';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sessions = Session::where('accept', 1)->whereNull('cancel_request')->where('completed', 0)->get();

        if(count($sessions)){
            foreach ($sessions as $session){

                $remainingTimeInHours = Carbon::parse($session->date)->diffInHours(Carbon::now());

                if($remainingTimeInHours < 4 && $remainingTimeInHours > 0){
                    $smail = $session->student->user->email;
                    $tmail = $session->teacher->user->email;

                    Mail::to($smail)->send(new ThreeHoursMail($session, auth()->user(), $session->teacher->user, true, false));
                    Mail::to($tmail)->send(new ThreeHoursMail($session, auth()->user(), $session->teacher->user, true, false));
                }
            }
        }
    }
}
