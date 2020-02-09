<?php

namespace App\Http\Controllers;

use App\Earning;
use App\Session;
use App\Mail\cancelRequest;
use Illuminate\Http\Request;
use App\Mail\sessionCanceled;
use App\Mail\sessionCanceledToAdmin;
use Illuminate\Support\Facades\Mail;
use App\Mail\sessionCanceledToStudent;

class SessionController extends Controller
{
    
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

    public function cancel(Request $request)
    {
        $session = Session::findOrFail($request->id);
        if($session->completed)
        {
            session()->flash("message", "Session can not be canceled.");
            return back();
        }
        $sess = $session;
        $smail = $session->student->user->email;
        $sname = $session->student->user->name;
        $tname = $session->teacher->user->name;
        $tmail = $session->teacher->user->email;
        $hours = $session->hours;
        $rate = $session->rate;
        $total = $session->total;
        $fee = $session->fee;
        session()->flash("success", "Session has been canceled and deleted.");
        Mail::to($tmail)->send(new sessionCanceled($sname));
        Mail::to($smail)->send(new sessionCanceledToStudent($tname));
        Mail::to('info@tutors-hub.com')->send(new sessionCanceledToAdmin($sname, $tname, $smail, $tmail, $total, $hours, $rate, $fee));
        $session->delete();
        return redirect()->route('admin.sessions');
    }
    public function postCancel(Request $request)
    {
        $session = Session::findOrFail($request->id);
        $session->update(['cancel_request' => auth()->user()->type]);
        Mail::to('info@tutors-hub.com')->send(new cancelRequest($session, auth()->user()));
        return  response()->json(['msg' => 'success']);
    }
}
