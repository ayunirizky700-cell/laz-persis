<?php
namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function index(Request $request)
    {
        $query = Program::query();
        if ($request->filled('search')) {
            $query->where('nama_program', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status'))
            $query->where('status', $request->status);

        $program = $query->latest()->paginate(10);
        return view('program.index', compact('program'));
    }

    public function create()
    {
        return view('program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:pendidikan,kesehatan,ekonomi,dakwah,sosial,kemanusiaan',
            'jenis' => 'required|in:penghimpunan,penyaluran',
            'target_dana' => 'required|numeric|min:0',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'status' => 'required|in:draft,aktif,selesai,ditutup',
        ]);

        $program = Program::create($validated);
        ActivityLog::catat('create', 'program', 'Tambah program: ' . $program->nama_program, $program->id);

        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(Program $program)
    {
        return view('program.show', compact('program'));
    }

    public function edit(Program $program)
    {
        return view('program.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:pendidikan,kesehatan,ekonomi,dakwah,sosial,kemanusiaan',
            'jenis' => 'required|in:penghimpunan,penyaluran',
            'target_dana' => 'required|numeric|min:0',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'status' => 'required|in:draft,aktif,selesai,ditutup',
        ]);

        $program->update($validated);
        ActivityLog::catat('update', 'program', 'Update program: ' . $program->nama_program, $program->id);

        return redirect()->route('program.index')->with('success', 'Program berhasil diupdate.');
    }

    public function destroy(Program $program)
    {
        if ($program->penerimaan()->count() > 0 || $program->penyaluran()->count() > 0) {
            return back()->with('error', 'Program tidak bisa dihapus karena punya transaksi.');
        }
        ActivityLog::catat('delete', 'program', 'Hapus program: ' . $program->nama_program);
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program dihapus.');
    }
}