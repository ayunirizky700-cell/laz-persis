<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Muzakki</title>
    <style>
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

        .text-center {
            text-align: center;
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

    <div class="header">
        <h1>LAZ PERSIS</h1>
        <p>Jl. Contoh Alamat No. 123, Kota Anda, Provinsi</p>
        <p>Telp: (021) 1234567 | Email: info@lazpersis.com</p>
    </div>

    <div class="title">
        LAPORAN DATA MUZAKKI
        <br>
        Periode: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Kode</th>
                <th width="20%">Nama</th>
                <th width="12%">Telepon</th>
                <th width="20%">Alamat</th>
                <th width="13%">Kategori</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($muzakkis as $key => $m)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $m->kode }}</td>
                    <td>{{ $m->nama }}</td>
                    <td class="text-center">{{ $m->no_telepon ?? '-' }}</td>
                    <td>{{ $m->alamat ?? '-' }}</td>
                    <td class="text-center">{{ ucfirst($m->kategori) }}</td>
                    <td class="text-center">{{ ucfirst($m->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data muzakki.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="ttd">
            <p>Kota Anda, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>Pimpinan LAZ PERSIS</p>
            <br><br><br>
            <p><b>( ____________________ )</b></p>
        </div>
    </div>

</body>

</html>