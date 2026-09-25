<?php

namespace App\Http\Controllers;

use App\Models\Muzakki;
use App\Models\Mustahik;
use App\Models\Program;
use App\Models\Penerimaan;
use App\Models\Penyaluran;
use App\Models\User;
use App\Models\Amil;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalMuzakki = Muzakki::count();
        $totalMustahik = Mustahik::count();
        $totalProgram = Program::count();
        $totalPenerimaan = Penerimaan::where('status', 'valid')->sum('nominal');
        $totalPenyaluran = Penyaluran::whereIn('status', ['disetujui', 'direalisasi'])->sum('nominal');
        $saldo = $totalPenerimaan - $totalPenyaluran;
        $pendingPersetujuan = Penyaluran::where('status', 'diajukan')->count();

        // Variabel untuk dashboard versi terbaru
        $totalSuperAdmin = User::whereHas('role', function($q) {
            $q->where('nama_role', 'super_admin');
        })->count();

        $totalPimpinan = User::whereHas('role', function($q) {
            $q->where('nama_role', 'pimpinan');
        })->count();

        $totalAmil = Amil::count();

        // Variabel tambahan yang diminta view
        $recentUsers = User::with('role')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalMuzakki',
            'totalMustahik',
            'totalProgram',
            'totalPenerimaan',
            'totalPenyaluran',
            'saldo',
            'pendingPersetujuan',
            'totalSuperAdmin',
            'totalPimpinan',
            'totalAmil',
            'recentUsers'
        ));
    }
}