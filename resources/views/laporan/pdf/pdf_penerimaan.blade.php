<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penerimaan Dana</title>
    <style>
        /* CSS Khusus untuk PDF (Jangan pakai Flexbox/Grid, gunakan Table atau Float) */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 11px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: center;
        }

        td {
            padding: 6px 8px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row {
            font-weight: bold;
            background-color: #e6e6e6;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .ttd {
            float: right;
            width: 200px;
            text-align: center;
        }

        .ttd p {
            margin-bottom: 60px;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT -->
    <div class="header">
        <h1>LAZ PERSIS</h1>
        <p>Jl. Contoh Alamat No. 123, Kota Anda, Provinsi</p>
        <p>Telp: (021) 1234567 | Email: info@lazpersis.com</p>
    </div>

    <!-- JUDUL LAPORAN -->
    <div class="title">
        LAPORAN PENERIMAAN DANA ZIS
        <br>
        Periode: {{ date('d F Y') }}
    </div>

    <!-- TABEL DATA -->
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="25%">Nama Donatur</th>
                <th width="25%">Program</th>
                <th width="15%">Metode</th>
                <th width="15%">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penerimaans as $key => $p)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $p->muzakki->nama ?? 'Hamba Allah' }}</td> {{-- Sesuaikan dengan relasi database Anda --}}
                    <td>{{ $p->program->nama_program ?? '-' }}</td>
                    <td class="text-center">{{ $p->metode ?? 'Transfer' }}</td>
                    <td class="text-right">{{ number_format($p->nominal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data penerimaan pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right">TOTAL PENERIMAAN</td>
                <td class="text-right">{{ number_format($totalPenerimaan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- TANDA TANGAN -->
    <div class="footer">
        <div class="ttd">
            <p>Kota Anda, {{ date('d F Y') }}<br>Pimpinan LAZ PERSIS</p>
            <br><br><br>
            <p><b>( ____________________ )</b></p>
        </div>
    </div>

</body>

</html>