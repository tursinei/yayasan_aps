<?php

use App\Http\Controllers\AnakAsuhController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\KegiatanController;
use App\Http\Controllers\Master\ProgramController;
use App\Http\Controllers\UsersController;
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

require __DIR__.'/auth.php';
