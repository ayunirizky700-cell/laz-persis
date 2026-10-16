<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Rekap Saldo</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <!-- FILTER RESPONSIVE -->
        <div class="bg-white p-4 rounded shadow mb-4">
            <form method="GET" class="flex flex-col md:flex-row gap-2 w-full">
                <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}"
                    class="border rounded px-3 py-2 w-full md:w-auto flex-shrink-0">
                <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}"
                    class="border rounded px-3 py-2 w-full md:w-auto flex-shrink-0">
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto flex-shrink-0 whitespace-nowrap">Filter</button>
            </form>
        </div>
        <!-- SELESAI FILTER -->

        <!-- KARTU REKAP SALDO -->
        <div class="bg-white p-6 shadow rounded space-y-4">
            <h3 class="text-lg font-semibold">Periode: {{ $tanggalMulai }} s/d {{ $tanggalSelesai }}</h3>

            <div class="flex justify-between border-b pb-2">
                <span>Total Penerimaan</span>
                <strong class="text-blue-700">Rp {{ number_format($totalPenerimaan, 0, ',', '.') }}</strong>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span>Total Penyaluran</span>
                <strong class="text-red-700">Rp {{ number_format($totalPenyaluran, 0, ',', '.') }}</strong>
            </div>

            <div class="flex justify-between text-xl">
                <span>Saldo Akhir</span>
                <strong class="{{ $saldo >= 0 ? 'text-green-700' : 'text-red-700' }}">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </strong>
            </div>
        </div>
        <!-- SELESAI KARTU -->

        <!-- TOMBOL AKSI RESPONSIVE -->
        <div class="mt-4 flex flex-col md:flex-row gap-2">
            <a href="{{ route('laporan.index') }}"
                class="bg-gray-300 px-4 py-2 rounded text-center w-full md:w-auto">Kembali</a>
            <a href="{{ route('laporan.rekap-saldo.pdf', request()->all()) }}"
                class="bg-red-600 text-white px-4 py-2 rounded text-center w-full md:w-auto">📄 Export PDF</a>
        </div>
        <!-- SELESAI TOMBOL -->
    </div>
</x-app-layout>