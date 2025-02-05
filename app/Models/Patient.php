<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'user_id',
        'family_owner_id',
        'weight',
        'height',
        'gender',
        'birthday'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyOwner()
    {
        return $this->belongsTo(User::class, 'family_owner_id');
    }

    public function familyMember()
    {
        return $this->hasOne(FamilyMember::class, 'patient_id');
    }

}
