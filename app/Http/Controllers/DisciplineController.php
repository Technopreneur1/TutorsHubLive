<?php

namespace App\Http\Controllers;

use App\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    //
    public function getDisciplines()
    {
        $disciplines = Discipline::orderBy('name', 'asc')->get();
        return response()->json(['disciplines' => $disciplines]);
    }
}
