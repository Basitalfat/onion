<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiRekap extends Model
{
    use HasFactory;

    protected $table = 'absensi_rekaps'; // pastikan nama tabel sesuai

    protected $fillable = [
        'member_id',
        'bulan',
        'tahun',
        'total_hadir',
        'total_pertemuan',
        'persentase',
    ];

    /**
     * Relasi ke member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}