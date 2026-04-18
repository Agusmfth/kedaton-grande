@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h4 class="mb-1 font-weight-bold">Dashboard Konsumen</h4>
        <p class="text-muted mb-0">Ringkasan pengaduan dan status perbaikan Anda.</p>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $pengaduans->count() }}</h3>
                    <p>Total Pengaduan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>
                <a href="{{ route('pengaduan.index') }}" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pengaduans->where('status', '!=', 'selesai')->count() }}</h3>
                    <p>Belum Selesai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tools"></i>
                </div>
                <a href="{{ route('status.index') }}" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $pengaduans->where('status', 'selesai')->count() }}</h3>
                    <p>Selesai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('pengaduan.create') }}" class="small-box-footer">
                    Buat Pengaduan <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Selamat Datang</h3>
        </div>
        <div class="card-body">
            Halo <strong>{{ auth()->user()->name }}</strong>, Anda bisa membuat pengaduan baru dan memantau status perbaikan dari menu yang tersedia.
        </div>
    </div>
</div>
@endsection
