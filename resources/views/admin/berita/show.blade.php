@extends('admin.layouts.app')

@section('title', $berita->judul)

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

    .berita-image{
        width:100%;
        max-height:420px;
        height:auto;
        object-fit:contain;
        background:#f3f4f6;
        padding:10px;
        border-radius:24px;
        display:block;
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

    .slug-badge{
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
        word-break:break-all;
    }

    .berita-title{
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

    .status-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 16px;
        border-radius:999px;
        font-size:13px;
        font-weight:700;
    }

    .status-publish{
        background:#dcfce7;
        color:#166534;
    }

    .status-draft{
        background:#f3f4f6;
        color:#6b7280;
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

    .btn-back:hover{
        background:#e5e7eb !important;
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

        .berita-title{
            font-size:28px;
        }

        .berita-image,
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
            Detail Berita
        </h1>

        <p class="page-subtitle">
            Informasi lengkap berita website sekolah
        </p>

    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="{{ route('admin.berita.index') }}"
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

                    @if($berita->gambar)

                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                             alt="{{ $berita->judul }}"
                             class="berita-image">

                    @else

                        <div class="empty-image">

                            <div>

                                <i class="fas fa-image"></i>

                                <h5>
                                    Belum Ada Gambar
                                </h5>

                            </div>

                        </div>

                    @endif

                </div>

                {{-- CONTENT --}}
                <div>

                    <div class="slug-badge">

                        <i class="fas fa-link"></i>
                        {{ $berita->slug }}

                    </div>

                    <h1 class="berita-title">
                        {{ $berita->judul }}
                    </h1>

                    <div class="meta-wrapper mb-5">

                        <div class="meta-chip">

                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-clock"></i>
                            {{ $berita->created_at->format('H:i') }}

                        </div>

                    </div>

                    <div class="section-title">
                        Konten Berita
                    </div>

                    <div class="content-box">

                        {!! nl2br(e($berita->konten ?? 'Tidak ada konten berita.')) !!}

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
                    Informasi Berita
                </div>

                <div class="info-item">

                    <div class="info-label">
                        ID Berita
                    </div>

                    <div class="info-value">
                        {{ $berita->id }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Status Berita
                    </div>

                    <div class="info-value">

                        @if($berita->is_published)

                            <div class="status-badge status-publish">

                                <i class="fas fa-check-circle"></i>
                                Published

                            </div>

                        @else

                            <div class="status-badge status-draft">

                                <i class="fas fa-clock"></i>
                                Draft

                            </div>

                        @endif

                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tanggal Berita
                    </div>

                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($berita->tanggal)->format('d/m/Y') }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tanggal Dibuat
                    </div>

                    <div class="info-value">
                        {{ $berita->created_at->format('d/m/Y H:i') }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Terakhir Update
                    </div>

                    <div class="info-value">
                        {{ $berita->updated_at->diffForHumans() }}
                    </div>

                </div>

            </div>

        </div>

        {{-- LINK --}}
        <div class="modern-card">

            <div class="card-body-modern">

                <div class="section-title">
                    Link Publikasi
                </div>

                <div class="copy-group">

                    <input type="text"
                           id="publicUrl"
                           class="form-control copy-input"
                           value="{{ url('/berita/' . $berita->slug) }}"
                           readonly>

                    <button type="button"
                            onclick="copyToClipboard()"
                            class="copy-btn">

                        <i class="fas fa-copy"></i>

                    </button>

                </div>

                <small class="text-muted d-block mt-3">
                    Klik tombol copy untuk menyalin link berita.
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
                    Hapus Berita?
                </h3>

                <p class="text-muted mb-4">
                    Berita akan dihapus permanen dari sistem.
                </p>

                <div class="alert alert-danger rounded-4 mb-4">

                    <strong>
                        {{ $berita->judul }}
                    </strong>

                </div>

                <div class="d-flex justify-content-center gap-3">

                    <button type="button"
                            class="btn btn-back"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <form action="{{ route('admin.berita.destroy', $berita->slug) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger rounded-4 px-4">

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
    const copyText = document.getElementById('publicUrl');

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    navigator.clipboard.writeText(copyText.value);

    alert('Link berita berhasil disalin!');
}

</script>

@endpush

@endsection