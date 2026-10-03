<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Program</h2>
    </x-slot>

    <div style="padding:30px; max-width:1100px; margin:0 auto;">

        {{-- Header Card --}}
        <div
            style="background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:25px 30px; margin-bottom:20px;">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px;">
                <div>
                    <h3 style="font-size:1.5rem; font-weight:700; margin:0 0 5px 0; color:#212529;">
                        {{ $program->nama_program }}
                    </h3>
                    <p style="font-size:0.9rem; color:#6c757d; margin:0;">
                        Kode: {{ $program->kode_program }}
                    </p>
                </div>
                <span style="padding:8px 18px; border-radius:6px; font-size:0.9rem; font-weight:600;
                    {{ $program->status == 'aktif' ? 'background:#d1e7dd; color:#0f5132;' : '' }}
                    {{ $program->status == 'draft' ? 'background:#fff3cd; color:#664d03;' : '' }}
                    {{ $program->status == 'selesai' ? 'background:#cfe2ff; color:#084298;' : '' }}
                    {{ $program->status == 'ditutup' ? 'background:#e2e3e5; color:#41464b;' : '' }}">
                    {{ strtoupper($program->status) }}
                </span>
            </div>
        </div>

        {{-- Info Program --}}
        <div
            style="background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:25px; margin-bottom:20px;">
            <h4
                style="font-size:1rem; font-weight:700; margin:0 0 18px 0; color:#212529; border-bottom:1px solid #f1f3f5; padding-bottom:12px;">
                📋 Informasi Program
            </h4>
            <table style="width:100%; border-collapse:collapse;">
                <tr style="border-bottom:1px solid #f1f3f5;">
                    <td style="padding:12px 0; color:#6c757d; font-size:0.9rem; width:180px;">Kategori</td>
                    <td style="padding:12px 0; font-weight:600; color:#212529;">{{ ucfirst($program->kategori ?? '-') }}
                    </td>
                </tr>
                <tr style="border-bottom:1px solid #f1f3f5;">
                    <td style="padding:12px 0; color:#6c757d; font-size:0.9rem;">Jenis</td>
                    <td style="padding:12px 0; font-weight:600; color:#212529;">{{ ucfirst($program->jenis ?? '-') }}
                    </td>
                </tr>
                <tr style="border-bottom:1px solid #f1f3f5;">
                    <td style="padding:12px 0; color:#6c757d; font-size:0.9rem;">Deskripsi</td>
                    <td style="padding:12px 0; font-weight:600; color:#212529;">{{ $program->deskripsi ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding:12px 0; color:#6c757d; font-size:0.9rem;">Periode</td>
                    <td style="padding:12px 0; font-weight:600; color:#212529;">
                        {{ \Carbon\Carbon::parse($program->periode_mulai)->format('d/m/Y') }}
                        @if($program->periode_selesai)
                            - {{ \Carbon\Carbon::parse($program->periode_selesai)->format('d/m/Y') }}
                        @else
                            - Sekarang
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        {{-- 3 Kartu Keuangan --}}
        <div style="display:flex; gap:20px; margin-bottom:20px; flex-wrap:wrap;">
            <div
                style="flex:1 1 200px; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:20px; border-left:5px solid #0d6efd;">
                <p style="font-size:0.85rem; color:#6c757d; margin:0 0 8px 0;">Target Dana</p>
                <p style="font-size:1.3rem; font-weight:700; color:#0d6efd; margin:0;">Rp
                    {{ number_format($program->target_dana, 0, ',', '.') }}</p>
            </div>
            <div
                style="flex:1 1 200px; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:20px; border-left:5px solid #198754;">
                <p style="font-size:0.85rem; color:#6c757d; margin:0 0 8px 0;">Terkumpul</p>
                <p style="font-size:1.3rem; font-weight:700; color:#198754; margin:0;">Rp
                    {{ number_format($program->dana_terkumpul, 0, ',', '.') }}</p>
            </div>
            <div
                style="flex:1 1 200px; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:20px; border-left:5px solid #dc3545;">
                <p style="font-size:0.85rem; color:#6c757d; margin:0 0 8px 0;">Tersalurkan</p>
                <p style="font-size:1.3rem; font-weight:700; color:#dc3545; margin:0;">Rp
                    {{ number_format($program->dana_tersalurkan, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Progress Bar --}}
        @php
            $target = $program->target_dana ?? 0;
            $terkumpul = $program->dana_terkumpul ?? 0;
            $persen = $target > 0 ? min(round(($terkumpul / $target) * 100), 100) : 0;
        @endphp

        <div
            style="background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.06); padding:25px; margin-bottom:20px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <h4 style="font-weight:700; margin:0; color:#212529;">📊 Progress Pencapaian</h4>
                <span style="font-weight:700; color:#0d6efd; font-size:1.1rem;">{{ $persen }}%</span>
            </div>
            <div style="width:100%; background:#e9ecef; border-radius:10px; height:20px; overflow:hidden;">
                <div style="background:linear-gradient(90deg, #0d6efd, #0a58ca); height:100%; width:{{ $persen }}%;">
                </div>
            </div>
            <p style="font-size:0.85rem; color:#6c757d; margin:10px 0 0 0; text-align:right;">
                Rp {{ number_format($terkumpul, 0, ',', '.') }} dari Rp {{ number_format($target, 0, ',', '.') }}
            </p>
        </div>

        {{-- Tombol --}}
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('program.index') }}"
                style="background:#6c757d; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600; font-size:0.9rem;">
                ← Kembali
            </a>
            <a href="{{ route('program.edit', $program->id) }}"
                style="background:#fd7e14; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600; font-size:0.9rem;">
                ✏️ Edit Program
            </a>
        </div>

    </div>
</x-app-layout>