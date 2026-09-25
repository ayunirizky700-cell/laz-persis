<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Amil') }}
            </h2>
            <a href="{{ route('amil.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Amil
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">NIP</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama User</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Divisi</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Cabang</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($amil as $index => $a)
                                <tr>
                                    <td class="px-4 py-2">{{ $amil->firstItem() + $index }}</td>
                                    <td class="px-4 py-2 font-mono text-sm">{{ $a->nip_amil ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $a->user->nama ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $a->jabatan }}</td>
                                    <td class="px-4 py-2">{{ $a->divisi ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $a->cabang ?? '-' }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs rounded
                                            @if($a->status == 'aktif') bg-green-100 text-green-700
                                            @elseif($a->status == 'cuti') bg-yellow-100 text-yellow-700
                                            @else bg-red-100 text-red-700
                                            @endif">
                                            {{ $a->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('amil.show', $a->id) }}"
                                           class="text-blue-600 hover:text-blue-900 mr-2">Lihat</a>
                                        <a href="{{ route('amil.edit', $a->id) }}"
                                           class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                        <form action="{{ route('amil.destroy', $a->id) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                        Belum ada data amil.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $amil->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>