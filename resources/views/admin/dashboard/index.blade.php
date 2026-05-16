@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">
    Dashboard
</li>
@endsection

@section('content')

<div class="container-fluid px-0">

    <!-- Welcome -->
    <div class="welcome-card mb-4">
        <div class="card border-0 shadow-sm welcome-bg">
            <div class="card-body p-4">

                <div class="row align-items-center">

                    <div class="col-md-8">
                        <h4 class="text-white fw-bold mb-2">
                            <i class="fas fa-chart-line me-2"></i>
                            Selamat Datang,
                            {{ Auth::user()->name ?? 'Admin' }} 👋
                        </h4>

                        <p class="text-white-50 mb-0">
                            Berikut adalah ringkasan data dan statistik website
                            SMK Agri Insani.
                        </p>
                    </div>

                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="fas fa-school fa-4x text-white opacity-50"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">

        <!-- Berita -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1 small">
                                Total Berita
                            </p>

                            <h2 class="fw-bold mb-0 text-danger">
                                {{ number_format($totalBerita ?? 0) }}
                            </h2>

                            <small class="text-danger">
                                <i class="fas fa-newspaper"></i>
                                Semua berita
                            </small>
                        </div>

                        <div class="stat-icon bg-danger-light">
                            <i class="fas fa-newspaper text-danger"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1 small">
                                Pengumuman
                            </p>

                            <h2 class="fw-bold mb-0 text-orange">
                                {{ number_format($totalPengumuman ?? 0) }}
                            </h2>

                            <small class="text-orange">
                                <i class="fas fa-bullhorn"></i>
                                Informasi
                            </small>
                        </div>

                        <div class="stat-icon bg-orange-light">
                            <i class="fas fa-bullhorn text-orange"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Pendaftar -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1 small">
                                Pendaftar
                            </p>

                            <h2 class="fw-bold mb-0 text-warning">
                                {{ number_format($totalPendaftar ?? 0) }}
                            </h2>

                            <small class="text-warning">
                                <i class="fas fa-users"></i>
                                Keseluruhan
                            </small>
                        </div>

                        <div class="stat-icon bg-warning-light">
                            <i class="fas fa-users text-warning"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Galeri -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1 small">
                                Galeri
                            </p>

                            <h2 class="fw-bold mb-0 text-cyan">
                                {{ number_format($totalGaleri ?? 0) }}
                            </h2>

                            <small class="text-cyan">
                                <i class="fas fa-images"></i>
                                Foto & video
                            </small>
                        </div>

                        <div class="stat-icon bg-cyan-light">
                            <i class="fas fa-images text-cyan"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1 small">
                                Kontak
                            </p>

                            <h2 class="fw-bold mb-0 text-indigo">
                                {{ number_format($totalKontak ?? 0) }}
                            </h2>

                            <small class="text-indigo">
                                <i class="fas fa-envelope"></i>
                                Pesan masuk
                            </small>
                        </div>

                        <div class="stat-icon bg-indigo-light">
                            <i class="fas fa-envelope text-indigo"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- WhatsApp -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">
            <div class="stat-card card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1 small">
                                Chat WA
                            </p>

                            <h2 class="fw-bold mb-0 text-success">
                                {{ number_format($totalWhatsapp ?? 0) }}
                            </h2>

                            <small class="text-success">
                                <i class="fab fa-whatsapp"></i>
                                WhatsApp
                            </small>
                        </div>

                        <div class="stat-icon bg-success-light">
                            <i class="fab fa-whatsapp text-success"></i>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Grafik -->
    <div class="row">

        <!-- Statistik -->
        <div class="col-lg-7 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 pb-0">

                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-chart-bar text-primary me-2"></i>
                        Statistik Konten
                    </h5>

                    <p class="text-muted small mt-1">
                        Jumlah konten yang telah dipublikasikan
                    </p>

                </div>

                <div class="card-body">
                    <canvas id="statsChart" height="250"></canvas>
                </div>

            </div>

        </div>

        <!-- Aksi Cepat -->
        <div class="col-lg-5 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 pb-0">

                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Aksi Cepat
                    </h5>

                    <p class="text-muted small mt-1">
                        Akses fitur yang sering digunakan
                    </p>

                </div>

                <div class="card-body">

                    <div class="d-grid gap-2">

                        <!-- BERITA MERAH -->
                        <a href="{{ route('admin.berita.create') }}"
                           class="btn btn-danger">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Berita Baru
                        </a>

                        <!-- PENGUMUMAN JINGGA -->
                        <a href="{{ route('admin.pengumuman.create') }}"
                           class="btn btn-orange text-white">
                            <i class="fas fa-bullhorn me-2"></i>
                            Buat Pengumuman
                        </a>

                        <!-- PENDAFTARAN KUNING -->
                        <a href="{{ route('admin.pendaftaran.index') }}"
                           class="btn btn-warning text-dark">
                            <i class="fas fa-users me-2"></i>
                            Lihat Pendaftaran
                        </a>

                        <!-- GALERI BIRU TOSCA -->
                        <a href="{{ route('admin.galeri.index') }}"
                           class="btn btn-cyan text-white">
                            <i class="fas fa-images me-2"></i>
                            Kelola Galeri
                        </a>

                        <!-- KONTAK NILA -->
                        <a href="{{ route('admin.kontak.index') }}"
                           class="btn btn-indigo text-white">
                            <i class="fas fa-envelope me-2"></i>
                            Lihat Kontak
                        </a>

                        <!-- CHAT WA HIJAU -->
                        <a href="{{ route('admin.kontak.index') }}"
                           class="btn btn-success">
                            <i class="fab fa-whatsapp me-2"></i>
                            Lihat Chat WA
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@push('styles')

<style>

.welcome-bg{
    background: linear-gradient(135deg,#14401E 0%,#246934 100%);
    border-radius:20px;
}

.stat-card{
    border-radius:18px;
    transition:0.3s;
    overflow:hidden;
}

.stat-card:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 35px rgba(0,0,0,0.12)!important;
}

.stat-icon{
    width:60px;
    height:60px;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

/* ORANGE */
.text-orange{
    color:#fd7e14 !important;
}

.bg-orange-light{
    background:rgba(253,126,20,0.15);
}

.btn-orange{
    background:#fd7e14;
    border-color:#fd7e14;
}

.btn-orange:hover{
    background:#e96b02;
    border-color:#e96b02;
    color:#fff;
}

/* CYAN / BIRU TOSCA */
.text-cyan{
    color:#06b6d4 !important;
}

.bg-cyan-light{
    background:rgba(6,182,212,0.15);
}

.btn-cyan{
    background:#06b6d4;
    border-color:#06b6d4;
}

.btn-cyan:hover{
    background:#0891b2;
    border-color:#0891b2;
    color:#fff;
}

/* INDIGO */
.text-indigo{
    color:#6610f2 !important;
}

.bg-indigo-light{
    background:rgba(102,16,242,0.15);
}

.btn-indigo{
    background:#6610f2;
    border-color:#6610f2;
}

.btn-indigo:hover{
    background:#520dc2;
    border-color:#520dc2;
    color:#fff;
}

/* DEFAULT */
.bg-success-light{
    background:rgba(25,135,84,0.12);
}

.bg-warning-light{
    background:rgba(255,193,7,0.15);
}

.bg-primary-light{
    background:rgba(13,110,253,0.12);
}

.bg-danger-light{
    background:rgba(220,53,69,0.12);
}

.btn{
    border-radius:12px;
    font-weight:600;
    padding:12px;
}

.card{
    border-radius:20px;
}

@media(max-width:768px){

    .stat-icon{
        width:50px;
        height:50px;
        font-size:20px;
    }

    h2{
        font-size:1.4rem;
    }

}

</style>

@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('statsChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Berita',
                'Pengumuman',
                'Pendaftar',
                'Galeri',
                'Kontak',
                'WhatsApp'
            ],

            datasets: [{

                label: 'Jumlah Data',

                data: [
                    {{ $totalBerita ?? 0 }},
                    {{ $totalPengumuman ?? 0 }},
                    {{ $totalPendaftar ?? 0 }},
                    {{ $totalGaleri ?? 0 }},
                    {{ $totalKontak ?? 0 }},
                    {{ $totalWhatsapp ?? 0 }}
                ],

                backgroundColor: [
                    'rgba(220,53,69,0.8)',
                    'rgba(253,126,20,0.8)',
                    'rgba(255,193,7,0.8)',
                    'rgba(6,182,212,0.8)',
                    'rgba(102,16,242,0.8)',
                    'rgba(25,135,84,0.8)'
                ],

                borderColor: [
                    'rgb(220,53,69)',
                    'rgb(253,126,20)',
                    'rgb(255,193,7)',
                    'rgb(6,182,212)',
                    'rgb(102,16,242)',
                    'rgb(25,135,84)'
                ],

                borderWidth: 1,
                borderRadius: 10,
                barPercentage: 0.6,
                categoryPercentage: 0.8

            }]
        },

        options: {

            responsive: true,
            maintainAspectRatio: true,

            plugins: {

                legend: {
                    display: true,
                    position: 'top',

                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }

            },

            scales: {

                y: {
                    beginAtZero: true,

                    ticks: {
                        stepSize: 1
                    },

                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },

                x: {
                    grid: {
                        display: false
                    }
                }

            }

        }

    });

});

</script>

@endpush

@endsection