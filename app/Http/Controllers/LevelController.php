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

    public function post(Request $request)
    {
        Level::create(['name' => $request->name]);
        session()->flash('message', 'New Level Added');
        return back();
    }
}
