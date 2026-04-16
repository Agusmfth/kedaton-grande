<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedaton Grande</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link">{{ auth()->user()->name ?? 'User' }}</span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm mt-1 mr-2">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light ml-2">Kedaton Grande</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name ?? 'User' }}</a>
                        <small class="text-light">
                            @if(auth()->user()->role == 'admin')
                            Admin
                            @elseif(auth()->user()->role == 'konsumen')
                            Konsumen
                            @elseif(auth()->user()->role == 'lapangan')
                            Bagian Lapangan
                            @elseif(auth()->user()->role == 'pimpinan')
                            Pimpinan
                            @endif
                        </small>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        {{-- Dashboard --}}
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        {{-- ADMIN --}}
                        @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('serah-terima*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>Data Serah Terima Kunci</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pengaduan.index') }}"
                                class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>Pengaduan Konsumen</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('tugas-perbaikan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Tugas Perbaikan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Laporan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('cetak-laporan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-print"></i>
                                <p>Cetak Laporan</p>
                            </a>
                        </li>
                        @endif

                        {{-- KONSUMEN --}}
                        @if(auth()->user()->role == 'konsumen')
                        <li class="nav-item">
                            <a href="{{ route('pengaduan.index') }}"
                                class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>Pengaduan Konsumen</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('status.index') }}"
                                class="nav-link {{ request()->routeIs('status.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Status Perbaikan</p>
                            </a>
                        </li>
                        @endif

                        {{-- BAGIAN LAPANGAN --}}
                        @if(auth()->user()->role == 'lapangan')
                        <li class="nav-item">
                            <a href="{{ route('pengaduan.index') }}"
                                class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Tugas Perbaikan</p>
                            </a>
                        </li>
                        @endif

                        {{-- PIMPINAN --}}
                        @if(auth()->user()->role == 'pimpinan')
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Laporan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('cetak-laporan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-print"></i>
                                <p>Cetak Laporan</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    @isset($header)
                    {{ $header }}
                    @endisset
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-sm">
            <strong>Copyright &copy; {{ date('Y') }} Kedaton Grande.</strong>
            All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>