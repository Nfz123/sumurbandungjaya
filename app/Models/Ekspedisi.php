<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    
    protected $table = 'ekspedisi';
    protected $fillable = [
        'tanggal',
        'jenis',
        'kendaraan_id',
        'supir_id',
        'tkbm',
        'uangjalan',
        'hargaritasi',
    ];
    
    public function Supir()
    {
        return $this->belongsTo(Supir::class, 'supir_id');
    }
    public function Typebarang()
    {
        return $this->belongsTo(Typebarang::class, 'kendaraan_id');
    }

    public function detail()
    {
        return $this->hasMany(EkspedisiDetail::class);
    }
}
