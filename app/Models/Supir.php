<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    protected $table = 'supir';
    protected $fillable = [
        'id',
        'namasupir',
    ];
     public function Ekspedisi()
    {
        return $this->hasmany(Ekspedisi::class, 'id');
    }
}
