<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class JasaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = [
            'title' => 'List Jasa',
        ];

        $jasas = Jasa::paginate(5);
        return view('admin.jasa.list', compact('jasas'), $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Jasa'
        ];
        return view('admin.jasa.add', $data);
    }

    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Kode_Jasa' => 'required',
            'Nama_Perusahaan' => 'required',
            'Kota_Asal' => 'required',
            'Kota_Tujuan' => 'required',
            'Harga' => 'required',
        ]);

        Jasa::create($validateData);

        // sweet alert
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('admin/jasa');
    }

   
    public function show(Jasa $jasa)
    {
        //
    }

    
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Jasa',
        ];

        $jasas = Jasa::find($id);
        return view('admin.jasa.edit', compact('jasas'), $data);
    }

    
    public function update($id, Request $request)
    {
        //validasi form
        $validateData = $request->validate([
            'Kode_Jasa' => 'required',
            'Nama_Perusahaan' => 'required',
            'Kota_Asal' => 'required',
            'Kota_Tujuan' => 'required',
            'Harga' => 'required',
        ]);

        Jasa::where('id', $id)->update($validateData);
        // sweet alert
        Alert::success('Success', 'Data berhasil diupdate');
        return redirect('admin/jasa');
    }

    
    public function destroy($id)
    {
        $jasa = Jasa::find($id);
        $jasa->delete();

        // sweet alert
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('admin/jasa')->with('success', 'Data Berhasil Dihapus');
    }
}
