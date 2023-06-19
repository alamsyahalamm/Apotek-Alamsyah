<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function obat()
    {
        return $this->belongsTo('App\Models\Obat', 'obat_id', 'id');
    }

    public function pembelian()
    {
        return $this->belongsTo('App\Models\pembelian', 'pembelian_id', 'id');
    }
}
