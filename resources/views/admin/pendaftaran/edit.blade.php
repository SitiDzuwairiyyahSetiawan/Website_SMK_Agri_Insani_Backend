@extends('admin.layouts.app')

@section('title', 'Edit Status Pendaftaran')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="mb-0">Edit Status Pendaftaran</h2>
        <p class="text-muted">
            Update status dan informasi pendaftaran siswa
        </p>
    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <form action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-8">

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Nama Lengkap
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $pendaftaran->nama_lengkap }}"
                               readonly>
                    </div>

                    <!-- NISN -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            NISN
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $pendaftaran->nisn }}"
                               readonly>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Email
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $pendaftaran->email }}"
                               readonly>
                    </div>

                    <!-- ASAL SEKOLAH -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Asal Sekolah
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $pendaftaran->asal_sekolah }}"
                               readonly>
                    </div>

                    <!-- PROGRAM -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Program Unggulan
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $pendaftaran->program->nama_program_unggulan ?? 'Belum ada program' }}"
                               readonly>
                    </div>

                    <!-- STATUS -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Status Pendaftaran
                            <span class="text-danger">*</span>
                        </label>

                        <select name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required>

                            <option value="pending"
                                {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="dibaca"
                                {{ $pendaftaran->status == 'dibaca' ? 'selected' : '' }}>
                                Dibaca
                            </option>

                            <option value="diverifikasi"
                                {{ $pendaftaran->status == 'diverifikasi' ? 'selected' : '' }}>
                                Diverifikasi
                            </option>

                            <option value="lolos_berkas"
                                {{ $pendaftaran->status == 'lolos_berkas' ? 'selected' : '' }}>
                                Lolos Berkas
                            </option>

                            <option value="diterima"
                                {{ $pendaftaran->status == 'diterima' ? 'selected' : '' }}>
                                Diterima
                            </option>

                            <option value="ditolak"
                                {{ $pendaftaran->status == 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-md-4">

                    <!-- STATUS CARD -->
                    <div class="card mb-3 border-0 shadow-sm">

                        <div class="card-header bg-light">
                            <i class="fas fa-info-circle"></i>
                            Informasi Status
                        </div>

                        <div class="card-body">

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Status Saat Ini
                                </label>

                                <div>

                                    @if($pendaftaran->status == 'pending')

                                        <span class="badge bg-warning px-3 py-2">
                                            Pending
                                        </span>

                                    @elseif($pendaftaran->status == 'dibaca')

                                        <span class="badge bg-secondary px-3 py-2">
                                            Dibaca
                                        </span>

                                    @elseif($pendaftaran->status == 'diverifikasi')

                                        <span class="badge bg-info px-3 py-2">
                                            Diverifikasi
                                        </span>

                                    @elseif($pendaftaran->status == 'lolos_berkas')

                                        <span class="badge bg-primary px-3 py-2">
                                            Lolos Berkas
                                        </span>

                                    @elseif($pendaftaran->status == 'diterima')

                                        <span class="badge bg-success px-3 py-2">
                                            Diterima
                                        </span>

                                    @else

                                        <span class="badge bg-danger px-3 py-2">
                                            Ditolak
                                        </span>

                                    @endif

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Tanggal Daftar
                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $pendaftaran->created_at->format('d/m/Y H:i') }}"
                                       readonly>

                            </div>

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="alert alert-info">

                        <i class="fas fa-info-circle"></i>

                        <strong>Informasi:</strong>

                        <ul class="mb-0 mt-2 small">
                            <li>Status dapat diubah kapan saja</li>
                            <li>Perubahan akan tersimpan otomatis</li>
                            <li>Pastikan status sesuai hasil seleksi</li>
                        </ul>

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="border-top pt-3 mt-3 d-flex gap-2">

                <a href="{{ route('admin.pendaftaran.index') }}"
                   class="btn btn-secondary custom-btn">

                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali

                </a>

                <button type="submit"
                        class="btn btn-primary custom-btn">

                    <i class="fas fa-save me-2"></i>
                    Update Status

                </button>

            </div>

        </form>

    </div>

</div>

<style>

.custom-btn{
    border-radius: 12px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all .25s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,.15);
}

.custom-btn:hover{
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0,0,0,.25) !important;
}

.form-control,
.form-select{
    border-radius: 10px;
}

.card{
    border-radius: 14px;
}

.badge{
    font-size: 13px;
}

</style>

@endsection