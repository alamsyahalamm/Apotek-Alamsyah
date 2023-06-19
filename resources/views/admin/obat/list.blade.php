@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kode Obat</th>
                            <th>Nama Obat</th>
                            <th>Bentuk Obat</th>
                            {{-- <th>Kontra_Indikasi</th>
                            <th>Indikasi</th>
                            <th>Aturan</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Kadaluarsa</th> --}}
                            <th>Harga </th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($obats as $obat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('uploads/' . $obat->Gambar) }}" alt="{{ $obat->nama_obat }}"
                                            width="100px"></td>
                                    <td>{{ $obat->Kode_Obat }}</td>
                                    <td>{{ $obat->Nama_Obat }}</td>
                                    <td>{{ $obat->Bentuk_Obat }}</td>
                                    {{-- <td>{{ $obat->Kontra_Indikasi }}</td>
                                    <td>{{ $obat->Indikasi }}</td>
                                    <td>{{ $obat->Aturan }}</td>
                                    <td>{{ $obat->Tgl_Masuk }}</td>
                                    <td>{{ $obat->Tgl_Kadaluarsa }}</td> --}}
                                    <td>Rp. {{ number_format($obat->Hargas) }}</td>
                                    <td>{{ $obat->Stok }}</td>
                                    <td>
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group btn-action">
                                                <a href="{{ url('admin/obat/show') }}/{{ $obat->id }}"
                                                    class="btn btn-warning d-inline-block" title="Edit Jurusan">
                                                    <i class="fa fa-info fa-fw"></i>
                                                </a>

                                                <div class="btn-group btn-action">
                                                    <a href="{{ url('admin/obat') }}/{{ $obat->id }}"
                                                        class="btn btn-primary d-inline-block" title="Edit Jurusan">
                                                        <i class="fa fa-edit fa-fw"></i>
                                                    </a>
                                                </div>

                                                <form action="{{ url('admin/obat', $obat->id) }}" method="POST" class="d-inline">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-hapus"
                                                        title="Hapus obat" data-name="{{ $obat->Nama_Obat }}"
                                                        data-table="obat" onclick="return confirm('Anda yakin ingin menghapus data?')">
                                                        <i class="fa fa-trash fa-fw"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                    <div class="row">
                        <div class="mx-auto mt-3">
                            {{ $obats->fragment('judul')->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
