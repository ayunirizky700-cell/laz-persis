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
        $persetujuan = \App\Models\Penyaluran::with(['program', 'mustahik'])
            ->latest()
            ->paginate(5);

        return view('persetujuan.index', compact('persetujuan'));
    }
    public function show(Persetujuan $persetujuan)
    {
        $persetujuan->load(['penyaluran.program', 'penyaluran.mustahik', 'approver']);
        return view('persetujuan.show', compact('persetujuan'));
    }

    public function approve(Request $request, Persetujuan $persetujuan)
    {
        if (!auth()->user()->isPimpinan() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Hanya Pimpinan yang bisa approve.');
        }

        $request->validate(['catatan' => 'nullable|string']);

        $persetujuan->update([
            'status' => 'disetujui',
            'catatan' => $request->catatan,
            'approved_at' => now(),
        ]);

        // Update status penyaluran
        $penyaluran = Penyaluran::find($persetujuan->referensi_id);
        if ($penyaluran && $penyaluran->status === 'diajukan') {
            $penyaluran->update(['status' => 'disetujui']);
        }

        ActivityLog::catat(
            'approve',
            'persetujuan',
            'Setujui penyaluran: ' . ($penyaluran->nomor_transaksi ?? ''),
            $persetujuan->id
        );

        return redirect()->route('persetujuan.index')
            ->with('success', 'Pengajuan disetujui.');
    }

    public function reject(Request $request, Persetujuan $persetujuan)
    {
        if (!auth()->user()->isPimpinan() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Hanya Pimpinan yang bisa reject.');
        }

        $request->validate(['catatan' => 'required|string']);

        $persetujuan->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
            'approved_at' => now(),
        ]);

        $penyaluran = Penyaluran::find($persetujuan->referensi_id);
        if ($penyaluran) {
            $penyaluran->update([
                'status' => 'ditolak',
                'keterangan' => $request->catatan,
            ]);
        }

        ActivityLog::catat(
            'reject',
            'persetujuan',
            'Tolak penyaluran: ' . ($penyaluran->nomor_transaksi ?? ''),
            $persetujuan->id
        );

        return redirect()->route('persetujuan.index')
            ->with('success', 'Pengajuan ditolak.');
    }
}