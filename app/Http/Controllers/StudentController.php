<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
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
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'type' => 'student',
            'country_id' => $request['country'],
            'password' => bcrypt($request['password']),
            'city_id' => $request['city'],
            'state_id' => $request['state'],
            'neighborhood_id' => $request['neighborhood'],
        ]);
        $student = Student::create([
            'user_id' => $user->id,
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
        ]);
        return response()->json(['user' => $user,'student' => $student]);
    }
}
