<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Review Pengajuan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-2xl font-bold mb-4">Review Pengajuan Penyaluran</h3>

            <div class="bg-gray-50 p-4 rounded mb-4">
                <h4 class="font-semibold mb-2">Detail Penyaluran:</h4>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div><strong>No. Transaksi:</strong> {{ $persetujuan->penyaluran->nomor_transaksi }}</div>
                    <div><strong>Tanggal:</strong> {{ $persetujuan->penyaluran->tanggal_pengajuan->format('d/m/Y') }}
                    </div>
                    <div><strong>Program:</strong> {{ $persetujuan->penyaluran->program->nama_program }}</div>
                    <div><strong>Mustahik:</strong> {{ $persetujuan->penyaluran->mustahik->nama }}</div>
                    <div><strong>Jenis Bantuan:</strong> {{ ucfirst($persetujuan->penyaluran->jenis_bantuan) }}</div>
                    <div><strong>Nominal:</strong> Rp
                        {{ number_format($persetujuan->penyaluran->nominal, 0, ',', '.') }}</div>
                </div>
                <div class="mt-2 text-sm">
                    <strong>Deskripsi:</strong> {{ $persetujuan->penyaluran->deskripsi_bantuan ?? '-' }}
                </div>
            </div>

            <div class="mb-4">
                <p class="text-sm"><strong>Status Persetujuan:</strong>
                    <span class="px-2 py-1 text-xs rounded
                        {{ $persetujuan->status == 'pending' ? 'bg-yellow-100' : '' }}
                        {{ $persetujuan->status == 'disetujui' ? 'bg-green-100' : '' }}
                        {{ $persetujuan->status == 'ditolak' ? 'bg-red-100' : '' }}">
                        {{ ucfirst($persetujuan->status) }}
                    </span>
                </p>
            </div>

            @if($persetujuan->status == 'pending')
                <!-- Form Approve -->
                <form action="{{ route('persetujuan.approve', $persetujuan) }}" method="POST" class="mb-4">
                    @csrf
                    <label class="block font-medium mb-1">Catatan (opsional):</label>
                    <textarea name="catatan" rows="2" class="w-full border rounded px-3 py-2 mb-2"></textarea>
                    <button class="bg-green-600 text-white px-4 py-2 rounded">✓ Setujui</button>
                </form>

                <!-- Form Reject -->
                <form action="{{ route('persetujuan.reject', $persetujuan) }}" method="POST">
                    @csrf
                    <label class="block font-medium mb-1">Alasan Penolakan (wajib):</label>
                    <textarea name="catatan" rows="2" class="w-full border rounded px-3 py-2 mb-2" required></textarea>
                    <button class="bg-red-600 text-white px-4 py-2 rounded">✗ Tolak</button>
                </form>
            @else
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm"><strong>Catatan:</strong> {{ $persetujuan->catatan ?? '-' }}</p>
                    <p class="text-sm"><strong>Tanggal Review:</strong>
                        {{ $persetujuan->approved_at?->format('d/m/Y H:i') ?? '-' }}</p>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('persetujuan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>