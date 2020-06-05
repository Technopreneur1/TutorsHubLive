<?php

namespace App\Exports;

use App\Payment;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;

class UserPyamentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Payment::all();
    // }

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        // dd(Payment::all());
        return view('exports.payments', [
            'payments' => Payment::with('teacher.user')->where('teacher_id', $this->id)->get()
        ]);
    }
}
