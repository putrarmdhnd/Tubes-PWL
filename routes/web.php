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

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

    Route::get('/admin/input-user', [App\Http\Controllers\AdminController::class, 'input'])->name('admin.input');
    Route::post('/admin/submit-data', [App\Http\Controllers\AdminController::class, 'submit_data'])->name('admin.submit');

    Route::patch('admin/users/update', [App\Http\Controllers\AdminController::class, 'update_user'])->name('admin.user.update');
    Route::get('admin/ajaxadmin/dataUser/{id}', [App\Http\Controllers\AdminController::class, 'getDataUser']);


    
    
    //Export PDF
    Route::get('/exportPDF', [App\Http\Controllers\AdminController::class, 'exportPDF'])->name('admin.export');

    
    Route::post('admin/users/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_user'])->name('admin.user.delete');

});
Route::middleware(['auth', 'perawat'])->group(function () {

    Route::get('/perawat', [App\Http\Controllers\PerawatController::class, 'index'])->name('perawat.home');

    Route::get('/perawat/input-pasien', [App\Http\Controllers\PerawatController::class, 'pasiendata'])->name('perawat.input');
    Route::post('/perawat/submit-pasien', [App\Http\Controllers\PerawatController::class, 'submit_data'])->name('perawat.submit');

    Route::patch('perawat/update-pasien', [App\Http\Controllers\PerawatController::class, 'update_data'])->name('perawat.update');
    Route::get('perawat/ajaxadmin/dataPasien/{id}', [App\Http\Controllers\PerawatController::class, 'getDataPasien']);

    Route::post('perawat/pasien/delete/{id}', [App\Http\Controllers\PerawatController::class, 'delete_pasien'])->name('admin.book.delete');

    Route::get('/data-dokter', [App\Http\Controllers\PerawatController::class, 'dokter_data'])->name('dokter.home');
    Route::get('/{id}/pasien', [App\Http\Controllers\PerawatController::class, 'sortir_pasien']);
    
    //pdf
    Route::get('/exportpdf', [App\Http\Controllers\PerawatController::class, 'exportpdf'])->name('perawat.export');
    
    //recycle bin
    Route::get('/recycle_bin',[App\Http\Controllers\PerawatController::class,'recycle_bin'])->name('recycle.bin');
    Route::get('perawat/restore/{id?}', [App\Http\Controllers\PerawatController::class,'restore']);
    Route::get('perawat/delete/{id?}', [App\Http\Controllers\PerawatController::class,'delete']);


    //halaman pemeriksaan
    Route::get('/data-pemeriksaan', [App\Http\Controllers\PerawatController::class, 'pemeriksaan_data'])->name('pemeriksaan.home');
    Route::post('perawat/periksa/delete/{id}', [App\Http\Controllers\PerawatController::class, 'delete_pemeriksaan']);
    Route::get('/recycle_bin_pemeriksaan',[App\Http\Controllers\PerawatController::class,'recycle_bin_pemeriksaan'])->name('bin.recycle');
    Route::get('perawat/restore_pemeriksaan/{id?}', [App\Http\Controllers\PerawatController::class,'restore_pemeriksaan']);
    Route::get('perawat/delete_periksa/{id?}', [App\Http\Controllers\PerawatController::class,'delete_periksa']);
    Route::get('/exportpdf1', [App\Http\Controllers\PerawatController::class, 'exportpdf1'])->name('perawat.export1');

    //halaman rawat inap
    Route::get('/data-pemeriksaan', [App\Http\Controllers\PerawatController::class, 'pemeriksaan_data'])->name('pemeriksaan.home');
    
});

Route::middleware(['auth', 'dokter'])->group(function () {

    Route::get('/dokter', [App\Http\Controllers\DokterController::class, 'index'])->name('dokter.home');
    Route::get('/pemeriksaan', [App\Http\Controllers\DokterController::class, 'Pemeriksaan'])->name('dokter.pemeriksaan');

    Route::post('/tambah-pemeriksaan', [App\Http\Controllers\DokterController::class, 'tambah_data'])->name('dokter.pemeriksaan.tambah');
    Route::get('pemeriksaan/ajaxadmin/dataPasien/{id}', [App\Http\Controllers\DokterController::class, 'getDataPasien']);
});
