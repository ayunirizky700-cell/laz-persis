<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Program Zakat & Bantuan
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..."
                    class="border rounded px-3 py-2">
                <select name="status" class="border rounded px-3 py-2">
                    <option value="">Semua Status</option>
                    @foreach(['draft', 'aktif', 'selesai', 'ditutup'] as $s)
                        <option value="{{ $s }}" @selected(request('status') == $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            </form>
            <a href="{{ route('program.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah
                Program</a>
        </div>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Kode</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Kategori</th>
                    <th class="p-3 text-left">Target</th>
                    <th class="p-3 text-left">Terkumpul</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($program as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->kode_program }}</td>
                        <td class="p-3">{{ $p->nama_program }}</td>
                        <td class="p-3">{{ ucfirst($p->kategori) }}</td>
                        <td class="p-3">Rp {{ number_format($p->target_dana, 0, ',', '.') }}</td>
                        <td class="p-3">Rp {{ number_format($p->dana_terkumpul, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <span class="bg-green-100 px-2 py-1 text-xs rounded">{{ ucfirst($p->status) }}</span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('program.edit', $p) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('program.destroy', $p) }}" method="POST"
                                onsubmit="return confirm('Hapus program ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-3 text-center text-gray-500">Belum ada program.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $program->links() }}</div>
    </div>
</x-app-layout>