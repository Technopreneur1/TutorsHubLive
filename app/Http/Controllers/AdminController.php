<?php

namespace App\Http\Controllers;

use App\Meta;
use App\User;
use App\Level;
use App\Earning;
use App\Location;
use App\Discipline;
use Illuminate\Http\Request;
// use App\Http\Controllers\TeacherController;

class AdminController extends Controller
{
    //Countries
    public function settings()
    {
        $fee = Meta::where('key', 'fee')->first();
        return view('admin.pages.settings', ['fee' => $fee]);
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
    
    // Return Single Tutor Page
    public function getUser($id)
    {
        $user = User::with(['country', 'state', 'city', 'neighborhood'])->findOrFail($id);
        $profile = $user->profile;
       
        return view('admin.pages.users.single', ['user' => $user, 'type' => 'Tutor']);
        
    }
    
    
}
