<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Program</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Kode</th>
                    <th class="p-3 text-left">Program</th>
                    <th class="p-3 text-left">Target</th>
                    <th class="p-3 text-left">Terkumpul</th>
                    <th class="p-3 text-left">Tersalurkan</th>
                    <th class="p-3 text-left">Capaian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($program as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->kode_program }}</td>
                        <td class="p-3">{{ $p->nama_program }}</td>
                        <td class="p-3">Rp {{ number_format($p->target_dana, 0, ',', '.') }}</td>
                        <td class="p-3">Rp {{ number_format($p->dana_terkumpul, 0, ',', '.') }}</td>
                        <td class="p-3">Rp {{ number_format($p->dana_tersalurkan, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <div class="w-32 bg-gray-200 rounded h-3">
                                <div class="bg-blue-600 h-3 rounded" style="width: {{ min($p->persentase_capaian, 100) }}%">
                                </div>
                            </div>
                            <span class="text-xs">{{ $p->persentase_capaian }}%</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('laporan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
            <a href="{{ route('laporan.program.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded">📄 Export
                PDF</a>
        </div>
    </div>
</x-app-layout>