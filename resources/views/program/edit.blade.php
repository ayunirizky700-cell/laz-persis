<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Program</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form action="{{ route('program.update', $program) }}" method="POST"
            class="bg-white p-6 shadow rounded space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama Program</label>
                <input type="text" name="nama_program" value="{{ old('nama_program', $program->nama_program) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full border rounded px-3 py-2">{{ old('deskripsi', $program->deskripsi) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="kategori" class="w-full border rounded px-3 py-2" required>
                        @foreach(['pendidikan', 'kesehatan', 'ekonomi', 'dakwah', 'sosial', 'kemanusiaan'] as $k)
                            <option value="{{ $k }}" @selected($program->kategori == $k)>{{ ucfirst($k) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Jenis</label>
                    <select name="jenis" class="w-full border rounded px-3 py-2" required>
                        <option value="penghimpunan" @selected($program->jenis == 'penghimpunan')>Penghimpunan</option>
                        <option value="penyaluran" @selected($program->jenis == 'penyaluran')>Penyaluran</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Target Dana (Rp)</label>
                <input type="number" name="target_dana" value="{{ old('target_dana', $program->target_dana) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Periode Mulai</label>
                    <input type="date" name="periode_mulai"
                        value="{{ old('periode_mulai', $program->periode_mulai->format('Y-m-d')) }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Periode Selesai</label>
                    <input type="date" name="periode_selesai"
                        value="{{ old('periode_selesai', $program->periode_selesai?->format('Y-m-d')) }}"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2" required>
                    @foreach(['draft', 'aktif', 'selesai', 'ditutup'] as $s)
                        <option value="{{ $s }}" @selected($program->status == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 pt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('program.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>