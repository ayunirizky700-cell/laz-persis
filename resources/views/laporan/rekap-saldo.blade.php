<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Rekap Saldo</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white p-4 rounded shadow mb-4">
            <form method="GET" class="flex gap-2 flex-wrap">
                <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}" class="border rounded px-3 py-2">
                <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}"
                    class="border rounded px-3 py-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>

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

        <div class="mt-4 flex gap-2">
            <a href="{{ route('laporan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
            <a href="{{ route('laporan.rekap-saldo.pdf', request()->all()) }}"
                class="bg-red-600 text-white px-4 py-2 rounded">📄 Export PDF</a>
        </div>
    </div>
</x-app-layout>