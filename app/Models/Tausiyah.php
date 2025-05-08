<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tausiyah extends Model
{
    protected $fillable = [
        'pengisi',
        'tempat',
        'bulan',
        'holaqoh',
        'farah',
        'user_id',
    ];
        // Relasi ke User
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function absensis()
        {
        return $this->hasMany(Absensi::class);
        }
}
