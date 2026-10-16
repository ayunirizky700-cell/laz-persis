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

        <!-- TOOLBAR RESPONSIVE -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">

            <!-- Form Pencarian & Filter -->
            <form method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari transaksi..."
                    class="border rounded px-3 py-2 w-full md:w-56 flex-shrink-0">
                <select name="status" class="border rounded px-3 py-2 w-full md:w-auto flex-shrink-0">
                    <option value="">Semua Status</option>
                    @foreach(['valid', 'pending'] as $s)
                        <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto flex-shrink-0 whitespace-nowrap">Filter</button>
            </form>

            <!-- Tombol Tambah Penerimaan -->
            <a href="{{ route('penerimaan.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded text-center w-full md:w-auto md:inline-block whitespace-nowrap flex-shrink-0">
                + Tambah Penerimaan
            </a>
        </div>
        <!-- SELESAI TOOLBAR -->

        <!-- TABEL RESPONSIVE -->
        <div class="overflow-x-auto w-full bg-white shadow rounded">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">No. Transaksi</th>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Muzakki/Donatur</th>
                        <th class="p-3 text-left">Jenis Dana</th>
                        <th class="p-3 text-left">Nominal</th>
                        <th class="p-3 text-left">Tersalurkan</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penerimaan as $p)
                        <tr class="border-t">
                            <td class="p-3">{{ $p->nomor_transaksi }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                            <td class="p-3">{{ $p->muzakki->nama ?? $p->nama_donatur ?? 'Anonim' }}</td>
                            <td class="p-3">{{ ucfirst($p->jenis_dana) }}</td>
                            <td class="p-3">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                            <td class="p-3">-</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded
                                                {{ $p->status == 'valid' ? 'bg-green-100' : '' }}
                                                {{ $p->status == 'pending' ? 'bg-yellow-100' : '' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <!-- Aksi dibungkus div flex -->
                                <div class="flex gap-2">
                                    <a href="{{ route('penerimaan.show', $p) }}" class="text-blue-600">Lihat</a>
                                    <a href="{{ route('penerimaan.edit', $p) }}" class="text-yellow-600">Edit</a>
                                    @if($p->status != 'valid')
                                        <form action="{{ route('penerimaan.destroy', $p) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin hapus?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-3 text-center text-gray-500">Belum ada penerimaan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- SELESAI TABEL -->

        <div class="mt-4">{{ $penerimaan->links() }}</div>
    </div>
</x-app-layout>