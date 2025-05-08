<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'status',
        'ket',
        'member_id',
        'tausiyah_id',
    ];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function tausiyah()
    {
        return $this->belongsTo(Tausiyah::class);
    }
}
