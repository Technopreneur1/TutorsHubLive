<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
 
    public function index()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->get();
        return view("admin.pages.tickets.index", ['tickets' => $tickets]);
    }

}
