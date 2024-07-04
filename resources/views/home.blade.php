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
    <link rel="stylesheet" href="/scss/_variables.scss">
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

    <div class="container mt-5 hero-section">
      <div class="row align-items-center">
          <div class="col-md-6">
              <h3 class="display-6">Selamat Datang di Halaman Laporan Keuangan Masjid Nurul Fikri</h3>
              <p class="lead">Laporan keuangan masjid selama sepekan dapat diakses dibawah ini.</p>
              <a href="#rincian" class="btn btn-primary btn-lg">Lihat Laporan</a>
          </div>
          <div class="col-md-6">
              <img src="img/masjidnf.jpeg" alt="gambar-masjid-nf" class="img-fluid">
          </div>
      </div>
  </div>


    {{-- Card Laporan --}}
    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
          <h3>Laporan Keuangan Selama Sepekan</h3>
          <p>{{ \Carbon\Carbon::now()->subDays(7)->format('d M Y') }} - {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
      </div>
  
      <div class="row">
          <div class="col-md-4">
            <div class="card text-white bg-light mb-3 border-success">
              <div class="card-header text-success">Total Dana Masuk</div>
              <div class="card-body">
                  <h5 class="card-title text-success">Rp {{ number_format($totalLast7DaysMasuk, 0, ',', '.') }}</h5>
                  <p class="card-text text-muted">Dana masuk selama 7 hari terakhir.</p>
              </div>
          </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-light mb-3 border-danger">
              <div class="card-header text-danger">Total Dana Keluar</div>
              <div class="card-body">
                  <h5 class="card-title text-danger">Rp {{ number_format($totalLast7DaysKeluar, 0, ',', '.') }}</h5>
                  <p class="card-text text-muted">Dana keluar selama 7 hari terakhir.</p>
              </div>
          </div>
          </div>
          <div class="col-md-4">
            <div class="card text-white bg-light mb-3 border-info">
              <div class="card-header text-info">Total Saldo</div>
              <div class="card-body">
                  <h5 class="card-title text-info">Rp {{ number_format($totalLast7DaysMasuk - $totalLast7DaysKeluar, 0, ',', '.') }}</h5>
                  <p class="card-text text-muted">Saldo selama 7 hari terakhir.</p>
              </div>
          </div>
          </div>
      </div>

    {{-- Tabel detail --}}
      <div class="container mt-5">
        <h4 class="text-center mb-4" id="rincian">Rincian</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white text-center">
                        Dana Masuk (7 Hari Terakhir)
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataDanaMasuk as $dana)
                                    <tr>
                                        <td>{{ $dana->tanggal }}</td>
                                        <td>{{ number_format($dana->nominal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white text-center">
                        Dana Keluar (7 Hari Terakhir)
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataDanaKeluar as $dana)
                                    <tr>
                                        <td>{{ $dana->tanggal }}</td>
                                        <td>{{ number_format($dana->nominal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="pt-3">
        <h4>Detail grafik</h4>
        <hr><br>
      </div>
      <!-- Grafik Dana Masuk dan Dana Keluar -->
      <div class="row">
        <!-- Grafik Dana Masuk -->
        <div class="col-md-6">
            <h4>Grafik Dana Masuk</h4>
            <canvas id="grafikDanaMasuk"></canvas>
        </div>
    
        <!-- Grafik Dana Keluar -->
        <div class="col-md-6">
            <h4>Grafik Dana Keluar</h4>
            <canvas id="grafikDanaKeluar"></canvas>
        </div>
      </div> --}}
    
    {{-- <!-- Script untuk Grafik Dana Masuk -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          var ctxMasuk = document.getElementById('grafikDanaMasuk').getContext('2d');
          var myChartMasuk = new Chart(ctxMasuk, {
              type: 'line',
              data: {
                  labels: [
                      @foreach ($dataDanaMasuk as $danaMasuk)
                          '{{ $danaMasuk->tanggal }}',
                      @endforeach
                  ],
                  datasets: [{
                      label: 'Nominal Dana Masuk',
                      data: [
                          @foreach ($dataDanaMasuk as $danaMasuk)
                              {{ $danaMasuk->nominal }},
                          @endforeach
                      ],
                      fill: false,
                      borderColor: 'rgba(54, 162, 235, 1)', // Warna garis
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true,
                              callback: function(value) { if (value % 1 === 0) { return value; } }
                          }
                      }]
                  }
              }
          });
      });
    </script> --}}
    
    {{-- <!-- Script untuk Grafik Dana Keluar -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          var ctxKeluar = document.getElementById('grafikDanaKeluar').getContext('2d');
          var myChartKeluar = new Chart(ctxKeluar, {
              type: 'line',
              data: {
                  labels: [
                      @foreach ($dataDanaKeluar as $danaKeluar)
                          '{{ $danaKeluar->tanggal }}',
                      @endforeach
                  ],
                  datasets: [{
                      label: 'Nominal Dana Keluar',
                      data: [
                          @foreach ($dataDanaKeluar as $danaKeluar)
                              {{ $danaKeluar->nominal }},
                          @endforeach
                      ],
                      fill: false,
                      borderColor: 'rgba(255, 99, 132, 1)', // Warna garis
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true,
                              callback: function(value) { if (value % 1 === 0) { return value; } }
                          }
                      }]
                  }
              }
          });
      });
    </script> --}}

    {{-- Footer --}}
    <div class="footer">
      <h3>SIKEUMAS 2024</h3>
    </div>
    
    {{-- end of footer --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>