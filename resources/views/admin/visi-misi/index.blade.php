@extends('admin.layouts.app')

@section('title', 'Manajemen Visi & Misi')

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

    /* BUTTON */
    .btn-add{
        display:inline-flex !important;
        align-items:center;
        justify-content:center;
        gap:10px;
        padding:14px 26px !important;
        border-radius:18px !important;
        color:#fff !important;
        text-decoration:none !important;
        font-size:15px;
        font-weight:700;
        border:none !important;
        outline:none !important;
        transition:.25s ease;
    }

    .btn-add:hover{
        transform:translateY(-3px);
        color:#fff !important;
    }

    .btn-visi{
        background:linear-gradient(135deg,#166534,#14532d) !important;
        box-shadow:
            0 10px 25px rgba(20,83,45,.22),
            inset 0 1px 0 rgba(255,255,255,.08);
    }

    .btn-misi{
        background:linear-gradient(135deg,#22c55e,#15803d) !important;
        box-shadow:
            0 10px 25px rgba(34,197,94,.22),
            inset 0 1px 0 rgba(255,255,255,.08);
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

    /* TYPE BADGE */
    .badge-visi{
        background:#e8f0ff;
        color:#2563eb;
        padding:10px 16px;
        border-radius:999px;
        font-size:13px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    .badge-misi{
        background:#ecfdf3;
        color:#16a34a;
        padding:10px 16px;
        border-radius:999px;
        font-size:13px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    /* ID */
    .badge-id{
        background:transparent;
        color:#14532d;
        width:auto;
        height:auto;
        border-radius:0;
        display:block;
        font-size:15px;
        font-weight:700;
        padding:0;
    }

    /* CONTENT */
    .content-title{
        font-weight:700;
        color:#111827;
        line-height:1.6;
    }

    .content-sub{
        color:#9ca3af;
        font-size:13px;
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

    /* PAGINATION */
    .pagination-wrap{
        padding:24px;
        border-top:1px solid #eef2f7;
    }

    /* DELETE MODAL */
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
            Manajemen Visi & Misi
        </h1>

        <p class="page-subtitle">
            Kelola semua visi dan misi sekolah
        </p>

    </div>

    <div class="d-flex flex-wrap gap-3">

        <a href="{{ route('admin.visi-misi.create', 'visi') }}"
           class="btn-add btn-visi">

            <i class="fas fa-bullseye"></i>
            <span>Tambah Visi</span>

        </a>

        <a href="{{ route('admin.visi-misi.create', 'misi') }}"
           class="btn-add btn-misi">

            <i class="fas fa-tasks"></i>
            <span>Tambah Misi</span>

        </a>

    </div>

</div>

{{-- STATISTIK --}}
<div class="row mb-4">

    <div class="col-lg-4 mb-3">

        <div class="modern-card stat-card stat-green">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">
                            Total Visi
                        </div>

                        <div class="stat-value">
                            {{ $totalVisi ?? 0 }}
                        </div>

                        <div class="stat-desc">
                            Semua data visi
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-bullseye"></i>
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

                        <div class="stat-label">
                            Total Misi
                        </div>

                        <div class="stat-value">
                            {{ $totalMisi ?? 0 }}
                        </div>

                        <div class="stat-desc">
                            Semua data misi
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
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

                        <div class="stat-label">
                            Total Data
                        </div>

                        <div class="stat-value">
                            {{ $visimisis->count() }}
                        </div>

                        <div class="stat-desc">
                            Semua visi & misi
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- FILTER --}}
<div class="modern-card filter-card mb-4">

    <div class="card-body p-3">

        <form action="{{ route('admin.visi-misi.index') }}"
              method="GET">

            <div class="row g-3 align-items-center">

                <div class="col-lg-10">

                    <input type="text"
                           name="search"
                           class="form-control search-input"
                           placeholder="Cari visi atau misi..."
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
                    <th>Tipe</th>
                    <th>Konten</th>
                    <th>Dibuat</th>
                    <th class="text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($visimisis as $item)

                <tr>

                    <td>

                        <div class="badge-id">
                            {{ $item->id }}
                        </div>

                    </td>

                    <td>

                        @if($item->type == 'visi')

                            <span class="badge-visi">
                                <i class="fas fa-bullseye"></i>
                                Visi
                            </span>

                        @else

                            <span class="badge-misi">
                                <i class="fas fa-tasks"></i>
                                Misi
                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="content-title mb-1">

                            {{ Str::limit(strip_tags($item->type == 'visi' ? $item->visi : $item->misi), 100) }}

                        </div>

                        <div class="content-sub">
                            Data {{ ucfirst($item->type) }}
                        </div>

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

                            <a href="{{ route('admin.visi-misi.show', $item->id) }}"
                               class="action-btn btn-view">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="{{ route('admin.visi-misi.edit', $item->id) }}"
                               class="action-btn btn-edit">

                                <i class="fas fa-pen"></i>

                            </a>

                            <button type="button"
                                    class="action-btn btn-delete"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                {{-- DELETE MODAL --}}
                <div class="modal fade delete-modal"
                     id="deleteModal{{ $item->id }}"
                     tabindex="-1"
                     aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-body">

                                <div class="delete-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </div>

                                <h3 class="delete-title">
                                    Hapus Data?
                                </h3>

                                <p class="delete-text">

                                    Data

                                    <strong>
                                        {{ Str::limit(strip_tags($item->type == 'visi' ? $item->visi : $item->misi), 60) }}
                                    </strong>

                                    akan dihapus permanen dan tidak dapat dikembalikan lagi.

                                </p>

                                <div class="d-flex justify-content-center gap-3 flex-wrap">

                                    <button type="button"
                                            class="btn-cancel"
                                            data-bs-dismiss="modal">

                                        Batal

                                    </button>

                                    <form action="{{ route('admin.visi-misi.destroy', $item->id) }}"
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

                    <td colspan="5">

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>

                            <h4 class="fw-bold text-muted mb-2">
                                Belum Ada Data Visi & Misi
                            </h4>

                            <p class="text-muted mb-0">
                                Tambahkan visi atau misi pertama sekolah.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    @if($visimisis->hasPages())

    <div class="pagination-wrap d-flex flex-column flex-md-row justify-content-between align-items-center">

        <div class="text-muted small mb-3 mb-md-0">

            Menampilkan
            {{ $visimisis->firstItem() ?? 0 }}
            -
            {{ $visimisis->lastItem() ?? 0 }}

            dari

            {{ $visimisis->total() ?? 0 }}
            data

        </div>

        <div>
            {{ $visimisis->appends(request()->query())->links() }}
        </div>

    </div>

    @endif

</div>

@endsection