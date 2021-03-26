<?php
namespace App;
class Earning{


    public static function gross($profile)
    {
        return $profile->sessions->where('completed', true)->sum('total');
    }
    public static function fee($profile)
    {
        return $profile->sessions->sum('fee');
    }
    public static function paid($profile)
    {
        return $profile->payments->sum('amount');
    }
    public static function total($profile)
    {
        return self::gross($profile) - self::fee($profile);
    }
    public static function balance($profile)
    {
        return self::total($profile) - self::paid($profile);
    }

    public static function currentFee()
    {
        return Meta::where('key', 'fee')->pluck('value')->first();
    }



}
?>
