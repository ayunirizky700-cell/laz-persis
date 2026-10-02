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

        <div class="flex justify-between mb-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mustahik..."
                    class="border rounded px-3 py-2">
                <select name="asnaf" class="border rounded px-3 py-2">
                    <option value="">Semua Asnaf</option>
                    @foreach(['fakir', 'miskin', 'amil', 'muallaf', 'fisabilillah'] as $a)
                        <option value="{{ $a }}" @selected(request('asnaf') == $a)>{{ ucfirst($a) }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
            <a href="{{ route('mustahik.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah
                Mustahik</a>
        </div>

        <table class="w-full bg-white shadow rounded">
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
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('mustahik.show', $m) }}" class="text-blue-600">Lihat</a>
                            <a href="{{ route('mustahik.edit', $m) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('mustahik.destroy', $m) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">Belum ada mustahik.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $mustahik->links() }}</div>
    </div>
</x-app-layout>