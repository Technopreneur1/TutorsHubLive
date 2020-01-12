<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    //
    protected $guarded = [
    ];

    public function students()
    {
        return $this->hasMany('App\Student');
    }
    public function ads()
    {
        return $this->hasMany('App\Ad');
    }
    public function plans()
    {
        return $this->hasMany('App\Plan');
    }
}
