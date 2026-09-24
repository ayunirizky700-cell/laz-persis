<?php
namespace App\Http\Controllers;

use App\Models\Penyaluran;
use App\Models\Mustahik;
use App\Models\Program;
use App\Models\Persetujuan;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyaluranController extends Controller
{

    public function index(Request $request)
    {
        $query = Penyaluran::with(['program', 'mustahik']);

        if ($request->filled('search')) {
            $query->where('nomor_transaksi', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status'))
            $query->where('status', $request->status);

        $penyaluran = $query->latest()->paginate(10);
        return view('penyaluran.index', compact('penyaluran'));
    }

    public function create()
    {
        $program = Program::where('status', 'aktif')->get();
        $mustahik = Mustahik::where('status_verifikasi', 'terverifikasi')->get();
        return view('penyaluran.create', compact('program', 'mustahik'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'program_id' => 'required|exists:program,id',
            'mustahik_id' => 'required|exists:mustahik,id',
            'jenis_bantuan' => 'required|in:uang,barang,jasa,beasiswa,sembako',
            'nominal' => 'required|numeric|min:1000',
            'deskripsi_bantuan' => 'nullable|string',
            'bukti_penyaluran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('bukti_penyaluran')) {
            $validated['bukti_penyaluran'] = $request->file('bukti_penyaluran')
                ->store('bukti-penyaluran', 'public');
        }

        $validated['status'] = 'draft';
        $penyaluran = Penyaluran::create($validated);

        ActivityLog::catat(
            'create',
            'penyaluran',
            'Tambah penyaluran: ' . $penyaluran->nomor_transaksi,
            $penyaluran->id
        );

        return redirect()->route('penyaluran.index')
            ->with('success', 'Penyaluran dibuat (draft). Ajukan ke pimpinan untuk disetujui.');
    }

    public function show(Penyaluran $penyaluran)
    {
        $penyaluran->load(['program', 'mustahik', 'persetujuan.approver']);
        return view('penyaluran.show', compact('penyaluran'));
    }

    public function ajukan(Penyaluran $penyaluran)
    {
        if ($penyaluran->status !== 'draft') {
            return back()->with('error', 'Hanya draft yang bisa diajukan.');
        }

        $penyaluran->update(['status' => 'diajukan']);

        // Buat record persetujuan untuk semua pimpinan
        $pimpinan = User::whereHas('role', fn($q) => $q->where('nama_role', 'pimpinan'))->get();
        foreach ($pimpinan as $p) {
            Persetujuan::create([
                'referensi_tipe' => 'penyaluran',
                'referensi_id' => $penyaluran->id,
                'approver_id' => $p->id,
                'status' => 'pending',
            ]);
        }

        ActivityLog::catat(
            'ajukan',
            'penyaluran',
            'Ajukan: ' . $penyaluran->nomor_transaksi,
            $penyaluran->id
        );

        return redirect()->route('penyaluran.index')
            ->with('success', 'Pengajuan terkirim ke Pimpinan.');
    }

    public function realisasi(Request $request, Penyaluran $penyaluran)
    {
        if ($penyaluran->status !== 'disetujui') {
            return back()->with('error', 'Hanya penyaluran disetujui yang bisa direalisasi.');
        }

        $request->validate([
            'bukti_penyaluran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = [
            'status' => 'direalisasi',
            'tanggal_realisasi' => now(),
        ];

        if ($request->hasFile('bukti_penyaluran')) {
            $data['bukti_penyaluran'] = $request->file('bukti_penyaluran')
                ->store('bukti-penyaluran', 'public');
        }

        $penyaluran->update($data);

        ActivityLog::catat(
            'realisasi',
            'penyaluran',
            'Realisasi: ' . $penyaluran->nomor_transaksi,
            $penyaluran->id
        );

        return redirect()->route('penyaluran.index')
            ->with('success', 'Penyaluran direalisasi. Dana tersalurkan bertambah.');
    }

    public function destroy(Penyaluran $penyaluran)
    {
        if ($penyaluran->status !== 'draft') {
            return back()->with('error', 'Hanya draft yang bisa dihapus.');
        }

        if ($penyaluran->bukti_penyaluran) {
            Storage::disk('public')->delete($penyaluran->bukti_penyaluran);
        }
        $penyaluran->delete();

        return redirect()->route('penyaluran.index')->with('success', 'Data dihapus.');
    }
}