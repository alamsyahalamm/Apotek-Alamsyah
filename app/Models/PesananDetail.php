<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function obat()
    {
        return $this->belongsTo('App\Models\Obat', 'obat_id', 'id');
    }

    public function jasa()
    {
        return $this->belongsTo('App\Models\Jasa', 'jasa_id', 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Models\Pesanan', 'pesanan_id', 'id');
    }
}
