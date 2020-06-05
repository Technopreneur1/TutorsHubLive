<?php

namespace App\Exports;


use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class TutorsExport implements FromView
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
        $users = User::with('country', 'state', 'city', 'neighborhood', )->where('type', 'teacher')->get();
        // dd($users);
        return view('exports.tutors', [
            'users' => $users
        ]);
    }
}
