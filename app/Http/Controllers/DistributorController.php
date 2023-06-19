<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DistributorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = [
            'title' => 'List Distributor',
        ];

        $distributors = Distributor::paginate(5);
        return view('admin.distributor.list', compact('distributors'), $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah distributor'
        ];
        return view('admin.distributor.add', $data);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Kode_Distributor' => 'required',
            'Nama_Distributor' => 'required',
        ]);

        Distributor::create($validateData);

        // sweet alert
        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('admin/distributor');
    }

    public function show(Distributor $distributor)
    {
        //
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit distributor',
        ];

        $distributors = Distributor::find($id);
        return view('admin.distributor.edit', compact('distributors'), $data);
    }
    

    public function update($id, Request $request)
    {
        //validasi form
        $validateData = $request->validate([
            'Kode_Distributor' => 'required',
            'Nama_Distributor' => 'required',
        ]);

        Distributor::where('id', $id)->update($validateData);
        // sweet alert
        Alert::success('Success', 'Data berhasil diupdate');
        return redirect('admin/distributor');
    }

    public function destroy($id)
    {
        $distributor = Distributor::find($id);
        $distributor->delete();

        // sweet alert
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('admin/distributor')->with('success', 'Data Berhasil Dihapus');
    }
}
