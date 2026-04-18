@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1 font-weight-bold">Data Serah Terima Kunci</h4>
            <p class="text-muted mb-0">Daftar data konsumen yang telah menerima serah terima kunci.</p>
        </div>
        <a href="{{ route('serah-terima.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Data
        </a>
    </div>
</div>

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-key mr-1"></i> Daftar Serah Terima Kunci
            </h3>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Konsumen</th>
                        <th>Username</th>
                        <th>Blok</th>
                        <th>Tanggal Serah Terima</th>
                        <th>Keterangan</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->user->username ?? '-' }}</td>
                            <td class="text-center">{{ $item->blok }}</td>
                            <td class="text-center">{{ $item->tanggal_serah_terima }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('serah-terima.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('serah-terima.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Belum ada data serah terima kunci.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection