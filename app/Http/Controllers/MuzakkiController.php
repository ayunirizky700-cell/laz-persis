<?php
namespace App\Http\Controllers;

use App\Models\Muzakki;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class MuzakkiController extends Controller {

    public function index(Request $request) {
        $query = Muzakki::query();
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%')
                  ->orWhere('kode', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('kategori')) $query->where('kategori', $request->kategori);
        $muzakki = $query->latest()->paginate(10);
        return view('muzakki.index', compact('muzakki'));
    }

    public function create() {
        return view('muzakki.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'kategori' => 'required|in:individu,perusahaan,lembaga',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        $muzakki = Muzakki::create($validated);
        ActivityLog::catat('create', 'muzakki', 'Tambah muzakki: '.$muzakki->nama);
        return redirect()->route('muzakki.index')->with('success', 'Muzakki ditambahkan. Kode: '.$muzakki->kode);
    }

    public function show(Muzakki $muzakki) {
        $muzakki->load('penerimaan');
        return view('muzakki.show', compact('muzakki'));
    }

    public function edit(Muzakki $muzakki) {
        return view('muzakki.edit', compact('muzakki'));
    }

    public function update(Request $request, Muzakki $muzakki) {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'kategori' => 'required|in:individu,perusahaan,lembaga',
            'status' => 'required|in:aktif,nonaktif',
        ]);
        $muzakki->update($validated);
        return redirect()->route('muzakki.index')->with('success', 'Muzakki diupdate.');
    }

    public function destroy(Muzakki $muzakki) {
        if ($muzakki->penerimaan()->count() > 0) {
            return back()->with('error', 'Tidak bisa hapus, ada transaksi.');
        }
        $muzakki->delete();
        return redirect()->route('muzakki.index')->with('success', 'Muzakki dihapus.');
    }
}