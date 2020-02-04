<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\Location;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'latitude' => $request['lat'],
            'longitude' => $request['lng'],
            'type' => 'student',
            'country_id' => $request['country'],
            'password' => bcrypt($request['password']),
            'city_id' => $request['city'],
            'state_id' => $request['state'],
            'neighborhood_id' => $neighborhood,
        ]);
        $student = Student::create([
            'user_id' => $user->id,
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
        ]);
        $user->sendEmailVerificationNotification();
        return response()->json(['user' => $user,'student' => $student]);
    }
}
