@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detail Riwayat WhatsApp</h2>
        <div><a href="{{ route('admin.whatsapp-logs.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a></div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white"><h5 class="mb-0">Informasi Pengunjung</h5></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th width="150">Nama Lengkap</th><td>{{ $log->name }}</td></tr>
                        <tr><th>No. WhatsApp</th><td><a href="https://wa.me/{{ $log->phone }}" target="_blank" class="text-success"><i class="fab fa-whatsapp"></i> {{ $log->phone }}</a></td></tr>
                        <tr><th>Tujuan / Topik</th><td>{{ strtoupper($log->purpose) }}</td></tr>
                        <tr><th>Status</th><td>@if(strtolower($log->status) == 'terkirim') <span class="badge bg-success">Terkirim</span> @else <span class="badge bg-warning text-dark">Tertunda</span> @endif</td></tr>
                        <tr><th>Dikirim Pada</th><td>{{ $log->created_at->format('d F Y H:i:s') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-success text-white"><h5 class="mb-0">Aksi Cepat</h5></div>
                <div class="card-body">
                    <button onclick="showBalasModal({{ $log->id }}, {{ json_encode($log->name) }}, {{ json_encode($log->phone) }}, {{ json_encode(strtoupper($log->purpose)) }})" class="btn btn-success w-100 mb-3"><i class="fab fa-whatsapp"></i> Balas via WhatsApp</button>
                    <form action="{{ route('admin.whatsapp-logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger w-100"><i class="fas fa-trash"></i> Hapus Riwayat</button></form>
                </div>
            </div>
            <div class="card"><div class="card-header bg-secondary text-white"><h5 class="mb-0">Informasi</h5></div><div class="card-body"><p class="small text-muted"><i class="fas fa-info-circle"></i> Klik "Balas via WhatsApp" untuk menghubungi pengunjung ini. Status otomatis berubah menjadi "Dibalas".</p></div></div>
        </div>
    </div>
</div>

<!-- Modal Balas WhatsApp -->
<div class="modal fade" id="balasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white"><h5 class="modal-title"><i class="fab fa-whatsapp me-2"></i>Balas via WhatsApp</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="alert alert-light border"><p class="mb-1"><strong>Nama:</strong> <span id="userNama"></span></p><p class="mb-1"><strong>Nomor:</strong> <span id="userNomor"></span></p><p class="mb-0"><strong>Tujuan:</strong> <span id="userTopik"></span></p></div>
                <label class="form-label fw-semibold">Pesan Balasan</label>
                <textarea id="balasanText" rows="5" class="form-control" placeholder="Tulis balasan untuk dikirim via WhatsApp..."></textarea>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="button" class="btn btn-success" onclick="sendToWhatsApp()"><i class="fab fa-whatsapp me-1"></i> Kirim</button></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentLogId = null, currentWaNumber = null, balasModal = null;
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('balasModal');
        if (modalEl) {
            balasModal = new bootstrap.Modal(modalEl);
            modalEl.addEventListener('hidden.bs.modal', function() {
                document.getElementById('balasanText').value = '';
                currentLogId = null;
                currentWaNumber = null;
                document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                document.body.classList.remove('modal-open');
            });
        }
    });
    function showBalasModal(id, nama, nomor, topik) {
        currentLogId = id;
        currentWaNumber = nomor.startsWith('0') ? '62' + nomor.substring(1) : nomor;
        document.getElementById('userNama').innerText = nama;
        document.getElementById('userNomor').innerText = nomor;
        document.getElementById('userTopik').innerText = topik;
        document.getElementById('balasanText').value = `Halo ${nama},\nTerima kasih telah menghubungi SMK Agri Insani.\nAda yang bisa kami bantu terkait ${topik}?`;
        if (balasModal) balasModal.show();
    }
    function sendToWhatsApp() {
        const balasan = document.getElementById('balasanText').value;
        if (!balasan.trim()) { alert('Silakan isi balasan.'); return; }
        const waUrl = `https://wa.me/${currentWaNumber}?text=${encodeURIComponent(balasan)}`;
        fetch(`/admin/whatsapp-logs/${currentLogId}/status`, {
            method: 'PATCH', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
            body: JSON.stringify({ status: 'dibalas' })
        }).then(() => { window.open(waUrl, '_blank'); balasModal.hide(); setTimeout(() => location.reload(), 1000); })
          .catch(() => { window.open(waUrl, '_blank'); balasModal.hide(); });
    }
</script>
@endpush