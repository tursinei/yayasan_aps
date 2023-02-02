<?php

use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\CalonYatamaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\KegiatanController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Master\ProgramController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;

/*
,--------------------------------------------------------------------------
, Web Routes
,--------------------------------------------------------------------------
,
, Here is where you can register web routes for your application. These
, routes are loaded by the RouteServiceProvider within a group which
, contains the "web" middleware group. Now create something great!
,
*/

Route::get('/', function () {
    return view('login');
})->middleware('guest');
Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');
    Route::get('/dashboard/jumlah', [HomeController::class,'jumlah'])->name('dashboard.jumlah');
    Route::get('formProfile/{users}', [UsersController::class,'edit'])->name('profile.form');
    Route::post('simpanProfile',[UsersController::class,'store'])->name('profile.simpan');
});
Route::middleware(['auth','role:admin'])->group(function(){
    Route::resource('user', UsersController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('kegiatan', KegiatanController::class);
    // Route::resource('kurator', KuratorController::class);
    Route::resource('kelas', KelasController::class);
});

Route::middleware(['auth','role:admin,kordes,humas'])->group(function(){
    Route::resource('pendidikan',PendidikanController::class);
    Route::resource('yatama', AnakAsuhController::class);
});
Route::middleware(['auth','role:admin,kordes,humas,kesehatan'])->group(function(){
    Route::get('pendaftaran', [CalonYatamaController::class, 'pendaftaran'])->name('calonyatama.pendaftaran');
    Route::resource('calonyatama',CalonYatamaController::class);
    Route::resource('rekammedis',RekamMedisController::class);
});
Route::middleware(['auth','role:admin,sekretaris'])->group(function(){
    Route::resource('verifikasi',VerifikasiController::class);
});

Route::middleware(['auth','role:admin,bendahara'])->group(function(){
    Route::resource('rab',RabController::class);
    Route::resource('kas/pemasukan',PemasukanController::class);
    Route::resource('kas/pengeluaran',PengeluaranController::class);
});
// laporan
Route::middleware(['auth','role:admin,pengurus,kordes,sekretaris,bendahara,humas'])->group(function(){
    Route::resource('rab',RabController::class);
});
Route::middleware(['auth','role:admin,kesehatan'])->group(function(){
    Route::resource('rab',RabController::class);
});


require __DIR__.'/auth.php';
