<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <h3 class="text-lg font-semibold mb-4">Pilih Jenis Laporan:</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('laporan.penerimaan') }}" class="bg-blue-50 p-6 rounded shadow hover:bg-blue-100">
                <h4 class="font-bold text-lg mb-2">📥 Laporan Penerimaan</h4>
                <p class="text-sm text-gray-600">Laporan dana masuk dari muzakki</p>
            </a>

            <a href="{{ route('laporan.penyaluran') }}" class="bg-green-50 p-6 rounded shadow hover:bg-green-100">
                <h4 class="font-bold text-lg mb-2">📤 Laporan Penyaluran</h4>
                <p class="text-sm text-gray-600">Laporan dana keluar ke mustahik</p>
            </a>

            <a href="{{ route('laporan.program') }}" class="bg-purple-50 p-6 rounded shadow hover:bg-purple-100">
                <h4 class="font-bold text-lg mb-2">📋 Laporan Program</h4>
                <p class="text-sm text-gray-600">Rekap capaian program</p>
            </a>

            <a href="{{ route('laporan.rekap-saldo') }}" class="bg-orange-50 p-6 rounded shadow hover:bg-orange-100">
                <h4 class="font-bold text-lg mb-2">💰 Rekap Saldo</h4>
                <p class="text-sm text-gray-600">Ringkasan aliran dana</p>
            </a>
        </div>
    </div>
</x-app-layout>