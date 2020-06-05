<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [
    ];
    public function teacher()
    {
        return $this->belongsTo("App\Teacher");
    }
}
