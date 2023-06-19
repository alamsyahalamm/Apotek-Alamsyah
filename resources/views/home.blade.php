@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                {{--  <div class="carousel-item active">
                    <img src="{{ url('img/c-1.jpeg') }}" class="img-fluid d-block w-100" alt="Responsive image carousel-1">
                </div>  --}}
                <div class="carousel-item">
                    <img src="{{ url('img/c-2.jpeg') }}" class="img-fluid d-block w-100" alt="Responsive image carousel-2">
                </div>
                <div class="carousel-item">
                    <img src="{{ url('img/c-3.jpeg') }}" class="img-fluid d-block w-100" alt="Responsive image carousel-3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 my-4">
                <h2 class="text-center">Daftar Obat</h2>
            </div>
            @foreach ($obats as $obat)
                <div class="col-md-4 p-2">
                    <a href="">
                        <div class="card">
                            <img src="{{ url('uploads') }}/{{ $obat->Gambar }}" class="card-img-top"
                                style="height: 20rem; object-fit: cover;" alt="obat">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $obat->Nama_Obat }}</h5>
                                <p class="card-text">
                                    <strong>Harga :</strong> Rp. {{ number_format($obat->Hargas) }} <br>
                                    <strong>Stok :</strong> {{ $obat->Stok }} <br>
                                </p>
                                <a href="{{ url('member/pesan') }}/{{ $obat->id }}" class="btn btn-primary"><i
                                        class="fa fa-shopping-cart"></i> Pesan</a>
                            </div>
                        </div>
                </div>
            @endforeach
            <div class="row">
                <div class="mx-auto mt-3">
                    {{ $obats->fragment('judul')->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
