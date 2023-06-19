@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesan - {{ $obat->Nama_Obat }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ url('uploads') }}/{{ $obat->Gambar }}" class="img-thumbnail" alt="obat">
                            </div>
                            <div class="col-md-6">
                                <h2>{{ $obat->Nama_Obat }}</h2>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($obat->Hargas) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td>{{ number_format($obat->Stok) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kontra Indikasi</td>
                                            <td>:</td>
                                            <td>{{ $obat->Kontra_Indikasi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Aturan</td>
                                            <td>:</td>
                                            <td>{{ $obat->Aturan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Indikasi</td>
                                            <td>:</td>
                                            <td>{{ $obat->Indikasi }}</td>
                                        </tr>

                                        <tr>
                                            <form method="POST" action="{{ url('member/pesan') }}/{{ $obat->id }}">

                                                @csrf
                                                <td>Jasa</td>
                                                <td>:</td>
                                                <td>
                                                    <select name="jasa_id" id="jasa_id"
                                                        class="form-control @error('jasa_id') is-invalid @enderror">
                                                        @foreach ($jasas as $jasa)
                                                            @if ($jasa->id == (old('jasa_id') ?? ($dosen->jasa_id ?? '')))
                                                                <option value="{{ $jasa->id }}" selected>
                                                                    {{ $jasa->Nama_Perusahaan }}</option>
                                                            @else
                                                                <option value="{{ $jasa->id }}">
                                                                    {{ $jasa->Nama_Perusahaan }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('jasa_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </td>
                                        </tr>

                                        <td>
                                            <h6>Jumlah Pesan</h6>
                                        </td>
                                        <td>:</td>
                                        <hr>
                                        <td>
                                            <input type="number" name="jumlah_pesan" class="form-control" required="">
                                            <hr>
                                            <button type="submit" class="btn btn-primary mt-2"><i
                                                    class="fa fa-shopping-cart"></i> Masukan keranjang</button>
                                            <a href="{{ url('home') }}" class="btn btn-secondary mt-2"><i
                                                    class="fa fa-arrow-left"></i> Kembali</a>
                                        </td>

                                        </form>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
