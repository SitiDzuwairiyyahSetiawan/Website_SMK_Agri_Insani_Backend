@extends('admin.layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')

<style>
    .detail-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
    }

    .hero-section {
        background: linear-gradient(135deg, #0d6efd, #4f8cff);
        border-radius: 16px;
        padding: 40px 30px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        right: -40px;
        top: -40px;
        width: 180px;
        height: 180px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 160px;
        height: 160px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .student-icon {
        width: 90px;
        height: 90px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        margin-bottom: 20px;
    }

    .student-icon i {
        font-size: 42px;
    }

    .info-table tr td {
        padding: 14px 10px;
        vertical-align: middle;
    }

    .info-table tr:not(:last-child) {
        border-bottom: 1px solid #eee;
    }

    .label-title {
        font-weight: 600;
        color: #555;
    }

    .status-badge {
        font-size: 13px;
        padding: 8px 14px;
        border-radius: 50px;
    }

    .file-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
</style>

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">Detail Pendaftaran</h2>
        <p class="text-muted mb-0">Informasi lengkap calon siswa</p>
    </div>

    <a href="{{ route('admin.pendaftaran.index') }}"
       class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

</div>

<div class="row justify-content-center">

    <div class="col-lg-10">

        <div class="card detail-card shadow-sm">

            <div class="card-body p-4">

                <!-- HERO -->
                <div class="hero-section mb-4 text-center">

                    <div class="student-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>

                    <h3 class="fw-bold mb-2">
                        {{ $pendaftaran->nama_lengkap }}
                    </h3>

                    <div class="mb-2">
                        {{ $pendaftaran->asal_sekolah }}
                    </div>

                    <small>
                        {{ $pendaftaran->created_at->format('d F Y H:i') }}
                    </small>

                </div>

                <!-- DATA SISWA -->
                <h5 class="fw-bold mb-3">Data Siswa</h5>

                <div class="table-responsive mb-4">

                    <table class="table info-table">

                        <tr>
                            <td class="label-title">NISN</td>
                            <td>{{ $pendaftaran->nisn }}</td>
                        </tr>

                        <tr>
                            <td class="label-title">NIK</td>
                            <td>{{ $pendaftaran->nik ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="label-title">TTL</td>
                            <td>
                                {{ $pendaftaran->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d F Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label-title">Jenis Kelamin</td>
                            <td>{{ $pendaftaran->jenis_kelamin }}</td>
                        </tr>

                        <tr>
                            <td class="label-title">Alamat</td>
                            <td>{{ $pendaftaran->alamat }}</td>
                        </tr>

                        <tr>
                            <td class="label-title">No HP</td>
                            <td>
                                <a href="https://wa.me/{{ $pendaftaran->no_hp }}"
                                   target="_blank"
                                   class="text-success text-decoration-none">
                                    {{ $pendaftaran->no_hp }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-title">Email</td>
                            <td>{{ $pendaftaran->email }}</td>
                        </tr>

                        <tr>
                            <td class="label-title">Asal Sekolah</td>
                            <td>{{ $pendaftaran->asal_sekolah }}</td>
                        </tr>

                        <tr>
                            <td class="label-title">Program</td>
                            <td>
                                <span class="badge bg-primary status-badge">
                                    {{ $pendaftaran->program->nama_program_unggulan ?? '-' }}
                                </span>
                            </td>
                        </tr>

                    </table>

                </div>

                <!-- ORANG TUA -->
                <h5 class="fw-bold mb-3">Data Orang Tua</h5>

                <table class="table info-table mb-4">

                    <tr>
                        <td class="label-title">Ayah</td>
                        <td>{{ $pendaftaran->nama_ayah ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label-title">Ibu</td>
                        <td>{{ $pendaftaran->nama_ibu ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label-title">No Wali</td>
                        <td>{{ $pendaftaran->no_hp_wali ?? '-' }}</td>
                    </tr>

                </table>

                <!-- FILE DOKUMEN -->
                <h5 class="fw-bold mb-3">Dokumen</h5>

                <div class="mb-4">

                    <div class="file-box">
                        <span>Foto Siswa</span>
                        @if($pendaftaran->foto_siswa)
                            <a href="{{ route('admin.pendaftaran.download', [$pendaftaran->id,'foto']) }}"
                               class="btn btn-sm btn-primary">
                                Download
                            </a>
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </div>

                    <div class="file-box">
                        <span>KK</span>
                        @if($pendaftaran->file_kk)
                            <a href="{{ route('admin.pendaftaran.download', [$pendaftaran->id,'kk']) }}"
                               class="btn btn-sm btn-primary">
                                Download
                            </a>
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </div>

                    <div class="file-box">
                        <span>Transkrip Nilai</span>
                        @if($pendaftaran->transkrip_nilai)
                            <a href="{{ route('admin.pendaftaran.download', [$pendaftaran->id,'transkrip']) }}"
                               class="btn btn-sm btn-primary">
                                Download
                            </a>
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </div>

                </div>

                <!-- STATUS -->
                <h5 class="fw-bold mb-3">Status Pendaftaran</h5>

                @php
                    $status = $pendaftaran->status;
                @endphp

                <div class="mb-4">

                    @if($status == 'pending')
                        <span class="badge bg-warning status-badge">Pending</span>

                    @elseif($status == 'dibaca')
                        <span class="badge bg-secondary status-badge">Dibaca</span>

                    @elseif($status == 'diverifikasi')
                        <span class="badge bg-info status-badge">Diverifikasi</span>

                    @elseif($status == 'lolos_berkas')
                        <span class="badge bg-primary status-badge">Lolos Berkas</span>

                    @elseif($status == 'diterima')
                        <span class="badge bg-success status-badge">Diterima</span>

                    @else
                        <span class="badge bg-danger status-badge">Ditolak</span>
                    @endif

                </div>

                <!-- TRACKING ADMIN -->
                <h5 class="fw-bold mb-3">Tracking Admin</h5>

                <table class="table info-table">

                    <tr>
                        <td class="label-title">Diverifikasi Oleh</td>
                        <td>{{ $pendaftaran->verified_by ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label-title">Waktu Verifikasi</td>
                        <td>{{ $pendaftaran->verified_at ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="label-title">Catatan Admin</td>
                        <td>{{ $pendaftaran->catatan_admin ?? '-' }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection