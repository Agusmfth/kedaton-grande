@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="mb-1 font-weight-bold">Edit Data Serah Terima Kunci</h4>
            <p class="text-muted mb-0">Silakan perbarui data serah terima kunci konsumen.</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-outline card-warning shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-1"></i> Form Edit Data
            </h3>
        </div>

        <form action="{{ route('serah-terima.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label>Nama Konsumen</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->user->name ?? '') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Username Login</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $item->user->username ?? '') }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password Login</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin mengubah password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Blok Rumah</label>
                    <input type="text" name="blok" class="form-control @error('blok') is-invalid @enderror" value="{{ old('blok', $item->blok) }}" required>
                    @error('blok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Serah Terima</label>
                    <input type="date" name="tanggal_serah_terima" class="form-control @error('tanggal_serah_terima') is-invalid @enderror" value="{{ old('tanggal_serah_terima', $item->tanggal_serah_terima) }}" required>
                    @error('tanggal_serah_terima')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $item->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
                <a href="{{ route('serah-terima.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
