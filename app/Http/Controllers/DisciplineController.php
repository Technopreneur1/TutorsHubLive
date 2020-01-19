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

    public function post(Request $request)
    {
        Discipline::create(['name' => $request->name]);
        session()->flash('message', 'New Discipline Added');
        return back();
    }
    public function update(Request $request, $id)
    {
        Discipline::findOrFail($id)->update(['name' => $request->name]);
        session()->flash('message', 'Discipline Updated');
        return back();
    }
    public function destroy($id)
    {
        $discipline = Discipline::findOrFail($id);
        if(!$discipline->students()->count() && !$discipline->plans()->count() && !$discipline->ads()->count())
        {
            $discipline->delete();
            session()->flash('message', 'Discipline deleted');
            session()->flash('success', 'Discipline deleted');
            return back();
        }
        else {
            # code...
            session()->flash('message', 'Discipline can not be deleted because it has related users or ads');
            return back();
        }
    }
}
