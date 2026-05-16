@extends('admin.layouts.app')

@section('title', 'Data WhatsApp Logs')

@section('content')
<style>
    .col-lg-3-custom { width: 25%; }
    @media (max-width: 992px) { .col-lg-3-custom { width: 50%; } }
    @media (max-width: 768px) { .col-lg-3-custom { width: 50%; } }
    .stat-card .card-body { padding: 1rem; }
    .stat-card h3 { font-size: 1.8rem; font-weight: 700; margin-bottom: 0; }
    .stat-card h6 { font-size: 0.85rem; margin-bottom: .5rem; }
    .stat-card i { font-size: 2.2rem !important; }
</style>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="mb-0">Data WhatsApp Logs</h2><p class="text-muted">Kelola semua aktivitas WhatsApp dari sistem</p></div>
    <a href="{{ route('admin.whatsapp.export') }}" class="btn btn-success"><i class="fas fa-file-excel me-2"></i> Export Excel</a>
</div>

<div class="row mb-4">
    <div class="col-lg-3-custom col-md-6 col-6 mb-3"><div class="card stat-card bg-primary text-white border-0 shadow-sm h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-center"><div><h6 class="text-white-50">Total WhatsApp</h6><h3>{{ $statistik['total'] ?? 0 }}</h3></div><i class="fab fa-whatsapp opacity-50"></i></div></div></div></div>
    <div class="col-lg-3-custom col-md-6 col-6 mb-3"><div class="card stat-card bg-warning text-white border-0 shadow-sm h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-center"><div><h6 class="text-white-50">Pending</h6><h3>{{ $statistik['pending'] ?? 0 }}</h3></div><i class="fas fa-clock opacity-50"></i></div></div></div></div>
    <div class="col-lg-3-custom col-md-6 col-6 mb-3"><div class="card stat-card bg-info text-white border-0 shadow-sm h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-center"><div><h6 class="text-white-50">Dibaca</h6><h3>{{ $statistik['dibaca'] ?? 0 }}</h3></div><i class="fas fa-eye opacity-50"></i></div></div></div></div>
    <div class="col-lg-3-custom col-md-6 col-6 mb-3"><div class="card stat-card bg-success text-white border-0 shadow-sm h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-center"><div><h6 class="text-white-50">Dibalas</h6><h3>{{ $statistik['dibalas'] ?? 0 }}</h3></div><i class="fas fa-reply opacity-50"></i></div></div></div></div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light"><tr><th class="ps-3">ID</th><th>Nama</th><th>No WhatsApp</th><th>Tujuan</th><th>Status</th><th>Tanggal</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                    @forelse($whatsappLogs as $key => $log)
                    <tr>
                        <td class="ps-3">{{ $whatsappLogs->firstItem() + $key }}</td>
                        <td><strong>{{ $log->name }}</strong></td>
                        <td><a href="https://wa.me/{{ $log->phone }}" target="_blank" class="text-success"><i class="fab fa-whatsapp me-1"></i>{{ $log->phone }}</a></td>
                        <td>@if(strtolower($log->purpose) == 'ppdb') PPDB @else {{ Str::title(Str::limit($log->purpose, 30)) }} @endif</td>
                        <td>@if(strtolower($log->status) == 'pending') <span class="badge bg-warning text-dark">Pending</span> @elseif(strtolower($log->status) == 'dibaca') <span class="badge bg-info">Dibaca</span> @elseif(strtolower($log->status) == 'dibalas') <span class="badge bg-success">Dibalas</span> @else <span class="badge bg-secondary">Proses</span> @endif</td>
                        <td>{{ $log->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('admin.whatsapp-logs.show', $log->id) }}" class="btn btn-info btn-sm action-btn" title="Lihat Detail"><i class="fas fa-eye"></i> @if(strtolower($log->status) == 'pending')<span class="badge bg-light text-dark ms-1">NEW</span>@endif</a>
                                <button type="button" class="btn btn-success btn-sm action-btn" title="Balas WhatsApp" onclick="openBalasModal({{ $log->id }}, {{ json_encode($log->name) }}, {{ json_encode($log->phone) }}, {{ json_encode($log->purpose) }})"><i class="fab fa-whatsapp"></i></button>
                                <button type="button" class="btn btn-danger btn-sm action-btn" title="Hapus" onclick="confirmDelete({{ $log->id }}, {{ json_encode($log->name) }})"><i class="fas fa-trash"></i></button>
                            </div>
                            <form id="delete-form-{{ $log->id }}" action="{{ route('admin.whatsapp-logs.destroy', $log->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-5"><i class="fab fa-whatsapp fa-4x text-muted mb-3 d-block"></i><h5 class="text-muted">Tidak ada data WhatsApp logs</h5></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-3">{{ $whatsappLogs->links() }}</div>
</div>

<!-- Modal Balas WhatsApp -->
<div class="modal fade" id="balasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white"><h5 class="modal-title"><i class="fab fa-whatsapp me-2"></i>Balas WhatsApp</h5><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="alert alert-light border"><p class="mb-1"><strong>Nama:</strong> <span id="namaUser"></span></p><p class="mb-1"><strong>No:</strong> <span id="nomorUser"></span></p><p class="mb-0"><strong>Tujuan:</strong> <span id="tujuanUser"></span></p></div>
                <textarea id="balasanText" class="form-control" rows="5" placeholder="Tulis balasan..."></textarea>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button class="btn btn-success" onclick="sendWA()">Kirim</button></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentLogId = null, currentPhone = null, waModal = null;
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('balasModal');
        if (modalEl) {
            waModal = new bootstrap.Modal(modalEl);
            modalEl.addEventListener('hidden.bs.modal', function() {
                document.getElementById('balasanText').value = '';
                currentLogId = null;
                currentPhone = null;
                document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                document.body.classList.remove('modal-open');
            });
        }
    });
    function openBalasModal(id, nama, phone, tujuan) {
        currentLogId = id;
        currentPhone = phone.startsWith('0') ? '62' + phone.substring(1) : phone;
        document.getElementById('namaUser').innerText = nama;
        document.getElementById('nomorUser').innerText = phone;
        document.getElementById('tujuanUser').innerText = tujuan;
        document.getElementById('balasanText').value = `Halo ${nama},\nTerima kasih telah menghubungi SMK Agri Insani. Ada yang bisa kami bantu terkait ${tujuan}?`;
        if (waModal) waModal.show();
    }
    function sendWA() {
        const msg = document.getElementById('balasanText').value;
        if (!msg.trim()) { alert('Isi balasan dulu'); return; }
        const url = `https://wa.me/${currentPhone}?text=${encodeURIComponent(msg)}`;
        fetch(`/admin/whatsapp-logs/${currentLogId}/status`, {
            method: 'PATCH', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ status: 'dibalas' })
        }).then(() => { window.open(url, '_blank'); waModal.hide(); setTimeout(() => location.reload(), 1000); })
          .catch(() => { window.open(url, '_blank'); waModal.hide(); });
    }
    function confirmDelete(id, name) { if (confirm(`Hapus data ${name}?`)) document.getElementById('delete-form-' + id).submit(); }
</script>
<style>
    .action-btn { border-radius: 8px !important; transition: all .2s ease; box-shadow: 0 2px 6px rgba(0,0,0,.12); }
    .action-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,.18); }
</style>
@endpush