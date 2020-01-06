<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index()
    {
        if(auth()->user()->type == 'teacher')
        { 
            $payments = auth()->user()->profile->payments;
            return view('pages.payments.index', ['payments' => $payments]);
        }else {
            abort(404);
        }
    }
}
