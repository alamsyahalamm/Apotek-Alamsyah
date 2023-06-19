<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function pesanan_detail()
    {
        return $this->belongsTo('App\PesananDetail', 'obat_id', 'id');
    }
}
