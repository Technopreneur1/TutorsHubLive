<?php

namespace App\Http\Controllers;

use App\Earning;
use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function index()
    {
        $sessions = auth()->user()->profile->sessions;
        return view("pages.sessions.index", ['sessions' => $sessions]);
    }

    public function book()
    {
        // if(auth()->user()->type == 'student')
        // {
        //     return view("pages.session.booking");
        // }else{
            return view("pages.error", ['message' => 'Sorry! You must have a student account to book a session']);
        // }
    }

    public function pay(Request $request)
    {
        $session = Session::create([
            'teacher_id' => $request->teacher,
            'student_id' => auth()->user()->profile->id,
            'subject' => $request->subject,
            'level' => $request->level,
            'rate' => $request->rate,
            'hours' => $request->hours,
            'total' => $request->total,
            'fee' => ($request->total * Earning::currentFee())/100,

        ]);
        return response()->json(['session' => $session]);
    }
}
