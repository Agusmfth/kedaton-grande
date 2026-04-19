@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-1 font-weight-bold">Manajemen Akun</h4>
            <p class="text-muted mb-0">Kelola akun admin, pimpinan, petugas lapangan, dan konsumen.</p>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
            <i class="fas fa-user-plus mr-1"></i> Tambah Akun
        </button>
    </div>
</div>

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-3 col-6 mb-2">
            <a href="{{ route('users.index') }}" class="btn btn-block {{ empty($role) ? 'btn-primary' : 'btn-outline-secondary' }}">Semua</a>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <a href="{{ route('users.index', ['role' => 'lapangan']) }}" class="btn btn-block {{ $role == 'lapangan' ? 'btn-primary' : 'btn-outline-secondary' }}">Petugas Lapangan</a>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <a href="{{ route('users.index', ['role' => 'pimpinan']) }}" class="btn btn-block {{ $role == 'pimpinan' ? 'btn-primary' : 'btn-outline-secondary' }}">Pimpinan</a>
        </div>
        <div class="col-md-3 col-6 mb-2">
            <a href="{{ route('users.index', ['role' => 'konsumen']) }}" class="btn btn-block {{ $role == 'konsumen' ? 'btn-primary' : 'btn-outline-secondary' }}">Konsumen</a>
        </div>
    </div>

    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users-cog mr-1"></i> Daftar Akun
            </h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover kg-datatable">
                <thead>
                    <tr class="text-center">
                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="180" class="no-sort">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username ?? '-' }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            @if($user->role == 'admin')
                                <span class="badge badge-primary px-3 py-2">Admin</span>
                            @elseif($user->role == 'lapangan')
                                <span class="badge badge-info px-3 py-2">Petugas Lapangan</span>
                            @elseif($user->role == 'pimpinan')
                                <span class="badge badge-success px-3 py-2">Pimpinan</span>
                            @else
                                <span class="badge badge-secondary px-3 py-2">Konsumen</span>
                            @endif
                        </td>
                        <td class="text-center table-action-cell">
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title"><i class="fas fa-user-plus mr-1"></i> Tambah Akun</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="lapangan">Petugas Lapangan</option>
                                        <option value="admin">Admin</option>
                                        <option value="pimpinan">Pimpinan</option>
                                        <option value="konsumen">Konsumen</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($users as $user)
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="fas fa-edit mr-1"></i> Edit Akun</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="lapangan" {{ $user->role == 'lapangan' ? 'selected' : '' }}>Petugas Lapangan</option>
                                        <option value="pimpinan" {{ $user->role == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                                        <option value="konsumen" {{ $user->role == 'konsumen' ? 'selected' : '' }}>Konsumen</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
