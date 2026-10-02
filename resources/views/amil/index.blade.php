<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Data Amil</h2>
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
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari amil..."
                    class="border rounded px-3 py-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
            <a href="{{ route('amil.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Amil</a>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">NIP</th>
                    <th class="p-3 text-left">Nama User</th>
                    <th class="p-3 text-left">Jabatan</th>
                    <th class="p-3 text-left">Divisi</th>
                    <th class="p-3 text-left">Cabang</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($amil as $a)
                    <tr class="border-t">
                        <td class="p-3">{{ $a->nip_amil ?? '-' }}</td>
                        <td class="p-3">{{ $a->user->nama ?? $a->user->name ?? '-' }}</td>
                        <td class="p-3">{{ $a->jabatan }}</td>
                        <td class="p-3">{{ $a->divisi ?? '-' }}</td>
                        <td class="p-3">{{ $a->cabang ?? '-' }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 text-xs rounded
                                    {{ $a->status == 'aktif' ? 'bg-green-100' : 'bg-gray-100' }}">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('amil.show', $a) }}" class="text-blue-600">Lihat</a>
                            <a href="{{ route('amil.edit', $a) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('amil.destroy', $a) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-3 text-center text-gray-500">Belum ada amil.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $amil->links() }}</div>
    </div>
</x-app-layout>