<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FasyankesController;
use Illuminate\Support\Facades\Route;

// ── Public (Fasyankes) ────────────────────────────────────────────────────────
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::post('/tracking',  [PengajuanController::class, 'tracking'])->name('pengajuan.tracking');

// ── Admin ─────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/fasyankes',                        [FasyankesController::class, 'index'])->name('fasyankes.index');
        Route::get('/fasyankes/{pengajuan}',            [FasyankesController::class, 'show'])->name('fasyankes.show');
        Route::get('/fasyankes/{pengajuan}/data',       [FasyankesController::class, 'getData'])->name('fasyankes.data');
        Route::patch('/fasyankes/{pengajuan}/penjadwalan', [FasyankesController::class, 'updatePenjadwalan'])->name('fasyankes.penjadwalan');
        Route::patch('/fasyankes/{pengajuan}/langsungKunjungan',   [FasyankesController::class, 'updateLangsungKunjungan'])->name('fasyankes.langsung_kunjungan');
        Route::patch('/fasyankes/{pengajuan}/kunjungan',   [FasyankesController::class, 'updateKunjungan'])->name('fasyankes.kunjungan');
        Route::patch('/fasyankes/{pengajuan}/ttd',         [FasyankesController::class, 'updateTtd'])->name('fasyankes.ttd');
        Route::patch('/fasyankes/{pengajuan}/selesai',     [FasyankesController::class, 'updateSelesai'])->name('fasyankes.selesai');
        Route::get('/fasyankes/dokumen/download/{path}', [FasyankesController::class, 'downloadDokumen'])->name('fasyankes.dokumen.download');
    });
});