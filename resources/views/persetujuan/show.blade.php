<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Pengajuan</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow rounded p-6 mb-4">
            <h3 class="text-lg font-bold mb-4">Informasi Pengajuan</h3>

            <table class="w-full">
                <tr class="border-b">
                    <td class="p-3 font-semibold w-48">No. Transaksi</td>
                    <td class="p-3">{{ $persetujuan->nomor_transaksi }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3 font-semibold">Tanggal Pengajuan</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($persetujuan->tanggal_pengajuan)->format('d/m/Y') }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3 font-semibold">Program</td>
                    <td class="p-3">{{ $persetujuan->program->nama_program ?? '-' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3 font-semibold">Mustahik</td>
                    <td class="p-3">{{ $persetujuan->mustahik->nama ?? '-' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="p-3 font-semibold">Nominal</td>
                    <td class="p-3 font-bold text-blue-600">Rp {{ number_format($persetujuan->nominal, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="p-3 font-semibold">Keterangan</td>
                    <td class="p-3">{{ $persetujuan->deskripsi_bantuan ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="p-3 font-semibold">Status</td>
                    <td class="p-3">
                        <span class="px-3 py-1 text-xs rounded font-semibold
                            {{ $persetujuan->status == 'diajukan' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $persetujuan->status == 'disetujui' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $persetujuan->status == 'ditolak' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $persetujuan->status == 'direalisasi' ? 'bg-green-100 text-green-700' : '' }}">
                            {{ ucfirst($persetujuan->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        @if($persetujuan->status == 'diajukan')
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-bold mb-4">Aksi Persetujuan</h3>
                <div class="flex gap-3">
                    <form action="{{ route('persetujuan.approve', $persetujuan->id) }}" method="POST"
                        onsubmit="return confirm('Setujui pengajuan ini?');">
                        @csrf
                        <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700">
                            ✓ Setujui
                        </button>
                    </form>
                    <form action="{{ route('persetujuan.reject', $persetujuan->id) }}" method="POST"
                        onsubmit="return confirm('Tolak pengajuan ini?');">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 text-white px-6 py-2 rounded font-semibold hover:bg-red-700">
                            ✗ Tolak
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('persetujuan.index') }}" class="text-gray-600 hover:text-gray-800">← Kembali ke Daftar
                Persetujuan</a>
        </div>
    </div>
</x-app-layout>