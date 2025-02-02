<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens, SoftDeletes ;


       protected $fillable = [
        'full_name',
        'phone',
        'password',
        'city',
        'hood',
        'gender',
        'birthday',
        'role_id',
        'specialization_id',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role (){
        return $this->belongsTo(Role::class);
    }

    public function specialization(){
        return $this->belongsTo(Specialty::class);   ///// relation for doctor acconts
    }

    public function familyMembers(){
        return $this->hasMany(FamilyMember::class,'family_owner_id');  ///// relation for family acconts
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
