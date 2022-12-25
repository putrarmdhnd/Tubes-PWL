<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
  
    Route::get('/admin',[App\Http\Controllers\AdminController::class,'index'])->name('admin.home');
});
Route::middleware(['auth', 'perawat'])->group(function () {
  
    Route::get('/perawat',[App\Http\Controllers\PerawatController::class,'index'])->name('perawat.home');
    Route::get('/email', [App\Http\Controllers\PerawatController::class,'sentMail'])->name('email');
});
Route::middleware(['auth', 'dokter'])->group(function () {
  
    Route::get('/dokter',[App\Http\Controllers\DokterController::class,'index'])->name('dokter.home');
});