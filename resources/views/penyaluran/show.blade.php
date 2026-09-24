<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Penyaluran</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-2xl font-bold mb-4">{{ $penyaluran->nomor_transaksi }}</h3>

            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                <div><strong>Tanggal Pengajuan:</strong> {{ $penyaluran->tanggal_pengajuan->format('d/m/Y') }}</div>
                <div><strong>Tanggal Realisasi:</strong> {{ $penyaluran->tanggal_realisasi?->format('d/m/Y') ?? '-' }}
                </div>
                <div><strong>Program:</strong> {{ $penyaluran->program->nama_program ?? '-' }}</div>
                <div><strong>Mustahik:</strong> {{ $penyaluran->mustahik->nama ?? '-' }}</div>
                <div><strong>Jenis Bantuan:</strong> {{ ucfirst($penyaluran->jenis_bantuan) }}</div>
                <div><strong>Nominal:</strong> Rp {{ number_format($penyaluran->nominal, 0, ',', '.') }}</div>
                <div><strong>Status:</strong> {{ ucfirst($penyaluran->status) }}</div>
                <div><strong>Deskripsi:</strong> {{ $penyaluran->deskripsi_bantuan ?? '-' }}</div>
            </div>

            @if($penyaluran->bukti_penyaluran)
                <div class="mt-4">
                    <strong>Bukti:</strong><br>
                    <img src="{{ asset('storage/' . $penyaluran->bukti_penyaluran) }}" class="max-w-md mt-2 border rounded">
                </div>
            @endif

            @if($penyaluran->persetujuan->count() > 0)
                <div class="mt-4 pt-4 border-t">
                    <strong>Riwayat Persetujuan:</strong>
                    <ul class="mt-2 space-y-1 text-sm">
                        @foreach($penyaluran->persetujuan as $p)
                            <li>
                                {{ $p->approver->nama ?? '-' }} —
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $p->status == 'pending' ? 'bg-yellow-100' : '' }}
                                    {{ $p->status == 'disetujui' ? 'bg-green-100' : '' }}
                                    {{ $p->status == 'ditolak' ? 'bg-red-100' : '' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                                @if($p->catatan) — "{{ $p->catatan }}" @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-6 flex gap-2">
                @if($penyaluran->status == 'draft')
                    <form action="{{ route('penyaluran.ajukan', $penyaluran) }}" method="POST">
                        @csrf
                        <button class="bg-yellow-600 text-white px-4 py-2 rounded">Ajukan ke Pimpinan</button>
                    </form>
                @endif
                @if($penyaluran->status == 'disetujui')
                    <form action="{{ route('penyaluran.realisasi', $penyaluran) }}" method="POST">
                        @csrf
                        <button class="bg-green-600 text-white px-4 py-2 rounded">Realisasi Sekarang</button>
                    </form>
                @endif
                <a href="{{ route('penyaluran.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>