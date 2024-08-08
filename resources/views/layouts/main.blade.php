<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIKEUMAS-NF</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/select2.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- CSS Internal-->
    <style>
        body,
        html {
            overflow: auto;
            height: 100%;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: "Roboto", sans-serif;
            background-color: #f7f7f7;
            font-family: "Roboto", Arial, Helvetica, sans-serif;
        }

        @media (min-width: 768px) {
            .sidebar {
                display: block;
            }
        }

        @media (max-width: 767px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-top: 3rem;
                /* Menambahkan margin atas untuk memberi ruang bagi tombol toggle */
            }

            #toggleSidebar {
                font-size: 1.5rem;
                /* Ukuran font */
                padding: 0.25rem 0.5rem;
                /* Padding */
                position: fixed;
                /* Tetap di tempat */
                top: 20px;
                /* Jarak dari atas */
                left: 20px;
                /* Jarak dari kiri */
                z-index: 2000;
                /* Di atas konten lain */
            }
        }

        .nav-link:hover {
            background-color: #c0d406;
            color: #ffffff;
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
            padding-left: 70px;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        .container {
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 2px 2px 2px #888888;
        }

        #grafik {
            margin-top: 1em;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 1px 1px 1px #888888;
        }

        .sidebar {
            background-color: #469aee;
            color: #ffffff;
            border-radius: 0 15px 15px 0;
            box-shadow: 1px 1px 1px #888888;
            transition: all 0.3s;
        }

        #dana-pekan-lalu:hover {
            background-color: #f98619;
            color: #ffffff;
            border-radius: 5px;
        }

        #dana-masuk:hover {
            background-color: #198754;
            color: #ffffff;
            border-radius: 5px;
        }

        #dana-keluar:hover {
            background-color: #dc3545;
            color: #ffffff;
            border-radius: 5px;
        }

        #dana-total:hover {
            background-color: #0d6efd;
            color: #ffffff;
            border-radius: 5px;
        }

        .sidebar ul li a {
            font-weight: 500;
        }

        #header-judul {
            font-weight: 600;
        }

        /* Styles for small screens */
        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                height: 100%;
                display: block;
                z-index: 1500;
            }

            .sidebar.active {
                left: 0;
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1499;
                display: none;
            }

            .overlay.active {
                display: block;
            }
        }
    </style>

</head>

<body>

    <!-- Tombol Toggle Sidebar -->
    <button class="btn btn-primary d-md-none" id="toggleSidebar" type="button" aria-expanded="false"
        aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <div class="container-fluid p-0">
        <div class="overlay"></div>
        <div class="d-flex">
            <!-- Sidebar-->
            <div class="sidebar">
                <div class="d-flex flex-column flex-shrink-0 p-3" style="min-width: 250px; min-height: 100vh;">
                    <a href="/"
                        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="/img/logo-masjidnf.png" width="50" height="50" alt="">
                        <span class="px-2" id="header-judul">SIKEUMAS NF</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link d-flex align-items-center gap-2 text-white"
                                aria-current="page">
                                @include('icons/home')
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="/dana_masuk" class="nav-link d-flex align-items-center gap-2 text-white"
                                aria-current="page">
                                @include('icons/dana-masuk')
                                Dana Masuk
                            </a>
                        </li>
                        <li>
                            <a href="/dana_keluar" class="nav-link d-flex align-items-center gap-2 text-white"
                                aria-current="page">
                                @include('icons/dana-keluar')
                                Dana Keluar
                            </a>
                        </li>
                        <li>
                            <a href="/laporan/cetak" target="_blank"
                                class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                                @include('icons/cetak-laporan')
                                Cetak Laporan
                            </a>
                        </li>
                        <li>
                            <a href="/" class="nav-link d-flex align-items-center gap-2 text-white"
                                aria-current="page">
                                @include('icons/halaman-awal')
                                Laporan Keuangan
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle p-3"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>Admin</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content-->
            <main class="main-content p-4">
                @yield('container')
            </main>
        </div>
    </div>


    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/sidebars.js"></script>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        document.querySelector('.overlay').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>

</body>

</html>
