@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="mb-1 font-weight-bold">Detail Tracking Pengaduan</h4>
            <p class="text-muted mb-0">Riwayat proses penanganan pengaduan konsumen.</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-info-circle mr-1"></i> Informasi Pengaduan
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200">Judul Pengaduan</th>
                    <td>{{ $pengaduan->judul }}</td>
                </tr>
                <tr>
                    <th>Keluhan</th>
                    <td>{{ $pengaduan->keluhan }}</td>
                </tr>
                <tr>
                    <th>Status Saat Ini</th>
                    <td>
                        @if($pengaduan->status == 'baru')
                        <span class="badge badge-secondary px-3 py-2">Baru</span>
                        @elseif($pengaduan->status == 'diproses')
                        <span class="badge badge-warning px-3 py-2">Diproses Admin</span>
                        @elseif($pengaduan->status == 'diteruskan_lapangan')
                        <span class="badge badge-primary px-3 py-2">Diteruskan ke Lapangan</span>
                        @elseif($pengaduan->status == 'dikerjakan')
                        <span class="badge badge-info px-3 py-2">Dikerjakan</span>
                        @elseif($pengaduan->status == 'selesai')
                        <span class="badge badge-success px-3 py-2">Selesai</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Pengaduan</th>
                    <td>{{ $pengaduan->tanggal_pengaduan }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card card-outline card-success shadow-sm">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-stream mr-1"></i> Histori Tracking Pengaduan
            </h3>
        </div>
        <div class="card-body">
            @if($pengaduan->histori->count() > 0)
            <div class="timeline timeline-inverse">
                @foreach($pengaduan->histori as $item)
                <div class="time-label">
                    <span class="bg-primary">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                    </span>
                </div>

                <div>
                    <i class="fas fa-check bg-success"></i>
                    <div class="timeline-item">
                        <h3 class="timeline-header">
                            <strong>{{ $item->status }}</strong>
                        </h3>
                        <div class="timeline-body">
                            {{ $item->keterangan }}
                        </div>
                    </div>
                </div>
                @endforeach

                <div>
                    <i class="far fa-clock bg-gray"></i>
                </div>
            </div>
            @else
            <div class="alert alert-warning mb-0">
                Belum ada histori pengaduan.
            </div>
            @endif
            @if($pengaduan->foto_perbaikan)
            <div class="card card-outline card-info shadow-sm mt-3">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-image mr-1"></i> Foto Bukti Perbaikan
                    </h3>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $pengaduan->foto_perbaikan) }}" alt="Foto Bukti Perbaikan"
                        class="img-fluid rounded shadow-sm" style="max-width: 500px;">
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection