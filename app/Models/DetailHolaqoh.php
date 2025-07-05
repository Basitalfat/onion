<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailHolaqoh extends Model
{
    protected $table = 'detail_holaqoh';
    
    protected $fillable = ['member_id', 'holaqoh_id'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function halaqoh()
    {
        return $this->belongsTo(Holaqoh::class, 'holaqoh_id');
    }
}
