@extends('admin.layouts.app')

@section('title', 'Edit Visi & Misi')

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
    textarea{
        border-radius:18px !important;
        border:1px solid #e5e7eb !important;
        background:#f9fafb !important;
        padding:16px 18px !important;
        font-size:15px;
        box-shadow:none !important;
    }

    .form-control:focus,
    textarea:focus{
        background:white !important;
        border-color:#bbf7d0 !important;
        box-shadow:0 0 0 4px rgba(22,163,74,.10) !important;
    }

    textarea.form-control{
        resize:none;
        min-height:320px !important;
        height:320px !important;
        padding-top:18px !important;
        line-height:1.8;
    }

    .hero-preview{
        width:100%;
        height:280px;
        border-radius:24px;
        overflow:hidden;
        position:relative;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        padding:30px;
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

    .hero-preview::before{
        content:'';
        position:absolute;
        width:220px;
        height:220px;
        border-radius:999px;
        background:rgba(255,255,255,.08);
        top:-70px;
        right:-60px;
    }

    .hero-preview::after{
        content:'';
        position:absolute;
        width:180px;
        height:180px;
        border-radius:999px;
        background:rgba(255,255,255,.05);
        bottom:-60px;
        left:-50px;
    }

    .hero-content{
        position:relative;
        z-index:2;
    }

    .hero-icon{
        width:90px;
        height:90px;
        border-radius:26px;
        background:rgba(255,255,255,.15);
        display:flex;
        align-items:center;
        justify-content:center;
        margin:auto auto 20px;
        backdrop-filter:blur(8px);
    }

    .hero-icon i{
        font-size:42px;
        color:white;
    }

    .hero-title{
        font-size:30px;
        font-weight:800;
        color:white;
        margin-bottom:10px;
    }

    .hero-subtitle{
        color:rgba(255,255,255,.78);
        font-size:14px;
        margin:0;
    }

    .type-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 18px;
        border-radius:999px;
        font-size:13px;
        font-weight:700;
    }

    .badge-visi{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .badge-misi{
        background:#dcfce7;
        color:#166534;
    }

    .tips-card{
        border:none;
        border-radius:24px;
        background:linear-gradient(
            135deg,
            #f0fdf4,
            #dcfce7
        );
        padding:24px;
    }

    .tips-title{
        font-size:16px;
        font-weight:800;
        color:#166534;
        margin-bottom:14px;
    }

    .tips-list{
        padding-left:18px;
        margin:0;
    }

    .tips-list li{
        color:#166534;
        margin-bottom:8px;
        line-height:1.6;
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

        .hero-preview{
            height:240px;
        }

        .hero-title{
            font-size:24px;
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

            {{ $visiMisi->type == 'visi'
                ? 'Edit Visi'
                : 'Edit Misi'
            }}

        </h1>

        <p class="page-subtitle">
            Update data visi & misi sekolah
        </p>

    </div>

</div>

<div class="modern-card">

    <div class="card-body-modern">

        <form action="{{ route('admin.visi-misi.update', $visiMisi->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    <div class="section-title">
                        Konten {{ ucfirst($visiMisi->type) }}
                    </div>

                    {{-- TYPE --}}
                    <div class="mb-4">

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

                    </div>

                    {{-- TEXTAREA --}}
                    <div>

                        <label class="form-label">

                            {{ $visiMisi->type == 'visi'
                                ? 'Konten Visi'
                                : 'Poin Misi'
                            }}

                        </label>

                        @if($visiMisi->type == 'visi')

                            <textarea
                                name="visi"
                                class="form-control @error('visi') is-invalid @enderror"
                                placeholder="Tulis visi sekolah disini...">{{ old('visi', $visiMisi->visi) }}</textarea>

                            @error('visi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        @else

                            <textarea
                                name="misi"
                                class="form-control @error('misi') is-invalid @enderror"
                                placeholder="Tulis poin misi disini...">{{ old('misi', $visiMisi->misi) }}</textarea>

                            @error('misi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        @endif

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- PREVIEW --}}
                    <div class="modern-card mb-4">

                        <div class="card-body-modern">

                            <div class="section-title">
                                Preview
                            </div>

                            <div class="hero-preview {{ $visiMisi->type == 'visi' ? 'hero-visi' : 'hero-misi' }}">

                                <div class="hero-content">

                                    <div class="hero-icon">

                                        @if($visiMisi->type == 'visi')

                                            <i class="fas fa-bullseye"></i>

                                        @else

                                            <i class="fas fa-tasks"></i>

                                        @endif

                                    </div>

                                    <h3 class="hero-title">

                                        {{ $visiMisi->type == 'visi'
                                            ? 'Visi Sekolah'
                                            : 'Misi Sekolah'
                                        }}

                                    </h3>

                                    <p class="hero-subtitle">

                                        {{ $visiMisi->type == 'visi'
                                            ? 'Tujuan besar & arah masa depan sekolah'
                                            : 'Langkah dan komitmen sekolah'
                                        }}

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

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
                                    Dibuat
                                </div>

                                <div class="info-value">
                                    {{ $visiMisi->created_at->format('d M Y H:i') }}
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

                    {{-- TIPS --}}
                    <div class="tips-card">

                        <div class="tips-title">
                            Tips Penulisan
                        </div>

                        <ul class="tips-list">

                            @if($visiMisi->type == 'visi')

                                <li>Gunakan kalimat yang singkat dan jelas</li>

                                <li>Visi menggambarkan tujuan jangka panjang sekolah</li>

                                <li>Buat visi yang inspiratif dan mudah dipahami</li>

                            @else

                                <li>Gunakan bahasa yang spesifik dan jelas</li>

                                <li>Pastikan misi mendukung visi sekolah</li>

                                <li>Gunakan kalimat yang mudah dipahami</li>

                            @endif

                        </ul>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="border-top pt-4 mt-4 d-flex gap-3">

                <a href="{{ route('admin.visi-misi.index') }}"
                   class="btn btn-back">

                    Batal

                </a>

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save me-2"></i>
                    Update {{ ucfirst($visiMisi->type) }}

                </button>

            </div>

        </form>

    </div>

</div>

@endsection