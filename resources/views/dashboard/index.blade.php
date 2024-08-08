@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Dashboard Sistem Informasi Laporan Keuangan Masjid NF</h4>
    </div>

    <div class="container">
        <!-- Judul Laporan Keuangan dan Tanggal -->
        <div class="row mb-3">
            <div class="col-md-6">
                <h4 class="float-md-start">Rekap Keuangan</h4>
            </div>
            <div class="col-md-6">
                <h5 class="float-md-end">
                    {{ \Carbon\Carbon::now()->subDays(7)->format('d F Y') }} - {{ \Carbon\Carbon::now()->format('d F Y') }}
                </h5>
            </div>
        </div>

        <div class="row" id="card-dana">
            <!-- Card saldo pekan kemarin -->
            <div class="col-md-4">
                <div class="card border-warning mb-4">
                    <div class="card-body" id="dana-pekan-lalu">
                        <h5 class="card-title">Saldo Pekan Kemarin</h5>
                        <p class="card-text">Rp. {{ number_format($totallast14DaysKeluar) }}</p>
                    </div>
                </div>
            </div>

            <!-- Card total saldo jum'at pekan lalu -->
            <div class="col-md-4">
                <div class="card border-success mb-4">
                    <div class="card-body" id="dana-masuk">
                        <h5 class="card-title">Infaq Jum'at Pekan Lalu</h5>
                        <p class="card-text">Rp. {{ number_format($totalDanaMasukLastFriday) }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Total Dana Keluar -->
            <div class="col-md-4">
                <div class="card border-danger mb-4">
                    <div class="card-body" id="dana-keluar">
                        <h5 class="card-title">Total Dana Keluar Sepekan</h5>
                        <p class="card-text">Rp. {{ number_format($totalLast7DaysKeluar) }}</p>
                    </div>
                </div>
            </div>

            <!-- Card total saldo keseluruhan -->
            <div class="col-md-4">
                <div class="card border-success mb-4">
                    <div class="card-body" id="dana-masuk">
                        <h5 class="card-title">Total Saldo Keseluruhan</h5>
                        <p class="card-text">Rp. {{ number_format($totalSaldo) }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Total Dana Masuk -->
            <div class="col-md-4">
                <div class="card border-success mb-4">
                    <div class="card-body" id="dana-masuk">
                        <h5 class="card-title">Total Dana Masuk Sepekan</h5>
                        <p class="card-text">Rp. {{ number_format($totalLast7DaysMasuk) }}</p>
                    </div>
                </div>
            </div>


            <!-- Card Total Saldo Sepekan -->
            <div class="col-md-4">
                <div class="card card border-primary mb-4">
                    <div class="card-body" id="dana-total">
                        <h5 class="card-title">Saldo Bersih Sepekan</h5>
                        <p class="card-text">Rp. {{ number_format($totalSaldoSepekan) }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="pt-4" id="grafik">
        <h4>Pantauan Grafik</h4>
        <hr><br>
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
    </div>
    <!-- Grafik Dana Masuk dan Dana Keluar -->



    <!-- Script untuk Grafik Dana Masuk -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                                callback: function(value) {
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            }
                        }]
                    }
                }
            });
        });
    </script>

    <!-- Script untuk Grafik Dana Keluar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                                callback: function(value) {
                                    if (value % 1 === 0) {
                                        return value;
                                    }
                                }
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
