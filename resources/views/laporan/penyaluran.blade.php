<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Penyaluran Dana</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <!-- FILTER RESPONSIVE -->
        <div class="bg-white p-4 rounded shadow mb-4">
            <form method="GET" class="flex flex-col md:flex-row gap-2 w-full">
                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                    class="border rounded px-3 py-2 w-full md:w-auto flex-shrink-0">
                <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                    class="border rounded px-3 py-2 w-full md:w-auto flex-shrink-0">
                <button class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto flex-shrink-0 whitespace-nowrap">Filter</button>
            </form>
        </div>
        <!-- SELESAI FILTER -->

        <!-- KARTU TOTAL -->
        <div class="bg-green-50 border border-green-200 p-4 rounded mb-4">
            <p class="text-sm text-gray-600">Total Penyaluran:</p>
            <p class="text-2xl font-bold text-green-700">Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>

        <!-- TABEL RESPONSIVE -->
        <div class="overflow-x-auto w-full bg-white shadow rounded">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">No. Transaksi</th>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Program</th>
                        <th class="p-3 text-left">Mustahik</th>
                        <th class="p-3 text-left">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $p)
                        <tr class="border-t">
                            <td class="p-3">{{ $i + 1 }}</td>
                            <td class="p-3">{{ $p->nomor_transaksi }}</td>
                            <td class="p-3">{{ $p->tanggal_pengajuan->format('d/m/Y') }}</td>
                            <td class="p-3">{{ $p->program->nama_program ?? '-' }}</td>
                            <td class="p-3">{{ $p->mustahik->nama ?? '-' }}</td>
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
        </div>
        <!-- SELESAI TABEL -->

        <!-- TOMBOL AKSI RESPONSIVE -->
        <div class="mt-4 flex flex-col md:flex-row gap-2">
            <a href="{{ route('laporan.index') }}" class="bg-gray-300 px-4 py-2 rounded text-center w-full md:w-auto">Kembali</a>
            <a href="{{ route('laporan.penyaluran.pdf', request()->all()) }}"
                class="bg-red-600 text-white px-4 py-2 rounded text-center w-full md:w-auto">📄 Export PDF</a>
        </div>
        <!-- SELESAI TOMBOL -->
    </div>
</x-app-layout>