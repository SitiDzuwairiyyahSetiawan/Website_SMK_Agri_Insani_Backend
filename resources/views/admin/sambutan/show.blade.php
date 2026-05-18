@extends('admin.layouts.app')

@section('title', 'Detail Sambutan')

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

    .sambutan-image{
        width:100%;
        max-height:420px;
        height:auto;
        object-fit:contain;
        background:#f3f4f6;
        padding:10px;
        border-radius:24px;
        display:block;
        margin:0 auto;
    }

    .empty-image{
        width:100%;
        height:420px;
        border-radius:24px;
        border:2px dashed #d1d5db;
        background:#f9fafb;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
    }

    .empty-image i{
        font-size:70px;
        color:#9ca3af;
        margin-bottom:18px;
    }

    .empty-image h5{
        font-weight:700;
        color:#6b7280;
    }

    .jabatan-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 18px;
        border-radius:999px;
        background:#dcfce7;
        color:#166534;
        font-size:13px;
        font-weight:700;
        margin-bottom:18px;
    }

    .sambutan-title{
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

        .sambutan-title{
            font-size:28px;
        }

        .sambutan-image,
        .empty-image{
            height:280px;
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
            Detail Sambutan
        </h1>

        <p class="page-subtitle">
            Informasi lengkap sambutan kepala sekolah
        </p>

    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="{{ route('admin.sambutan.index') }}"
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

                {{-- IMAGE --}}
                <div class="mb-4">

                    @if($sambutan->foto)

                        <img src="{{ asset('storage/' . $sambutan->foto) }}"
                             alt="{{ $sambutan->nama_kepala_sekolah }}"
                             class="sambutan-image">

                    @else

                        <div class="empty-image">

                            <div>

                                <i class="fas fa-user-tie"></i>

                                <h5>
                                    Belum Ada Foto
                                </h5>

                            </div>

                        </div>

                    @endif

                </div>

                {{-- CONTENT --}}
                <div>

                    <div class="jabatan-badge">

                        <i class="fas fa-user-tie"></i>
                        {{ $sambutan->jabatan }}

                    </div>

                    <h1 class="sambutan-title">
                        {{ $sambutan->nama_kepala_sekolah }}
                    </h1>

                    <div class="meta-wrapper mb-5">

                        <div class="meta-chip">

                            <i class="fas fa-calendar-alt"></i>
                            {{ $sambutan->created_at->format('d M Y') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-clock"></i>
                            {{ $sambutan->created_at->format('H:i') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-user"></i>
                            Kepala Sekolah

                        </div>

                    </div>

                    <div class="section-title">
                        Pesan Sambutan
                    </div>

                    <div class="description-box">

                        {!! nl2br(e($sambutan->pesan ?? 'Belum ada pesan sambutan.')) !!}

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
                    Informasi Sambutan
                </div>

                <div class="info-item">

                    <div class="info-label">
                        ID Sambutan
                    </div>

                    <div class="info-value">
                        {{ $sambutan->id }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Nama Kepala Sekolah
                    </div>

                    <div class="info-value">
                        {{ $sambutan->nama_kepala_sekolah }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Jabatan
                    </div>

                    <div class="info-value">
                        {{ $sambutan->jabatan }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tanggal Dibuat
                    </div>

                    <div class="info-value">
                        {{ $sambutan->created_at->format('d/m/Y H:i') }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Terakhir Update
                    </div>

                    <div class="info-value">
                        {{ $sambutan->updated_at->diffForHumans() }}
                    </div>

                </div>

            </div>

        </div>

        {{-- LINK FOTO --}}
        <div class="modern-card">

            <div class="card-body-modern">

                <div class="section-title">
                    Link Foto
                </div>

                <div class="copy-group">

                    <input type="text"
                           id="imageUrl"
                           class="form-control copy-input"
                           value="{{ $sambutan->foto ? asset('storage/' . $sambutan->foto) : '-' }}"
                           readonly>

                    <button type="button"
                            onclick="copyToClipboard()"
                            class="copy-btn">

                        <i class="fas fa-copy"></i>

                    </button>

                </div>

                <small class="text-muted d-block mt-3">
                    Klik tombol copy untuk menyalin link foto kepala sekolah.
                </small>

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
                    Hapus Sambutan?
                </h3>

                <p class="text-muted mb-4">
                    Sambutan akan dihapus permanen dari sistem.
                </p>

                <div class="alert alert-danger rounded-4 mb-4">

                    <strong>
                        {{ $sambutan->nama_kepala_sekolah }}
                    </strong>

                </div>

                <div class="d-flex justify-content-center gap-3">

                    <button type="button"
                            class="btn btn-back"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <form action="{{ route('admin.sambutan.destroy', $sambutan->id) }}"
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
    const copyText = document.getElementById('imageUrl');

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copyText.value);

    alert('Link foto berhasil disalin!');
}

</script>

@endpush

@endsection