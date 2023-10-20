<?php

use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProvinsiController;
use App\Models\Provinsi;
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
// Data Provinsi
Route::resource('/provinsi', ProvinsiController::class);
Route::get('/sampah-provinsi', [ProvinsiController::class,'trash']);
Route::get('/pulih-data-provinsi/{id}', [ProvinsiController::class, 'restore']);
Route::get('/hapus-data-provinsi-permanen/{id}', [ProvinsiController::class, 'forceDelete']);

// Data Kabupaten
Route::resource('/kabupaten', KabupatenController::class);
Route::get('/sampah-kabupaten', [KabupatenController::class,'trash']);
Route::get('/pulih-data-kabupaten/{id}', [KabupatenController::class, 'restore']);
Route::get('/hapus-data-kabupaten-permanen/{id}', [KabupatenController::class, 'forceDelete']);

// Data Penduduk
Route::get('/', [PendudukController::class, 'index']);
Route::get('/tambah-data', [PendudukController::class, 'create']);
Route::post('/simpan-data', [PendudukController::class, 'store']);
Route::get('/ubah-data/{id}', [PendudukController::class, 'edit']);
Route::put('/ubah-data/{id}', [PendudukController::class, 'update']);
Route::get('/hapus-data/{id}', [PendudukController::class, 'destroy']);
Route::get('/data-sampah', [PendudukController::class, 'trash']);
Route::get('/pulih-data/{id}', [PendudukController::class, 'restore']);
Route::get('/hapus-data-permanen/{id}', [PendudukController::class, 'forceDelete']);

// Laporan
Route::get('/laporan/provinsi', [LaporanController::class,'laporanPerProvinsi']);
Route::get('/laporan/kabupaten', [LaporanController::class,'laporanPerKabupaten']);
Route::get('/cetak-laporan-per-provinsi', [LaporanController::class,'pdfLaporanPerProvinsi']);
Route::get('/cetak-laporan-per-kabupaten', [LaporanController::class,'pdfLaporanPerKabupaten']);