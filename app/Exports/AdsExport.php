<?php

namespace App\Exports;


use App\Ad;
use App\Session;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdsExport implements FromView
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
        $ads = Ad::with('country', 'state', 'city', 'neighborhood', 'user')->get();
        // dd($sessions);
        return view('exports.ads', [
            'ads' => $ads
        ]);
    }
}
