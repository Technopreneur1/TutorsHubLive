<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
    protected $guarded = [
    ];
}
