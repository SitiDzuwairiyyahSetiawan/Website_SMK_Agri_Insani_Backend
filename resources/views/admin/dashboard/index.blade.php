@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- BLUR -->
<div class="blur-dashboard-1"></div>
<div class="blur-dashboard-2"></div>

<div class="dashboard-wrapper">

<div class="container-fluid px-0">

    <!-- Welcome -->
    <div class="welcome-card mb-4">

        <div class="card border-0 welcome-bg">

            <div class="card-body p-4 p-lg-5">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <div class="welcome-badge mb-3">
                            <i class="fas fa-shield-halved me-2"></i>
                            Admin Dashboard
                        </div>

                        <h2 class="welcome-title mb-3">
                            Selamat Datang,
                            {{ Auth::user()->name ?? 'Admin' }} 👋
                        </h2>

                        <p class="welcome-subtitle mb-0">
                            Berikut adalah ringkasan data dan statistik website
                            SMK Agri Insani secara realtime.
                        </p>

                    </div>

                    <div class="col-lg-4 text-end d-none d-lg-block">

                        <div class="welcome-icon">
                            <i class="fas fa-school"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Statistik -->
    <div class="row mb-4">

        <!-- BERITA -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="stat-card card border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label">
                                Total Berita
                            </p>

                            <h2 class="stat-value text-danger">
                                {{ number_format($totalBerita ?? 0) }}
                            </h2>

                            <small class="stat-desc">
                                <i class="fas fa-newspaper me-1"></i>
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

        <!-- PENGUMUMAN -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="stat-card card border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label">
                                Pengumuman
                            </p>

                            <h2 class="stat-value text-orange">
                                {{ number_format($totalPengumuman ?? 0) }}
                            </h2>

                            <small class="stat-desc">
                                <i class="fas fa-bullhorn me-1"></i>
                                Informasi sekolah
                            </small>

                        </div>

                        <div class="stat-icon bg-orange-light">
                            <i class="fas fa-bullhorn text-orange"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- PENDAFTAR -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="stat-card card border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label">
                                Pendaftar
                            </p>

                            <h2 class="stat-value text-warning">
                                {{ number_format($totalPendaftar ?? 0) }}
                            </h2>

                            <small class="stat-desc">
                                <i class="fas fa-users me-1"></i>
                                Total siswa
                            </small>

                        </div>

                        <div class="stat-icon bg-warning-light">
                            <i class="fas fa-users text-warning"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- GALERI -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="stat-card card border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label">
                                Galeri
                            </p>

                            <h2 class="stat-value text-cyan">
                                {{ number_format($totalGaleri ?? 0) }}
                            </h2>

                            <small class="stat-desc">
                                <i class="fas fa-images me-1"></i>
                                Media sekolah
                            </small>

                        </div>

                        <div class="stat-icon bg-cyan-light">
                            <i class="fas fa-images text-cyan"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- KONTAK -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="stat-card card border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label">
                                Kontak
                            </p>

                            <h2 class="stat-value text-indigo">
                                {{ number_format($totalKontak ?? 0) }}
                            </h2>

                            <small class="stat-desc">
                                <i class="fas fa-envelope me-1"></i>
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

        <!-- WHATSAPP -->
        <div class="col-xl-2 col-md-4 col-6 mb-4">

            <div class="stat-card card border-0 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="stat-label">
                                Chat WA
                            </p>

                            <h2 class="stat-value text-success">
                                {{ number_format($totalWhatsapp ?? 0) }}
                            </h2>

                            <small class="stat-desc">
                                <i class="fab fa-whatsapp me-1"></i>
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

    <!-- CHART + QUICK -->
    <div class="row">

        <!-- CHART -->
        <div class="col-lg-7 mb-4">

            <div class="glass-card card border-0">

                <div class="card-header border-0 pt-4 pb-0">

                    <h5 class="fw-bold mb-2 text-white">
                        <i class="fas fa-chart-column me-2 text-success"></i>
                        Statistik Konten
                    </h5>

                    <p class="text-white-soft small">
                        Jumlah seluruh konten website
                    </p>

                </div>

                <div class="card-body">
                    <canvas id="statsChart" height="250"></canvas>
                </div>

            </div>

        </div>

        <!-- QUICK ACTION -->
        <div class="col-lg-5 mb-4">

            <div class="glass-card card border-0">

                <div class="card-header border-0 pt-4 pb-0">

                    <h5 class="fw-bold mb-2 text-white">
                        <i class="fas fa-bolt me-2 text-warning"></i>
                        Aksi Cepat
                    </h5>

                    <p class="text-white-soft small">
                        Kelola fitur website dengan cepat
                    </p>

                </div>

                <div class="card-body">

                    <div class="d-grid gap-3">

                        <a href="{{ route('admin.berita.create') }}"
                           class="btn btn-danger custom-btn">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Berita
                        </a>

                        <a href="{{ route('admin.pengumuman.create') }}"
                           class="btn btn-orange text-white custom-btn">
                            <i class="fas fa-bullhorn me-2"></i>
                            Buat Pengumuman
                        </a>

                        <a href="{{ route('admin.pendaftaran.index') }}"
                           class="btn btn-warning text-dark custom-btn">
                            <i class="fas fa-users me-2"></i>
                            Lihat Pendaftaran
                        </a>

                        <a href="{{ route('admin.galeri.index') }}"
                           class="btn btn-cyan text-white custom-btn">
                            <i class="fas fa-images me-2"></i>
                            Kelola Galeri
                        </a>

                        <a href="{{ route('admin.kontak.index') }}"
                           class="btn btn-indigo text-white custom-btn">
                            <i class="fas fa-envelope me-2"></i>
                            Pesan Kontak
                        </a>

                        <a href="{{ route('admin.kontak.index') }}"
                           class="btn btn-success custom-btn">
                            <i class="fab fa-whatsapp me-2"></i>
                            Chat WhatsApp
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

@push('styles')

<style>

body{
    background:
        linear-gradient(
            135deg,
            #07130C 0%,
            #0F2417 40%,
            #14532D 100%
        );
}

/* BLUR */

.blur-dashboard-1,
.blur-dashboard-2{
    position:fixed;
    border-radius:999px;
    filter:blur(120px);
    opacity:.18;
    z-index:0;
}

.blur-dashboard-1{
    width:320px;
    height:320px;
    background:#22C55E;
    top:-120px;
    left:-100px;
}

.blur-dashboard-2{
    width:320px;
    height:320px;
    background:#4ADE80;
    bottom:-120px;
    right:-120px;
}

.dashboard-wrapper{
    position:relative;
    z-index:2;
}

/* WELCOME */

.welcome-bg{
    background:
        linear-gradient(
            135deg,
            rgba(20,83,45,.92),
            rgba(34,197,94,.72)
        );

    backdrop-filter:blur(18px);

    border:1px solid rgba(255,255,255,.08);

    border-radius:32px;

    overflow:hidden;

    position:relative;

    box-shadow:
        0 20px 60px rgba(0,0,0,.25);
}

.welcome-bg::before{
    content:'';

    position:absolute;

    width:260px;
    height:260px;

    border-radius:999px;

    background:rgba(255,255,255,.08);

    top:-130px;
    right:-100px;
}

.welcome-badge{
    display:inline-flex;
    align-items:center;

    padding:10px 18px;

    border-radius:999px;

    background:rgba(255,255,255,.12);

    color:white;

    font-size:13px;
    font-weight:700;
}

.welcome-title{
    font-size:2rem;
    font-weight:800;
    color:white;
}

.welcome-subtitle{
    color:rgba(255,255,255,.75);
    line-height:1.8;
}

.welcome-icon{
    width:130px;
    height:130px;

    border-radius:32px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:rgba(255,255,255,.08);

    backdrop-filter:blur(10px);

    margin-left:auto;

    border:1px solid rgba(255,255,255,.08);
}

.welcome-icon i{
    font-size:60px;
    color:white;
    opacity:.85;
}

/* CARD */

.glass-card,
.stat-card{
    background:rgba(255,255,255,.08) !important;

    backdrop-filter:blur(18px);

    border:1px solid rgba(255,255,255,.08) !important;

    border-radius:28px;

    overflow:hidden;

    transition:.35s ease;

    box-shadow:
        0 15px 40px rgba(0,0,0,.18);
}

.stat-card:hover{
    transform:translateY(-6px);

    box-shadow:
        0 25px 60px rgba(0,0,0,.25);
}

/* TEXT */

.stat-label{
    color:rgba(255,255,255,.6);
    margin-bottom:6px;
    font-size:14px;
}

.stat-value{
    font-size:2rem;
    font-weight:800;
    margin-bottom:5px;
}

.stat-desc{
    color:rgba(255,255,255,.7);
}

.text-white-soft{
    color:rgba(255,255,255,.65);
}

/* ICON */

.stat-icon{
    width:65px;
    height:65px;

    border-radius:20px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;

    border:1px solid rgba(255,255,255,.08);

    backdrop-filter:blur(10px);
}

/* COLORS */

.text-orange{
    color:#fd7e14 !important;
}

.text-cyan{
    color:#06b6d4 !important;
}

.text-indigo{
    color:#8b5cf6 !important;
}

.bg-danger-light{
    background:rgba(220,53,69,.18);
}

.bg-orange-light{
    background:rgba(253,126,20,.18);
}

.bg-warning-light{
    background:rgba(255,193,7,.18);
}

.bg-cyan-light{
    background:rgba(6,182,212,.18);
}

.bg-indigo-light{
    background:rgba(139,92,246,.18);
}

.bg-success-light{
    background:rgba(25,135,84,.18);
}

/* BUTTON */

.custom-btn{
    border:none !important;

    border-radius:18px;

    padding:14px 18px;

    font-weight:700;

    transition:.3s ease;
}

.custom-btn:hover{
    transform:translateY(-3px);
}

.btn-orange{
    background:#fd7e14;
}

.btn-cyan{
    background:#06b6d4;
}

.btn-indigo{
    background:#8b5cf6;
}

/* CHART */

canvas{
    filter:brightness(1.1);
}

/* MOBILE */

@media(max-width:768px){

    .welcome-title{
        font-size:1.5rem;
    }

    .welcome-bg{
        border-radius:24px;
    }

    .stat-card{
        border-radius:22px;
    }

    .stat-icon{
        width:55px;
        height:55px;
        font-size:20px;
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
                    'rgba(220,53,69,0.85)',
                    'rgba(253,126,20,0.85)',
                    'rgba(255,193,7,0.85)',
                    'rgba(6,182,212,0.85)',
                    'rgba(139,92,246,0.85)',
                    'rgba(25,135,84,0.85)'
                ],

                borderRadius: 12,
                borderSkipped: false,
                barPercentage: 0.65,
                categoryPercentage: 0.7

            }]
        },

        options: {

            responsive: true,

            plugins: {

                legend: {

                    labels: {
                        color: '#fff',
                        usePointStyle: true
                    }

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        color: 'rgba(255,255,255,.7)',
                        stepSize: 1
                    },

                    grid: {
                        color: 'rgba(255,255,255,.08)'
                    }

                },

                x: {

                    ticks: {
                        color: 'rgba(255,255,255,.7)'
                    },

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