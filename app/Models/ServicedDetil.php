<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicedDetil extends Model
{
    use HasFactory;
    protected $table = 'serviced_detil';
    protected $primaryKey = 'id';
    protected $fillable = ['serviced_id', 'kodetype', 'namatype', 'barang', 'qty', 'harga', 'total'];


public function serviced()
{
    return $this->belongsTo(Serviced::class, 'serviced.id'); // ini harus 'serviced_id', bukan 'id'
}
public function typebarang()
{
    return $this->belongsTo(Typebarang::class, 'kodetype', 'kodetype');
}


    
}
