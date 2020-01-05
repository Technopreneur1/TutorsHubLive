<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    
    protected $guarded = [
    ];
    public function states()
    {
        return $this->hasMany("App\Location", 'parent_id')->where('type', 'state')->orderBy('name', 'desc');
    }
    public function cities()
    {
        return $this->hasMany("App\Location", 'parent_id')->where('type', 'city')->orderBy('name', 'desc');
    }
    public function neighborhoods()
    {
        return $this->hasMany("App\Location", 'parent_id')->where('type', 'neighborhood')->orderBy('name', 'desc');
    }

    public function neighborhoodAds()
    {
        return $this->hasMany("App\Ad", 'neighborhood_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'desc');
    }
    
    public function cityAds()
    {
        return $this->hasMany("App\Ad", 'city_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'desc');
    }
    public function stateAds()
    {
        return $this->hasMany("App\Ad", 'state_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'desc');
    }
    public function countryAds()
    {
        return $this->hasMany("App\Ad", 'country_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'desc');
    }
    
    
    
   
}
