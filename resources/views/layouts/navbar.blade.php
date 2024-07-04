<div class="sidebar">
    <!-- Tombol Toggle Sidebar -->
    <button class="btn btn-primary d-md-none" id="toggleSidebar" type="button" aria-expanded="false"
        aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="min-width: 250px; min-height: 100vh;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img src="img/logo-masjidnf.png" width="50" height="50" alt="">
            <span class="px-2">SIKEUMAS</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="/dashboard" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                    @include('icons/home')
                    Dashboard
                </a>
            </li>
            <li>
                <a href="/dana_masuk" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                    @include('icons/dana-masuk')
                    Dana Masuk
                </a>
            </li>
            <li>
                <a href="/dana_keluar" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                    @include('icons/dana-keluar')
                    Dana Keluar
                </a>
            </li>
            <li>
                <a href="/laporan/cetak" target="_blank" class="nav-link d-flex align-items-center gap-2 text-white"
                    aria-current="page">
                    @include('icons/cetak-laporan')
                    Cetak Laporan
                </a>
            </li>
            <li>
                <a href="/" class="nav-link d-flex align-items-center gap-2 text-white" aria-current="page">
                    @include('icons/halaman-awal')
                    Halaman Awal
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle p-3"
                data-bs-toggle="dropdown" aria-expanded="false">
                <strong>Admin</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                {{-- <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li> --}}
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        if (sidebar.style.display === 'block') {
            sidebar.style.display = 'none';
        } else {
            sidebar.style.display = 'block';
        }
    });
</script>
