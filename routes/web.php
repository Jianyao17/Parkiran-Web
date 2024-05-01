<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\RuangParkirController;
use App\Http\Controllers\Admin\ParkirViewController;

use App\Http\Controllers\Parkiran\ParkirKeluarController;
use App\Http\Controllers\Parkiran\ParkirMasukController;
use App\Http\Controllers\Parkiran\ParkirRuangController;

use App\Http\Controllers\LoginController;
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


Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


// Admin Route
Route::middleware(['auth', 'user-role:Admin'])->group(function() {
    
    Route::get('/users', UserController::class);
    Route::get('/laporan', LaporanController::class);
    Route::get('/ruang-parkir', RuangParkirController::class);
    Route::get('/parkiran', ParkirViewController::class);
});

// Petugas Masuk Route
Route::middleware(['auth', 'user-role:Petugas-Masuk'])->group(function() {
    Route::get('/parkiran/masuk', ParkirMasukController::class);
});

// Petugas Keluar
Route::middleware(['auth', 'user-role:Petugas-Keluar'])->group(function() {
    Route::get('/parkiran/keluar', ParkirKeluarController::class);
});

// Petugas Ruang
Route::middleware(['auth', 'user-role:Petugas-Ruang'])->group(function() {
    Route::get('/parkiran/set-ruang', ParkirRuangController::class);
});
