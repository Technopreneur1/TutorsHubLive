<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    
    protected $guarded = [
    ];
    public function states()
    {
        return $this->hasMany("App\Location", 'parent_id')->where('type', 'state')->orderBy('name', 'asc');
    }
    public function cities()
    {
        return $this->hasMany("App\Location", 'parent_id')->where('type', 'city')->orderBy('name', 'asc');
    }
    public function neighborhoods()
    {
        return $this->hasMany("App\Location", 'parent_id')->where('type', 'neighborhood')->orderBy('name', 'asc');
    }

    public function neighborhoodAds()
    {
        return $this->hasMany("App\Ad", 'neighborhood_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'asc');
    }
    
    public function cityAds()
    {
        return $this->hasMany("App\Ad", 'city_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'asc');
    }
    public function stateAds()
    {
        return $this->hasMany("App\Ad", 'state_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'asc');
    }
    public function countryAds()
    {
        return $this->hasMany("App\Ad", 'country_id')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'asc');
    }
    
    
    
   
}
