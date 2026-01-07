<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typebarang extends Model
{
    protected $table = 'typebarang';
    protected $fillable = [
        'kodetype',
        'merek',
        'no_rangka',
        'no_mesin',
        'pajak_tahun',
        'pajak_kir',
    ];
   public function angsuran()
    {
        return $this->hasMany(Angsuran::class, 'kodetype', 'kodetype');
    }
    public function servicedDetil()
    {
        return $this->hasMany(ServicedDetil::class, 'kodetype', 'kodetype');
    }
    public function ekspedisi()
    {
        return $this->hasMany(Ekspedisi::class, 'kendaraan_id');
    }

    public function ekspedisiDetail()
    {
        return $this->hasManyThrough(
            EkspedisiDetail::class,
            Ekspedisi::class,
            'kendaraan_id',   // FK di ekspedisi
            'ekspedisi_id',   // FK di ekspedisi_detail
            'id',             // PK Typebarang
            'id'              // PK Ekspedisi
        );
    }

    use HasFactory;
}
