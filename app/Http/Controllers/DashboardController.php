<?php
namespace App\Http\Controllers;

use App\Models\Muzakki;
use App\Models\Mustahik;
use App\Models\Program;
use App\Models\Penerimaan;
use App\Models\Penyaluran;
use App\Models\User;

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

        return view('dashboard', compact(
            'totalUsers',
            'totalMuzakki',
            'totalMustahik',
            'totalProgram',
            'totalPenerimaan',
            'totalPenyaluran',
            'saldo',
            'pendingPersetujuan'
        ));
    }
}