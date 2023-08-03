<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typebarang extends Model
{
    protected $table = 'typebarang';
    protected $fillable = [
        'kodetype',
        'namatype',
        'uom',
        'hargabaru',
        'ppn',
        'hargajual',
    ];
    // public function transaksidetil()
    // {
    //     return $this->hasMany(TransaksiDetil::class, 'kodetype', 'kodetype');
    // }
    use HasFactory;
}
