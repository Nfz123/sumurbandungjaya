<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkspedisiDetail extends Model
{
    protected $table = 'ekspedisi_detail';
    protected $fillable = [
        'ekspedisi_id',
        'nosalesorder',
        'tujuan',
        'qty_terima',
        'qty_tolak',
    ];

    public function ekspedisi()
    {
        return $this->belongsTo(Ekspedisi::class);
    }

}
