<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
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
}
