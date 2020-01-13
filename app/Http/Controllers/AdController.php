<?php

namespace App\Http\Controllers;

use App\Ad;
use App\User;
use App\Location;
use Illuminate\Http\Request;

class AdController extends Controller
{
    //
    public function myAds()
    {
        if(auth()->user()->type == 'student')
        {
            return view('pages.ad.my');
        }else {
            return abort(404);
        }
    }
    public function getMyAds()
    {
        $ads = auth()->user()->ads()->paginate(30);
        return response()->json(['ads' => $ads]);
    }
    //
    public function index()
    {
        return view('pages.ad.index');
    }
    //
    public function create()
    {
        return view('pages.ad.create');
    }

    public function update(Request $request)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'discipline' => 'required', 'level' => 'required']);
        if($request->neighborhood < 1)
        {
            if($request->new_neighborhood)
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
                }
                else {
                    $neighborhood = $existing->id;
                }
            }else {
                $neighborhood = 0;
            }
            
            
        }else {
            $neighborhood = $request->neighborhood;
        }

        $ad = Ad::findOrFail($request->id)->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'country_id' => $request['country'],
            'state_id' => $request['state'],
            'city_id' => $request['city'],
            'neighborhood_id' => $neighborhood,
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
        ]);
        
        return response()->json(['ad' => $ad]);
    }
    public function post(Request $request)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'discipline' => 'required', 'level' => 'required']);
        if($request->neighborhood < 1)
        {
            if($request->new_neighborhood)
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
                }
                else {
                    $neighborhood = $existing->id;
                }
            }else {
                $neighborhood = 0;
            }
            
            
        }else {
            $neighborhood = $request->neighborhood;
        }

        $ad = Ad::create([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'description' => $request['description'],
            'country_id' => $request['country'],
            'state_id' => $request['state'],
            'city_id' => $request['city'],
            'neighborhood_id' => $neighborhood,
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
        ]);
        
        return response()->json(['ad' => $ad]);
    }

    public function search(Request $request)
    {
        if($request['neighborhood'])
        {
            $ads = Location::findOrFail($request['neighborhood'])->neighborhoodAds()->paginate(30);
        }
        else if($request['city'])
        {
            $ads = Location::findOrFail($request['city'])->cityAds()->paginate(30);
        }
        else if($request['state'])
        {
            $ads = Location::findOrFail($request['state'])->stateAds()->paginate(30);
        }
        else if($request['country'])
        {
            $ads = Location::findOrFail($request['country'])->countryAds()->paginate(30);
        }
        else {
            $ads = Location::findOrFail(auth()->user()->country_id)->countryAds()->paginate(30);
            // $ads = auth()->user()->neighborhood_id;
        }
        return response()->json(['ads' => $ads]);
    }

    public function destroy(Request $request)
    {
        Ad::findOrFail($request->id)->delete();
        return response()->json(['msg' => 'success']);
    }
}
