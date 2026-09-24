<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Persetujuan Pengajuan</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form method="GET" class="mb-4">
            <select name="status" class="border rounded px-3 py-2">
                <option value="">Semua Status</option>
                <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                <option value="disetujui" @selected(request('status') == 'disetujui')>Disetujui</option>
                <option value="ditolak" @selected(request('status') == 'ditolak')>Ditolak</option>
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Filter</button>
        </form>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No. Transaksi</th>
                    <th class="p-3 text-left">Program</th>
                    <th class="p-3 text-left">Mustahik</th>
                    <th class="p-3 text-left">Nominal</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($persetujuan as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->penyaluran->nomor_transaksi ?? '-' }}</td>
                        <td class="p-3">{{ $p->penyaluran->program->nama_program ?? '-' }}</td>
                        <td class="p-3">{{ $p->penyaluran->mustahik->nama ?? '-' }}</td>
                        <td class="p-3">Rp {{ number_format($p->penyaluran->nominal ?? 0, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $p->status == 'pending' ? 'bg-yellow-100' : '' }}
                                {{ $p->status == 'disetujui' ? 'bg-green-100' : '' }}
                                {{ $p->status == 'ditolak' ? 'bg-red-100' : '' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="p-3">
                            <a href="{{ route('persetujuan.show', $p) }}" class="text-blue-600">Lihat</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">Belum ada pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $persetujuan->links() }}</div>
    </div>
</x-app-layout>