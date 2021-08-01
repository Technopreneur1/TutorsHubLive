<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TutorAllowanceSetting extends Model
{
    protected $guarded = [];

    protected $table = 'tutors_allowance_settings';

    public function tutor() : BelongsTo {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}
