<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\InsertTriwulanController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Models\SetoranModel;
use Illuminate\Support\Facades\DB;
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

Route::get('/',[DashboardController::class,'index'])->middleware('auth');
// Route::get('/',[DashboardController::class,'index']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/authenticate', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);



// Route::resource('/setoran', SetoranController::class);



Route::get('nama_pemda', [SetoranController::class,'getNamaPemda'])->name('nama_pemda');

//jalankan di tanggal 31 maret
Route::get('triwulan1', [InsertTriwulanController::class,'insertTriwulan1']);
//jalankan di tanggal 30 Juni
Route::get('triwulan2', [InsertTriwulanController::class,'insertTriwulan2']);
//jalankan di tanggal 30 September
Route::get('triwulan3', [InsertTriwulanController::class,'insertTriwulan3']);

//jalankan di tanggal 31 Desember
Route::get('triwulan4', [InsertTriwulanController::class,'insertTriwulan4']);
Route::get('tonextyear', [InsertTriwulanController::class,'toNextYear']);
// batas akhir


// Route::get('/statistik',[StatistikController::class,'index']);

Route::get('/aktivitas',[AktivitasController::class,'index'])->middleware('auth');


Route::resource('/histories', HistoriesController::class)->middleware('auth');



Route::post('/aktivitas', [AktivitasController::class, 'store'])->middleware('auth');

// Route::get('/report', [ReportController::class, 'index'])->middleware('auth');
Route::get('/report', [ReportController::class, 'index']);

Route::get('/printlaporan', [ReportController::class, 'printlaporan']);

Route::get('/exportexcel', [ReportController::class, 'exportexcel']);

Route::get('/freezetable', [ReportController::class, 'freezetable']);







