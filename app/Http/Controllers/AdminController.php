<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\Cms;
use App\TutorAllowanceSetting;
use auth;
use App\Ad;
use App\Meta;
use App\Blog;
use App\User;
use App\Level;
use App\Earning;
use App\Message;
use App\Session;
use App\Student;
use App\Location;
use Carbon\Carbon;
use App\Discipline;
use App\Testimonial;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\TeacherController;

class AdminController extends Controller
{


    //Countries
    public function verifyEmail(Request $request)
    {
        $date =Carbon::now();
        User::findOrFail($request->id)->update(['email_verified_at' => $date]);
        session()->flash("message", "Updated");
        return back();
    }
    public function ads()
    {
        // if(request()->country)
        // {
        //     $ads = Ad::where('country_id', request()->country)->get();
        // }
        // elseif(request()->state)
        // {
        //     $ads = Ad::where('state_id', request()->state)->get();
        // }
        // elseif(request()->city)
        // {
        //     $ads = Ad::where('city_id', request()->city)->get();
        // }
        // elseif(request()->neighborhood)
        // {
        //     $ads = Ad::where('neighborhood_id', request()->city)->get();
        // }
        // else
        {
            $ads = Ad::orderBy('created_at', 'desc')->get();
        }
        return view('admin.pages.ads.index', ['ads' => $ads]);
    }
    public function adminLoginAs(Request $request)
    {
        $user = User::findOrFail($request->id);
        auth::login($user);
        return redirect()->route('home');
    }
    public function sessions()
    {
        $sessionTitle = 'All Sessions';
        $sessions = Session::latest()->get();
        return view('admin.pages.sessions.index', ['sessions' => $sessions, 'sessionTitle' => $sessionTitle]);
    }

    public function requestedSessions()
    {
        $sessionTitle = 'Requested Sessions';
        $sessions = Session::where('accept', 0)
                        ->whereNull('cancel_request')
                        ->latest()
                        ->get();
        return view('admin.pages.sessions.index', ['sessions' => $sessions, 'sessionTitle' => $sessionTitle]);
    }

    public function pendingSessions()
    {
        $sessionTitle = 'Pending Sessions';
        $sessions = Session::where('accept', 1)
            ->where('payment_status', 0)
            ->where('completed', 0)
            ->whereNull('cancel_request')
            ->latest()
            ->get();

        return view('admin.pages.sessions.index', ['sessions' => $sessions, 'sessionTitle' => $sessionTitle]);
    }

    public function upcomingSessions()
    {
        $sessionTitle = 'Upcoming Sessions';
        $sessions = Session::where('accept', 1)
            ->where('completed', 0)
            ->where('payment_status', 1)
            ->whereNull('cancel_request')
            ->latest()
            ->get();
        return view('admin.pages.sessions.index', ['sessions' => $sessions, 'sessionTitle' => $sessionTitle]);
    }

    public function completedSessions()
    {
        $sessionTitle = 'Completed Sessions';
        $sessions = Session::where('payment_status', 1)->where('completed', 1)->latest()->get();
        return view('admin.pages.sessions.index', ['sessions' => $sessions, 'sessionTitle' => $sessionTitle]);
    }

    public function cancelledSessions()
    {
        $sessionTitle = 'Cancelled Sessions';
        $sessions = Session::whereNotNull('cancel_request')->latest()->get();
        return view('admin.pages.sessions.index', ['sessions' => $sessions, 'sessionTitle' => $sessionTitle]);
    }

    public function sessions1()
    {
        $sessions = Session::where('completed',1)->orderBy('created_at', 'desc')->get();
        return view('admin.pages.sessions.index1', ['sessions' => $sessions]);
    }

    public function viewSession($id)
    {
        $session = Session::findOrFail($id);
        if(!$session->seen){
            $session->update(['seen' => 1]);
        }
        return view('admin.pages.sessions.single', ['session' => $session]);
    }
    public function viewAd($id)
    {
        $ad = Ad::findOrFail($id);
        return view('admin.pages.ads.single', ['ad' => $ad]);
    }
    //Countries
    public function settings()
    {
        $fee = Meta::where('key', 'fee')->first();
        $settings = AdminSetting::first();

        return view('admin.pages.settings', compact('fee', 'settings'));
    }

    public function updateSettings(Request $request){
        $settings = AdminSetting::first();

        if($settings){
            $settings->update([
                'copyrightText' => $request->copyrightText ? : $settings->copyrightText,
                'videoURL' => $request->videoURL ? : $settings->videoURL,
                'contact_number' => $request->contact_number ? : $settings->contact_number,
                'email' => $request->email ? : $settings->email,
                'address' => $request->address ? : $settings->address,
                'allow_confidentials_in_messages' => $request->allow_confidentials_in_messages ? 1 : 0,
                'allow_confidentials_in_bio' => $request->allow_confidentials_in_bio ? 1 : 0,
                'allow_confidentials_in_ads' => $request->allow_confidentials_in_ads ? 1 : 0
            ]);

            session()->flash('message' ,'Settings Updated');
            return back();

        }else{
            AdminSetting::create([
                'copyrightText' => $request->copyrightText,
                'videoURL' => $request->videoURL,
                'contact_number' => $request->contact_number ,
                'email' => $request->email,
                'address' => $request->address,
                'allow_confidentials_in_messages' => $request->allow_confidentials_in_messages ? 1 : 0,
                'allow_confidentials_in_bio' => $request->allow_confidentials_in_bio ? 1 : 0,
                'allow_confidentials_in_ads' => $request->allow_confidentials_in_ads ? 1 : 0
            ]);

            session()->flash('message' ,'Settings Updated');
            return back();
        }
    }
    public function blogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        // dd($blogs);
        return view('admin.pages.blogs.index', ['blogs' => $blogs]);
    }
    public function addBlog()
    {
        return view('admin.pages.blogs.add');
    }
    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.pages.blogs.edit', ['blog' => $blog]);
    }
    public function showBlog($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.pages.blogs.single', ['blog', $blog]);
    }
    public function admins()
    {
        $admins = User::where('type', 'admin')->get();
        return view('admin.pages.admins.index', ['admins' => $admins]);
    }
    public function showAdmin()
    {
        $admin = auth()->user();
        return view('admin.pages.admins.single', ['admin' => $admin]);
    }
    public function createAdmin()
    {

        return view('admin.pages.admins.add');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);
        if(Hash::check($request->current, auth::user()->password))
        {
            auth::user()->update(['password' => Hash::make($request->password)]);
            $message = "success";
        }else
        {
            session()->flash('message', 'Incorrect Password');
            return back();
        }

        session()->flash('message', 'Password Updated');
        return back();
    }
    public function postAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'type' => 'admin',
            'password' => bcrypt($request['password']),
        ]);
        $student = Student::create([
            'user_id' => $user->id,
        ]);
        session()->flash('message', 'Admin Added');
        return redirect()->route('admin.admins');
    }
    public function levels()
    {
        $levels = Level::orderBy('name', 'asc')->get();
        return view('admin.pages.levels.index', ['levels' => $levels]);
    }

    public function disciplines()
    {
        $disciplines = Discipline::orderBy('name', 'asc')->get();
        return view('admin.pages.disciplines.index', ['disciplines' => $disciplines]);
    }
    public function editDiscipline($id)
    {
        $discipline = Discipline::findOrFail($id);
        return view('admin.pages.disciplines.edit', ['discipline' => $discipline]);
    }
    public function editlevels($id)
    {
        $level = Level::findOrFail($id);
        return view('admin.pages.levels.edit', ['level' => $level]);
    }

    public function countries()
    {
        $countries = Location::where('type', 'country')->get();
        return view('admin.pages.locations.index', ['locations' => $countries, 'type' => 'Countries']);
    }

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('name', 'asc')->get();
        return view('admin.pages.testimonials.index', ['testimonials' => $testimonials]);
    }
    public function editTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.pages.testimonials.edit', ['testimonial' => $testimonial]);
    }
    public function getCountry($id)
    {
        $country = Location::with('states')->findOrFail($id);
        return view('admin.pages.locations.country', ['country' => $country, 'type' => 'Country']);
    }
    public function getState($id)
    {
        $state = Location::with('cities')->findOrFail($id);
        return view('admin.pages.locations.state', ['state' => $state, 'type' => 'State']);
    }
    public function getCity($id)
    {
        $city = Location::with('neighborhoods')->findOrFail($id);
        return view('admin.pages.locations.city', ['city' => $city, 'type' => 'City']);
    }
    public function getNeighborhood($id)
    {
        $neighborhood = Location::findOrFail($id);
        return view('admin.pages.locations.neighborhood', ['neighborhood' => $neighborhood, 'type' => 'City']);
    }

    public function adminpanel()
    {
        return view('admin.pages.dashboard');
    }
    public function teachers()
    {
        if(request()->country)
        {
            $users = User::where('type', 'teacher')->where('country_id', request()->country)->get();
        }
        elseif(request()->state)
        {
            $users = User::where('type', 'teacher')->where('state_id', request()->state)->get();
        }
        elseif(request()->city)
        {
            $users = User::where('type', 'teacher')->where('city_id', request()->city)->get();
        }
        elseif(request()->neighborhood)
        {
            $users = User::where('type', 'teacher')->where('neighborhood_id', request()->city)->get();
        }
        else
        {
            $users = User::where('type', 'teacher')->get();
        }
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'Tutors']);
    }
    public function students()
    {
        if(request()->country)
        {
            $users = User::where('type', 'student')->where('country_id', request()->country)->get();
        }
        elseif(request()->state)
        {
            $users = User::where('type', 'student')->where('state_id', request()->state)->get();
        }
        elseif(request()->city)
        {
            $users = User::where('type', 'student')->where('city_id', request()->city)->get();
        }
        elseif(request()->neighborhood)
        {
            $users = User::where('type', 'student')->where('neighborhood_id', request()->city)->get();
        }
        else
        {
            $users = User::where('type', 'student')->get();
        }
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'Students']);
    }
    public function bannedStudents()
    {
        $users = User::where('type', 'student')->where('is_banned', 1)->get();
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'Banned Students']);
    }
    public function bannedTutors()
    {
        $users = User::where('type', 'teacher')->where('is_banned', 1)->get();
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'Banned Tutors']);
    }
    public function featuredTutors()
    {
        $users = User::where('type', 'teacher')->where('is_featured', 1)->get();
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'Featured Tutors']);
    }

    public function deActivatedTutors()
    {
        $users = User::where('type', 'teacher')->where('is_active', 0)->get();
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'DeActivated Tutors']);
    }
    public function deActivatedStudents()
    {
        $users = User::where('type', 'student')->where('is_active', 0)->get();
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'DeActivated Tutors']);
    }

    // Return Single Tutor Page
    public function getUser($id)
    {
        $user = User::with(['country', 'state', 'city', 'neighborhood'])->findOrFail($id);
        $profile = $user->profile;
        $settings = $user->allowanceSettings;

        return view('admin.pages.users.single', ['user' => $user, 'type' => 'Tutor', 'settings' => $settings]);

    }

    public function saveSettings (Request $request) {
        $setting = TutorAllowanceSetting::where('user_id', $request->tutor_id)->first();

        if($setting){

            $setting->update([
                'allow_confidentials_in_messages' => $request->allow_confidentials_in_messages ? 1 : 0,
                'allow_confidentials_in_bio' => $request->allow_confidentials_in_bio ? 1 : 0,
                'allow_confidentials_in_ads' => $request->allow_confidentials_in_ads ? 1 : 0,
            ]);

        }else{
            TutorAllowanceSetting::create([
                'user_id' => $request->tutor_id,
                'allow_confidentials_in_messages' => $request->allow_confidentials_in_messages ? 1 : 0,
                'allow_confidentials_in_bio' => $request->allow_confidentials_in_bio ? 1 : 0,
                'allow_confidentials_in_ads' => $request->allow_confidentials_in_ads ? 1 : 0,
            ]);
        }

        session()->flash('success', 'Settings Updated');

        return back();
    }

    public function contact($id, $ticket)
    {
        $from = Message::where('from', auth()->id())
                        ->Where('to', $id)
                        ->get();
        if(count($from))
        {
            return redirect('/messages?u='. $id);
        }
        $to = Message::where('to', auth()->id())
                        ->Where('from', $id)
                        ->get();
        if(count($to))
        {
            return redirect('/messages?u='. $id);
        }
        else {
            if($ticket == "NO")
            {
                $message = Message::create([
                    'from' => auth()->id(),
                    'to' => $id,
                    'text' => "Hello " . User::find($id)->name
                ]);
            }
            else{
                $message = Message::create([
                    'from' => auth()->id(),
                    'to' => $id,
                    'text' => "Hello " . User::find($id)->name . " thanks reaching out. I am sending this message in regards to your ticket " . $ticket . " How can I help you?"
                ]);
            }

            // broadcast(new NewMessage($message));

            return redirect('/messages?u='. $id);

        }
    }
    // public function hasConversationWith(Request $request)
    // {

    // }

    public function cms()
    {
        $cmsArray = Cms::orderBy('created_at', 'desc')->get();
        return view('admin.pages.cms.index', ['cmsArray' => $cmsArray]);
    }
    public function addCms()
    {
        return view('admin.pages.cms.add');
    }
    public function editCms($id)
    {
        $cms = Cms::findOrFail($id);
        return view('admin.pages.cms.edit', ['cms' => $cms]);
    }

    public function addSessionText()
    {
        $settings = AdminSetting::first();
        $sessionText = '';

        if($settings){
            $sessionText = $settings->session_text;
        }

        return view('admin.add-sessionText', compact('sessionText'));
    }
    public function storeSessionText(Request $request)
    {
        $settings = AdminSetting::first();
        if($settings){
            $settings->update([
                'session_text' => $request->text
            ]);
        }else{
            AdminSetting::create([
                'session_text' => $request->text
            ]);
        }

        session()->flash('message', 'Session Text Added!');
        return redirect()->route('adminpanel');
    }
}
