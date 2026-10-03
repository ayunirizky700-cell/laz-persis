<?php

namespace App\Http\Controllers;

use App\Models\Persetujuan;
use App\Models\Penyaluran;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function index()
    {
        $persetujuan = Penyaluran::with(['program', 'mustahik'])
            ->whereIn('status', ['diajukan', 'disetujui', 'ditolak'])
            ->latest()
            ->paginate(10);

        return view('persetujuan.index', compact('persetujuan'));
    }

    public function show($id)
    {
        $persetujuan = Penyaluran::with(['program', 'mustahik'])->findOrFail($id);
        return view('persetujuan.show', compact('persetujuan'));
    }

    public function approve(Request $request, $id)
    {
        $penyaluran = Penyaluran::findOrFail($id);
        $penyaluran->update(['status' => 'disetujui']);

        // Update record persetujuan juga (kalau ada)
        Persetujuan::where('referensi_tipe', 'penyaluran')
            ->where('referensi_id', $penyaluran->id)
            ->update([
                'status' => 'disetujui',
                'approved_at' => now(),
            ]);

        ActivityLog::catat('approve', 'penyaluran', 'Setujui: ' . $penyaluran->nomor_transaksi, $penyaluran->id);

        return redirect()->route('persetujuan.index')->with('success', 'Pengajuan disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $penyaluran = Penyaluran::findOrFail($id);
        $penyaluran->update(['status' => 'ditolak']);

        Persetujuan::where('referensi_tipe', 'penyaluran')
            ->where('referensi_id', $penyaluran->id)
            ->update([
                'status' => 'ditolak',
                'approved_at' => now(),
            ]);

        ActivityLog::catat('reject', 'penyaluran', 'Tolak: ' . $penyaluran->nomor_transaksi, $penyaluran->id);

        return redirect()->route('persetujuan.index')->with('success', 'Pengajuan ditolak.');
    }
}