<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'perusahaan',
    ];

    public function transaksidetil()
    {
        return $this->hasMany(TransaksiDetil::class, 'transaksi_id');
    }
}
