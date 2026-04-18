<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedaton Grande</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <style>
        :root {
            --kg-bg: #f6f7fb;
            --kg-surface: #ffffff;
            --kg-text: #1f2937;
            --kg-muted: #64748b;
            --kg-border: #e7ebf3;
            --kg-teal: #14b8a6;
            --kg-violet: #7c3aed;
            --kg-rose: #f43f5e;
            --kg-gold: #f59e0b;
        }

        body {
            background: var(--kg-bg);
            color: var(--kg-text);
            font-family: "Source Sans Pro", Arial, sans-serif;
        }

        .content-wrapper {
            background: var(--kg-bg);
        }

        .main-header {
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--kg-border);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
        }

        .main-header .nav-link {
            color: var(--kg-muted);
        }

        .top-user-name {
            color: var(--kg-text);
            font-weight: 700;
        }

        .main-sidebar {
            background: #ffffff;
            border-right: 1px solid var(--kg-border);
            box-shadow: 10px 0 30px rgba(15, 23, 42, 0.05);
        }

        .brand-link {
            border-bottom: 1px solid var(--kg-border);
            padding: 18px 16px;
        }

        .brand-link .brand-text {
            color: var(--kg-text);
            font-weight: 700;
        }

        .brand-mark {
            align-items: center;
            background: linear-gradient(135deg, var(--kg-teal), var(--kg-violet));
            border-radius: 8px;
            color: #fff;
            display: inline-flex;
            font-size: 14px;
            font-weight: 800;
            height: 34px;
            justify-content: center;
            margin-right: 10px;
            width: 34px;
        }

        .user-panel {
            background: #f8fafc;
            border: 1px solid var(--kg-border);
            border-radius: 8px;
            margin: 16px 10px 14px;
            padding: 14px;
        }

        .user-panel .info {
            padding: 0;
        }

        .user-panel .d-block {
            color: var(--kg-text);
            font-weight: 700;
        }

        .role-badge {
            background: #ecfeff;
            border-radius: 6px;
            color: #0f766e;
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            margin-top: 6px;
            padding: 4px 8px;
        }

        .nav-sidebar {
            padding: 0 10px;
        }

        .nav-sidebar .nav-item {
            margin-bottom: 5px;
        }

        .nav-sidebar .nav-link {
            border-radius: 8px;
            color: #667085;
            font-weight: 600;
            padding: 12px 13px;
        }

        .nav-sidebar .nav-link .nav-icon {
            color: #94a3b8;
            margin-right: 8px;
            width: 22px;
        }

        .nav-sidebar .nav-link:hover {
            background: #f1f5f9;
            color: var(--kg-text);
        }

        .nav-sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--kg-teal), var(--kg-violet));
            box-shadow: 0 10px 20px rgba(20, 184, 166, 0.22);
            color: #fff;
        }

        .nav-sidebar .nav-link.active .nav-icon {
            color: #fff;
        }

        .content-header {
            padding: 18px 0 6px;
        }

        .content-header h4 {
            color: var(--kg-text);
        }

        .card,
        .modal-content,
        .alert {
            border-radius: 8px;
        }

        .card {
            border: 1px solid var(--kg-border);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        }

        .card-header {
            background: var(--kg-surface);
            border-bottom: 1px solid var(--kg-border);
            padding: 16px 18px;
        }

        .card-title {
            color: var(--kg-text);
            font-weight: 700;
        }

        .card-footer {
            background: #fbfcfe;
            border-top: 1px solid var(--kg-border);
        }

        .form-group label {
            color: #344054;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .form-control {
            border: 1px solid #d9e1ec;
            border-radius: 8px;
            min-height: 42px;
        }

        textarea.form-control {
            min-height: auto;
        }

        .form-control:focus {
            border-color: var(--kg-teal);
            box-shadow: 0 0 0 0.16rem rgba(20, 184, 166, 0.15);
        }

        .form-control[readonly] {
            background: #f8fafc;
            color: #475569;
        }

        .btn {
            border-radius: 8px;
            font-weight: 700;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--kg-teal), var(--kg-violet));
            border: 0;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0f766e, #6d28d9);
        }

        .btn-warning {
            background: var(--kg-gold);
            border-color: var(--kg-gold);
            color: #111827;
        }

        .btn-danger {
            background: var(--kg-rose);
            border-color: var(--kg-rose);
        }

        .btn-secondary,
        .btn-outline-secondary {
            border-color: #cbd5e1;
        }

        .table {
            color: #344054;
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 1px solid var(--kg-border);
            color: #475569;
            font-size: 13px;
            font-weight: 800;
        }

        .table-bordered,
        .table-bordered td,
        .table-bordered th {
            border-color: var(--kg-border);
        }

        .table-hover tbody tr:hover {
            background: #f8fafc;
        }

        .dataTables_wrapper {
            padding: 2px;
        }

        .dataTables_wrapper .row:first-child {
            align-items: center;
            background: #f8fafc;
            border: 1px solid var(--kg-border);
            border-radius: 8px;
            margin: 0 0 14px;
            padding: 12px 10px;
        }

        .dataTables_wrapper .row:last-child {
            align-items: center;
            margin-top: 14px;
        }

        .dataTables_length label,
        .dataTables_filter label,
        .dataTables_info {
            color: var(--kg-muted);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .dataTables_length select {
            border: 1px solid #d9e1ec;
            border-radius: 8px;
            margin: 0 6px;
            min-height: 38px;
            padding: 4px 28px 4px 10px;
        }

        .dataTables_filter input {
            border: 1px solid #d9e1ec;
            border-radius: 8px;
            margin-left: 8px;
            min-height: 38px;
            padding: 6px 12px;
        }

        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            border-color: var(--kg-teal);
            box-shadow: 0 0 0 0.16rem rgba(20, 184, 166, 0.15);
            outline: 0;
        }

        .page-item .page-link {
            border-color: var(--kg-border);
            color: var(--kg-teal);
            font-weight: 700;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--kg-teal), var(--kg-violet));
            border-color: transparent;
        }

        .table-action-cell {
            white-space: nowrap;
        }

        .modal-header {
            border-bottom: 1px solid var(--kg-border);
        }

        .modal-header.bg-primary,
        .modal-header.bg-warning {
            background: linear-gradient(135deg, var(--kg-teal), var(--kg-violet)) !important;
            color: #fff;
        }

        .modal-header .close {
            color: #fff;
            opacity: 0.9;
        }

        .main-footer {
            background: #fff;
            border-top: 1px solid var(--kg-border);
            color: var(--kg-muted);
        }

        @media (max-width: 767px) {
            .quick-actions .btn,
            .content-header .btn {
                margin-top: 8px;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link top-user-name">{{ auth()->user()->name ?? 'User' }}</span>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm mt-1 mr-2">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <span class="brand-mark">KG</span>
                <span class="brand-text">Kedaton Grande</span>
            </a>

            <div class="sidebar">
                <div class="user-panel">
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name ?? 'User' }}</a>
                        <small class="role-badge">
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

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if(auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('serah-terima.index') }}"
                                class="nav-link {{ request()->routeIs('serah-terima.*') ? 'active' : '' }}">
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
                            <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        @endif

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

                        @if(auth()->user()->role == 'lapangan')
                        <li class="nav-item">
                            <a href="{{ route('pengaduan.index') }}"
                                class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>Tugas Perbaikan</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->role == 'pimpinan')
                        <li class="nav-item">
                            <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Laporan</p>
                            </a>
                        </li>

                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

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

        <footer class="main-footer text-sm">
            <strong>Copyright &copy; {{ date('Y') }} Kedaton Grande.</strong>
            All rights reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('.kg-datatable').DataTable({
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Semua']],
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data yang ditampilkan',
                    infoFiltered: '(difilter dari _MAX_ total data)',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: 'Belum ada data',
                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                },
                columnDefs: [
                    { targets: 'no-sort', orderable: false, searchable: false }
                ]
            });
        });
    </script>
</body>

</html>
