<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Penerimaan</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-2xl font-bold mb-4">{{ $penerimaan->nomor_transaksi }}</h3>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><strong>Tanggal:</strong> {{ $penerimaan->tanggal->format('d/m/Y') }}</div>
                <div><strong>Jenis Dana:</strong> {{ ucfirst($penerimaan->jenis_dana) }}</div>
                <div><strong>Muzakki:</strong> {{ $penerimaan->muzakki->nama ?? $penerimaan->nama_donatur ?? 'Anonim' }}
                </div>
                <div><strong>Program:</strong> {{ $penerimaan->program->nama_program ?? '-' }}</div>
                <div><strong>Nominal:</strong> Rp {{ number_format($penerimaan->nominal, 0, ',', '.') }}</div>
                <div><strong>Metode:</strong> {{ ucfirst(str_replace('_', ' ', $penerimaan->metode_pembayaran)) }}</div>
                <div><strong>Status:</strong> {{ ucfirst($penerimaan->status) }}</div>
                <div><strong>Keterangan:</strong> {{ $penerimaan->keterangan ?? '-' }}</div>
            </div>

            @if($penerimaan->bukti_pembayaran)
                <div class="mt-4">
                    <strong>Bukti Pembayaran:</strong><br>
                    <img src="{{ asset('storage/' . $penerimaan->bukti_pembayaran) }}" class="max-w-md mt-2 border rounded">
                </div>
            @endif

            <div class="mt-6 flex gap-2">
                @if($penerimaan->status == 'pending')
                    <form action="{{ route('penerimaan.validasi', $penerimaan) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="valid">
                        <button class="bg-green-600 text-white px-4 py-2 rounded">Validasi (Valid)</button>
                    </form>
                    <form action="{{ route('penerimaan.validasi', $penerimaan) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="ditolak">
                        <button class="bg-red-600 text-white px-4 py-2 rounded">Tolak</button>
                    </form>
                @endif
                <a href="{{ route('penerimaan.index') }}" class="bg-gray-300 px-4 py-2 rounded">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>