<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //get Countries
    public function getCountries()
    {
        $countries = Location::where('type', 'country')->orderBy('name', 'asc')->get();
        return response()->json(['countries' => $countries]);
    }
    //get Countries
    public function hide($id)
    {
        $location = Location::findOrFail($id);
        if($location->is_hidden)
        {
            $location->update(['is_hidden' => 0]);
        }
        else
        {
            $location->update(['is_hidden' => 1]);
        }
        session('message', "Location Status Updated");
        return back();
    }
    //get Countries
    public function getStates(Request $request)
    {
        if($request->country)
        {
            $states = Location::findOrFail($request->country)->states;
        }else{
            $states = Location::where('type', 'state')->orderBy('name', 'asc')->get();
        }
        return response()->json(['states' => $states]);
    }
    //get Countries
    public function getCities(Request $request)
    {
        if($request->state)
        {
            $cities = Location::findOrFail($request->state)->cities;
        }else{
            $cities = Location::where('type', 'city')->orderBy('name', 'asc')->get();
        }
        return response()->json(['cities' => $cities]);
    }
    //get Countries
    public function getNeighborhoods(Request $request)
    {
        if($request->city)
        {
            $neighborhoods = Location::findOrFail($request->city)->neighborhoods;
        }else{
            $neighborhoods = Location::where('type', 'neighborhood')->orderBy('name', 'asc')->get();
        }
        return response()->json(['neighborhoods' => $neighborhoods]);
    }

    public function postCountries(Request $request)
    {
        Location::create([
            'name' => $request->name,
            'type' => $request->type,
            'parent_id' => $request->parent_id,
        ]);
        session()->flash('message', 'New Country Added');
        return back();
    }

    // Update USer's Location
    public function updateUserLocation(Request $request)
    {
        
        if($request->neighborhood < 1)
        {
            $existing = Location::where('name', $request->new_neighborhood)
                                        ->where('type', 'neighborhood')
                                        ->where('parent_id', $request['city'])
                                        ->get()->first();
            
            if(!$existing)
            {
                $existing = Location::where('name', 'like', '%' . $request->new_neighborhood . '%')
                                        ->where('type', 'neighborhood')
                                        ->where('parent_id', $request['city'])
                                        ->get()->first();
                if($existing && strlen($existing->name) == $request->new_neighborhood)
                {
                    $len = strlen($existing->name);
                    if($existing->name[0] == $request->new_neighborhood[0] && $existing->name[1] == $request->new_neighborhood[1] && $existing->name[$len-1] == $request->new_neighborhood[$len-1] && $existing->name[$len-2] == $request->new_neighborhood[$len-2]) {
                        $neighborhood = $existing->id;
                    }else {
                        $new = Location::create(['name' => $request->new_neighborhood, 'type' => 'neighborhood', 'parent_id' => $request->city]);
                        $neighborhood = $new->id;
                    }
                }
                else {
                    $new = Location::create(['name' => $request->new_neighborhood, 'type' => 'neighborhood', 'parent_id' => $request->city]);
                    $neighborhood = $new->id;
                }
            }else {
                $neighborhood = $existing->id;
            }
            
        }else {
            $neighborhood = $request->neighborhood;
        }

        auth()->user()->update([
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'neighborhood_id' => $neighborhood,
        ]);
        return response()->json(['message' => 'success']);
    }
}
