<?php

namespace App\Http\Controllers;

use auth;
use App\Meta;
use App\User;
use App\Level;
use App\Earning;
use App\Message;
use App\Session;
use App\Student;
use App\Location;
use App\Discipline;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\TeacherController;

class AdminController extends Controller
{

    
    //Countries
    public function sessions()
    {
        $sessions = Session::orderBy('created_at', 'desc')->get();
        return view('admin.pages.sessions.index', ['sessions' => $sessions]);
    }
    public function viewSession($id)
    {
        $session = Session::findOrFail($id);
        if(!$session->seen){
            $session->update(['seen' => 1]);
        }
        return view('admin.pages.sessions.single', ['session' => $session]);
    }
    //Countries
    public function settings()
    {
        $fee = Meta::where('key', 'fee')->first();
        return view('admin.pages.settings', ['fee' => $fee]);
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
        $users = User::where('type', 'teacher')->get();
        return view('admin.pages.users.index', ['users' => $users, 'type' => 'Tutors']);
    }
    public function students()
    {
        $users = User::where('type', 'student')->get();
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
    
    // Return Single Tutor Page
    public function getUser($id)
    {
        $user = User::with(['country', 'state', 'city', 'neighborhood'])->findOrFail($id);
        $profile = $user->profile;
       
        return view('admin.pages.users.single', ['user' => $user, 'type' => 'Tutor']);
        
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
            $message = Message::create([
                'from' => auth()->id(),
                'to' => $id,
                'text' => "Hello " . User::find($id)->name . " thanks reaching out. I am sending this message in regards to your ticket " . $ticket . " How can I help you?"
            ]);
    
            // broadcast(new NewMessage($message));
            
            return redirect('/messages?u='. $id);
            
        }
    }
    // public function hasConversationWith(Request $request)
    // {
        
    // }
    
}
