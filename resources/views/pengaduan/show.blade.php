@extends('layouts.app')

@section('content')
@php
    $statusLabels = [
        'baru' => 'Pengaduan Dikirim',
        'diproses' => 'Diterima Admin',
        'diteruskan_lapangan' => 'Diteruskan ke Lapangan',
        'dikerjakan' => 'Sedang Dikerjakan',
        'selesai' => 'Selesai',
    ];

    $statusBadges = [
        'baru' => 'secondary',
        'diproses' => 'warning',
        'diteruskan_lapangan' => 'primary',
        'dikerjakan' => 'info',
        'selesai' => 'success',
    ];

    $statusIcons = [
        'baru' => 'paper-plane',
        'diproses' => 'user-check',
        'diteruskan_lapangan' => 'share',
        'dikerjakan' => 'tools',
        'selesai' => 'check-circle',
    ];

    $currentStatusLabel = $statusLabels[$pengaduan->status] ?? $pengaduan->status;
    $currentStatusBadge = $statusBadges[$pengaduan->status] ?? 'secondary';
@endphp

<style>
    .tracking-page {
        color: #1f2937;
    }

    .tracking-hero {
        background:
            linear-gradient(135deg, rgba(15, 118, 110, 0.96), rgba(124, 58, 237, 0.92)),
            url('https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1600&q=80');
        background-position: center;
        background-size: cover;
        border-radius: 8px;
        box-shadow: 0 18px 42px rgba(15, 23, 42, 0.16);
        color: #fff;
        margin-bottom: 22px;
        overflow: hidden;
        padding: 28px;
        position: relative;
    }

    .tracking-hero::after {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        content: "";
        height: 220px;
        position: absolute;
        right: -70px;
        top: -92px;
        width: 220px;
    }

    .tracking-kicker {
        color: #fef3c7;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .tracking-title {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
        max-width: 760px;
    }

    .tracking-subtitle {
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 0;
        max-width: 780px;
    }

    .tracking-status-pill {
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.24);
        border-radius: 8px;
        padding: 14px 16px;
        position: relative;
        z-index: 1;
    }

    .tracking-status-pill span {
        color: rgba(255, 255, 255, 0.76);
        display: block;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .tracking-status-pill strong {
        color: #fff;
        font-size: 18px;
    }

    .lux-card {
        background: #fff;
        border: 1px solid #e7ebf3;
        border-radius: 8px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
        margin-bottom: 22px;
    }

    .lux-card-header {
        align-items: center;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        justify-content: space-between;
        padding: 18px 20px;
    }

    .lux-card-title {
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 0;
    }

    .lux-card-body {
        padding: 20px;
    }

    .info-grid {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .info-box {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 8px;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
        min-height: 102px;
        padding: 18px;
    }

    .info-label {
        color: #64748b;
        display: block;
        font-size: 12px;
        font-weight: 800;
        line-height: 1.35;
        margin-bottom: 10px;
        text-transform: uppercase;
        width: 100%;
    }

    .info-value {
        color: #1f2937;
        display: block;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.55;
        margin-bottom: 0;
        width: 100%;
        word-break: break-word;
    }

    .info-value.long-text {
        font-size: 16px;
        font-weight: 500;
        white-space: pre-line;
    }

    .info-box.full {
        grid-column: 1 / -1;
        min-height: auto;
    }

    .info-box.compact {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .lux-timeline {
        margin: 0;
        padding: 4px 0 0;
        position: relative;
    }

    .lux-timeline::before {
        background: linear-gradient(180deg, #14b8a6, #7c3aed);
        border-radius: 8px;
        bottom: 14px;
        content: "";
        left: 23px;
        position: absolute;
        top: 20px;
        width: 4px;
    }

    .lux-timeline-item {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        position: relative;
    }

    .lux-timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        align-items: center;
        background: #fff;
        border: 3px solid #14b8a6;
        border-radius: 50%;
        box-shadow: 0 8px 20px rgba(20, 184, 166, 0.22);
        color: #0f766e;
        display: flex;
        flex: 0 0 50px;
        height: 50px;
        justify-content: center;
        position: relative;
        width: 50px;
        z-index: 1;
    }

    .timeline-panel {
        background: #fff;
        border: 1px solid #e7ebf3;
        border-radius: 8px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
        flex: 1;
        padding: 16px;
    }

    .timeline-panel-header {
        align-items: flex-start;
        display: flex;
        gap: 12px;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .timeline-panel h5 {
        color: #1f2937;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .timeline-date {
        color: #64748b;
        font-size: 13px;
        white-space: nowrap;
    }

    .timeline-panel p {
        color: #475569;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .evidence-image {
        border-radius: 8px;
        box-shadow: 0 16px 34px rgba(15, 23, 42, 0.12);
        max-height: 380px;
        object-fit: cover;
        width: 100%;
    }

    .empty-evidence {
        align-items: center;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        color: #64748b;
        display: flex;
        min-height: 180px;
        justify-content: center;
        padding: 24px;
        text-align: center;
    }

    @media (max-width: 767px) {
        .tracking-title {
            font-size: 23px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .timeline-panel-header {
            display: block;
        }

        .timeline-date {
            display: block;
            margin-top: 4px;
        }
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="mb-1 font-weight-bold">Detail Tracking Pengaduan</h4>
            <p class="text-muted mb-0">Riwayat proses penanganan pengaduan konsumen.</p>
        </div>
    </div>
</div>

<div class="container-fluid tracking-page">
    <div class="tracking-hero">
        <div class="d-lg-flex justify-content-between align-items-center">
            <div>
                <div class="tracking-kicker">Kedaton Grande Service Tracking</div>
                <h1 class="tracking-title">{{ $pengaduan->judul }}</h1>
                <p class="tracking-subtitle">Pantau setiap tahapan pengaduan mulai dari pengiriman, penerimaan admin, tindak lanjut lapangan, hingga penyelesaian perbaikan.</p>
            </div>
            <div class="tracking-status-pill mt-4 mt-lg-0">
                <span>Status Saat Ini</span>
                <strong>{{ $currentStatusLabel }}</strong>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="lux-card">
                <div class="lux-card-header">
                    <h3 class="lux-card-title">
                        <i class="fas fa-info-circle mr-1"></i> Informasi Pengaduan
                    </h3>
                    <span class="badge badge-{{ $currentStatusBadge }} px-3 py-2">{{ $currentStatusLabel }}</span>
                </div>
                <div class="lux-card-body">
                    <div class="info-grid">
                        <div class="info-box compact">
                            <div class="info-label">Konsumen</div>
                            <div class="info-value">{{ $pengaduan->user->name ?? '-' }}</div>
                        </div>
                        <div class="info-box compact">
                            <div class="info-label">Tanggal Pengaduan</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y') }}</div>
                        </div>
                        <div class="info-box full">
                            <div class="info-label">Judul Pengaduan</div>
                            <div class="info-value">{{ $pengaduan->judul }}</div>
                        </div>
                        <div class="info-box full">
                            <div class="info-label">Keluhan</div>
                            <div class="info-value long-text">{{ $pengaduan->keluhan }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lux-card">
                <div class="lux-card-header">
                    <h3 class="lux-card-title">
                        <i class="fas fa-image mr-1"></i> Bukti Perbaikan
                    </h3>
                </div>
                <div class="lux-card-body">
                    @if($pengaduan->foto_perbaikan)
                        <img src="{{ asset('storage/' . $pengaduan->foto_perbaikan) }}" alt="Foto Bukti Perbaikan" class="evidence-image">
                    @else
                        <div class="empty-evidence">
                            <div>
                                <i class="fas fa-image fa-2x mb-2"></i>
                                <div>Foto bukti perbaikan akan tampil setelah petugas lapangan mengunggah dokumentasi.</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="lux-card">
                <div class="lux-card-header">
                    <h3 class="lux-card-title">
                        <i class="fas fa-stream mr-1"></i> Histori Tracking
                    </h3>
                </div>
                <div class="lux-card-body">
                    @if($pengaduan->histori->count() > 0)
                        <div class="lux-timeline">
                            @foreach($pengaduan->histori as $item)
                                @php
                                    $label = $statusLabels[$item->status] ?? $item->status;
                                    $icon = $statusIcons[$item->status] ?? 'check';
                                    $badge = $statusBadges[$item->status] ?? 'secondary';
                                @endphp
                                <div class="lux-timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-{{ $icon }}"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-panel-header">
                                            <div>
                                                <h5>{{ $label }}</h5>
                                                <span class="badge badge-{{ $badge }}">{{ $label }}</span>
                                            </div>
                                            <span class="timeline-date">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}
                                            </span>
                                        </div>
                                        <p>{{ $item->keterangan }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">
                            Belum ada histori pengaduan.
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
    </div>
</div>
@endsection
