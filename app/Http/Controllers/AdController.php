<?php

namespace App\Http\Controllers;

use App\Ad;
use App\User;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
    //    foreach ($ads as $ad) {
    //        dd($ad);
    //    }
    //    dd($ads);
        return response()->json(['ads' => $ads]);
    }
    //
    public function index()
    {
        $user = auth()->user();
        $country = auth()->user()->country;
        return view('pages.ad.index', ['user' => $user]);
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
            'availability' => $request['availability'],
            'city_id' => $request['city'],
            'neighborhood_id' => $neighborhood,
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
        ]);

        return response()->json(['ad' => $ad]);
    }
    public function post(Request $request)
    {
        // dd($request);
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
            'longitude' => $request['lng'],
            'latitude' => $request['lat'],
            'address' => $request['address'],
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
            'availability' => $request['availability'],
            
        ]);

        return response()->json(['ad' => $ad]);
    }
    public function search(Request $request)
    {
        // $requests = Req::with('user')->get();

        $lat = auth()->user()->latitude;
        $lng = auth()->user()->longitude;
        $av = "";

        if($request->level && $request->subject)
        {
            // return response()->json(['requests' => "os"]);
            $string = "SELECT id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance FROM users JOIN students ON users.id=students.user_id WHERE level_id = ? And is_banned = 0 AND type= 'student' AND discipline_id = ? HAVING  ".$av."distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->level, $request->subject, $request->radius];
        }
        elseif($request->level)
        {
            // return response()->json(['requests' => "os"]);
            $string = "SELECT id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance FROM users WHERE type = ?  And is_banned = 0 AND type= 'student' ".$av." HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->level, $request->radius];
        }
        elseif($request->subject)
        {
            // return response()->json(['requests' => "os"]);
            $string = "SELECT id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance FROM users WHERE sector_id = ? And is_banned = 0 AND type= 'student' ".$av." HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->subject, $request->radius];
        }
        else{
            $string = "SELECT id, ( 6371 * acos( cos( radians(?) ) *
                cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )
                AS distance FROM users WHERE is_banned = 0 AND type= 'student' ".$av." HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";
            $args = [$lat,$lng, $lat, $request->radius];

        }
//        dd($string);

        $ids = DB::select($string, $args);
        $ids = Arr::pluck($ids, "id");
        // array_push($ids, 11);

        if ($request->availability && $request->availability!='Both') {
            $ads = User::with(['city', 'state', 'neighborhood', 'country', 'profile','ad_detail'])
            ->select('users.*','ads.*')
            ->join('ads', 'users.id', '=', 'ads.user_id')
            ->where('ads.availability', $request->availability)
            ->where('is_hidden', 0)
            ->where('is_banned', 0)
            ->where('type', 'student')
            ->whereIn('users.id', $ids)
            ->paginate(30);
        } else {
            $ads = User::with(['city', 'state', 'neighborhood', 'country', 'profile','ad_detail'])
            ->where('is_hidden', 0)
            ->where('is_banned', 0)
            ->where('type', 'student')
            ->whereIn('users.id', $ids)
            ->paginate(30);
        }

        // $adsArray = [];
        
        // foreach($ads as $ad) {
        //     if($ad->ad_detail != null) {
        //         array_push($adsArray,$ad);
        //     }
        // }

        return response()->json(['ads' => $ads]);
    }
    public function search_(Request $request)
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
    public function deleteByAdmin($id)
    {
        session()->flash("success", "Ad has been deleted");
        Ad::findOrFail($id)->delete();
        return back();
    }
}
