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
    return $this->belongsTo(Member::class, 'member_id'); // tambahkan 'member_id'
}

public function tausiyah()
{
    return $this->belongsTo(Tausiyah::class, 'tausiyah_id'); // tambahkan 'tausiyah_id'
}
}
