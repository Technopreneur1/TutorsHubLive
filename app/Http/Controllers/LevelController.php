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

    public function update(Request $request, $id)
    {
        Level::findOrFail($id)->update(['name' => $request->name]);
        session()->flash('message', 'Level Updated');
        return back();
    }

    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        if(!$level->students()->count() && !$level->plans()->count() && !$level->ads()->count())
        {
            $level->delete();
            session()->flash('message', 'Level deleted');
            return back();
        }
        else {
            # code...
            session()->flash('message', 'Level can not be deleted because it has related users or ads');
            return back();
        }
    }
}
