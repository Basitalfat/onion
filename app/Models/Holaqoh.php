<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holaqoh extends Model
{
    protected $fillable = [
        'kode_holaqoh',
        'name',
        
    ];
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function absensiRekap()
    {
        return $this->hasMany(AbsensiRekap::class);
    }
}
