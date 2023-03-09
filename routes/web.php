<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RombelController;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    toast('Berhasil Logout', 'success');
    return view('auth.login');
});

Auth::routes();

route::resource('siswa', SiswaController::class);
route::resource('rombel', RombelController::class);
route::resource('pembayaran', PembayaranController::class);
route::resource('petugas', PetugasController::class);
route::resource('spp', SppController::class);
route::resource('history', HistoryController::class);

Route::resource('Pembayaran', PembayaranController::class);
Route::get('pembayaran/getDataSiswa/{nisn}', [PembayaranController::class, 'getDataSiswa'])->name('Pembayaran.getDataSiswa');
Route::get('pembayaran/getData/{nisn}/{berapa}', [PembayaranController::class, 'getData'])->name('pembayaran.getData');


Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  

Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    
});
  
Route::middleware(['auth', 'user-access:petugas'])->group(function () {
  
    Route::get('/petugas/home', [HomeController::class, 'petugasHome'])->name('petugas.home');
});

