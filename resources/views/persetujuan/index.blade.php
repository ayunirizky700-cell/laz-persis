<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Persetujuan Pengajuan</h2>
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
                    @foreach(['diajukan', 'disetujui', 'ditolak'] as $s)
                        <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto flex-shrink-0 whitespace-nowrap">Filter</button>
            </form>
        </div>
        <!-- SELESAI TOOLBAR -->

        <!-- TABEL RESPONSIVE -->
        <div class="overflow-x-auto w-full bg-white shadow rounded">
            <table class="w-full whitespace-nowrap">
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
                            <td class="p-3">{{ $p->nomor_transaksi }}</td>
                            <td class="p-3">{{ $p->program->nama_program ?? '-' }}</td>
                            <td class="p-3">{{ $p->mustahik->nama ?? '-' }}</td>
                            <td class="p-3">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded
                                            {{ $p->status == 'diajukan' ? 'bg-yellow-100' : '' }}
                                            {{ $p->status == 'disetujui' ? 'bg-blue-100' : '' }}
                                            {{ $p->status == 'ditolak' ? 'bg-red-100' : '' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <!-- Aksi dibungkus div flex -->
                                <div class="flex gap-2">
                                    <a href="{{ route('persetujuan.show', $p) }}" class="text-blue-600">Lihat</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada pengajuan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- SELESAI TABEL -->

        {{-- Pagination Custom --}}
        <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
            <div class="text-base text-gray-700">
                Showing {{ $persetujuan->firstItem() ?? 0 }} to {{ $persetujuan->lastItem() ?? 0 }} of
                {{ $persetujuan->total() }} results
            </div>
            <div class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden">
                {{-- Tombol Previous --}}
                @if ($persetujuan->onFirstPage())
                    <span
                        class="inline-flex items-center justify-center min-w-[50px] h-12 px-4 bg-white text-gray-300 border-r border-gray-300 cursor-not-allowed text-lg">‹</span>
                @else
                    <a href="{{ $persetujuan->previousPageUrl() }}"
                        class="inline-flex items-center justify-center min-w-[50px] h-12 px-4 bg-white text-gray-700 border-r border-gray-300 hover:bg-gray-100 text-lg">‹</a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($persetujuan->getUrlRange(1, max($persetujuan->lastPage(), 1)) as $page => $url)
                    @if ($page == $persetujuan->currentPage())
                        <span
                            class="inline-flex items-center justify-center min-w-[50px] h-12 px-4 bg-gray-200 text-gray-900 font-bold border-r border-gray-300 text-base">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="inline-flex items-center justify-center min-w-[50px] h-12 px-4 bg-white text-gray-700 border-r border-gray-300 hover:bg-gray-100 text-base">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($persetujuan->hasMorePages())
                    <a href="{{ $persetujuan->nextPageUrl() }}"
                        class="inline-flex items-center justify-center min-w-[50px] h-12 px-4 bg-white text-gray-700 hover:bg-gray-100 text-lg">›</a>
                @else
                    <span
                        class="inline-flex items-center justify-center min-w-[50px] h-12 px-4 bg-white text-gray-300 cursor-not-allowed text-lg">›</span>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>