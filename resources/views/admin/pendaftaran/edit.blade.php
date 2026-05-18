@extends('admin.layouts.app')

@section('title', 'Edit Status Pendaftaran')

@section('content')

<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
        margin-bottom:32px;
        flex-wrap:wrap;
    }

    .page-title{
        font-size:38px;
        font-weight:800;
        color:white;
        margin-bottom:8px;
        line-height:1.1;
    }

    .page-subtitle{
        color:rgba(255,255,255,.7);
        margin:0;
        font-size:15px;
        font-weight:500;
    }

    .modern-card{
        border:none;
        border-radius:28px;
        background:white;
        overflow:hidden;
        box-shadow:
            0 10px 30px rgba(0,0,0,.05),
            0 2px 10px rgba(0,0,0,.03);
    }

    .card-body-modern{
        padding:32px;
    }

    .section-title{
        font-size:13px;
        font-weight:800;
        color:#16a34a;
        text-transform:uppercase;
        letter-spacing:.08em;
        margin-bottom:22px;
    }

    .form-label{
        font-size:14px;
        font-weight:700;
        color:#1f2937;
        margin-bottom:10px;
    }

    .form-control,
    .form-select,
    textarea{
        border-radius:18px !important;
        border:1px solid #e5e7eb !important;
        background:#f9fafb !important;
        padding:16px 18px !important;
        font-size:15px;
        box-shadow:none !important;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus{
        background:white !important;
        border-color:#bbf7d0 !important;
        box-shadow:0 0 0 4px rgba(22,163,74,.10) !important;
    }

    .readonly-input{
        background:#f3f4f6 !important;
        color:#6b7280;
    }

    .status-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 16px;
        border-radius:999px;
        font-size:13px;
        font-weight:700;
    }

    .status-pending{
        background:#fef3c7;
        color:#92400e;
    }

    .status-secondary{
        background:#e5e7eb;
        color:#374151;
    }

    .status-info{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .status-primary{
        background:#dbeafe;
        color:#1e40af;
    }

    .status-success{
        background:#dcfce7;
        color:#166534;
    }

    .status-danger{
        background:#fee2e2;
        color:#b91c1c;
    }

    .info-box{
        border:none;
        border-radius:24px;
        background:linear-gradient(
            135deg,
            #eff6ff,
            #dbeafe
        );
        padding:24px;
    }

    .info-title{
        font-size:16px;
        font-weight:800;
        color:#1d4ed8;
        margin-bottom:14px;
    }

    .info-list{
        padding-left:18px;
        margin:0;
    }

    .info-list li{
        color:#1e3a8a;
        margin-bottom:8px;
        line-height:1.6;
    }

    .student-profile{
        text-align:center;
        margin-bottom:28px;
    }

    .student-avatar{
        width:90px;
        height:90px;
        border-radius:50%;
        background:linear-gradient(
            135deg,
            #166534,
            #15803d
        );
        color:white;
        display:flex;
        align-items:center;
        justify-content:center;
        margin:0 auto 18px;
        font-size:38px;
    }

    .student-name{
        font-size:24px;
        font-weight:800;
        color:#111827;
        margin-bottom:6px;
    }

    .student-school{
        color:#6b7280;
        font-weight:500;
    }

    .btn-back{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        background:#f3f4f6 !important;
        color:#374151 !important;
        transition:.3s;
    }

    .btn-back:hover{
        background:#e5e7eb !important;
    }

    .btn-save{
        border:none !important;
        border-radius:18px !important;
        padding:14px 28px !important;
        font-weight:700;
        color:white !important;
        background:linear-gradient(
            135deg,
            #166534,
            #15803d
        ) !important;
        transition:.3s;
    }

    .btn-save:hover{
        transform:translateY(-2px);
        box-shadow:
            0 10px 20px rgba(21,128,61,.25);
    }

    .invalid-feedback{
        font-size:13px;
        margin-top:8px;
        display:block;
    }

    @media(max-width:768px){

        .page-title{
            font-size:30px;
        }

        .card-body-modern{
            padding:22px;
        }

    }

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Edit Status Pendaftaran
        </h1>

        <p class="page-subtitle">
            Update status dan informasi pendaftaran siswa
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.pendaftaran.updateStatus', $pendaftaran->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="row g-4">

        {{-- LEFT --}}
        <div class="col-lg-8">

            <div class="student-profile">

                <div class="student-avatar">
                    <i class="fas fa-user-graduate"></i>
                </div>

                <div class="student-name">
                    {{ $pendaftaran->nama_lengkap }}
                </div>

                <div class="student-school">
                    {{ $pendaftaran->asal_sekolah }}
                </div>

            </div>

            <div class="section-title">
                Data Pendaftaran
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control readonly-input"
                       value="{{ $pendaftaran->nama_lengkap }}" readonly>
            </div>

            <div class="mb-4">
                <label class="form-label">NISN</label>
                <input type="text" class="form-control readonly-input"
                       value="{{ $pendaftaran->nisn }}" readonly>
            </div>

            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="text" class="form-control readonly-input"
                       value="{{ $pendaftaran->email }}" readonly>
            </div>

            <div class="mb-4">
                <label class="form-label">Asal Sekolah</label>
                <input type="text" class="form-control readonly-input"
                       value="{{ $pendaftaran->asal_sekolah }}" readonly>
            </div>

            <div class="mb-4">
                <label class="form-label">Program Unggulan</label>
                <input type="text" class="form-control readonly-input"
                       value="{{ $pendaftaran->program->nama_program_unggulan ?? 'Belum ada program' }}"
                       readonly>
            </div>

            {{-- STATUS --}}
            <div>
                <label class="form-label">Status Pendaftaran</label>

                <select name="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required>

                    <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="dibaca" {{ $pendaftaran->status == 'dibaca' ? 'selected' : '' }}>
                        Dibaca
                    </option>

                    <option value="diverifikasi" {{ $pendaftaran->status == 'diverifikasi' ? 'selected' : '' }}>
                        Diverifikasi
                    </option>

                    <option value="lolos_berkas" {{ $pendaftaran->status == 'lolos_berkas' ? 'selected' : '' }}>
                        Lolos Berkas
                    </option>

                    <option value="diterima" {{ $pendaftaran->status == 'diterima' ? 'selected' : '' }}>
                        Diterima
                    </option>

                    <option value="ditolak" {{ $pendaftaran->status == 'ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>

                </select>

                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">

            <div class="modern-card mb-4">
                <div class="card-body-modern">

                    <div class="section-title">
                        Informasi Status
                    </div>

                    <div class="mb-4">
                        @if($pendaftaran->status == 'pending')
                            <div class="status-badge status-pending">
                                <i class="fas fa-clock"></i> Pending
                            </div>

                        @elseif($pendaftaran->status == 'dibaca')
                            <div class="status-badge status-secondary">
                                <i class="fas fa-book-open"></i> Dibaca
                            </div>

                        @elseif($pendaftaran->status == 'diverifikasi')
                            <div class="status-badge status-info">
                                <i class="fas fa-check-circle"></i> Diverifikasi
                            </div>

                        @elseif($pendaftaran->status == 'lolos_berkas')
                            <div class="status-badge status-primary">
                                <i class="fas fa-file-alt"></i> Lolos Berkas
                            </div>

                        @elseif($pendaftaran->status == 'diterima')
                            <div class="status-badge status-success">
                                <i class="fas fa-user-check"></i> Diterima
                            </div>

                        @else
                            <div class="status-badge status-danger">
                                <i class="fas fa-times-circle"></i> Ditolak
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tanggal Daftar</label>
                        <input type="text" class="form-control readonly-input"
                               value="{{ $pendaftaran->created_at->format('d/m/Y H:i') }}"
                               readonly>
                    </div>

                    <div>
                        <label class="form-label">Terakhir Update</label>
                        <input type="text" class="form-control readonly-input"
                               value="{{ $pendaftaran->updated_at->diffForHumans() }}"
                               readonly>
                    </div>

                </div>
            </div>

        </div>

    </div>

    {{-- BUTTON --}}
    <div class="border-top pt-4 mt-4 d-flex gap-3">

        <a href="{{ route('admin.pendaftaran.index') }}"
           class="btn btn-back">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>

        <button type="submit" class="btn btn-save">
            <i class="fas fa-save me-2"></i> Update Status
        </button>

    </div>

</form>

@endsection