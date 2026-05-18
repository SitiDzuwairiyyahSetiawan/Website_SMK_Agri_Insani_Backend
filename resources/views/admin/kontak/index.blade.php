@extends('admin.layouts.app')

@section('title', 'Manajemen Kontak')

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
    .btn-export{
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

    .btn-export:hover{
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

    .stat-primary{
        background:linear-gradient(135deg,#2563eb,#1d4ed8);
    }

    .stat-warning{
        background:linear-gradient(135deg,#f59e0b,#d97706);
    }

    .stat-info{
        background:linear-gradient(135deg,#06b6d4,#0891b2);
    }

    .stat-success{
        background:linear-gradient(135deg,#16a34a,#15803d);
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

    /* BADGE */
    .badge-pending{
        background:#fef3c7;
        color:#b45309;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    .badge-pending::before{
        content:'';
        width:8px;
        height:8px;
        border-radius:50%;
        background:#f59e0b;
    }

    .badge-read{
        background:#dbeafe;
        color:#2563eb;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    .badge-read::before{
        content:'';
        width:8px;
        height:8px;
        border-radius:50%;
        background:#2563eb;
    }

    .badge-replied{
        background:#dcfce7;
        color:#16a34a;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    .badge-replied::before{
        content:'';
        width:8px;
        height:8px;
        border-radius:50%;
        background:#16a34a;
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

    .btn-wa{
        background:#dcfce7;
        color:#16a34a;
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
/* =========================
   MODAL WHATSAPP
========================= */

#balasModal .modal-dialog{
    max-width:900px;
}

.wa-modal-content{
    border:none !important;
    border-radius:32px !important;
    overflow:hidden;
    background:white;
    box-shadow:
        0 30px 60px rgba(0,0,0,.16),
        0 10px 24px rgba(0,0,0,.08);
}

/* HEADER */
.wa-modal-header{
    border:none !important;
    padding:30px 34px !important;
    background:
        linear-gradient(135deg,#16a34a,#14532d);
    position:relative;
    overflow:hidden;
}

.wa-modal-header::before{
    content:'';
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    top:-100px;
    right:-60px;
}

.wa-modal-header::after{
    content:'';
    position:absolute;
    width:150px;
    height:150px;
    border-radius:50%;
    background:rgba(255,255,255,.05);
    bottom:-80px;
    right:90px;
}

.wa-header-content{
    display:flex;
    align-items:center;
    gap:18px;
    position:relative;
    z-index:2;
}

.wa-header-icon{
    width:70px;
    height:70px;
    border-radius:24px;
    background:rgba(255,255,255,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    backdrop-filter:blur(10px);
    color:white;
    font-size:30px;
    box-shadow:0 12px 24px rgba(0,0,0,.12);
}

.wa-modal-title{
    color:white;
    font-size:28px;
    font-weight:800;
    margin-bottom:4px;
}

.wa-modal-subtitle{
    color:rgba(255,255,255,.75);
    margin:0;
    font-size:14px;
    font-weight:500;
}

.wa-modal-header .btn-close{
    position:relative;
    z-index:2;
}

/* BODY */
.wa-modal-body{
    padding:34px !important;
    background:#fcfcfc;
}

/* USER BOX */
.wa-user-box{
    background:white;
    border-radius:28px;
    border:1px solid #eef2f7;
    padding:24px;
    box-shadow:0 8px 24px rgba(0,0,0,.04);
}

.wa-user-item{
    display:flex;
    align-items:flex-start;
    gap:16px;
    padding-bottom:18px;
    margin-bottom:18px;
    border-bottom:1px solid #f3f4f6;
}

.wa-user-item:last-child{
    margin-bottom:0;
    padding-bottom:0;
    border-bottom:none;
}

.wa-user-icon{
    width:52px;
    height:52px;
    border-radius:18px;
    background:#f0fdf4;
    color:#15803d;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    flex-shrink:0;
}

.wa-user-content{
    display:flex;
    flex-direction:column;
}

.wa-user-label{
    font-size:13px;
    color:#6b7280;
    margin-bottom:4px;
    font-weight:700;
}

.wa-user-value{
    font-size:16px;
    color:#111827;
    font-weight:800;
    line-height:1.6;
    word-break:break-word;
}

/* LABEL */
.wa-label{
    display:block;
    font-size:15px;
    font-weight:800;
    color:#14532d;
    margin-bottom:14px;
}

/* TEXTAREA */
textarea.form-control{
    height:auto !important;
}

.wa-textarea{
    display:block;
    width:100% !important;

    height:320px !important;
    min-height:320px !important;

    border-radius:24px !important;
    border:1px solid #e5e7eb !important;

    background:#fff !important;

    padding:24px !important;

    font-size:15px;
    line-height:1.9;

    resize:vertical !important;
    overflow-y:auto !important;

    transition:.25s ease;
    box-shadow:none !important;

    appearance:none;
    -webkit-appearance:none;
}

.wa-textarea:focus{
    border-color:#22c55e !important;

    box-shadow:
        0 0 0 5px rgba(34,197,94,.12) !important;
}

/* FOOTER */
.wa-modal-footer{
    border:none !important;
    padding:0 34px 34px !important;
    display:flex;
    gap:16px;
}

.btn-wa-cancel{
    flex:1;
    height:58px;
    border:none;
    border-radius:20px;
    background:#f3f4f6;
    color:#374151;
    font-size:15px;
    font-weight:700;
    transition:.2s ease;
}

.btn-wa-cancel:hover{
    background:#e5e7eb;
}

.btn-wa-send{
    flex:1;
    height:58px;
    border:none;
    border-radius:20px;
    background:linear-gradient(135deg,#22c55e,#15803d);
    color:white;
    font-size:15px;
    font-weight:800;
    box-shadow:
        0 12px 24px rgba(34,197,94,.22);
    transition:.25s ease;
}

.btn-wa-send:hover{
    transform:translateY(-2px);
    color:white;
    box-shadow:
        0 18px 30px rgba(34,197,94,.28);
}

/* MOBILE */
@media(max-width:768px){

    #balasModal .modal-dialog{
        margin:16px;
    }

    .wa-modal-header{
        padding:24px !important;
    }

    .wa-modal-body{
        padding:24px !important;
    }

    .wa-modal-footer{
        padding:0 24px 24px !important;
        flex-direction:column;
    }

    .btn-wa-cancel,
    .btn-wa-send{
        width:100%;
    }

    .wa-modal-title{
        font-size:22px;
    }

    .wa-header-icon{
        width:58px;
        height:58px;
        font-size:24px;
    }
}

</style>

{{-- HEADER --}}
<div class="page-header">

    <div>

        <h1 class="page-title">
            Manajemen Kontak
        </h1>

        <p class="page-subtitle">
            Kelola semua pesan dan pertanyaan pengunjung website
        </p>

    </div>

    <a href="{{ route('admin.kontak.export') }}"
       class="btn-export">

        <i class="fas fa-file-excel"></i>
        <span>Export Excel</span>

    </a>

</div>

{{-- STATISTIK --}}
<div class="row mb-4">

    <div class="col-lg-3 mb-3">

        <div class="modern-card stat-card stat-primary">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">Total Pesan</div>

                        <div class="stat-value">
                            {{ $statistik['total'] ?? 0 }}
                        </div>

                        <div class="stat-desc">Semua pesan</div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-envelope"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 mb-3">

        <div class="modern-card stat-card stat-warning">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">Pending</div>

                        <div class="stat-value">
                            {{ $statistik['pending'] ?? 0 }}
                        </div>

                        <div class="stat-desc">Belum dibaca</div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 mb-3">

        <div class="modern-card stat-card stat-info">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">Dibaca</div>

                        <div class="stat-value">
                            {{ $statistik['dibaca'] ?? 0 }}
                        </div>

                        <div class="stat-desc">Sudah dibaca</div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 mb-3">

        <div class="modern-card stat-card stat-success">

            <div class="card-body p-4 h-100">

                <div class="d-flex justify-content-between align-items-center h-100">

                    <div>

                        <div class="stat-label">Dibalas</div>

                        <div class="stat-value">
                            {{ $statistik['dibalas'] ?? 0 }}
                        </div>

                        <div class="stat-desc">Sudah dibalas</div>

                    </div>

                    <div class="stat-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- FILTER --}}
<div class="modern-card filter-card mb-4">

    <div class="card-body p-3">

        <form method="GET">

            <div class="row g-3 align-items-center">

                <div class="col-lg-10">

                    <input type="text"
                           name="search"
                           class="form-control search-input"
                           placeholder="Cari nama, nomor atau topik..."
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
                    <th>Nama</th>
                    <th>WhatsApp</th>
                    <th>Topik</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($kontaks as $item)

                <tr>

                    <td>
                        <span class="fw-bold text-dark">
                            {{ ($kontaks->currentPage() - 1) * $kontaks->perPage() + $loop->iteration }}
                        </span>
                    </td>

                    <td>

                        <div class="fw-bold text-dark fs-6 mb-1">
                            {{ $item->nama_lengkap }}
                        </div>

                    </td>

                    <td>

                        <a href="https://wa.me/{{ $item->no_telepon }}"
                           target="_blank"
                           class="text-success fw-semibold text-decoration-none">

                            <i class="fab fa-whatsapp me-1"></i>
                            {{ $item->no_telepon }}

                        </a>

                    </td>

                    <td>

                        <span class="fw-semibold text-dark">
                            {{ Str::limit($item->topik_pertanyaan, 35) }}
                        </span>

                    </td>

                    <td>

                        <small class="text-muted">
                            {{ Str::limit($item->pesan, 60) }}
                        </small>

                    </td>

                    <td>

                        @if($item->status == 'pending')

                            <span class="badge-pending">
                                Pending
                            </span>

                        @elseif($item->status == 'dibaca')

                            <span class="badge-read">
                                Dibaca
                            </span>

                        @else

                            <span class="badge-replied">
                                Dibalas
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

                            <a href="{{ route('admin.kontak.show', $item->id) }}"
                               class="action-btn btn-view">

                                <i class="fas fa-eye"></i>

                            </a>

                            <button type="button"
                                    class="action-btn btn-wa"
                                    onclick="openBalasModal(
                                        {{ $item->id }},
                                        {{ json_encode($item->nama_lengkap) }},
                                        {{ json_encode($item->no_telepon) }},
                                        {{ json_encode($item->topik_pertanyaan) }}
                                    )">

                                <i class="fab fa-whatsapp"></i>

                            </button>

                            <button type="button"
                                    class="action-btn btn-delete"
                                    onclick="confirmDelete(
                                        {{ $item->id }},
                                        {{ json_encode($item->nama_lengkap) }}
                                    )">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8">

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="fas fa-inbox"></i>
                            </div>

                            <h4 class="fw-bold text-muted mb-2">
                                Belum Ada Pesan
                            </h4>

                            <p class="text-muted mb-0">
                                Pesan dari pengunjung akan tampil di sini.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($kontaks->hasPages())

    <div class="p-4">
        {{ $kontaks->links() }}
    </div>

    @endif

</div>

{{-- MODAL HAPUS --}}
<div class="modal fade delete-modal"
     id="deleteModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">

                <div class="delete-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>

                <h3 class="delete-title">
                    Hapus Pesan?
                </h3>

                <p class="delete-text">
                    Pesan dari
                    <strong id="deleteNama"></strong>
                    akan dihapus permanen dan tidak dapat dikembalikan lagi.
                </p>

                <div class="d-flex justify-content-center gap-3 flex-wrap">

                    <button type="button"
                            class="btn-cancel"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="button"
                            class="btn-confirm-delete"
                            id="confirmDeleteBtn">

                        Ya, Hapus

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- MODAL BALAS WHATSAPP --}}
<div class="modal fade"
     id="balasModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content wa-modal-content">

            {{-- HEADER --}}
            <div class="modal-header wa-modal-header">

                <div class="wa-header-content">

                    <div class="wa-header-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>

                    <div>

                        <h5 class="wa-modal-title">
                            Balas WhatsApp
                        </h5>

                        <p class="wa-modal-subtitle">
                            Kirim balasan langsung ke pengunjung
                        </p>

                    </div>

                </div>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            {{-- BODY --}}
            <div class="modal-body wa-modal-body">

                {{-- INFO USER --}}
                <div class="wa-user-box">

                    <div class="wa-user-item">

                        <div class="wa-user-icon">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="wa-user-content">

                            <span class="wa-user-label">
                                Nama Pengirim
                            </span>

                            <span class="wa-user-value"
                                  id="modalNama"></span>

                        </div>

                    </div>

                    <div class="wa-user-item">

                        <div class="wa-user-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>

                        <div class="wa-user-content">

                            <span class="wa-user-label">
                                Nomor WhatsApp
                            </span>

                            <span class="wa-user-value"
                                  id="modalNomor"></span>

                        </div>

                    </div>

                    <div class="wa-user-item">

                        <div class="wa-user-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>

                        <div class="wa-user-content">

                            <span class="wa-user-label">
                                Topik Pertanyaan
                            </span>

                            <span class="wa-user-value"
                                  id="modalTopik"></span>

                        </div>

                    </div>

                </div>

                {{-- TEXTAREA --}}
                <div class="mt-4">

                    <label class="wa-label">
                        Tulis Balasan
                    </label>

                    <textarea id="balasanText"
                              class="wa-textarea"
                              placeholder="Tulis balasan untuk pengunjung..."></textarea>

                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer wa-modal-footer">

                <button type="button"
                        class="btn-wa-cancel"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <button type="button"
                        class="btn-wa-send"
                        onclick="sendToWhatsApp()">

                    <i class="fab fa-whatsapp me-2"></i>
                    Kirim WhatsApp

                </button>

            </div>

        </div>

    </div>

</div>

@foreach($kontaks as $item)
<form id="delete-form-{{ $item->id }}"
      action="{{ route('admin.kontak.destroy', $item->id) }}"
      method="POST"
      class="d-none">

    @csrf
    @method('DELETE')

</form>
@endforeach

@endsection

@push('scripts')
<script>
    let currentKontakId = null,
        currentWaNumber = null,
        balasModal = null,
        deleteId = '';

    document.addEventListener('DOMContentLoaded', function() {

        const modalEl = document.getElementById('balasModal');

        if (modalEl) {

            balasModal = new bootstrap.Modal(modalEl);

            modalEl.addEventListener('hidden.bs.modal', function() {

                document.getElementById('balasanText').value = '';

                currentKontakId = null;
                currentWaNumber = null;

                document.querySelectorAll('.modal-backdrop')
                    .forEach(b => b.remove());

                document.body.classList.remove('modal-open');
            });
        }
    });

    function openBalasModal(id, nama, nomor, topik) {

        currentKontakId = id;

        currentWaNumber = nomor.startsWith('0')
            ? '62' + nomor.substring(1)
            : nomor;

        document.getElementById('modalNama').innerText = nama;
        document.getElementById('modalNomor').innerText = nomor;
        document.getElementById('modalTopik').innerText = topik;

        document.getElementById('balasanText').value = `Halo ${nama},

        Terima kasih telah menghubungi SMK Agri Insani.

        - Topik: ${topik}

        Balasan:
        `;

        if (balasModal) {
            balasModal.show();
        }
    }

    function sendToWhatsApp() {

        const balasan =
            document.getElementById('balasanText').value;

        if (!balasan.trim()) {

            alert('Silakan isi balasan.');
            return;
        }

        const waUrl =
            `https://wa.me/${currentWaNumber}?text=${encodeURIComponent(balasan)}`;

        fetch('{{ route("admin.kontak.save-balasan") }}', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                kontak_id: currentKontakId,
                balasan: balasan
            })

        }).then(() => {

            window.open(waUrl, '_blank');

            balasModal.hide();

            setTimeout(() => location.reload(), 1000);

        }).catch(() => {

            window.open(waUrl, '_blank');

            balasModal.hide();
        });
    }

    function confirmDelete(id, nama) {

        deleteId = id;

        document.getElementById('deleteNama').innerText = nama;

        new bootstrap.Modal(
            document.getElementById('deleteModal')
        ).show();
    }

    document.getElementById('confirmDeleteBtn')
        ?.addEventListener('click', function() {

            if (deleteId) {

                document.getElementById(
                    'delete-form-' + deleteId
                ).submit();
            }
        });
</script>
@endpush