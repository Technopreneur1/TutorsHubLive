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

    public function complete(Request $request)
    {
        $session = Session::findOrFail($request->id);
        // if(auth()->user()->profile->id == $session->teacher_id)
        // {
            $session->update(['completed' => true]);
            return response()->json(['msg' => 'success']);
        // }else {
        //     return response()->json(['msg' => 'error']);
        // }
    }
    public function postReview(Request $request)
    {
        $session = Session::findOrFail($request->id);
        if($request->by == 'teacher')
        {
            $session->update(['student_rating' => $request->rating, 'student_review' => $request->review]);
            return response()->json(['msg' => 'success', 'session' => $session]);
        }
        if($request->by == 'student')
        {
            $session->update(['tutor_rating' => $request->rating, 'tutor_review' => $request->review]);
            return response()->json(['msg' => 'success', 'session' => $session]);
        }else {
            return response()->json(['msg' => 'error']);
        }
    }
}
