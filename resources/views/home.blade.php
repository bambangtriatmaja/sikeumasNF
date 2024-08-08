<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIKEUMAS-NF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/home.css">
</head>

<body>

    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo-masjidnf.png" class="ml-auto" alt="Bootstrap" width="50" id="hero-img">
                <span class="navbar-text">Sistem Informasi Keuangan Masjid Nurul Fikri Depok</span>
            </a>
        </div>
    </nav>
    {{-- end of navbar --}}

    <div class="container mt-3 p-3 hero-section" id="hero">
        <div class="row align-items-center">
            <div class="col-md-6 text-center mb-3 mb-md-0">
                <h3 class="display-6 text-md-start text-center">Selamat Datang di Halaman Laporan Keuangan Masjid Nurul
                    Fikri</h3>
                <p class="lead text-md-start text-center">Laporan keuangan masjid selama sepekan dapat diakses dibawah
                    ini.</p>
                {{-- <a href="#rincian" class="btn btn-primary btn-lg">Lihat Laporan</a> --}}
            </div>
            <div class="col-md-6">
                <img src="img/gambar-masjid-nf.png" alt="gambar-masjid-nf" class="img-fluid rounded">
            </div>
        </div>
    </div>


    {{-- Card Laporan --}}
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Laporan Keuangan Selama Sepekan</h3>
            <p>{{ \Carbon\Carbon::now()->subDays(7)->format('d M Y') }} - {{ \Carbon\Carbon::now()->format('d M Y') }}
            </p>
        </div>

        <div class="row" id="card-dana">
            <div class="col-md-4">
                <div class="card border-success mb-4">
                    <div class="card-header text-success">Total Dana Masuk</div>
                    <div class="card-body">
                        <h5 class="card-title text-success">Rp {{ number_format($totalLast7DaysMasuk, 0, ',', '.') }}
                        </h5>
                        <p class="card-text text-muted">Dana masuk selama 7 hari terakhir.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-danger mb-4">
                    <div class="card-header text-danger">Total Dana Keluar</div>
                    <div class="card-body">
                        <h5 class="card-title text-danger">Rp {{ number_format($totalLast7DaysKeluar, 0, ',', '.') }}
                        </h5>
                        <p class="card-text text-muted">Dana keluar selama 7 hari terakhir.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card border-primary mb-4">
                    <div class="card-header text-primary">Total Saldo</div>
                    <div class="card-body">
                        <h5 class="card-title text-primary">Rp
                            {{ number_format($totalSaldo, 0, ',', '.') }}</h5>
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
                        <div class="card-header bg-primary text-white text-center">
                            Dana Masuk (7 Hari Terakhir)
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataDanaMasuk as $dana)
                                        <tr>
                                            <td>{{ $dana->tanggal }}</td>
                                            <td>{{ number_format($dana->nominal, 2) }}</td>
                                            <td>{{ $dana->ket_pemasukan }}</td>
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
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataDanaKeluar as $dana)
                                        <tr>
                                            <td>{{ $dana->tanggal }}</td>
                                            <td>{{ number_format($dana->nominal, 2) }}</td>
                                            <td>{{ $dana->ket_pengeluaran }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <h6>SIKEUMAS 2024</h6>
        </div>

        {{-- end of footer --}}

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>


</html>
