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
        auth()->user()->update([
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'neighborhood_id' => $request->neighborhood,
        ]);
        return response()->json(['message' => 'success']);
    }
}
