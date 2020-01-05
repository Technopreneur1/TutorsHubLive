<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    // Get Levels
    public function getAll()
    {
        $levels = Level::orderBy('name', 'asc')->get();
        return response()->json(['levels' => $levels]);
    }
}
