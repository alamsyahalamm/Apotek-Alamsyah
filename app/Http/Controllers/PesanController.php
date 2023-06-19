<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Obat;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isMember');
    }


    public function index($id)
    {
        $obat = Obat::where('id', $id)->first();
        $jasas = Jasa::all();
        $data =
            [
                'produk' => $obat->Nama_Obat
            ];
        return view('member.pesan.index', compact('obat', 'jasas'), $data);
    }


    public function pesan(Request $request, $id)
    {

        $jasa = Jasa::find($request->jasa_id);

        $obat = Obat::where('id', $id)->first();
        $tanggal = Carbon::now();

        // validasi apakah melebihi Stok
        if ($request->jumlah_pesan > $obat->Stok) {

            Alert::warning('Warning', 'Jumlah pesanan melebihi jumlah Stok');
            return redirect('/member/pesan/' . $id);
        }

        // cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (empty($cek_pesanan)) {
            // simpan ke database pesanan
            $pesanan = new Pesanan();

            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }

        // simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('obat_id', $obat->id)->where('pesanan_id', $pesanan_baru->id)->first();

        if (empty($cek_pesanan_detail)) {
            $pesanan_detail = new PesananDetail();
            $pesanan_detail->obat_id = $obat->id;
            $pesanan_detail->jasa_id = $jasa->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = ($obat->Hargas * $request->jumlah_pesan) + $jasa->Harga;
            $pesanan_detail->save();
        } else {
            $pesanan_detail = PesananDetail::where('obat_id', $obat->id)->where('pesanan_id', $pesanan_baru->id)->first();

            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $request->jumlah_pesan;

            // Hargas sekarang
            $haraga_pesanan_detail_baru = ($obat->Hargas * $request->jumlah_pesan) + $jasa->Harga;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $haraga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        // jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = ($obat->Hargas * $request->jumlah_pesan) + $jasa->Harga;
        $pesanan->update();

        Alert::success('Success', 'Pesanan Berhasil Masuk Keranjang');
        return redirect('/member/check-out');
    }


    public function check_out()
    {
        $data =
            [
                'title' => 'Check Out'
            ];

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // validasi
        if (!empty($pesanan)) {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('member.pesan.check_out', compact('pesanan', 'pesanan_details'), $data);
        } else {
            Alert::warning('Pesanan Kosong', 'Anda Belum Memesan obat');
            return view('member.pesan.check_out', compact('pesanan'), $data);
        }
    }


    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();
        
        Alert::error('Delete', 'Pesanan Berhasil Dihapus');
        return redirect('/member/check-out');
    }


    public function konfirmasi()
    {
        // validasi
        $user = User::where('id', Auth::user()->id)->first();

        if (empty($user->no_hp)) {
            Alert::warning('Warning', 'Harap Lengkapi Identitas Anda');
            return redirect('/member/profile');
        }

        if (empty($user->alamat)) {
            Alert::warning('Warning', 'Harap Lengkapi Identitas Anda');
            return redirect('/member/profile');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $obat = Obat::where('id', $pesanan_detail->obat_id)->first();
            $obat->Stok = $obat->Stok - $pesanan_detail->jumlah;
            $obat->update();
        }

        // sweet alert
        Alert::success('Success', 'Pesanan Berhasil Check Out');
        return redirect('/member/history/' . $pesanan_id);
    }


    public function pesan_diterima($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->status = 4;
        $pesanan->updated_at = Carbon::now();
        $pesanan->save();

        // sweet alert
        Alert::success('Success', 'Pesanan Berhasil Diterima');
        return redirect('/member/history');
    }
}
