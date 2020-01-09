<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Home Page
    public function index()
    {
        
        if(auth()->check())
        {
            if(auth()->user()->type == 'admin')
            {
                return redirect()->route('adminpanel');
            }
            $messages = auth()->user()->unreadMessages()->count();
            return view("pages.userhome", ['messages' => $messages]);
        }else {
            return view("pages.home");
            # code...
        }
    }

    public function messages(Request $request)
    {
        $with = null;
        if($request->has('u'))
        {
            
            $with = User::findOrFail($request->u);
        }
        return view("pages.messages", ['with' => $with]);
    }
}
