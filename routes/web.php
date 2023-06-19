<?php

use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\DistributorController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\JasaController;
// use App\Http\Controllers\LandingController;
// use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ObatController;
// use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenggunaController;
// use App\Http\Controllers\PenjualanController;
// use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
});

Auth::routes();

Route::get('/', [DashboardController::class, 'index'])->name('landing');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/member')->group(function () {

    //pesan
    Route::get('/pesan/{id}', [PesanController::class, 'index'])->name('pesan');

    // pesan obat
    Route::post('/pesan/{id}', [PesanController::class, 'pesan']);
    //pesanan diterima
    Route::post('/pesan/pesanan-diterima/{id}', [PesanController::class, 'pesan_diterima']);

    // Check out
    Route::get('/check-out', [PesanController::class, 'check_out']);
    Route::delete('check-out/{id}', [PesanController::class, 'delete']);

    // Konfirmasi check out
    Route::get('/konfirmasi-check-out', [PesanController::class, 'konfirmasi']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    // update profile
    Route::post('/profile', [ProfileController::class, 'update']);

    // history
    Route::get('/history', [HistoryController::class, 'index']);
    // detail history
    Route::get('/history/{id}', [HistoryController::class, 'detail']);
});

Route::prefix('/admin')->group(function () {

    //profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // Dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('isAdmin');

    //Pengguna (Admin)
    Route::get('/list-admin', [PenggunaController::class, 'admin'])->name('admin');;
    Route::get('/tambah-admin', [PenggunaController::class, 'tambah_admin'])->name('admin');
    Route::post('/tambah-admin', [PenggunaController::class, 'add_admin'])->name('admin');
    Route::get('/list-admin/{id}', [PenggunaController::class, 'edit_admin'])->name('admin');
    Route::post('/list-admin/{id}', [PenggunaController::class, 'update_admin']);
    Route::delete('/list-admin/{id}', [PenggunaController::class, 'delete_admin']);

    //Pengguna (Member)
    Route::get('/list-member', [PenggunaController::class, 'member'])->name('member');
    Route::delete('/list-member/{id}', [PenggunaController::class, 'delete_member']);

    //Obat
    Route::get('/tambah-obat', [ObatController::class, 'create'])->name('obat');
    Route::post('/tambah-obat', [ObatController::class, 'store']);
    Route::get('/obat', [ObatController::class, 'index'])->name('obat');
    Route::get('/obat/{id}', [ObatController::class, 'edit'])->name('obat');
    Route::post('/obat/{id}', [ObatController::class, 'update']);
    Route::delete('/obat/{id}', [ObatController::class, 'destroy']);
    Route::get('/obat/show/{id}', [ObatController::class, 'show']);


});
