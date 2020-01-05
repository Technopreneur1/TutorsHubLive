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
        return $this->hasMany("App\Session", "teacher_id")->with('student');
    }
    public function unseenSessions()
    {
        return $this->hasMany("App\Session", "teacher_id")->with('student')->where('seen', 0);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
