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
    Route::get('/admin/input-user',[App\Http\Controllers\AdminController::class,'input'])->name('admin.input');
});
Route::middleware(['auth', 'perawat'])->group(function () {
  
    Route::get('/perawat',[App\Http\Controllers\PerawatController::class,'index'])->name('perawat.home');

    Route::get('/perawat/input-pasien',[App\Http\Controllers\PerawatController::class,'pasiendata'])->name('perawat.input');
    Route::post('/perawat/submit-pasien',[App\Http\Controllers\PerawatController::class,'submit_data'])->name('perawat.submit');

    Route::patch('perawat/update-pasien', [App\Http\Controllers\PerawatController::class, 'update_data'])->name('perawat.update');
    Route::get('perawat/ajaxadmin/dataPasien/{id}', [App\Http\Controllers\PerawatController::class, 'getDataPasien']);

    Route::post('perawat/pasien/delete/{id}', [App\Http\Controllers\PerawatController::class, 'delete_pasien'])->name('admin.book.delete');
    

    Route::get('perawat/print_data_pasien', [App\Http\Controllers\PerawatController::class, 'print_data_pasien'])->name('perawat.print.pasien');
    
    Route::get('/email', [App\Http\Controllers\PerawatController::class,'sentMail'])->name('email');

});
Route::middleware(['auth', 'dokter'])->group(function () {
  
    Route::get('/dokter',[App\Http\Controllers\DokterController::class,'index'])->name('dokter.home');
});
