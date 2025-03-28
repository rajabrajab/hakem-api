<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'path',
        'ext',
        'size',
        'mime_type',
    ];

    public function getFileUrl()
    {
        return asset("/{$this->path}");
    }
}
