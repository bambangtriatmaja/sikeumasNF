<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Keuangan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .no-print {
            display: none;
        }

        @media print {
            body {
                font-size: 12pt;
            }

            .no-print {
                display: none;
            }
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media print {
            button {
                display: none;
            }
        }

        .content img {
            width: 5rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #periode {
            text-align: center;
            color: #333;
        }

        .total p {
            font-size: 1em;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="content">
        <!-- Konten halaman -->
        <img src="/img/logo-masjidnf.png" alt="">
        <h2>Laporan Keuangan Pekanan</h2>
        <h3>Masjid Nurul Fikri, Depok</h3>
        <p id="periode">Periode: {{ $today->format('d F Y') }} - {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <hr>

        <!-- Total Dana Masuk dan Dana Keluar -->
        <div class="total">
            <p>Total Dana Masuk Sepekan Kemarin: Rp. {{ number_format($totalLast7DaysMasuk) }}</p>
            <p>Infaq Jum'at Kemarin: Rp. {{ number_format($totalDanaMasukLastFriday) }}</p>
            <p>Total Dana Keluar: Rp. {{ number_format($totalLast7DaysKeluar) }}</p>
            <p>Saldo Akhir: Rp. {{ number_format($totalSaldo, 0, ',', '.') }}</p>
        </div>
        <hr>

        <!-- Tabel data dana masuk -->
        <h3>Data Dana Masuk</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataDanaMasuk as $index => $masuk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $masuk->tanggal }}</td>
                        <td>{{ number_format($masuk->nominal) }}</td>
                        <td>{{ $masuk->ket_pemasukan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tabel data dana keluar -->
        <h3>Data Dana Keluar</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataDanaKeluar as $index => $keluar)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $keluar->tanggal }}</td>
                        <td>{{ number_format($keluar->nominal) }}</td>
                        <td>{{ $keluar->ket_pengeluaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>

    </div>

    <!-- Script JavaScript untuk fungsi cetak -->
    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
