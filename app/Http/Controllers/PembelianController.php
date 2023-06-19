<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\ListPembelian;
use App\Models\Obat;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class PembelianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = [
            'title' => 'List pembelian',
        ];

        $pembelians = Pembelian::paginate(5);

        return view('admin.pembelian.list', compact('pembelians'), $data);
    }

    public function create1()
    {

        $data = [
            'title' => 'Pilih Distributor'
        ];

        $distributors = Distributor::all();

        return view('admin.pembelian.add1', compact('distributors'), $data);
    }

    public function store1(Request $request)
    {
        $tanggal = Carbon::now();
        $pembelian = new Pembelian();
        $pembelian->distributor_id = $request->distributor_id;
        $pembelian->tanggal = $tanggal;
        $pembelian->total_item = 0;
        $pembelian->total_harga = 0;
        $pembelian->bayar = 0;
        $pembelian->save();

        session(['id_pembelian' => $pembelian->id]);
        session(['distributor_id' => $pembelian->distributor_id]);
        session(['total_item' => $request->total_item]);

        return redirect(route('pembelians.create2'));
    }

    public function create2()
    {
        $data = [
            'title' => 'Pilih Obat'
        ];

        $obats = Obat::all();

        $id_pembelian = session('id_pembelian');
        $distributor_id = session('distributor_id');
        $total_item = session('total_item');


        return view('admin.pembelian.add2', compact('obats', 'id_pembelian', 'distributor_id', 'total_item'), $data);
    }

    public function store2(Request $request)
    {

        $pembelian = Pembelian::findOrFail($request->id_pembelian);
        $obat = Obat::findOrFail($request->obat_id);

        $total = 0;
        $total = $obat->Hargas * $request->total_item;

        $pembelian->total_harga = $total;
        $pembelian->bayar = $total;
        $pembelian->update();

        // cek pesanan detail
        $cek_pembelian_detail = PembelianDetail::where('obat_id', $obat->id)->where('pembelian_id', $pembelian->id)->first();

        if (empty($cek_pembelian_detail)) {

            $pembelian_detail = new pembelianDetail();
            $pembelian_detail->pembelian_id = $pembelian->id;
            $pembelian_detail->obat_id = $obat->id;
            $pembelian_detail->harga_beli = $obat->Hargas;
            $pembelian_detail->jumlah = $request->total_item;
            $pembelian_detail->subtotal = $total;
            $pembelian_detail->save();
        } else {

            $pembelian_detail = pembelianDetail::where('obat_id', $obat->id)->where('pembelian_id', $pembelian->id)->first();

            $pembelian_detail->jumlah = $pembelian_detail->jumlah + $request->total_item;

            // Hargas sekarang
            $haraga_pembelian_detail_baru = $obat->Hargas * $request->total_item;
            $pembelian_detail->subtotal += $haraga_pembelian_detail_baru;
            $pembelian_detail->update();
        }

        session(['id_pembelian' => $pembelian->id]);
        session(['distributor_id' => $pembelian->distributor_id]);

        return redirect(route('pembelians.listPembelian'));
    }

    public function listPembelian(Request $request)
    {
        $id_pembelian = session('id_pembelian');
        $distributor_id = session('distributor_id');

        $data =
            [
                'title' => 'Check Out'
            ];

        $pembelian = Pembelian::findOrFail($id_pembelian);

        // validasi
        if (!empty($pembelian)) {
            $pembelian_details = PembelianDetail::where('pembelian_id', $pembelian->id)->get();
            return view('admin.pembelian.listPembelian', compact('pembelian', 'pembelian_details'), $data);
        } else {
            Alert::warning('pembelian Kosong', 'Anda Belum Memesan obat');
            return view('admin.pembelian.listPembelian', compact('pembelian'), $data);
        }
    }

    public function confirm()
    {

        $id_pembelian = session('id_pembelian');
        
        $pembelian_details = pembelianDetail::where('pembelian_id', $id_pembelian)->get();
        
        $pembelian = Pembelian::findOrFail($id_pembelian);
        $pembelian->total_item = count($pembelian_details);
        
        $total = 0;

        foreach ($pembelian_details as $pembelian_detail) {
            $obat = Obat::find($pembelian_detail->obat_id);
            $obat->Stok += $pembelian_detail->jumlah;
            $obat->update();
            $total += $pembelian_detail->subtotal; 
        }
        $pembelian->total_harga = $total;
        $pembelian->bayar = $total;
        $pembelian->update();
        
        // sweet alert
        Alert::success('Success', 'pembelian Berhasil');
        return redirect('admin/pembelians');
    }

    public function destroy(PembelianDetail $pembelianDetail)
    {
        $pembelian_details = pembelianDetail::where('id', $pembelianDetail->id)->first();
        $pembelian_details->delete();
        
        Alert::error('Delete', 'pembelian Berhasil Dihapus');
        return redirect()->route('pembelians.listPembelian');
    }

    public function detail(Pembelian $pembelian)
    {
        $data = [
            'title' => 'List Detail Pembelian',
        ];

        $pembelianDetails = PembelianDetail::where('pembelian_id', $pembelian->id)->get();

        return view('admin.pembelian.listDetail', compact('pembelianDetails'), $data);
    }
}
