<?php

namespace App\Http\Controllers;

use App\User;
use App\Teacher;
use App\Location;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TeacherController extends Controller
{

    
    public function teacherProfile($id)
    {
        $teacher  = Teacher::with('user')->findOrFail($id);
        dd($teacher);
        return view('pages.teacher');
    }
    //
    public function post(Request $request)
    {
        if(User::where('email', $request->email)->count())
        {
            return response()->json(['error' => 'email']);
        }
        if(User::where('phone', $request->phone)->count())
        {
            return response()->json(['error' => 'phone']);
        }
        if($request->neighborhood < 1)
        {
            $existing = Location::where('name', $request->new_neighborhood)
                                        ->where('type', 'neighborhood')
                                        ->where('parent_id', $request['city'])
                                        ->get()->first();
            
            if(!$existing)
            {
                $existing = Location::where('name', 'like', '%' . $request->new_neighborhood . '%')
                                        ->where('type', 'neighborhood')
                                        ->where('parent_id', $request['city'])
                                        ->get()->first();
                if($existing && strlen($existing->name) == $request->new_neighborhood)
                {
                    $len = strlen($existing->name);
                    if($existing->name[0] == $request->new_neighborhood[0] && $existing->name[1] == $request->new_neighborhood[1] && $existing->name[$len-1] == $request->new_neighborhood[$len-1] && $existing->name[$len-2] == $request->new_neighborhood[$len-2]) {
                        $neighborhood = $existing->id;
                    }else {
                        $new = Location::create(['name' => $request->new_neighborhood, 'type' => 'neighborhood', 'parent_id' => $request->city]);
                        $neighborhood = $new->id;
                    }
                }
                else {
                    $new = Location::create(['name' => $request->new_neighborhood, 'type' => 'neighborhood', 'parent_id' => $request->city]);
                    $neighborhood = $new->id;
                }
            }else {
                $neighborhood = $existing->id;
            }
            
        }else {
            $neighborhood = $request->neighborhood;
        }
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'gender' => $request['gender'],
                'type' => 'teacher',
                'country_id' => $request['country'],
                'password' => bcrypt($request['password']),
                'city_id' => $request['city'],
                'state_id' => $request['state'],
                'latitude' => $request['lat'],
                'longitude' => $request['lng'],
                'neighborhood_id' => $neighborhood,
            ]);
            $teacher = Teacher::create([
                'user_id' => $user->id,
            ]);
        Mail::to($user->email)->send(new WelcomeEmail(auth()->user()));
        return response()->json(['user' => $user,'teacher' => $teacher]);
    }
    public function updatePayment(Request $request)
    {
        auth()->user()->profile()->update(['payment' => $request->payment, 'paypal' => $request->paypal]);
        
        return response()->json(['msg' =>'success']);
    }

    public function search(Request $request)
    {
        if($request['neighborhood'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('neighborhood_id', $request['neighborhood'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else if($request['city'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('city_id', $request['city'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else if($request['state'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('state_id', $request['state'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else if($request['country'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('country_id', $request['country'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        return response()->json(['tutors' => $tutors]);
    }

    //Return Find Tutor Page

    public function index()
    {
        // $tutors = Teachers::orderBy('created_at', 'desc')->paginate(20);
        if(auth()->user()->type == 'student')
        {
            return view('pages.search.tutor');
        }else {
            return abort(404);
        }
    }
}
