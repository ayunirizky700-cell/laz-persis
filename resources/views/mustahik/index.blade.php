<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Data Mustahik</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <!-- TOOLBAR YANG DIPERBAIKI TOTAL -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">

            <!-- Form Pencarian & Filter -->
            <form method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mustahik..."
                    class="border rounded px-3 py-2 w-full md:w-56 flex-shrink-0">
                <select name="asnaf" class="border rounded px-3 py-2 w-full md:w-auto flex-shrink-0">
                    <option value="">Semua Asnaf</option>
                    @foreach(['fakir', 'miskin', 'amil', 'muallaf', 'fisabilillah'] as $a)
                        <option value="{{ $a }}" @selected(request('asnaf') == $a)>{{ ucfirst($a) }}</option>
                    @endforeach
                </select>
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto flex-shrink-0 whitespace-nowrap">Filter</button>
            </form>

            <!-- Tombol Tambah Mustahik (Dibuat agar tidak melar) -->
            <a href="{{ route('mustahik.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded text-center w-full md:w-auto md:inline-block whitespace-nowrap flex-shrink-0">
                + Tambah Mustahik
            </a>
        </div>
        <!-- SELESAI TOOLBAR -->

        <!-- Tabel (Jangan diubah) -->
        <div class="overflow-x-auto w-full bg-white shadow rounded">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Kode</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Telepon</th>
                        <th class="p-3 text-left">Asnaf</th>
                        <th class="p-3 text-left">Verifikasi</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mustahik as $m)
                        <tr class="border-t">
                            <td class="p-3">{{ $m->kode }}</td>
                            <td class="p-3">{{ $m->nama }}</td>
                            <td class="p-3">{{ $m->no_telepon ?? '-' }}</td>
                            <td class="p-3">{{ ucfirst($m->asnaf ?? '-') }}</td>
                            <td class="p-3">
                                <span
                                    class="px-2 py-1 text-xs rounded
                                            {{ ($m->status_verifikasi ?? '') == 'terverifikasi' ? 'bg-green-100' : 'bg-yellow-100' }}">
                                    {{ ucfirst($m->status_verifikasi ?? 'Belum') }}
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('mustahik.show', $m) }}" class="text-blue-600">Lihat</a>
                                    <a href="{{ route('mustahik.edit', $m) }}" class="text-yellow-600">Edit</a>
                                    <form action="{{ route('mustahik.destroy', $m) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada mustahik.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $mustahik->links() }}</div>
    </div>
</x-app-layout>