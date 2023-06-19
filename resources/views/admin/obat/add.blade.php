@extends('layouts.admin')
@section('content')

{{ 'id_pembelian' }}
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('admin/tambah-obat') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-2">
                    <label for="Kode_Obat" class="col-md-2 col-form-label text-md-end">{{ __('Kode Obat') }}</label>

                    <div class="col-md-5">
                        <input id="Kode_Obat" type="text"
                            class="form-control @error('Kode_Obat') is-invalid @enderror" name="Kode_Obat" required
                            autocomplete="Kode_Obat" autofocus>

                        @error('Kode_Obat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Nama_Obat" class="col-md-2 col-form-label text-md-end">{{ __('Nama Obat') }}</label>

                    <div class="col-md-5">
                        <input id="Nama_Obat" type="text"
                            class="form-control @error('Nama_Obat') is-invalid @enderror" name="Nama_Obat" required
                            autocomplete="Nama_Obat" autofocus>

                        @error('Nama_Obat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Bentuk_Obat" class="col-md-2 col-form-label text-md-end">{{ __('Bentuk Obat') }}</label>

                    <div class="col-md-5">
                        <input id="Bentuk_Obat" type="text"
                            class="form-control @error('Bentuk_Obat') is-invalid @enderror" name="Bentuk_Obat" required
                            autocomplete="Bentuk_Obat" autofocus>

                        @error('Bentuk_Obat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Tgl_Masuk" class="col-md-2 col-form-label text-md-end">{{ __('Tanggal Masuk') }}</label>

                    <div class="col-md-5">
                        <input id="Tgl_Masuk" type="date"
                            class="form-control @error('Tgl_Masuk') is-invalid @enderror" name="Tgl_Masuk" required
                            autocomplete="Tgl_Masuk" autofocus>

                        @error('Tgl_Masuk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Tgl_Kadaluarsa" class="col-md-2 col-form-label text-md-end">{{ __('Tanggal Kadaluarsa') }}</label>

                    <div class="col-md-5">
                        <input id="Tgl_Kadaluarsa" type="date"
                            class="form-control @error('Tgl_Kadaluarsa') is-invalid @enderror" name="Tgl_Kadaluarsa" required
                            autocomplete="Tgl_Kadaluarsa" autofocus>

                        @error('Tgl_Kadaluarsa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Kontra_Indikasi" class="col-md-2 col-form-label text-md-end">{{ __('Kontra_Indikasi') }}</label>

                    <div class="col-md-5">
                        <textarea name="Kontra_Indikasi" id="Kontra_Indikasi" class="form-control" @error('Kontra_Indikasi') is-invalid @enderror
                            required=""></textarea>

                        @error('Kontra_Indikasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Indikasi" class="col-md-2 col-form-label text-md-end">{{ __('Indikasi') }}</label>

                    <div class="col-md-5">
                        <textarea name="Indikasi" id="Indikasi" class="form-control" @error('Indikasi') is-invalid @enderror
                            required=""></textarea>

                        @error('Indikasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Aturan" class="col-md-2 col-form-label text-md-end">{{ __('Aturan') }}</label>

                    <div class="col-md-5">
                        <textarea name="Aturan" id="Aturan" class="form-control" @error('Aturan') is-invalid @enderror
                            required=""></textarea>

                        @error('Aturan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Hargas" class="col-md-2 col-form-label text-md-end">Harga (Rp.)</label>

                    <div class="col-md-5">
                        <input id="Hargas" type="number" class="form-control @error('Hargas') is-invalid @enderror"
                            name="Hargas" required autocomplete="Hargas" autofocus>

                        @error('Hargas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Stok" class="col-md-2 col-form-label text-md-end">Stok</label>

                    <div class="col-md-5">
                        <input id="Stok" type="number" class="form-control @error('Stok') is-invalid @enderror"
                            name="Stok" required autocomplete="Stok" autofocus>

                        @error('Stok')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="Gambar" class="col-md-2 col-form-label text-md-end">{{ __('Gambar') }}</label>

                    <div class="col-md-5">
                        <input id="Gambar" type="file" class="form-control @error('Gambar') is-invalid @enderror"
                            name="Gambar" required autocomplete="Gambar" autofocus>
                        @error('Gambar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-2 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                            Tambah obat
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
