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
                $q->where('nomor_transaksi', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_donatur', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('status'))
            $query->where('status', $request->status);
        if ($request->filled('jenis_dana'))
            $query->where('jenis_dana', $request->jenis_dana);

        $penerimaan = $query->latest()->paginate(10);
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
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'muzakki_id' => 'nullable|exists:muzakki,id',
            'nama_donatur' => 'nullable|string|max:100',
            'program_id' => 'nullable|exists:program,id',
            'jenis_dana' => 'required|in:zakat,infaq,sedekah,wakaf,dana_kemanusiaan,csr',
            'nominal' => 'required|numeric|min:1000',
            'metode_pembayaran' => 'required|in:tunai,transfer_bank,qris,e_wallet,lainnya',
            'no_referensi' => 'nullable|string|max:50',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,valid',
        ]);

        if (empty($validated['muzakki_id']) && empty($validated['nama_donatur'])) {
            return back()->withInput()
                ->withErrors(['muzakki_id' => 'Pilih muzakki atau isi nama donatur anonim.']);
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')
                ->store('bukti-penerimaan', 'public');
        }

        if ($validated['status'] === 'valid') {
            $validated['validated_by'] = auth()->id();
            $validated['validated_at'] = now();
        }

        $penerimaan = Penerimaan::create($validated);
        ActivityLog::catat(
            'create',
            'penerimaan',
            'Tambah penerimaan: ' . $penerimaan->nomor_transaksi,
            $penerimaan->id
        );

        return redirect()->route('penerimaan.index')
            ->with('success', 'Penerimaan dicatat. No: ' . $penerimaan->nomor_transaksi);
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
            'Validasi: ' . $penerimaan->nomor_transaksi . ' → ' . $request->status,
            $penerimaan->id
        );

        return back()->with('success', 'Status diupdate menjadi ' . $request->status);
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