<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Doctor extends BaseModel
{
    use SoftDeletes;

    protected $guarded = [];

    protected $appends = [
        'can_book_for_start_date',
        'can_book_for_end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function timeReservations()
    {
        return $this->hasMany(DoctorTimeReservation::class);
    }

    public function getCanBookForStartDateAttribute() : string
    {
        return Carbon::now()->toDateString();
    }

    public function getCanBookForEndDateAttribute() : string
    {
        return Carbon::now()->addDays($this->can_book_for)->toDateString();
    }

    public function holidays()
    {
        return $this->hasMany(DoctorHoliday::class);
    }


}
