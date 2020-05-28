<?php

namespace App\Http\Controllers;

use auth;
use App\User;
use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //

    
    public function getUserInfo()
    {
        $user = User::with(['state', 'city', 'neighborhood', 'country'])->find(auth()->id());
        $profile = $user->profile;
        // if($user->type == 'student')
        // {
        $discipline = $user->profile->discipline;
        $level = $user->profile->level;
        // }
        // $state = $user->state;
        // $city = $user->city;
        // $neighborhood = $user->neighborhood;
        // $profile = $user->profile;
        return response()->json(['user' => $user]);
    }


    
    public function updateLatLng(Request $request)
    {
        $user = auth()->user()->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return response()->json(['msg' => "success"]);
    }


    
    public function postFavorite(Request $request)
    {
        $user = User::findOrFail($request->id);
        $like = Favorite::where('user_id', auth()->id())->where('target_id', $request->id)->get();
        if(count($like))
        {
            Favorite::where('user_id', auth()->id())->where('target_id', $request->id)->delete();
            return response()->json(['status' => 'unliked']);
        }
        $like = Favorite::create(['user_id' => auth()->id(), 'target_id' => $request->id]);
        return response()->json(['status' => 'liked']);
        
    }
    public function profile()
    {
        if(auth()->check())
        {
            $user = User::with(['state', 'city', 'neighborhood', 'country'])->find(auth()->id());
            $profile = $user->profile;

            if($user->type == 'teacher')
            {
                $type = 'tutor_rating';
            }
            elseif($user->type == 'student')
            {
                $type = 'student_rating';
            }
            $sessions = $profile->sessions->where('completed', 1);
            // dd($sessions);
            return view('pages.user.profile',  ['user' => $user, 'likes' => 0]);
        }
        return abort(404);
        
    }

    public function userProfile($id)
    {
        $user = User::with(['state', 'city', 'neighborhood', 'country'])->find($id);
        if($user->is_hidden || $user->is_banned)
        {
            return view("pages.user.unavailable");
        }
        $profile = $user->profile;
        if($user->type == 'teacher')
        {
            $type = 'tutor_rating';
        }
        elseif($user->type == 'student')
        {
            $type = 'student_rating';
        }
        $user->profile->sessions = $profile->sessions->where('completed', 1)->where($type, '!=', null);
        // dd($user->profile->sessions);
        $likes = Favorite::where('user_id', auth()->id())->where('target_id', $user->id)->count();
        return view('pages.user.profile',  ['user' => $user, 'profile' => $profile, 'likes' => $likes]);
    }
    
    public function doILike(Request $request)
    {
        
        $likes = Favorite::where('user_id', auth()->id())->where('target_id', $request->id)->count();
        return response()->json([
            'status' => $likes
        ]);
    }

    public function updateUserProfile(Request $request)
    {
        $user = auth()->user();
        $user->name =$request->name;
        $user->phone =$request->phone;
        $user->gender =$request->gender;
        $user->is_hidden =$request->is_hidden;
        $user->can_contact =$request->can_contact;
        $user->update();
        $profile = auth()->user()->profile;
        $profile->gender_preference =$request->gender_preference;
        $profile->bio =$request->bio;
        $profile->update();
        return response()->json(['user' => $user]);
    }

    public function updatePassword(Request $request)
    {

        if(Hash::check($request->current, auth::user()->password))
        {
            auth::user()->update(['password' => Hash::make($request->password)]);
            $message = "success";
        }else
        {
            $message = "Incorrect Password";
        }
        
        
        return response()->json(['message' => $message]);

    }

    public function postAvatar(Request $request)
    {
        // image in base64
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
        // store locally
        $name =  auth()->id() . "_avatar" . auth()->id() . uniqid(true) . '.jpg';
        Storage::put('public/images/' . $name, $image);
        
        $user = User::findOrFail(auth()->id())->update(['avatar' => $name]);

        return response()->json(['avatar' => $name]);
    
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        if($user->is_banned)
        {
            $user->update(['is_banned' => false]);
        }
        else
        {
            $user->update(['is_banned' => true]);
        }
        session()->flash('message', 'User Successfully Banned');
        return back();
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        if($user->verified)
        {
            $user->update(['verified' => false]);
        }
        else
        {
            $user->update(['verified' => true]);
        }
        session()->flash('message', 'Verification status updated');
        return back();
    }
    public function postFile(Request $request, $type)
    {
        if($request->hasFile('file'))
        {
            $file = $request->file;
            $name = uniqid(true) . 'fl' . rand(99, 9999) . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/files', $name);
        }
        auth()->user()->profile->update([
            $type => $name
        ]);
        session()->flash('File has been uploaded');
        return back();
    }
    public function deleteFile(Request $request, $type)
    {

        auth()->user()->profile->update([
            $type => ''
        ]);
        session()->flash('File has been Deleted');
        return back();
    }
}
