<?php

namespace App\Exports;


use App\Session;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SessionsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return User::all();
    // }

    public function __construct()
    {
        
    }

    public function view(): View
    {
        $sessions = Session::with('teacher', 'student', 'teacher.user', 'student.user' )->get();
        // dd($sessions);
        return view('exports.sessions', [
            'sessions' => $sessions
        ]);
    }
}
