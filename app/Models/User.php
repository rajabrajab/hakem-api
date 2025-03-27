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
        'phone',
        'password',
        'city',
        'hood',
        'role_id',
        'image_id',
        'is_first_login',
        'last_login'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_first_login' => 'boolean'
        ];
    }

    public function role (){
        return $this->belongsTo(Role::class);
    }

    public function familyMembers(){
        return $this->hasMany(FamilyMember::class,'family_owner_id');  ///// relation for family acconts
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
