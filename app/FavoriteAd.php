<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteAd extends Model
{
    protected $guarded = [];

    public function user (){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ad () {
        return $this->belongsTo(Ad::class, 'ad_id', 'id')->with(['discipline', 'level']);
    }
}
