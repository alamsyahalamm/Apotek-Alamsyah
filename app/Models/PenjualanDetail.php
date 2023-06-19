<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    public function obat()
    {
        return $this->belongsTo('App\Models\Obat', 'obat_id', 'id');
    }

    public function penjualan()
    {
        return $this->belongsTo('App\Models\Penjualan', 'penjualan_id', 'id');
    }
}
