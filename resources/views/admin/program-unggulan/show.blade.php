@extends('admin.layouts.app')

@section('title', 'Detail Program Unggulan')

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

    .program-preview{
        width:100%;
        height:420px;
        border-radius:24px;
        background:linear-gradient(
            135deg,
            #f0fdf4,
            #dcfce7
        );
        border:2px solid #dcfce7;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        text-align:center;
        padding:40px;
    }

    .program-icon{
        font-size:110px;
        line-height:1;
        margin-bottom:24px;
    }

    .program-label{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 18px;
        border-radius:999px;
        background:white;
        color:#166534;
        font-size:13px;
        font-weight:700;
        margin-bottom:20px;
        box-shadow:0 6px 18px rgba(0,0,0,.05);
    }

    .program-title{
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

    .description-box{
        line-height:2;
        color:#4b5563;
        font-size:15px;
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

    .icon-box{
        width:72px;
        height:72px;
        border-radius:22px;
        background:#dcfce7;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:38px;
    }

    .copy-group{
        display:flex;
        overflow:hidden;
        border-radius:18px;
        border:1px solid #e5e7eb;
        background:#f9fafb;
    }

    .copy-input{
        flex:1;
        border:none !important;
        background:transparent !important;
        padding:16px !important;
        font-size:14px;
        box-shadow:none !important;
    }

    .copy-btn{
        width:60px;
        border:none;
        background:linear-gradient(
            135deg,
            #166534,
            #15803d
        );
        color:white;
        font-size:18px;
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

    .modal-modern{
        border:none;
        border-radius:28px;
        overflow:hidden;
    }

    @media(max-width:768px){

        .page-title{
            font-size:30px;
        }

        .program-title{
            font-size:28px;
        }

        .program-preview{
            height:auto;
            min-height:320px;
        }

        .program-icon{
            font-size:80px;
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
            Detail Program Unggulan
        </h1>

        <p class="page-subtitle">
            Informasi lengkap program unggulan sekolah
        </p>

    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="{{ route('admin.program-unggulan.index') }}"
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

                {{-- CONTENT --}}
                <div>

                    <h1 class="program-title">
                        {{ $programUnggulan->nama_program_unggulan }}
                    </h1>

                    <div class="meta-wrapper mb-5">

                        <div class="meta-chip">

                            <i class="fas fa-calendar-alt"></i>
                            {{ $programUnggulan->created_at->format('d M Y') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-clock"></i>
                            {{ $programUnggulan->created_at->format('H:i') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-layer-group"></i>
                            Program Sekolah

                        </div>

                    </div>

                    <div class="section-title">
                        Deskripsi Program
                    </div>

                    <div class="description-box">

                        {!! nl2br(e($programUnggulan->deskripsi ?? 'Tidak ada deskripsi program unggulan.')) !!}

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
                    Informasi Program
                </div>

                <div class="info-item">

                    <div class="info-label">
                        ID Program
                    </div>

                    <div class="info-value">
                        {{ $programUnggulan->id }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Ikon Program
                    </div>

                    <div class="info-value">

                        <div class="icon-box">
                            {{ $programUnggulan->ikon }}
                        </div>

                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tanggal Dibuat
                    </div>

                    <div class="info-value">
                        {{ $programUnggulan->created_at->format('d/m/Y H:i') }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Terakhir Update
                    </div>

                    <div class="info-value">
                        {{ $programUnggulan->updated_at->diffForHumans() }}
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
                    Hapus Program?
                </h3>

                <p class="text-muted mb-4">
                    Program unggulan akan dihapus permanen dari sistem.
                </p>

                <div class="alert alert-danger rounded-4 mb-4">

                    <strong>
                        {{ $programUnggulan->nama_program_unggulan }}
                    </strong>

                </div>

                <div class="d-flex justify-content-center gap-3">

                    <button type="button"
                            class="btn btn-back"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <form action="{{ route('admin.program-unggulan.destroy', $programUnggulan->id) }}"
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

@push('scripts')

<script>

function confirmDelete()
{
    const modal = new bootstrap.Modal(
        document.getElementById('deleteModal')
    );

    modal.show();
}

function copyToClipboard()
{
    const copyText = document.getElementById('iconValue');

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copyText.value);

    alert('Ikon berhasil disalin!');
}

</script>

@endpush

@endsection