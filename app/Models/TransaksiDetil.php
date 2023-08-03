<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetil extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detils';

    protected $fillable = [
        'transaksi_id',
        'kodetype',
        'namatype',
        'uom',
        'hargabaru',
        'ppn',
        'hargajual',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
    // public function typebarang()
    // {
    //     return $this->belongsTo(Typebarang::class, 'kodetype', 'kodetype');
    // }
}
