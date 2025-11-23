<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'nas',
        'syubah',
        'holaqoh_id',
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
        return $this->hasMany(DetailHolaqoh::class);
    }

    public function holaqoh()
    {
        return $this->belongsTo(Holaqoh::class, 'holaqoh_id');
    }

    public function halaqohs()
    {
        return $this->belongsToMany(
            Holaqoh::class,        // model tujuan
            'detail_holaqoh',      // nama tabel pivot
            'member_id',           // FK di pivot ke model ini
            'holaqoh_id'           // FK ke model tujuan
        );
    }
}
