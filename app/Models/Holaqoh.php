<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holaqoh extends Model
{
    protected $table = 'holaqohs';
    
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
    public function detailHolaqoh()
    {
        return $this->hasMany(DetailHolaqoh::class, 'holaqoh_id');
    }
}
