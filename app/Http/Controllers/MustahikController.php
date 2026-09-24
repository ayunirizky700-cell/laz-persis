<?php
namespace App\Http\Controllers;

use App\Models\Mustahik;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class MustahikController extends Controller {

    public function index(Request $request) {
        $query = Mustahik::query();
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('kategori_asnaf')) $query->where('kategori_asnaf', $request->kategori_asnaf);
        if ($request->filled('status_verifikasi')) $query->where('status_verifikasi', $request->status_verifikasi);
        $mustahik = $query->latest()->paginate(10);
        return view('mustahik.index', compact('mustahik'));
    }

    public function create() {
        return view('mustahik.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'kategori_asnaf' => 'required|in:fakir,miskin,amil,muallaf,riqab,gharim,fisabilillah,ibnu_sabil',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        $mustahik = Mustahik::create($validated);
        ActivityLog::catat('create', 'mustahik', 'Tambah mustahik: '.$mustahik->nama);
        return redirect()->route('mustahik.index')->with('success', 'Mustahik ditambahkan.');
    }

    public function show(Mustahik $mustahik) {
        $mustahik->load('penyaluran');
        $totalBantuan = $mustahik->penyaluran()->whereIn('status',['disetujui','direalisasi'])->sum('nominal');
        return view('mustahik.show', compact('mustahik', 'totalBantuan'));
    }

    public function edit(Mustahik $mustahik) {
        return view('mustahik.edit', compact('mustahik'));
    }

    public function update(Request $request, Mustahik $mustahik) {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'kategori_asnaf' => 'required|in:fakir,miskin,amil,muallaf,riqab,gharim,fisabilillah,ibnu_sabil',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        $mustahik->update($validated);
        return redirect()->route('mustahik.index')->with('success', 'Mustahik diupdate.');
    }

    public function verifikasi(Request $request, Mustahik $mustahik) {
        $request->validate(['status_verifikasi' => 'required|in:terverifikasi,ditolak']);
        $mustahik->update([
            'status_verifikasi' => $request->status_verifikasi,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);
        return back()->with('success', 'Status verifikasi diupdate.');
    }

    public function destroy(Mustahik $mustahik) {
        if ($mustahik->penyaluran()->count() > 0) {
            return back()->with('error', 'Tidak bisa hapus, ada transaksi.');
        }
        $mustahik->delete();
        return redirect()->route('mustahik.index')->with('success', 'Mustahik dihapus.');
    }
}