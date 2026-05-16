@extends('admin.layouts.app')

@section('title', 'Detail Pesan Kontak')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="mb-0">Detail Pesan Kontak</h2><p class="text-muted">Lihat informasi lengkap pesan kontak pengunjung</p></div>
    <div><a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a></div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="mb-4 text-center"><div class="bg-light rounded p-5"><i class="fas fa-envelope fa-5x text-primary"></i><p class="text-muted mt-3">Pesan dari Pengunjung</p></div></div>
                <h1 class="h3 mb-3">{{ $kontak->topik_pertanyaan }}</h1>
                <div class="text-muted mb-4"><i class="fas fa-user"></i> {{ $kontak->nama_lengkap }} <span class="mx-2">|</span> <i class="fas fa-calendar-alt"></i> {{ $kontak->created_at->format('d F Y') }} <span class="mx-2">|</span> <i class="fas fa-clock"></i> {{ $kontak->created_at->format('H:i') }}</div>
                <div class="border-top pt-4"><h5 class="fw-bold mb-3">Isi Pesan</h5><div class="berita-konten">{!! nl2br(e($kontak->pesan)) !!}</div></div>
            </div>
        </div>
        @if($kontak->balasan_admin)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white"><h5 class="mb-0"><i class="fab fa-whatsapp me-2"></i>Balasan Admin</h5></div>
            <div class="card-body"><div class="berita-konten">{!! nl2br(e($kontak->balasan_admin)) !!}</div><hr><small class="text-muted"><i class="fas fa-clock me-1"></i> Dibalas pada: {{ $kontak->updated_at->format('d F Y H:i:s') }}</small></div>
        </div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white"><h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Kontak</h5></div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><td width="40%"><strong>Status</strong></td><td>@if($kontak->status == 'pending') <span class="badge bg-warning">Pending</span> @elseif($kontak->status == 'dibaca') <span class="badge bg-info">Dibaca</span> @else <span class="badge bg-success">Dibalas</span> @endif</td></tr>
                    <tr><td><strong>Nama</strong></td><td>{{ $kontak->nama_lengkap }}</td></tr>
                    <tr><td><strong>WhatsApp</strong></td><td><a href="https://wa.me/{{ $kontak->no_telepon }}" target="_blank" class="text-success"><i class="fab fa-whatsapp"></i> {{ $kontak->no_telepon }}</a></td></tr>
                    <tr><td><strong>Dikirim</strong></td><td>{{ $kontak->created_at->format('d/m/Y H:i:s') }}</td></tr>
                    <tr><td><strong>ID Pesan</strong></td><td>#{{ $kontak->id }}</td></tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-success text-white"><h5 class="mb-0">Aksi Cepat</h5></div>
            <div class="card-body">
                <button onclick="showBalasModal({{ $kontak->id }}, {{ json_encode($kontak->nama_lengkap) }}, {{ json_encode($kontak->no_telepon) }}, {{ json_encode($kontak->topik_pertanyaan) }})" class="btn btn-success w-100 mb-3"><i class="fab fa-whatsapp"></i> Balas via WhatsApp</button>
                <button onclick="confirmDelete()" class="btn btn-danger w-100"><i class="fas fa-trash"></i> Hapus Pesan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white"><h5 class="modal-title"><i class="fas fa-trash-alt me-2"></i>Konfirmasi Hapus</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body"><p>Apakah Anda yakin ingin menghapus pesan dari:</p><p class="fw-bold text-danger">{{ $kontak->nama_lengkap }}</p><p class="text-muted small">Tindakan ini tidak dapat dibatalkan!</p></div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><form action="{{ route('admin.kontak.destroy', $kontak->id) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Ya, Hapus!</button></form></div>
        </div>
    </div>
</div>

<!-- Modal Balas WhatsApp -->
<div class="modal fade" id="balasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white"><h5 class="modal-title"><i class="fab fa-whatsapp me-2"></i>Balas via WhatsApp</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="alert alert-light border"><p class="mb-1"><strong>Nama:</strong> <span id="userNama"></span></p><p class="mb-1"><strong>Nomor:</strong> <span id="userNomor"></span></p><p class="mb-0"><strong>Topik:</strong> <span id="userTopik"></span></p></div>
                <label class="form-label fw-bold">Balasan:</label>
                <textarea id="balasanText" rows="5" class="form-control" placeholder="Tulis balasan Anda..."></textarea>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="button" onclick="sendToWhatsApp()" class="btn btn-success"><i class="fab fa-whatsapp me-2"></i>Kirim ke WhatsApp</button></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentKontakId = null, currentWaNumber = null, balasModal = null;
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('balasModal');
        if (modalEl) {
            balasModal = new bootstrap.Modal(modalEl);
            modalEl.addEventListener('hidden.bs.modal', function() {
                document.getElementById('balasanText').value = '';
                currentKontakId = null;
                currentWaNumber = null;
                document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                document.body.classList.remove('modal-open');
            });
        }
    });
    function showBalasModal(id, nama, nomor, topik) {
        currentKontakId = id;
        currentWaNumber = nomor.startsWith('0') ? '62' + nomor.substring(1) : nomor;
        document.getElementById('userNama').innerText = nama;
        document.getElementById('userNomor').innerText = nomor;
        document.getElementById('userTopik').innerText = topik;
        document.getElementById('balasanText').value = `Halo ${nama},\n\nTerima kasih telah menghubungi SMK Agri Insani.\n\nBalasan untuk topik "${topik}":\n`;
        if (balasModal) balasModal.show();
    }
    function sendToWhatsApp() {
        const balasan = document.getElementById('balasanText').value;
        if (!balasan.trim()) { alert('Silakan isi balasan.'); return; }
        const nama = document.getElementById('userNama').innerText;
        const topik = document.getElementById('userTopik').innerText;
        const message = `*SMK Agri Insani*\n\nHalo *${nama}*,\n\nTerima kasih telah menghubungi kami.\n\n📝 *Topik:* ${topik}\n\n*Balasan:*\n${balasan}\n\n_SMK Agri Insani_`;
        const waUrl = `https://wa.me/${currentWaNumber}?text=${encodeURIComponent(message)}`;
        fetch('{{ route("admin.kontak.save-balasan") }}', {
            method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ kontak_id: currentKontakId, balasan: balasan })
        }).then(() => { window.open(waUrl, '_blank'); balasModal.hide(); setTimeout(() => location.reload(), 1000); })
          .catch(() => { window.open(waUrl, '_blank'); balasModal.hide(); });
    }
    function confirmDelete() { new bootstrap.Modal(document.getElementById('deleteModal')).show(); }
</script>
@endpush