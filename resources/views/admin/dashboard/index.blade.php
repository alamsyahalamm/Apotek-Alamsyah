@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User</h4>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0">{{ $totaluser }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Obat</h4>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0">{{ $totalobat }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Distributor</h4>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0">{{ $totalobat }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-cart-shopping"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0">{{ $totalpesanan }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-cart-shopping"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pembelian</h4>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0">{{ $totalpembelian }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-cart-shopping"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Penjualan</h4>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0">{{ $totalpenjualan }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
