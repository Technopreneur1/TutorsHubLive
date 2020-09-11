<?php
namespace App;

use App\Meta;
use Carbon\Carbon;

class Time{
    public static function convertTime($time)
    {
        $time = Carbon::createFromFormat('Y-m-d H:i:s', $time, 'UTC');
        $time->setTimezone(Meta::where('key', 'timezone')->pluck('value')->first());
        return $time;
    }
}
