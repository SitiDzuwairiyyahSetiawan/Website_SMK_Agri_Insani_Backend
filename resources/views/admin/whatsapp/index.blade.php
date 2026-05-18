@extends('admin.layouts.app')

@section('title', 'Data WhatsApp Logs')

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
    }

    .modern-card{
        border:none;
        border-radius:28px;
        overflow:hidden;
        background:white;
        box-shadow:
            0 10px 30px rgba(0,0,0,.05),
            0 2px 10px rgba(0,0,0,.03);
    }

    .stat-card{
        position:relative;
        overflow:hidden;
        transition:.3s ease;
        min-height:160px;
    }

    .stat-card:hover{
        transform:translateY(-4px);
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

    .table-modern tbody tr:hover{
        background:#fbfffc;
    }

    .badge-pending{
        background:#fef3c7;
        color:#b45309;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
    }

    .badge-read{
        background:#dbeafe;
        color:#2563eb;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
    }

    .badge-replied{
        background:#dcfce7;
        color:#16a34a;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
    }

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

    /* DELETE MODAL */

    .delete-modal .modal-content{
        border:none;
        border-radius:30px;
        overflow:hidden;
    }

    .delete-icon{
        width:95px;
        height:95px;
        border-radius:30px;
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

    /* MODAL WHATSAPP */

    .wa-modal-content{
        border:none !important;
        border-radius:32px !important;
        overflow:hidden;
    }

    .wa-modal-header{
        background:linear-gradient(135deg,#16a34a,#14532d);
        padding:30px;
        border:none;
    }

    .wa-modal-title{
        color:white;
        font-size:24px;
        font-weight:800;
    }

    .wa-modal-subtitle{
        color:rgba(255,255,255,.8);
        margin:0;
    }

    .wa-modal-body{
        padding:30px;
    }

    .wa-user-box{
        background:#f9fafb;
        border-radius:20px;
        padding:20px;
        margin-bottom:20px;
    }

    .wa-user-item{
        margin-bottom:15px;
    }

    .wa-user-label{
        font-size:13px;
        color:#6b7280;
        font-weight:700;
    }

    .wa-user-value{
        font-size:16px;
        font-weight:700;
        color:#111827;
    }

    .wa-textarea{
        width:100%;
        min-height:220px;
        border-radius:20px;
        border:1px solid #d1d5db;
        padding:20px;
        resize:none;
    }

    .wa-modal-footer{
        border:none;
        padding:0 30px 30px;
        display:flex;
        gap:14px;
    }

    .btn-wa-cancel{
        flex:1;
        height:58px;
        border:none;
        border-radius:18px;
        background:#f3f4f6;
        color:#374151;
        font-weight:700;
    }

    .btn-wa-send{
        flex:1;
        height:58px;
        border:none;
        border-radius:18px;
        background:linear-gradient(135deg,#22c55e,#15803d);
        color:white;
        font-weight:700;
    }

</style>

<div class="page-header">

    <div>

        <h1 class="page-title">
            Data WhatsApp Logs
        </h1>

        <p class="page-subtitle">
            Kelola semua aktivitas WhatsApp dari sistem
        </p>

    </div>

    <a href="{{ route('admin.whatsapp.export') }}"
       class="btn-export">

        <i class="fas fa-file-excel"></i>
        <span>Export Excel</span>

    </a>

</div>

<div class="row mb-4">

    <div class="col-lg-3 mb-3">

        <div class="modern-card stat-card stat-primary">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">Total WhatsApp</div>

                        <div class="stat-value">
                            {{ $statistik['total'] ?? 0 }}
                        </div>

                        <div class="stat-desc">
                            Semua aktivitas
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3 mb-3">

        <div class="modern-card stat-card stat-warning">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">Pending</div>

                        <div class="stat-value">
                            {{ $statistik['pending'] ?? 0 }}
                        </div>

                        <div class="stat-desc">
                            Belum dibaca
                        </div>

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

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">Dibaca</div>

                        <div class="stat-value">
                            {{ $statistik['dibaca'] ?? 0 }}
                        </div>

                        <div class="stat-desc">
                            Sudah dibaca
                        </div>

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

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">Dibalas</div>

                        <div class="stat-value">
                            {{ $statistik['dibalas'] ?? 0 }}
                        </div>

                        <div class="stat-desc">
                            Sudah dibalas
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-reply"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modern-card">

    <div class="table-responsive">

        <table class="table table-modern align-middle">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>WhatsApp</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($whatsappLogs as $log)

                <tr>

                    <td>
                        {{ $log->id }}
                    </td>

                    <td>
                        <strong>{{ $log->name }}</strong>
                    </td>

                    <td>

                        <a href="https://wa.me/{{ $log->phone }}"
                           target="_blank"
                           class="text-success text-decoration-none">

                            <i class="fab fa-whatsapp"></i>
                            {{ $log->phone }}

                        </a>

                    </td>

                    <td>

                        @if(strtolower($log->purpose) == 'spmb')
                            SPMB
                        @else
                            {{ Str::title(Str::limit($log->purpose, 35)) }}
                        @endif

                    </td>

                    <td>

                        @if(strtolower($log->status) == 'pending')

                            <span class="badge-pending">
                                Pending
                            </span>

                        @elseif(strtolower($log->status) == 'dibaca')

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

                        {{ $log->created_at->format('d M Y H:i') }}

                    </td>

                    <td>

                        <div class="action-group">

                            <a href="{{ route('admin.whatsapp-logs.show', $log->id) }}"
                               class="action-btn btn-view">

                                <i class="fas fa-eye"></i>

                            </a>

                            <button type="button"
                                    class="action-btn btn-wa"
                                    onclick="openBalasModal(
                                        {{ $log->id }},
                                        {{ json_encode($log->name) }},
                                        {{ json_encode($log->phone) }},
                                        {{ json_encode($log->purpose) }}
                                    )">

                                <i class="fab fa-whatsapp"></i>

                            </button>

                            <button type="button"
                                    class="action-btn btn-delete"
                                    onclick="confirmDelete(
                                        {{ $log->id }},
                                        {{ json_encode($log->name) }}
                                    )">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7">

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>

                            <h4 class="fw-bold text-muted">
                                Belum Ada Aktivitas WhatsApp
                            </h4>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- MODAL DELETE --}}
<div class="modal fade delete-modal"
     id="deleteModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body text-center p-5">

                <div class="delete-icon mx-auto mb-4">

                    <i class="fas fa-trash-alt"></i>

                </div>

                <h3 class="delete-title">
                    Hapus Data?
                </h3>

                <p class="delete-text">

                    Data WhatsApp dari
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

{{-- MODAL BALAS --}}
<div class="modal fade"
     id="balasModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content wa-modal-content">

            <div class="modal-header wa-modal-header">

                <div>

                    <h5 class="wa-modal-title">
                        Balas WhatsApp
                    </h5>

                    <p class="wa-modal-subtitle">
                        Kirim balasan langsung
                    </p>

                </div>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body wa-modal-body">

                <div class="wa-user-box">

                    <div class="wa-user-item">

                        <div class="wa-user-label">
                            Nama
                        </div>

                        <div class="wa-user-value"
                             id="modalNama"></div>

                    </div>

                    <div class="wa-user-item">

                        <div class="wa-user-label">
                            WhatsApp
                        </div>

                        <div class="wa-user-value"
                             id="modalNomor"></div>

                    </div>

                    <div class="wa-user-item">

                        <div class="wa-user-label">
                            Topik
                        </div>

                        <div class="wa-user-value"
                             id="modalTopik"></div>

                    </div>

                </div>

                <textarea id="balasanText"
                          class="wa-textarea"
                          placeholder="Tulis balasan..."></textarea>

            </div>

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

{{-- FORM DELETE --}}
@foreach($whatsappLogs as $log)

<form id="delete-form-{{ $log->id }}"
      action="{{ route('admin.whatsapp-logs.destroy', $log->id) }}"
      method="POST"
      class="d-none">

    @csrf
    @method('DELETE')

</form>

@endforeach

@endsection

@push('scripts')
<script>

    let currentLogId = null,
        currentWaNumber = null,
        balasModal = null,
        deleteId = '';

    document.addEventListener('DOMContentLoaded', function() {

        const modalEl =
            document.getElementById('balasModal');

        if (modalEl) {

            balasModal =
                new bootstrap.Modal(modalEl);

            modalEl.addEventListener(
                'hidden.bs.modal',
                function() {

                    document.getElementById(
                        'balasanText'
                    ).value = '';

                    currentLogId = null;
                    currentWaNumber = null;

                    document.querySelectorAll(
                        '.modal-backdrop'
                    ).forEach(b => b.remove());

                    document.body.classList.remove(
                        'modal-open'
                    );
                }
            );
        }
    });

    function openBalasModal(id, nama, nomor, topik) {

        currentLogId = id;

        currentWaNumber =
            nomor.startsWith('0')
            ? '62' + nomor.substring(1)
            : nomor;

        document.getElementById(
            'modalNama'
        ).innerText = nama;

        document.getElementById(
            'modalNomor'
        ).innerText = nomor;

        document.getElementById(
            'modalTopik'
        ).innerText = topik;

        document.getElementById(
            'balasanText'
        ).value =
`Halo ${nama},

Terima kasih telah menghubungi SMK Agri Insani.

Terkait:
${topik}

Balasan:
`;

        if (balasModal) {
            balasModal.show();
        }
    }

    function sendToWhatsApp() {

        const balasan =
            document.getElementById(
                'balasanText'
            ).value;

        if (!balasan.trim()) {

            alert('Silakan isi balasan.');
            return;
        }

        const waUrl =
            `https://wa.me/${currentWaNumber}?text=${encodeURIComponent(balasan)}`;

        fetch(`/admin/whatsapp-logs/${currentLogId}/status`, {

            method: 'PATCH',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                status: 'dibalas'
            })

        }).then(() => {

            window.open(waUrl, '_blank');

            balasModal.hide();

            setTimeout(() => {

                location.reload();

            }, 1000);

        }).catch(() => {

            window.open(waUrl, '_blank');

            balasModal.hide();
        });
    }

    function confirmDelete(id, nama) {

        deleteId = id;

        document.getElementById(
            'deleteNama'
        ).innerText = nama;

        new bootstrap.Modal(
            document.getElementById(
                'deleteModal'
            )
        ).show();
    }

    document.getElementById(
        'confirmDeleteBtn'
    )?.addEventListener('click', function() {

        if (deleteId) {

            document.getElementById(
                'delete-form-' + deleteId
            ).submit();
        }
    });

</script>
@endpush