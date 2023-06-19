<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ObatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = [
            'title' => 'List obat',
        ];

        $obats = obat::paginate(5);
        return view('admin.obat.list', compact('obats'), $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah obat'
        ];
        return view('admin.obat.add', $data);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'Kode_Obat' => 'required',
            'Nama_Obat' => 'required',
            'Bentuk_Obat' => 'required',
            'Hargas' => 'required',
            'Tgl_Masuk' => 'required',
            'Tgl_Kadaluarsa' => 'required',
            'Kontra_Indikasi' => 'required',
            'Indikasi' => 'required',
            'Aturan' => 'required',
            'Stok' => 'required',
            'Gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('Gambar');
        $nama_gambar = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads', $nama_gambar);

        $validateData['Gambar'] = $nama_gambar;

        Obat::create($validateData);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect('admin/obat');
    }


    public function show($id)
    {
        $data = [
            'title' => 'Show obat',
        ];

        $obats = obat::find($id);
        return view('admin.obat.show', compact('obats'), $data);
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Edit obat',
        ];

        $obats = obat::find($id);
        return view('admin.obat.edit', compact('obats'), $data);
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'Kode_Obat' => 'required',
            'Nama_Obat' => 'required',
            'Bentuk_Obat' => 'required',
            'Hargas' => 'required',
            'Tgl_Masuk' => 'required',
            'Tgl_Kadaluarsa' => 'required',
            'Kontra_Indikasi' => 'required',
            'Indikasi' => 'required',
            'Aturan' => 'required',
            'Stok' => 'required',
            // 'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $obat = obat::find($id);

        // cek jika ada file yang diupload | Jika tidak akan langsung mengupdate data tanpa mengubah file
        if ($request->hasFile('Gambar')) {
            File::delete('uploads/' . $obat->Gambar);
            $file = $request->file('Gambar');
            $nama_gambar = $obat->Gambar;
            $file->move('uploads', $nama_gambar);
        }

        // mengupdate data ke tabel obat
        $obat->Kode_Obat = $request->Kode_Obat;
        $obat->nama_obat = $request->Nama_Obat;
        $obat->Bentuk_Obat = $request->Bentuk_Obat;
        $obat->Hargas = $request->Hargas;
        $obat->Tgl_Masuk = $request->Tgl_Masuk;
        $obat->Tgl_Kadaluarsa = $request->Tgl_Kadaluarsa;
        $obat->Indikasi = $request->Indikasi;
        $obat->Kontra_Indikasi = $request->Kontra_Indikasi;
        $obat->Aturan = $request->Aturan;
        $obat->Stok = $request->Stok;
        $obat->Gambar = $obat->Gambar;
        $obat->save();

        Alert::success('Berhasil', "Data $request->Nama_Obat telah di edit");
        return redirect('admin/obat');
    }


    public function destroy($id)
    {
        $obat = obat::find($id);
        File::delete('uploads/' . $obat->gambar);
        $obat->delete();
        Alert::success('Berhasil', "obat $obat->Nama_Obat telah di hapus");
        return redirect("admin/obat");
    }
}
