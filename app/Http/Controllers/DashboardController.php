<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penerimaan;
use App\Models\Penyaluran;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Keuangan
        $totalPenerimaan = Penerimaan::sum('nominal') ?? 0;
        $totalPenyaluran = Penyaluran::sum('nominal') ?? 0;
        $saldo = $totalPenerimaan - $totalPenyaluran;

        // 2. Data User
        $totalPengguna = User::count();
        $totalSuperAdmin = User::where('role_id', 1)->count();
        $totalAmil = User::where('role_id', 2)->count();
        $totalPimpinan = User::where('role_id', 3)->count();

        // 3. Ambil Role User yang sedang login
        $role_id = auth()->user()->role_id;

        return view('dashboard', compact(
            'totalPenerimaan',
            'totalPenyaluran',
            'saldo',
            'totalPengguna',
            'totalSuperAdmin',
            'totalPimpinan',
            'totalAmil',
            'role_id'
        ));
    }
}