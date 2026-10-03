<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Penerimaan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <form action="{{ route('penerimaan.update', $penerimaan->id) }}" method="POST"
            class="bg-white p-6 shadow rounded space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">No. Transaksi</label>
                <input type="text" value="{{ $penerimaan->nomor_transaksi }}"
                    class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $penerimaan->tanggal) }}"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Muzakki</label>
                <select name="muzakki_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Muzakki --</option>
                    @foreach($muzakki as $m)
                        <option value="{{ $m->id }}" @selected(old('muzakki_id', $penerimaan->muzakki_id) == $m->id)>
                            {{ $m->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Atau Nama Donatur Manual</label>
                <input type="text" name="nama_donatur" value="{{ old('nama_donatur', $penerimaan->nama_donatur) }}"
                    class="w-full border rounded px-3 py-2" placeholder="Kosongkan jika pilih muzakki">
            </div>

            <div>
                <label class="block font-medium mb-1">Program</label>
                <select name="program_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Program --</option>
                    @foreach($program as $p)
                        <option value="{{ $p->id }}" @selected(old('program_id', $penerimaan->program_id) == $p->id)>
                            {{ $p->nama_program }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Jenis Dana *</label>
                    <select name="jenis_dana" class="w-full border rounded px-3 py-2" required>
                        @foreach(['zakat', 'infaq', 'sedekah', 'wakaf', 'dana_kemanusiaan', 'csr'] as $j)
                            <option value="{{ $j }}" @selected(old('jenis_dana', $penerimaan->jenis_dana) == $j)>
                                {{ ucfirst(str_replace('_', ' ', $j)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Nominal (Rp) *</label>
                    <input type="number" name="nominal" value="{{ old('nominal', $penerimaan->nominal) }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Metode Pembayaran *</label>
                    <select name="metode_pembayaran" class="w-full border rounded px-3 py-2" required>
                        @foreach(['tunai', 'transfer_bank', 'qris', 'e_wallet', 'lainnya'] as $mp)
                            <option value="{{ $mp }}" @selected(old('metode_pembayaran', $penerimaan->metode_pembayaran) == $mp)>{{ ucfirst(str_replace('_', ' ', $mp)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">No. Referensi</label>
                    <input type="text" name="no_referensi" value="{{ old('no_referensi', $penerimaan->no_referensi) }}"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Status *</label>
                <select name="status" class="w-full border rounded px-3 py-2" required>
                    @foreach(['pending', 'valid', 'ditolak', 'dibatalkan'] as $s)
                        <option value="{{ $s }}" @selected(old('status', $penerimaan->status) == $s)>{{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3"
                    class="w-full border rounded px-3 py-2">{{ old('keterangan', $penerimaan->keterangan) }}</textarea>
            </div>

            <div class="flex gap-2 pt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                <a href="{{ route('penerimaan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>