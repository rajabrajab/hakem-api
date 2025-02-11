<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_en',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
