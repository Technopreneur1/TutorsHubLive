<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use App\Blog;
use App\Discipline;
use App\Plan;
use App\Cms;
use App\Testimonial;
use App\TutorAllowanceSetting;
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
            $teachers = Plan::join('disciplines', 'plans.discipline_id', '=', 'disciplines.id')
                ->join('teachers', 'plans.teacher_id', '=', 'teachers.id')
                ->join('users', 'teachers.user_id', '=', 'users.id')
                ->select('plans.*',  'disciplines.name AS subject_name', 'teachers.*', 'users.*')
                ->where('users.type', 'teacher')->where('users.is_featured', 1)
                ->groupBy('users.id')
                ->get();

//            dd($teachers);
            //                                                                                                                                                                                                class="sc_title sc_title_default  vc_custom_1484220999465"><h6 class="sc_item_subtitle sc_title_subtitle sc_align_default sc_item_title_style_default">Find the Right Tutor for You</h6><h2 class="sc_item_title sc_title_title sc_align_default sc_item_title_style_default">Featured Tutors</h2></div><!-- /.sc_title -->

            $subjects = json_decode($subject);
            $settings = AdminSetting::first();
            //dd($teachers);
            return view("pages.home1", compact('subjects', 'testimonials', 'teachers', 'settings'));
        }
    }
    public function blog()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('pages.blog', ['blog' => $blogs]);
    }
    public function viewBlog($id)
    {
        $post = Blog::findOrFail($id);
        return view('pages.post', ['post' => $post]);
    }
    public function myFiles()
    {
        return view('pages.files');
    }
    public function settings()
    {
        return view('pages.settings');
    }
    public function about()
    {
        $content = Cms::whereId(3)->get(['title','description'])->first();

        return view('pages.privacy', ['content' => $content]);
    }

    public function privacy()
    {
        $content = Cms::whereId(1)->get(['title','description'])->first();

        return view('pages.privacy', ['content' => $content]);
    }
    public function terms()
    {
        $content = Cms::whereId(2)->get(['title','description'])->first();

        return view('pages.privacy', ['content' => $content]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
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
        $admin_settings = AdminSetting::first();

        if($request->has('u'))
        {

            $with = User::findOrFail($request->u);
        }

        $allowanceSettings = TutorAllowanceSetting::where('user_id', auth()->user()->id)->first();

        return view("pages.messages", ['with' => $with, 'admin_settings' => $admin_settings, 'allowanceSettings' => $allowanceSettings]);
    }

}
