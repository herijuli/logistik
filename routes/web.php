<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\StokController;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('master');
});

Route::resource('barangmasuk',BarangMasukController::class);


Route::resource('barangkeluar',BarangKeluarController::class);

Route::resource('stok',StokController::class);

Route::get('cari-stok',[StokController::class,'finds'])->name('cari-stok');

Route::get('cari-barang',[BarangMasukController::class,'finds'])->name('cari-barang-masuk');

Route::get('cari-barang-keluar',[BarangKeluarController::class,'finds'])->name('cari-barang-keluar');
