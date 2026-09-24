<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PenerimaanController;
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
});

require __DIR__ . '/auth.php';