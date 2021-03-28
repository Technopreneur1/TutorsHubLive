<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $guarded = [
    ];

    public function plans()
    {
        return $this->hasMany("App\Plan")->with(['level', 'discipline']);
    }
    public function sessions()
    {
        return $this->hasMany("App\Session", "teacher_id")->latest()->with('student');
    }
    public function completedSessions()
    {
        return $this->hasMany("App\Session", "teacher_id")->where('completed', 1)->where('tutor_rating', '>', 0)->with('student');
    }
    public function unseenSessions()
    {
        return $this->hasMany("App\Session", "teacher_id")->with('student')->where('completed', 0);
    }
    public function unseenPayments()
    {
        return $this->hasMany("App\Payment", "teacher_id")->where('seen', 0);
    }
    public function payments()
    {
        return $this->hasMany("App\Payment", "teacher_id");
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
