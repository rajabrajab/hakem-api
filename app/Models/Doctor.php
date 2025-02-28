<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'clinic_location',
        'clinic_start_time',
        'clinic_end_time',
        'user_id',
        'specialty_id',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
