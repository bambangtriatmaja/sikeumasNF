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
      h1, h2, h3 {
          text-align: center;
          color: #333;
      }
      table {
          width: 100%;
          border-collapse: collapse;
          margin-bottom: 20px;
      }
      table th, table td {
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
  </style>
</head>
<body>

<div class="content">
    <!-- Konten halaman -->
    <h1>Laporan Keuangan Pekanan</h1>
    <p>Periode: {{ $tanggalMulai->format('d F Y') }} - {{ \Carbon\Carbon::now()->format('d F Y') }}</p>

    <!-- Tabel data dana masuk -->
    <h2>Data Dana Masuk</h2>
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
                <td>{{ number_format($masuk->nominal)}}</td>
                <td>{{ $masuk->ket_pemasukan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel data dana keluar -->
    <h2>Data Dana Keluar</h2>
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
                <td>{{ number_format($keluar->nominal)}}</td>
                <td>{{ $keluar->ket_pengeluaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total Dana Masuk dan Dana Keluar -->
    <h2>Total Dana Masuk: Rp. {{ number_format($totalDanaMasuk) }}</h2>
    <h2>Total Dana Keluar: Rp. {{ number_format($totalDanaKeluar) }}</h2>

    <button class="no-print" onclick="printReport()">Cetak Laporan</button>
</div>

<!-- Script JavaScript untuk fungsi cetak -->
<script type="text/javascript">

  window.print();
  </script>

</body>
</html>
