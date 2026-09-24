<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penerimaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row {
            background-color: #e8e8e8;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LEMBAGA AMIL ZAKAT PERSIS</h2>
        <p>Sistem Manajemen & Digitalisasi LAZ PERSIS</p>
        <h3 style="margin-top: 15px;">LAPORAN PENERIMAAN DANA</h3>
        <p>Periode: {{ request('tanggal_mulai') ?? 'Semua' }} s/d {{ request('tanggal_selesai') ?? 'Sekarang' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">No. Transaksi</th>
                <th width="12%">Tanggal</th>
                <th width="20%">Muzakki/Donatur</th>
                <th width="12%">Jenis Dana</th>
                <th width="15%">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $p)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $p->nomor_transaksi }}</td>
                    <td>{{ $p->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $p->muzakki->nama ?? $p->nama_donatur ?? 'Anonim' }}</td>
                    <td>{{ ucfirst($p->jenis_dana) }}</td>
                    <td class="text-right">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right">TOTAL</td>
                <td class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggalCetak }}</p>
        <br><br>
        <p>Tanda Tangan Pimpinan</p>
        <br><br><br>
        <p>_____________________</p>
    </div>
</body>

</html>