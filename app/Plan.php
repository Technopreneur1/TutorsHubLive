<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $guarded = [
    ];
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function discipline()
    {
        return $this->belongsTo('App\Discipline');
    }
}
