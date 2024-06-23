<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIKEUMAS-NF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    
    {{-- navbar --}}
    <nav class="navbar bg-body">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="img/logo-masjidnf.png" class="ml-auto" alt="Bootstrap" width="50" height="50">
        </a>
      </div>
    </nav>
    {{-- end of navbar --}}

    {{-- Hero --}}
    <div class="hero">
      <img src="img/masjidnf.jpeg" alt="gambar-masjid-nf">
      <div class="hero-text">
        <h2>SISTEM INFORMASI LAPORAN KEUANGAN MASJID NURUL FIKRI DEPOK</h2>
        <button>Lihat Laporan</button>
      </div>
    </div>
    {{-- end of Hero --}}

    <div class="laporan">
      <div class="laporan-text">
        <h3>Laporan Keuangan</h3>
        <h5>Laporan Pekanan</h5>
        <p>31 Mei - 07 Juni 2024</p>
      </div>
      
      <div class="tabel-laporan">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Infaq</th>
              <th scope="col">Pengeluaran</th>
              <th scope="col">Keterangan Pengeluaran</th>
              <th scope="col">Saldo Akhir</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
              <th scope="row">{{ $item->tanggal}}</th>
              <td>{{ $item->formatRupiah('infaq')}}</td>
              <td>{{ $item->formatRupiah('pengeluaran')}}</td>
              <td>{{ $item->ket_pengeluaran}}</td>
              <td>{{ $item->formatRupiah('saldo_akhir')}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
    </div>

    {{-- Footer --}}
    <div class="footer">
      <h3>SIKEUMAS 2024</h3>
    </div>
    
    {{-- end of footer --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>