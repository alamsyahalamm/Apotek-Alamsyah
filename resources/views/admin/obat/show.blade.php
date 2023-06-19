@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <section class="py-5">
                        <div class="container px-4 px-lg-5 my-5">
                            <a href="{{ url('admin/obat') }}" class="btn btn-primary d-inline-block">
                                <i class="fa fa-arrow-left fa-fw"></i>
                                Back
                            </a>
                            <div class="row gx-4 gx-lg-5 align-items-center">
                                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                                        src="{{ asset('uploads/' . $obats->Gambar) }}" alt="..." /></div>
                                <div class="col-md-6">
                                    <div class="small mb-1">{{ $obats->Kode_Obat }}</div>
                                    <h1 class="display-5 fw-bolder">{{ $obats->Nama_Obat }}</h1>
                                    <div class="fs-5 mb-3">
                                        <span class="text-decoration-line-through">Rp.
                                            {{ number_format($obats->Hargas) }}</span>
                                    </div>
                                    <h5>Stok : {{ $obats->Stok }}</h5>
                                    <br>
                                    <h5>Bentuk_Obat.</h5>
                                    <p class="lead">{{ $obats->Bentuk_Obat }}</p>
                                    <h5>Kontra_Indikasi.</h5>
                                    <p class="lead">{{ $obats->Kontra_Indikasi }}</p>
                                    <h5>Indikasi.</h5>
                                    <p class="lead">{{ $obats->Indikasi }}</p>
                                    <h5>Aturan.</h5>
                                    <p class="lead">{{ $obats->Aturan }}</p>
                                    <h5>Tanggal Masuk.</h5>
                                    <p class="lead">{{ $obats->Tgl_Masuk }}</p>
                                    <h5>Tanggal Kadaluwarsa.</h5>
                                    <p class="lead">{{ $obats->Tgl_Kadaluarsa }}</p>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
