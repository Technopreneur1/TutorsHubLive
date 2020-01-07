<?php

namespace App\Http\Controllers;

use App\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    //\
    
    public function updateFee(Request $request){
        if($fee = Meta::where('key', 'fee')->count())
        {
            Meta::where('key', 'fee')->first()->update(['value' => $request->fee]);
        }
        else {
        
            Meta::create(['key' => 'fee', 'value' => $request->fee]);
        }
        session()->flash('message' ,'Fee Updatesd');
        return back();
    }
}
