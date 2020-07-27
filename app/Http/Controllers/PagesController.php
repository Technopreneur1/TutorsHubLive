<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Testimonial;
use App\User;
use App\Ticket;
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
            if(auth()->user()->email_verified_at)
            {
                if(auth()->user()->is_banned)
                {
                    auth()->logout();
                    return redirect()->route('login')->withMessage("Your account is banned.");
                }
                if(auth()->user()->type == 'admin')
                {
                    return redirect()->route('adminpanel');
                }
                $messages = auth()->user()->unreadMessages()->count();
                return view("pages.userhome", ['messages' => $messages]);
            }else {

                return redirect('/email/verify');
            }
        }else {
            $subject = Discipline::get();
            $testimonials = Testimonial::get();
            $subjects = json_decode($subject);
            return view("pages.home1")->with('subjects',$subjects)->with('testimonials',$testimonials);
        }
    }
    public function myFiles()
    {
        return view('pages.files');
    }
    public function privacy()
    {
        $title = "Privacy Policy";
        return view('pages.privacy', ['title' => $title]);
    }
    public function settings()
    {
        return view('pages.settings');
    }
    public function terms()
    {
        $title = "Terms & Conditions";

        return view('pages.privacy', ['title' => $title]);
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
            Ticket::create([
                'user_id' => auth()->id(),
                'user_type' => 'Existing User',
                'email' => auth()->user()->email,
                'query' => $request->qry,
                'ticket_id' => $ticket,
            ]);
            Mail::to('info@tutors-hub.com')->send(new ContactEmail(auth()->user(), "Existing User", auth()->user()->email, $request->qry, $ticket));
        }else {
            Ticket::create([
                'user_id' => 0,
                'user_type' => $request->type,
                'email' => $request->email,
                'query' => $request->qry,
                'ticket_id' => $ticket,
            ]);
            Mail::to('info@tutors-hub.com')->send(new ContactEmail(null, $request->type, $request->email, $request->qry, $ticket));
        }
        return view('pages.contactmsg', ['ticket' => $ticket]);
    }

    public function plans()
    {
        if(auth()->user()->type == 'teacher')
        {

            return view('pages.user.plans');
        }else {
            abort(404);
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
