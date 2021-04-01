<?php

namespace App\Http\Controllers;

use App\User;
use App\Teacher;
use App\Location;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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
                'currency' => $request['currency'],
                'address' => $request['address'],
                'type' => 'teacher',
                'country_id' => $request['country'],
                'password' => bcrypt($request['password']),
                'city_id' => $request['city'],
                'state_id' => $request['state'],
                'latitude' => $request['lat'],
                'longitude' => $request['lng'],
                'timezone' => $request['timezone'],
                'neighborhood_id' => $neighborhood,
            ]);
            $teacher = Teacher::create([
                'user_id' => $user->id,
            ]);
        $user->sendEmailVerificationNotification();
        return response()->json(['user' => $user,'teacher' => $teacher]);
    }
    public function updatePayment(Request $request)
    {
        auth()->user()->profile()->update(['payment' => $request->payment, 'paypal' => $request->paypal]);

        return response()->json(['msg' =>'success']);
    }
    public function search(Request $request)
    {
        // $requests = Req::with('user')->get();

        $lat = auth()->user()->latitude;
        $lng = auth()->user()->longitude;
        $av = '';

        if ($request->availability && $request->availability!='Both') {
            $av = "AND users.availability='". $request->availability."'";
        }

        if($request->level && $request->subject)
        {
            $string = "SELECT users.id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance
                 FROM users JOIN teachers ON users.id=teachers.user_id JOIN plans ON  teachers.id=plans.teacher_id WHERE plans.level_id = ? And type= 'teacher' AND plans.discipline_id = ?  ".$av." HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->level, $request->subject, $request->radius];
        }
        elseif($request->level)
        {
            $string = "SELECT users.id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance FROM users JOIN teachers ON users.id=teachers.user_id JOIN plans ON  teachers.id=plans.teacher_id WHERE plans.level_id = ?  And type= 'teacher' ".$av."  HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->level, $request->radius];
        }
        elseif($request->subject)
        {
            $string = "SELECT users.id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance FROM users JOIN teachers ON users.id=teachers.user_id JOIN plans ON  teachers.id=plans.teacher_id WHERE plans.discipline_id = ? And type= 'teacher' ".$av."  HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->subject, $request->radius];
        }
        else{
            $string = "SELECT id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance FROM users WHERE type= 'teacher' ".$av." HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->radius];

        }
//        dd($string);
//            $args = [$lat, $lng, $lat, $request->radius];

//        }
    //    dd($string);

//        if($request->radius)
//        {
//            $string = "SELECT id, ( 6371 * acos( cos( radians(?) ) *
//                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
//                AS distance FROM users WHERE type= 'teacher' HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
//            $args = [$lat, $lng, $lat, $request->radius];
//        }
//        else{
//            $string = "SELECT id, ( 6371 * acos( cos( radians(?) ) *
//                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
//                AS distance FROM users WHERE type= 'teacher' HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
//            $args = [$lat,$lng, $lat, 10];
//
//        }

        $ids = DB::select($string, $args);
        $ids = Arr::pluck($ids, "id");

        $tutors = User::with(['city', 'state', 'neighborhood', 'country', 'profile'])
                    ->where('is_hidden', 0)
                    ->where('is_active', 1)
                    ->where('is_banned', 0)
                    ->where('type', 'teacher')
                    ->whereIn('id', $ids)
                    ->paginate(30);

        return response()->json(['tutors' => $tutors]);
    }
    public function search_(Request $request)
    {
        if($request['neighborhood'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('is_hidden', 0)
                ->where('is_banned', 0)
                ->where('neighborhood_id', $request['neighborhood'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else if($request['city'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('is_hidden', 0)
                ->where('is_banned', 0)
                ->where('city_id', $request['city'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else if($request['state'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('is_hidden', 0)
                ->where('is_banned', 0)
                ->where('state_id', $request['state'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else if($request['country'])
        {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country'])
                ->where('is_hidden', 0)
                ->where('is_banned', 0)
                ->where('country_id', $request['country'])
                ->where('type', 'teacher')
                ->paginate(30);
        }
        else {
            $tutors = User::with(['city', 'state', 'neighborhood', 'country', 'profile'])

                ->where('is_hidden', 0)
                ->where('is_banned', 0)
                ->where('country_id', auth()->user()->country_id)
                ->where('type', 'teacher')
                ->paginate(30);
        }
        return response()->json(['tutors' => $tutors]);
    }
    public function getMinWage(Request $request)
    {
        $wage = User::findOrFail($request->id)->profile->plans->where('rate', '>', 0)->min('rate');
        return response()->json(['wage' => $wage ? $wage : 0]);
    }
    //Return Find Tutor Page

    public function index()
    {
        // $tutors = Teachers::orderBy('created_at', 'desc')->paginate(20);
        if(auth()->user()->type == 'student')
        {
            $user = auth()->user();
            $country = auth()->user()->country;
            return view('pages.search.tutor', ['user' => $user]);
        }else {
            return abort(404);
        }
    }
}
