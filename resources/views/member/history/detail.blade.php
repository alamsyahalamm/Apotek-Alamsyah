@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat Pemesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-2">
                <a href="{{ url('member/history') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            @php
                $total = 0;
                foreach ($pesanan_details as $pesanan_detail) {
                    $total += $pesanan_detail->jumlah_harga;
                }
            @endphp
            <div class="col-md-12 mt-4">
                @if ($pesanan->status == 1)
                    <div class="alert alert-success" role="alert">
                        <h3>Check Out Sukses</h3>
                        <h5>Pesanan anda sudah berhasil di check out, selanjutnya untuk pembayaran silahkan transfer ke
                            rekening : </h5>
                        <h5><strong>Bank BCA : 12345678 - a/n Apotek Sehati Jaya</strong> dengan nominal : <strong>Rp.
                                {{ number_format($total) }}</strong></h5>
                        <h5></h5>
                    </div>
                @elseif ($pesanan->status == 2)
                    <div class="alert alert-success" role="alert">
                        <h3>Pesanan Diproses</h3>
                        <h5>Pembayaran sudah kami terima, selanjutnya anda tinggal menunggu pesanan anda dikirim ke
                            alamat anda</h5>
                    </div>
                @endif
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>
                        <hr>
                        @if (!empty($pesanan))
                            <div class="alert alert-secondary" role="alert">
                                @if ($pesanan->status == 1)
                                    Tanggal Pesan: <strong>{{ $pesanan->tanggal }}</strong>
                                @elseif ($pesanan->status == 2)
                                    Tanggal Bayar: <strong>{{ $pesanan->updated_at }}</strong>
                                @elseif ($pesanan->status == 4)
                                    Diterima pada: <strong>{{ $pesanan->updated_at }}</strong>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama obat</th>
                                            <th>Harga</th>
                                            <th>Jasa</th>
                                            <th class="text-end">Jumlah</th>
                                            <th class="text-end">Total</th>
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
                                                <td>Rp.
                                                    {{ number_format($pesanan_detail->obat->Hargas) }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($pesanan_detail->jasa->Harga) }}
                                                </td>
                                                <td>{{ $pesanan_detail->jumlah }} obat</td>
                                                <td>Rp. {{ number_format($pesanan_detail->jumlah_harga) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td></td>
                                            <td colspan="5" align="right"><strong>Total Harga : </strong></td>
                                            <td><strong>Rp.
                                                    {{ number_format($total) }}</strong></td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="5" align="right"><strong>Total Yang Harus Ditransfer :
                                                </strong>
                                            </td>
                                            <td><strong>Rp.
                                                    {{ number_format($total) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if ($pesanan->status == 2 || $pesanan->status == 4)
                                    <hr style="height:1px;border:none;color:#6a6a6a;background-color:#6a6a6a;">
                                    <div class="pl-4">
                                        <h5><i class="fa fa-user"></i> Informasi Penerima</h5>
                                        <br>
                                        <p>
                                            <strong>Nama Penerima : </strong>{{ Auth::user()->name }}<br>
                                            <strong>Alamat : </strong>{{ Auth::user()->alamat }}<br>
                                            <strong>No. HP : </strong>{{ Auth::user()->no_hp }}<br>
                                            <strong>Email : </strong>{{ Auth::user()->email }}<br>
                                        </p>
                                    </div>
                                @endif
                            </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('sweetalert::alert')
@endsection
