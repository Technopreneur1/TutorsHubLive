<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    //
    protected $guarded = [
    ];

    public function city()
    {
       return $this->belongsTo('App\Location', 'city_id')->where('type', 'city');
    }
    public function user()
    {
       return $this->belongsTo('App\User');
    }
    public function neighborhood()
    {
       return $this->belongsTo('App\Location', 'neighborhood_id')->where('type', 'neighborhood');
    }
    public function state()
    {
       return $this->belongsTo('App\Location', 'state_id')->where('type', 'state');
    }
    public function country()
    {
       return $this->belongsTo('App\Location', 'country_id')->where('type', 'country');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function discipline()
    {
        return $this->belongsTo('App\Discipline');
    }
    public function ad_detail() {
      return $this->belongsTo('App\Discipline');
    }

    public function favorite () {
        return $this->hasOne(FavoriteAd::class, 'ad_id', 'id');
    }
}
