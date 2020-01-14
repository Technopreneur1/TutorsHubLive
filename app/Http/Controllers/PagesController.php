<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function privacy()
    {
        return view('pages.privacy');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
        // dd($request->qry);
        $ticket = "TS" . rand(1000, 99999);
        if(auth()->check())
        {
            Mail::to('mudassirmaqboolofficial@gmail.com')->send(new ContactEmail(auth()->user(), "Existing User", auth()->user()->email, $request->qry, $ticket));
        }else {
            Mail::to('mudassirmaqboolofficial@gmail.com')->send(new ContactEmail(null, $request->type, $request->email, $request->qry, $ticket));
        }
        return view('pages.contactmsg', ['ticket' => $ticket]);
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
