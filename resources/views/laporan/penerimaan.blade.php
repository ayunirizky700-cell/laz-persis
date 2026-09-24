<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Penerimaan Dana</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <div class="bg-white p-4 rounded shadow mb-4">
            <form method="GET" class="flex gap-2 flex-wrap">
                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                    class="border rounded px-3 py-2">
                <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                    class="border rounded px-3 py-2">
                <select name="jenis_dana" class="border rounded px-3 py-2">
                    <option value="">Semua Jenis Dana</option>
                    @foreach(['zakat', 'infaq', 'sedekah', 'wakaf', 'dana_kemanusiaan', 'csr'] as $j)
                        <option value="{{ $j }}" @selected(request('jenis_dana') == $j)>{{ ucfirst($j) }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>

        <div class="bg-blue-50 border border-blue-200 p-4 rounded mb-4">
            <p class="text-sm text-gray-600">Total Penerimaan:</p>
            <p class="text-2xl font-bold text-blue-700">Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">No. Transaksi</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Muzakki/Donatur</th>
                    <th class="p-3 text-left">Jenis Dana</th>
                    <th class="p-3 text-left">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $i + 1 }}</td>
                        <td class="p-3">{{ $p->nomor_transaksi }}</td>
                        <td class="p-3">{{ $p->tanggal->format('d/m/Y') }}</td>
                        <td class="p-3">{{ $p->muzakki->nama ?? $p->nama_donatur ?? 'Anonim' }}</td>
                        <td class="p-3">{{ ucfirst($p->jenis_dana) }}</td>
                        <td class="p-3">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <th colspan="5" class="p-3 text-right">TOTAL</th>
                    <th class="p-3">Rp {{ number_format($total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('laporan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
            <a href="{{ route('laporan.penerimaan.pdf', request()->all()) }}"
                class="bg-red-600 text-white px-4 py-2 rounded">📄 Export PDF</a>
        </div>
    </div>
</x-app-layout>