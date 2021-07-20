<?php

namespace App\Http\Controllers;

use App\Ad;
use App\FavoriteAd;
use auth;
use App\User;
use App\Teacher;
use App\Plan;
use App\Location;
use App\Discipline;
use App\Level;
use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    public $timezones= array(
        'Pacific/Midway'       => "(GMT-11:00) Midway Island",
        'US/Samoa'             => "(GMT-11:00) Samoa",
        'US/Hawaii'            => "(GMT-10:00) Hawaii",
        'US/Alaska'            => "(GMT-09:00) Alaska",
        'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
        'America/Tijuana'      => "(GMT-08:00) Tijuana",
        'US/Arizona'           => "(GMT-07:00) Arizona",
        'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
        'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
        'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
        'America/Mexico_City'  => "(GMT-06:00) Mexico City",
        'America/Monterrey'    => "(GMT-06:00) Monterrey",
        'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
        'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
        'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
        'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
        'America/Bogota'       => "(GMT-05:00) Bogota",
        'America/Lima'         => "(GMT-05:00) Lima",
        'America/Caracas'      => "(GMT-04:30) Caracas",
        'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
        'America/La_Paz'       => "(GMT-04:00) La Paz",
        'America/Santiago'     => "(GMT-04:00) Santiago",
        'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
        'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
        'Greenland'            => "(GMT-03:00) Greenland",
        'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
        'Atlantic/Azores'      => "(GMT-01:00) Azores",
        'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
        'Africa/Casablanca'    => "(GMT) Casablanca",
        'Europe/Dublin'        => "(GMT) Dublin",
        'Europe/Lisbon'        => "(GMT) Lisbon",
        'Europe/London'        => "(GMT) London",
        'Africa/Monrovia'      => "(GMT) Monrovia",
        'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
        'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
        'Europe/Berlin'        => "(GMT+01:00) Berlin",
        'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
        'Europe/Brussels'      => "(GMT+01:00) Brussels",
        'Europe/Budapest'      => "(GMT+01:00) Budapest",
        'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
        'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
        'Europe/Madrid'        => "(GMT+01:00) Madrid",
        'Europe/Paris'         => "(GMT+01:00) Paris",
        'Europe/Prague'        => "(GMT+01:00) Prague",
        'Europe/Rome'          => "(GMT+01:00) Rome",
        'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
        'Europe/Skopje'        => "(GMT+01:00) Skopje",
        'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
        'Europe/Vienna'        => "(GMT+01:00) Vienna",
        'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
        'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
        'Europe/Athens'        => "(GMT+02:00) Athens",
        'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
        'Africa/Cairo'         => "(GMT+02:00) Cairo",
        'Africa/Harare'        => "(GMT+02:00) Harare",
        'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
        'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
        'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
        'Europe/Kiev'          => "(GMT+02:00) Kyiv",
        'Europe/Minsk'         => "(GMT+02:00) Minsk",
        'Europe/Riga'          => "(GMT+02:00) Riga",
        'Europe/Sofia'         => "(GMT+02:00) Sofia",
        'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
        'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
        'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
        'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
        'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
        'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
        'Europe/Moscow'        => "(GMT+03:00) Moscow",
        'Asia/Tehran'          => "(GMT+03:30) Tehran",
        'Asia/Baku'            => "(GMT+04:00) Baku",
        'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
        'Asia/Muscat'          => "(GMT+04:00) Muscat",
        'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
        'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
        'Asia/Kabul'           => "(GMT+04:30) Kabul",
        'Asia/Karachi'         => "(GMT+05:00) Karachi",
        'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
        'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
        'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
        'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
        'Asia/Almaty'          => "(GMT+06:00) Almaty",
        'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
        'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
        'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
        'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
        'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
        'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
        'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
        'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
        'Australia/Perth'      => "(GMT+08:00) Perth",
        'Asia/Singapore'       => "(GMT+08:00) Singapore",
        'Asia/Taipei'          => "(GMT+08:00) Taipei",
        'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
        'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
        'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
        'Asia/Seoul'           => "(GMT+09:00) Seoul",
        'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
        'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
        'Australia/Darwin'     => "(GMT+09:30) Darwin",
        'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
        'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
        'Australia/Canberra'   => "(GMT+10:00) Canberra",
        'Pacific/Guam'         => "(GMT+10:00) Guam",
        'Australia/Hobart'     => "(GMT+10:00) Hobart",
        'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
        'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
        'Australia/Sydney'     => "(GMT+10:00) Sydney",
        'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
        'Asia/Magadan'         => "(GMT+12:00) Magadan",
        'Pacific/Auckland'     => "(GMT+12:00) Auckland",
        'Pacific/Fiji'         => "(GMT+12:00) Fiji",);

    public function getUserInfo()
    {
        $user = User::with(['state', 'city', 'neighborhood', 'country'])->find(auth()->id());
        $profile = $user->profile;
        // if($user->type == 'student')
        // {
        $discipline = $user->profile->discipline;
        $level = $user->profile->level;
        // }
        // $state = $user->state;
        // $city = $user->city;
        // $neighborhood = $user->neighborhood;
        // $profile = $user->profile;
        return response()->json(['user' => $user]);
    }



    public function updateLatLng(Request $request)
    {
        $user = auth()->user()->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return response()->json(['msg' => "success"]);
    }

    public function updateLocation(Request $request)
    {
        $user = auth()->user()->update([
            'latitude' => $request->lat,
            'longitude' => $request->lng,
            'address' => $request->address
        ]);
        return response()->json(['msg' => "success"]);
    }

    public function postFavorite(Request $request)
    {
        $user = User::findOrFail($request->id);
        $like = Favorite::where('user_id', auth()->id())->where('target_id', $request->id)->get();
        if(count($like))
        {
            Favorite::where('user_id', auth()->id())->where('target_id', $request->id)->delete();
            return response()->json(['status' => 'unliked']);
        }
        $like = Favorite::create(['user_id' => auth()->id(), 'target_id' => $request->id]);
        return response()->json(['status' => 'liked']);

    }

    public function postAdFavorite(Request $request)
    {

        $like = FavoriteAd::where('user_id', auth()->id())
                    ->where('ad_id', $request->id)
                    ->get();

        if(count($like))
        {
            FavoriteAd::where('user_id', auth()->id())
                    ->where('ad_id', $request->id)
                    ->delete();
            return response()->json(['status' => 'Unliked']);
        }

        FavoriteAd::create([
            'user_id' => auth()->id(),
            'ad_id' => $request->id
        ]);

        return response()->json(['status' => 'liked']);

    }

    public function profile()
    {
        if(auth()->check())
        {
            $user = User::with(['state', 'city', 'neighborhood', 'country'])->find(auth()->id());
            $profile = $user->profile;

            if($user->type == 'teacher')
            {
                $type = 'tutor_rating';
            }
            elseif($user->type == 'student')
            {
                $type = 'student_rating';
            }
            $sessions = $profile->sessions->where('completed', 1);
            // dd($sessions);
            $timezones = $this->timezones;

            return view('pages.user.profile',  ['user' => $user, 'likes' => 0,'timezones'=>$timezones]);
        }
        return abort(404);

    }

    public function userProfile($id)
    {
        $user = User::with(['state', 'city', 'neighborhood', 'country'])->find($id);
            if($user) {
                if($user->is_hidden || $user->is_banned)
            {
                return view("pages.user.unavailable");
            }
            $profile = $user->profile;
            if($user->type == 'teacher')
            {
                $type = 'tutor_rating';
            }
            elseif($user->type == 'student')
            {
                $type = 'student_rating';
            }
            $user->profile->sessions = $profile->sessions->where('completed', 1)->where($type, '!=', null);
            // dd($user->profile->sessions);
            $likes = Favorite::where('user_id', auth()->id())->where('target_id', $user->id)->count();
            $timezones = $this->timezones;

            return view('pages.user.profile',  ['user' => $user, 'profile' => $profile, 'likes' => $likes,'timezones'=>$timezones]);

        } else {
            return view("pages.user.unavailable");
        }

    }

    public function doILike(Request $request)
    {

        $likes = Favorite::where('user_id', auth()->id())->where('target_id', $request->id)->count();
        return response()->json([
            'status' => $likes
        ]);
    }

    public function updateUserProfile(Request $request)
    {
        $user = auth()->user();
        $user->name =$request->name;
        $user->phone =$request->phone;
        $user->gender =$request->gender;
        $user->availability =$request->availability;
        $user->currency =$request->currency;
        $user->is_hidden =$request->is_hidden;
        $user->can_contact =$request->can_contact;
        $user->paypal = $request->paypal;
        $user->bank_name = $request->bank_name;
        $user->routing_number = $request->routing_number;
        $user->transit_number = $request->transit_number;
        $user->institution_number = $request->institution_number;
        $user->account_number = $request->account_number;
        $user->timezone = $request->timezone;
        $user->update();
        $profile = auth()->user()->profile;
        $profile->gender_preference =$request->gender_preference;
        $profile->bio =$request->bio;
        $profile->update();
        return response()->json(['user' => $user]);
    }

    public function updatePassword(Request $request)
    {

        if(Hash::check($request->current, auth::user()->password))
        {
            auth::user()->update(['password' => Hash::make($request->password)]);
            $message = "success";
        }else
        {
            $message = "Incorrect Password";
        }


        return response()->json(['message' => $message]);

    }

    public function postAvatar(Request $request)
    {
        // image in base64
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
        // store locally
        $name =  auth()->id() . "_avatar" . auth()->id() . uniqid(true) . '.jpg';
        Storage::put('public/images/' . $name, $image);

        $user = User::findOrFail(auth()->id())->update(['avatar' => $name]);

        return response()->json(['avatar' => $name]);

    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        if($user->is_banned)
        {
            $user->update(['is_banned' => false]);
        }
        else
        {
            $user->update(['is_banned' => true]);
        }
        session()->flash('message', 'User Successfully Banned');
        return back();
    }
    public function feature($id)
    {
        $user = User::findOrFail($id);
        if($user->is_featured)
        {
            $user->update(['is_featured' => false]);
        }
        else
        {
            $user->update(['is_featured' => true]);
        }
        session()->flash('message', 'User Successfully Featured');
        return back();
    }

    public function search_locations(Request $request){
        // dd($request->all());

       $subject = $request->get('subject');
       $location = $request->get('location');
       $lat = $request->get('lat');
       $lng = $request->get('lng');


       if ($subject== 'All') {
            $results =  Plan::join('disciplines', 'plans.discipline_id', '=', 'disciplines.id')
            ->join('teachers', 'plans.teacher_id', '=', 'teachers.id')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->select('plans.*',  'disciplines.name AS subject_name', 'teachers.*', 'users.*')
            ->where('users.longitude', $lng)
            ->where('users.latitude', $lat)
            ->get();
        }else {
            $results =  Plan::join('disciplines', 'plans.discipline_id', '=', 'disciplines.id')
            ->join('teachers', 'plans.teacher_id', '=', 'teachers.id')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->select('plans.*',  'disciplines.name AS subject_name', 'teachers.*', 'users.*')
            ->where('users.longitude', $lng)
            ->where('users.latitude', $lat)
            ->where('plans.discipline_id', $subject)
            ->get();
       }
       $data = json_decode($results);
//       dd($data);
       $subject =   Discipline::get();
       $subjects = json_decode($subject);

            return view('pages.search.tutor1')->with('data', $data)->with('subjects', $subjects);

    }


    function viewtutor(Request $request)
    {

        $res = array('availability' => $request->availability, 'id' => $request->id, 'name' =>$request->name, 'subject' => $request->subject,'bio' => $request->bio,'rate' => $request->rate,'avatar' => $request->avatar,'created_at' => $request->created_at);

        //dd($res);
        return view('pages.search.viewtutor')->with('data', $res);


    }

    public function profiles(Request $request, User $users){

        // $this->validate($request,array(
        //     'name'       => 'required',
        //     'email'         =>'required',
        //     'phone'       => 'required',
        //     'gender'         =>'required',
        //     'location_id'       => 'required',
        //     'levels_id'         =>'required',
        //     'disciplines_name'       => 'required',
        //     'password'         =>'required',
        //     'cnfrm_password'       => 'required|same:password',

        // ));

        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->phone = $request->get('phone');
        $users->gender = $request->get('gender');
        $users->country_id = $request->get('location_id');
       // $users->level_id = $request->get('levels_id');
        $users->type = $request->get('disciplines_id');
        $users->password = Hash::make($request->get('password'));

        $data = $users->save();
        if (!empty($data)) {
            return redirect()->back()->with('message','Record has been updated successfully!');
        }else
        {
            return redirect()->back()->with('message','Failed! Try Again');
        }

    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        if($user->verified)
        {
            $user->update(['verified' => false]);
        }
        else
        {
            $user->update(['verified' => true]);
        }
        session()->flash('message', 'Verification status updated');
        return back();
    }
    public function postFile(Request $request, $type)
    {
        if($request->hasFile('file'))
        {
            $file = $request->file;
            $name = uniqid(true) . 'fl' . rand(99, 9999) . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/files', $name);
        }
        auth()->user()->profile->update([
            $type => $name
        ]);
        session()->flash('File has been uploaded');
        return back();
    }
    public function deleteFile(Request $request, $type)
    {

        auth()->user()->profile->update([
            $type => ''
        ]);
        session()->flash('File has been Deleted');
        return back();
    }

    function teacherregistration(){
        $timezones = $this->timezones;

        return view('pages.search.studentregistration',compact('timezones'));

    }
    function studentregistration(){
        $timezones = $this->timezones;
        return view('pages.search.teacherregistration',compact('timezones'));

    }
    function deleteResume($user_id) {
        Teacher::where('user_id', $user_id)
            ->update(['resume' => null]);

        session()->flash('message','Resume has been Deleted');
        return back();
    }
    function deleteBackgroundCheck($user_id) {
        Teacher::where('user_id', $user_id)
            ->update(['background_check' => null]);

        session()->flash('message','Background Check has been Deleted');
        return back();
    }
    function deleteIdentity($user_id) {
        Teacher::where('user_id', $user_id)
            ->update(['identity' => null]);

        session()->flash('message','Identity has been Deleted');
        return back();
    }

    public function deActivateProfile(Request $request, $id){
        $user = User::findOrFail($id);

        $user->is_active = false;
        $user->save();

        $ads = Ad::where('user_id', $id)->get();

        if(count($ads)){
            foreach ($ads as $ad) {
                $ad->delete();
            }
        }

        session()->flash('message','Profile De-Activated');
        return redirect()->back();
    }

}
