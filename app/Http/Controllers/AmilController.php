<?php
namespace App\Http\Controllers;

use App\Models\Amil;
use App\Models\User;
use Illuminate\Http\Request;

class AmilController extends Controller {

    public function index() {
        $amil = Amil::with('user')->paginate(10);
        return view('amil.index', compact('amil'));
    }

    public function create() {
        $users = User::orderBy('nama')->get();
        return view('amil.create', compact('users'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:amil,user_id',
            'nip_amil' => 'nullable|string|max:30|unique:amil,nip_amil',
            'jabatan' => 'required|string|max:50',
            'divisi' => 'nullable|string|max:50',
            'cabang' => 'nullable|string|max:50',
            'tanggal_masuk' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif,cuti',
        ]);
        Amil::create($validated);
        return redirect()->route('amil.index')->with('success', 'Amil ditambahkan.');
    }

    public function show(Amil $amil) {
        $amil->load('user');
        return view('amil.show', compact('amil'));
    }

    public function edit(Amil $amil) {
        $users = User::orderBy('nama')->get();
        return view('amil.edit', compact('amil', 'users'));
    }

    public function update(Request $request, Amil $amil) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:amil,user_id,'.$amil->id,
            'nip_amil' => 'nullable|string|max:30|unique:amil,nip_amil,'.$amil->id,
            'jabatan' => 'required|string|max:50',
            'divisi' => 'nullable|string|max:50',
            'cabang' => 'nullable|string|max:50',
            'tanggal_masuk' => 'nullable|date',
            'status' => 'required|in:aktif,nonaktif,cuti',
        ]);
        $amil->update($validated);
        return redirect()->route('amil.index')->with('success', 'Amil diupdate.');
    }

    public function destroy(Amil $amil) {
        $amil->delete();
        return redirect()->route('amil.index')->with('success', 'Amil dihapus.');
    }
}