<?php

namespace App\Http\Controllers;

use App\User;
use App\Earning;
use Illuminate\Http\Request;
// use App\Http\Controllers\TeacherController;

class AdminController extends Controller
{
    //
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
        $payments = $profile->payments->sum('amount');

       
        return view('admin.pages.users.single', ['user' => $user, 'type' => 'Tutor']);
        
    }
    
    
}
