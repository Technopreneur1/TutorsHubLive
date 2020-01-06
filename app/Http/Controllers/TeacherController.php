<?php

namespace App\Http\Controllers;

use App\User;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'neighborhood_id' => $request['neighborhood'],
        ]);
        $teacher = Teacher::create([
            'user_id' => $user->id,
        ]);
        
        return response()->json(['user' => $user,'teacher' => $teacher]);
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
                ->where('neighborhood_id', auth()->user()->neighborhood_id)
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
