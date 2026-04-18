@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-3">
            <h4 class="mb-1 font-weight-bold">Update Status Pengaduan</h4>
            <p class="text-muted mb-0">Halaman ini digunakan oleh bagian lapangan untuk memperbarui status dan mengunggah foto bukti perbaikan.</p>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-1"></i> Form Update Pengaduan
            </h3>
        </div>

        <form action="{{ route('pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="alert alert-info">
                    Perbarui status pekerjaan dan unggah foto bukti jika perbaikan sudah selesai.
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Pengaduan</label>
                            <input type="text" class="form-control" value="{{ $pengaduan->judul }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="dikerjakan" {{ $pengaduan->status == 'dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keluhan</label>
                            <textarea class="form-control" rows="4" readonly>{{ $pengaduan->keluhan }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-md-0">
                            <label>Upload Foto Bukti Perbaikan</label>
                            <input type="file" name="foto_perbaikan" class="form-control @error('foto_perbaikan') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2 MB.</small>
                            @error('foto_perbaikan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if($pengaduan->foto_perbaikan)
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label>Foto Saat Ini</label><br>
                            <img src="{{ asset('storage/' . $pengaduan->foto_perbaikan) }}" alt="Foto Perbaikan" class="img-fluid rounded shadow-sm" style="max-width: 300px;">
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
