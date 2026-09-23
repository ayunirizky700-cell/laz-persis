<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Program</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form action="{{ route('program.store') }}" method="POST" class="bg-white p-6 shadow rounded space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">Nama Program</label>
                <input type="text" name="nama_program" value="{{ old('nama_program') }}"
                    class="w-full border rounded px-3 py-2" required>
                @error('nama_program')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full border rounded px-3 py-2">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="kategori" class="w-full border rounded px-3 py-2" required>
                        @foreach(['pendidikan', 'kesehatan', 'ekonomi', 'dakwah', 'sosial', 'kemanusiaan'] as $k)
                            <option value="{{ $k }}" @selected(old('kategori') == $k)>{{ ucfirst($k) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Jenis</label>
                    <select name="jenis" class="w-full border rounded px-3 py-2" required>
                        <option value="penghimpunan" @selected(old('jenis') == 'penghimpunan')>Penghimpunan</option>
                        <option value="penyaluran" @selected(old('jenis') == 'penyaluran')>Penyaluran</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Target Dana (Rp)</label>
                <input type="number" name="target_dana" value="{{ old('target_dana', 0) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Periode Mulai</label>
                    <input type="date" name="periode_mulai" value="{{ old('periode_mulai') }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Periode Selesai</label>
                    <input type="date" name="periode_selesai" value="{{ old('periode_selesai') }}"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2" required>
                    @foreach(['draft', 'aktif', 'selesai', 'ditutup'] as $s)
                        <option value="{{ $s }}" @selected(old('status') == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 pt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('program.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>