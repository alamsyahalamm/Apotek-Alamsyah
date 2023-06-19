<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        $totalobat = Obat::count();
        $totaluser = User::count();
        $totalpesanan = Pesanan::count();
        $totaljasa = Jasa::count();
        $totalpembelian = Pembelian::count();
        $totalpenjualan = Penjualan::count();
        return view('admin.dashboard.index', compact('totalobat', 'totaluser', 'totalpesanan', 'totaljasa' , 'totalpembelian', 'totalpenjualan'), $data);
    }
}
