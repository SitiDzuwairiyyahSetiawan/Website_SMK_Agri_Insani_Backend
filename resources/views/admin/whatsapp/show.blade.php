@extends('admin.layouts.app')

@section('title', 'Detail WhatsApp')

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

    .message-icon{
        width:100%;
        height:320px;
        border-radius:24px;
        background:linear-gradient(
            135deg,
            #dcfce7,
            #bbf7d0
        );
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        border:2px solid #f3f4f6;
    }

    .message-icon i{
        font-size:90px;
        color:#166534;
        margin-bottom:18px;
    }

    .message-icon h5{
        font-weight:700;
        color:#166534;
    }

    .slider-title{
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

    .status-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 16px;
        border-radius:999px;
        font-size:13px;
        font-weight:700;
    }

    .status-pending{
        background:#fef3c7;
        color:#92400e;
    }

    .status-read{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .status-replied{
        background:#dcfce7;
        color:#166534;
    }

    .reply-box{
        margin-top:40px;
        padding:28px;
        border-radius:24px;
        background:#f9fafb;
        border:1px solid #f3f4f6;
    }

    .btn-back{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        background:#f3f4f6 !important;
        color:#374151 !important;
    }

    .btn-wa{
        border:none !important;
        border-radius:18px !important;
        padding:14px 24px !important;
        font-weight:700;
        color:white !important;
        background:linear-gradient(
            135deg,
            #16a34a,
            #15803d
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

        .slider-title{
            font-size:28px;
        }

        .message-icon{
            height:240px;
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
            Detail WhatsApp
        </h1>

        <p class="page-subtitle">
            Informasi lengkap aktivitas WhatsApp pengunjung
        </p>

    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="{{ route('admin.whatsapp-logs.index') }}"
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

                {{-- ICON --}}
                <div class="mb-4">

                    <div class="message-icon">

                        <i class="fab fa-whatsapp"></i>

                        <h5>
                            Aktivitas WhatsApp
                        </h5>

                    </div>

                </div>

                {{-- CONTENT --}}
                <div>

                    <h1 class="slider-title">
                        {{ strtoupper($log->purpose) }}
                    </h1>

                    <div class="meta-wrapper mb-5">

                        <div class="meta-chip">

                            <i class="fas fa-user"></i>
                            {{ $log->name }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-calendar-alt"></i>
                            {{ $log->created_at->format('d M Y') }}

                        </div>

                        <div class="meta-chip">

                            <i class="fas fa-clock"></i>
                            {{ $log->created_at->format('H:i') }}

                        </div>

                    </div>

                    <div class="section-title">
                        Informasi Aktivitas
                    </div>

                    <div class="description-box">

                        Pengunjung telah melakukan kontak WhatsApp
                        dengan tujuan:

                        <strong>
                            {{ strtoupper($log->purpose) }}
                        </strong>

                        menggunakan nomor WhatsApp
                        <strong>
                            {{ $log->phone }}
                        </strong>.

                    </div>

                    @if($log->status == 'dibalas')

                        <div class="reply-box">

                            <div class="section-title mb-3">
                                Status Balasan
                            </div>

                            <div class="description-box">

                                Admin telah membalas pesan WhatsApp
                                pengunjung melalui sistem.

                            </div>

                            <hr>

                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>

                                Dibalas pada:
                                {{ $log->updated_at->format('d F Y H:i:s') }}
                            </small>

                        </div>

                    @endif

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
                    Informasi Pengunjung
                </div>

                <div class="info-item">

                    <div class="info-label">
                        Status
                    </div>

                    <div class="info-value">

                        @if($log->status == 'pending')

                            <div class="status-badge status-pending">

                                <i class="fas fa-clock"></i>
                                Pending

                            </div>

                        @elseif($log->status == 'dibaca')

                            <div class="status-badge status-read">

                                <i class="fas fa-eye"></i>
                                Dibaca

                            </div>

                        @else

                            <div class="status-badge status-replied">

                                <i class="fas fa-check-circle"></i>
                                Dibalas

                            </div>

                        @endif

                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Nama Lengkap
                    </div>

                    <div class="info-value">
                        {{ $log->name }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        WhatsApp
                    </div>

                    <div class="info-value">
                        {{ $log->phone }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tujuan / Topik
                    </div>

                    <div class="info-value">
                        {{ strtoupper($log->purpose) }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        Tanggal Aktivitas
                    </div>

                    <div class="info-value">
                        {{ $log->created_at->format('d/m/Y H:i') }}
                    </div>

                </div>

                <div class="info-item">

                    <div class="info-label">
                        ID Log
                    </div>

                    <div class="info-value">
                        #{{ $log->id }}
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
                    Hapus Riwayat?
                </h3>

                <p class="text-muted mb-4">
                    Data WhatsApp akan dihapus permanen dari sistem.
                </p>

                <div class="alert alert-danger rounded-4 mb-4">

                    <strong>
                        {{ $log->name }}
                    </strong>

                </div>

                <div class="d-flex justify-content-center gap-3">

                    <button type="button"
                            class="btn btn-back"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <form action="{{ route('admin.whatsapp-logs.destroy', $log->id) }}"
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

{{-- MODAL BALAS --}}
<div class="modal fade"
     id="balasModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content modal-modern border-0 shadow">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">

                    <i class="fab fa-whatsapp me-2"></i>
                    Balas via WhatsApp

                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="alert alert-light border rounded-4">

                    <p class="mb-1">
                        <strong>Nama:</strong>
                        <span id="userNama"></span>
                    </p>

                    <p class="mb-1">
                        <strong>Nomor:</strong>
                        <span id="userNomor"></span>
                    </p>

                    <p class="mb-0">
                        <strong>Tujuan:</strong>
                        <span id="userTopik"></span>
                    </p>

                </div>

                <label class="form-label fw-bold">
                    Balasan:
                </label>

                <textarea id="balasanText"
                          rows="5"
                          class="form-control"
                          placeholder="Tulis balasan Anda..."></textarea>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-back"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <button type="button"
                        onclick="sendToWhatsApp()"
                        class="btn btn-wa">

                    <i class="fab fa-whatsapp me-2"></i>
                    Kirim

                </button>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>

let currentLogId = null;
let currentWaNumber = null;
let balasModal = null;

document.addEventListener('DOMContentLoaded', function(){

    const modalEl = document.getElementById('balasModal');

    if(modalEl){

        balasModal = new bootstrap.Modal(modalEl);

        modalEl.addEventListener('hidden.bs.modal', function(){

            document.getElementById('balasanText').value = '';

            currentLogId = null;
            currentWaNumber = null;

        });

    }

});

function confirmDelete()
{
    const modal = new bootstrap.Modal(
        document.getElementById('deleteModal')
    );

    modal.show();
}

function showBalasModal(id, nama, nomor, topik)
{
    currentLogId = id;

    currentWaNumber = nomor.startsWith('0')
        ? '62' + nomor.substring(1)
        : nomor;

    document.getElementById('userNama').innerText = nama;
    document.getElementById('userNomor').innerText = nomor;
    document.getElementById('userTopik').innerText = topik;

    document.getElementById('balasanText').value =
`Halo ${nama},

Terima kasih telah menghubungi SMK Agri Insani.

Terkait ${topik}, kami siap membantu Anda.

Salam,
Admin SMK Agri Insani`;

    balasModal.show();
}

function sendToWhatsApp()
{
    const balasan =
        document.getElementById('balasanText').value;

    if(!balasan.trim()){

        alert('Silakan isi balasan.');
        return;

    }

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

    })

    .then(() => {

        const waUrl =
`https://wa.me/${currentWaNumber}?text=${encodeURIComponent(balasan)}`;

        window.open(waUrl, '_blank');

        balasModal.hide();

        setTimeout(() => location.reload(), 1000);

    })

    .catch(() => {

        const waUrl =
`https://wa.me/${currentWaNumber}?text=${encodeURIComponent(balasan)}`;

        window.open(waUrl, '_blank');

        balasModal.hide();

    });
}

</script>

@endpush