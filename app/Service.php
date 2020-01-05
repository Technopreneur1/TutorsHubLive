<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $guarded = [
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
