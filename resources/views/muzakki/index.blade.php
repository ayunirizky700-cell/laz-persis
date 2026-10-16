<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Data Muzakki</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <!-- TOOLBAR RESPONSIVE (Sama seperti Mustahik) -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">

            <!-- Form Pencarian & Filter -->
            <form method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari muzakki..."
                    class="border rounded px-3 py-2 w-full md:w-56 flex-shrink-0">
                <select name="kategori" class="border rounded px-3 py-2 w-full md:w-auto flex-shrink-0">
                    <option value="">Semua Kategori</option>
                    @foreach(['individu', 'perusahaan', 'lembaga'] as $k)
                        <option value="{{ $k }}" @selected(request('kategori') == $k)>{{ ucfirst($k) }}</option>
                    @endforeach
                </select>
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded w-full md:w-auto flex-shrink-0 whitespace-nowrap">Filter</button>
            </form>

            <!-- Tombol Tambah Muzakki -->
            <a href="{{ route('muzakki.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded text-center w-full md:w-auto md:inline-block whitespace-nowrap flex-shrink-0">
                + Tambah Muzakki
            </a>
        </div>
        <!-- SELESAI TOOLBAR -->

        <!-- TABEL RESPONSIVE (Sama seperti Mustahik) -->
        <div class="overflow-x-auto w-full bg-white shadow rounded">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Kode</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Telepon</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($muzakki as $m)
                        <tr class="border-t">
                            <td class="p-3">{{ $m->kode }}</td>
                            <td class="p-3">{{ $m->nama }}</td>
                            <td class="p-3">{{ $m->no_telepon ?? '-' }}</td>
                            <td class="p-3">{{ ucfirst($m->kategori) }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded
                                            {{ $m->status == 'aktif' ? 'bg-green-100' : 'bg-gray-100' }}">
                                    {{ ucfirst($m->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <!-- Aksi dibungkus div flex (Sama seperti Mustahik) -->
                                <div class="flex gap-2">
                                    <a href="{{ route('muzakki.show', $m) }}" class="text-blue-600">Lihat</a>
                                    <a href="{{ route('muzakki.edit', $m) }}" class="text-yellow-600">Edit</a>
                                    <form action="{{ route('muzakki.destroy', $m) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada muzakki.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- SELESAI TABEL -->

        <div class="mt-4">{{ $muzakki->links() }}</div>
    </div>
</x-app-layout>