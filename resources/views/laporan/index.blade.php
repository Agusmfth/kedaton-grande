@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1 font-weight-bold">Laporan</h4>
            <p class="text-muted mb-0">Rekap data serah terima kunci dan pengaduan konsumen.</p>
        </div>
        <a href="{{ route('laporan.cetak', request()->query()) }}" target="_blank" class="btn btn-danger">
            <i class="fas fa-print mr-1"></i> Cetak Laporan
        </a>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter mr-1"></i> Filter Laporan
            </h3>
        </div>
        <form action="{{ route('laporan.index') }}" method="GET">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group mb-md-0">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" class="form-control" value="{{ $tanggalAwal }}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-md-0">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir }}">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search mr-1"></i> Tampilkan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalSerahTerima }}</h3>
                    <p>Serah Terima Kunci</p>
                </div>
                <div class="icon">
                    <i class="fas fa-key"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalPengaduan }}</h3>
                    <p>Pengaduan Konsumen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalBelumSelesai }}</h3>
                    <p>Belum Selesai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalSelesai }}</h3>
                    <p>Selesai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-info shadow-sm">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-key mr-1"></i> Laporan Serah Terima Kunci
            </h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="text-center bg-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Konsumen</th>
                        <th>Username</th>
                        <th>Blok</th>
                        <th>Tanggal Serah Terima</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($serahTerima as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->user->username ?? '-' }}</td>
                        <td class="text-center">{{ $item->blok }}</td>
                        <td class="text-center">{{ $item->tanggal_serah_terima }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data serah terima kunci.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-outline card-success shadow-sm">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-comments mr-1"></i> Laporan Pengaduan Konsumen
            </h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="text-center bg-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Konsumen</th>
                        <th>Judul</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->keluhan }}</td>
                        <td class="text-center">
                            @if($item->status == 'baru')
                                <span class="badge badge-secondary">Baru</span>
                            @elseif($item->status == 'diproses')
                                <span class="badge badge-warning">Diproses Admin</span>
                            @elseif($item->status == 'diteruskan_lapangan')
                                <span class="badge badge-primary">Diteruskan ke Lapangan</span>
                            @elseif($item->status == 'dikerjakan')
                                <span class="badge badge-info">Dikerjakan</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $item->tanggal_pengaduan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data pengaduan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
