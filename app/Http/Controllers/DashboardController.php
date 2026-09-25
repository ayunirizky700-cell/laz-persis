<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total user per role
        $totalUsers = User::count();

        $totalSuperAdmin = User::whereHas('role', function ($q) {
            $q->where('nama_role', 'super_admin');
        })->count();

        $totalPimpinan = User::whereHas('role', function ($q) {
            $q->where('nama_role', 'pimpinan');
        })->count();

        $totalAmil = User::whereHas('role', function ($q) {
            $q->where('nama_role', 'admin_amil');
        })->count();

        // Data user terbaru
        $recentUsers = User::with('role')->latest()->take(5)->get();

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
            'totalSuperAdmin',
            'totalPimpinan',
            'totalAmil',
            'recentUsers'
        ));
    }
}