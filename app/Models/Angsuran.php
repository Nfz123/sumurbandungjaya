<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsuran';

    protected $fillable = [
        'kode_id',
        'kodetype',
        'namatype',
        'tanggal_angsuran',
        'nominal_angsuran',
    ];
    public function type()
    {
        return $this->belongsTo(TypeBarang::class, 'kodetype', 'kodetype');
    }
}