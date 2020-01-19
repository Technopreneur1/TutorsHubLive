<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    
    
    public function index()
    {
        $favorites = Favorite::with('user')->where('user_id', auth()->id())->get();
        return view("pages.user.favorites", ['favorites' => $favorites]);
    }

    public function destroy(Request $request)
    {
        $fav = Favorite::where('user_id', auth()->id())
            ->where('target_id', $request->id)
            ->delete();
        return response()->json(['message' => 'success']);
    }
}
