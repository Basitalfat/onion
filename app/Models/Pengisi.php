<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengisi extends Model
{
    protected $table = 'pengisi';
    protected $fillable = ['name', 'status'];

    public function tausiyahs()
    {
        return $this->hasMany(Tausiyah::class);
    }
}
