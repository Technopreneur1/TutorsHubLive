<?php

namespace App\Http\Controllers;

use App\Exports\AdsExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Exports\TutorsExport;
use App\Exports\PaymentsExport;
use App\Exports\SessionsExport;
use App\Exports\StudentsExport;
use App\Exports\UserPyamentExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    //
    public function tutors() 
    {
        return Excel::download(new TutorsExport, 'tutors.xlsx');
    }
    public function students() 
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }
    public function sessions() 
    {
        return Excel::download(new SessionsExport, 'sessions.xlsx');
    }
    public function ads() 
    {
        return Excel::download(new AdsExport, 'ads.xlsx');
    }
    public function payments() 
    {
        return Excel::download(new PaymentsExport, 'payments.xlsx');
    }
    public function userPayments($id) 
    {

        return Excel::download(new UserPyamentExport($id), 'payments.xlsx');
    }
}
