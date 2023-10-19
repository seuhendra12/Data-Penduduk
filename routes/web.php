<?php

use App\Http\Controllers\PendudukController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PendudukController::class, 'index']);
Route::get('/tambah-data', [PendudukController::class, 'create']);
Route::post('/simpan-data', [PendudukController::class, 'store']);
Route::get('/ubah-data/{id}', [PendudukController::class, 'edit']);
Route::put('/ubah-data/{id}', [PendudukController::class, 'update']);
Route::get('/hapus-data/{id}', [PendudukController::class, 'destroy']);
Route::get('/data-sampah', [PendudukController::class, 'trash']);
Route::get('/pulih-data/{id}', [PendudukController::class, 'restore']);
Route::get('/hapus-data-permanen/{id}', [PendudukController::class, 'forceDelete']);