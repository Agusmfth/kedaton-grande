@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="mb-1 font-weight-bold">Tambah Pengaduan</h4>
            <p class="text-muted mb-0">Silakan isi formulir pengaduan dengan lengkap dan jelas.</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-1"></i> Form Pengaduan Konsumen
            </h3>
        </div>

        <form action="{{ route('pengaduan.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="alert alert-info">
                    Jelaskan keluhan dengan singkat dan jelas agar admin lebih cepat menindaklanjuti.
                </div>

                <div class="form-group">
                    <label>Judul Pengaduan</label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}"
                        placeholder="Contoh: Kerusakan keran kamar mandi"
                        required
                    >
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea
                        name="keluhan"
                        class="form-control @error('keluhan') is-invalid @enderror"
                        rows="5"
                        placeholder="Tuliskan detail keluhan yang Anda alami"
                        required
                    >{{ old('keluhan') }}</textarea>
                    @error('keluhan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
