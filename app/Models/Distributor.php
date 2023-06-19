<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pembelian()
    {
        return $this->belongsTo('App\Models\Pembelian', 'pembelian_id', 'id');
    }
}
