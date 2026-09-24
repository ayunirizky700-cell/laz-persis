<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Ajukan Penyaluran Dana</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form action="{{ route('penyaluran.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 shadow rounded space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">Tanggal Pengajuan *</label>
                <input type="date" name="tanggal_pengajuan" value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Program *</label>
                <select name="program_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Program --</option>
                    @foreach($program as $pr)
                        <option value="{{ $pr->id }}" @selected(old('program_id') == $pr->id)>{{ $pr->nama_program }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Mustahik (Penerima) *</label>
                <select name="mustahik_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Mustahik --</option>
                    @foreach($mustahik as $m)
                        <option value="{{ $m->id }}" @selected(old('mustahik_id') == $m->id)>
                            {{ $m->nama }} ({{ ucfirst($m->kategori_asnaf) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Jenis Bantuan *</label>
                    <select name="jenis_bantuan" class="w-full border rounded px-3 py-2" required>
                        @foreach(['uang', 'barang', 'jasa', 'beasiswa', 'sembako'] as $j)
                            <option value="{{ $j }}" @selected(old('jenis_bantuan') == $j)>{{ ucfirst($j) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Nominal (Rp) *</label>
                    <input type="number" name="nominal" value="{{ old('nominal', 0) }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi Bantuan</label>
                <textarea name="deskripsi_bantuan" rows="3"
                    class="w-full border rounded px-3 py-2">{{ old('deskripsi_bantuan') }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Bukti/Dokumentasi (Opsional)</label>
                <input type="file" name="bukti_penyaluran" accept=".jpg,.jpeg,.png,.pdf"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex gap-2 pt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan sebagai Draft</button>
                <a href="{{ route('penyaluran.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>