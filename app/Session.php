<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Session extends Model
{
    protected $dates = ['startsession','endsession','session_started_at'];
    //
    protected $guarded = [
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id')->with('user');
    }
    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id')->with('user');
    }

    public function getStartsessionAttribute($value)
    {
        $user=Auth::user();
        if ($user->timezone) {
            return Carbon::parse($value)->timezone($user->timezone)->toDateTimeString();
        }
        return $value;
    }

    public function getEndsessionAttribute($value)
    {
        $user=Auth::user();
        if ($user->timezone) {
//            dd(Carbon::parse($value)->timezone('Asia/Jerusalem')->toDateTimeString());
                          return Carbon::parse($value)->timezone($user->timezone)->toDateTimeString();

        }
        return $value;
    }




}
