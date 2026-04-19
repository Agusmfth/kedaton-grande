<x-app-layout>
    <style>
        .content-wrapper {
            background: #f7f8fc;
        }

        .purple-dashboard {
            color: #263238;
        }

        .welcome-panel,
        .metric-card,
        .dashboard-card {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(17, 24, 39, 0.08);
        }

        .welcome-panel {
            background: linear-gradient(120deg, #ffffff 0%, #f6f1ff 55%, #eefaf8 100%);
            margin-bottom: 22px;
            overflow: hidden;
            padding: 24px;
            position: relative;
        }

        .welcome-panel::after {
            background: rgba(111, 66, 193, 0.10);
            border-radius: 50%;
            content: "";
            height: 180px;
            position: absolute;
            right: -58px;
            top: -70px;
            width: 180px;
        }

        .welcome-eyebrow {
            color: #7c3aed;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .welcome-title {
            color: #1f2937;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-copy {
            color: #64748b;
            margin-bottom: 0;
            max-width: 760px;
        }

        .quick-actions {
            position: relative;
            z-index: 1;
        }

        .quick-actions .btn {
            border-radius: 6px;
            font-weight: 700;
            margin-left: 8px;
        }

        .btn-soft-primary {
            background: #ede9fe;
            color: #6d28d9;
        }

        .metric-card {
            color: #fff;
            margin-bottom: 20px;
            min-height: 138px;
            overflow: hidden;
            padding: 22px;
            position: relative;
        }

        .metric-card::after {
            background: rgba(255, 255, 255, 0.16);
            border-radius: 50%;
            content: "";
            height: 142px;
            position: absolute;
            right: -48px;
            top: -42px;
            width: 142px;
        }

        .metric-card .metric-icon {
            align-items: center;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 8px;
            display: flex;
            height: 48px;
            justify-content: center;
            width: 48px;
        }

        .metric-card h3 {
            font-size: 32px;
            font-weight: 700;
            margin: 16px 0 2px;
        }

        .metric-card p {
            margin-bottom: 0;
            opacity: 0.92;
        }

        .metric-card a {
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            position: absolute;
            right: 22px;
            bottom: 18px;
            z-index: 1;
        }

        .metric-violet {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
        }

        .metric-teal {
            background: linear-gradient(135deg, #14b8a6, #22c55e);
        }

        .metric-gold {
            background: linear-gradient(135deg, #f59e0b, #f97316);
        }

        .metric-rose {
            background: linear-gradient(135deg, #f43f5e, #ef4444);
        }

        .dashboard-card {
            background: #fff;
            margin-bottom: 22px;
        }

        .dashboard-card .card-header {
            background: #fff;
            border-bottom: 1px solid #edf2f7;
            padding: 17px 20px;
        }

        .dashboard-card .card-title {
            color: #1f2937;
            font-weight: 700;
        }

        .status-item {
            margin-bottom: 18px;
        }

        .status-item:last-child {
            margin-bottom: 0;
        }

        .status-label {
            color: #475569;
            font-weight: 600;
        }

        .status-value {
            color: #111827;
            font-weight: 700;
        }

        .status-item .progress {
            background: #eef2f7;
            border-radius: 8px;
            height: 8px;
        }

        .progress-bar {
            border-radius: 8px;
        }

        .mini-stat {
            background: #f8fafc;
            border: 1px solid #eef2f7;
            border-radius: 8px;
            padding: 14px;
        }

        .mini-stat span {
            color: #64748b;
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .mini-stat strong {
            color: #111827;
            font-size: 22px;
        }

        .dashboard-table td,
        .dashboard-table th {
            border-top: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .dashboard-table thead th {
            border-bottom: 0;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
        }

        .avatar-initial {
            align-items: center;
            background: #ede9fe;
            border-radius: 8px;
            color: #6d28d9;
            display: inline-flex;
            font-weight: 700;
            height: 34px;
            justify-content: center;
            margin-right: 10px;
            width: 34px;
        }

        @media (max-width: 767px) {
            .welcome-title {
                font-size: 22px;
            }

            .quick-actions .btn {
                margin: 8px 8px 0 0;
            }
        }
    </style>

    @php
        $statusItems = [
            ['label' => 'Baru', 'value' => $statusPengaduan['baru'], 'color' => 'secondary'],
            ['label' => 'Diproses Admin', 'value' => $statusPengaduan['diproses'], 'color' => 'warning'],
            ['label' => 'Diteruskan Lapangan', 'value' => $statusPengaduan['diteruskan_lapangan'], 'color' => 'primary'],
            ['label' => 'Dikerjakan', 'value' => $statusPengaduan['dikerjakan'], 'color' => 'info'],
            ['label' => 'Selesai', 'value' => $statusPengaduan['selesai'], 'color' => 'success'],
        ];

        $completionRate = $jumlahPengaduan > 0 ? round(($jumlahLaporan / $jumlahPengaduan) * 100) : 0;
    @endphp

    <div class="purple-dashboard">
        <div class="welcome-panel">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <div class="welcome-eyebrow">Kedaton Grande</div>
                    <h4 class="welcome-title">{{ $dashboardTitle }}</h4>
                    <p class="welcome-copy">Selamat datang <strong>{{ auth()->user()->name }}</strong>. {{ $dashboardDescription }}</p>
                </div>
                <div class="quick-actions mt-3 mt-md-0">
                    @if(auth()->user()->role == 'admin')
                    <a href="{{ route('serah-terima.index') }}" class="btn btn-soft-primary">
                        <i class="fas fa-key mr-1"></i> Serah Terima
                    </a>
                    @endif
                    @if(auth()->user()->role == 'lapangan')
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-soft-primary">
                        <i class="fas fa-tools mr-1"></i> Tugas Saya
                    </a>
                    @endif
                    @if(auth()->user()->role != 'lapangan')
                    <a href="{{ route('laporan.index') }}" class="btn btn-dark">
                        <i class="fas fa-file-alt mr-1"></i> Laporan
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="metric-card metric-violet">
                    <div class="metric-icon">
                        <i class="fas {{ auth()->user()->role == 'lapangan' ? 'fa-clipboard-list' : 'fa-key' }}"></i>
                    </div>
                    <h3>{{ auth()->user()->role == 'lapangan' ? $jumlahPengaduan : $jumlahSerahTerima }}</h3>
                    <p>{{ auth()->user()->role == 'lapangan' ? 'Total Tugas Saya' : 'Serah Terima Kunci' }}</p>
                    <a href="{{ auth()->user()->role == 'lapangan' ? route('pengaduan.index') : route('serah-terima.index') }}">Detail <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="metric-card metric-teal">
                    <div class="metric-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>{{ auth()->user()->role == 'lapangan' ? $statusPengaduan['diteruskan_lapangan'] : $jumlahPengaduan }}</h3>
                    <p>{{ auth()->user()->role == 'lapangan' ? 'Menunggu Dikerjakan' : 'Pengaduan Konsumen' }}</p>
                    <a href="{{ route('pengaduan.index') }}">Detail <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="metric-card metric-gold">
                    <div class="metric-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>{{ auth()->user()->role == 'lapangan' ? $statusPengaduan['dikerjakan'] : $jumlahTugasPerbaikan }}</h3>
                    <p>{{ auth()->user()->role == 'lapangan' ? 'Sedang Dikerjakan' : 'Tugas Perbaikan' }}</p>
                    <a href="{{ route('pengaduan.index', ['status' => auth()->user()->role == 'lapangan' ? 'dikerjakan' : 'diteruskan_lapangan']) }}">Detail <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="metric-card metric-rose">
                    <div class="metric-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>{{ $jumlahLaporan }}</h3>
                    <p>Pengaduan Selesai</p>
                    <a href="{{ route('pengaduan.index', ['status' => 'selesai']) }}">Detail <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-chart-pie mr-1"></i> Ringkasan Status
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mini-stat mb-3">
                            <span>Tingkat pengaduan selesai</span>
                            <strong>{{ $completionRate }}%</strong>
                        </div>

                        @foreach($statusItems as $status)
                            @php
                                $percent = $jumlahPengaduan > 0 ? round(($status['value'] / $jumlahPengaduan) * 100) : 0;
                            @endphp
                            <div class="status-item">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="status-label">{{ $status['label'] }}</span>
                                    <span class="status-value">{{ $status['value'] }}</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-{{ $status['color'] }}" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="dashboard-card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-comments mr-1"></i> Pengaduan Terbaru
                        </h3>
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-outline-primary ml-auto">Lihat Semua</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table dashboard-table mb-0">
                            <thead>
                                <tr>
                                    <th>Diajukan Oleh</th>
                                    <th>Judul</th>
                                    <th>Dikerjakan Oleh</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduanTerbaru as $item)
                                <tr>
                                    <td>
                                        <span class="avatar-initial">{{ strtoupper(substr($item->user->name ?? 'K', 0, 1)) }}</span>
                                        {{ $item->user->name ?? '-' }}
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->petugas->name ?? 'Belum ditugaskan' }}</td>
                                    <td>
                                        @if($item->status == 'baru')
                                            <span class="badge badge-secondary">Baru</span>
                                        @elseif($item->status == 'diproses')
                                            <span class="badge badge-warning">Diproses</span>
                                        @elseif($item->status == 'diteruskan_lapangan')
                                            <span class="badge badge-primary">Ke Lapangan</span>
                                        @elseif($item->status == 'dikerjakan')
                                            <span class="badge badge-info">Dikerjakan</span>
                                        @elseif($item->status == 'selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->tanggal_pengaduan }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada pengaduan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->role != 'lapangan')
        <div class="dashboard-card">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title mb-0">
                    <i class="fas fa-key mr-1"></i> Serah Terima Kunci Terbaru
                </h3>
                <a href="{{ route('serah-terima.index') }}" class="btn btn-sm btn-outline-primary ml-auto">Lihat Semua</a>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table dashboard-table mb-0">
                    <thead>
                        <tr>
                            <th>Konsumen</th>
                            <th>Username</th>
                            <th>Blok</th>
                            <th>Tanggal Serah Terima</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($serahTerimaTerbaru as $item)
                        <tr>
                            <td>
                                <span class="avatar-initial">{{ strtoupper(substr($item->user->name ?? 'K', 0, 1)) }}</span>
                                {{ $item->user->name ?? '-' }}
                            </td>
                            <td>{{ $item->user->username ?? '-' }}</td>
                            <td>{{ $item->blok }}</td>
                            <td>{{ $item->tanggal_serah_terima }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data serah terima kunci.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
