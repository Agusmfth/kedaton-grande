@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="mb-1 font-weight-bold">Tambah Data Serah Terima Kunci</h4>
            <p class="text-muted mb-0">Silakan isi data konsumen yang telah menerima serah terima kunci.</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-plus-circle mr-1"></i> Form Tambah Data
            </h3>
        </div>

        {{-- ROUTE HARUS SESUAI --}}
        <form action="{{ route('serah-terima.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- NAMA --}}
                <div class="form-group">
                    <label>Nama Konsumen</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- USERNAME LOGIN --}}
                <div class="form-group">
                    <label>Username Login</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username') }}" required>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- PASSWORD --}}
                <div class="form-group">
                    <label>Password Login</label>
                    <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"
                        required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BLOK --}}
                <div class="form-group">
                    <label>Blok Rumah</label>
                    <input type="text" name="blok" class="form-control @error('blok') is-invalid @enderror"
                        value="{{ old('blok') }}" required>
                    @error('blok')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TANGGAL --}}
                <div class="form-group">
                    <label>Tanggal Serah Terima</label>
                    <input type="date" name="tanggal_serah_terima"
                        class="form-control @error('tanggal_serah_terima') is-invalid @enderror"
                        value="{{ old('tanggal_serah_terima') }}" required>
                    @error('tanggal_serah_terima')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KETERANGAN --}}
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan"
                        class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="{{ route('serah-terima.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection