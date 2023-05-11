<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboasrdController;

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

Route::get('/dashboard', [DashboasrdController::class, 'index']);

Route::get('/guru',[DashboasrdController::class, 'guru']);


Route::get('/siswa',[DashboasrdController::class,'siswa']);


Route::get('/tahun-akademik',[DashboasrdController::class, 'akademik']);


Route::get('/mata-pelajaran', [DashboasrdController::class, 'mapel']);
