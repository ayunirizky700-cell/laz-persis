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

        <div class="flex justify-between mb-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari muzakki..."
                    class="border rounded px-3 py-2">
                <select name="kategori" class="border rounded px-3 py-2">
                    <option value="">Semua Kategori</option>
                    @foreach(['individu', 'perusahaan', 'lembaga'] as $k)
                        <option value="{{ $k }}" @selected(request('kategori') == $k)>{{ ucfirst($k) }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
            <a href="{{ route('muzakki.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah
                Muzakki</a>
        </div>

        <table class="w-full bg-white shadow rounded">
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
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('muzakki.show', $m) }}" class="text-blue-600">Lihat</a>
                            <a href="{{ route('muzakki.edit', $m) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('muzakki.destroy', $m) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">Belum ada muzakki.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $muzakki->links() }}</div>
    </div>
</x-app-layout>