<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Penyaluran Dana</h2>
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
                    @foreach(['draft', 'diajukan', 'disetujui', 'ditolak', 'direalisasi'] as $s)
                        <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto flex-shrink-0 whitespace-nowrap">Filter</button>
            </form>

            <!-- Tombol Ajukan Penyaluran -->
            <a href="{{ route('penyaluran.create') }}" class="bg-green-600 text-white px-4 py-2 rounded text-center w-full md:w-auto md:inline-block whitespace-nowrap flex-shrink-0">
                + Ajukan Penyaluran
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
                        <th class="p-3 text-left">Program</th>
                        <th class="p-3 text-left">Mustahik</th>
                        <th class="p-3 text-left">Nominal</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyaluran as $p)
                        <tr class="border-t">
                            <td class="p-3">{{ $p->nomor_transaksi }}</td>
                            <td class="p-3">{{ $p->tanggal_pengajuan->format('d/m/Y') }}</td>
                            <td class="p-3">{{ $p->program->nama_program ?? '-' }}</td>
                            <td class="p-3">{{ $p->mustahik->nama ?? '-' }}</td>
                            <td class="p-3">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded
                                        {{ $p->status == 'draft' ? 'bg-gray-100' : '' }}
                                        {{ $p->status == 'diajukan' ? 'bg-yellow-100' : '' }}
                                        {{ $p->status == 'disetujui' ? 'bg-blue-100' : '' }}
                                        {{ $p->status == 'ditolak' ? 'bg-red-100' : '' }}
                                        {{ $p->status == 'direalisasi' ? 'bg-green-100' : '' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <!-- Aksi dibungkus div flex agar tidak merusak struktur tabel -->
                                <div class="flex gap-2">
                                    <a href="{{ route('penyaluran.show', $p) }}" class="text-blue-600">Lihat</a>
                                    @if($p->status == 'draft')
                                        <form action="{{ route('penyaluran.ajukan', $p) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Ajukan ke Pimpinan?')">
                                            @csrf
                                            <button class="text-yellow-600">Ajukan</button>
                                        </form>
                                    @endif
                                    @if($p->status == 'disetujui')
                                        <form action="{{ route('penyaluran.realisasi', $p) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Realisasi sekarang?')">
                                            @csrf
                                            <button class="text-green-600">Realisasi</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-3 text-center text-gray-500">Belum ada penyaluran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- SELESAI TABEL -->

        <div class="mt-4">{{ $penyaluran->links() }}</div>
    </div>
</x-app-layout>