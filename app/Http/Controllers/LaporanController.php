<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    // public function index(Request $request)
    // {
    //     $data = [
    //         'title' => 'List laporan',
    //     ];

    //     $laporans = Laporan::paginate(5);
    //     return view('admin.laporan.index', compact('laporans'), $data);
    // }

    public function index()
    {
        $data = [
            'title' => 'List laporan',
        ];

        $tampil = array();
        $pendapatan = 0;
        $total_pendapatan = 0;

        $dd = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAwal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggalAkhir = date('Y-m-d');

        while (strtotime($tanggalAwal) <= strtotime($tanggalAkhir)) {
            $tanggal = $tanggalAwal;
            $tanggalAwal = date('Y-m-d', strtotime("+1 day", strtotime($tanggalAwal)));

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('total_bayar');
            $total_pesanan = Pesanan::where('created_at', 'LIKE', "%$tanggal%")->sum('jumlah_harga');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pesanan;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['tanggal'] = date($tanggal, false);
            $row['pesanan'] = number_format($total_pesanan);
            $row['penjualan'] = number_format($total_penjualan);
            $row['pembelian'] = number_format($total_pembelian);
            $row['pendapatan'] = number_format($pendapatan);

            $tampil[] = $row;
        }

        $collections = collect($tampil);

        $collections->all();

        return view('admin.laporan.index', compact('collections','total_pendapatan'), $data);
    }
}
