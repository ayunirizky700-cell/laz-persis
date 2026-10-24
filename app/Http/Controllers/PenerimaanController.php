<?php
namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Muzakki;
use App\Models\Program;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenerimaanController extends Controller
{

    public function index(Request $request)
    {
        $query = Penerimaan::with(['muzakki', 'program']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                // Sesuaikan 'nomor_transaksi' dengan nama kolom di database (kode_penerimaan)
                $q->where('kode_penerimaan', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_donatur', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('status'))
            $query->where('status', $request->status);
        if ($request->filled('jenis_dana'))
            $query->where('jenis_dana', $request->jenis_dana);

        $penerimaan = $query->latest()->paginate(5);
        $total = Penerimaan::where('status', 'valid')->sum('nominal');

        return view('penerimaan.index', compact('penerimaan', 'total'));
    }

    public function create()
    {
        $muzakki = Muzakki::orderBy('nama')->get();
        $program = Program::where('status', 'aktif')->get();
        return view('penerimaan.create', compact('muzakki', 'program'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (PERBAIKAN UTAMA DI SINI)
        $validated = $request->validate([
            'tanggal' => 'required|date',
            // Ubah jadi nullable karena ada opsi donatur anonim
            'muzakki_id' => 'nullable|exists:muzakki,id',
            'nama_donatur' => 'nullable|string|max:255',
            'program_id' => 'nullable|exists:program,id',
            // GANTI 'jenis' MENJADI 'jenis_dana'
            'jenis_dana' => 'required|string',
            'nominal' => 'required|numeric|min:1000',
            'metode_pembayaran' => 'required|string',
            'no_referensi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,valid',
        ]);

        // 2. Otomatis isi created_by (ID user yang login)
        $validated['created_by'] = auth()->id();

        // 3. Otomatis buat kode_penerimaan
        $tahun = date('Y');
        $lastData = \App\Models\Penerimaan::whereYear('created_at', $tahun)->latest('id')->first();
        $lastNumber = $lastData ? (int) substr($lastData->kode_penerimaan, -4) : 0;
        $validated['kode_penerimaan'] = 'PNR-' . $tahun . '-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        // 4. Logika Validasi (Jika statusnya langsung 'valid')
        if ($validated['status'] === 'valid') {
            $validated['validated_by'] = auth()->id();
            $validated['validated_at'] = now();
        }

        // 5. Simpan ke Database
        $penerimaan = \App\Models\Penerimaan::create($validated);

        // 6. Catat Activity Log
        if (class_exists('\App\Models\ActivityLog')) {
            \App\Models\ActivityLog::catat(
                'create',
                'penerimaan',
                'Tambah penerimaan: ' . $penerimaan->kode_penerimaan,
                $penerimaan->id
            );
        }

        // 7. Redirect kembali ke halaman index
        return redirect()->route('penerimaan.index')->with('success', 'Data Penerimaan berhasil disimpan!');
    }

    public function show(Penerimaan $penerimaan)
    {
        $penerimaan->load(['muzakki', 'program', 'validator']);
        return view('penerimaan.show', compact('penerimaan'));
    }

    public function validasi(Request $request, Penerimaan $penerimaan)
    {
        $request->validate(['status' => 'required|in:valid,ditolak']);

        if ($penerimaan->status !== 'pending') {
            return back()->with('error', 'Transaksi ini sudah divalidasi.');
        }

        $penerimaan->update([
            'status' => $request->status,
            'validated_by' => auth()->id(),
            'validated_at' => now(),
        ]);

        ActivityLog::catat(
            'validasi',
            'penerimaan',
            'Validasi: ' . $penerimaan->kode_penerimaan . ' → ' . $request->status,
            $penerimaan->id
        );

        return back()->with('success', 'Status diupdate menjadi ' . $request->status);
    }

    public function edit(Penerimaan $penerimaan)
    {
        $muzakki = \App\Models\Muzakki::orderBy('nama')->get();
        $program = \App\Models\Program::where('status', 'aktif')->orderBy('nama_program')->get();
        return view('penerimaan.edit', compact('penerimaan', 'muzakki', 'program'));
    }

    public function update(Request $request, Penerimaan $penerimaan)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'muzakki_id' => 'nullable|exists:muzakki,id',
            'nama_donatur' => 'nullable|string|max:100',
            'program_id' => 'nullable|exists:program,id',
            'jenis_dana' => 'required|in:zakat,infaq,sedekah,wakaf,dana_kemanusiaan,csr',
            'nominal' => 'required|numeric|min:1000',
            'metode_pembayaran' => 'required|in:tunai,transfer_bank,qris,e_wallet,lainnya',
            'no_referensi' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,valid,ditolak,dibatalkan',
        ]);

        $penerimaan->update($validated);

        \App\Models\ActivityLog::catat('update', 'penerimaan', 'Update: ' . $penerimaan->kode_penerimaan, $penerimaan->id);

        return redirect()->route('penerimaan.index')->with('success', 'Penerimaan diupdate.');
    }

    public function destroy(Penerimaan $penerimaan)
    {
        if ($penerimaan->status === 'valid') {
            return back()->with('error', 'Transaksi valid tidak bisa dihapus.');
        }

        if ($penerimaan->bukti_pembayaran) {
            Storage::disk('public')->delete($penerimaan->bukti_pembayaran);
        }
        $penerimaan->delete();

        return redirect()->route('penerimaan.index')->with('success', 'Data dihapus.');
    }
}