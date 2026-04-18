@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1 font-weight-bold">Data Serah Terima Kunci</h4>
            <p class="text-muted mb-0">Daftar data konsumen yang telah menerima serah terima kunci.</p>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSerahTerimaModal">
            <i class="fas fa-plus mr-1"></i> Tambah Data
        </button>
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
            <table class="table table-bordered table-hover kg-datatable">
                <thead class="text-center">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Konsumen</th>
                        <th>Username</th>
                        <th>Blok</th>
                        <th>Tanggal Serah Terima</th>
                        <th>Keterangan</th>
                        <th width="180" class="no-sort">Aksi</th>
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
                            <td class="text-center table-action-cell">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSerahTerimaModal{{ $item->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

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

    <div class="modal fade" id="createSerahTerimaModal" tabindex="-1" role="dialog" aria-labelledby="createSerahTerimaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('serah-terima.store') }}" method="POST">
                    @csrf

                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="createSerahTerimaModalLabel">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Data Serah Terima Kunci
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-info">
                            Data ini akan sekaligus membuat akun konsumen baru untuk login.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Konsumen</label>
                                    <input type="text" name="name" class="form-control {{ session('create_modal') && $errors->has('name') ? 'is-invalid' : '' }}" value="{{ session('create_modal') ? old('name') : '' }}" required>
                                    @if(session('create_modal'))
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username Login</label>
                                    <input type="text" name="username" class="form-control {{ session('create_modal') && $errors->has('username') ? 'is-invalid' : '' }}" value="{{ session('create_modal') ? old('username') : '' }}" required>
                                    @if(session('create_modal'))
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control {{ session('create_modal') && $errors->has('email') ? 'is-invalid' : '' }}" value="{{ session('create_modal') ? old('email') : '' }}" required>
                                    @if(session('create_modal'))
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password Login</label>
                                    <input type="password" name="password" class="form-control {{ session('create_modal') && $errors->has('password') ? 'is-invalid' : '' }}" required>
                                    @if(session('create_modal'))
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Blok Rumah</label>
                                    <input type="text" name="blok" class="form-control {{ session('create_modal') && $errors->has('blok') ? 'is-invalid' : '' }}" value="{{ session('create_modal') ? old('blok') : '' }}" required>
                                    @if(session('create_modal'))
                                        @error('blok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Serah Terima</label>
                                    <input type="date" name="tanggal_serah_terima" class="form-control {{ session('create_modal') && $errors->has('tanggal_serah_terima') ? 'is-invalid' : '' }}" value="{{ session('create_modal') ? old('tanggal_serah_terima') : '' }}" required>
                                    @if(session('create_modal'))
                                        @error('tanggal_serah_terima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control {{ session('create_modal') && $errors->has('keterangan') ? 'is-invalid' : '' }}" rows="3">{{ session('create_modal') ? old('keterangan') : '' }}</textarea>
                                    @if(session('create_modal'))
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{ route('serah-terima.create') }}" class="btn btn-outline-secondary mr-auto">
                            Buka Halaman Form
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($data as $item)
        @php
            $isEditing = (string) session('edit_id') === (string) $item->id;
        @endphp
        <div class="modal fade" id="editSerahTerimaModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editSerahTerimaModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('serah-terima.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="editSerahTerimaModalLabel{{ $item->id }}">
                                <i class="fas fa-edit mr-1"></i> Edit Data Serah Terima Kunci
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Konsumen</label>
                                        <input type="text" name="name" class="form-control {{ $isEditing && $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $isEditing ? old('name') : ($item->user->name ?? '') }}" required>
                                        @if($isEditing)
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username Login</label>
                                        <input type="text" name="username" class="form-control {{ $isEditing && $errors->has('username') ? 'is-invalid' : '' }}" value="{{ $isEditing ? old('username') : ($item->user->username ?? '') }}" required>
                                        @if($isEditing)
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password Login</label>
                                        <input type="password" name="password" class="form-control {{ $isEditing && $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Kosongkan jika tidak ingin mengubah password">
                                        @if($isEditing)
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Blok Rumah</label>
                                        <input type="text" name="blok" class="form-control {{ $isEditing && $errors->has('blok') ? 'is-invalid' : '' }}" value="{{ $isEditing ? old('blok') : $item->blok }}" required>
                                        @if($isEditing)
                                            @error('blok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Serah Terima</label>
                                        <input type="date" name="tanggal_serah_terima" class="form-control {{ $isEditing && $errors->has('tanggal_serah_terima') ? 'is-invalid' : '' }}" value="{{ $isEditing ? old('tanggal_serah_terima') : $item->tanggal_serah_terima }}" required>
                                        @if($isEditing)
                                            @error('tanggal_serah_terima')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <label>Keterangan</label>
                                        <textarea name="keterangan" class="form-control {{ $isEditing && $errors->has('keterangan') ? 'is-invalid' : '' }}" rows="3">{{ $isEditing ? old('keterangan') : $item->keterangan }}</textarea>
                                        @if($isEditing)
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save mr-1"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if(session('edit_id'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#editSerahTerimaModal{{ session('edit_id') }}').modal('show');
    });
</script>
@endif

@if(session('create_modal'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#createSerahTerimaModal').modal('show');
    });
</script>
@endif
@endsection
