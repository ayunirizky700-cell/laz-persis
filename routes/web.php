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

// Rute utama: Kalau sudah login ke dashboard, kalau belum ke login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// ==========================================
// PAGAR 0: BISA DIAKSES SEMUA YANG SUDAH LOGIN (Tanpa cek role)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Dashboard dan Profile aman di sini, gak akan kena 403
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// PAGAR 1: Bisa diakses SEMUA ROLE (1=Admin, 2=Amil, 3=Pimpinan)
// ==========================================
Route::middleware(['auth', 'role:1,2,3'])->group(function () {
    // Modul Master Data
    Route::resource('program', ProgramController::class);
    Route::resource('muzakki', MuzakkiController::class);
    Route::resource('mustahik', MustahikController::class);
    Route::post('mustahik/{mustahik}/verifikasi', [MustahikController::class, 'verifikasi'])->name('mustahik.verifikasi');

    // Modul Penerimaan & Penyaluran
    Route::resource('penerimaan', PenerimaanController::class);
    Route::post('penerimaan/{penerimaan}/validasi', [PenerimaanController::class, 'validasi'])->name('penerimaan.validasi');

    Route::resource('penyaluran', PenyaluranController::class);
    Route::post('penyaluran/{penyaluran}/ajukan', [PenyaluranController::class, 'ajukan'])->name('penyaluran.ajukan');
    Route::post('penyaluran/{penyaluran}/realisasi', [PenyaluranController::class, 'realisasi'])->name('penyaluran.realisasi');
});

// ==========================================
// PAGAR 2: KHUSUS SUPER ADMIN (Role 1)
// ==========================================
Route::middleware(['auth', 'role:1'])->group(function () {
    // Modul Amil (Manajemen User)
    Route::resource('amil', AmilController::class);
});

// ==========================================
// PAGAR 3: KHUSUS SUPER ADMIN & PIMPINAN (Role 1 & 3)
// ==========================================
Route::middleware(['auth', 'role:1,3'])->group(function () {
    // Modul Persetujuan
    Route::get('persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan.index');
    Route::get('persetujuan/{id}', [PersetujuanController::class, 'show'])->name('persetujuan.show');
    Route::post('persetujuan/{id}/approve', [PersetujuanController::class, 'approve'])->name('persetujuan.approve');
    Route::post('persetujuan/{id}/reject', [PersetujuanController::class, 'reject'])->name('persetujuan.reject');

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