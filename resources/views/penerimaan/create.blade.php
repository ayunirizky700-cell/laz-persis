<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Catat Penerimaan Dana</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form action="{{ route('penerimaan.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 shadow rounded space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">Tanggal *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                    class="w-full border rounded px-3 py-2" required>
                @error('tanggal')
                <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium mb-1">Muzakki</label>
                <select name="muzakki_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Muzakki --</option>
                    @foreach($muzakki as $m)
                        <option value="{{ $m->id }}" @selected(old('muzakki_id') == $m->id)>{{ $m->nama }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Atau isi nama donatur anonim di bawah:</p>
                <input type="text" name="nama_donatur" value="{{ old('nama_donatur') }}"
                    placeholder="Nama donatur anonim (opsional)" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label class="block font-medium mb-1">Program (Opsional)</label>
                <select name="program_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Tidak terkait program --</option>
                    @foreach($program as $pr)
                        <option value="{{ $pr->id }}" @selected(old('program_id') == $pr->id)>{{ $pr->nama_program }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Jenis Dana *</label>
                    <select name="jenis_dana" class="w-full border rounded px-3 py-2" required>
                        @foreach(['zakat', 'infaq', 'sedekah', 'wakaf', 'dana_kemanusiaan', 'csr'] as $j)
                            <option value="{{ $j }}" @selected(old('jenis_dana') == $j)>{{ ucfirst(str_replace('_', ' ', $j)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Nominal (Rp) *</label>
                    <input type="number" name="nominal" value="{{ old('nominal', 0) }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Metode Pembayaran *</label>
                    <select name="metode_pembayaran" class="w-full border rounded px-3 py-2" required>
                        @foreach(['tunai', 'transfer_bank', 'qris', 'e_wallet', 'lainnya'] as $m)
                            <option value="{{ $m }}" @selected(old('metode_pembayaran') == $m)>
                                {{ ucfirst(str_replace('_', ' ', $m)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">No. Referensi</label>
                    <input type="text" name="no_referensi" value="{{ old('no_referensi') }}"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png,.pdf"
                    class="w-full border rounded px-3 py-2">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF (max 2MB)</p>
            </div>

            <div>
                <label class="block font-medium mb-1">Keterangan</label>
                <textarea name="keterangan" rows="2"
                    class="w-full border rounded px-3 py-2">{{ old('keterangan') }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Status *</label>
                <select name="status" class="w-full border rounded px-3 py-2" required>
                    <option value="pending" @selected(old('status') == 'pending')>Pending (perlu validasi)</option>
                    <option value="valid" @selected(old('status') == 'valid')>Langsung Valid</option>
                </select>
            </div>

            <div class="flex gap-2 pt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('penerimaan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>