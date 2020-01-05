<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function location()
    {
        return $this->belongsTo('App\Location')->with('parent');
    }

}
