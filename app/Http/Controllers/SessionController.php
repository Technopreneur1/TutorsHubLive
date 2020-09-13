<?php

namespace App\Http\Controllers;

use App\Earning;
use App\Mail\PaymentReceived;
use App\Mail\sessionAccepted;
use App\Mail\sessionRequested;
use App\Session;
use Carbon\Carbon;
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
    public function paynow(Request $request)
    {
        $session = Session::findOrFail($request->sessionpid);
        $session->update(['payment_status' => 1]);
        Mail::to('info@tutors-hub.com')->send(new PaymentReceived($session, auth()->user()));
        Mail::to(auth()->user()->email)->send(new PaymentReceived($session, auth()->user()));

        //return response()->json(['msg' => 'success']);
        return response()->json(['session' => $session]);

    }
    public function sessionrequest(Request $request)
    {
        $session = Session::create([
            'teacher_id' => $request->teacher,
            'student_id' => auth()->user()->profile->id,
            'subject' => $request->subject,
            'level' => $request->level,
            'rate' => $request->rate,
            'hours' => $request->hours,
            'date' => Carbon::parse($request->date)->format('Y-m-d H:i:s'),
            'sessiontype' => $request->sessiontype,
            'total' => $request->total,
            'accept' => '0',
            'fee' => ($request->total * Earning::currentFee())/100,

        ]);
        $smail = $session->student->user->email;
        $tmail = $session->teacher->user->email;
        Mail::to('info@tutors-hub.com')->send(new sessionRequested($session, auth()->user()));
        Mail::to($smail)->send(new sessionRequested($session, auth()->user()));
        Mail::to($tmail)->send(new sessionRequested($session, auth()->user()));

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

    public function postaccept(Request $request)
    {
        $session = Session::findOrFail($request->id);
        $roomname = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9).$request->id;
        $agorasession = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32).$request->id;
        $session->update(['accept' => '1', 'roomname' => $roomname, 'agora_session' => $agorasession]);
        $smail = $session->student->user->email;
        $tmail = $session->teacher->user->email;
        Mail::to('info@tutors-hub.com')->send(new sessionAccepted($session, auth()->user()));
        Mail::to($smail)->send(new sessionAccepted($session, auth()->user()));
        Mail::to($tmail)->send(new sessionAccepted($session, auth()->user()));

        return  response()->json(['msg' => 'success']);
    }
//button of payment
    public function payment(Request $request)
    {

        $session = Session::findOrFail($request->id);

        $session->update(['payment_status' => '1']);
        return  response()->json(['msg' => 'success']);
    }
    public function startsession(Request $request)
    {
        $session = Session::findOrFail($request->id);
        $hr = json_decode($session->hours);
        $startsession = date("Y-m-d H:i:s");
        $endsession = date("Y-m-d H:i:s", strtotime("+".$hr." hours"));
        $session->update(['startsession' => $startsession, 'endsession' => $endsession]);
//        Mail::to('info@tutors-hub.com')->send(new cancelRequest($session, auth()->user()));
        return  response()->json(['msg' => 'success']);
    }
    public function requestagorasession($agora_id)
    {
        $result = Session::where('agora_session', $agora_id)
            ->where('class_status', 0)
            ->join('teachers','sessions.teacher_id','=','teachers.id')
            ->join('users','teachers.user_id','=','users.id')
            ->select('sessions.*','users.name')
            ->get();
        //Mail::to('info@tutors-hub.com')->send(new cancelRequest($session, auth()->user()));
        $res = json_decode($result);
        if(!empty($res)) {
            //dd($res[0]);
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return response()->json([
                'result' => 'success',
                'roomName' => $res[0]->roomname,
                'roomType' => 0,
                'yourName' => $res[0]->name,
                'role' => 'teacher',
                'formId' => $agora_id
            ]);
        }else{
            //dd($res[0]);
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return response()->json([
                'result' => 'failed',
                'roomName' => '',
                'roomType' => 0,
                'yourName' => '',
                'role' => 'teacher',
                'formId' => $agora_id
            ]);
        }
    }
    public function requestagorasessionstudent($agora_id)
    {
        $result = Session::where('agora_session', $agora_id)
            ->where('class_status', 0)
            ->join('students','sessions.student_id','=','students.id')
            ->join('users','students.user_id','=','users.id')
            ->select('sessions.*','users.name')
            ->get();
        //Mail::to('info@tutors-hub.com')->send(new cancelRequest($session, auth()->user()));
        $res = json_decode($result);
        if(!empty($res)) {
            //dd($res[0]);
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return response()->json([
                'result' => 'success',
                'roomName' => $res[0]->roomname,
                'roomType' => 0,
                'yourName' => $res[0]->name,
                'role' => 'student',
                'hours' => $res[0]->hours,
                'formId' => $agora_id
            ]);
        }else{
            //dd($res[0]);
            header('Access-Control-Allow-Origin: *');
            header('Content-type: application/json');
            return response()->json([
                'result' => 'failed',
                'roomName' => '',
                'roomType' => 0,
                'yourName' => '',
                'role' => 'student',
                'formId' => $agora_id
            ]);
        }
    }
    public function requestagorasessionhours($agora_id)
    {
        $result = Session::where('agora_session', $agora_id)
            ->where('class_status', 0)
            ->join('teachers','sessions.teacher_id','=','teachers.id')
            ->join('users','teachers.user_id','=','users.id')
            ->select('sessions.*','users.name')
            ->get();
//dd($result);
        $res = json_decode($result);

        if(!empty($res))
{
        //Mail::to('info@tutors-hub.com')->send(new cancelRequest($session, auth()->user()));
        //dd($res[0]);
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  response()->json([
            'result' => 'success',
            'roomName' => $res[0]->roomname,
            'roomType' => 0,
            'yourName' => $res[0]->name,
            'role' => 'teacher',
            'formId' => $agora_id,
            'hours' => $res[0]->hours
        ]);
}else{
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    return  response()->json([
        'result' => 'failed',
        'roomName' => '',
        'roomType' => 0,
        'yourName' => '',
        'role' => 'teacher',
        'formId' => $agora_id,
        'hours' => 0
    ]);
}
    }

    public function update_class_status($status_id)
    {
        $result = Session::where('agora_session', $status_id)
            ->update(['class_status' => 1]);
        //Mail::to('info@tutors-hub.com')->send(new cancelRequest($session, auth()->user()));
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/json');
        return  response()->json(['result' => 'success']);
    }
}
