<?php

use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\DaftarBarangController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Route;


//Route untuk home

Route::middleware(['web'])->group(function () {
    Route::get('home',[HomePageController::class, 'index'])->name('home');
    
    //Route untuk jenis barang
    Route::get('jenis_barang', [JenisBarangController::class, 'index'])->name('jenis_barang.index');
    Route::get('jenis_barang/create', [JenisBarangController::class, 'create'])->name('jenis_barang.create');
    Route::post('jenis_barang', [JenisBarangController::class, 'store'])->name('jenis_barang.store');
    Route::get('jenis_barang/{jns_brg_kode}', [JenisBarangController::class, 'edit'])->name('jenis_barang.edit');
    Route::patch('jenis_barang/{jns_brg_kode}', [JenisBarangController::class, 'update'])->name('jenis_barang.update');
    Route::delete('jenis_barang/{jns_brg_kode}', [JenisBarangController::class, 'destroy'])->name('jenis_barang.destroy');
    
    //Route untuk daftar barang
    Route::get('barang', [BarangInventarisController::class, 'index'])->name('barang.index');
    Route::get('barang/create', [BarangInventarisController::class, 'create'])->name('barang.create');
    Route::post('barang/store', [BarangInventarisController::class, 'store'])->name('barang.store');
    Route::get('barang/{br_kode}', [BarangInventarisController::class, 'edit'])->name('barang.edit');
    Route::patch('barang/{br_kode}', [BarangInventarisController::class, 'update'])->name('barang.update');
    Route::delete('barang/{br_kode}', [BarangInventarisController::class, 'destroy'])->name('barang.destroy');
    Route::post('/', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //Route Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}/detail', [PeminjamanController::class, 'detail'])->name('peminjaman.detail');
    
    Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
});

    //Route Pengembalian
    


Route::view('/', 'auth.login')->name('login');  