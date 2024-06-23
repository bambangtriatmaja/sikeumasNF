@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2>Dashboard</h2>
    </div>

    <div class="container">
        <!-- Judul Laporan Keuangan dan Tanggal -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h3 class="float-md-start">Rekap Keuangan Selama Sepekan</h3>
            </div>
            <div class="col-md-6">
                <h5 class="float-md-end">
                    {{ \Carbon\Carbon::now()->subDays(7)->format('d F Y') }} - {{ \Carbon\Carbon::now()->format('d F Y') }}
                </h5>
            </div>
        </div>

      <div class="row">
          <!-- Card Total Dana Masuk -->
          <div class="col-md-4">
              <div class="card mb-4" style="background-color: #4CAF50; color: white;">
                  <div class="card-body">
                      <h5 class="card-title">Total Dana Masuk</h5>
                      <p class="card-text">Rp. {{ number_format($totalLast7DaysMasuk) }}</p>
                  </div>
              </div>
          </div>

          <!-- Card Total Dana Keluar -->
          <div class="col-md-4">
              <div class="card mb-4" style="background-color: #FF5733; color: white;">
                  <div class="card-body">
                      <h5 class="card-title">Total Dana Keluar</h5>
                      <p class="card-text">Rp. {{ number_format($totalLast7DaysKeluar) }}</p>
                  </div>
              </div>
          </div>

          <!-- Card Total Saldo -->
          <div class="col-md-4">
              <div class="card mb-4" style="background-color: #007BFF; color: white;">
                  <div class="card-body">
                      <h5 class="card-title">Total Saldo</h5>
                      <p class="card-text">Rp. {{ number_format($totalSaldo) }}</p>
                  </div>
              </div>
          </div>
      </div>

      <!-- Tabel Dana Masuk dan Dana Keluar Bersebelahan -->
      {{-- <div class="row">
        <h4>Detail</h4>
        <hr>
       <!-- Tabel Dana Masuk -->
      <div class="col-md-6">
        <h5>Tabel Dana Masuk</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Ket.Masuk</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataDanaMasuk as $danaMasuk)
                    <tr>
                        <td>{{ $danaMasuk->tanggal }}</td>
                        <td>{{ number_format($danaMasuk->nominal, 2) }}</td>
                        <td>{{ $danaMasuk->ket_pemasukan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>

      <!-- Tabel Dana Keluar -->
      <div class="col-md-6">
        <h5>Tabel Dana Keluar</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Ket.Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataDanaKeluar as $danaKeluar)
                    <tr>
                        <td>{{ $danaKeluar->tanggal }}</td>
                        <td>{{ number_format($danaKeluar->nominal, 2) }}</td>
                        <td>{{ $danaKeluar->ket_pengeluaran }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      </div> --}}
  </div>

  <div class="pt-3">
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
  </div>

<!-- Script untuk Grafik Dana Masuk -->
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
</script>

<!-- Script untuk Grafik Dana Keluar -->
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
</script>

@endsection