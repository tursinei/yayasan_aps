<?php

use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\CalonYatamaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\KegiatanController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Master\KuratorController;
use App\Http\Controllers\Master\ProgramController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VerifikasiController;
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
    return view('login');
});

Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');//->middleware(['auth'])

Route::resource('user', UsersController::class);
Route::resource('yatama', AnakAsuhController::class);
Route::resource('program', ProgramController::class);
Route::resource('kegiatan', KegiatanController::class);
Route::resource('kurator', KuratorController::class);
Route::resource('kelas', KelasController::class);
Route::resource('calonyatama',CalonYatamaController::class);
Route::resource('verifikasi',VerifikasiController::class);
Route::resource('pendidikan',PendidikanController::class);
Route::resource('rekammedis',RekamMedisController::class);
Route::get('pendaftaran', [CalonYatamaController::class, 'pendaftaran'])->name('calonyatama.pendaftaran');


require __DIR__.'/auth.php';
