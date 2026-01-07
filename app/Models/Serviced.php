<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serviced extends Model
{
    protected $table = 'serviced';

    protected $fillable = [
        'kode_serviced',
        'tanggal',
        'perusahaan',
    ];

    public function ServicedDetil()
    {
        return $this->hasMany(ServicedDetil::class, 'serviced_id');
    }

    use HasFactory;
}
