<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Penerimaan</h2>
    </x-slot>

    <div style="padding:30px; max-width:1100px; margin:0 auto;">

        {{-- Header Card --}}
        <div
            style="background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:25px 30px; margin-bottom:20px;">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px;">
                <div>
                    <h3 style="font-size:1.5rem; font-weight:700; margin:0 0 5px 0; color:#212529;">
                        {{ $penerimaan->nomor_transaksi }}
                    </h3>
                    <p style="font-size:0.9rem; color:#6c757d; margin:0;">
                        {{ \Carbon\Carbon::parse($penerimaan->tanggal)->format('d F Y') }}
                    </p>
                </div>
                <span style="padding:8px 18px; border-radius:6px; font-size:0.9rem; font-weight:600;
                    {{ $penerimaan->status == 'valid' ? 'background:#d1e7dd; color:#0f5132;' : '' }}
                    {{ $penerimaan->status == 'pending' ? 'background:#fff3cd; color:#664d03;' : '' }}
                    {{ $penerimaan->status == 'ditolak' ? 'background:#f8d7da; color:#842029;' : '' }}
                    {{ $penerimaan->status == 'dibatalkan' ? 'background:#e2e3e5; color:#41464b;' : '' }}">
                    {{ strtoupper($penerimaan->status) }}
                </span>
            </div>
        </div>

        {{-- Kartu Nominal --}}
        <div
            style="background:linear-gradient(135deg, #198754 0%, #20c997 100%); border-radius:12px; padding:25px 30px; margin-bottom:20px; color:#fff;">
            <p style="font-size:0.85rem; margin:0 0 8px 0; opacity:0.9;">Nominal Penerimaan</p>
            <p style="font-size:2rem; font-weight:800; margin:0;">Rp
                {{ number_format($penerimaan->nominal, 0, ',', '.') }}</p>
        </div>

        {{-- Grid Informasi --}}
        <div style="display:flex; gap:20px; margin-bottom:20px; flex-wrap:wrap;">
            {{-- Kolom Kiri --}}
            <div
                style="flex:1 1 300px; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:25px;">
                <h4
                    style="font-size:1rem; font-weight:700; margin:0 0 18px 0; color:#212529; border-bottom:1px solid #f1f3f5; padding-bottom:12px;">
                    📋 Informasi Donatur
                </h4>
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="padding:10px 0; color:#6c757d; font-size:0.9rem; width:120px;">Muzakki</td>
                        <td style="padding:10px 0; font-weight:600; color:#212529;">
                            {{ $penerimaan->muzakki->nama ?? $penerimaan->nama_donatur ?? 'Anonim' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; color:#6c757d; font-size:0.9rem;">Jenis Dana</td>
                        <td style="padding:10px 0; font-weight:600; color:#212529;">
                            {{ ucfirst(str_replace('_', ' ', $penerimaan->jenis_dana)) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; color:#6c757d; font-size:0.9rem;">Program</td>
                        <td style="padding:10px 0; font-weight:600; color:#212529;">
                            {{ $penerimaan->program->nama_program ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Kolom Kanan --}}
            <div
                style="flex:1 1 300px; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:25px;">
                <h4
                    style="font-size:1rem; font-weight:700; margin:0 0 18px 0; color:#212529; border-bottom:1px solid #f1f3f5; padding-bottom:12px;">
                    💳 Informasi Pembayaran
                </h4>
                <table style="width:100%; border-collapse:collapse;">
                    <tr>
                        <td style="padding:10px 0; color:#6c757d; font-size:0.9rem; width:120px;">Metode</td>
                        <td style="padding:10px 0; font-weight:600; color:#212529;">
                            {{ ucfirst(str_replace('_', ' ', $penerimaan->metode_pembayaran)) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; color:#6c757d; font-size:0.9rem;">No. Referensi</td>
                        <td style="padding:10px 0; font-weight:600; color:#212529;">
                            {{ $penerimaan->no_referensi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; color:#6c757d; font-size:0.9rem;">Keterangan</td>
                        <td style="padding:10px 0; font-weight:600; color:#212529;">{{ $penerimaan->keterangan ?? '-' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Bukti Pembayaran --}}
        @if($penerimaan->bukti_pembayaran)
            <div
                style="background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:25px; margin-bottom:20px;">
                <h4
                    style="font-size:1rem; font-weight:700; margin:0 0 18px 0; color:#212529; border-bottom:1px solid #f1f3f5; padding-bottom:12px;">
                    📎 Bukti Pembayaran
                </h4>
                <div style="text-align:center;">
                    <img src="{{ asset('storage/' . $penerimaan->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                        style="max-width:100%; max-height:500px; border-radius:8px; border:1px solid #e9ecef;">
                </div>
            </div>
        @endif

        {{-- Tombol Aksi --}}
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('penerimaan.index') }}"
                style="background:#6c757d; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600; font-size:0.9rem;">
                ← Kembali
            </a>
            @if($penerimaan->status == 'pending')
                <a href="{{ route('penerimaan.edit', $penerimaan->id) }}"
                    style="background:#fd7e14; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600; font-size:0.9rem;">
                    ✏️ Edit
                </a>
            @endif
        </div>

    </div>
</x-app-layout>