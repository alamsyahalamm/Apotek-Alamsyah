@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-2">
                <a href="{{ url('home') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Check Out</h3>
                        @if (!empty($pesanan))
                            <div class="alert alert-secondary" role="alert">
                                Tanggal Pesan : <strong>{{ $pesanan->tanggal }}</strong>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama obat</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Jasa</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($pesanan_details as $pesanan_detail)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    <img src="{{ url('uploads') }}/{{ $pesanan_detail->obat->Gambar }}"
                                                        width="100" alt="obat">
                                                </td>
                                                <td>{{ $pesanan_detail->obat->Nama_Obat }}</td>
                                                <td align="left">Rp. {{ number_format($pesanan_detail->obat->Hargas) }}
                                                </td>
                                                <td>{{ $pesanan_detail->jumlah }} Obat</td>
                                                <td>Rp. {{ number_format($pesanan_detail->jasa->Harga) }} </td>
                                                <td align="left">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}
                                                </td>
                                                <td>
                                                    <form action="{{ url('/member/check-out') }}/{{ $pesanan_detail->id }}"
                                                        method="POST">
                                                        @csrf
                                                        {{ method_field('DELETE') }}

                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Anda yakin ingin menghapus data?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                        <td></td>
                                            <td colspan="5" align="right"><strong>Total Harga:</strong></td>
                                            @php
                                            $total = 0;
                                            foreach ($pesanan_details as $pesanan_detail) {
                                                $total += $pesanan_detail->jumlah_harga;
                                            }
                                            @endphp
                                            <td><strong>Rp. {{ number_format($total) }}</strong></td>
                                            <td>
                                                <a href="{{ url('/member/konfirmasi-check-out') }}" class="btn btn-success"
                                                    onclick="return confirm('Anda yakin check out?')">
                                                    <i class="fa fa-shopping-cart"></i> Check Out
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
