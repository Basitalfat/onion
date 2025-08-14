<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tausiyah extends Model
{
    protected $fillable = [
        'tanggal',
        'pengisi_id',
        'tempat',
        'bulan',
        'holaqoh_id',
        'media',
        'user_id',
    ];
        // Relasi ke User
        public function pengisi()
        {
            return $this->belongsTo(Pengisi::class);
        }
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function absensis()
        {
        return $this->hasMany(Absensi::class);
        }
        public function holaqoh()
        {
            return $this->belongsTo(Holaqoh::class);
        }
}
