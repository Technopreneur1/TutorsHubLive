<?php

namespace App\Http\Controllers;

use App\Earning;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
   

    public function index()
    {
        if(auth()->user()->type == 'teacher')
        { 
            $profile = auth()->user()->profile;
            $payments = auth()->user()->profile->payments;
            $gross = Earning::gross($profile);
            $net = Earning::total($profile);
            $withdrawn = $payments->sum('amount');
            $balance = Earning::balance($profile);
            // dd($gross);
            return view('pages.payments.index', ['payments' => $payments, 'gross' => $gross, 'net' => $net, 'withdrawn' => $withdrawn, 'balance' => $balance]);
        }else {
            abort(404);
        }
    }


    public function post(Request $request)
    {
        $name = '';
        if($request->hasFile('image'))
        {
            $file = $request->image;
            $name = uniqid(true) . 'proff' . rand(99, 9999) . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/proffs', $name);
        }

        Payment::create([
            'teacher_id' => $request->teacher,
            'amount' => $request->amount,
            'proff' => $name
        ]);

        
        session('message', 'Payment Added');
        return back();
    }


}
