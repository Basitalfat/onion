<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'nas',
        'syubah',
        'holaqoh',
        
    ];
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
