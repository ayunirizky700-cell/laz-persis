<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PenyaluranController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => redirect('/login'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modul Program
    Route::resource('program', ProgramController::class);

    // Modul Penerimaan
    Route::resource('penerimaan', PenerimaanController::class);
    Route::post('penerimaan/{penerimaan}/validasi', [PenerimaanController::class, 'validasi'])
        ->name('penerimaan.validasi');

    // Modul Penyaluran
    Route::resource('penyaluran', PenyaluranController::class);
    Route::post('penyaluran/{penyaluran}/ajukan', [PenyaluranController::class, 'ajukan'])
        ->name('penyaluran.ajukan');
    Route::post('penyaluran/{penyaluran}/realisasi', [PenyaluranController::class, 'realisasi'])
        ->name('penyaluran.realisasi');

    // Modul Persetujuan
    Route::get('persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan.index');
    Route::get('persetujuan/{persetujuan}', [PersetujuanController::class, 'show'])->name('persetujuan.show');
    Route::post('persetujuan/{persetujuan}/approve', [PersetujuanController::class, 'approve'])->name('persetujuan.approve');
    Route::post('persetujuan/{persetujuan}/reject', [PersetujuanController::class, 'reject'])->name('persetujuan.reject');
});

require __DIR__ . '/auth.php';