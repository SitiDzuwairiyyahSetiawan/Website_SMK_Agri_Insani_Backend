@extends('admin.layouts.app')

@section('title', 'Manajemen Berita')

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
        font-size:40px;
        font-weight:800;
        color:var(--green-900);
        margin-bottom:8px;
        line-height:1.1;
    }

    .page-subtitle{
        color:#6b7280;
        margin:0;
        font-size:16px;
        font-weight:500;
    }

    /* BUTTON TAMBAH */
    .btn-add{
        display:inline-flex !important;
        align-items:center;
        justify-content:center;
        gap:10px;
        padding:14px 26px !important;
        border-radius:18px !important;
        background:linear-gradient(135deg,#166534,#14532d) !important;
        color:#fff !important;
        text-decoration:none !important;
        font-size:15px;
        font-weight:700;
        border:none !important;
        outline:none !important;
        box-shadow:
            0 10px 25px rgba(20,83,45,.22),
            inset 0 1px 0 rgba(255,255,255,.08);
        transition:.25s ease;
    }

    .btn-add:hover{
        transform:translateY(-3px);
        color:#fff !important;
        box-shadow:
            0 16px 30px rgba(20,83,45,.28),
            inset 0 1px 0 rgba(255,255,255,.1);
    }

    /* CARD */
    .modern-card{
        border:none;
        border-radius:28px;
        overflow:hidden;
        background:white;
        box-shadow:
            0 10px 30px rgba(0,0,0,.05),
            0 2px 10px rgba(0,0,0,.03);
    }

    /* STAT CARD */
    .stat-card{
        position:relative;
        overflow:hidden;
        transition:.3s ease;
        min-height:160px;
    }

    .stat-card:hover{
        transform:translateY(-4px);
    }

    .stat-card::before{
        content:'';
        position:absolute;
        right:-30px;
        bottom:-30px;
        width:180px;
        height:180px;
        background:rgba(255,255,255,.08);
        border-radius:50%;
    }

    .stat-card::after{
        content:'';
        position:absolute;
        right:40px;
        bottom:-50px;
        width:120px;
        height:120px;
        background:rgba(255,255,255,.06);
        border-radius:50%;
    }

    .stat-green{
        background:linear-gradient(135deg,#0f3b1d,#14532d);
    }

    .stat-light{
        background:linear-gradient(135deg,#34c759,#22c55e);
    }

    .stat-dark{
        background:linear-gradient(135deg,#374151,#1f2937);
    }

    .stat-icon{
        width:82px;
        height:82px;
        border-radius:24px;
        background:rgba(255,255,255,.15);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:34px;
        color:white;
        box-shadow:0 10px 25px rgba(0,0,0,.12);
        backdrop-filter:blur(8px);
    }

    .stat-label{
        color:rgba(255,255,255,.75);
        font-size:15px;
        margin-bottom:10px;
        font-weight:500;
    }

    .stat-value{
        font-size:48px;
        font-weight:800;
        line-height:1;
        margin-bottom:8px;
        color:white;
    }

    .stat-desc{
        color:rgba(255,255,255,.80);
        font-size:14px;
        font-weight:500;
    }

    /* FILTER */
    .filter-card{
        padding:12px;
    }

    .search-input{
        height:62px;
        border-radius:20px !important;
        border:1px solid #e5e7eb !important;
        background:#f9fafb !important;
        padding:0 22px !important;
        font-size:15px;
        font-weight:500;
        transition:.2s ease;
    }

    .search-input:focus{
        background:white !important;
        border-color:#cbd5e1 !important;
        box-shadow:0 0 0 4px rgba(46,125,65,.08) !important;
    }

    /* BUTTON FILTER */
    .btn-filter{
        width:100%;
        height:62px;
        display:flex !important;
        align-items:center;
        justify-content:center;
        gap:10px;
        border:none !important;
        border-radius:20px !important;
        background:linear-gradient(135deg,#22c55e,#15803d) !important;
        color:#fff !important;
        font-size:15px;
        font-weight:700;
        box-shadow:
            0 10px 24px rgba(34,197,94,.20),
            inset 0 1px 0 rgba(255,255,255,.08);
        transition:.25s ease;
    }

    .btn-filter:hover{
        transform:translateY(-2px);
        box-shadow:
            0 16px 28px rgba(34,197,94,.28),
            inset 0 1px 0 rgba(255,255,255,.1);
    }

    /* TABLE */
    .table-modern{
        margin:0;
    }

    .table-modern thead th{
        background:#f4f7f2;
        color:#1f4d2f;
        border:none;
        padding:22px 18px;
        font-size:14px;
        font-weight:800;
        white-space:nowrap;
    }

    .table-modern tbody td{
        padding:18px;
        vertical-align:middle;
        border-color:#eef2f7;
    }

    .table-modern tbody tr{
        transition:.2s ease;
    }

    .table-modern tbody tr:hover{
        background:#fbfffc;
    }

    /* IMAGE */
    .berita-img{
        width:96px;
        height:66px;
        object-fit:cover;
        border-radius:16px;
        box-shadow:0 8px 18px rgba(0,0,0,.08);
    }

    .empty-img{
        width:96px;
        height:66px;
        border-radius:16px;
        background:#f3f4f6;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#9ca3af;
    }

    /* BADGE */
    .badge-publish{
        background:#ecfdf3;
        color:#16a34a;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    .badge-publish::before{
        content:'';
        width:8px;
        height:8px;
        border-radius:50%;
        background:#16a34a;
    }

    .badge-draft{
        background:#f3f4f6;
        color:#6b7280;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    .badge-draft::before{
        content:'';
        width:8px;
        height:8px;
        border-radius:50%;
        background:#9ca3af;
    }

    /* ACTION */
    .action-group{
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
    }

    .action-btn{
        width:44px;
        height:44px;
        border:none;
        border-radius:14px;
        display:flex;
        align-items:center;
        justify-content:center;
        transition:.25s ease;
        text-decoration:none;
    }

    .action-btn:hover{
        transform:translateY(-3px);
    }

    .btn-view{
        background:#e8f0ff;
        color:#2563eb;
    }

    .btn-edit{
        background:#fff4db;
        color:#d97706;
    }

    .btn-delete{
        background:#ffe7e7;
        color:#dc2626;
    }

    /* EMPTY */
    .empty-state{
        padding:80px 20px;
        text-align:center;
    }

    .empty-icon{
        width:120px;
        height:120px;
        border-radius:36px;
        background:#f3f4f6;
        display:flex;
        align-items:center;
        justify-content:center;
        margin:auto auto 24px;
    }

    .empty-icon i{
        font-size:50px;
        color:#9ca3af;
    }

    /* MODAL */
    .delete-modal .modal-content{
        border:none;
        border-radius:30px;
        overflow:hidden;
    }

    .delete-modal .modal-body{
        padding:40px 30px;
        text-align:center;
    }

    .delete-icon{
        width:95px;
        height:95px;
        border-radius:30px;
        margin:auto auto 24px;
        background:linear-gradient(135deg,#fee2e2,#fecaca);
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .delete-icon i{
        font-size:42px;
        color:#dc2626;
    }

    .delete-title{
        font-size:28px;
        font-weight:800;
        color:#111827;
        margin-bottom:12px;
    }

    .delete-text{
        color:#6b7280;
        font-size:15px;
        line-height:1.7;
        margin-bottom:30px;
    }

    .btn-cancel{
        height:54px;
        border:none;
        border-radius:18px;
        background:#f3f4f6;
        color:#374151;
        font-weight:700;
        padding:0 24px;
    }

    .btn-confirm-delete{
        height:54px;
        border:none;
        border-radius:18px;
        background:linear-gradient(135deg,#dc2626,#b91c1c);
        color:white;
        font-weight:700;
        padding:0 26px;
        box-shadow:0 10px 24px rgba(220,38,38,.22);
    }

    .btn-confirm-delete:hover{
        color:white;
    }

    @media(max-width:768px){

        .page-title{
            font-size:30px;
        }

        .table-modern thead{
            display:none;
        }

        .table-modern,
        .table-modern tbody,
        .table-modern tr,
        .table-modern td{
            display:block;
            width:100%;
        }

        .table-modern tr{
            padding:18px;
            border-bottom:1px solid #f1f5f9;
        }

        .table-modern td{
            border:none;
            padding:10px 0;
        }

        .action-group{
            justify-content:flex-start;
        }
    }
</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Manajemen Berita
        </h1>

        <p class="page-subtitle">
            Kelola semua berita dan informasi terbaru sekolah
        </p>

    </div>

    <a href="{{ route('admin.berita.create') }}"
       class="btn-add">

        <i class="fas fa-plus"></i>
        <span>Tambah Berita</span>

    </a>

</div>

{{-- STATISTIK --}}
<div class="row mb-4">

    <div class="col-lg-4 mb-3">

        <div class="modern-card stat-card stat-green">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">Total Berita</div>

                        <div class="stat-value">
                            {{ $totalBerita ?? 0 }}
                        </div>

                        <div class="stat-desc">Semua berita</div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4 mb-3">

        <div class="modern-card stat-card stat-light">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">Published</div>

                        <div class="stat-value">
                            {{ $publishedCount ?? 0 }}
                        </div>

                        <div class="stat-desc">Sudah dipublish</div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4 mb-3">

        <div class="modern-card stat-card stat-dark">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">Draft</div>

                        <div class="stat-value">
                            {{ $draftCount ?? 0 }}
                        </div>

                        <div class="stat-desc">Belum dipublish</div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-pencil-alt"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- FILTER --}}
<div class="modern-card filter-card mb-4">

    <div class="card-body p-3">

        <form action="{{ route('admin.berita.index') }}"
              method="GET">

            <div class="row g-3 align-items-center">

                <div class="col-lg-10">

                    <input type="text"
                           name="search"
                           class="form-control search-input"
                           placeholder="Cari berita..."
                           value="{{ request('search') }}">

                </div>

                <div class="col-lg-2">

                    <button type="submit"
                            class="btn-filter">

                        <i class="fas fa-filter"></i>
                        <span>Filter Data</span>

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

{{-- TABLE --}}
<div class="modern-card">

    <div class="table-responsive">

        <table class="table table-modern align-middle">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Berita</th>
                    <th>Gambar</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th class="text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($beritas as $key => $item)

                <tr>

                    <td>
                        <span class="fw-bold text-dark">
                            {{ $beritas->firstItem() + $key }}
                        </span>
                    </td>

                    <td>

                        <div class="fw-bold text-dark fs-6 mb-1">
                            {{ \Illuminate\Support\Str::limit($item->judul, 45) }}
                        </div>

                        <small class="text-muted">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 60) }}
                        </small>

                    </td>

                    <td>

                        @if($item->gambar)

                            <img src="{{ asset('storage/'.$item->gambar) }}"
                                 class="berita-img">

                        @else

                            <div class="empty-img">
                                <i class="fas fa-image"></i>
                            </div>

                        @endif

                    </td>

                    <td>

                        <div class="fw-semibold text-dark">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </div>

                    </td>

                    <td>

                        @if($item->is_published)

                            <span class="badge-publish">
                                Published
                            </span>

                        @else

                            <span class="badge-draft">
                                Draft
                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="fw-semibold text-dark">
                            {{ $item->created_at->format('d M Y') }}
                        </div>

                        <small class="text-muted">
                            {{ $item->created_at->format('H:i') }}
                        </small>

                    </td>

                    <td>

                        <div class="action-group">

                            <a href="{{ route('admin.berita.show', $item->slug) }}"
                               class="action-btn btn-view">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="{{ route('admin.berita.edit', $item->slug) }}"
                               class="action-btn btn-edit">

                                <i class="fas fa-pen"></i>

                            </a>

                            <button type="button"
                                    class="action-btn btn-delete"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->slug }}">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                {{-- DELETE MODAL --}}
                <div class="modal fade delete-modal"
                     id="deleteModal{{ $item->slug }}"
                     tabindex="-1"
                     aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-body">

                                <div class="delete-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </div>

                                <h3 class="delete-title">
                                    Hapus Berita?
                                </h3>

                                <p class="delete-text">
                                    Berita
                                    <strong>{{ $item->judul }}</strong>
                                    akan dihapus permanen dan tidak dapat dikembalikan lagi.
                                </p>

                                <div class="d-flex justify-content-center gap-3 flex-wrap">

                                    <button type="button"
                                            class="btn-cancel"
                                            data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form action="{{ route('admin.berita.destroy', $item->slug) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn-confirm-delete">

                                            Ya, Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                @empty

                <tr>

                    <td colspan="7">

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="fas fa-newspaper"></i>
                            </div>

                            <h4 class="fw-bold text-muted mb-2">
                                Belum Ada Berita
                            </h4>

                            <p class="text-muted mb-0">
                                Tambahkan berita pertama untuk website sekolah.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    @if($beritas->hasPages())

    <div class="p-4 border-top d-flex justify-content-between align-items-center flex-wrap gap-3">

        <small class="text-muted">
            Menampilkan {{ $beritas->firstItem() }} - {{ $beritas->lastItem() }}
        </small>

        {{ $beritas->links() }}

    </div>

    @endif

</div>

@endsection