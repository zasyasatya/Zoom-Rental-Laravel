<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect(route('login')); 
});

Auth::routes(['verify'=>true]);

Route::prefix('home')->middleware(['auth','verified'])->group(function () {
    // Buat route didalam ini, jangan diluar
    Route::prefix('staff')->middleware(['staff'])->group(function () { 
        // Untuk fitur staff, silahkan buat route disini
        Route::prefix('zoom')->group(function () {
            Route::get('/', [App\Http\Controllers\ZoomController::class, 'index'])->name('zoom.index');
            Route::get('create', [App\Http\Controllers\ZoomController::class, 'create'])->name('zoom.create');
            Route::post('store', [App\Http\Controllers\ZoomController::class, 'store'])->name('zoom.store');
            Route::get('edit/{id}', [App\Http\Controllers\ZoomController::class, 'edit'])->name('zoom.edit');
            Route::post('update', [App\Http\Controllers\ZoomController::class, 'update'])->name('zoom.update');
            Route::get('delete/{id}', [App\Http\Controllers\ZoomController::class, 'destroy'])->name('zoom.delete');
            Route::get('sampah', [App\Http\Controllers\ZoomController::class, 'sampah'])->name('zoom.sampah');
            Route::get('/recover/{id}', [App\Http\Controllers\ZoomController::class,'recover'])->name('zoom.recover');
            Route::get('/recoverall', [App\Http\Controllers\ZoomController::class,'recoverall'])->name('zoom.recoverall');
            Route::get('/dltperm/{id}', [App\Http\Controllers\ZoomController::class,'hapuspermanen'])->name('zoom.hapuspermanen');
            Route::get('/deleteall', [App\Http\Controllers\ZoomController::class,'hapussemua'])->name('zoom.hapussemua');
        });
        
        Route::prefix('peminjaman')->group(function () {
            Route::get('/', [App\Http\Controllers\PeminjamanController::class, 'index'])->name('peminjaman.index');
            Route::get('create',[App\Http\Controllers\PeminjamanController::class,'create'])->name('peminjaman.create');
            Route::post('store', [App\Http\Controllers\PeminjamanController::class, 'store'])->name('peminjaman.store');
            Route::get('edit/{id}', [App\Http\Controllers\PeminjamanController::class, 'edit'])->name('peminjaman.edit');
            Route::post('update', [App\Http\Controllers\PeminjamanController::class, 'update'])->name('peminjaman.update');
            Route::get('delete/{id}', [App\Http\Controllers\PeminjamanController::class, 'destroy'])->name('peminjaman.delete');
            Route::put('reject', [App\Http\Controllers\PeminjamanController::class, 'reject'])->name('peminjaman.reject');
            Route::get('showApprove/{id}', [App\Http\Controllers\PeminjamanController::class, 'showApprove'])->name('peminjaman.showApprove');
            Route::put('approve', [App\Http\Controllers\PeminjamanController::class, 'approve'])->name('peminjaman.approve');
        });
    });
    
    Route::prefix('mahasiswa')->middleware(['mahasiswa'])->group(function () {
        // Untuk fitur mahasiswa, silahkan buat route disini
        Route::prefix('pengajuan-peminjaman')->group(function () {
            Route::get('/', [App\Http\Controllers\PengajuanPeminjamanController::class, 'index'])->name('pengajuan.index');
            Route::get('create', [App\Http\Controllers\PengajuanPeminjamanController::class, 'create'])->name('pengajuan.create');
            Route::post('store', [App\Http\Controllers\PengajuanPeminjamanController::class, 'store'])->name('pengajuan.store');
            Route::get('delete/{id}', [App\Http\Controllers\PengajuanPeminjamanController::class, 'destroy'])->name('pengajuan.delete');
            Route::post('done', [App\Http\Controllers\PengajuanPeminjamanController::class, 'done'])->name('pengajuan.done');
        });
        Route::prefix('zoom')->group(function () {
            Route::get('/', [App\Http\Controllers\ZoomController::class, 'mindex'])->name('zoom.mindex');
        });
    });
    
    // Bisa diakses oleh semua, (staff dan mahasiswa)
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('jadwal-peminjaman', [App\Http\Controllers\JadwalController::class, 'index'])->name('jadwal.index');
});
