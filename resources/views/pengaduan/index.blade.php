@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-1 font-weight-bold">Data Pengaduan Konsumen</h4>
                <p class="text-muted mb-0">
                    @if(auth()->user()->role == 'konsumen')
                    Daftar pengaduan yang telah Anda kirim beserta status penanganannya.
                    @elseif(auth()->user()->role == 'lapangan')
                    Daftar pengaduan konsumen yang perlu dipantau dan diperbarui statusnya.
                    @elseif(auth()->user()->role == 'admin')
                    Daftar seluruh pengaduan konsumen yang masuk ke dalam sistem.
                    @else
                    Daftar pengaduan konsumen untuk kebutuhan monitoring pimpinan.
                    @endif
                </p>
            </div>

            @if(auth()->user()->role == 'konsumen')
            <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Pengaduan
            </a>
            @endif
        </div>
    </div>
</div>

<div class="container-fluid">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-1"></i>
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(!empty($status))
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <span>
            <i class="fas fa-filter mr-1"></i>
            Menampilkan pengaduan dengan status:
            <strong>
                @if($status == 'baru')
                    Baru
                @elseif($status == 'diproses')
                    Diproses Admin
                @elseif($status == 'diteruskan_lapangan')
                    Diteruskan ke Lapangan
                @elseif($status == 'dikerjakan')
                    Dikerjakan
                @elseif($status == 'selesai')
                    Selesai
                @else
                    {{ $status }}
                @endif
            </strong>
        </span>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-outline-primary">
            Tampilkan Semua
        </a>
    </div>
    @endif

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
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        {{ $pengaduans->where('status', 'baru')->count()
                         + $pengaduans->where('status', 'diproses')->count()
                         + $pengaduans->where('status', 'diteruskan_lapangan')->count()
                         + $pengaduans->where('status', 'dikerjakan')->count() }}
                    </h3>
                    <p>Belum Selesai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tools"></i>
                </div>
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
            </div>
        </div>
    </div>

    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-list-alt mr-1"></i> Daftar Pengaduan
            </h3>
        </div>

        <div class="card-body">
            @if($pengaduans->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle kg-datatable">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th style="width: 60px;">No</th>

                            @if(auth()->user()->role != 'konsumen')
                            <th>Nama Konsumen</th>
                            @endif

                            <th>Judul Pengaduan</th>
                            <th>Keluhan</th>
                            <th style="width: 180px;">Status</th>
                            <th style="width: 140px;">Tanggal</th>
                            <th style="width: 320px;" class="no-sort">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduans as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            @if(auth()->user()->role != 'konsumen')
                            <td>{{ $p->user->name ?? '-' }}</td>
                            @endif

                            <td class="font-weight-semibold">{{ $p->judul }}</td>
                            <td>{{ $p->keluhan }}</td>

                            <td class="text-center table-action-cell">
                                @if($p->status == 'baru')
                                <span class="badge badge-secondary px-3 py-2">Baru</span>
                                @elseif($p->status == 'diproses')
                                <span class="badge badge-warning px-3 py-2">Diproses Admin</span>
                                @elseif($p->status == 'diteruskan_lapangan')
                                <span class="badge badge-primary px-3 py-2">Diteruskan ke Lapangan</span>
                                @elseif($p->status == 'dikerjakan')
                                <span class="badge badge-info px-3 py-2">Dikerjakan</span>
                                @elseif($p->status == 'selesai')
                                <span class="badge badge-success px-3 py-2">Selesai</span>
                                @endif
                            </td>

                            <td class="text-center">{{ $p->tanggal_pengaduan }}</td>

                            <td class="text-center">

                                {{-- ADMIN --}}
                                @if(auth()->user()->role == 'admin')

                                @if($p->status == 'baru')
                                <form action="{{ route('pengaduan.update', $p->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="diproses">
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-spinner mr-1"></i> Proses
                                    </button>
                                </form>
                                @endif

                                @if($p->status == 'diproses')
                                <form action="{{ route('pengaduan.update', $p->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="diteruskan_lapangan">
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-share mr-1"></i> Teruskan
                                    </button>
                                </form>
                                @endif

                                @endif

                                {{-- BAGIAN LAPANGAN --}}
                                @if(auth()->user()->role == 'lapangan')

                                @if($p->status == 'diteruskan_lapangan')
                                <form action="{{ route('pengaduan.update', $p->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="dikerjakan">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-tools mr-1"></i> Kerjakan
                                    </button>
                                </form>
                                @endif

                                @if($p->status == 'dikerjakan')
                                <a href="{{ route('pengaduan.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-camera mr-1"></i> Upload & Selesaikan
                                </a>
                                @endif

                                @endif

                                <a href="{{ route('pengaduan.show', $p->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="font-weight-bold">Belum Ada Data Pengaduan</h5>
                <p class="text-muted mb-3">
                    @if(auth()->user()->role == 'konsumen')
                    Anda belum mengirim pengaduan apa pun.
                    @else
                    Belum ada pengaduan yang masuk ke dalam sistem.
                    @endif
                </p>

                @if(auth()->user()->role == 'konsumen')
                <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Buat Pengaduan
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
