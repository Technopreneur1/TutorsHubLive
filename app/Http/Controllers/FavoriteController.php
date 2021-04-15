<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    // Student Favourite Tutors
    public function index()
    {
        $favorites = Favorite::whereHas('user')
        ->where('user_id', auth()->user()->id)
        ->with('user')
        ->get();

        return view("pages.user.favorites", ['favorites' => $favorites]);
    }

    public function destroy(Request $request)
    {
        $fav = Favorite::where('user_id', auth()->id())
            ->where('target_id', $request->id)
            ->delete();
        return response()->json(['message' => 'success']);
    }

    // Tutor Favorited Ads
    public function abc() {

    }
}
