<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PenyaluranController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MuzakkiController;
use App\Http\Controllers\MustahikController;
use App\Http\Controllers\AmilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => redirect('/login'));

// Rute utama: Cek apakah sudah login atau belum
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard'); // Kalau sudah login, ke Dashboard
    }
    return redirect()->route('login'); // Kalau belum login, ke Login
});

Route::middleware('auth')->group(function () {
    // Rute Dashboard (yang sempat hilang)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Modul Program
    Route::resource('program', ProgramController::class);

    // Modul Master Data
    Route::resource('muzakki', MuzakkiController::class);
    Route::resource('mustahik', MustahikController::class);
    Route::post('mustahik/{mustahik}/verifikasi', [MustahikController::class, 'verifikasi'])
        ->name('mustahik.verifikasi');
    Route::resource('amil', AmilController::class);

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

    // Modul Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/penerimaan', [LaporanController::class, 'penerimaan'])->name('laporan.penerimaan');
    Route::get('laporan/penyaluran', [LaporanController::class, 'penyaluran'])->name('laporan.penyaluran');
    Route::get('laporan/program', [LaporanController::class, 'program'])->name('laporan.program');
    Route::get('laporan/rekap-saldo', [LaporanController::class, 'rekapSaldo'])->name('laporan.rekap-saldo');

    // Export PDF
    Route::get('laporan/penerimaan/pdf', [LaporanController::class, 'penerimaanPdf'])->name('laporan.penerimaan.pdf');
    Route::get('laporan/penyaluran/pdf', [LaporanController::class, 'penyaluranPdf'])->name('laporan.penyaluran.pdf');
    Route::get('laporan/program/pdf', [LaporanController::class, 'programPdf'])->name('laporan.program.pdf');
    Route::get('laporan/rekap-saldo/pdf', [LaporanController::class, 'rekapSaldoPdf'])->name('laporan.rekap-saldo.pdf');
    Route::get('laporan/muzakki/pdf', [LaporanController::class, 'muzakkiPdf'])->name('laporan.muzakki.pdf');
    Route::get('laporan/mustahik/pdf', [LaporanController::class, 'mustahikPdf'])->name('laporan.mustahik.pdf');
});


require __DIR__ . '/auth.php';