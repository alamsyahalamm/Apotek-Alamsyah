<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\Obat;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class penjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = [
            'title' => 'List penjualan',
        ];

        $penjualans = Penjualan::paginate(5);

        return view('admin.penjualan.list', compact('penjualans'), $data);
    }

    public function store1(Request $request)
    {

        $tanggal = Carbon::now();
        
        $kasir = User::findOrFail(Auth::user()->id);

        $penjualan = new penjualan();
        $penjualan->kasir = $kasir->name;
        $penjualan->tanggal = $tanggal;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->total_bayar = 0;
        $penjualan->save();

        session(['penjualan_id' => $penjualan->id]);

        return redirect(route('penjualans.create'));
    }

    public function create()
    {
        $data = [
            'title' => 'Pilih Obat'
        ];

        $obats = Obat::all();

        $penjualan_id = session('penjualan_id');


        return view('admin.penjualan.add', compact('obats', 'penjualan_id'), $data);
    }

    public function store2(Request $request)
    {

        $penjualan = Penjualan::findOrFail($request->penjualan_id);
        
        $obat = Obat::findOrFail($request->obat_id);

        if ($request->total_item > $obat->Stok) {

            Alert::warning('Warning', 'Jumlah pesanan melebihi jumlah Stok');
            return redirect('admin/tambah-penjualan');
        }

        $total = 0;
        $total = $obat->Hargas * $request->total_item;

        $penjualan->total_harga = $total;
        $penjualan->total_bayar = $total;
        $penjualan->update();

        // cek pesanan detail
        $cek_penjualan_detail = penjualanDetail::where('obat_id', $obat->id)->where('penjualan_id', $penjualan->id)->first();

        if (empty($cek_penjualan_detail)) {

            $penjualan_detail = new penjualanDetail();
            $penjualan_detail->penjualan_id = $penjualan->id;
            $penjualan_detail->obat_id = $obat->id;
            $penjualan_detail->harga_beli = $obat->Hargas;
            $penjualan_detail->jumlah = $request->total_item;
            $penjualan_detail->subtotal = $total;
            $penjualan_detail->save();
        } else {

            $penjualan_detail = penjualanDetail::where('obat_id', $obat->id)->where('penjualan_id', $penjualan->id)->first();

            $penjualan_detail->jumlah = $penjualan_detail->jumlah + $request->total_item;

            // Hargas sekarang
            $haraga_penjualan_detail_baru = $obat->Hargas * $request->total_item;
            $penjualan_detail->subtotal += $haraga_penjualan_detail_baru;
            $penjualan_detail->update();
        }

        session(['penjualan_id' => $penjualan->id]);

        return redirect(route('penjualans.listpenjualan'));
    }

    public function listpenjualan(Request $request)
    {
        $penjualan_id = session('penjualan_id');
        $distributor_id = session('distributor_id');

        $data =
            [
                'title' => 'Check Out'
            ];

        $penjualan = Penjualan::findOrFail($penjualan_id);

        // validasi
        if (!empty($penjualan)) {
            $penjualan_details = penjualanDetail::where('penjualan_id', $penjualan->id)->get();
            return view('admin.penjualan.listPenjualan', compact('penjualan', 'penjualan_details'), $data);
        } else {
            Alert::warning('penjualan Kosong', 'Anda Belum Memesan obat');
            return view('admin.penjualan.listPenjualan', compact('penjualan'), $data);
        }
    }

    public function confirm()
    {

        $penjualan_id = session('penjualan_id');
        
        $penjualan_details = penjualanDetail::where('penjualan_id', $penjualan_id)->get();
        
        $penjualan = Penjualan::findOrFail($penjualan_id);
        $penjualan->total_item = count($penjualan_details);
        
        $total = 0;

        foreach ($penjualan_details as $penjualan_detail) {
            $obat = Obat::find($penjualan_detail->obat_id);
            $obat->Stok -= $penjualan_detail->jumlah;
            $obat->update();
            $total += $penjualan_detail->subtotal; 
        }
        $penjualan->total_harga = $total;
        $penjualan->total_bayar = $total;
        $penjualan->update();
        
        // sweet alert
        Alert::success('Success', 'penjualan Berhasil');
        return redirect('admin/penjualans');
    }

    public function destroy(penjualanDetail $penjualanDetail)
    {
        $penjualan_details = penjualanDetail::where('id', $penjualanDetail->id)->first();
        $penjualan_details->delete();
        
        Alert::error('Delete', 'penjualan Berhasil Dihapus');
        return redirect()->route('penjualans.listpenjualan');
    }

    public function detail(penjualan $penjualan)
    {
        $data = [
            'title' => 'List Detail penjualan',
        ];

        $penjualanDetails = penjualanDetail::where('penjualan_id', $penjualan->id)->get();

        return view('admin.penjualan.listDetail', compact('penjualanDetails'), $data);
    }
}
