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


Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/users', UserController::class);
Route::get('/laporan', LaporanController::class);
Route::get('/ruang-parkir', RuangParkirController::class);
Route::get('/parkiran', ParkirViewController::class);


Route::get('/parkiran/masuk', ParkirMasukController::class);

Route::get('/parkiran/keluar', ParkirKeluarController::class);

Route::get('/parkiran/set-ruang', ParkirRuangController::class);
