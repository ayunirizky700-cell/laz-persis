<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Program</title>
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
        <h3 style="margin-top: 15px;">LAPORAN PROGRAM</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Kode</th>
                <th width="25%">Nama Program</th>
                <th width="15%">Target</th>
                <th width="15%">Terkumpul</th>
                <th width="15%">Tersalurkan</th>
                <th width="13%">Capaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($program as $i => $p)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $p->kode_program }}</td>
                    <td>{{ $p->nama_program }}</td>
                    <td class="text-right">Rp {{ number_format($p->target_dana, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($p->dana_terkumpul, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($p->dana_tersalurkan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $p->persentase_capaian }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggalCetak }}</p>
    </div>
</body>

</html>