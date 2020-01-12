<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $guarded = [
    ];

    public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function discipline()
    {
        return $this->belongsTo('App\Discipline');
    }
    public function sessions()
    {
        return $this->hasMany("App\Session", 'student_id')->with('teacher');
    }
    public function completedSessions()
    {
        return $this->hasMany("App\Session", 'student_id')->where('completed', 1)->where('student_rating', '>', 0)->with('teacher');
    }
    public function unseenSessions()
    {
        return $this->hasMany("App\Session", 'student_id')->with('teacher')->where('seen', 0);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
