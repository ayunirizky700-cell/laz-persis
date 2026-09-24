<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Penerimaan Dana</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="bg-blue-50 border border-blue-200 p-4 rounded mb-4">
            <p class="text-sm text-gray-600">Total Penerimaan (Valid):</p>
            <p class="text-2xl font-bold text-blue-700">Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>

        <div class="flex justify-between mb-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari transaksi..."
                    class="border rounded px-3 py-2">
                <select name="status" class="border rounded px-3 py-2">
                    <option value="">Semua Status</option>
                    @foreach(['pending', 'valid', 'ditolak', 'dibatalkan'] as $s)
                        <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
            <a href="{{ route('penerimaan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah
                Penerimaan</a>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">No. Transaksi</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Muzakki/Donatur</th>
                    <th class="p-3 text-left">Jenis Dana</th>
                    <th class="p-3 text-left">Nominal</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penerimaan as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->nomor_transaksi }}</td>
                        <td class="p-3">{{ $p->tanggal->format('d/m/Y') }}</td>
                        <td class="p-3">{{ $p->muzakki->nama ?? $p->nama_donatur ?? 'Anonim' }}</td>
                        <td class="p-3">{{ ucfirst($p->jenis_dana) }}</td>
                        <td class="p-3">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $p->status == 'valid' ? 'bg-green-100' : '' }}
                                {{ $p->status == 'pending' ? 'bg-yellow-100' : '' }}
                                {{ $p->status == 'ditolak' ? 'bg-red-100' : '' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('penerimaan.show', $p) }}" class="text-blue-600">Lihat</a>
                            @if($p->status == 'pending')
                                <form action="{{ route('penerimaan.validasi', $p) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="valid">
                                    <button class="text-green-600">Validasi</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-3 text-center text-gray-500">Belum ada penerimaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $penerimaan->links() }}</div>
    </div>
</x-app-layout>