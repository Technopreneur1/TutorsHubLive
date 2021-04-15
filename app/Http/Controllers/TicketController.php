<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::where('resolved', '0')->with('user')->orderBy('created_at', 'desc')->get();
        return view("admin.pages.tickets.index", ['tickets' => $tickets, 'page' => 'Open Tickets']);
    }
    public function closed()
    {
        $tickets = Ticket::where('resolved', '1')->orderBy('created_at', 'desc')->get();
        return view("admin.pages.tickets.index", ['tickets' => $tickets, 'page' => 'Closed Tickets']);
    }
    public function close(Request $request, $id)
    {
        $tickets = Ticket::findOrFail($id)->update([
            'resolved' => 1
        ]);
        session()->flash('success', 'Session Closed');
        return back();
    }

}
