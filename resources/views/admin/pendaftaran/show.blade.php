@extends('admin.layouts.app')

@section('title', 'Detail Pendaftaran')

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
        color:var(--green-900);
        margin-bottom:8px;
        line-height:1.1;
    }

    .page-subtitle{
        color:#6b7280;
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

    .hero-box{
        width:100%;
        min-height:420px;
        border-radius:24px;
        background:linear-gradient(135deg,#166534,#14532d);
        position:relative;
        overflow:hidden;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        padding:40px;
    }

    .hero-box::before{
        content:'';
        position:absolute;
        right:-40px;
        top:-40px;
        width:220px;
        height:220px;
        border-radius:50%;
        background:rgba(255,255,255,.06);
    }

    .hero-box::after{
        content:'';
        position:absolute;
        left:-50px;
        bottom:-50px;
        width:180px;
        height:180px;
        border-radius:50%;
        background:rgba(255,255,255,.04);
    }

    .student-avatar{
        width:110px;
        height:110px;
        border-radius:30px;
        background:rgba(255,255,255,.12);
        backdrop-filter:blur(8px);
        display:flex;
        align-items:center;
        justify-content:center;
        margin:0 auto 24px;
        box-shadow:0 10px 30px rgba(0,0,0,.15);
    }

    .student-avatar i{
        font-size:48px;
        color:white;
    }

    .hero-name{
        font-size:38px;
        font-weight:800;
        color:white;
        margin-bottom:12px;
        line-height:1.2;
    }

    .hero-school{
        color:rgba(255,255,255,.85);
        font-size:16px;
        margin-bottom:24px;
        font-weight:500;
    }

    .meta-wrapper{
        display:flex;
        justify-content:center;
        flex-wrap:wrap;
        gap:12px;
    }

    .meta-chip{
        display:inline-flex;
        align-items:center;
        gap:10px;
        padding:12px 18px;
        border-radius:18px;
        background:rgba(255,255,255,.10);
        border:1px solid rgba(255,255,255,.08);
        color:white;
        font-size:14px;
        font-weight:700;
        backdrop-filter:blur(8px);
    }

    .info-item{
        padding:16px 0;
        border-bottom:1px dashed #e5e7eb;
    }

    .info-item:last-child{
        border-bottom:none;
        padding-bottom:0;
    }

    .info-label{
        font-size:13px;
        color:#9ca3af;
        margin-bottom:6px;
        font-weight:600;
    }

    .info-value{
        font-size:15px;
        font-weight:700;
        color:#111827;
        line-height:1.8;
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

    .status-warning{
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
        color:#2563eb;
    }

    .status-success{
        background:#dcfce7;
        color:#166534;
    }

    .status-danger{
        background:#fee2e2;
        color:#b91c1c;
    }

    .document-box{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:16px;
        padding:18px;
        border-radius:20px;
        background:#f9fafb;
        border:1px solid #eef2f7;
        margin-bottom:14px;
    }

    .document-info{
        display:flex;
        align-items:center;
        gap:14px;
    }

    .document-icon{
        width:52px;
        height:52px;
        border-radius:16px;
        background:#dcfce7;
        color:#166534;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
    }

    .btn-download{
        border:none !important;
        border-radius:14px !important;
        padding:10px 18px !important;
        background:linear-gradient(135deg,#166534,#15803d) !important;
        color:white !important;
        font-size:13px;
        font-weight:700;
    }

    .btn-back{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        background:#f3f4f6 !important;
        color:#374151 !important;
    }

    .btn-edit{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        color:white !important;
        background:linear-gradient(
            135deg,
            #f59e0b,
            #d97706
        ) !important;
    }

    .btn-delete{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        color:white !important;
        background:linear-gradient(
            135deg,
            #dc2626,
            #b91c1c
        ) !important;
    }

    @media(max-width:768px){

        .page-title{
            font-size:30px;
        }

        .hero-name{
            font-size:28px;
        }

        .hero-box{
            min-height:320px;
            padding:28px;
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
            Detail Pendaftaran
        </h1>

        <p class="page-subtitle">
            Informasi lengkap calon siswa baru
        </p>

    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="{{ route('admin.pendaftaran.index') }}"
           class="btn btn-back">

            <i class="fas fa-arrow-left me-2"></i>
            Kembali

        </a>

    </div>

</div>

<div class="row g-4">

    {{-- LEFT --}}
    <div class="col-lg-8">

        <div class="modern-card">

            <div class="card-body-modern">

                {{-- HERO --}}
                <div class="mb-4">

                    <div class="hero-box">

                        <div>

                            <div class="student-avatar">
                                <i class="fas fa-user-graduate"></i>
                            </div>

                            <h1 class="hero-name">
                                {{ $pendaftaran->nama_lengkap }}
                            </h1>

                            <div class="hero-school">
                                {{ $pendaftaran->asal_sekolah }}
                            </div>

                            <div class="meta-wrapper">

                                <div class="meta-chip">
                                    <i class="fas fa-id-card"></i>
                                    NISN {{ $pendaftaran->nisn }}
                                </div>

                                <div class="meta-chip">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $pendaftaran->created_at->format('d M Y') }}
                                </div>

                                <div class="meta-chip">
                                    <i class="fas fa-clock"></i>
                                    {{ $pendaftaran->created_at->format('H:i') }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- DATA SISWA --}}
                <div class="section-title">
                    Data Siswa
                </div>

                <div class="info-item">
                    <div class="info-label">NIK</div>
                    <div class="info-value">
                        {{ $pendaftaran->nik ?? '-' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Tempat, Tanggal Lahir</div>
                    <div class="info-value">
                        {{ $pendaftaran->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d F Y') }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Jenis Kelamin</div>
                    <div class="info-value">
                        {{ $pendaftaran->jenis_kelamin }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">
                        {{ $pendaftaran->alamat }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">No HP</div>
                    <div class="info-value">
                        <a href="https://wa.me/{{ $pendaftaran->no_hp }}"
                           target="_blank"
                           class="text-success text-decoration-none">

                            {{ $pendaftaran->no_hp }}

                        </a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        {{ $pendaftaran->email }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Program Unggulan</div>
                    <div class="info-value">
                        {{ $pendaftaran->program->nama_program_unggulan ?? '-' }}
                    </div>
                </div>

                {{-- ORANG TUA --}}
                <div class="section-title mt-5">
                    Data Orang Tua
                </div>

                <div class="info-item">
                    <div class="info-label">Nama Ayah</div>
                    <div class="info-value">
                        {{ $pendaftaran->nama_ayah ?? '-' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">Nama Ibu</div>
                    <div class="info-value">
                        {{ $pendaftaran->nama_ibu ?? '-' }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">No HP Wali</div>
                    <div class="info-value">
                        {{ $pendaftaran->no_hp_wali ?? '-' }}
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- RIGHT --}}
    <div class="col-lg-4">

        {{-- STATUS --}}
        <div class="modern-card mb-4">

            <div class="card-body-modern">

                <div class="section-title">
                    Status Pendaftaran
                </div>

                <div class="info-item">

                    <div class="info-label">
                        Status Saat Ini
                    </div>

                    <div class="info-value">

                        @if($pendaftaran->status == 'pending')

                            <div class="status-badge status-warning">
                                <i class="fas fa-clock"></i>
                                Pending
                            </div>

                        @elseif($pendaftaran->status == 'dibaca')

                            <div class="status-badge status-secondary">
                                <i class="fas fa-book-open"></i>
                                Dibaca
                            </div>

                        @elseif($pendaftaran->status == 'diverifikasi')

                            <div class="status-badge status-info">
                                <i class="fas fa-check-circle"></i>
                                Diverifikasi
                            </div>

                        @elseif($pendaftaran->status == 'lolos_berkas')

                            <div class="status-badge status-primary">
                                <i class="fas fa-file-alt"></i>
                                Lolos Berkas
                            </div>

                        @elseif($pendaftaran->status == 'diterima')

                            <div class="status-badge status-success">
                                <i class="fas fa-user-check"></i>
                                Diterima
                            </div>

                        @else

                            <div class="status-badge status-danger">
                                <i class="fas fa-times-circle"></i>
                                Ditolak
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- DOKUMEN --}}
        <div class="modern-card">

            <div class="card-body-modern">

                <div class="section-title">
                    Dokumen Pendaftaran
                </div>

                {{-- FOTO --}}
                <div class="document-box">

                    <div class="document-info">

                        <div class="document-icon">
                            <i class="fas fa-image"></i>
                        </div>

                        <div>

                            <div class="fw-bold">
                                Foto Siswa
                            </div>

                            <small class="text-muted">
                                File upload siswa
                            </small>

                        </div>

                    </div>

                    @if($pendaftaran->foto_siswa)

                        <a href="{{ route('admin.pendaftaran.download', [$pendaftaran->id,'foto']) }}"
                           class="btn btn-download">

                            Download

                        </a>

                    @else

                        <small class="text-muted">
                            Tidak ada
                        </small>

                    @endif

                </div>

                {{-- KK --}}
                <div class="document-box">

                    <div class="document-info">

                        <div class="document-icon">
                            <i class="fas fa-users"></i>
                        </div>

                        <div>

                            <div class="fw-bold">
                                Kartu Keluarga
                            </div>

                            <small class="text-muted">
                                Dokumen KK
                            </small>

                        </div>

                    </div>

                    @if($pendaftaran->file_kk)

                        <a href="{{ route('admin.pendaftaran.download', [$pendaftaran->id,'kk']) }}"
                           class="btn btn-download">

                            Download

                        </a>

                    @else

                        <small class="text-muted">
                            Tidak ada
                        </small>

                    @endif

                </div>

                {{-- TRANSKRIP --}}
                <div class="document-box mb-0">

                    <div class="document-info">

                        <div class="document-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>

                        <div>

                            <div class="fw-bold">
                                Transkrip Nilai
                            </div>

                            <small class="text-muted">
                                Dokumen nilai siswa
                            </small>

                        </div>

                    </div>

                    @if($pendaftaran->transkrip_nilai)

                        <a href="{{ route('admin.pendaftaran.download', [$pendaftaran->id,'transkrip']) }}"
                           class="btn btn-download">

                            Download

                        </a>

                    @else

                        <small class="text-muted">
                            Tidak ada
                        </small>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection