<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = [
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function allowanceSettings() : HasOne {
        return $this->hasOne(
            TutorAllowanceSetting::class,
            'user_id',
            'id'
        );
    }

    public function profile()
    {

        if($this->type == "student")
        {
            return $this->hasOne("App\Student")->with(['level', 'discipline', 'sessions', 'completedSessions']);
        }
        elseif($this->type == "teacher") {
            return $this->hasOne("App\Teacher")->with(['plans.teacher.user', 'sessions', 'completedSessions']);
        }
        else {

            return $this->hasOne("App\Student");
        }



    }

    public function allAds(){
        return $this->hasMany(Ad::class,'user_id', 'id')->with('discipline','level');
    }

    public function ads()
    {
        return $this->hasMany('App\Ad')->with(['user','country', 'state', 'neighborhood', 'city', 'discipline', 'level'])->orderBy('created_at', 'desc');;
    }

    public function ad_detail()
    {
        return $this->hasOne('App\Ad', 'user_id')->with('discipline','level');
    }

    public function city()
    {
       return $this->belongsTo('App\Location', 'city_id')->where('type', 'city');
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

    public function favorites()
    {
        return $this->hasMany('App\Favorite')->with('user');
    }


    public function messagesToMe()
    {
        return $this->hasMany('App\Message', 'to');
    }
    public function unreadMessages()
    {
        return $this->hasMany('App\Message', 'to')->where('read', 0);
    }

    public function favoriteAds (){
        return $this->hasMany(FavoriteAd::class, 'user_id', 'id');
    }
}
