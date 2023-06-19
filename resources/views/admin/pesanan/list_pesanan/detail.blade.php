@extends('layouts.admin')
@section('content')
    @php
        $total = 0;
        foreach ($pesanan_details as $pesanan_detail) {
            $total += $pesanan_detail->jumlah_harga;
        }
    @endphp
    <div class="card">
        @if (!empty($pesanan))
            <div class="alert alert-secondary" role="alert">
                Tanggal Pesan: <strong>{{ $pesanan->tanggal }}</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
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
                                    <img src="{{ url('uploads') }}/{{ $pesanan_detail->obat->Gambar }}" width="100"
                                        alt="obat">
                                </td>
                                <td>{{ $pesanan_detail->obat->Nama_Obat }}</td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->obat->Hargas) }}
                                </td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->jasa->Harga) }}
                                </td>
                                <td align="right">{{ $pesanan_detail->jumlah }} obat</td>
                                <td align="right">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td></td>
                            <td colspan="5" align="right"><strong>Total Harga : </strong></td>
                            <td align="right"><strong>Rp.
                                    {{ number_format($total) }}</strong></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="5" align="right"><strong>Total Yang Harus Ditransfer :
                                </strong>
                            </td>
                            <td align="right"><strong>Rp.
                                    {{ number_format($total) }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <div class="text-right pr-4 pb-4">
                    <a href="{{ url('admin/pesanan') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
                    <a href="#" class="btn btn-success"
                        onclick="event.preventDefault(); document.getElementById('bayar').submit();"><i
                            class="fa fa-check"></i> Sudah
                        Dibayar</a>

                    <form id="bayar" action="{{ url('admin/pesanan') }}/{{ $pesanan->id }}" method="post">
                        @csrf
                        <input type="hidden" name="status" value="2">
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
