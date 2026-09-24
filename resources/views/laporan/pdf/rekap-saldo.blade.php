<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rekap Saldo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
        }

        .box {
            border: 1px solid #333;
            padding: 20px;
            margin-top: 20px;
        }

        .row {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .row:last-child {
            border-bottom: none;
            font-size: 16px;
            font-weight: bold;
            padding-top: 20px;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LEMBAGA AMIL ZAKAT PERSIS</h2>
        <p>Sistem Manajemen & Digitalisasi LAZ PERSIS</p>
        <h3 style="margin-top: 15px;">REKAP SALDO</h3>
        <p>Periode: {{ $tanggalMulai }} s/d {{ $tanggalSelesai }}</p>
    </div>

    <div class="box">
        <div class="row">
            <span>Total Penerimaan</span>
            <strong style="float:right;">Rp {{ number_format($totalPenerimaan, 0, ',', '.') }}</strong>
        </div>
        <div class="row">
            <span>Total Penyaluran</span>
            <strong style="float:right;">Rp {{ number_format($totalPenyaluran, 0, ',', '.') }}</strong>
        </div>
        <div class="row">
            <span>Saldo Akhir</span>
            <strong style="float:right;">Rp {{ number_format($saldo, 0, ',', '.') }}</strong>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ $tanggalCetak }}</p>
        <br><br>
        <p>Tanda Tangan Pimpinan</p>
        <br><br><br>
        <p>_____________________</p>
    </div>
</body>

</html>