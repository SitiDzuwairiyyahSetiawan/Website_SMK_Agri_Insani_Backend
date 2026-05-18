@extends('admin.layouts.app')

@section('title', 'Detail Visi & Misi')

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

    .hero-box{
        width:100%;
        min-height:420px;
        border-radius:24px;
        overflow:hidden;
        position:relative;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:50px;
    }

    .hero-visi{
        background:linear-gradient(
            135deg,
            #1d4ed8,
            #2563eb,
            #3b82f6
        );
    }

    .hero-misi{
        background:linear-gradient(
            135deg,
            #166534,
            #15803d,
            #22c55e
        );
    }

    .hero-box::before{
        content:'';
        position:absolute;
        width:300px;
        height:300px;
        border-radius:999px;
        background:rgba(255,255,255,.08);
        top:-100px;
        right:-80px;
    }

    .hero-box::after{
        content:'';
        position:absolute;
        width:220px;
        height:220px;
        border-radius:999px;
        background:rgba(255,255,255,.06);
        bottom:-80px;
        left:-60px;
    }

    .hero-content{
        position:relative;
        z-index:2;
        text-align:center;
    }

    .hero-icon{
        width:120px;
        height:120px;
        border-radius:32px;
        background:rgba(255,255,255,.15);
        display:flex;
        align-items:center;
        justify-content:center;
        margin:auto auto 28px;
        backdrop-filter:blur(8px);
        box-shadow:0 10px 30px rgba(0,0,0,.12);
    }

    .hero-icon i{
        font-size:58px;
        color:white;
    }

    .hero-label{
        color:rgba(255,255,255,.8);
        font-size:15px;
        font-weight:700;
        letter-spacing:.08em;
        margin-bottom:14px;
    }

    .hero-heading{
        font-size:42px;
        font-weight:800;
        color:white;
        margin-bottom:0;
    }

    .type-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 18px;
        border-radius:999px;
        font-size:13px;
        font-weight:700;
        margin-bottom:18px;
    }

    .badge-visi{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .badge-misi{
        background:#dcfce7;
        color:#166534;
    }

    .content-title{
        font-size:38px;
        font-weight:800;
        color:#111827;
        line-height:1.2;
        margin-bottom:24px;
    }

    .meta-wrapper{
        display:flex;
        flex-wrap:wrap;
        gap:12px;
    }

    .meta-chip{
        display:inline-flex;
        align-items:center;
        gap:10px;
        padding:12px 18px;
        border-radius:18px;
        background:#f9fafb;
        border:1px solid #f3f4f6;
        color:#374151;
        font-size:14px;
        font-weight:700;
    }

    .content-box{
        line-height:2;
        color:#4b5563;
        font-size:16px;
    }

    .misi-item{
        display:flex;
        align-items:flex-start;
        gap:16px;
        padding:18px 0;
        border-bottom:1px dashed #e5e7eb;
    }

    .misi-item:last-child{
        border-bottom:none;
    }

    .misi-check{
        min-width:42px;
        width:42px;
        height:42px;
        border-radius:14px;
        background:#dcfce7;
        color:#166534;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:16px;
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

    .status-visi{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .status-misi{
        background:#dcfce7;
        color:#166534;
    }

    .btn-back{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        background:#f3f4f6 !important;
        color:#374151 !important;
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

    .modal-modern{
        border:none;
        border-radius:28px;
        overflow:hidden;
    }

    @media(max-width:768px){

        .page-title{
            font-size:30px;
        }

        .content-title{
            font-size:28px;
        }

        .hero-box{
            min-height:320px;
            padding:30px;
        }

        .hero-heading{
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
            Detail {{ $visiMisi->type == 'visi' ? 'Visi' : 'Misi' }}
        </h1>

        <p class="page-subtitle">
            Informasi lengkap visi & misi sekolah
        </p>

    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="{{ route('admin.visi-misi.index') }}"
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

                    <div class="hero-box {{ $visiMisi->type == 'visi' ? 'hero-visi' : 'hero-misi' }}">

                        <div class="hero-content">

                            <div class="hero-icon">

                                @if($visiMisi->type == 'visi')

                                    <i class="fas fa-bullseye"></i>

                                @else

                                    <i class="fas fa-tasks"></i>

                                @endif

                            </div>

                            <div class="hero-label">
                                {{ strtoupper($visiMisi->type) }} SEKOLAH
                            </div>

                            <h1 class="hero-heading">

                                {{ $visiMisi->type == 'visi'
                                    ? 'Visi Sekolah'
                                    : 'Misi Sekolah'
                                }}

                            </h1>

                        </div>

                    </div>

                </div>

                {{-- CONTENT --}}
                <div>

                    @if($visiMisi->type == 'visi')

                        <div class="type-badge badge-visi">

                            <i class="fas fa-bullseye"></i>
                            Data Visi

                        </div>

                    @else

                        <div class="type-badge badge-misi">

                            <i class="fas fa-tasks"></i>
                            Data Misi

                        </div>

                    @endif

                    <h1 class="content-title">

                        {{ $visiMisi->type == 'visi'
                            ? 'Visi Utama Sekolah'
                            : 'Poin Misi Sekolah'
                        }}

                    </h1>

                    <div class="meta-wrapper mb-5">

                        <div class="meta-chip">

                            <i class="fas fa-calendar-alt"></i>
                            {{ $visiMisi->created_at->format('d M Y') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-clock"></i>
                            {{ $visiMisi->created_at->format('H:i') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-layer-group"></i>
                            {{ ucfirst($visiMisi->type) }}

                        </div>

                    </div>

                    <div class="section-title">
                        Konten {{ ucfirst($visiMisi->type) }}
                    </div>

                    <div class="content-box">

                        @if($visiMisi->type == 'visi')

                            {!! nl2br(e($visiMisi->visi)) !!}

                        @else

                            <div class="misi-item">

                                <div class="misi-check">
                                    <i class="fas fa-check"></i>
                                </div>

                                <div>
                                    {!! nl2br(e($visiMisi->misi)) !!}
                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- RIGHT --}}
    <div class="col-lg-4">

        {{-- INFO --}}
        <div class="modern-card mb-4">

            <div class="card-body-modern">

                <div class="section-title">
                    Informasi Data
                </div>

                <div class="info-item">

                    <div class="info-label">
                        ID Data
                    </div>

                    <div class="info-value">
                        {{ $visiMisi->id }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tipe Data
                    </div>

                    <div class="info-value">

                        @if($visiMisi->type == 'visi')

                            <div class="status-badge status-visi">

                                <i class="fas fa-bullseye"></i>
                                Visi

                            </div>

                        @else

                            <div class="status-badge status-misi">

                                <i class="fas fa-tasks"></i>
                                Misi

                            </div>

                        @endif

                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tanggal Dibuat
                    </div>

                    <div class="info-value">
                        {{ $visiMisi->created_at->format('d/m/Y H:i') }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Terakhir Update
                    </div>

                    <div class="info-value">
                        {{ $visiMisi->updated_at->diffForHumans() }}
                    </div>

                </div>

            </div>

        </div>


    </div>

</div>

{{-- DELETE MODAL --}}
<div class="modal fade"
     id="deleteModal"
     tabindex="-1"
     data-bs-backdrop="static">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-modern">

            <div class="modal-body p-5 text-center">

                <div class="mb-4">

                    <div class="mx-auto d-flex align-items-center justify-content-center rounded-circle"
                         style="width:90px;height:90px;background:#fee2e2;">

                        <i class="fas fa-trash-alt text-danger fa-2x"></i>

                    </div>

                </div>

                <h3 class="fw-bold mb-3">
                    Hapus Data?
                </h3>

                <p class="text-muted mb-4">
                    Data visi & misi akan dihapus permanen dari sistem.
                </p>

                <div class="alert alert-danger rounded-4 mb-4">

                    <strong>
                        {{ ucfirst($visiMisi->type) }} #{{ $visiMisi->id }}
                    </strong>

                </div>

                <div class="d-flex justify-content-center gap-3">

                    <button type="button"
                            class="btn btn-back"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <form action="{{ route('admin.visi-misi.destroy', $visiMisi->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-delete">

                            Ya, Hapus

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection